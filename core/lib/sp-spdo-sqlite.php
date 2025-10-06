<?php

use StripePad\Exceptions\DatabaseException;

/**
 * SPDO for SQLite
 */
class SPDO_sqlite extends PDO
{
    private static $instance = null;

    public function __construct()
    {
        try {
            // Ruta absoluta al archivo SQLite
            $dsn = 'sqlite:' . ROOT_PATH . 'storage/database.sqlite';
            parent::__construct($dsn);

            // Opciones comunes
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // Activar claves foráneas en SQLite (por defecto están desactivadas)
            $this->exec('PRAGMA foreign_keys = ON;');
            // Create NOW() returning UTC like MySQL's default timezone can vary
            $this->sqliteCreateFunction('NOW', function () {
                return (new DateTime('now', new DateTimeZone('UTC')))->format('Y-m-d H:i:s');
            }, 0);
        } catch (\PDOException $e) {
            throw new DatabaseException(DatabaseException::CONNECTION_FAILED, 0, $e);
        }
    }



    public static function singleton()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get_error()
    {
        return $this->errorInfo();
    }
}
