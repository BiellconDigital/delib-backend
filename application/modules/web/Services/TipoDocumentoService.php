<?php

namespace web\Services;
use \web\Entity\CmsTipoDocumento;

/**
 * Description of Cliente
 *
 * @author aramosr
 */
class TipoDocumentoService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\web\Entity\CmsTipoDocumento";
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     * 
     * @return array
     */
    public function aList($estado="TODOS", $oLanguage=1, $asArray = true, $pageStart=NULL, $pageLimit=NULL) {
        
        $aResult = $this->_em->getRepository($this->_entityName)->listRecords($estado, $oLanguage=1, $asArray, $pageStart, $pageLimit);
        return $aResult;
    }
    
    /**
     * 
     * @return array
     */
    public function getById($id, $asArray=true, $soloActivo=true) {
        $aCliente = $this->_em->getRepository($this->_entityName)->getById($id, $asArray, $soloActivo);
        return $aCliente;
    }
    
    
    public function save($formData) {
        try {
            if (is_numeric($formData['idTipoDocumento']) ) {
                $oTipoDocumento = $this->_em->find($this->_entityName, $formData['idTipoDocumento'] );
            } else {
                $oTipoDocumento = new \web\Entity\CmsTipoDocumento();
            }
            $oTipoDocumento->setEstadoTipodoc(isset($formData['estadoTipodoc'])?1:0);
            $oTipoDocumento->setLongitudTdoc($formData['longitudTdoc']);
            $oTipoDocumento->setTiempoModif(new \DateTime());
            $this->_em->persist($oTipoDocumento);
            $this->_em->flush();
                
            return $oTipoDocumento;
        } catch(\Exception $e) {
            throw new \Exception("Error al guardar registro. ", 1);//$e->getMessage()
        }
    }
    
    public function delete($idRegistro) {
        try {
            $oTipoDocumento = $this->_em->find('\web\Entity\CmsTipoDocumento', $idRegistro);
            if(!$oTipoDocumento)
                throw new \Exception("No exite TipoDocumento con el ID ".$idRegistro .".",2);

            $this->_em->remove($oTipoDocumento);
            $this->_em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de eliminar el Cliente.", 1);
        }
    }
    
}

?>
