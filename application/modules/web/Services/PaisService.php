<?php

namespace web\Services;
use \web\Entity\CmsPais;

/**
 * Description of Cliente
 *
 * @author aramosr
 */
class PaisService {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em = null;
    private $_entityName = "\web\Entity\CmsPais";
    private $_pathCliente;
    
    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
        $this->_pathCliente = PTH_FILES . DS . "pais" . DS;
    }
    
    /**
     * 
     * @return array
     */
    public function aList($estado="TODOS", $asArray = true, $pageStart=NULL, $pageLimit=NULL) {
        
        $aResult = $this->_em->getRepository($this->_entityName)->listRecords($estado, $asArray, $pageStart, $pageLimit);
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
            if (is_numeric($formData['idPais']) ) {
                $oPais = $this->_em->find($this->_entityName, $formData['idPais'] );
            } else {
                $oPais = new \web\Entity\CmsPais();
            }
            $oPais->setEstado(isset($formData['estado'])?1:0);
            $oPais->setNombre($formData['nombre']);
            $oPais->setNumPais($formData['numPais']);
            $this->_em->persist($oPais);
            $this->_em->flush();
                
            return $oPais;
        } catch(\Exception $e) {
            throw new \Exception("Error al guardar registro. ", 1);//$e->getMessage()
        }
    }
    
    public function delete($idRegistro) {
        try {
            //$oPais = new CmsPais();
            $oPais = $this->_em->find('\web\Entity\CmsPais', $idRegistro);
            if(!$oPais)
                throw new \Exception("No exite Pais con el ID ".$idRegistro .".",2);

            $this->_em->remove($oPais);
            $this->_em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de eliminar el Cliente.", 1);
        }
    }

    
    
    
}

?>
