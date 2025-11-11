<?php

/**
 *   Package Name: Stripe Pad
 *   File Description: Main Controller for custom app. Use this class to Override any core method /core/StripePad.php
 *   # Each method of this class can be accessed from //your-domain/app/{method}?params=params
 *   @author Beto Ayesa <beto.phpninja@gmail.com>
 *   @version 1.0.0
 *   @package StripePad
 *   @license GPL3
 *   @link https://github.com/natzar/stripe-pad
 * 
 *  
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   This file is part of Stripe Pad.
 *
 *   Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 *   Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
 */


/**
 * Your Custom App
 * @ this controller by default extends StripePadController located at core/sp-core.php
 * 
 * Each method of this class can be accessed from //your-domain/{method}
 * $this->params contains all get/post params
 * App.php is just the main and solo controller of your custom app. 
 * Create service end points or just urls for your public and private pages. 
 * Old skool, php sevver side rendering, as less javascript as possible.
 */

include dirname(__FILE__) . '/orm/sp-orm.php'; // include the core controller
class Admin extends StripePadController
{
	var $isAuthenticated = false;

	public function __construct()
	{

		parent::__construct(); // !important

		$this->isAuthenticated = $this->isAuthenticated() and isset($_SESSION['is_superadmin']) and $_SESSION['is_superadmin'] == true;

		if (!$this->isAuthenticated) {
			header("location: " . LANDING_URL . "login");
			return;
		}

		$this->view->set_views_path(ADMIN_PATH . "views/");
		$this->view->set_isAuthenticated(true);
	}

	/**
	 * index
	 * default main method
	 * @return void
	 */
	public function index()
	{
		if (!$this->isAuthenticated) {
			header("location: " . ADMIN_URL . "login");
			return;
		}
		# check if user is authenticated
		$this->dashboard();
	}

	/**
	 * app 
	 * (Private part entry point, registered users only)
	 * If a registered user logs in, this method will be called. MODIFY THIS FUNCTION.
	 * @return void
	 */
	public function dashboard() // DASHBOARD
	{

		if (!$this->isSuperadmin) {
			throw new StripePad\Exceptions\PermissionsException('Not superadmin');
		}
		$trafficStats = $this->log->getTrafficSummaryFromFile(60, 10);
		$data = array(
			"log" => $this->log->getAll(),
			"counters" => $this->log->get_counters(),
			"online_visitors" => $trafficStats['online_visitors'],
			"traffic" => $trafficStats,
			"db_stats" => $this->getDatabaseStats()
		);
		$this->view->show('dashboard.php', $data);
	}





	/**
	 * form
	 * Generic Form generator for Orm based models
	 * @return void
	 */
	public function form()
	{



		$table = isset($this->params['m']) ? $this->params['m'] : -1;
		$rid = isset($this->params['a']) ? $this->params['a'] : -1;
		$op = isset($this->params['i']) ? $this->params['i'] : '';
		$modelName = $table . 'Model';
		$form = new $modelName();

		$data = $form->generateForm($table, $rid, $op);
		$data['SEO_TITLE'] = 'Añadir nuevo ';
		$data['SEO_DESCRIPTION'] = 'Añade un nuevo ' . ucfirst($table) . ' a la base de datos';
		$data["breadcrumb"] = array("label" => ucfirst($table), "url" => "app_" . $table);
		if ($rid != -1) {
			$data['SEO_TITLE'] = ucfirst($table) . ' #' . $rid;
			$data['SEO_DESCRIPTION'] = "sp-core.php linea 659"; //Created " . strftime(" %d %B %Y %H:%M", strtotime($data['created'])) . " - Updated: " . strftime(" %d %B %Y %H:%M", strtotime($data['updated']));
		}

		$this->view->show('superadmin/form.php', $data);
	}


	/* SuperAdmin magic functions: Forms creation and Rows Inserting and updating. One day someone will come asking questions about this shit.
    ---------------------------------------*/


