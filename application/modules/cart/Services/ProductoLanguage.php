<?php

namespace cart\Services;
use \cart\Entity\CartProducto;

/**
 * Description of Producto
 *
 * @author aramosr
 */
class ProductoLanguage {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\cart\Entity\CartProductoLanguage";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function listLanguage($oProducto, $isArray = true) {
        
        $aResult = $this->_em->getRepository($this->_entityName)->listLanguage($oProducto, $isArray);
        return $aResult;
    }
    
    
    public function saveLanguage(array $formData) {
//        header("Content-Type: text/html; charset=ISO-8859-1");
        try {
            $oProducto = $this->_em->find("\cart\Entity\CartProducto", $formData['idproducto']);
            if(!($oProducto instanceof \cart\Entity\CartProducto)) {
                throw new \Exception('No existe el registro.',1);
            }
//            $oProducto = new \CmsMarca();
            $idsToFilter = array($formData['idProductoLanguage']);
            if (!$oProducto->getLanguages()->filter(
                        function($oProductoLang) use ($idsToFilter) {
                            return in_array($oProductoLang->getIdProductoLanguage(), $idsToFilter);
                        })->first()  instanceof \cart\Entity\CartProductoLanguage ) {
                $oLanguage = $this->_em->find("\web\Entity\CmsLanguage", $formData['idLanguage'] );
                $oProductoLanguage = new $this->_entityName();
                $oProductoLanguage  ->setProducto($oProducto)
                                    ->setLanguage($oLanguage)
                                    ->setNombre($formData['nombre'])
                                    ->setIntro(isset($formData['intro'])?$formData['intro']:"")
                                    ->setFicha(isset($formData['ficha'])?$formData['ficha']:"");
                $oProducto->getLanguages()->add($oProductoLanguage);
                $this->_em->persist($oProducto);
            } else {
                $oProducto->getLanguages()->filter(
                        function($oProductoLang) use ($idsToFilter) {
                            return in_array($oProductoLang->getIdProductoLanguage(), $idsToFilter);
                        })->first()->setNombre($formData['nombre'])
                                ->setIntro(isset($formData['intro'])?$formData['intro']:"")
                                ->setFicha(isset($formData['ficha'])?$formData['ficha']:"");
                $this->_em->merge($oProducto);
            }
            $this->_em->flush();
            
            return $oProducto;
        } catch(\Exception $e) {
            throw new \Exception("Error al guardar registro. " .$e->getMessage(),1);
        }
    }
    
}

?>
