<?php

namespace cart\Services;
use \cart\Entity\CartProductoCategoria;
use \cart\Entity\CartProductoCategoriaLanguage;

/**
 * Description of User
 *
 * @author aramosr
 */
class ProductoCategoria {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entity = "\cart\Entity\CartProductoCategoria";
    private $_pathProducto;
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
        $this->_pathProducto = PTH_FILES_CART . DS . "producto" . DS;
    }
    
    /**
     * 
     * @return array
     */
    public function aList($idcontCate=1, $oLanguage=1, $estado="TODOS", $pageStart=NULL, $pageLimit=NULL) {
        
        $aResult = $this->_em->getRepository($this->_entity)->listRecords($idcontCate, $oLanguage, $estado, $pageStart, $pageLimit);
        return $aResult;
    }
    
    /**
     * 
     * @return string
     */
    public function listTree($idcatpadre = 1, $language=1, $todos = false) {
        
        $sResult = $this->_em->getRepository($this->_entity)->getTree($idcatpadre, $language, $todos);
        return $sResult;
    }
    
    /**
     * 
     * @return string
     */
    public function getTreeHtml($idcatpadre = 1, $language=1, $todos = false) {
        $result = $this->_em->getRepository($this->_entity)->getTreeHtml($idcatpadre, $language, $todos);
        return $result;
    }
    
    /**
     * 
     * @return string
     */
    public function getTreeRouteHtml($idcatpadre = null, $idprod = null, $oLanguage=1, $todos = false) {
        $result = $this->_em->getRepository($this->_entity)->getTreeRouteHtml($idcatpadre, $idprod, $oLanguage, $todos);
        return $result;
    }
    
    
    /**
     * 
     * @return array
     */
    public function getById($id, $language=null, $asArray=true, $soloActivo=false) {
        $aResult = $this->_em->getRepository($this->_entity)->getById($id, $language, $asArray, $soloActivo);
        return $aResult;
    }
    
    public function save($formData) {
        try {
            
//            $newRegister = false;
            $subioArchivo = false;
            if ($formData['idcontcatePadre'] != "") {
                $oProdCatePadre = $this->_em->find("\cart\Entity\CartProductoCategoria", $formData['idcontcatePadre'] );
                if(!($oProdCatePadre instanceof CartProductoCategoria)) {
                    throw new \Exception('No existe el registro padre.',1);
                }
                $formData['padre'] = $oProdCatePadre;
            } else {
                $formData['padre'] = NULL;
            }

            
            if (is_numeric($formData['idcontcate']) ) {
                $oProductoCategoria = $this->_em->find($this->_entity, $formData['idcontcate'] );
            }
            else {
                $oProductoCategoria = new CartProductoCategoria();
//                $newRegister = true;
                $oProductoCategoria->setFecharegCate( new \DateTime() );
                $aLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findByestado(1);
                foreach ($aLanguage as $oLanguage) {
                    $oProductoCategoriaLanguage = new CartProductoCategoriaLanguage();
                    $oProductoCategoriaLanguage ->setContcate($oProductoCategoria)
                                    -> setLanguage($oLanguage)
                                    ->setDescripcion("descripcion");
                    $oProductoCategoria->addLanguage($oProductoCategoriaLanguage);
                }
            }

            if ($formData['padre'] != NULL)
                $oProductoCategoria->setContcatePadre($formData['padre']);

            $oProductoCategoria->setStateCate(isset($formData['stateCate'])?1:0);
            $oProductoCategoria->setNivelCate($formData['nivelCate']);
            $oProductoCategoria->setOrdenCate($formData['ordenCate']);
            $oProductoCategoria->setFechamodfCate( new \DateTime() );

            $this->_em->persist($oProductoCategoria);
            $this->_em->flush();
            
            /* Subir archivo de imagen */
            $tipo = $_FILES['file_image']['type'];
            if ($tipo == "image/jpg" || $tipo =="image/jpeg" || $tipo =="image/pjpeg" || $tipo =="image/png") {
                $aInfoImg = pathinfo($_FILES['file_image']['name']);
                $nomArchivoImg = trim("producto_cate_" . time() . '_' . $oProductoCategoria->getIdcontcate()) .'.' . $aInfoImg['extension'];//$aInfoImg['extension']
                @move_uploaded_file($_FILES['file_image']['tmp_name'], $this->_pathProducto . $nomArchivoImg);
//                $objThumb = new \Tonyprr_Thumb();
//                $res1=$objThumb->thumbjpeg_replace_fijo($this->_pathProducto . $nomArchivoImg,200,130);
//                $res2=$objThumb->thumbjpeg($this->_pathProducto . $nomArchivoImg,"",140,'thumb_');
                @unlink($this->_pathProducto . trim($oProductoCategoria->getImagenCate()));
//                @unlink($this->_pathProducto . 'thumb_' . trim($oProductoCategoria->getImagenConte()));
                $oProductoCategoria->setImagenCate($nomArchivoImg);
                $subioArchivo = true;
            }

            if ($subioArchivo == true) {
                $this->_em->persist($oProductoCategoria);
                $this->_em->flush();
            }
            return $oProductoCategoria;
        } catch(\Exception $e) {
            throw new \Exception("Error al guardar registro. ", 1);//$e->getMessage()
        }
    }
    
    public function delete($idRegistro) {
        $this->_em->getRepository($this->_entity)->delete($idRegistro, $this->_pathProducto);
    }
    

    
}

?>
