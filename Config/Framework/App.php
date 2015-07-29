<?php

class Config_Framework_App
{
    protected $_data;
    
    static private $_registry  = array();
    static protected $_instance;
    
    public function __construct() 
    {
        $this->_loadDir();
    }

    public function run()
    {
        spl_autoload_extensions('.php, .class.php, .lib.php');
        spl_autoload_register(array(self::instance(), '_autoload'));
       
        $con = Config_Framework_Database::getDbConn();
        
        
        new Config_Framework_Route($_GET);
    }

    static public function instance()
    {
        if (!self::$_instance) {
            self::$_instance = new Config_Framework_App();
        }
        return self::$_instance;
    }
    
    public function getModel($class)
    {
        $className = ucwords($class). 'Model.php';
        $class = ucwords($class).'Model';
        
        if (file_exists($this->getMediaDir() . $className)) {
            return new $class;
        } 
    }
    
    public function getView($controller, $action, $data = '')
    {   
       return new Config_Framework_Template($controller, $action, $data);        
    }
    
    public function getDirectoryPath($name)
    {
        $name = ucwords($name);
        
        switch ($name)
        {
            case 'Controllers':
                return $this->getControllersDir();
                break;
            
            case 'Models':
                return $this->getModelDir();
                break;
            
            case 'Views':
                return $this->getViewDir();
                break;
            
            case 'Appconfig':
                return $this->getAppDir() . DS . 'Config'. DS;
                break;
        }
        
        throw new Exception('Directory not found');
    }
    
    public function _autoload($class)
    {       
        if (file_exists($this->getControllersDir() . $class . '.php')) {
            return include_once $this->getControllersDir() . $class . '.php'; 
        } else if (file_exists($this->getConfigDir() . $class . '.php')) {
            return include_once $this->getConfigDir() . $class . '.php';
        } else if (file_exists($this->getModelDir() . ucwords($class). '.php')) {
            return include_once $this->getModelDir() . ucwords($class). '.php';
        } else {
            $class = str_replace('_', '/', ucwords($class));
            return include_once $class.'.php';
        }
        
    }
    
    protected function _loadDir()
    {
        $appRoot = ROOT . DS . 'app';
        $root = ROOT;
                
        $this->_data['app_dir']         = $appRoot;
        $this->_data['base_dir']        = $root;
        $this->_data['conf_dir']        = $root . DS . 'Config' . DS;
        $this->_data['controller_dir']  = $appRoot . DS . 'Controllers' . DS;
        $this->_data['model_dir']       = $appRoot . DS . 'Models' . DS;
        $this->_data['view_dir']        = $appRoot . DS . 'Views' . DS;
        $this->_data['lib_dir']         = $root . DS . 'lib' . DS;
        $this->_data['media_dir']       = $root . DS . 'public' . DS;       
        $this->_data['css_dir']         = $this->getBaseUrl() . 'public' . US . 'css' . US;       
        $this->_data['js_dir']          = $this->getBaseUrl() . 'public' . US . 'js' . US;       
        $this->_data['image_dir']       = $this->getBaseUrl() . 'public' . US . 'images' . US;       
        $this->_data['install_dir']     = $this->getBaseUrl() . 'public' . US . 'install' . US;       
    }
    
    public function getAppDir()
    {
        return $this->_data['app_dir'];
    }

    public function getBaseDir()
    {
        return $this->_data['base_dir'];
    }
    
    public function getConfigDir()
    {
        return $this->_data['conf_dir'];
    }
    
    public function getControllersDir()
    {
        return $this->_data['controller_dir'];
    }
    
    public function getModelDir()
    {
        return $this->_data['model_dir'];
    }
    
    public function getViewDir()
    {
        return $this->_data['view_dir'];
    }
    
    public function getMediaDir()
    {
        return $this->_data['media_dir'];
    }
    
    public function getLibDir()
    {
        return $this->_data['lib_dir'];
    }
    
    public function getCssPath()
    {
        return $this->_data['css_dir'];
    }
    
    public function getJsPath()
    {
        return $this->_data['js_dir'];
    }
    
    public function getImagesPath()
    {
        return $this->_data['image_dir'];
    }
    
    public function getInstallPath()
    {
        return $this->_data['install_dir'];
    }

    public static function register($key, $value, $graceful = false)
    {
        if (isset(self::$_registry[$key])) {
            if ($graceful) {
                return;
            }
        }
        self::$_registry[$key] = $value;
    }
    
    public static function registry($key)
    {
        if (isset(self::$_registry[$key])) {
            return self::$_registry[$key];
        }
        return null;
    }
    
    public function url()
    {
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        } else {
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
    
    protected function _redirect($url, $isPermanent = false)
    {
        if ($isPermanent) {
            header('HTTP/1.1 301 Moved Permanently');
        }

        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Pragma: no-cache');
        header('Location: ' . $url);
        exit;
    }
    
    public function getBaseUrl() 
    {
        $currentPath = $_SERVER['PHP_SELF']; 

        $pathInfo = pathinfo($currentPath); 

        $hostName = $_SERVER['HTTP_HOST']; 

        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5)) == 'https://'?'https://':'http://';

        $pro = explode('/', $pathInfo['dirname']);
        
        return $protocol.$hostName."/".$pro[1]."/";
//        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
    
}