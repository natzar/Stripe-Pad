<?php

/**
 * ModelBase
 */
abstract class ModelBase
{
	public $db = null;
	public $model = null;
	public $table = null;
	var $log;

	public function __construct($table = null)
	{
		$this->table = $table;

		// Database connection, that IF should be removed to a singleton class
		try {
			if (APP_STORAGE == "mysql")
				$this->db = SPDO_mysql::singleton();
			else
				$this->db = SPDO_sqlite::singleton();
		} catch (StripePad\Exceptions\DatabaseException $e) {
			die("Database connection error: "  . "[APP STORAGE: " . APP_STORAGE . " " . $e->getMessage());
		}
	}

	/**
	 * getLastId
	 *
	 * @return int id
	 */
	public function getLastId()
	{
		$stmt  = $this->db->query("SELECT LAST_INSERT_ID()");
		$c  = $stmt->fetch(PDO::FETCH_ASSOC);
		$cid = $c['LAST_INSERT_ID()'];
		return $cid;
	}
	/**
	 * Method setField
	 *
	 * @param $table $table [explicite description]
	 * @param $id $id [explicite description]
	 * @param $field $field [explicite description]
	 * @param $value $value [explicite description]
	 *
	 * @return void
	 */
	public function setField($table, $id, $field, $value)
	{
		$q = $this->db->prepare("UPDATE :t set :f = :v where :fid = :id");
		$q->bindParam(":t", $table);
		$q->bindParam(":f", $field);
		$q->bindParam(":v", $value);
		$q->bindParam(":fid", $table . "Id");
		$q->bindParam(":id", $id);
		if ($q->execute()) {
			return true;
		}
		return false;
	}


	/**
	 * getOrmDescription
	 * I think you have to explain a couple things and answer some questions ....
	 * @param  mixed $table
	 * @return void
	 */
	public function getOrmDescription($table = null)
	{
		if ($table == null)
			$table = $this->table ?? null;

		if (empty($table)) {
			throw new RuntimeException("No table selected");
		}

		$description = [
			"table_label"     => $table,
			"fields"          => [],
			"fields_types"    => [],
			"fields_labels"   => [],
			"fields_hints"    => [],
			"fields_to_show"  => [],
		];

		$pdo    = $this->db;              // PDO
		$driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);

		// --- 1) Obtener columnas según driver ---
		$cols = [];

		if ($driver === 'mysql') {
			// DESCRIBE devuelve Field, Type, Null, Key, Default, Extra
			$stmt = $pdo->prepare("DESCRIBE `$table`");
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($rows as $row) {
				$cols[] = [
					'name' => $row['Field'],
					'type' => strtolower(preg_replace('/\(.*/', '', $row['Type'])),
					'pk'   => ($row['Key'] === 'PRI') ? 1 : 0,
				];
			}
		} elseif ($driver === 'sqlite') {
			// PRAGMA table_info() devuelve: cid, name, type, notnull, dflt_value, pk
			// OJO: no admite parámetros, así que escapamos el nombre mínimamente
			$safeTable = preg_replace('/[^a-zA-Z0-9_]/', '', $table);
			$stmt = $pdo->query("PRAGMA table_info('$safeTable')");
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($rows as $row) {
				$cols[] = [
					'name' => $row['name'],
					'type' => strtolower(preg_replace('/\(.*/', '', $row['type'] ?? '')),
					'pk'   => (int)$row['pk'],
				];
			}
		} else {
			throw new RuntimeException("Unsupported driver: $driver");
		}

