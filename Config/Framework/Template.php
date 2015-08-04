<?php

class Config_Framework_Template extends Config_Framework_App
{
    private $_controller;
    
    private $_action;
    
    private $_output = '';

    private $_templateData = array();
    
    private $_values = array();
    
    const EXT = '.ash';

    public function __construct($controller, $action, $templateData = '') 
    {
        $this->_controller = $controller;
        $this->_action = $action;
        
        $this->_templateData = $templateData;
        
        parent::__construct();
    }
    
    public function render()
    {
        $this->renderHeader();
        $this->renderContent();
        $this->renderFooter();
        $this->_output();        
    }
    
    public function __call($name, $arguments) 
    {
        switch (substr($name, 0, 3)) {
            case 'get' :
                $data = $this->get(substr($name, 3));
                return $data;
            case 'set' :
                $this->set(substr($name, 3), $arguments[0]);
                break;
        }
    }
    
    public function set($key, $value) 
    {
        $this->_values[$key] = $value;
        //Config_Framework_App::register($key, $value);
    }
 
   public function get($key)
   {
       //return Config_Framework_App::registry($key);
   }
   
   protected function renderHeader()
   {
       if (file_exists($this->getDirectoryPath('Views') . 'layout' . DS . 'header'. self::EXT)) {
            $this->setHeaderParam();
            $this->_output .= $this->_parseTemplate(
                file_get_contents(
                    $this->getDirectoryPath('Views') 
                    . 'layout' . DS 
                    . 'header'.self::EXT
                )
            );
       }
       
       return $this->_output;
   }
   
   protected function renderFooter()
   {
       if (file_exists($this->getDirectoryPath('Views') . 'layout' . DS . 'footer'. self::EXT)) {
            $this->setHeaderParam();
            $this->_output .= $this->_parseTemplate(
                file_get_contents(
                    $this->getDirectoryPath('Views') 
                    . 'layout' . DS 
                    . 'footer'.self::EXT
                )
            );
       }
       
       return $this->_output;
   }
   
   protected function renderContent()
   {
       if (file_exists($this->getDirectoryPath('Views') . $this->_controller . DS . $this->_action . self::EXT)) {
            $this->setHeaderParam();
            $this->_output .= $this->_parseTemplate(
                file_get_contents(
                    $this->getDirectoryPath('Views') 
                    . $this->_controller . DS 
                    . $this->_action.self::EXT
                )
            );
       }
       
       return $this->_output;
   }
   
   protected function _parseTemplate($html)
   {
       $output = $html;
       
       foreach ($this->_values as $key => $value) {
           $tagToReplace = "{".$key."}";
           $output = str_replace($tagToReplace, $value, $output);
       }
       
       return $output;
   }
   
   protected function _output()
   {
       echo $this->_output;
   }
   
   protected function setHeaderParam()
   {
       $this->set('base_url', $this->getBaseUrl());
       $this->set('style_dir', $this->getCssPath());
   }
}
