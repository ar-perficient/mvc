<?php

include getcwd()."/config/Lib/NotORM.php";
class Config_Framework_AppModel extends Config_Framework_Database
{

    protected $_version;
    
    protected $_dbConn;
    
    protected $_class;

    public function __construct() 
    {
        $this->_class = get_class($this);
        $this->_dbConn = parent::getDbConn();
        $this->up();
    }

    protected function up()
    {   
        $software = new NotORM($this->_dbConn);

        foreach ($software->indexmodel()->order("name") as $application) {
            echo "$application[name]\n";
        }
    }
    
    protected function down()
    {
        
    }
}