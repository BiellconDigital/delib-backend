<?php
namespace Dao\Cart;

use CmsOrden;
use CmsCliente;
use CmsMoneda;
use CmsOrdenEstado;
use CmsOrdenDetalle;
use Vendors\Paginate\Paginate;

/**
 * Clase Dao para el manejo de Marcas de Orden
 *
 * @author aramosr
 */
class Orden {
    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em;
    private $_pathOrden;

    public function __construct() {
        $this->_em = \Zend_Registry::get('em');
        $this->_pathOrden = PTH_FILES . DS . "orden" . DS;
    }
    
    public function listRecords($ordenEstado=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        $count= 0;
        if (!$oLanguage instanceof \CmsLanguage)
            $oLanguage = $this->_em->getRepository("CmsLanguage")->findOneByidLanguage($oLanguage);
        
        $qbOrden = $this->_em->createQueryBuilder();
        $qbOrden->select(
                    "o.idOrden,o.tipoDocumento,o.direccionEnvio,o.direccionPago,o.personaRecepcion,
                     o.subTotal,o.totalImpuesto,o.impuestoRatio,o.total,o.totalDescuento,o.totalFinal,o.costoEnvio,
                     o.cuentaBanco,o.fechaProcesado,o.fechaEnvio,o.horaEnvio,o.fechaModificado,
                     o.codigoVoucher,o.nroFactura,o.fechaDeposito,o.horaDeposito,o.rucCliente,o.razonSocial
                     ,c.idCliente,CONCAT(CONCAT(CONCAT(CONCAT(c.nombres,' '),c.apellidoPaterno),' '),c.apellidoMaterno) as nombre_cliente
                     ,m.idMoneda,m.signo
                     ,oe.idOrdenEstado,oel.nombre as nombre_estado
                     ,CONCAT(CONCAT(CONCAT(CONCAT(ou.dpto,' - '),ou.prov),' - '),ou.dist) as distritoEnvio
                    ")->from('\CmsOrden','o')
                    ->innerJoin('o.cliente','c')->innerJoin('o.moneda','m')->innerJoin('o.ordenEstado','oe')
                    ->innerJoin("oe.languages", "oel")->leftJoin("o.ubigeo", "ou")
                    ->where("oel.language = :lang")->setParameter("lang", $oLanguage)
                   ->orderBy('o.fechaProcesado','DESC');
        if ($ordenEstado != NULL) $qbOrden->andWhere('p.ordenEstado = :estado')->setParameter('estado', $ordenEstado);
        $qyOrden = $qbOrden->getQuery();//,c.apellidoPaterno,' ',c.apellidoMaterno
        if ($pageStart!= NULL and $pageLimit!=NULL) {
            $count = Paginate::getTotalQueryResults($qyOrden);
            $qyOrden->setFirstResult($pageStart)->setMaxResults($pageLimit);
        }
        return array($qyOrden, $count);
    }

    /**
     *
     * @param CmsCliente $oCliente
     * @param CmsOrdenEstado $ordenEstado
     * @param int $pageStart
     * @param int $pageLimit
     * @return array 
     */
    public function listRecordsXCliente($oCliente, $ordenEstado=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        $count= 0;
        if (!$oLanguage instanceof \CmsLanguage)
            $oLanguage = $this->_em->getRepository("CmsLanguage")->findOneByidLanguage($oLanguage);
        
        $qbOrden = $this->_em->createQueryBuilder();
        $qbOrden->select(
                    "o.idOrden,o.tipoDocumento,o.direccionEnvio,o.direccionPago,o.personaRecepcion,
                     o.subTotal,o.totalImpuesto,o.impuestoRatio,o.total,o.totalDescuento,o.totalFinal,o.costoEnvio,
                     o.cuentaBanco,o.fechaProcesado,o.fechaEnvio,o.horaEnvio,o.fechaModificado,
                     o.codigoVoucher,o.nroFactura,o.fechaDeposito,o.horaDeposito
                     ,m.idMoneda,m.signo
                     ,oe.idOrdenEstado,oel.nombre as nombre_estado
                    ")->from('\CmsOrden','o')
                    ->innerJoin('o.moneda','m')->innerJoin('o.ordenEstado','oe')
                    ->innerJoin("oe.languages", "oel")
                    ->where("oel.language = ?1 AND o.cliente = ?2")
                    ->setParameter(1, $oLanguage)->setParameter(2, $oCliente);
//        ->orderBy('o.fechaProcesado','DESC')
        if ($ordenEstado != NULL) $qbOrden->andWhere('o.ordenEstado = ?3')->setParameter(3, $ordenEstado);
        $qyOrden = $qbOrden->getQuery();//,c.apellidoPaterno,' ',c.apellidoMaterno
        if ($pageStart!= NULL and $pageLimit!=NULL) {
            $count = Paginate::getTotalQueryResults($qyOrden);
            $qyOrden->setFirstResult($pageStart)->setMaxResults($pageLimit);
        }
        return array($qyOrden, $count);
    }

    
    /**
     *
     * @param array $formData
     * @return CmsOrden $oOrden
     */
    public function save($formData) {
        try {
            
            $newRegister = false;
            $subioArchivo = false;
            
            if (is_numeric($formData['idOrden']) ) {
                $oOrden = $this->_em->find("\CmsOrden", $formData['idOrden'] );
            }
            else {
                $oOrden = new CmsOrden();
                $newRegister = true;
                $oOrden->setFechaProcesado( new \DateTime() );
            }

            $oCliente = $this->_em->find("\CmsCliente", $formData['idCliente'] );
            if(!$oCliente)
                throw new \Exception('No existe cliente.',1);
                
            $oMoneda = $this->_em->find("\CmsMoneda", $formData['idMoneda'] );
            if(!$oMoneda)
                throw new \Exception('No existe moneda.',1);
                
            $oOrdenEstado = $this->_em->find("\CmsOrdenEstado", $formData['idOrdenEstado'] );
            if(!$oOrdenEstado)
                throw new \Exception('No existe el estado de orden de compra.',1);
                
            $oUbigeo = $this->_em->find("\CmsUbigeo", $formData['codPostal'] );
            if(!$oUbigeo)
                throw new \Exception('No existe ubigeo.', 1);
            
            $oOrden->setCliente($oCliente);
            $oOrden->setDireccionEnvio($formData['direccionEnvio']);
            $oOrden->setUbigeo($oUbigeo);
            $oOrden->setDireccionPago($formData['direccionPago']);
            $oOrden->setPersonaRecepcion($formData['personaRecepcion']);
//            $oOrden->setFechaEnvio($formData['fechaEnvio']);
            $oOrden->setHoraEnvio($formData['horaEnvio']);
            $oOrden->setImpuestoRatio($formData['impuestoRatio']);
            $oOrden->setMoneda($oMoneda);
            $oOrden->setOrdenEstado($oOrdenEstado);
            $oOrden->setSubTotal($formData['subTotal']);
            $oOrden->setTotal($formData['total']);
            $oOrden->setTotalDescuento($formData['totalDescuento']);
            $oOrden->setTotalFinal($formData['totalFinal']);
            $oOrden->setTotalImpuesto($formData['totalImpuesto']);
            $oOrden->setCostoEnvio($formData['costoEnvio']);
            $oOrden->setTipoDocumento($formData['tipoDocumento']);
            $oOrden->setCuentaBanco($formData['cuentaBanco']);
            if(isset ($formData['rucCliente']))
                $oOrden->setRucCliente ($formData['rucCliente']);
            if(isset ($formData['razonSocial']))
                $oOrden->setRazonSocial ($formData['razonSocial']);
//            $oOrden->setFechaModificacion( new \DateTime() );
            $this->_em->persist($oOrden);
            $this->_em->flush();
            return $oOrden;
        } catch(\Exception $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            throw new \Exception('Error al guardar registro Orden.',1);
        }
    }
    

    /**
     *
     * @param array $formData
     * @return CmsOrden $oOrden
     */
    public function registrarPago($formData) {
        try {
//                $oOrden = new CmsOrden();
            $oOrden = $this->_em->find("\CmsOrden", $formData['idOrden'] );
            if(!$oOrden)
                throw new \Exception('No existe orden de compra.',1);
                
            $daoOrdenEstado = new OrdenEstado();
            $oOrdenEstado = $daoOrdenEstado->getById(OrdenEstado::$PENDIENTE_VERIFICAR, false);
            $oOrden->setOrdenEstado($oOrdenEstado);
            $oOrden->setCodigoVoucher($formData['codigoVoucher']);
            $oOrden->setFechaDeposito(new \DateTime($formData['fechaDeposito']));
            $oOrden->setHoraDeposito($formData['horaDeposito']);
//            $oOrden->setFechaModificado( new \DateTime() );
            $this->_em->persist($oOrden);
            $this->_em->flush();
            return $oOrden;
            
        } catch(\Exception $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            throw new \Exception('Error al guardar registro Orden.',1);
        }
    }
    
    
    public function getById($id, $asArray=true, $oCliente=NULL) {
        $dqlList = 'SELECT o FROM \CmsOrden o WHERE o.idOrden = ?1';
        if($oCliente != NULL) $dqlList .= ' AND o.cliente = ?2';
        
        $qyOrden = $this->_em->createQuery($dqlList);
        $qyOrden->setParameter(1,$id);
        if($oCliente != NULL) $qyOrden->setParameter(2, $oCliente);
        
        if ($asArray) {
            $oOrden = $qyOrden->getArrayResult();
            $objRecords = \Tonyprr_lib_Records::getInstance();
            if (count($oOrden) != 1)
                throw new \Exception('No existe este registro.',1);
            $objRecords->normalizeRecord($oOrden[0]);
            $oOrden = $oOrden[0];
        } else {
            $oOrden = $qyOrden->getSingleResult();
        }
        return $oOrden;
    }
    

    /**
     *
     * @param CmsCliente $oCliente
     * @param CmsOrdenEstado $oOrdenEstado
     * @param boolean $asArray
     * @return CmsOrden
     */
    public function getUltimaOrden($oCliente, $oOrdenEstado=NULL, $asArray=true) {
            $dqlList = 'SELECT o FROM \CmsOrden o WHERE o.cliente = ?1';
            if($oOrdenEstado != NULL) $dqlList .= ' AND o.ordenEstado = ?2';
            $dqlList .= " ORDER BY o.fechaProcesado DESC, o.idOrden DESC";
            $qyOrden = $this->_em->createQuery($dqlList)->setMaxResults(1);
            $qyOrden->setParameter(1,$oCliente);
            if($oOrdenEstado != NULL) $qyOrden->setParameter(2, $oOrdenEstado);

            if ($asArray) {
                $oOrden = $qyOrden->getArrayResult();
                $objRecords = \Tonyprr_lib_Records::getInstance();
                if (count($oOrden) != 1)
                    throw new \Exception('No existe un registro pendiente de confirmación de pago.',10);
                $objRecords->normalizeRecord($oOrden[0]);
                $oOrden = $oOrden[0];
            } else {
                try {
                    $oOrden = $qyOrden->getSingleResult();
                } catch(\Doctrine\ORM\NoResultException $e) {
                    throw new \Exception('No existe un registro pendiente de confirmación de pago.',10);
                }
            }
            return $oOrden;
    }
    
    /**
     *
     * @param CmsCliente $oCliente
     * @param CmsOrdenEstado $oOrdenEstado
     * @param boolean $asArray
     * @return CmsOrden
     */
    public function getPrimeraOrden($oCliente, $oOrdenEstado=NULL, $asArray=true) {
            $dqlList = 'SELECT o FROM \CmsOrden o WHERE o.cliente = ?1';
            if($oOrdenEstado != NULL) $dqlList .= ' AND o.ordenEstado = ?2';
            $dqlList .= " ORDER BY o.fechaProcesado ASC, o.idOrden ASC";
            $qyOrden = $this->_em->createQuery($dqlList)->setMaxResults(1);
            $qyOrden->setParameter(1,$oCliente);
            if($oOrdenEstado != NULL) $qyOrden->setParameter(2, $oOrdenEstado);

            if ($asArray) {
                $oOrden = $qyOrden->getArrayResult();
                $objRecords = \Tonyprr_lib_Records::getInstance();
                if (count($oOrden) != 1)
                    throw new \Exception('No existe un registro pendiente de confirmación de pago.',10);
                $objRecords->normalizeRecord($oOrden[0]);
                $oOrden = $oOrden[0];
            } else {
                try {
                    $oOrden = $qyOrden->getSingleResult();
                } catch(\Doctrine\ORM\NoResultException $e) {
                    throw new \Exception('No existe un registro pendiente de confirmación de pago.',10);
                }
            }
            return $oOrden;
    }
    

    /**
     *
     * @param array $formData
     * @return CmsOrden 
     */
    public function cambiarEstado($formData) {
        try {
            $this->_em->getConnection()->beginTransaction();
            $daoOrdenEstado = new OrdenEstado();
//            $oOrden = new CmsOrden();
            $oOrden = $this->_em->find("\CmsOrden", $formData['idOrden'] );
            if(!$oOrden)
                throw new \Exception('No existe orden de compra.',1);
            
            if ($oOrden->getOrdenEstado()->getIdOrdenEstado()  == OrdenEstado::$CANCELADO)
                throw new \Exception('La Orden ya esta procesada.', 1);

            if ($oOrden->getOrdenEstado()->getIdOrdenEstado()  == OrdenEstado::$PENDIENTE_CANCELAR) {
                if ($formData['idOrdenEstado'] == OrdenEstado::$CANCELADO)
                    throw new \Exception('El pago no puede ser confirmado si no ha verificado el ingreso del Vaucher.', 1);
            }
            
            $oOrdenEstado = $daoOrdenEstado->getById($formData['idOrdenEstado'], false);
            
            
            if ($formData['idOrdenEstado'] == OrdenEstado::$CANCELADO) {
                foreach ($oOrden->getDetalle() as $oOrdenDetalle) {
//                    if (!$oOrdenDetalle instanceof \CmsOrdenDetalle)
                    $dataMov['cantidad'] = $oOrdenDetalle->getCantidad();
                    $dataMov['idMovimientoStockTipo'] = \Dao\Cart\MovimientoStockTipo::$MOVIMIENTO_VENTA;
                    $dataMov['idMovimientoStock'] =  '';
                    $daoMovientoStock = new MovimientoStock();
                    $daoMovientoStock->save($dataMov, $oOrdenDetalle->getProducto(), $oOrden);
                }
                $oOrden->setOrdenEstado($oOrdenEstado);
                $oOrden->setNroFactura($formData['nroFactura']);
    //            $oOrden->setFechaModificado( new \DateTime() );
                $this->_em->persist($oOrden);
                $this->_em->flush();
                $this->notificarPagoConfirmado($oOrden);
            } else if ($formData['idOrdenEstado'] == OrdenEstado::$ANULADO) {
                $this->_em->remove($oOrden);
                $this->_em->flush();
            }
            
            $this->_em->getConnection()->commit();
            return $oOrden;
        } catch(\Exception $e) {
            $this->_em->getConnection()->rollBack();
            $this->_em->close();
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            throw new \Exception('Error al guardar registro Orden. ', 1);
        }
    }
    
    public function notificarRegistroOrden(\CmsOrden $oOrden) {
        try {
            $objEmail = new \Tonyprr_Email();
            $total = $oOrden->getCostoEnvio() + $oOrden->getTotalFinal();
            $mensaje = "Se ha generado un nuevo pedido: <br/><br/>";
            $mensaje .= "Nro. Orden: " . $oOrden->getIdOrden() ."<br/>";
            $mensaje .= "Combo: " . $oOrden->getDireccionPago() ."<br/>";
            $mensaje .= "Cliente: " . $oOrden->getCliente()->getNombres() . " " . $oOrden->getCliente()->getApellidoPaterno() . " " . $oOrden->getCliente()->getApellidoMaterno() . "<br/>";
            $mensaje .= "Costo del Combo: S/. " . $oOrden->getTotalFinal() ."<br/>";
            $mensaje .= "Costo de Envío: S/. " . $oOrden->getCostoEnvio() ."<br/>";
            $mensaje .= "Costo Total: S/. " . $total ."<br/>";
            
            $objEmail->setBodyHtml($objEmail->convertString($mensaje));
            $objEmail->setFrom($objEmail->getAccount(), $objEmail->convertString($objEmail->getName()) );
            $objEmail->addTo(EMAIL_VENTAS);//ventas.online@mpf.com.pe
            $objEmail->setSubject($objEmail->convertString("Notificación - Registro de Orden de Compra"));
            $objEmail->send($objEmail->getMailTrans());

        } catch(\Exception $e) {
            throw new \Exception('Ocurrió un error en el envío de notificación del pedido.', 1);
        }
    }
    
    public function notificarRegistroPagoOrden(\CmsOrden $oOrden) {
        try {
            $objEmail = new \Tonyprr_Email();
            $fechaDeposito = null;
            if(!is_null($oOrden->getFechaDeposito()))
                $fechaDeposito = $oOrden->getFechaDeposito()->format("d-m-Y");
            $total = $oOrden->getCostoEnvio() + $oOrden->getTotalFinal();
            $mensaje = "El Cliente ha registrado el pago ingresando el Número de Vaucher, la fecha y la hora de envío.<br/>
                        Proceda a verificar la Orden:<br/>";
            $mensaje .= "Nro. Orden: " . $oOrden->getIdOrden() ."<br/>";
            $mensaje .= "Combo: " . $oOrden->getDireccionPago() ."<br/>";
            $mensaje .= "Cliente: " . $oOrden->getCliente()->getNombres() . " " . $oOrden->getCliente()->getApellidoPaterno() . " " . $oOrden->getCliente()->getApellidoMaterno() . "<br/>";
            $mensaje .= "Vaucher: " . $oOrden->getCodigoVoucher() ."<br/>";
            $mensaje .= "Fecha de Deposito: " . $fechaDeposito ."<br/>";
            $mensaje .= "Hora de Deposito: " . $oOrden->getHoraDeposito() ."<br/>";
            $mensaje .= "Costo del Combo: S/. " . $oOrden->getTotalFinal() ."<br/>";
            $mensaje .= "Costo de Envío: S/. " . $oOrden->getCostoEnvio() ."<br/>";
            $mensaje .= "Costo Total: S/. " . $total ."<br/>";
            
            $objEmail->setBodyHtml($objEmail->convertString($mensaje));
            $objEmail->setFrom($objEmail->getAccount(), $objEmail->convertString($objEmail->getName()) );
            $objEmail->addTo(EMAIL_VENTAS);//ventas.online@mpf.com.pe
            $objEmail->setSubject($objEmail->convertString("Notificación - Registro de Orden de Compra"));
            $objEmail->send($objEmail->getMailTrans());

        } catch(\Exception $e) {
            throw new \Exception('Ocurrió un error en el envío de notificación del pedido.', 1);
        }
    }
    
    public function notificarPagoConfirmado(\CmsOrden $oOrden) {
        try {
//            $tranlate = new \Zend_Translate();
            $tranlate =  \Zend_Registry::get('Zend_Translate');
            $localeClie = $oOrden->getCliente()->getLanguage()->getNombreCorto();
            $mensaje =  $tranlate->getAdapter()->translate("MsgConfir_content", $localeClie) . "<br/>";
            $nroOrden =  $tranlate->getAdapter()->translate("CodigoOrden", $localeClie);
            $nroOperacion =  $tranlate->getAdapter()->translate("NroOperacion", $localeClie);
            $dFechaHoraDeposito =  $tranlate->getAdapter()->translate("Pago_DateTimeDep", $localeClie);
            $montoTotal =  $tranlate->getAdapter()->translate("MontoTotal", $localeClie);
            
            $objEmail = new \Tonyprr_Email();
            $fechaDeposito = null;
            if(!is_null($oOrden->getFechaDeposito()))
                $fechaDeposito = $oOrden->getFechaDeposito()->format("d-m-Y");
            $total = $oOrden->getCostoEnvio() + $oOrden->getTotalFinal();
            $mensaje .= $nroOrden . ": " . $oOrden->getIdOrden() ."<br/>";
            $mensaje .= "Combo: " . $oOrden->getDireccionPago() ."<br/>";
            $mensaje .= $nroOperacion . ": " . $oOrden->getCodigoVoucher() ."<br/>";
            $mensaje .= $dFechaHoraDeposito . ": " . $fechaDeposito . " " . $oOrden->getHoraDeposito()  ."<br/>";
            $mensaje .= $montoTotal . ": S/. " . $total ."<br/>";
            
            $objEmail->setBodyHtml($objEmail->convertString($mensaje));
            $objEmail->setFrom($objEmail->getAccount(), $objEmail->convertString($objEmail->getName()) );
            $objEmail->addTo($oOrden->getCliente()->getEmail());//ventas.online@mpf.com.pe
            $objEmail->setSubject($objEmail->convertString("Machu Picchu Foods"));
            $objEmail->send($objEmail->getMailTrans());

        } catch(\Exception $e) {
            throw new \Exception('Ocurrió un error en el envío de notificación del confirmación de pedido.', 1);
        }
    }
    
}

?>
