<?php

class Loader
{
    private $_controllerName;
    private $_actionName;
    private $_queryString;

    public function __construct($request) 
    {
        $url = explode('/', $request['url']);
                
        if (empty($url)) {
            $this->_controllerName = 'IndexController';
            $this->_actionName = 'IndexAction';
        } elseif (isset($url[0])) {
            $controller = $url[0];
            if (isset($url[1]) && !empty($url[1])) {
                $this->_actionName = $url[1];
            } else {
                $this->_actionName = 'IndexAction';
            }
        }
        
        $this->_queryString = array();
        
        $this->_controllerName = ucwords($controller).'Controller';
        
        $controller = new $this->_controllerName;
        if (method_exists($controller, $this->_actionName)) {
            call_user_func_array(array($controller, $this->_actionName), $this->_queryString);
        } else {
            
        }
    }
}