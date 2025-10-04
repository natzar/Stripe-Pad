<?php

use StripePad\Exceptions\DatabaseException;

/**
 * SPDO
 */
class SPDO extends PDO
{
	private static $instance = null;

	public function __construct()
	{
		try {
			parent::__construct('mysql:host=' . APP_DB_HOST . ';dbname=' . APP_DB, APP_DB_USER, APP_DB_PASSWORD);
			parent::exec("SET NAMES utf8mb4;");  
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		} catch (\PDOException $e) {
			// Propaga con mensaje propio y conserva la excepción original
			throw new DatabaseException(DatabaseException::CONNECTION_FAILED, 0, $e);
		}
	}

	public static function singleton()
	{
		if (self::$instance == null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function get_error()
	{
		$this->errorInfo();
	}
}
