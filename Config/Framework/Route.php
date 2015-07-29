<?php

class Config_Framework_Route
{
    private $_controllerName;
    private $_actionName;
    private $_queryString;
    
    private $_errorController = 'ErrorController';
    private $_errorAction = 'errorAction';

    
    public function __construct($request) 
    {
        if (empty($request)) {
            $this->_controllerName = 'Index';
            $this->_actionName = 'IndexAction';
        } else {
            $url = explode('/', $request['url']);
            if (isset($url[0])) {
                $this->_controllerName = $url[0];
            } else {
                $this->_controllerName = 'Index';
            }
            
            if (isset($url[1]) && !empty($url[1])) {
                $this->_actionName = $url[1].'Action';
            } else {
                $this->_actionName = 'IndexAction';
            }
        }
        
        $this->_queryString = array();
        
        $this->_controllerName = ucwords($this->_controllerName).'Controller';
        
        $controllerFile = ROOT 
                . DS . 'app' . DS . 'Controllers' 
                . DS . $this->_controllerName . '.php';
        
        if (file_exists($controllerFile)) {
            $controller = new $this->_controllerName;
            if (method_exists($controller, $this->_actionName)) {
                call_user_func_array(
                    array(
                    $controller, 
                    $this->_actionName), 
                    $this->_queryString
                );
            } else {
                call_user_func_array(
                    array(
                    $this->_errorController, 
                    $this->_errorAction), 
                    array( 
                        0 => '404 not found')
                );
            }
        } else {
            call_user_func_array(
                array(
                $this->_errorController, 
                $this->_errorAction), 
                array( 
                    0 => '404 not found')
            );
        }
    }
}