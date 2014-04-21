<?php

namespace web\Services;
use \web\Entity\CmsContentLanguage;
use \web\Entity\CmsContentCategoria;
use \web\Entity\CmsContent;

/**
 * Description of Content
 *
 * @author aramosr
 */
class Content {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\web\Entity\CmsContent";
    private $_pathContent;
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
        $this->_pathContent = PTH_FILES . DS . "content" . DS;
    }
    
    /**
     * 
     * @return array
     */
    public function aList($idcontCate=NULL, $oLanguage=1, $estado="TODOS", $pageStart=NULL, $pageLimit=NULL, $textoBusqueda=NULL) {
        
        $aResult = $this->_em->getRepository($this->_entityName)->listRecords($idcontCate, $oLanguage, $estado, $pageStart, $pageLimit, $textoBusqueda);
        return $aResult;
    }
    
    /**
     * 
     * @return array
     */
    public function getById($id, $language=null, $asArray=true, $soloActivo=false) {
        $aContent = $this->_em->getRepository($this->_entityName)->getById($id, $language, $asArray, $soloActivo);
        return $aContent;
    }
    
    
    public function save($formData) {
        try {
            
            $newRegister = false;
            $subioArchivo = false;
            
            if (is_numeric($formData['idcontent']) ) {
                $oContent = $this->_em->find($this->_entityName, $formData['idcontent'] );
            }
            else {
                $oContent = new CmsContent();
//                $oContent = new $this->_entityName();
                $newRegister = true;
                
                $aLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findByestado(1);
                foreach ($aLanguage as $oLanguage) {
                    $oContentLanguage = new CmsContentLanguage();
                    $oContentLanguage ->setContent($oContent)
                                    -> setLanguage($oLanguage)
                                    ->setDescripcion("descripcion");
                    $oContent->addLanguage($oContentLanguage);
                }
            }

            $oContentCate = $this->_em->find("\web\Entity\CmsContentCategoria", $formData['idcontcate'] );
            if(!$oContentCate)
                throw new \Exception('No existe categoría. Seleccione primero una Categoria.');
                
            if (isset($formData['idTipo'])) {
                $oContentTipo = $this->_em->find("\web\Entity\CmsContentTipo", $formData['idTipo'] );
                if(!$oContentTipo)
                    throw new \Exception('No existe Tipo. Seleccione primero un tipo.');
                $oContent->setTipo($oContentTipo);
            }
            $oContent->setContcate($oContentCate);
            if( isset($formData['orden']) ) $oContent->setOrden($formData['orden']);
            if( isset($formData['url']) ) $oContent->setUrl($formData['url']);
            if( isset($formData['adicional1']) ) $oContent->setAdicional1($formData['adicional1']);
            if( isset($formData['adicional2']) ) $oContent->setAdicional2($formData['adicional2']);
            if( isset($formData['adicional3']) ) $oContent->setAdicional3($formData['adicional3']);
            if( isset($formData['fechainipub']) )  $oContent->setFechainipub( new \DateTime($formData['fechainipub']) );
            if( isset($formData['fechafinpub']) )  $oContent->setFechafinpub( new \DateTime($formData['fechafinpub']) );
                
            $oContent->setEstado(isset($formData['estado'])?1:0);
            $oContent->setFechamodf( new \DateTime() );
            $this->_em->persist($oContent);
            $this->_em->flush();

            
            /* Subir archivo de imagen */
            $tipo = $_FILES['file_image']['type'];
            if ($tipo == "image/jpg" || $tipo =="image/jpeg" || $tipo =="image/pjpeg" || $tipo =="image/png") {
                $aInfoImg = pathinfo($_FILES['file_image']['name']);
                $nomArchivoImg = trim("content_" . time() . '_' . $oContent->getIdcontent()) .'.' . $aInfoImg['extension'];//$aInfoImg['extension']
                @move_uploaded_file($_FILES['file_image']['tmp_name'], $this->_pathContent . $nomArchivoImg);
//                $objThumb = new \Tonyprr_Thumb();
//                $res1=$objThumb->thumbjpeg_replace_fijo($this->_pathContent . $nomArchivoImg,200,130);
//                $res2=$objThumb->thumbjpeg($this->_pathContent . $nomArchivoImg,"",140,'thumb_');
                @unlink($this->_pathContent . trim($oContent->getImagen()));
//                @unlink($this->_pathContent . 'thumb_' . trim($oContent->getImagenConte()));
                
                $oContent->setImagen($nomArchivoImg);
                $subioArchivo = true;
            }
            
            if (isset($_FILES['file_image2'])) {
                $tipo = $_FILES['file_image2']['type'];
                if ($tipo == "image/jpg" || $tipo =="image/jpeg" || $tipo =="image/pjpeg" || $tipo =="image/png") {
                    $aInfoImg = pathinfo($_FILES['file_image2']['name']);
                    $nomArchivoImg = trim("content2_" . time() . '_' . $oContent->getIdcontent()) .'.' . $aInfoImg['extension'];//$aInfoImg['extension']
                    @move_uploaded_file($_FILES['file_image2']['tmp_name'], $this->_pathContent . $nomArchivoImg);
                    @unlink($this->_pathContent . trim($oContent->getImagen2()));
                    $oContent->setImagen2($nomArchivoImg);
                    $subioArchivo = true;
                }
            }
            
            
            /* Subir archivo de adjunto */
            if (isset($_FILES['file_adjunto'])) {
                $tipo = $_FILES['file_adjunto']['type'];
                if ($_FILES['file_adjunto']['name'] != "") {
                    $aInfoAdj = pathinfo($_FILES['file_adjunto']['name']);
                    $nomArchivoAdj = trim("content_adj_" . time() . '_' . $oContent->getIdcontent()) .'.' . $aInfoAdj['extension'];
                    @move_uploaded_file($_FILES['file_adjunto']['tmp_name'], $this->_pathContent . $nomArchivoAdj);
                    $oContent->setAdjunto($nomArchivoAdj);
                    $subioArchivo = true;
                }
            }
            if ($subioArchivo == true) {
                $this->_em->persist($oContent);
                $this->_em->flush();
            }
            return $oContent;
        } catch(\Exception $e) {
            throw new \Exception("Error al guardar registro. ", 1);//$e->getMessage()
        }
    }
    
    public function delete($idRegistro) {
        try {
//            $oContent = new CmsContent();
            $oContent = $this->_em->find('\web\Entity\CmsContent',$idRegistro);
            if(!$oContent)
                throw new \Exception("No exite Content con el ID ".$idRegistro .".",2);
            @unlink($this->_pathContent . trim($oContent->getImagen()));
            @unlink($this->_pathContent . trim($oContent->getImagen2()));
            @unlink($this->_pathContent . trim($oContent->getAdjunto()));
            /*Eliminar archivos de su galeria*/
            if ((sizeof($oContent->getGaleria()) > 0) ) {
                foreach ($oContent->getGaleria() as $oFotoGale) {
                    @unlink($this->_pathContent . trim($oFotoGale->getImagenGale()) );
//                    @unlink($this->_pathContent . 'thumb_' . trim($oFotoGale->getImagenGale()) );
                }
            }
            
            $dqlList = 'DELETE \web\Entity\CmsContentGaleria pg WHERE pg.content = ?1';
            $qyContent = $this->_em->createQuery($dqlList);
            $qyContent->setParameter(1, $oContent);
            $result = $qyContent->execute();
            $this->_em->remove($oContent);
            $this->_em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de eliminar el Content.",1);
        }
    }

    
    
    
}

?>
