<?php
namespace cart\Services;

use cart\Entity\CartProductoGaleria;
use cart\Entity\CartProductoGaleriaLanguage;

/**
 * Clase Dao para el manejo de Galeria de Producto
 *
 * @author aramosr
 */
class ProductoGaleria {
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\cart\Entity\CartProductoGaleria";
    private $_pathProductoGale;

    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
        $this->_pathProductoGale = PTH_FILES_CART . DS . "producto" . DS . "galeria" .DS;
    }
    
    /**
     * 
     * @return array
     */
    public function aList($idproducto=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        $aResult = $this->_em->getRepository($this->_entityName)->listRecords($idproducto, $oLanguage, $pageStart, $pageLimit);
        return $aResult;
    }
    
    public function save(array $formData) {
        try {
            $newRegister = false;
            $subioArchivo = false;

            if (is_numeric($formData['idcontgale']) ) {
                $oProductoGale = $this->_em->find("\cart\Entity\CartProductoGaleria", $formData['idcontgale'] );
            }
            else {
                $oProductoGale = new CartProductoGaleria();
                $newRegister = true;
                
                $dqlList = "SELECT l from web\Entity\CmsLanguage l WHERE l.estado = 1";
                $qbLanguage = $this->_em->createQuery($dqlList);
                $aLanguage = $qbLanguage->getResult();
                foreach ($aLanguage as $oLanguage) {
                    $oProductoGaleriaLanguage = new CartProductoGaleriaLanguage();
                    $oProductoGaleriaLanguage ->setContgale($oProductoGale)
                                    -> setLanguage($oLanguage)
                                    ->setTitulo("titulo");
                    $oProductoGale->addLanguage($oProductoGaleriaLanguage);
                }
            }
            $Producto = $this->_em->find("cart\Entity\CartProducto", $formData['idproducto'] );

//            $oProductoGale->setDescripcionGale($formData['descripcionGale']);
            $oProductoGale->setProducto($Producto);
            $oProductoGale->setOrdenGale($formData['ordenGale']);
//            $oProductoGale->setTipoGale($formData['tipoGale']);
            $this->_em->persist($oProductoGale);
            $this->_em->flush();


            /* Subir archivo de foto  */
            $tipo = $_FILES['file_foto_gale']['type'];
            if ($tipo == "image/jpg" || $tipo =="image/jpeg" || $tipo =="image/pjpeg") {// || $tipo =="image/png"
                $aInfoImg = pathinfo($_FILES['file_foto_gale']['name']);
                $nomArchivoImg = trim("producto_ga_" . time() . '_' . $Producto->getIdproducto(). '_'. $oProductoGale->getIdcontgale()) .'.' . $aInfoImg['extension'];
                @move_uploaded_file($_FILES['file_foto_gale']['tmp_name'], $this->_pathProductoGale . $nomArchivoImg);
                $objThumb = new \Tonyprr_Thumb();
                $res2=$objThumb->thumbjpeg($this->_pathProductoGale . $nomArchivoImg, "",100,'thumb_');
                @unlink($this->_pathProductoGale . trim($oProductoGale->getImagenGale()));
                @unlink($this->_pathProductoGale . 'thumb_' . trim($oProductoGale->getImagenGale()));
                
                $oProductoGale->setImagenGale($nomArchivoImg);
                $subioArchivo = true;
            }

            if ($subioArchivo == true) {
                $this->_em->persist($oProductoGale);
                $this->_em->flush();
            }
            return $oProductoGale;
        } catch( \Exception $e) {
            throw new \Exception("Error al guardar registro.",2);
        }
    }


    public function delete($idRegistro) {
        try {
            $oProductoGale = $this->_em->find('cart\Entity\CartProductoGaleria',$idRegistro);
            if(!$oProductoGale) 
                throw new \Exception("No exite el registro con el ID ".$idRegistro .".",2);
            @unlink($this->_pathProductoGale . trim($oProductoGale->getImagenGale()));
            @unlink($this->_pathProductoGale . 'thumb_' . trim($oProductoGale->getImagenGale()));
            $this->_em->remove($oProductoGale);
            $this->_em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de eliminar el registro.",2);
        }
    }

}

?>
