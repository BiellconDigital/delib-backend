<?php

namespace web\Services;

/**
 * Description of Content
 *
 * @author aramosr
 */
class ContentTipo {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\web\Entity\CmsContentTipo";
    
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
