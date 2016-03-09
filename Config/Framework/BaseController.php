<?php

class Config_Framework_BaseController extends Config_Framework_App
{
    protected $_model;
    private $_activeRecord = 'ActiveRecord';
    protected $exception;
    /**
     * class constructor
     * loads the controller model and
     * ORM for further transaction
     */
    public function __construct()
    {
        $modelClass = str_replace('Controller', '', get_class($this));
        $this->_model = get_class($this);
        $this->requireDirs()->initORM()->initExceptions();
//        new $modelClass();
    }

    /**
     * Load the currennt view
     * @param type $controller
     * @param type $action
     * @param type $data
     * @return type
     */
    protected function loadView($controller, $action, $data = '')
    {
        return $this->setView($controller, $action, $data);
    }
    
    /**
     * Load the current Model
     * @param type $name
     * @return type
     */
    protected function loadModel($name)
    {
        return $this->getModel($name);
    }
    
    /**
     * Get the ORM configs
     * @return \Config_Framework_BaseController
     */
    protected function requireDirs()
    {
        require $this->getConfigLib() . $this->_activeRecord . DS . 'ActiveRecord' .'.php';        
        return $this;
    }
    
    /**
     * Initalize the ORM
     * @return \Config_Framework_BaseController
     */
    protected function initORM()
    {
        ActiveRecord\Config::initialize(
            function($cfg) {
                $cfg->set_model_directory($this->getClassDir());
                $cfg->set_connections(
                    array(
                        'development' => 'mysql://root:root@127.0.0.1/mvc'
                    )
                );
            }
        );
        
        return $this;
    }
    
    /**
     * Get the class 
     * directory
     * @return type
     */
    protected function getClassDir()
    {
        $reflector = new ReflectionClass($this->_model);
        $fn = $reflector->getFileName();
        return dirname($fn);
    }
    
    /**
     * Get the values from
     * database config
     */
    private function initExceptions()
    {
        $this->exception = new Config_Framework_ErrorHandler(E_ALL);
        $this->exception->LogFile($this->getBaseDir().'/errors/log/error.log');
        $this->exception->DisplayError(true);
        $this->exception->SysLogIdent('ErrorHandler');
        $this->exception->LogToConsole(true);
        $this->exception->DateFormat('d-m-Y H:i:s');
    }
}