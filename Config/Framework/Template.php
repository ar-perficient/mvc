<?php

class Config_Framework_Template extends Config_Framework_App
{
    private $_controller;
    private $_action;
    
    private $_templateData = array();

    public function __construct($controller, $action, $templateData = '') 
    {
        $this->_controller = $controller;
        $this->_action = $action;
        
        $this->_templateData = $templateData;
        
        parent::__construct();
    }
    
    public function render()
    {
        if (file_exists($this->getDirectoryPath('Views') . 'layout' . DS . 'header.php')) {
                include ($this->getDirectoryPath('Views') . 'layout' . DS . 'header.php');
        } else {
            include ($this->getDirectoryPath('Views') . 'header.php');
        }

        if (file_exists($this->getDirectoryPath('Views') . $this->_controller . DS . $this->_action . '.php')) {
            include ($this->getDirectoryPath('Views') . $this->_controller . DS . $this->_action . '.php');
        } else {
            $this->set('ErrorMessage', 'Template file not found');
            include ($this->getDirectoryPath('Views') . 'error' . DS . '404' . '.php');
        }
        
        

        if (file_exists($this->getDirectoryPath('Views') . 'layout' . DS . 'footer.php')) {
            include ($this->getDirectoryPath('Views') . 'layout' . DS . 'footer.php');
        } else {
            include ($this->getDirectoryPath('Views') . 'footer.php');
        }
    }
    
    public function __call($name, $arguments) 
    {
        switch (substr($name, 0, 3)) {
            case 'get' :
                $data = $this->get(substr($name, 3));
                return $data;
                break;
            case 'set' :
                $this->set(substr($name, 3), $arguments[0]);
                break;
        }
    }
    
    public function set($key, $value) 
    {
        Config_Framework_App::register($key, $value);
    }
 
   public function get($key)
   {
       return Config_Framework_App::registry($key);
   }
}
