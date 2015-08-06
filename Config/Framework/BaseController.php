<?php

class Config_Framework_BaseController extends Config_Framework_App
{
    protected $_model;

    public function __construct()
    {
        $modelClass = str_replace('Controller', 'Model', get_class($this));
        $this->_model = new $modelClass();
    }

    protected function loadView($controller, $action, $data = '')
    {
        return $this->getView($controller, $action, $data);
    }
    
    protected function loadModel($name)
    {
        return $this->getModel($name);
    }
    
    protected function loadPlugin($name)
    {
        echo 'hi there';
    }
    
    protected function loadHelper($name)
    {
        echo 'hi there';
    }
    
    protected function redirect($location)
    {
        echo 'hi there';
    }
    
    protected function setTemplate($templateFile, $data = '')
    {
        
    }
}