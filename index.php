<?php

/*** error reporting on ***/
 error_reporting(E_ALL);
 
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', getcwd());
 
require_once (ROOT . DS . 'Config' . DS . 'bootstrap.php');