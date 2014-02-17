<?php

namespace cart\Services;
use cart\Entity\CartProductoGaleria;
use cart\Entity\CartProductoGaleriaLanguage;
/**
 * Description of ProductoGaleria
 *
 * @author aramosr
 */
class ProductoGaleriaLanguage {
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\cart\Entity\CartProductoGaleriaLanguage";

    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function listLanguage($oProductoGaleria, $isArray = true) {
        
        $aResult = $this->_em->getRepository($this->_entityName)->listLanguage($oProductoGaleria, $isArray);
        return $aResult;
    }
    
    
    public function saveLanguage(array $formData) {
        try {
            $oProductoGaleria = $this->_em->find("\cart\Entity\CartProductoGaleria", $formData['idcontgale']);
            if(!($oProductoGaleria instanceof CartProductoGaleria)) {
                throw new \Exception('No existe el registro.',1);
            }
//            $oProducto = new \CmsMarca();
            $idsToFilter = array($formData['idProductogaleLanguage']);
            if (!$oProductoGaleria->getLanguages()->filter(
                function($oProductoGaleLang) use ($idsToFilter) {
                    return in_array($oProductoGaleLang->getIdProductogaleLanguage(), $idsToFilter);
                })->first()  instanceof CartProductoGaleriaLanguage ) {
                            
                $oLanguage = $this->_em->find("\web\Entity\CmsLanguage", $formData['idLanguage'] );
                $oProductoGaleLanguage = new CartProductoGaleriaLanguage();
                $oProductoGaleLanguage  ->setContgale($oProductoGaleria)
                                        ->setLanguage($oLanguage)
                                        ->setTitulo($formData['titulo'])
                                        ->setDescripcion($formData['descripcion']);
                $oProductoGaleria->getLanguages()->add($oProductoGaleLanguage);
                $this->_em->persist($oProductoGaleria);
            } else {
                $oProductoGaleria->getLanguages()->filter(
                        function($oProductoGaleLang) use ($idsToFilter) {
                            return in_array($oProductoGaleLang->getIdProductogaleLanguage(), $idsToFilter);
                        })->first() ->setTitulo($formData['titulo'])
                                    ->setDescripcion($formData['descripcion']);
                $this->_em->merge($oProductoGaleria);
            }
            $this->_em->flush();
            
            return $oProductoGaleria;
        } catch(\Exception $e) {
            throw new \Exception("Error al guardar registro. " .$e->getMessage(),1);
        }
    }
}

?>
