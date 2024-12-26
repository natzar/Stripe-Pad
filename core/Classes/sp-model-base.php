<?php

/**
 * ModelBase
 */
abstract class ModelBase
{
	public $db;
	public $model;

	public function __construct()
	{
		$this->db = SPDO::singleton();
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
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
}
