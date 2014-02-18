<?php

namespace cart\Repositories;

use Doctrine\ORM\EntityRepository;
use Vendors\Paginate\Paginate;

/**
 * CartOrdenRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CartOrdenRepository extends EntityRepository
{
    public function listRecords($ordenEstado=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        $count= 0;
        if (!$oLanguage instanceof \web\Entity\CmsLanguage)
            $oLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findOneByidLanguage($oLanguage);
        
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
                    ")->from($this->_entityName, 'o')
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
     * @param \cart\Entity\CartOrdenEstado $ordenEstado
     * @param int $pageStart
     * @param int $pageLimit
     * @return array 
     */
    public function listRecordsXCliente($oCliente, $ordenEstado=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        $count= 0;
        if (!$oLanguage instanceof \web\Entity\CmsLanguage)
            $oLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findOneByidLanguage($oLanguage);
        
        $qbOrden = $this->_em->createQueryBuilder();
        $qbOrden->select(
                    "o.idOrden,o.tipoDocumento,o.direccionEnvio,o.direccionPago,o.personaRecepcion,
                     o.subTotal,o.totalImpuesto,o.impuestoRatio,o.total,o.totalDescuento,o.totalFinal,o.costoEnvio,
                     o.cuentaBanco,o.fechaProcesado,o.fechaEnvio,o.horaEnvio,o.fechaModificado,
                     o.codigoVoucher,o.nroFactura,o.fechaDeposito,o.horaDeposito
                     ,m.idMoneda,m.signo
                     ,oe.idOrdenEstado,oel.nombre as nombre_estado
                    ")->from($this->_entityName, 'o')
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
     * @param CmsCliente $oCliente
     * @param \cart\Entity\CartOrdenEstado $ordenEstado
     * @param int $pageStart
     * @param int $pageLimit
     * @return array 
     */
    public function listRecordsXClienteThumb($oCliente, $ordenEstado=NULL, $oLanguage=1, $pageStart=NULL, $pageLimit=NULL) {
        $count= 0;
        if (!$oCliente instanceof \web\Entity\CmsCliente)
            $oCliente = $this->_em->getRepository("\web\Entity\CmsCliente")->find($oCliente);
        
        if (!$oLanguage instanceof \web\Entity\CmsLanguage)
            $oLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findOneByidLanguage($oLanguage);
        
        $qbOrden = $this->_em->createQueryBuilder();
        $qbOrden->select( array(
                    "o.idOrden,o.tipoDocumento,o.total,o.fechaProcesado
                     ,m.idMoneda,m.signo,oe.idOrdenEstado,oel.nombre as nombre_estado,
                     od.productoNombre,odp.imagen
                    ",
                    //select("MIN(od.idOrdenDetalle) as idOrden, od.productoNombre")->from("cart\Entity\CartOrdenDetalle", "od")
                        
                    ))->from($this->_entityName, 'o')
                    ->innerJoin('o.moneda','m')->innerJoin('o.ordenEstado','oe')//,od.productoNombre,odp.imagen ->where("od.orden = o")
                    ->innerJoin("oe.languages", "oel")
                    ->leftJoin("o.detalle", "od")//, \Doctrine\ORM\Query\Expr\Join::WITH, "o = od.orden and MIN(od.idOrdenDetalle) > 0" )
                    ->leftJoin("od.producto", "odp")
                    ->where("oel.language = ?1 AND o.cliente = ?2")
                    ->setParameter(1, $oLanguage)->setParameter(2, $oCliente)
                    ->andWhere($qbOrden->expr()->in("od.idOrdenDetalle", "select MIN(odt.idOrdenDetalle) as idOrdenDetalle from cart\Entity\CartOrdenDetalle odt where odt.orden = o"));
//                    ->having($qbOrden->expr()->min("od.idOrdenDetalle") . " > 0");

        if ($ordenEstado != NULL) $qbOrden->andWhere('o.ordenEstado = ?3')->setParameter(3, $ordenEstado);
//        echo $qbOrden->getDQL();
        $qyOrden = $qbOrden->getQuery();
        if ($pageStart!= NULL and $pageLimit!=NULL) {
            $count = Paginate::getTotalQueryResults($qyOrden);
            $qyOrden->setFirstResult($pageStart)->setMaxResults($pageLimit);
        }
        $resultados = $qyOrden->getArrayResult();
        $objRecords=\Tonyprr_lib_Records::getInstance();
        $objRecords->normalizeRecords($resultados);
        
        return array($resultados, $count);
    }

    
    /**
     *
     * @param array $formData
     * @return \cart\Entity\CartOrden $oOrden
     */
    public function save($formData) {
        try {
            $newRegister = false;
            $subioArchivo = false;
            
            if (is_numeric($formData['idOrden']) ) {
                $oOrden = $this->_em->find($this->_entityName, $formData['idOrden'] );
            }
            else {
                $newRegister = true;
                $oOrden = new \cart\Entity\CartOrden();
                $oOrden->setFechaProcesado( new \DateTime() );
            }

            $oCliente = $this->_em->find("\web\Entity\CmsCliente", $formData['idCliente'] );
            if(!$oCliente)
                throw new \Exception('No existe cliente.',1);
                
            $oMoneda = $this->_em->find("\cart\Entity\CartMoneda", $formData['idMoneda'] );
            if(!$oMoneda)
                throw new \Exception('No existe moneda.',1);
                
            $oOrdenEstado = $this->_em->find("\cart\Entity\CartOrdenEstado", $formData['idOrdenEstado'] );
            if(!$oOrdenEstado)
                throw new \Exception('No existe el estado de orden de compra.',1);
                
            $oOrdenTipo = $this->_em->find("\cart\Entity\CartOrdenTipo", $formData['idOrdenTipo'] );
            if(!$oOrdenTipo)
                throw new \Exception('No existe tipo de orden.',1);
                
            $oUbigeo = $this->_em->find("\web\Entity\CmsUbigeo", $formData['codPostal'] );
            if(!$oUbigeo)
                throw new \Exception('No existe ubigeo.', 1);
            
            $oOrden->setCliente($oCliente);
            $oOrden->setDireccionEnvio($formData['direccionEnvio']);
            $oOrden->setUbigeo($oUbigeo);
            if (isset($formData['direccionPago']))
                $oOrden->setDireccionPago($formData['direccionPago']);
            if (isset($formData['personaRecepcion']))
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
            $oOrden->setOrdenTipo($oOrdenTipo);
            $oOrden->setTipoPago($formData['tipoPago']);
            $oOrden->setAceptaPolitica($formData['aceptaPolitica']);
            
//            $oOrden->setFechaModificacion( new \DateTime() );
            $this->_em->persist($oOrden);
            $this->_em->flush();
            return $oOrden;
        } catch(\Exception $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            throw new \Exception('Error al guardar registro Orden. ' . $e->getMessage(),1);
        }
    }
    

    /**
     *
     * @param array $formData
     * @return \cart\Entity\CartOrden $oOrden
     */
    public function registrarPago($formData) {
        try {
            /**
             * \cart\Entity\CartOrden
             */
            $oOrden = $this->_em->find($this->_entityName, $formData['idOrden'] );
            if(!$oOrden)
                throw new \Exception('No existe orden de compra.', 1);

            $oOrdenEstado = $this->_em->getRepository("\cart\Entity\CartOrdenEstado")->
                    find(\cart\Repositories\CartOrdenEstadoRepository::$PENDIENTE_VERIFICAR);
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
    
    
    public function getById($id, $asArray=true, $oCliente=NULL, $oLanguage = 1) {
        
        if ($asArray) {
            if (!$oLanguage instanceof \web\Entity\CmsLanguage)
                $oLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findOneByidLanguage($oLanguage);
        
            $qbOrden = $this->_em->createQueryBuilder();
            $qbOrden->select( array("o", "m","oe","oel"))->from($this->_entityName, 'o')
/*                        "o.idOrden,o.tipoDocumento,o.total,o.fechaProcesado
                         ,m.idMoneda,m.signo,oe.idOrdenEstado,oel.nombre as nombre_estado
                        ",
  */                      
                        ->innerJoin('o.moneda','m')->innerJoin('o.ordenEstado','oe')//,od.productoNombre,odp.imagen ->where("od.orden = o")
                        ->innerJoin("oe.languages", "oel")
                        ->where("oel.language = ?1 AND o.idOrden = ?2")
                        ->setParameter(1, $oLanguage)->setParameter(2, $id);
    //                    ->having($qbOrden->expr()->min("od.idOrdenDetalle") . " > 0");

            if ($oCliente != NULL) $qbOrden->andWhere('o.cliente = ?3')->setParameter(3, $oCliente);
            $qyOrden = $qbOrden->getQuery();
            $oOrden = $qyOrden->getArrayResult();
            $objRecords = \Tonyprr_lib_Records::getInstance();
            if (count($oOrden) != 1)
                throw new \Exception('No existe este registro.',1);
            $objRecords->normalizeRecord($oOrden[0]);
            $oOrden = $oOrden[0];
        } else {
            $dqlList = 'SELECT o FROM \cart\Entity\CartOrden o WHERE o.idOrden = ?1';
            $qyOrden = $this->_em->createQuery($dqlList);
            $qyOrden->setParameter(1, $id);
            if($oCliente != NULL) $dqlList .= ' AND o.cliente = ?2';
            if($oCliente != NULL) $qyOrden->setParameter(2, $oCliente);
            $oOrden = $qyOrden->getSingleResult();
//            $oOrdenHead = \Vendors\Util\Serializor::json_encode($oOrden);
//            $oOrdenDetalle = \Vendors\Util\Serializor::json_encode($oOrden->getDetalle());
//            $this->_em->detach($oOrden);
        }
        return $oOrden;
    }
    

    /**
     *
     * @param CmsCliente $oCliente
     * @param \cart\Entity\CartOrdenEstado $oOrdenEstado
     * @param boolean $asArray
     * @return \cart\Entity\CartOrden
     */
    public function getUltimaOrden($oCliente, $oOrdenEstado=NULL, $asArray=true) {
            $dqlList = 'SELECT o FROM \cart\Entity\CartOrden o WHERE o.cliente = ?1';
            if($oOrdenEstado != NULL) $dqlList .= ' AND o.ordenEstado = ?2';
            $dqlList .= " ORDER BY o.fechaProcesado DESC, o.idOrden DESC";
            $qyOrden = $this->_em->createQuery($dqlList)->setMaxResults(1);
            $qyOrden->setParameter(1,$oCliente);
            if($oOrdenEstado != NULL) $qyOrden->setParameter(2, $oOrdenEstado);

            if ($asArray) {
                $oOrden = $qyOrden->getArrayResult();
                $objRecords = \Tonyprr_lib_Records::getInstance();
                if (count($oOrden) != 1)
                    throw new \Exception('No existe un registro pendiente de confirmaci�n de pago.',10);
                $objRecords->normalizeRecord($oOrden[0]);
                $oOrden = $oOrden[0];
            } else {
                try {
                    $oOrden = $qyOrden->getSingleResult();
                } catch(\Doctrine\ORM\NoResultException $e) {
                    throw new \Exception('No existe un registro pendiente de confirmaci�n de pago.',10);
                }
            }
            return $oOrden;
    }
    
    /**
     *
     * @param \web\Entity\CmsCliente $oCliente
     * @param \cart\Entity\CartOrdenEstado $oOrdenEstado
     * @param boolean $asArray
     * @return \cart\Entity\CartOrden
     */
    public function getPrimeraOrden($oCliente, $oOrdenEstado=NULL, $asArray=true) {
            $dqlList = 'SELECT o FROM \cart\Entity\CartOrden o WHERE o.cliente = ?1';
            if($oOrdenEstado != NULL) $dqlList .= ' AND o.ordenEstado = ?2';
            $dqlList .= " ORDER BY o.fechaProcesado ASC, o.idOrden ASC";
            $qyOrden = $this->_em->createQuery($dqlList)->setMaxResults(1);
            $qyOrden->setParameter(1,$oCliente);
            if($oOrdenEstado != NULL) $qyOrden->setParameter(2, $oOrdenEstado);

            if ($asArray) {
                $oOrden = $qyOrden->getArrayResult();
                $objRecords = \Tonyprr_lib_Records::getInstance();
                if (count($oOrden) != 1)
                    throw new \Exception('No existe un registro pendiente de confirmaci�n de pago.',10);
                $objRecords->normalizeRecord($oOrden[0]);
                $oOrden = $oOrden[0];
            } else {
                try {
                    $oOrden = $qyOrden->getSingleResult();
                } catch(\Doctrine\ORM\NoResultException $e) {
                    throw new \Exception('No existe un registro pendiente de confirmaci�n de pago.',10);
                }
            }
            return $oOrden;
    }
    

    /**
     *
     * @param array $formData
     * @return \cart\Entity\CartOrden 
     */
    public function cambiarEstado($formData) {
        try {
            $this->_em->getConnection()->beginTransaction();
            $daoOrdenEstado = new OrdenEstado();
//            $oOrden = new \cart\Entity\CartOrden();
            $oOrden = $this->_em->find("\cart\Entity\CartOrden", $formData['idOrden'] );
            if(!$oOrden)
                throw new \Exception('No existe orden de compra.',1);
            
            if ($oOrden->getOrdenEstado()->getIdOrdenEstado()  == \cart\Repositories\CartOrdenEstadoRepository::$CANCELADO)
                throw new \Exception('La Orden ya esta procesada.', 1);

            if ($oOrden->getOrdenEstado()->getIdOrdenEstado()  == \cart\Repositories\CartOrdenEstadoRepository::$PENDIENTE_CANCELAR) {
                if ($formData['idOrdenEstado'] == \cart\Repositories\CartOrdenEstadoRepository::$CANCELADO)
                    throw new \Exception('El pago no puede ser confirmado si no ha verificado el ingreso del Vaucher.', 1);
            }
            
            $oOrdenEstado = $this->_em->getRepository("\cart\Entity\CartOrdenEstado")->find($formData['idOrdenEstado']);
            
            if ($formData['idOrdenEstado'] == \cart\Repositories\CartOrdenEstadoRepository::$CANCELADO) {
                foreach ($oOrden->getDetalle() as $oOrdenDetalle) {
//                    if (!$oOrdenDetalle instanceof \\cart\Entity\CartOrdenDetalle)
                    $dataMov['cantidad'] = $oOrdenDetalle->getCantidad();
                    $dataMov['idMovimientoStockTipo'] = \cart\Repositories\CartMovimientoStockTipoRepository::$MOVIMIENTO_VENTA;
                    $dataMov['idMovimientoStock'] =  '';
                    
                    $movientoStockService = new \cart\Services\MovimientoStockService();
                    $movientoStockService->save($dataMov, $oOrdenDetalle->getProducto(), $oOrden);
                }
                $oOrden->setOrdenEstado($oOrdenEstado);
                $oOrden->setNroFactura($formData['nroFactura']);
    //            $oOrden->setFechaModificado( new \DateTime() );
                $this->_em->persist($oOrden);
                $this->_em->flush();
                $this->notificarPagoConfirmado($oOrden);
            } else if ($formData['idOrdenEstado'] == \cart\Repositories\CartOrdenEstadoRepository::$ANULADO) {
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
    
    public function notificarRegistroOrden(\cart\Entity\CartOrden $oOrden) {
        try {
            $objEmail = new \Tonyprr_Email();
            $total = $oOrden->getCostoEnvio() + $oOrden->getTotalFinal();
            $mensaje = "Se ha generado un nuevo pedido: <br/><br/>";
            $mensaje .= "Nro. Orden: " . $oOrden->getIdOrden() ."<br/>";
            $mensaje .= "Combo: " . $oOrden->getDireccionPago() ."<br/>";
            $mensaje .= "Cliente: " . $oOrden->getCliente()->getNombres() . " " . $oOrden->getCliente()->getApellidoPaterno() . " " . $oOrden->getCliente()->getApellidoMaterno() . "<br/>";
            $mensaje .= "Costo del Combo: S/. " . $oOrden->getTotalFinal() ."<br/>";
            $mensaje .= "Costo de Env�o: S/. " . $oOrden->getCostoEnvio() ."<br/>";
            $mensaje .= "Costo Total: S/. " . $total ."<br/>";
            
            $objEmail->setBodyHtml($objEmail->convertString($mensaje));
            $objEmail->setFrom($objEmail->getAccount(), $objEmail->convertString($objEmail->getName()) );
            $objEmail->addTo(EMAIL_VENTAS);
            $objEmail->setSubject($objEmail->convertString("Notificación - Registro de Orden de Compra"));
            $objEmail->send($objEmail->getMailTrans());

        } catch(\Exception $e) {
            throw new \Exception('Ocurri� un error en el env�o de notificaci�n del pedido.', 1);
        }
    }
    
    public function notificarRegistroPagoOrden(\cart\Entity\CartOrden $oOrden) {
        try {
            $objEmail = new \Tonyprr_Email();
            $fechaDeposito = null;
            if(!is_null($oOrden->getFechaDeposito()))
                $fechaDeposito = $oOrden->getFechaDeposito()->format("d-m-Y");
            $total = $oOrden->getCostoEnvio() + $oOrden->getTotalFinal();
            $mensaje = "El Cliente ha registrado el pago ingresando el Número de Vaucher, la fecha y la hora de env�o.<br/>
                        Proceda a verificar la Orden:<br/>";
            $mensaje .= "Nro. Orden: " . $oOrden->getIdOrden() ."<br/>";
            $mensaje .= "Combo: " . $oOrden->getDireccionPago() ."<br/>";
            $mensaje .= "Cliente: " . $oOrden->getCliente()->getNombres() . " " . $oOrden->getCliente()->getApellidoPaterno() . " " . $oOrden->getCliente()->getApellidoMaterno() . "<br/>";
            $mensaje .= "Vaucher: " . $oOrden->getCodigoVoucher() ."<br/>";
            $mensaje .= "Fecha de Deposito: " . $fechaDeposito ."<br/>";
            $mensaje .= "Hora de Deposito: " . $oOrden->getHoraDeposito() ."<br/>";
            $mensaje .= "Costo del Combo: S/. " . $oOrden->getTotalFinal() ."<br/>";
            $mensaje .= "Costo de Env�o: S/. " . $oOrden->getCostoEnvio() ."<br/>";
            $mensaje .= "Costo Total: S/. " . $total ."<br/>";
            
            $objEmail->setBodyHtml($objEmail->convertString($mensaje));
            $objEmail->setFrom($objEmail->getAccount(), $objEmail->convertString($objEmail->getName()) );
            $objEmail->addTo(EMAIL_VENTAS);//ventas.online@mpf.com.pe
            $objEmail->setSubject($objEmail->convertString("Notificaci�n - Registro de Orden de Compra"));
            $objEmail->send($objEmail->getMailTrans());

        } catch(\Exception $e) {
            throw new \Exception('Ocurrió un error en el env�o de notificación del pedido.', 1);
        }
    }
    
    public function notificarPagoConfirmado(\cart\Entity\CartOrden $oOrden) {
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
            throw new \Exception('Ocurrió un error en el env�o de notificaci�n del confirmaci�n de pedido.', 1);
        }
    }
}
