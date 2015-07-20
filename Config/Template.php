<?php

class Template
{
    private $_controller;
    private $_action;

    private $_data = array();

    public function __construct($controller, $action, $data = '') 
    {
        $this->_controller = $controller;
        $this->_action = $action;
        
        $this->_data = $data;
    }
    
    public function render()
    {
        if (file_exists(ROOT . DS . 'app' . DS . 'Views' . DS . 'layout' . DS . 'header.php')) {
                include (ROOT . DS . 'app' . DS . 'views' . DS . 'layout' . DS . 'header.php');
        } else {
            include (ROOT . DS . 'app' . DS . 'Views' . DS . 'header.php');
        }

        include (ROOT . DS . 'app' . DS . 'Views' . DS . $this->_controller . DS . $this->_action . '.php');       

        if (file_exists(ROOT . DS . 'app' . DS . 'Views' . DS . 'layout' . DS . 'footer.php')) {
            include (ROOT . DS . 'app' . DS . 'views' . DS . 'layout' . DS . 'footer.php');
        } else {
            include (ROOT . DS . 'app' . DS . 'Views' . DS . 'footer.php');
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
        if (!isset($this->registry[$key])) {
          $this->registry[$key] = $value;
        }
    }
 
   public function get($key)
   {
        if (isset($this->registry[$key])) {
            return $this->registry[$key];
        }
        
        return null;
   }
}
