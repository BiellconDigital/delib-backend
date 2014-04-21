<?php

namespace web\Services;
use \web\Entity\CmsKeys;

/**
 * Description of Keys
 *
 * @author aramosr
 */
class KeysService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\web\Entity\CmsKeys";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function aList($pageStart=NULL, $pageLimit=NULL) {
        $aResult = $this->_em->getRepository($this->_entityName)->listRecords($pageStart, $pageLimit);
        return $aResult;
    }
    
    public function addKey($keyValidacion, $oCliente) {
        $aResult = $this->_em->getRepository($this->_entityName)->addKey($keyValidacion, $oCliente);
        return $aResult;
    }

    public function verificarActivo($key) {
        $aResult = $this->_em->getRepository($this->_entityName)->verificarActivo($key);
        return $aResult;
    }

    public function consumirKey($okey) {
        $aResult = $this->_em->getRepository($this->_entityName)->consumirKey($okey);
        return $aResult;
    }

    
    
    
}

?>
