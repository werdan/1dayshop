<?php
// Define path to application directory
define('BASE_PATH', realpath(dirname(__FILE__) . '/../../'));
define('APPLICATION_PATH', BASE_PATH . '/application');

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../application'),
    realpath(APPLICATION_PATH . '/../library'),
    realpath(APPLICATION_PATH . '/../library/zendframework'),
    realpath(APPLICATION_PATH . '/../library/doctrine'),
    realpath(APPLICATION_PATH . '/../library/onedayshop'),
    get_include_path(),
)));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));


///** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap();
Zend_Registry::set('application',$application);