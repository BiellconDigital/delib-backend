<?php

namespace web\Services;

/**
 * Description of User
 *
 * @author aramosr
 */
class ContentCategoria {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\web\Entity\CmsContentCategoria";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return string
     */
    public function listTree($idcatpadre = 1, $language=1, $todos = false) {
        
        $oUser = $this->_em->getRepository($this->_entity)->getTree($idcatpadre, $language, $todos);
        return $oUser;
    }
    
}

?>
