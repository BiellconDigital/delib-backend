<?php

namespace web\Services;
use \web\Entity\CmsUbigeo;

/**
 * Description of Cliente
 *
 * @author aramosr
 */
class UbigeoService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\web\Entity\CmsUbigeo";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function lista($asArray = true, $oPais = 1, $pageStart=NULL, $pageLimit=NULL) {
        
        $aResult = $this->_em->getRepository($this->_entityName)->listRecords($asArray, $oPais, $pageStart, $pageLimit);
        return $aResult;
    }
    
    
}

?>
