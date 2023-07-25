<?php
class Config
{
    private $vars;
    private static $instance;
 
    private function __construct()
    {
        $this->vars = array();
    }
 
 
    public function set($name, $value)
    {
        if(!isset($this->vars[$name]))
        {
            $this->vars[$name] = $value;
        }else{
	        $this->vars[$name] = $value;
        }
        
    }
 
    public function get($name)
    {
        if(isset($this->vars[$name]))
        {
            return $this->vars[$name];
        }
    }
 
    public static function singleton()
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
 
        return self::$instance;
    }
    public function print_vars(){
        return $this->vars;
    }
}
