<?php

require_once getcwd() . DS . 'Config' . DS . 'Lib' . DS . 'ActiveRecord' . DS . 'ActiveRecord.php';

class Config_Framework_AppModel 
    extends Config_Framework_Database
{

    protected $_version;
    protected $_dbConn;
    protected $_class;

    public function __construct()
    {
        $this->_class = get_class($this);
        $this->_dbConn = parent::getDbConn();        
    }

    protected function up() 
    {
        print_r(Index::first()->attributes());
    }

    protected function down()
    {
        
    }
    
    protected function getClassDir()
    {
        $reflector = new ReflectionClass($this->_class);
        $fn = $reflector->getFileName();
        return dirname($fn);
    }

}
