<?php

class Framework_Model
{
    private static $_instance;
    
    private $_host;
    
    private $_userName;
    
    private $_password = '';
    
    private $_databaseName;
    
    private $_appPath;
    
    private $_dbConn;


    public function __construct() 
    {
        $this->controller()->view()->clearSession();
    }
    
    public function controller()
    {
        return Framework_Controller::singleton();
    }
    
    public static function singleton()
    {
        if (!self::$_instance) {
            self::$_instance = new self;
        }
        
        return self::$_instance;
    }

    public static function setConfig($confFile)
    {
        $db = self::singleton();
        $db->setPostConfig();
        
        try{
            $db->_dbConn = new PDO(
                "mysql:host="
                .$db->_host.";dbname="
                .$db->_databaseName."", ""
                .$db->_userName."", ""
                .$db->_password.""
            );    
            
            $configData = array(
                'defaultsetup' => array(
                    'connection' => array(
                        "host" => $db->_host,
                        "username" => $db->_userName,
                        "password" => $db->_password,
                        "dbname" => $db->_databaseName,
                        "initStatements" => "SET NAMES utf8",
                        "model" => "mysql4",
                        "type" => "pdo_mysql",
                        "active" => "1"
                    )
                )
            );
            
            file_put_contents($confFile, json_encode($configData));
            $db->controller()->view()->setSessionMessage('success', 'Database connection establish');
            $db->controller()->view()->clearSession();
            $db->controller()->_redirect($db->_appPath);
        } catch (Exception $ex) {
            $db->controller()->view()->setSessionMessage('error', $ex->getMessage());
            $db->controller()->_redirect($db->controller()->getBaseUrl());
        }
    }
    
    public function setPostConfig()
    { 
        $p = filter_input(INPUT_POST, 'appConfig', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        
        $this->_host = $p['host'];
        $this->_userName = $p['username'];
        $this->_password = $p['dbpass'];
        $this->_databaseName = $p['dbname'];
        
        $this->_appPath = $p['appPath'];
    }
}
