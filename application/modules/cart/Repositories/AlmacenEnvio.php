<?php
namespace Dao\Cart;

use CmsAlmacen;
use CmsAlmacenEnvio;
use CmsProducto;
//use Models\CmsTipoDocumento;
//use Models\CmsPais;
use Vendors\Paginate\Paginate;

/**
 * Clase Dao para el manejo de Marcas de AlmacenEnvio
 *
 * @author aramosr
 */
class AlmacenEnvio {
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
     * @param CmsAlmacen $oAlmacen
     * @param mixed $estado
     * @param int $pageStart
     * @param int $pageLimit
     * @return mixed
     */
    public function listRecords($oAlmacen, $pageStart=NULL, $pageLimit=NULL) {
        $count= 0;
        $qbAlmacenEnvio = $this->_em->createQueryBuilder();
        $qbAlmacenEnvio->select(
                    '
                    od.idAlmacenEnvio,od.productoNombre,od.cantidad,od.precioUnitario,od.precioTotal
                    ')->from('\CmsAlmacenEnvio','od')
//                   ->innerJoin('cd.tipoDireccion','td')->innerJoin('cd.pais','pa')->innerJoin('cd.cliente','c')
                   ->orderBy('od.fechaRegistro','DESC')
                   ->where('od.orden = :orden')->setParameter('orden', $oAlmacen);
        $qyAlmacenEnvio = $qbAlmacenEnvio->getQuery();//,pa.nombre as nombre_pais
        
        if ($pageStart!= NULL and $pageLimit!=NULL) {
            $count = Paginate::getTotalQueryResults($qyAlmacenEnvio);
            $qyAlmacenEnvio->setFirstResult($pageStart)->setMaxResults($pageLimit);
        }
        return array($qyAlmacenEnvio, $count);
    }

    
    /**
     *
     * @param array $formData
     * @param CmsAlmacen $oAlmacen
     * @param CmsProducto $oProducto
     * @return CmsAlmacenEnvio 
     */
    public function save($formData, $oAlmacen = null, $oProducto = null) {
        try {
            
            $newRegister = false;
            $subioArchivo = false;
            
            if (!$oAlmacen instanceof \CmsAlmacen)
                $oAlmacen = $this->_em->find("\CmsAlmacen", $formData['idAlmacen'] );
            if(!$oAlmacen)
                throw new \Exception('No existe Almacen.',1);
            
            if (!$oProducto instanceof \CmsProducto)
                $oProducto = $this->_em->find("\CmsProducto", $formData['idproducto'] );
            if(!$oProducto)
                throw new \Exception('No existe Producto.',1);
            
            
            if (is_numeric($formData['idAlmacenEnvio']) ) {
                $oAlmacenEnvio = $this->_em->find("\CmsAlmacenEnvio", $formData['idAlmacenEnvio'] );
            } else {
                $oAlmacenEnvio = new CmsAlmacenEnvio();
                $newRegister = true;
            }
                
            $oAlmacenEnvio->setCantidad($formData['cantidad']);
            $oAlmacenEnvio->setAlmacen($oAlmacen);
            $oAlmacenEnvio->setProducto($oProducto);
            $oAlmacenEnvio->setPrecioTotal($formData['precioTotal']);
            $oAlmacenEnvio->setPrecioUnitario($formData['precioUnitario']);
            $oAlmacenEnvio->setProductoNombre(isset($formData['tituloConte'])?$formData['tituloConte']:$oProducto->getTituloConte());
//            $oAlmacenEnvio->setFechaModificacion( new \DateTime() );
            $this->_em->persist($oAlmacenEnvio);
            $this->_em->flush();
            return $oAlmacenEnvio;
        } catch(\Exception $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            throw new \Exception('Error al guardar registro dirección.',1);
        }
    }
    
    public function delete($idRegistro) {
        try {
            $oAlmacenEnvio = $this->_em->find('\CmsAlmacenEnvio',$idRegistro);
            if(!$oAlmacenEnvio) 
                throw new \Exception("No exite AlmacenEnvio con el ID ".$idRegistro .".",2);
            @unlink($this->_pathAlmacenEnvio . trim($oAlmacenEnvio->getFoto()));
            $this->_em->remove($oAlmacenEnvio);
            $this->_em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de eliminar el AlmacenEnvio.",1);
        }
    }

    /**
     * 
     * @param mixed $oAlmacen
     * @param mixed $oUbigeo
     * @return \CmsAlmacenEnvio
     * @throws \Exception
     */
    public function getByAlmacenDestino($oAlmacen, $oUbigeo) {
        try {
            if (!$oAlmacen instanceof \CmsAlmacen) {
                $oAlmacen = $this->_em->getRepository("\CmsAlmacen")->findOneBy(array("idAlmacen" => $oAlmacen));
            }
            if (!$oUbigeo instanceof \CmsUbigeo) {
                $oUbigeo = $this->_em->getRepository("\CmsUbigeo")->findOneBy(array("codPostal" => $oUbigeo));
            }
            $oAlmacenEnvio = $this->_em->getRepository("\CmsAlmacenEnvio")->findOneBy(array("almacen" => $oAlmacen,"ubigeo" => $oUbigeo));
            return $oAlmacenEnvio;
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de consulta de destino por almacen.", 1);
        }
    }
    
    
}

?>
