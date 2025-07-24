<?php

class CountersModel extends ModelBase
{
	private string $tenantType;
	private int $tenantId;
	var $table = 'counters';

	public function __construct(string $tenantType, int $tenantId)
	{
		parent::__construct($this->table);
		$this->tenantType = $tenantType;
		$this->tenantId = $tenantId;
	}

	private function scopeSql(): string
	{
		return "tenant_type = :tenant_type AND tenant_id = :tenant_id";
	}

	private function bindScope($stmt)
	{
		$stmt->bindParam(':tenant_type', $this->tenantType);
		$stmt->bindParam(':tenant_id', $this->tenantId);
	}

	public function all(): array
	{
		$q = $this->db->prepare("SELECT * FROM counters WHERE " . $this->scopeSql());
		$this->bindScope($q);
		$q->execute();
		return $q->fetchAll();
	}

	public function findIdByLabel(string $label): int
	{

		$q = $this->db->prepare(
			"
			SELECT countersId FROM counters 
			WHERE label = :label AND " . $this->scopeSql() . " LIMIT 1"
		);
		$q->bindParam(":label", $label);
		$this->bindScope($q);
		$q->execute();
		$row = $q->fetch();

		if (is_null($row) or empty($row)) {
			$counter = $this->create($label);
			return $counter['countersId'];
		}

		return $row['countersId'] ?? -1;
	}

	public function get(string $label): ?array
	{
		$countersId = $this->findIdByLabel($label);

		$q = $this->db->prepare("SELECT * FROM counters WHERE countersId = :id AND " . $this->scopeSql());
		$q->bindParam(":id", $countersId);
		$this->bindScope($q);
		$q->execute();
		return $q->fetch() ?: null;
	}

	public function create(string $label): array
	{
		$hash = $this->generateHash($label);

		$q = $this->db->prepare("
			INSERT INTO counters (tenant_type, tenant_id, label, hash)
			VALUES (:tenant_type, :tenant_id, :label, :hash)
		");
		$q->bindParam(':label', $label);
		$q->bindParam(':hash', $hash);
		$this->bindScope($q);
		$q->execute();

		return $this->db->query("SELECT * FROM counters WHERE countersId = LAST_INSERT_ID()")->fetch();
	}

	public function update(int $id, string $label, int $addToCount = 0): ?array
	{
		$q = $this->db->prepare(
			"
			UPDATE counters SET label = :label WHERE countersId = :id AND " . $this->scopeSql()
		);
		$q->bindParam(":label", $label);
		$q->bindParam(":id", $id);
		$this->bindScope($q);
		$q->execute();

		if ($addToCount > 0) {
			$this->count($id, $addToCount);
		}

		return $this->get($id);
	}

	public function delete(int $id): void
	{
		$q = $this->db->prepare("DELETE FROM counters WHERE countersId = :id AND " . $this->scopeSql());
		$q->bindParam(":id", $id);
		$this->bindScope($q);
		$q->execute();

		$q = $this->db->prepare("DELETE FROM counters_data WHERE countersId = :id AND " . $this->scopeSql());
		$q->bindParam(":id", $id);
		$this->bindScope($q);
		$q->execute();
	}

	public function count($label, int $value): bool
	{
		// Buscar el contador (lo crea si no existe)
		$countersId = $this->findIdByLabel($label);
		// Suma al total
		$this->db->prepare("UPDATE counters SET total = total + :value WHERE countersId = :id")
			->execute([':value' => $value, ':id' => $countersId]);

		// Registrar en counters_data
		$week = date('oW');       // Semana ISO: 202407
		$month = date('Ym');      // Año y mes: 202407


		$q = $this->db->prepare("
			INSERT INTO counters_data (
				countersId,  week, month, counter
			) VALUES (
				:id, :week, :month, :counter
			)
		");

		$q->execute([
			':id' => $countersId,

			':week' => $week,
			':month' => $month,
			':counter' => $value
		]);

		return true;
	}

	public function getByPeriod(int $id, string $period): int
	{
		$field = match ($period) {
			'month' => 'month = :value',
			'week'  => 'week = :value',
			'year'  => 'LEFT(month,4) = :value',
			default => '1=0'
		};

		$value = match ($period) {
			'month' => date('Ym'),
			'week'  => date('oW'),
			'year'  => date('Y'),
			default => null
		};

		$q = $this->db->prepare(
			"
			SELECT SUM(counter) AS total FROM counters_data 
			WHERE countersId = :id AND $field AND " . $this->scopeSql()
		);

		$q->bindParam(':id', $id);
		$q->bindParam(':value', $value);
		$this->bindScope($q);
		$q->execute();

		return intval($q->fetch()['total']);
	}

	public function getHistory(int $id, string $period): array
	{
		$field = match ($period) {
			'month' => 'month',
			'week'  => 'week',
			'year'  => 'LEFT(month,4)',
			default => null
		};

		if (!$field) {
			throw new Exception("Invalid period for history");
		}

		$q = $this->db->prepare("
			SELECT $field AS period, SUM(counter) AS total
			FROM counters_data
			WHERE countersId = :id AND " . $this->scopeSql() . "
			GROUP BY period ORDER BY period DESC
		");
		$q->bindParam(':id', $id);
		$this->bindScope($q);
		$q->execute();

		return $q->fetchAll();
	}

	private function generateHash(string $label): string
	{
		$label = strtolower(preg_replace('/[^a-z0-9 ]/i', '', $label));
		$words = array_unique(explode(' ', $label));
		sort($words);
		return implode('-', $words);
	}
}
