<?php

namespace cart\Services;

/**
 * Description of MovimientoStockTipo
 *
 * @author aramosr
 */
class MovimientoStockTipoService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\cart\Entity\CartMovimientoStockTipo";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function aList($activo=true, $pageStart=NULL, $pageLimit=NULL) {
        
        $aResult = $this->_em->getRepository($this->_entity)->listRecords($activo, $pageStart, $pageLimit);
        return $aResult;
    }

}

?>
