<?php

class Template
{
    private $_controller;
    private $_action;


    public function __construct($controller, $action) 
    {
        $this->_controller = $controller;
        $this->_action = $action;
    }
    
    
}
