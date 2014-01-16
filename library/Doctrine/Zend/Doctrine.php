<?php
 
/**
 * Archivo ubicado en library/Doctrine/Zend/Doctrine.php
 */
require_once 'Zend/Application/Resource/ResourceAbstract.php';
require_once 'Doctrine/Common/ClassLoader.php';
require_once "Doctrine/ORM/Tools/Setup.php";
//require_once "Doctrine/Symfony/Component/Yaml/Yaml.php";
 
use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration,
    Doctrine\DBAL\Event\Listeners\MysqlSessionInit;

class Doctrine_Zend_Doctrine
  extends Zend_Application_Resource_ResourceAbstract
{
  public function init()
  {
    $options = $this -> getOptions();
    $classLoader = new \Doctrine\Common\ClassLoader('Doctrine');
    $classLoader -> register();
    // Entities
    $classLoader = new \Doctrine\Common\ClassLoader(
        'Entity',
        APPLICATION_PATH //. DIRECTORY_SEPARATOR . 'Models'    . DIRECTORY_SEPARATOR . 'Entities'
    );
    $classLoader -> register();
	
	
    $classLoader = new \Doctrine\Common\ClassLoader(
        'Proxies',
        APPLICATION_PATH //dirname(APPLICATION_PATH). DIRECTORY_SEPARATOR . 'library'
    );
    $classLoader -> register();
    $classLoader = new \Doctrine\Common\ClassLoader('Symfony', 'Doctrine');
    $classLoader->register();
    
    $config = Doctrine\ORM\Tools\Setup::createYAMLMetadataConfiguration(
        array(
            APPLICATION_PATH . "/modules/web/schema/yaml",
            APPLICATION_PATH . "/modules/cart/schema/yaml",
            ), true);
//    $config = Doctrine\ORM\Tools\Setup::createYAMLMetadataConfiguration(array(APPLICATION_PATH . "/../data/schema/yaml"), true);
    
    if ('development' == APPLICATION_ENV) {
        $cache = new \Doctrine\Common\Cache\ArrayCache();
        $config -> setAutoGenerateProxyClasses(true);
    } else {
        //$cache = new \Doctrine\Common\Cache\ApcCache();
        $cache = new \Doctrine\Common\Cache\ArrayCache();
        $config -> setAutoGenerateProxyClasses(false);
    }
    $config -> setMetadataCacheImpl($cache);
    $config -> setQueryCacheImpl($cache);
    $config -> setProxyDir($options['proxiesPath']);
    $config -> setProxyNamespace('Proxies');

    
/*	
	
    $classLoader = new \Doctrine\Common\ClassLoader(
        'Proxies',
        APPLICATION_PATH //dirname(APPLICATION_PATH). DIRECTORY_SEPARATOR . 'library'
    );
   $classLoader -> register();
   $config = new Configuration();
    if ('development' == APPLICATION_ENV) {
        $cache = new \Doctrine\Common\Cache\ArrayCache();
        $config -> setAutoGenerateProxyClasses(true);
    } else {
        $cache = new \Doctrine\Common\Cache\ArrayCache();
        $config -> setAutoGenerateProxyClasses(false);
    }
   $config -> setMetadataCacheImpl($cache);
   $config -> setQueryCacheImpl($cache);
   $driverImpl = $config -> newDefaultAnnotationDriver($options['entitiesPath']);
   $config -> setMetadataDriverImpl($driverImpl);
   $config -> setProxyDir($options['proxiesPath']);
   $config -> setProxyNamespace('Proxies');
   // $config -> setAutoGenerateProxyClasses(('development' == APPLICATION_PATH));//APPLICATION_ENV
*/
    
	
	

    $em = EntityManager::create(
        $this -> _buildConnectionOptions($options),
        $config
    );
//        $conn = $em->getConnection();
//        $conn->prepare($name_proc);  
    
    // Once we have the EntityManager ready, add it to the registry
   $em->getEventManager()->addEventSubscriber(new  MysqlSessionInit('utf8', 'utf8_unicode_ci') ); 
       
    Zend_Registry::set('em', $em);
    // end
    return $em;
  }
 
  /**
   * A method to build the connection options, for a Doctrine
   * EntityManager/Connection. Sure, we can find a more elegant solution to build
   * the connection options. A builder class could be applied. Sure you can with
   * some refactor!
   * TODO: refactor to build some other, more elegant, solution to build the conn
   * ection object.
   * @param Array $options The options array defined on the application.ini file
   * @return Array
   */
  protected function _buildConnectionOptions($options)
  {
    $connectionSpec = array(
      'pdo_sqlite' => array('user', 'password', 'path', 'memory'),
      'pdo_mysql'  => array(
        'user', 'password', 'host', 'port', 'dbname', 'unix_socket'
      ),
      'pdo_pgsql'  => array('user', 'password', 'host', 'port', 'dbname'),
      'pdo_oci'    => array(
        'user', 'password', 'host', 'port', 'dbname', 'charset'
      ),
      'pdo_sqlsrv'    => array(
        'user', 'password', 'host', 'port', 'dbname', 'charset'
      ),
      'pdo_dblib'    => array(
        'user', 'password', 'host', 'port', 'dbname', 'charset'
      )
      ,'sqlsrv'    => array(
        'user', 'password', 'host', 'port', 'dbname', 'charset'
      )
    );
 
    $connection = array(
      'driver' => $options['connection']['driver']
    );
 
    foreach ($connectionSpec[$options['connection']['driver']] as $driverOption) {
      if (isset($options['connection'][$driverOption]) && !is_null($driverOption)) {
        $connection[$driverOption] = $options['connection'][$driverOption];
      }
    }
 
    if (isset($options['connection']['driverOptions'])
      && !is_null($options['connection']['driverOptions'])) {
      $connection['driverOptions'] = $options['connection']['driverOptions'];
    }
 
    return $connection;
  }
}