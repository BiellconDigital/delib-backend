<?php

namespace cart\Services;

/**
 * Description of Orden
 *
 * @author aramosr
 */
class OrdenService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\cart\Entity\CartOrden";
    private $_pathOrden;
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function aList($ordenEstado=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        
        list($qyOrden, $total) = $this->_em->getRepository($this->_entity)->listRecords($ordenEstado, $oLanguage, $pageStart, $pageLimit);
        $resultados = $qyOrden->getArrayResult();
        $objRecords=\Tonyprr_lib_Records::getInstance();
        $objRecords->normalizeRecords($resultados);
        return array($resultados, $total);
    }

    public function aListRecordsXCliente($ordenEstado=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        
        list($qyOrden, $total) = $this->_em->getRepository($this->_entity)->listRecordsXCliente($ordenEstado, $oLanguage, $pageStart, $pageLimit);
        $resultados = $qyOrden->getArrayResult();
        $objRecords=\Tonyprr_lib_Records::getInstance();
        $objRecords->normalizeRecords($resultados);
        return array($resultados, $total);
    }

    
    /**
     * 
     * @param array $formData
     * @return \cart\Entity\CartOrden
     */
    public function save($formData) {
        $aOrden = $this->_em->getRepository($this->_entity)->save($formData);
        return $aOrden;
    }
    
    public function registrarPago($formData) {
        $aOrden = $this->_em->getRepository($this->_entity)->registrarPago($formData);
        return $aOrden;
    }
    
    /**
     * 
     * @param int $id
     * @param boolean $asArray
     * @param \web\Entity\CmsCliente $oCliente
     * @return \cart\Entity\CartOrden $oOrden
     */
    public function getById($id, $asArray=true, $oCliente=NULL) {
        $oOrden = $this->_em->getRepository($this->_entity)->getById($id, $asArray, $oCliente);
        return $oOrden;
    }
    
    public function getUltimaOrden($oCliente, $oOrdenEstado=NULL, $asArray=true) {
        $oOrden = $this->_em->getRepository($this->_entity)->getUltimaOrden($oCliente, $oOrdenEstado, $asArray);
        return $oOrden;
    }
    
    /**
     *
     * @param \web\Entity\CmsCliente $oCliente
     * @param \cart\Entity\CartOrdenEstado $oOrdenEstado
     * @param boolean $asArray
     * @return \cart\Entity\CartOrden
     */
    public function getPrimeraOrden($oCliente, $oOrdenEstado=NULL, $asArray=true) {
        $oOrden = $this->_em->getRepository($this->_entity)->getPrimeraOrden($oCliente, $oOrdenEstado, $asArray);
        return $oOrden;
    }
    
    /**
     *
     * @param array $formData
     * @return \cart\Entity\CartOrden 
     */
    public function cambiarEstado($formData) {
        $oOrden = $this->_em->getRepository($this->_entity)->cambiarEstado($formData);
        return $oOrden;
    }
    
    /**
     * 
     * @param \cart\Entity\CartOrden $oOrden
     */
    public function notificarRegistroOrden(\cart\Entity\CartOrden $oOrden) {
        $this->_em->getRepository($this->_entity)->notificarRegistroOrden($oOrden);
    }
    
    /**
     * 
     * @param \cart\Entity\CartOrden $oOrden
     */
    public function notificarRegistroPagoOrden(\cart\Entity\CartOrden $oOrden) {
        $this->_em->getRepository($this->_entity)->notificarRegistroPagoOrden($oOrden);
    }

    /**
     * 
     * @param \cart\Entity\CartOrden $oOrden
     */
    public function notificarPagoConfirmado(\cart\Entity\CartOrden $oOrden) {
        $this->_em->getRepository($this->_entity)->notificarPagoConfirmado($oOrden);
    }
    
}

