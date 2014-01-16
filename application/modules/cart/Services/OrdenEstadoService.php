<?php

namespace cart\Services;

/**
 * Description of OrdenEstado
 *
 * @author aramosr
 */
class OrdenEstadoService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\cart\Entity\CartOrdenEstado";
    
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
    public function aList($soloActivos=false, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        
        list($qyOrdenEstado, $total) = $this->_em->getRepository($this->_entity)->listRecords($soloActivos, $oLanguage, $pageStart, $pageLimit);
        $resultados = $qyOrdenEstado->getArrayResult();
        $objRecords=\Tonyprr_lib_Records::getInstance();
        $objRecords->normalizeRecords($resultados);
        return array($resultados, $total);
    }

    /**
     * 
     * @param int $id
     * @param boolean $asArray
     * @return \cart\Entity\CartOrdenEstado $oOrdenEstado
     */
    public function getById($id, $asArray=true) {
        $oOrdenEstado = $this->_em->getRepository($this->_entity)->getById($id, $asArray);
        return $oOrdenEstado;
    }
    
}

