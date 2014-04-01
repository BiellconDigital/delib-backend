<?php

namespace cart\Services;
use \cart\Entity\CartProductoLanguage;
//use \cart\Entity\CartProductoCategoria as ProductoCategoria;
use \cart\Entity\CartProducto;
use Tonyprr\Exception\ValidacionException;

/**
 * Description of Producto
 *
 * @author aramosr
 */
class Producto {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\cart\Entity\CartProducto";
    private $_pathProducto;
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
        $this->_pathProducto = PTH_FILES_CART . DS . "producto" . DS;
    }
    
    /**
     * 
     * @return array
     */
    public function getById($id, $language=null, $asArray=true, $soloActivo=false) {
        $aResult = $this->_em->getRepository($this->_entityName)->getById($id, $language, $asArray, $soloActivo);
        return $aResult;
        
    }
    
    /**
     * 
     * @return array
     */
    public function aList($idcontCate=NULL, $oLanguage=1, $estado="TODOS", $pageStart=NULL, $pageLimit=NULL, $textoBusqueda=NULL, $stock=0) {
        
        $aResult = $this->_em->getRepository($this->_entityName)->listRecords($idcontCate, $oLanguage, $estado, $pageStart, $pageLimit, $textoBusqueda, $stock);
        return $aResult;
    }
    
    
    public function save($formData) {
        try {
            
            $newRegister = false;
            $subioArchivo = false;
            
            if (is_numeric($formData['idproducto']) ) {
                $oProducto = $this->_em->find($this->_entityName, $formData['idproducto'] );
                if ((sizeof($oProducto->getLanguages()) > 0) ) {
                    foreach ($oProducto->getLanguages() as $language) {
                        $language-> setNombre($formData['nombre_producto'])
                                 -> setFicha($formData['ficha']);
                    }
                }
            }
            else {
                $oProducto = new CartProducto();
//                $oProducto = new $this->_entityName();
                $oProducto->setCantidad(0);
                $oProducto->setCantidadVendidos(0);
                $newRegister = true;
                
                $aLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findByestado(1);
                foreach ($aLanguage as $oLanguage) {
                    $oProductoLanguage = new CartProductoLanguage();
                    $oProductoLanguage ->setProducto($oProducto)
                                    -> setLanguage($oLanguage)
                                    -> setNombre($formData['nombre_producto'])
                                    -> setFicha($formData['ficha']);
                    $oProducto->addLanguage($oProductoLanguage);
                }
            }

            $oProductoCate = $this->_em->find("\cart\Entity\CartProductoCategoria", $formData['idcontcate'] );
            if(!$oProductoCate)
                throw new \Exception('No existe categoría. Seleccione primero una Categoria.');
                
            if (isset($formData['idmarca'])) {
                $oProductoMarca = $this->_em->find("\cart\Entity\CartMarca", $formData['idmarca'] );
                if(!$oProductoMarca)
                    throw new \Exception('No existe Marca. Seleccione primero una Marca.');
                $oProducto->setMarca($oProductoMarca);
            }

            if (isset($formData['idTipo'])) {
                $oProductoTipo = $this->_em->find("\cart\Entity\CartProductoTipo", $formData['idTipo'] );
                if(!$oProductoTipo)
                    throw new \Exception('No existe Tipo. Seleccione primero un tipo.');
                $oProducto->setTipo($oProductoTipo);
            }
                
//            $oProducto->setTituloConte($formData['tituloConte']);
            $oProducto->setContcate($oProductoCate);
            $oProducto->setCodigoProducto($formData['codigoProducto']);
            
            $oProducto->setOrden($formData['orden']);
//            $oProducto->setDescripcionConte($formData['descripcionConte']);
//            $oProducto->setFichaConte($formData['fichaConte']);
            
//            $oProducto->setPeso($formData['peso']);
            $oProducto->setPrecio($formData['precio']);
            
            if (isset($formData['precio1']))
                $oProducto->setPrecio1($formData['precio1']);
            
            if (isset($formData['precio2']))
                $oProducto->setPrecio2($formData['precio2']);
//            $oProducto->setCantidad($formData['cantidad']);
            
            $oProducto->setEstado(isset($formData['estado'])?1:0);
//            $oProducto->setFechainipubConte( new \DateTime($formData['fechainipubConte']) );
//            $oProducto->setFechafinpubConte( new \DateTime($formData['fechafinpubConte']) );
            $oProducto->setFechamodif( new \DateTime() );
//            $oProducto->setOrdenConte($formData['ordenConte']);

            if (isset($formData['borrarImg'])) {
                @unlink($this->_pathProducto . trim($oProducto->getImagen()));
                $oProducto->setImagen("");
            }
            if (isset($formData['borrarAdj'])) {
                @unlink($this->_pathProducto . trim($oProducto->getAdjunto()));
                $oProducto->setAdjunto("");
            }
            
            $this->_em->persist($oProducto);
            $this->_em->flush();
            
            /* Subir archivo de imagen */
            $tipo = $_FILES['file_image']['type'];
            if ($tipo == "image/jpg" || $tipo =="image/jpeg" || $tipo =="image/pjpeg" || $tipo =="image/png") {
                $aInfoImg = pathinfo($_FILES['file_image']['name']);
                $nomArchivoImg = trim("producto_" . time() . '_' . $oProducto->getIdproducto()) .'.' . $aInfoImg['extension'];//$aInfoImg['extension']
                @unlink($this->_pathProducto . trim($oProducto->getImagen()));
                @move_uploaded_file($_FILES['file_image']['tmp_name'], $this->_pathProducto . $nomArchivoImg);
//                echo $nomArchivoImg;
//                $objThumb = new \Tonyprr_Thumb();
//                $res1=$objThumb->thumbjpeg_replace_fijo($this->_pathProducto . $nomArchivoImg,200,130);
//                $res2=$objThumb->thumbjpeg($this->_pathProducto . $nomArchivoImg,"",140,'thumb_');
//                @unlink($this->_pathProducto . 'thumb_' . trim($oProducto->getImagenConte()));
                
                $oProducto->setImagen($nomArchivoImg);
                $subioArchivo = true;
            }
            
            /* Subir archivo de adjunto */
            $tipo = $_FILES['file_adjunto']['type'];
            if ($_FILES['file_adjunto']['name'] != "") {
                $aInfoAdj = pathinfo($_FILES['file_adjunto']['name']);
                $nomArchivoAdj = trim("producto_adj_" . $oProducto->getIdproducto()) .'.' . $aInfoAdj['extension'];
                @unlink($this->_pathProducto . trim($oProducto->getAdjunto()));
                @move_uploaded_file($_FILES['file_adjunto']['tmp_name'], $this->_pathProducto . $nomArchivoAdj);
                $oProducto->setAdjunto($nomArchivoAdj);
                $subioArchivo = true;
            }
            if ($subioArchivo == true) {
                $this->_em->persist($oProducto);
                $this->_em->flush();
            }
            return $oProducto;
        } catch(\Exception $e) {
            throw new \Exception("Error al guardar registro. ", 1);//$e->getMessage()
        }
    }
    
    public function delete($idRegistro) {
        try {
//            $oProducto = new CartProducto();
            $oProducto = $this->_em->find($this->_entityName, $idRegistro);
            if(!$oProducto)
                throw new ValidacionException("No exite Producto con el ID ".$idRegistro .".",2);
            
            //Verifica si existen ordenes asociados al producto. Si existen no permite la eliminación
            $qyTotalOrdenes = $this->_em->createQuery('SELECT COUNT(od.idOrdenDetalle) FROM \cart\Entity\CartOrdenDetalle od '
                    . 'WHERE od.producto = ?1')->setParameter(1, $oProducto);
            $totalOrdenes = (int) $qyTotalOrdenes->getSingleScalarResult();
            
            if ($totalOrdenes > 0)
                throw new ValidacionException("Existe Ordenes de Pedido o Compra asociados con este Producto", 2);

            @unlink($this->_pathProducto . trim($oProducto->getImagen()));
            @unlink($this->_pathProducto . trim($oProducto->getAdjunto()));
            /*Eliminar archivos de su galeria*/
            if ((sizeof($oProducto->getGaleria()) > 0) ) {
                foreach ($oProducto->getGaleria() as $oFotoGale) {
                    @unlink($this->_pathProducto . trim($oFotoGale->getImagenGale()) );
//                    $oProducto->removeGaleria($oFotoGale);
//                    @unlink($this->_pathProducto . 'thumb_' . trim($oFotoGale->getImagenGale()) );
                }
            }
            
            $dqlList = 'DELETE \cart\Entity\CartProductoGaleria pg WHERE pg.producto = ?1';
            $qyProducto = $this->_em->createQuery($dqlList);
            $qyProducto->setParameter(1, $oProducto);
            $result = $qyProducto->execute();
            
//            $oProducto->getGaleria()->clear();
            $this->_em->remove($oProducto);
//            $this->_em->persist($oProducto);
            $this->_em->flush();
        } catch(ValidacionException $e) {
            throw new ValidacionException($e->getMessage(), $e->getCode());
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de eliminar el Producto.",1);
        }
    }

    
    
    
}

?>
