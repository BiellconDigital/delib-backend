<?php

namespace cart\Services;

/**
 * Description of OrdenTipo
 *
 * @author aramosr
 */
class OrdenTipoService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\cart\Entity\CartOrdenTipo";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @param boolean $soloActivos
     * @param mixed $oLanguage
     * @param int $pageStart
     * @param int $pageLimit
     * @return array
     */
    public function lista($asArray = true, $oLanguage=1, $activo=true, $pageStart=NULL, $pageLimit=NULL) {
        $aResult = $this->_em->getRepository($this->_entityName)->listRecords($asArray, $oLanguage, $activo, $pageStart, $pageLimit);
        return $aResult;
    }

}

