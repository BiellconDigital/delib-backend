<?php
namespace Dao\Cart;

use CmsOrden;
use CmsOrdenDetalle;
use CmsProducto;
//use Models\CmsTipoDocumento;
//use Models\CmsPais;
use Vendors\Paginate\Paginate;

/**
 * Clase Dao para el manejo de Marcas de OrdenDetalle
 *
 * @author aramosr
 */
class OrdenDetalle {
    /**
     *
     * @var \Doctrine\ORM\EntityManager 
     */
    private $_em;

    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    /**
     *
     * @param CmsOrden $oOrden
     * @param mixed $estado
     * @param int $pageStart
     * @param int $pageLimit
     * @return mixed
     */
    public function listRecords($oOrden, $pageStart=NULL, $pageLimit=NULL) {
        $count= 0;
        $qbOrdenDetalle = $this->_em->createQueryBuilder();
        $qbOrdenDetalle->select(
                    '
                    od.idOrdenDetalle,od.productoNombre,od.cantidad,od.precioUnitario,od.precioTotal
                    ')->from('\CmsOrdenDetalle','od')
//                   ->innerJoin('cd.tipoDireccion','td')->innerJoin('cd.pais','pa')->innerJoin('cd.cliente','c')
                   ->orderBy('od.fechaRegistro','DESC')
                   ->where('od.orden = :orden')->setParameter('orden', $oOrden);
        $qyOrdenDetalle = $qbOrdenDetalle->getQuery();//,pa.nombre as nombre_pais
        
        if ($pageStart!= NULL and $pageLimit!=NULL) {
            $count = Paginate::getTotalQueryResults($qyOrdenDetalle);
            $qyOrdenDetalle->setFirstResult($pageStart)->setMaxResults($pageLimit);
        }
        return array($qyOrdenDetalle, $count);
    }

    
    /**
     *
     * @param array $formData
     * @param CmsOrden $oOrden
     * @param CmsProducto $oProducto
     * @return CmsOrdenDetalle 
     */
    public function save($formData, $oOrden = null, $oProducto = null) {
        try {
            
            $newRegister = false;
            $subioArchivo = false;
            
            if (!$oOrden instanceof \CmsOrden)
                $oOrden = $this->_em->find("\CmsOrden", $formData['idOrden'] );
            if(!$oOrden)
                throw new \Exception('No existe Orden.',1);
            
            if (!$oProducto instanceof \CmsProducto)
                $oProducto = $this->_em->find("\CmsProducto", $formData['idproducto'] );
            if(!$oProducto)
                throw new \Exception('No existe Producto.',1);
            
            
            if (is_numeric($formData['idOrdenDetalle']) ) {
                $oOrdenDetalle = $this->_em->find("\CmsOrdenDetalle", $formData['idOrdenDetalle'] );
            } else {
                $oOrdenDetalle = new CmsOrdenDetalle();
                $newRegister = true;
            }
                
            $oOrdenDetalle->setCantidad($formData['cantidad']);
            $oOrdenDetalle->setOrden($oOrden);
            $oOrdenDetalle->setProducto($oProducto);
            $oOrdenDetalle->setPrecioTotal($formData['precioTotal']);
            $oOrdenDetalle->setPrecioUnitario($formData['precioUnitario']);
            $oOrdenDetalle->setProductoNombre(isset($formData['tituloConte'])?$formData['tituloConte']:$oProducto->getTituloConte());
//            $oOrdenDetalle->setFechaModificacion( new \DateTime() );
            $this->_em->persist($oOrdenDetalle);
            $this->_em->flush();
            return $oOrdenDetalle;
        } catch(\Exception $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            throw new \Exception('Error al guardar registro dirección.',1);
        }
    }
    
    public function delete($idRegistro) {
        try {
            $oOrdenDetalle = $this->_em->find('\CmsOrdenDetalle',$idRegistro);
            if(!$oOrdenDetalle) 
                throw new \Exception("No exite OrdenDetalle con el ID ".$idRegistro .".",2);
            @unlink($this->_pathOrdenDetalle . trim($oOrdenDetalle->getFoto()));
            $this->_em->remove($oOrdenDetalle);
            $this->_em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de eliminar el OrdenDetalle.",1);
        }
    }


    public function getById($id, $asArray=true) {
        $dqlList = 'SELECT c FROM \CmsOrdenDetalle c WHERE c.idOrdenDetalle = ?1';
        $qyOrdenDetalle = $this->_em->createQuery($dqlList);
        $qyOrdenDetalle->setParameter(1,$id);
        if ($asArray) {
            $oOrdenDetalle = $qyOrdenDetalle->getArrayResult();
            $objRecords = \Tonyprr_lib_Records::getInstance();
            if (count($oOrdenDetalle) != 1)
                throw new \Exception('No existe este registro.',1);
            $objRecords->normalizeRecord($oOrdenDetalle[0]);
            $oOrdenDetalle = $oOrdenDetalle[0];
        } else {
            $oOrdenDetalle = $qyOrdenDetalle->getSingleResult();
        }
        return $oOrdenDetalle;
    }
    
    /**
     *
     * @param CmsOrdenDetalle $oOrden
     * @param boolean $asArray
     * @return mixed 
     */
    public function getDirPrinDespacho($oOrden, $asArray=true) {
        $dqlList = 'SELECT d.idOrdenDetalle,d.dirprinDespacho,d.direccion,td.idTipoDireccion,p.idPais 
                    FROM \CmsOrdenDetalle d JOIN d.tipoDireccion td JOIN d.pais p 
                    WHERE d.dirprinDespacho = 1 AND d.estado=1 AND d.cliente=?1';//dirprinDespacho
        $qyOrdenDetalle = $this->_em->createQuery($dqlList);
        $qyOrdenDetalle->setParameter(1,$oOrden);
        if ($asArray) {
            $oOrdenDetalle = $qyOrdenDetalle->getArrayResult();//getScalarResult
            $objRecords = \Tonyprr_lib_Records::getInstance();
            if (count($oOrdenDetalle) != 1)
                return null;
            $objRecords->normalizeRecord($oOrdenDetalle[0]);
            $oOrdenDetalle = $oOrdenDetalle[0];
        } else {
            try {
                $oOrdenDetalle = $qyOrdenDetalle->getSingleResult();
            } catch (\Doctrine\ORM\NoResultException $e) {
                return null;
            }
        }
        return $oOrdenDetalle;
    }
    
    /**
     *
     * @param CmsOrden $oOrden
     * @param boolean $asArray
     * @return CmsOrdenDetalle
     */
//    public function getDirPorTipo($oOrden, $tipo_dir, $asArray=true) {
//        if ($asArray) {
//        $dqlList = 'SELECT d.idOrdenDetalle,d.direccion,td.idTipoDireccion,d.dirDespacho,d.dirFactura,d.estado,p.idPais
//                    FROM \CmsOrdenDetalle d JOIN d.tipoDireccion td JOIN d.pais p
//                    WHERE d.estado=1 AND d.cliente=?1';//dirprinDespacho
//        } else {
//            $dqlList = 'SELECT d FROM \CmsOrdenDetalle d WHERE d.estado=1 AND d.cliente=?1';
//        }
//        if ($tipo_dir == 1) {
//            $dqlList .= ' AND d.dirDespacho = 1';
//        } else if ($tipo_dir == 2) {
//            $dqlList .= ' AND d.dirFactura = 1';
//        } else {
//            $dqlList .= ' AND d.dirFactura = 0';
//        }
//        
//        $qyOrdenDetalle = $this->_em->createQuery($dqlList);
//        $qyOrdenDetalle->setParameter(1,$oOrden);
//        if ($asArray) {
//            $oOrdenDetalle = $qyOrdenDetalle->getArrayResult();//getScalarResult
//            $objRecords = \Tonyprr_lib_Records::getInstance();
//            if (count($oOrdenDetalle) != 1)
//                return null;
//            $objRecords->normalizeRecord($oOrdenDetalle[0]);
//            $oOrdenDetalle = $oOrdenDetalle[0];
//        } else {
//            try {
//                $oOrdenDetalle = $qyOrdenDetalle->getSingleResult();
//            } catch (\Doctrine\ORM\NoResultException $e) {
//                return null;
//            }
//        }
//        return $oOrdenDetalle;
//    }
//    
    
}

?>
