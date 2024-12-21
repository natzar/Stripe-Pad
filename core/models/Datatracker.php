<?

// Php Ninja 1.0
// analytics Model
// 02-2021
// Beto Ayesa contacto@phpninja.info

class datatrackerModel extends ModelBase
{
	private static $instance = null;

	public static function singleton()
	{
		if (self::$instance == null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function getThisWeek()
	{
		$c = $this->db->prepare("SELECT q,v FROM datatracker where datatracker.week = YEARWEEK(CURDATE())");
		$c->execute();
		return $this->transform($c->fetchAll());
	}

	private function transform($origin)
	{

		$result = array();
		foreach ($origin as $o) {
			$result[$o['q']] = $o['v'];
		}
		return $result;
	}

	public function get($key, $dateA = null, $dateB = null)
	{
		if (is_null($dateA)) $dateA = Date("Y-m-d");
		if (is_null($dateB)) $dateB = Date("Y-m-d");
		$consulta = $this->db->prepare("SELECT * FROM datatracker where q = :q and created BETWEEN :a AND :b");
		$consulta->bindParam(":q", $key);
		$consulta->bindParam(":a", $dateA);
		$consulta->bindParam(":b", $dateB);
		$consulta->execute();
		$aux2 = $consulta->fetchAll();

		return $aux2;
	}
	public function total($key, $dateA = null, $dateB = null)
	{
		if (is_null($dateA)) $dateA = Date("Y-m-d");
		if (is_null($dateB)) $dateB = Date("Y-m-d");

		$consulta = $this->db->prepare("SELECT sum(v) as total FROM datatracker where q = :q and created BETWEEN :a AND :b");
		$consulta->bindParam(":q", $key);
		$consulta->bindParam(":a", $dateA);
		$consulta->bindParam(":b", $dateB);
		$consulta->execute();
		$aux2 = $consulta->fetch();

		return $aux2['total'];
	}
	public function push($key, $value = 1)
	{
		//	$key = fingerprint($key);
		$consulta = $this->db->prepare("INSERT INTO datatracker (week,q,v) VALUES (YEARWEEK(CURDATE()),:q,:v) ON DUPLICATE KEY UPDATE v=v+:v2");
		$consulta->bindParam(":q", $key);
		$consulta->bindParam(":v", $value);
		$consulta->bindParam(":v2", $value);
		$consulta->execute();

		$url = 'https://api.counterify.com/counter';

		$params = array(
			'label' => $key,
			'count' => $value
		);

		$headers = array(
			'Authorization: Bearer ' . COUNTERIFY_TOKEN,
			'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1000);
		curl_exec($ch);
		curl_close($ch);
	}
}
