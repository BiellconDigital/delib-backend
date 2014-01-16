<?php
namespace Dao\Cart;

//use Models\CmsOrden;
use Vendors\Paginate\Paginate;

/**
 * Clase Dao para el manejo de Marcas de Orden
 *
 * @author aramosr
 */
class OrdenEstado {
    /**
     *
     * @var \Doctrine\ORM\EntityManager 
     */
    private $_em;
    public static $PENDIENTE_CANCELAR = 1;
    public static $PENDIENTE_VERIFICAR = 2;
    public static $CANCELADO = 3;
    public static $ANULADO = 4;

    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
    }
    
    public function listRecords($estado="TODOS", $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        $count= 0;
        if (!$oLanguage instanceof \CmsLanguage)
            $oLanguage = $this->_em->getRepository("CmsLanguage")->findOneByidLanguage($oLanguage);
        
        $qbOrden = $this->_em->createQueryBuilder();
        $qbOrden->select(
                    '
                    oe.idOrdenEstado,oe.activo,oe.color,oe.envioEmail,
                    oel.nombre,oel.detalle
                    ')->from('\CmsOrdenEstado','oe')->innerJoin("oe.languages", "oel")
                    ->where("oel.language = :lang")->setParameter("lang", $oLanguage)
                   ->orderBy('oe.idOrdenEstado','ASC');
        if ($estado != "TODOS") $qbOrden->andWhere('oe.activo = :estado')->setParameter('estado', $estado);
        $qyOrden = $qbOrden->getQuery();
        if ($pageStart!= NULL and $pageLimit!=NULL) {
            $count = Paginate::getTotalQueryResults($qyOrden);
            $qyOrden->setFirstResult($pageStart)->setMaxResults($pageLimit);
        }
        return array($qyOrden, $count);
    }

    public function getById($id, $asArray=true) {
        $dqlList = 'SELECT c FROM \CmsOrdenEstado c WHERE c.idOrdenEstado = ?1';
        $qyOrden = $this->_em->createQuery($dqlList);
        $qyOrden->setParameter(1,$id);
        if ($asArray) {
            $oOrdenEstado = $qyOrden->getArrayResult();
            $objRecords = \Tonyprr_lib_Records::getInstance();
            if (count($oOrdenEstado) != 1)
                throw new \Exception('No existe este registro.',1);
            $objRecords->normalizeRecord($oOrdenEstado[0]);
            $oOrdenEstado = $oOrdenEstado[0];
        } else {
            $oOrdenEstado = $qyOrden->getSingleResult();
        }
        return $oOrdenEstado;
    }
    
}

?>