	/**
	 * table
	 * Part of Orm, it generates a table 
	 * @return void
	 */
	public function table()
	{
		if (!$this->isSuperadmin) {
			throw new StripePad\Exceptions\PermissionsException('Not superadmin');
		}


		$table = $this->params['m'];
		$items = null;
		$class = $table . 'Model';


		if (class_exists($class)) {
			$items = new $class();
		} else {
			$items = new Orm($table);
		}




		$itemsFinal = null;
		$items_head = $items->getItemsHead($table);
		$fields = $items->getTableAttribute($table, 'fields');
		$user_group = $_SESSION['user']['group'];

		if (isset($this->params['i']) and in_array($this->params['i'], $fields)) {
			$params = ['table' => $table, $this->params['i'] => $this->params['z']];
			$itemsFinal = $items->search($params);
		} else {
			$itemsFinal = $items->getAll($table);
		}

		$data = [/* "table_label" => $table_label, */
			'title' => "BackOffice | $table",
			'items_head' => $items_head,
			'items' => $itemsFinal,
			'HOOK_JS' => '', /// $items->table_js($table),
			'table' => $table,
			'table_label' => $items->getTableAttribute($table, 'table_label'),
			'notification' => isset($this->params['i']) and $this->params['i'] != -1 ? 'Se ha guardado correctamente' : '',
		];

		$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
		$this->view->show('table.php', $data);
	}

	/**
	 * update
	 *
	 * @return void
	 */
	public function update()
	{
		// if (!$this->isSuperadmin) {
		//     throw new StripePad\Exceptions\PermissionsException('Not superadmin');
		// }
		//        $orm = new Orm();
		$rid = $this->params['rid'];
		$table = $this->params['table'];
		$modelName = $table . 'Model';
		$orm = new $modelName();
		$return_url = null;


		if (isset($_SESSION['return_url']))    $return_url = $_SESSION['return_url'];

		if (isset($this->params['return_url']) and -1 != $this->params['return_url']) {
			$return_url = $this->params['return_url'];
		}

		if ($rid == -1) {
			$rid = $orm->add($this->params);
		} else {
			$orm->edit($this->params);
		}
		$_SESSION['alerts'][] = _('Actualizado correctamente');
		header('location: ' . $return_url);
	}
	public function reports()
	{
		$data = array();
		$this->view->show('superadmin/reports.php', $data);
	}
	public function system()
	{
		$data = array();
		$this->view->show('superadmin/system.php', $data);
	}
	/**
	 * actionStripeSync
	 *
	 * @return void
	 */
	public function actionStripeSync()
	{
		$stripe = new Stripe();
		$stripe->syncStripeCustomers();
		$stripe->syncStripeSubscriptions();
		$stripe->syncStripeInvoices();
		$stripe->syncStripeProducts();
		$_SESSION['alerts'][] = _("Stripe Import Completed");

		// ~ Redirection
		$this->superadmin();
	}

	/**
	 * Gather database stats for the dashboard (supports MySQL & SQLite)
	 */
	private function getDatabaseStats(): array
	{
		$stats = [
			'driver' => APP_STORAGE,
			'connection_ok' => false,
			'connection_error' => null,
			'table_sizes' => [],
			'available_pdo_drivers' => class_exists('PDO') ? PDO::getAvailableDrivers() : [],
		];

		try {
			if (APP_STORAGE === 'mysql') {
				$stats['table_sizes'] = $this->getMysqlTableSizes();
				$stats['connection_ok'] = true;
				$stats['database_label'] = APP_DB;
			} else {
				$sqliteStats = $this->getSqliteStats();
				$stats = array_merge($stats, $sqliteStats);
			}
		} catch (Throwable $e) {
			$stats['connection_error'] = $e->getMessage();
		}

		return $stats;
	}

	/**
	 * Return MySQL table sizes in MB
	 */
	private function getMysqlTableSizes(): array
	{
		$pdo = SPDO_mysql::singleton();
		$query = "
			SELECT
				table_name AS name,
				ROUND(((data_length + index_length) / 1024 / 1024), 2) AS size_mb
			FROM information_schema.TABLES
			WHERE table_schema = :schema
			ORDER BY (data_length + index_length) DESC";

		$stmt = $pdo->prepare($query);
		$stmt->execute(['schema' => APP_DB]);
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

		return array_map(function ($row) {
			return [
				'name' => $row['name'],
				'size_mb' => isset($row['size_mb']) ? (float)$row['size_mb'] : 0.0
			];
		}, $rows);
	}

