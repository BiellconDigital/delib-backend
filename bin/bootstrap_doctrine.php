<?php
// bootstrap_doctrine.php

// See :doc:`Configuration <../reference/configuration>` for up to date autoloading details.
use Doctrine\ORM\Tools\Setup;
require_once 'Doctrine/Common/ClassLoader.php';

require_once "Doctrine/ORM/Tools/Setup.php";
Setup::registerAutoloadPEAR();

    //set_include_path(implode(PATH_SEPARATOR, array(
    //    realpath(APPLICATION_PATH . DS . 'Models'),
    //    get_include_path(),
    //)));
//    set_include_path(get_include_path().PATH_SEPARATOR.realpath(APPLICATION_PATH . DS . 'Entity'));
    set_include_path(get_include_path().PATH_SEPARATOR.realpath(APPLICATION_PATH . DS . 'modules'));
    //echo get_include_path() . ' -- ';
    function autoload($className)
    {
        require($className . '.php');
    }
    spl_autoload_extensions('.php');
    spl_autoload_register('autoload');

    $classLoader = new \Doctrine\Common\ClassLoader(
        'web\Entity',
        APPLICATION_PATH . DS . "modules" //. DIRECTORY_SEPARATOR . 'Models'    . DIRECTORY_SEPARATOR . 'Entities'
    );
    $classLoader -> register();

    
    

// Create a simple "default" Doctrine ORM configuration for XML Mapping
$isDevMode = true;
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/../data/schema/xml"), $isDevMode);
// or if you prefer yaml or annotations
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/entities"), $isDevMode);
//realpath(dirname(__FILE__) . '/../application')
$config = Setup::createYAMLMetadataConfiguration(
        array(
            __DIR__."/../application/modules/web/schema/yaml",
            __DIR__."/../application/modules/cart/schema/yaml",
            ), $isDevMode);

//$config->setProxyDir(__DIR__."/../application/modules/web/schema/yaml");
$config->setProxyNamespace('Proxies');

//$config->
//$namespaces = array(
//    'MyProject\Entities' => '/path/to/files1',
//    'OtherProject\Entities' => '/path/to/files2'
//);
//$driver = new \Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver($namespaces);

//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/../data/schema/yaml"), $isDevMode);



//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/../data/schema/yaml"), $isDevMode);

// database configuration parameters
    $conn = array(
        'driver'    => 'pdo_mysql',
        'user'      => 'root',
        'password'  => '',
        'dbname'    => 'wiltons',
        'host'      => 'localhost'
    );

//    $conn = array(
//        'driver'    => 'pdo_sqlsrv',
//        'user'      => 'sa',
//        'password'  => 'super2',
//        'dbname'    => 'bd_mpf',
//        'host'      => 'ANTONIO-PC\SQLEXPRESS'
//    );

// obtaining the entity manager
$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);