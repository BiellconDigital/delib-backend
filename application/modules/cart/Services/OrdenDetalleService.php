<?php

namespace cart\Services;

/**
 * Description of Orden
 *
 * @author aramosr
 */
class OrdenDetalleService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\cart\Entity\CartOrdenDetalle";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @param \cart\Entity\CartOrden $oOrden
     * @param int $pageStart
     * @param int $pageLimit
     * @return array
     */
    public function aList($oOrden, $pageStart=NULL, $pageLimit=NULL) {
        
        list($qyOrdenDetalle, $total) = $this->_em->getRepository($this->_entity)->listRecords($oOrden, $pageStart, $pageLimit);
        $resultados = $qyOrdenDetalle->getArrayResult();
        $objRecords=\Tonyprr_lib_Records::getInstance();
        $objRecords->normalizeRecords($resultados);
        return array($resultados, $total);
    }

    /**
     *
     * @param array $formData
     * @param \cart\Entity\CartOrden $oOrden
     * @param \cart\Entity\CartProducto $oProducto
     * @return \cart\Entity\CartOrdenDetalle 
     */
    public function save($formData, $oOrden = null, $oProducto = null) {
        $oOrdenDetalle = $this->_em->getRepository($this->_entity)->listRecords($formData, $oOrden, $oProducto);
        return $oOrdenDetalle;
    }
    
    /**
     * 
     * @param int $idRegistro
     */
    public function delete($idRegistro) {
        $oOrdenDetalle = $this->_em->getRepository($this->_entity)->delete($idRegistro);
    }
    
    
    /**
     * 
     * @param int $id
     * @param boolean $asArray
     * @return \cart\Entity\CartOrdenDetalle $oOrdenDetalle
     */
    public function getById($id, $asArray=true) {
        $oOrdenDetalle = $this->_em->getRepository($this->_entity)->getById($id, $asArray);
        return $oOrdenDetalle;
    }
    
    
    
}


