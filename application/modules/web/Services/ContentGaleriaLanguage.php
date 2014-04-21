<?php

namespace web\Services;
use web\Entity\CmsContentGaleria;
use web\Entity\CmsContentGaleriaLanguage;
/**
 * Description of ContentGaleria
 *
 * @author aramosr
 */
class ContentGaleriaLanguage {
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\web\Entity\CmsContentGaleriaLanguage";

    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function listLanguage($oContentGaleria, $isArray = true) {
        
        $aResult = $this->_em->getRepository($this->_entityName)->listLanguage($oContentGaleria, $isArray);
        return $aResult;
    }
    
    
    public function saveLanguage(array $formData) {
        try {
            $oContentGaleria = $this->_em->find("\web\Entity\CmsContentGaleria", $formData['idcontgale']);
            if(!($oContentGaleria instanceof CmsContentGaleria)) {
                throw new \Exception('No existe el registro.',1);
            }
//            $oContent = new \CmsMarca();
            $idsToFilter = array($formData['idContentgaleLanguage']);
            if (!$oContentGaleria->getLanguages()->filter(
                function($oContentGaleLang) use ($idsToFilter) {
                    return in_array($oContentGaleLang->getIdContentgaleLanguage(), $idsToFilter);
                })->first()  instanceof CmsContentGaleriaLanguage ) {
                            
                $oLanguage = $this->_em->find("\web\Entity\CmsLanguage", $formData['idLanguage'] );
                $oContentGaleLanguage = new CmsContentGaleriaLanguage();
                $oContentGaleLanguage  ->setContgale($oContentGaleria)
                                        ->setLanguage($oLanguage)
                                        ->setTitulo($formData['titulo'])
                                        ->setDescripcion($formData['descripcion']);
                $oContentGaleria->getLanguages()->add($oContentGaleLanguage);
                $this->_em->persist($oContentGaleria);
            } else {
                $oContentGaleria->getLanguages()->filter(
                        function($oContentGaleLang) use ($idsToFilter) {
                            return in_array($oContentGaleLang->getIdContentgaleLanguage(), $idsToFilter);
                        })->first() ->setTitulo($formData['titulo'])
                                    ->setDescripcion($formData['descripcion']);
                $this->_em->merge($oContentGaleria);
            }
            $this->_em->flush();
            
            return $oContentGaleria;
        } catch(\Exception $e) {
            throw new \Exception("Error al guardar registro. " .$e->getMessage(),1);
        }
    }
}

?>
