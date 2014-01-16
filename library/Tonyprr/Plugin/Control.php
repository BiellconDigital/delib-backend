<?php
/*
 * @autor Antonio Ramos
 * 
 * Plugin para gestión de acceso por sesiones por cada módulo de la aplicación
 */
class Tonyprr_Plugin_Control extends Zend_Controller_Plugin_Abstract
{

    public function routeStartup(Zend_Controller_Request_Abstract $request) {
        $authSesion = new Zend_Session_Namespace(SES_USER);
        $em = \Zend_Registry::get('em');
        $authSesion->oLanguage = $em->getRepository("web\Entity\CmsLanguage")->findOneBynombreCorto($authSesion->idioma);
    }
    
    public function dispatchLoopShutdown()
    {
        $authSesion = new Zend_Session_Namespace(SES_USER);
        if(!$this->_request->isXmlHttpRequest()) {
            $authSesion->lastModule = $this->getRequest()->getModuleName();
            $authSesion->lastController = $this->getRequest()->getControllerName();
            $authSesion->lastAction = $this->getRequest()->getActionName();
            $authSesion->lastUrl = $this->getRequest()->getRequestUri();//$this->getRequest()->getUserParams();
//            Zend_Controller_Front::getInstance()->getRouter()->getCurrentRouteName();
//            Zend_Controller_Front::getInstance()->getBaseUrl();
        }
//        $authSesion = new Zend_Session_Namespace(SES_USER);
        
    }
	
}
?>