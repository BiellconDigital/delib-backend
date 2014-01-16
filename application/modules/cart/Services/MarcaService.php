<?php

namespace cart\Services;

/**
 * Description of Marca
 *
 * @author aramosr
 */
class MarcaService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\cart\Entity\CartMarca";
    private $_pathMarca;
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
        $this->_pathMarca = PTH_FILES_CART . DS . "marca" . DS;
    }
    
    /**
     * 
     * @return array
     */
    public function aList($state="TODOS", $language=1, $pageStart=NULL, $pageLimit=NULL) {
        
        $aResult = $this->_em->getRepository($this->_entity)->listRecords($state, $language, $pageStart, $pageLimit);
        return $aResult;
    }

    /**
     * 
     * @param array $formData
     * @return \cart\Entity\CartMarca
     */
    public function save($formData) {
        $aMarca = $this->_em->getRepository($this->_entity)->save($formData, $this->_pathMarca);
        return $aMarca;
    }
    
    public function getById($id, $language=1, $asArray=true, $soloActivo=true) {
        $aResult = $this->_em->getRepository($this->_entity)->getById($id, $language, $asArray, $soloActivo);
        return $aResult;
    }
    
    public function delete($idRegistro) {
        $this->_em->getRepository($this->_entity)->delete($idRegistro, $this->_pathMarca);
    }
    
    public function listLanguage($oMarca, $isArray = true) {
        $aMarcaLanguages = $this->_em->getRepository($this->_entity)->listLanguage($oMarca, $isArray);
        return $aMarcaLanguages;
    }
    
    /**
     * 
     * @param array $formData
     * @return type
     */
    public function saveLanguage(array $formData) {
        $oMarca = $this->_em->getRepository($this->_entity)->saveLanguage($formData);
        return $oMarca;
    }


}

?>
