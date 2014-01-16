<?php
namespace web\Services;

use web\Entity\CmsContentGaleria;
use web\Entity\CmsContentGaleriaLanguage;

/**
 * Clase Dao para el manejo de Galeria de Content
 *
 * @author aramosr
 */
class ContentGaleria {
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\web\Entity\CmsContentGaleria";
    private $_pathContentGale;

    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
        $this->_pathContentGale = PTH_FILES . DS . "content" . DS . "galeria" .DS;
    }
    
    /**
     * 
     * @return array
     */
    public function aList($idcontCate=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        $aResult = $this->_em->getRepository($this->_entityName)->listRecords($idcontCate, $oLanguage, $pageStart, $pageLimit);
        return $aResult;
    }
    
    public function save(array $formData) {
        try {
            $newRegister = false;
            $subioArchivo = false;

            if (is_numeric($formData['idcontgale']) ) {
                $oContentGale = $this->_em->find("\web\Entity\CmsContentGaleria", $formData['idcontgale'] );
            }
            else {
                $oContentGale = new CmsContentGaleria();
                $newRegister = true;
                
                $dqlList = "SELECT l from web\Entity\CmsLanguage l WHERE l.estado = 1";
                $qbLanguage = $this->_em->createQuery($dqlList);
                $aLanguage = $qbLanguage->getResult();
                foreach ($aLanguage as $oLanguage) {
                    $oContentGaleriaLanguage = new CmsContentGaleriaLanguage();
                    $oContentGaleriaLanguage ->setContgale($oContentGale)
                                    -> setLanguage($oLanguage)
                                    ->setTitulo("http://vadimarperu.com/web");
                    $oContentGale->addLanguage($oContentGaleriaLanguage);
                }
            }
            $Content = $this->_em->find("web\Entity\CmsContent", $formData['idcontent'] );

//            $oContentGale->setDescripcionGale($formData['descripcionGale']);
            $oContentGale->setContent($Content);
            $oContentGale->setOrdenGale($formData['ordenGale']);
            $this->_em->persist($oContentGale);
            $this->_em->flush();


            /* Subir archivo de foto  */
            $tipo = $_FILES['file_foto_gale']['type'];
            if ($tipo == "image/jpg" || $tipo =="image/jpeg" || $tipo =="image/pjpeg" || $tipo =="image/png") {
                $aInfoImg = pathinfo($_FILES['file_foto_gale']['name']);
                $nomArchivoImg = trim("content_ga_" . time() . '_' . $Content->getIdcontent(). '_'. $oContentGale->getIdcontgale()) .'.' . $aInfoImg['extension'];
                @move_uploaded_file($_FILES['file_foto_gale']['tmp_name'], $this->_pathContentGale . $nomArchivoImg);
//                $objThumb = new \Tonyprr_Thumb();
//                $res2=$objThumb->thumbjpeg($this->_pathContentGale . $nomArchivoImg,"",72,'thumb_');
                @unlink($this->_pathContentGale . trim($oContentGale->getImagenGale()));
//                @unlink($this->_pathContentGale . 'thumb_' . trim($oContentGale->getImagenGale()));
                
                $oContentGale->setImagenGale($nomArchivoImg);
                $subioArchivo = true;
            }

            if ($subioArchivo == true) {
                $this->_em->persist($oContentGale);
                $this->_em->flush();
            }
            return $oContentGale;
        } catch( \Exception $e) {
            throw new \Exception("Error al guardar registro.",2);
        }
    }


    public function delete($idRegistro) {
        try {
            $oContentGale = $this->_em->find('web\Entity\CmsContentGaleria',$idRegistro);
            if(!$oContentGale) 
                throw new \Exception("No exite el registro con el ID ".$idRegistro .".",2);
            @unlink($this->_pathContentGale . trim($oContentGale->getImagenGale()));
            @unlink($this->_pathContentGale . 'thumb_' . trim($oContentGale->getImagenGale()));
            $this->_em->remove($oContentGale);
            $this->_em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de eliminar el registro.",2);
        }
    }

}

?>
