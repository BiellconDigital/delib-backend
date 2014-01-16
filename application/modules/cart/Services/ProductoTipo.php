<?php

namespace cart\Services;

/**
 * Description of Producto
 *
 * @author aramosr
 */
class ProductoTipo {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\cart\Entity\CartProductoTipo";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function aList($state="TODOS", $language=1, $pageStart=NULL, $pageLimit=NULL) {
        
        $aResult = $this->_em->getRepository($this->_entity)->listRecords($state, $language, $pageStart, $pageLimit);
        return $aResult;
    }
    
}

?>
