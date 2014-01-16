<?php

namespace cart\Services;

/**
 * Description of MarcaLanguage
 *
 * @author aramosr
 */
class MarcaLanguageService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\cart\Entity\CartMarcaLanguage";
    private $_pathMarca;
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
        $this->_pathMarca = PTH_FILES_CART . DS . "marca" . DS;
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
