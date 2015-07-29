<?php

class Config_Framework_Database extends Config_Framework_App
{
    const DB_CONNECT_FILE = 'database.json';

    private static $_selfinstance;
    
    private $_dbConn, $_hostName, $_database, $_userName, $_password;

    /**
     *
     * @return DbConn
     */
    private static function getInstance()
    {
        if (self::$_selfinstance == null) {
            $className = __CLASS__;
            self::$_selfinstance = new $className;
        }

        return self::$_selfinstance;
    }

    /**
     *
     * @return DbConn
     */
    private static function initConnection()
    {
        $db = self::getInstance();
        $db->getConfigData();
        
        try{
            $db->_dbConn = new PDO(
                "mysql:host="
                .$db->_hostName.";dbname="
                .$db->_database."", ""
                .$db->_userName."", ""
                .$db->_password.""
            );            
        } catch (Exception $ex) {
            Config_Framework_App::register('ErrorMessage', $ex->getMessage());
        }
        
        return $db;
    }

    /**
     * @return mysqli
     */
    public static function getDbConn()
    {
        try {
            $db = self::initConnection();
            return $db->_dbConn;
        } catch (Exception $ex) {
            Config_Framework_App::register('ErrorMessage', $ex->getMessage());
            return null;
        }
    }
    
    private function getConfigData()
    {
        if(!file_exists($this->getDirectoryPath('appconfig').  self::DB_CONNECT_FILE)){
            $this->_redirect('install');
        }
        
        $connect = file_get_contents(
            $this->getDirectoryPath('appconfig')
            . self::DB_CONNECT_FILE
        );
        
        $this->setDatabaseParams(json_decode($connect));
    }
    
    private function setDatabaseParams($connectParam)
    {
        $this->_hostName = $connectParam->defaultsetup->connection->host;
        $this->_userName = $connectParam->defaultsetup->connection->username;
        $this->_password = $connectParam->defaultsetup->connection->password;
        $this->_database = $connectParam->defaultsetup->connection->dbname;
    }
}