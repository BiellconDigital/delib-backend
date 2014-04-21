<?php

namespace web\Services;
use \web\Entity\CmsContent;

/**
 * Description of Content
 *
 * @author aramosr
 */
class ContentLanguage {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\web\Entity\CmsContentLanguage";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function listLanguage($oContent, $isArray = true) {
        
        $aResult = $this->_em->getRepository($this->_entityName)->listLanguage($oContent, $isArray);
        return $aResult;
    }
    
    
    public function saveLanguage(array $formData) {
//        header("Content-Type: text/html; charset=ISO-8859-1");
        try {
            $oContent = $this->_em->find("\web\Entity\CmsContent", $formData['idcontent']);
            if(!($oContent instanceof \web\Entity\CmsContent)) {
                throw new \Exception('No existe el registro.',1);
            }
            $idsToFilter = array($formData['idContentLanguage']);
            if (!$oContent->getLanguages()->filter(
                        function($oContentLang) use ($idsToFilter) {
                            return in_array($oContentLang->getIdContentLanguage(), $idsToFilter);
                        })->first()  instanceof \web\Entity\CmsContentLanguage ) {
                $oLanguage = $this->_em->find("\web\Entity\CmsLanguage", $formData['idLanguage'] );
                $oContentLanguage = new $this->_entityName();
                $oContentLanguage  ->setContent($oContent)
                                    ->setLanguage($oLanguage)
                                    ->setDescripcion($formData['descripcion'])
                                    ->setIntro( isset($formData['intro'])?$formData['intro']:"" )
                                    ->setDetalle( isset($formData['detalle'])?$formData['detalle']:"" );
                $oContent->getLanguages()->add($oContentLanguage);
                $this->_em->persist($oContent);
            } else {
                $oContent->getLanguages()->filter(
                        function($oContentLang) use ($idsToFilter) {
                            return in_array($oContentLang->getIdContentLanguage(), $idsToFilter);
                        })->first()->setDescripcion($formData['descripcion'])
                                   ->setIntro( isset($formData['intro'])?$formData['intro']:"" )
                                   ->setDetalle( isset($formData['detalle'])?$formData['detalle']:"" );
                $this->_em->merge($oContent);
            }
            $this->_em->flush();
            
            return $oContent;
        } catch(\Exception $e) {
            throw new \Exception("Error al guardar registro. " .$e->getMessage(),1);
        }
    }
    
}

?>
