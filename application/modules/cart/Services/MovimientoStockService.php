<?php

namespace cart\Services;

/**
 * Description of MovimientoStock
 *
 * @author aramosr
 */
class MovimientoStockService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\cart\Entity\CartMovimientoStock";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function aList($idMovStockTipo=NULL, $oLanguage=NULL, $asArray = true, $pageStart=NULL, $pageLimit=NULL) {
        
        $aResult = $this->_em->getRepository($this->_entity)->listRecords($idMovStockTipo, $oLanguage, $asArray, $pageStart, $pageLimit);
        return $aResult;
    }

    /**
     * 
     * @param type $formData
     * @param \cart\Entity\CartProducto $oProducto
     * @param \cart\Entity\CartOrden $oOrden
     * @param \cart\Entity\CartMovimientoStockTipo $oMovimientoStockTipo
     * @return \cart\Entity\CartMovimientoStock
     */
    public function save($formData, $oProducto=NULL, $oOrden=NULL, $oMovimientoStockTipo=NULL) {
        $aMovimientoStock = $this->_em->getRepository($this->_entity)->save($formData, $oProducto, $oOrden, $oMovimientoStockTipo);
        return $aMovimientoStock;
    }
    
    /**
     *
     * @param int $id
     * @param boolean $asArray
     * @param boolean $soloActivo
     * @return \cart\Entity\CartMovimientoStock $oMovimientoStock
     */
    public function getById($id, $asArray=true, $soloActivo=false) {
        $aResult = $this->_em->getRepository($this->_entity)->getById($id, $asArray, $soloActivo);
        return $aResult;
    }

    /**
     * 
     * @param int $idRegistro
     */
    public function delete($idRegistro) {
        $this->_em->getRepository($this->_entity)->delete($idRegistro);
    }
}

?>