		// --- 2) Mapear tipos a tus tipos de UI ---
		foreach ($cols as $field) {
			$name = $field['name'];
			$rawType = $field['type'];
			$isPk = !empty($field['pk']);

			// Saltar PK y campos técnicos
			// Soporta tanto "tableId" como "id" si es PK
			if (
				$isPk ||
				$name === $table . "Id" ||
				$name === "created" ||
				$name === "updated"
			) {
				continue;
			}

			$type = $rawType;

			// Normalizar según tipos comunes MySQL + SQLite
			if (in_array($type, ['int', 'integer', 'bigint', 'smallint'])) {
				$type = 'number';
			}

			if (in_array($type, ['double', 'float', 'real', 'numeric', 'decimal'])) {
				$type = 'number';
			}

			if (in_array($type, ['varchar', 'char', 'string'])) {
				$type = 'literal';
			}

			if (in_array($type, ['blob', 'mediumtext', 'text'])) {
				$type = 'text';
			}

			if (in_array($type, ['date'])) {
				$type = 'fecha';
			}

			if (in_array($type, ['datetime', 'timestamp'])) {
				$type = 'fecha';
			}

			if (in_array($type, ['time'])) {
				$type = 'hora';
			}

			if (in_array($type, ['tinyint', 'boolean'])) {
				$type = 'truefalse';
			}

			// Reglas por nombre de campo
			if (str_contains($name, "Id")) {
				$type = 'combo';
			}

			if (str_contains($name, "_pass")) {
				$type = 'encrypted';
			}

			if ($name === 'password') {
				$type = 'password';
			}

			if ($name === 'agentsId') {
				$type = 'agents';
			}

			if ($name === 'actions') {
				$type = 'actions';
			}

			if (str_contains($name, "_file")) {
				$type = 'file_file';
			}

			if (str_contains($name, "image")) {
				$type = 'file_img';
			}

			if (str_contains($name, "content") || $type === 'text') {
				$type = 'text'; // sin WYSIWYG
			}

			if (in_array($name, ['no_reply', 'send_resumen', 'resend', 'add_cc', 'send_sms'])) {
				$type = 'scenario_option';
			}

			// Añadir al descriptor
			$description['fields'][] = $name;
			$description['fields_types'][] = $type;
		}

		// Labels y fields_to_show por defecto
		$description['fields_labels'] = $description['fields'];
		$description['fields_to_show'] = $description['fields'];

		// Orden por defecto:
		// 1) Si hay PK detectada, úsala
		// 2) Si no, intenta tableId
		// 3) Si no, id
		$pkField = null;
		foreach ($cols as $field) {
			if (!empty($field['pk'])) {
				$pkField = $field['name'];
				break;
			}
		}
		if (!$pkField && in_array($table . 'Id', array_column($cols, 'name'))) {
			$pkField = $table . 'Id';
		}
		if (!$pkField && in_array('id', array_column($cols, 'name'))) {
			$pkField = 'id';
		}

		if ($pkField) {
			$description['default_order'] = $pkField . " DESC";
		} else {
			$description['default_order'] = $table . "Id DESC";
		}

