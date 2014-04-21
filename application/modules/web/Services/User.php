<?php

namespace web\Services;

/**
 * Description of User
 *
 * @author aramosr
 */
class User {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "web\Entity\CmsUser";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @param string $usuario
     * @param string $clave
     * @return \web\Entity\CmsUser
     */
    public function login($usuario, $clave) {
        $oUser = $this->_em->getRepository($this->_entity)->login($usuario, $clave);
        return $oUser;
    }
    
    public function initSession(\web\Entity\CmsUser $users) {
        $access_admin = new \Zend_Session_Namespace ( SES_ADMIN );
        $access_admin->userId=$users->getIduser();
        $access_admin->user=$users->getNickUser();
        $access_admin->email=$users->getEmailUser();
    }
    
    public function closeSession() {
        $access_admin = new \Zend_Session_Namespace ( SES_ADMIN );
        $access_admin->unsetAll();
    }
    
}

?>
