<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initConfigView() {
//        $_SERVER['TEMP'] =  realpath(dirname(__FILE__) . '/Proxies');
        define("SES_ADMIN", "wiltons_admin");
        define("SES_USER", "wiltons_user");
        define("SES_CART", "wiltons_cart");
        //http://rmf.fciencias.unam.mx/~paris/zend/zend-acl-y-zend-auth/
        //http://otroblogmas.com/zend_acl-autorizacion-y-permisos-en-zend-framework/
        
        $view = new Zend_View();
//        $view->headMeta()->appendHttpEquiv('Cache-Control', 'no-cache');
        $view->headTitle()->setSeparator(' - ');
        $view->headTitle(utf8_encode('Wiltons'));
        Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);

        // toma los valores de Zend_Auth, aun no vemos esto no desesperes
        $auth = Zend_Auth::getInstance();

        // inicia nuestra lista de control de accesos
        $acl = new Tonyprr_Plugin_Acl();
        
        // setup FrontController
        $front = Zend_Controller_Front::getInstance();
//        $front->registerPlugin(new Tonyprr_Plugin_Access());
        $front->registerPlugin(new Tonyprr_Plugin_Authorization($auth, $acl));
        $front->registerPlugin(new Tonyprr_Plugin_Control());
        Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);
//        Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(false);
        $front->throwExceptions(true);
        
//        $db = Zend_Db::factory($this->_config->db);
//        $db->query("SET NAMES 'utf8'");
//        $db->query("set time_zone = 'America/Lima'");

    } 
    
    protected function _initTimeZone() {
        date_default_timezone_set('America/Lima');
    }
    
    protected function _initLanguage() {
        $authSesion = new Zend_Session_Namespace(SES_USER);
        if(!isset($authSesion->idioma)) {
            $locale = new Zend_Locale(Zend_Locale::BROWSER);
            if (!in_array($locale->getLanguage(), array("es","en"))) {
                $authSesion->idioma = "es";
                $locale->setLocale($authSesion->idioma);
            } else {
                $authSesion->idioma = $locale->getLanguage();
            }
        } else {
            $locale = new Zend_Locale($authSesion->idioma);
//            $locale = new Zend_Locale(Zend_Locale::BROWSER);
        }
        
//        echo $locale->getLanguage();
        
        $translate = new Zend_Translate(
            'array',
            APPLICATION_PATH . '/configs/languages/',
            null,
            array('scan' => Zend_Translate::LOCALE_DIRECTORY)
        );

        // setting the right locale
        if ($translate->isAvailable($locale->getLanguage())) {
            $translate->setLocale($locale);
        } else {
            $translate->setLocale('es');
        }
        
//        echo $translate->getAdapter()->translate("header_prueba");
        
        Zend_Registry::set('Zend_Translate', $translate);
    }    

    protected function _initRouters() 
    { 
        $fronController  = Zend_Controller_Front::getInstance();  
        $router = $fronController->getRouter(); 
         
//        $router->addRoute('web',
//                new Zend_Controller_Router_Route('/:url', array( 
//                    'url'=>':url', 
//                    'module'    => 'web', 
//                    'controller' => 'index', 
//                    'action' => 'index'                 
//                    )) 
//                ); 
//        $router->addRoute('cart',
//                new Zend_Controller_Router_Route('/cart', array( 
//                    'url'=>':url', 
//                    'module'    => 'cart', 
//                    'controller' => 'index', 
//                    'action' => 'index'                 
//                    )) 
//                ); 
        
        
        $route = new Zend_Controller_Router_Route( 
            'cart/:controller/:action/*', 
        array( 
            'module' => 'cart' , 'controller' => 'index', 'action' => 'index' 
            ) 
        ); 
        $router->addRoute('cart', $route); 
        
        
    }
}

