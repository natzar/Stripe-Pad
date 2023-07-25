<?php
class SPDO extends PDO
{
	private static $instance = null;
 
	public function __construct()
	{
		$config = Config::singleton();
		
		
		try  
            {  
                parent::__construct('mysql:host=' . $config->get('dbhost') . ';dbname=' . $config->get('dbname'),$config->get('dbuser'), $config->get('dbpass'));
		parent::exec("SET NAMES utf8mb4;");//$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
		 $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } 
            catch (PDOException $e)  
            { 

                echo("Error: ".$e->getMessage()); 
header("location: ".$config->get('base_url')."errors/mysql");
                die();
            } 
	}
/*
	public function execute(){
		parent::execute();
		echo $args;
	}
*/
	public static function singleton()
	{
		if( self::$instance == null )
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

     public function get_error()  
        { 
            $this->errorInfo(); 
        } 
}
?>