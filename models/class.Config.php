<?php

class Config {
    
    private static $_instance = null;

    private $_config = '';

    private function __construct() {
        $this->_config = require_once(__DIR__.'/../config/global.config.php');
    }

    public static function getInstance($param = '') {

        if(is_null(self::$_instance)) {
            
            self::$_instance = new Config();  
        }
        
        if(isset($param) && $param != '') {

            return self::$_instance->_config[$param];
        } else {
            
            return self::$_instance->_config;
        }

    }

}

?>