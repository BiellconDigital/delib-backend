<?php

namespace cart\Services;
use \cart\Entity\CartProducto;

/**
 * Description of Producto
 *
 * @author aramosr
 */
class ProductoCategoriaLanguage {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\cart\Entity\CartProductoCategoriaLanguage";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function listLanguage($oProductoCategoria, $isArray = true) {
        
        $aResult = $this->_em->getRepository($this->_entityName)->listLanguage($oProductoCategoria, $isArray);
        return $aResult;
    }
    
    
    public function saveLanguage(array $formData) {
//        header("Content-Type: text/html; charset=ISO-8859-1");
        try {
            $oProductoCategoria = $this->_em->find("\cart\Entity\CartProductoCategoria", $formData['idcontcate']);
            if(!($oProductoCategoria instanceof \cart\Entity\CartProductoCategoria)) {
                throw new \Exception('No existe el registro.', 1);
            }
//            $oProducto = new \CmsMarca();
            $idsToFilter = array($formData['idProductocateLanguage']);
            if (!$oProductoCategoria->getLanguages()->filter(
                        function($oProductoCategoriaLang) use ($idsToFilter) {
                            return in_array($oProductoCategoriaLang->getIdProductocateLanguage(), $idsToFilter);
                        })->first()  instanceof \cart\Entity\CartProductoCategoriaLanguage ) {
                $oLanguage = $this->_em->find("\web\Entity\CmsLanguage", $formData['idLanguage'] );
                $oProductoCategoriaLanguage = new $this->_entityName();
                $oProductoCategoriaLanguage  ->setProducto($oProductoCategoria)
                                    ->setLanguage($oLanguage)
                                    ->setDescripcion($formData['descripcion'])
                                    ->setDetalle($formData['detalle']);
                $oProductoCategoria->getLanguages()->add($oProductoCategoriaLanguage);
                $this->_em->persist($oProductoCategoria);
            } else {
                $oProductoCategoria->getLanguages()->filter(
                        function($oProductoCategoriaLang) use ($idsToFilter) {
                            return in_array($oProductoCategoriaLang->getIdProductocateLanguage(), $idsToFilter);
                        })->first()
                                ->setDescripcion($formData['descripcion'])
                                ->setDetalle($formData['detalle']);
                $this->_em->merge($oProductoCategoria);
            }
            $this->_em->flush();
            
            return $oProductoCategoria;
        } catch(\Exception $e) {
            throw new \Exception("Error al guardar registro. " .$e->getMessage(),1);
        }
    }
    
}

?>
