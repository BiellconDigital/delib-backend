<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));//development production
define('DS', DIRECTORY_SEPARATOR);
define('BP', dirname(dirname(__FILE__)));
define('PTH_FILES',BP . DS . 'web' . DS . 'm_web' . DS . 'files');
define('PTH_FILES_CART',BP . DS . 'web' . DS . 'm_cart' . DS . 'files');
define('PTH_PUBLIC',BP . DS . 'web' );
define('DIR_WEB','http://localhost/delib-frontend' . '/' . 'app/' );//$_SERVER['SERVER_NAME']
define('WEB_DOMAIN','http://localhost' );//$_SERVER['SERVER_NAME']

// Ensure library/ is on include_pathm
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
//    realpath(APPLICATION_PATH . '/../library/Vendors/Excel'),
    realpath(APPLICATION_PATH . DS . 'modules'),
    realpath(APPLICATION_PATH . '/../../libs'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();