		return $description;
	}



	public function getTableAttribute($table, $attribute)
	{
		$data = $this->getOrmDescription($table);
		return $data[$attribute];
	}


	/**
	 * Method getItemsHead
	 * returns table headers (columns) for the admin listing
	 * @return void
	 */
	public function getItemsHead()
	{
		$data = $this->getOrmDescription($this->table);
		$fr = $data['fields_labels'];
		$fields_to_show = $data['fields_to_show'];
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		if (isset($fields_to_show) and is_array($fields_to_show) and count($fields_to_show) > 0) {
			$fr = array();
			for ($i = 0; $i < count($fields); $i++):
				if (in_array($fields[$i], $fields_to_show))
					$fr[] = $fields_labels[$i];
			endfor;
		}

		return $fr;
	}


	public function getAllByField($table, $field, $rid_in_field, $custom_order = null)
	{
		$model = $table . 'Model';
		$instance = new $model();
		$data = $instance->getOrmDescription();
		$fields_to_show = $data['fields_to_show'];
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];
		$order = is_null($custom_order) ? $data['default_order'] : $custom_order;



		$consulta = $this->db->prepare('SELECT *, FROM ' . $table . ' where ' . $field . '= "' . $rid_in_field . '" order by ' . $order);
		$consulta->execute();
		$array_return = array();

		while ($r = $consulta->fetch()):
			$row_array = array();
			$row_array['id'] = $r['id'];
			for ($i = 0; $i < count($fields); $i++):
				if (!isset($fields_to_show) or in_array($fields[$i], $fields_to_show) or empty($fields_to_show)):
					if (!class_exists($fields_types[$i]))
						die("La clase " . $fields_types[$i] . " no existe");
					$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $r[$fields[$i]], $table,  $row_array['id']);
					$row_array[] = $field_aux->view();
				endif;
			endfor;
			$row_array['last_access'] = $r['last_access'];
			$array_return[] = $row_array;

		endwhile;
		//  $array_return = $this->rowExtras($array_return,$table);
		return $array_return;
	}


	public function search($params)
	{

		$model = $params['table'] . 'Model';
		$instance = new $model();
		$data = $instance->getOrmDescription();
		$fields_to_show = $data['fields_to_show'];
		$fields = $data['fields'];
		$fields_types = $data['fields_types'];
		$fields_labels = $data['fields_labels'];
		$order = ($params['sorder'] != -1) ? $params['sorder'] : $data['default_order'];
		$table = $table_aux = $params['table'];

		//	if (isset($group_by) and !empty($group_by)) $table_aux.= ' GROUP BY '.$group_by.' ';  

		$where = array();
		for ($i = 0; $i < count($fields); $i++):
			if (isset($_POST[$fields[$i]])  and !empty($_POST[$fields[$i]]) and $_POST[$fields[$i]] != -1 or isset($params[$fields[$i]]) and $params[$fields[$i]] != -1) {
				$val = isset($_POST[$fields[$i]]) ? $_POST[$fields[$i]] : $params[$fields[$i]];



				if ($fields_types[$i] == 'literal' or $fields_types[$i] == 'text')
					$where[] = $fields[$i] . ' LIKE "%' . $val . '%"';
				else if (is_array($val))
					$where[] = $fields[$i] . " IN (" . implode(",", $val) . ")";

				else if ($fields_types[$i] == "combo" and $fields[$i] == "plansId")
					$where[] = $fields[$i] . " >= " . $val;
				else
					$where[] = $fields[$i] . ' like "' . $val . '"';
			}
		endfor;
		if (count($where) < 1) return array();

		$consulta = $this->db->prepare('SELECT *,' . $table . '.created as created, (SELECT created from logs where object="' . $table . '" and objectid=' . $table . '.' . $table . 'Id and usersId = ' . $_SESSION['user']['usersId'] . ' order by created DESC limit 1) as last_access FROM ' . $table_aux . ' WHERE ' . implode(' AND ', $where) . ' order by ' . $order);
		$consulta->execute();
		$array_return = array();

		while ($r = $consulta->fetch()):
			$row_array = array();
			$row_array[$table . 'Id'] = $r[$table . 'Id'];
			for ($i = 0; $i < count($fields); $i++):
				if (!isset($fields_to_show) or in_array($fields[$i], $fields_to_show) or empty($fields_to_show)):
					if (!class_exists($fields_types[$i]))
						die("La clase " . $fields_types[$i] . " no existe");
					$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $r[$fields[$i]], $table, $row_array[$table . 'Id']);
					$row_array[$fields[$i]] = $field_aux->view();
				endif;

			endfor;
			//$row_array['last_access'] = $r['last_access'];
			$row_array['created'] = $r['created'];
			$array_return[] = $row_array;

		endwhile;
		// $array_return = $this->rowExtras($array_return,$table);
		return $array_return;
	}




	public function getAll()
	{

		$data = $this->getOrmDescription();
		//print_r($data);
		$fields_to_show = $data['fields_to_show'];
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];
		$custom_order = null;
		$order = is_null($custom_order) ? $data['default_order'] : $custom_order;
		$table_aux = $this->table;
		$table_no_prefix = $this->table;
		$consulta = null;


		$consulta = $this->db->prepare('SELECT * FROM ' . $this->table . ' order by ' . $this->table . '.' . $order);

		$consulta->execute();
		$array_return = array();

		while ($r = $consulta->fetch()):
			$row_array = array();
			$row_array[$table_no_prefix . 'Id'] = $r[$table_no_prefix . 'Id'];
			for ($i = 0; $i < count($fields); $i++):
				if (!isset($fields_to_show) or in_array($fields[$i], $fields_to_show) or empty($fields_to_show)):
					if (!class_exists($fields_types[$i]))
						die("La clase " . $fields_types[$i] . " no existe");
					$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $r[$fields[$i]], $this->table, $row_array[$table_no_prefix . 'Id']);
					$row_array[$fields[$i]] = $field_aux->view();
				endif;
			endfor;
			$array_return[] = $row_array;

		endwhile;
		return $array_return;
	}
	public function getById($id)
	{

		return $this->get_by_id($id);
	}
	public function get_by_id($id)
	{
		$consulta = $this->db->prepare('SELECT * FROM ' . $this->table . ' where ' . $this->table . 'Id = :id limit 1');
		$consulta->bindParam(':id', $id);
		$consulta->execute();

		return $consulta->fetch();
	}


	public function getFormValues($table, $rid)
	{
		$table_no_prefix = $table;
		$consulta = $this->db->prepare("SELECT * FROM " . $table . " where " . $table_no_prefix . "Id='" . $rid . "' limit 1");
		$consulta->execute();
		return $consulta->fetch();
	}

	public function add($params)
	{
		$table = $this->table;

		$data = null;
		if (class_exists($table . 'Model')) {
			$model = $table . 'Model';
			$instance = new $model();
			$data = $instance->getOrmDescription($table);
		} else {
			$data = $this->getOrmDescription($table);
		}


		$fields_to_show = $data['fields_to_show'];
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];
		$table_aux = $table;
		$table_no_prefix = $table;

		$add_info_form = "";
		$tmp_path = APP_UPLOAD_PATH;
		$filled_fields = array();
		for ($i = 0; $i < count($fields); $i++) {

			if ($fields[$i] != $table . 'Id' and isset($params[$fields[$i]])) {
				$filled_fields[] = $fields[$i];
				$retrieved = -1;
				if (isset($params[$fields[$i]]) and $fields_types[$i] != 'file_img' and $fields_types[$i] != 'file_file') {
					$retrieved = $params[$fields[$i]];
				}

				if (!class_exists($fields_types[$i])) die("La clase " . $fields_types[$i] . " no existe");
				$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $retrieved, $table);
				$add_info_form .= "'" . $field_aux->exec_add() . "',";
			}
		}

		$info = substr($add_info_form, 0, strlen($add_info_form) - 1);
		$consulta = $this->db->prepare("INSERT INTO " . $table . " (" . implode(",", $filled_fields) . ") VALUES ($info)");
		$consulta->execute();
		$id =  $this->getLastId($table);
		//$this->log->push($table . "-add");
		log::system('Añadido nuevo registro a la tabla ' . $table);
		return $this->get_by_id($id);
	}


	public function edit($params)
	{

		$table = $this->table;
		assert(!is_null($table));
		$data = null;
		if (class_exists($table . 'Model')) {
			$model = $table . 'Model';
			$instance = new $model();
			$data = $instance->getOrmDescription();
		} else {
			$data = $this->getOrmDescription();
		}

		$rid = isset($params[$table . 'Id']) ? $params[$table . 'Id'] : $params['rid'];


		$fields_to_show = $data['fields_to_show'];
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];
		$table_aux = $table;
		$table_no_prefix = $table;

		$edit_info_form = "";
		$current = $this->getFormValues($table, $rid);
		$new = array();

		for ($i = 0; $i < count($fields); $i++) {

			if ($fields[$i] != $table . 'Id' and isset($params[$fields[$i]]) and $fields_types[$i] != 'file_img' and $fields_types[$i] != 'file_file') {
				$retrieved = $params[$fields[$i]];
				if (!class_exists($fields_types[$i])) die("La clase " . $fields_types[$i] . " no existe");
				if (strstr($fields_types[$i], 'file_') and $_FILES[$fields[$i]]['name'] != "" or !strstr($fields_types[$i], 'file_')) {

					if ($retrieved == "" and $fields_types[$i] == "password") {
					} else {
						$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $retrieved, $table, $rid);
						$edit_info_form .= " " . $table . "." . $fields[$i] . " = '" . $field_aux->exec_edit() . "',";
						$new[$fields[$i]] = $field_aux->exec_edit();
					}
				}
			}
		}
		//echo 'xxxxx';
		$info = substr($edit_info_form, 0, strlen($edit_info_form) - 1);
		$table_no_prefix =  $table;
		$rid = intval($rid);
		//echo "UPDATE " . $table . " set  $info   where " . $table_no_prefix . "Id=" . $rid;
		$consulta = $this->db->prepare("UPDATE " . $table . " set  $info   where " . $table_no_prefix . "Id=" . $rid);
		$consulta->execute();



		//$this->log->push($table . "-edit");
	}

	public function form_js($table)
	{
		$data = $this->getOrmDescription($table);
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];
		$output = "";

		if (in_array('fecha', $fields_types) or in_array('hora', $fields_types) or in_array('combo_child', $fields_types))

			for ($i = 0; $i < count($fields); $i++) {
				/*
						if ($fields_types[$i] == 'fecha')
							$output .='$(function() {	$("#'.$fields[$i].'").datepicker({
							 format: "dd/mm/yyyy H:i:s",
							 todayHighlight: "true",
							 todayHighlight: true,
							 weekStart: 1,
							 autoclose: true

							}); }
							);';
*/

				if ($fields_types[$i] == 'hora') {
					$output .= "$('#" . $fields[$i] . "').timepicker({
									hourGrid: 4,
									minuteGrid: 10,
									timeFormat: 'hh:mm:ss'
									});";
				}
				if ($fields_types[$i] == 'horario') {
					$output .= "$('#" . $fields[$i] . "_hora').timepicker({
									showMeridian: false,
									template: false,
                showInputs: false,
                defaultTime: '00:00'
									});";
				}

				if ($fields_types[$i] == "slug") {
					$lang = substr($fields[$i], -2);
					$output .= '$(document).ready(function(){ $("#title_' . $lang . '").change(function(){ $("#' . $fields[$i] . '").val($("#title_' . $lang . '").val()); validateSlug("' . $fields[$i] . '");}); });';
				}
			}

		/* Before Submit */
		$output .= "\n function check_form_values(z){
					
					//var z = document.getElementById(x);
					";
		for ($i = 0; $i < count($fields); $i++) {
			$output .= "if (z." . $fields[$i] . "){";
			switch ($fields_types[$i]) {
				case 'time_spent':
					if ($_SESSION['user']['group'] == "developers") {
						$output .= " if (z." . $fields[$i] . ".value == 0 ){ alert('Por favor introduce el tiempo consumido en minutos');
							z." . $fields[$i] . ".style.background='#ffff66';
									z." . $fields[$i] . ".focus();
									 return false; 
									 }";
					}
					break;
				case 'number':
					$output .= " if((!validateNumber(z." . $fields[$i] . ".value)) && (z." . $fields[$i] . ".value != \"\")){
									alert('No es un valor numerico correcto. Introduzca solo digitos. Utilice . (punto) para los decimales.');
									z." . $fields[$i] . ".style.background='#ffff66';
									z." . $fields[$i] . ".focus();
									return false;
								} 
							";
					break;
				case 'email':
					$output .= " if((!validateEmail(z." . $fields[$i] . ".value)) && (z." . $fields[$i] . ".value != \"\")){
									alert('Email no valido.');
									z." . $fields[$i] . ".style.background='#ffff66';
									z." . $fields[$i] . ".focus();
									return false;
								}
							";
					break;


				case 'url':
					$output .= " if((!validateURL(z." . $fields[$i] . ".value)) && (z." . $fields[$i] . ".value != \"\")){
									alert('URL debe empezar por http:// ');
									z." . $fields[$i] . ".style.background='#ffff66';
									z." . $fields[$i] . ".focus();
									return false;
								}
							";
					break;

				case 'editor':
					$output .= " $('input[name=\"" . $fields[$i] . "\"]').attr('value', encodeURIComponent( $('#" . $fields[$i] . "').elrte('val') )) ;";
					break;
			}
			$output .= "}";
		}
		$output .= " busy();";
		$output .= " z.submit();
		  }";

		return $output;
	}

	function updateOrder()
	{
		$tabla = $_POST['tabla'];
		$table_no_prefix = $tabla;
		$action 				= $_POST['action'];
		$updateRecordsArray 	= $_POST['recordsArray'];
		$field = $_POST['field'];
		$id = $_POST['id'];
		if ($action == "updateRecordsListings") {

			$listingCounter = 0;
			foreach ($updateRecordsArray as $recordIDValue) {
				if ($field != -1 and $id != -1) {
					$consulta = $this->db->prepare("UPDATE " . $tabla . " SET orden = " . $listingCounter . " WHERE " . $field . "='" . $id . "' and id = " . $recordIDValue);
					$consulta->execute();
				} else {
					$consulta = $this->db->prepare("UPDATE " . $tabla . " SET orden = " . $listingCounter . " WHERE  " . $table_no_prefix . "Id = " . $recordIDValue);
					$consulta->execute();
				}
				$listingCounter = $listingCounter + 1;
			}
			echo $listingCounter;
		}
		echo 0;
	}
	function updateTrueFalse()
	{


		$tabla = $_GET['table'];
		$f = $_GET['fieldname'];
		$rid = $_GET['rid'];
		$v = $_GET['v'];
		if ($v == 'true') $v = '1';
		else $v = '0';


		$consulta = $this->db->prepare("UPDATE " . $tabla . " SET " . $f . " = '" . $v . "' WHERE " . $tabla . "Id='" . $rid . "'");
		$consulta->execute();

		return true;
	}
	function updateVisible()
	{


		$tabla = $_GET['table'];
		$rid = $_GET['rid'];
		$v = $_GET['v'];
		if ($v == 'true') $v = '1';
		else $v = '0';


		$consulta = $this->db->prepare("UPDATE " . $tabla . " SET visible = '" . $v . "' WHERE " . $tabla . "Id='" . $rid . "'");
		$consulta->execute();

		return true;
	}

	function updateFeatured()
	{

		$tabla = $_GET['table'];
		$rid = $_GET['rid'];
		$v = $_GET['v'];
		if ($v == 'true') $v = '1';
		else $v = '0';


		$consulta = $this->db->prepare("UPDATE " . $tabla . " SET destacado_home = '" . $v . "' WHERE id='" . $rid . "'");
		$consulta->execute();
	}


	public function deleteRow($table, $id)
	{
		// TO-DO
		// NEED SECURITY CHECK IF USER CAN DELETE ROWS THIS TABLE
		$model = $table . 'Model';
		$instance = new $model();
		$data = $instance->getOrmDescription($table);
		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];

		$table_no_prefix =  $table;
		if (in_array('file_img', $fields) or in_array('file', $fields)) {

			$consulta = $this->db->prepare("SELECT * from " . $table . " where " . $table_no_prefix . "Id='" . $id . "' limit 1");
			$consulta->execute();
			$row2 = $consulta->fetch();

			for ($i = 0; $i < count($fields); $i++) {
				if ($fields_types[$i] == 'file') {
					if ($row2[$fields[$i]] != "")
						@unlink(APP_UPLOAD_PATH . $row2[$fields[$i]]);
				}

				if ($fields_types[$i] == 'file_img') {
					if ($row2[$fields[$i]] != "") {
						@unlink(APP_UPLOAD_PATH . $row2[$fields[$i]]);
						@unlink(APP_UPLOAD_PATH . "thumbs/" . $row2[$fields[$i]]);
					}
				}
			}
		}

		$consulta = $this->db->prepare("DELETE FROM " . $table . " where " . $table_no_prefix . "Id = '" . $id . "'");
		$consulta->execute();

		return true;
	}

	public function deleteImage($table, $field, $id)
	{

		$table_no_prefix = $table;
		$consulta = $this->db->prepare("SELECT $field FROM $table where " . $table_no_prefix . "Id='$id' limit 1");
		$consulta->execute();
		$r = $consulta->fetch();
		@unlink(APP_UPLOAD_PATH . "img/" . $r[$field]);

		$consulta = $this->db->prepare("UPDATE $table set $field='' where " . $table_no_prefix . "Id='$id'");
		$consulta->execute();
		return true;
	}


	/**
	 * generateForm
	 * Returns the HTML for a form
	 * Some day a guy and an old guy will come to ask you questions about this function
	 * @param  mixed $table
	 * @param  mixed $rid
	 * @param  mixed $fields
	 * @param  mixed $fields_labels
	 * @param  mixed $fields_types
	 * @return void
	 */
	public function generateForm($table, $rid, $op)
	{

		$data = $this->getOrmDescription($table);



		$fields = $data['fields'];
		$fields_labels = $data['fields_labels'];
		$fields_types = $data['fields_types'];
		$fields_hints = $data['fields_hints'];


		if ($rid == '') {
			$rid = -1;
		}
		$form_html = '';
		$raw = ($rid != -1) ? $this->getFormValues($table, $rid) : '';

		for ($i = 0; $i < count($fields); ++$i) {
			if (!class_exists($fields_types[$i])) {
				exit('La clase ' . $fields_types[$i] . ' no existe');
			}

			//if ($fields[$i] == "agentsId") continue;
			if ($fields[$i] == "total") continue;
			if ($fields[$i] == "actions") continue;


			$VALUE = isset($raw[$fields[$i]]) ? $raw[$fields[$i]] : '';
			//$VALUE .= $fields_types[$i];
			$field_aux = new $fields_types[$i]($fields[$i], $fields_labels[$i], $fields_types[$i], $VALUE, $table, $rid);
			$field_label = $field_aux->bake_field_label($fields_labels, $fields_hints, $i);
			$form_html .= $field_label;
			$form_html .= $field_aux->bake_field();
			if (!empty($field_label)) $form_html .= '</div>';
		}

		return [
			'form' => $form_html,
			'HOOK_JS' => $this->form_js($table),
			'table' => $table,
			'raw' => $raw,
			'op' => '',
			'rid' => $rid,
			'table_label' => $data['table_label'],
		];
	}
}