	/**
	 * Return SQLite-specific stats (table sizes, db file size, etc.)
	 */
	private function getSqliteStats(): array
	{
		$pdo = SPDO_sqlite::singleton();
		$filePath = ROOT_PATH . 'storage/database.sqlite';
		$databaseSizeMb = $this->getFileSizeInMb($filePath);
		$tables = $this->fetchSqliteTables($pdo);
		$tableSizes = $this->calculateSqliteTableSizes($pdo, $tables, $databaseSizeMb);

		return [
			'connection_ok' => true,
			'database_path' => $filePath,
			'database_size_mb' => $databaseSizeMb,
			'table_sizes' => $tableSizes
		];
	}

	/**
	 * Fetch all user tables from SQLite schema
	 */
	private function fetchSqliteTables(PDO $pdo): array
	{
		$stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' ORDER BY name");
		$tables = $stmt ? $stmt->fetchAll(PDO::FETCH_COLUMN) : [];
		return $tables ?: [];
	}

	/**
	 * Calculate table sizes for SQLite (dbstat when available, fallback to row ratios)
	 */
	private function calculateSqliteTableSizes(PDO $pdo, array $tables, float $dbSizeMb): array
	{
		if (empty($tables)) {
			return [];
		}

		$fromDbstat = $this->fetchSqliteDbstatSizes($pdo, $tables);
		if (!empty($fromDbstat)) {
			return $fromDbstat;
		}

		$rowCounts = [];
		foreach ($tables as $table) {
			try {
				$sql = sprintf('SELECT COUNT(*) AS c FROM "%s"', $this->sanitizeSqliteIdentifier($table));
				$stmt = $pdo->query($sql);
				$rowCounts[$table] = (int)($stmt ? $stmt->fetchColumn() : 0);
			} catch (PDOException $e) {
				$rowCounts[$table] = 0;
			}
		}

		$totalRows = array_sum($rowCounts);
		if ($totalRows === 0 || $dbSizeMb <= 0) {
			return array_map(function ($table) {
				return ['name' => $table, 'size_mb' => 0.0];
			}, $tables);
		}

		return array_map(function ($table) use ($rowCounts, $totalRows, $dbSizeMb) {
			$ratio = $rowCounts[$table] / $totalRows;
			return [
				'name' => $table,
				'size_mb' => round($ratio * $dbSizeMb, 4)
			];
		}, $tables);
	}

	/**
	 * Try to use SQLite's dbstat virtual table for accurate size data
	 */
	private function fetchSqliteDbstatSizes(PDO $pdo, array $tables): array
	{
		$allowed = array_flip($tables);

		try {
			$pdo->exec("DROP TABLE IF EXISTS temp.dbstat");
			$pdo->exec("CREATE VIRTUAL TABLE temp.dbstat USING dbstat(main)");
			$stmt = $pdo->query("SELECT name, SUM(pgsize) AS size FROM temp.dbstat GROUP BY name");
		} catch (PDOException $e) {
			return [];
		}

		$result = [];
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$name = $row['name'] ?? null;
			if (!$name || !isset($allowed[$name])) {
				continue;
			}
			$bytes = (int)($row['size'] ?? 0);
			$result[] = [
				'name' => $name,
				'size_mb' => round($bytes / 1024 / 1024, 4)
			];
		}

		return $result;
	}

	/**
	 * Avoid double quotes poisoning the identifier
	 */
	private function sanitizeSqliteIdentifier(string $identifier): string
	{
		return str_replace('"', '""', $identifier);
	}

	private function getFileSizeInMb(string $path): float
	{
		if (!is_file($path)) {
			return 0.0;
		}

		$size = filesize($path);
		if ($size === false) {
			return 0.0;
		}

		return round($size / 1024 / 1024, 4);
	}
}
