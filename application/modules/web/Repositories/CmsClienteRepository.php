<?php

namespace web\Repositories;

use Doctrine\ORM\EntityRepository;
use Vendors\Paginate\Paginate;

/**
 * CmsClienteRepository
 *
 * Repositorio para gestión de clientes
 */
class CmsClienteRepository extends EntityRepository
{
    /**
     * Retorna una lista de registros de cliente
     * @param type $estado 
     * @param type $asArray determina si retornará una lista de elementos tipo Objetos o Array
     * @param type $pageStart
     * @param type $pageLimit
     * @return type
     */
    public function listRecords($estado = "TODOS", $asArray = true, $pageStart = NULL, $pageLimit = NULL) {
        $count= 0;
        $qbCliente = $this->_em->createQueryBuilder();
        $qbCliente->select(
                    '
                    c.idCliente,c.nombres,c.apellidoPaterno,c.apellidoMaterno,c.nroDocumento,c.role
                    ,c.genero,c.fechaNacimiento,c.telefonoCasa,c.telefonoOficina,c.movil,c.clave
                    ,c.recibirOfertasMail,c.recibirOfertasMovil,c.fechaRegistro,c.email,c.estado
                    ,c.fechaModificacion,c.foto
                    ,td.idtipoDocumento
                    ,pa.idPais,pa.nombre as nombre_pais
                    ')->from('\web\Entity\CmsCliente','c')//,td.nombreTdoc
                   ->innerJoin('c.tipoDocumento','td')->innerJoin('c.pais','pa')
                   ->orderBy('c.fechaRegistro','DESC');
        
        if ($estado != "TODOS") $qbCliente->andWhere('p.estado = :estado')->setParameter('estado', $estado);
        $qyCliente = $qbCliente->getQuery();
        
        
        if ($pageStart != NULL and $pageLimit != NULL) {
            $count = Paginate::getTotalQueryResults($qyCliente);
            $qyCliente->setFirstResult($pageStart)->setMaxResults($pageLimit);
        }
        if ($asArray) {
            $resultados = $qyCliente->getArrayResult();
            $objRecords=\Tonyprr_lib_Records::getInstance();
            $objRecords->normalizeRecords($resultados);
        } else  {
            $resultados = $qyCliente->getResult();
        }
        
        return array($resultados, $count);
    }

    
    /**
     *
     * @param array $formData
     * @return CmsCliente $oCliente
     */
    public function save($formData) {
        try {
            
            $newRegister = false;
            $subioArchivo = false;
            
            if (is_numeric($formData['idCliente']) ) {
                $oCliente = $this->_em->find("\web\Entity\CmsCliente", $formData['idCliente'] );
            }
            else {
                $oCliente = new \web\Entity\CmsCliente();
                $newRegister = true;
            }

            $oTipoDocumento = $this->_em->find("\web\Entity\CmsTipoDocumento", $formData['idtipoDocumento'] );
            if(!$oTipoDocumento)
                throw new \Exception('No existe categor�a. Seleccione primero una Categoria.',1);
                
            $oPais = $this->_em->find("\web\Entity\CmsPais", $formData['idPais'] );
            if(!$oPais)
                throw new \Exception('No existe Pais. Seleccione primero una Pais.', 1);

            if (isset($formData['idLanguage']) ) {
                $oLanguage = $this->_em->find("\web\Entity\CmsLanguage", $formData['idLanguage'] );
                $oCliente->setLanguage($oLanguage);
            }
            
            $oCliente->setNombres($formData['nombres']);
            $oCliente->setApellidoPaterno($formData['apellidoPaterno']);
            $oCliente->setApellidoMaterno($formData['apellidoMaterno']);
            $oCliente->setNroDocumento($formData['nroDocumento']);
            $oCliente->setGenero($formData['genero']);
            $oCliente->setFechaNacimiento(new \DateTime($formData['fechaNacimiento']));
            $oCliente->setTelefonoCasa($formData['telefonoCasa']);
            $oCliente->setTelefonoOficina($formData['telefonoOficina']);
            $oCliente->setMovil($formData['movil']);
            if (isset ($formData['clave']))
                $oCliente->setClave($formData['clave']);
            if (isset ($formData['role']))
                $oCliente->setRole ($formData['role']);
            else
                $oCliente->setRole ('user');
                
            $oCliente->setRecibirOfertasMail(isset($formData['recibirOfertasMail'])?1:0);
            $oCliente->setRecibirOfertasMovil(isset($formData['recibirOfertasMovil'])?1:0);
            
            $oCliente->setEmail($formData['email']);
            $oCliente->setTipoDocumento($oTipoDocumento);
            $oCliente->setPais($oPais);
            $oCliente->setEstado(isset($formData['estado'])?1:0);
            $oCliente->setFechaModificacion( new \DateTime() );

            $this->_em->persist($oCliente);
            $this->_em->flush();
                

            
            /* Subir archivo de imagen */
            $tipo = isset($_FILES['file_image']['type'])?$_FILES['file_image']['type']:'';
            if ($tipo == "image/jpg" || $tipo =="image/jpeg" || $tipo =="image/pjpeg") {
                $aInfoImg = pathinfo($_FILES['file_image']['name']);
                $nomArchivoImg = trim("cliente_" . time() . '_' . $oCliente->getIdCliente()) .'.' . 'jpg';//$aInfoImg['extension']
                @move_uploaded_file($_FILES['file_image']['tmp_name'], $this->_pathCliente . $nomArchivoImg);
                $objThumb = new \Tonyprr_Thumb();
                $res2=$objThumb->thumbjpeg_replace_fijo($this->_pathCliente . $nomArchivoImg,"",100);
                @unlink($this->_pathCliente . trim($oCliente->getFoto()));
                @unlink($this->_pathCliente . 'thumb_' . trim($oCliente->getFoto()));
                
                $oCliente->setFoto($nomArchivoImg);
                $subioArchivo = true;
            }
            
            if ($subioArchivo == true) {
                $this->_em->persist($oCliente);
                $this->_em->flush();
            }
            return $oCliente;
        } catch(\Exception $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            throw new \Exception('Error al guardar registro Cliente.' . $e->getMessage(),1);
        }
    }
    
    public function delete($idRegistro) {
        try {
            $oCliente = $this->_em->find('\web\Entity\CmsCliente',$idRegistro);
            if(!$oCliente) 
                throw new \Exception("No exite Cliente con el ID ".$idRegistro .".",2);
            @unlink($this->_pathCliente . trim($oCliente->getFoto()));
            $this->_em->remove($oCliente);
            $this->_em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de eliminar el Cliente.",1);
        }
    }

    /**
     * 
     * @param int $id
     * @param boolean $asArray
     * @return CmsCliente
     * @throws \Exception
     */
    public function getById($id, $asArray=true, $soloActivo=true) {
        $dqlList = 'SELECT c FROM \web\Entity\CmsCliente c WHERE c.idCliente = ?1';
        $qyCliente = $this->_em->createQuery($dqlList);
        $qyCliente->setParameter(1,$id);
        if ($asArray) {
            $oCliente = $qyCliente->getArrayResult();
            $objRecords = \Tonyprr_lib_Records::getInstance();
            if (count($oCliente) != 1)
                throw new \Exception('No existe este registro.',1);
            $objRecords->normalizeRecord($oCliente[0]);
            $oCliente = $oCliente[0];
        } else {
            $oCliente = $qyCliente->getSingleResult();
        }
        return $oCliente;
    }
    
    public function cambiarClave($id, $clave, $claveConfir=null, $claveActual=null) {
        try {
//            $oCliente = new CmsCliente();
            $dqlList = 'SELECT c FROM \web\Entity\CmsCliente c WHERE c.idCliente = ?1';
            $qyCliente = $this->_em->createQuery($dqlList);
            $qyCliente->setParameter(1,$id);
            try {
                $oCliente = $qyCliente->getSingleResult();
            } catch(\Doctrine\ORM\NoResultException $e) {
                throw new \Exception('No existe este registro o no se encuentra disponible.',1);
            }
            if($claveConfir != null)
                if ($oCliente->getEstado() != 1)
                    throw new \Exception('El usuario ya no esta disponible.', 1);
            if($claveActual != null)
                if ($oCliente->getClave() != md5($claveActual))
                    throw new \Exception('La clave actual ingresada no es correcta.',1);
            if($claveConfir != null)
                if($claveConfir != $clave)
                    throw new \Exception('Las claves no son las mismas.',1);
            $oCliente->setClave(md5($clave));
            $this->_em->persist($oCliente);
            $this->_em->flush();
            return true;
        } catch(\Doctrine\ORM\NoResultException $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            throw new \Exception('Ocurri� un error en el procesamiento, estaremos solucionandolo en breve.',1);
        }
    }
    

    public function activacionCliente($user, $key) {
        try {

            $daoKeys = new \web\Entity\Keys();
            $oKey = $daoKeys->verificarActivo($key);
            
            $query = $this->_em->createQuery('SELECT c from \web\Entity\CmsCliente c 
                WHERE c.email = :e_mail');// AND u.estado=1
            $query->setParameter('e_mail' ,$user);
            try {
                $oCliente = $query->getSingleResult();
            } catch(\Doctrine\ORM\NoResultException $e) {
                throw new \Exception('No es un e-mail v�lido de usuario.',1);
            }
//            $oCliente = new CmsCliente();
            if ($oCliente->getEstado())
                throw new \Exception('El usuario ya se encuentra activo.',1);

            $objEmail = new \Tonyprr_Email();
            $mensaje = "Su usuario ha sido activado correctamente, ¡bienvenido estimado cliente!";
            $objEmail->setBodyHtml($objEmail->convertString($mensaje));
            $objEmail->setFrom($objEmail->getAccount(), $objEmail->convertString($objEmail->getName()) );
            $objEmail->addTo($user);
            $objEmail->setSubject($objEmail->convertString("Activación de Cuenta - Machu Picchu Foods"));
            $objEmail->send($objEmail->getMailTrans());//$cn_mail

            $oCliente->setEstado(1);
            $oCliente->setFechaModificacion( new \DateTime() );
            $this->_em->persist($oCliente);
            $this->_em->flush();
            $daoKeys->consumirKey($oKey);
            
        } catch(\Doctrine\ORM\NoResultException $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            throw new \Exception('Ocurrió un error en el procesamiento, estaremos solucionandolo en breve.',1);
        }
    }
}
