<?php
/*
 * @autor Antonio Ramos
 * 
 * Plugin para gestión de acceso por sesiones por cada módulo de la aplicación
 */
class Tonyprr_Plugin_Access extends Zend_Controller_Plugin_Abstract
{
    public function dispatchLoopShutdown()
    {
    	if($this->getRequest()->getModuleName() == 'admin' 
                and $this->getRequest()->getControllerName() != 'login'
                and $this->getRequest()->getActionName() != 'access'
           ) {
            $session_apli = new Zend_Session_Namespace ( SES_ADMIN );
            if(empty($session_apli->userId)) {
                $this->_response->setRedirect('admin/login');
            }
    	}
        
    	if($this->getRequest()->getModuleName() == 'web' 
                and $this->getRequest()->getControllerName() != 'login'
                and $this->getRequest()->getActionName() != 'access'
           ) {
//            $session_apli = new Zend_Session_Namespace ( SES_ADMIN );
//            if(empty($session_apli->userId)) {
//                $this->_response->setRedirect('admin/login');
//            }
    	}
    }
	
}
?>