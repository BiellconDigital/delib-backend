<?php
use web\Services\UbigeoService;
//use web\Services\Cliente;
use cart\Services\OrdenTipoService;
use cart\Services\OrdenService;
use cart\Services\OrdenDetalleService;
use Tonyprr\Exception\ValidacionException;

class Api_CartController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
    }

    public function indexAction()
    {
        if ($this->_request->isGet()) {
            $this->_forward('get');
        } else {
            $this->getResponse()->setHttpResponseCode(500);
        }
    }

    public function getAction()
    {
        try {
            $data = $this->getRequest()->getParams();
            $pageStart = isset($data['start'])?$data['start']:NULL;
            $pageLimit = isset($data['limit'])?$data['limit']:NULL;
            $idcontCate = isset($data['idcontcate'])?$data['idcontcate']:NULL;
            $textoBusqueda = isset($data['query'])?$data['query']:NULL;
            
            if ($data['operacion'] == "distritos") {
                $srvUbigeo = new UbigeoService();
                list($aUbigeo, $total) = $srvUbigeo->lista();
                $result['data'] = $aUbigeo;
            } else if ($data['operacion'] == "razon_compra") {
                $srvOrdenTipo = new OrdenTipoService();
                list($aOrdenTipo, $total) = $srvOrdenTipo->lista();
                $result['data'] = $aOrdenTipo;
            } else if ($data['operacion'] == "lista_pedidos") {
                $srvOrdenService = new OrdenService();
                list($aOrdenTipo, $total) = $srvOrdenService->lista();
                $result['data'] = $aOrdenTipo;
            }
            $result['success'] = 1;
            $result['total'] = $total;
            echo Zend_Json::encode($result);
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    
    }

    public function postAction()
    {
            $body = $this->getRequest()->getRawBody();
            $cartData = Zend_Json::decode($body);
//            var_dump($cartData);
            $dataStorage = Zend_Auth::getInstance()->getStorage()->read();
            $em = \Zend_Registry::get('em');
            $em->getConnection()->beginTransaction();
            try {
                $srvOrden = new OrdenService();
                $srvOrdenDetalle = new OrdenDetalleService();
//                $srvCliente = new Cliente();
//                $oCliente = $srvCliente->getById($dataStorage['idCliente'], false);
                
                $orden = $cartData['orden'];
//                $srvClienteDireccion = new ClienteDireccion();
//                $oDirDespacho = $srvClienteDireccion->getDirPorTipo($oCliente, ClienteDireccion::$DIR_DESPACHO, false);
//                $oDirFactura = $srvClienteDireccion->getDirPorTipo($oCliente, ClienteDireccion::$DIR_FACTURA, false);
                $totalMonto = $orden['subTotal'];
                $subTotal = round($totalMonto/1.18, 2);
                $impuestoTotal = $totalMonto - $subTotal;

                $headOrden['subTotal'] = $subTotal;//sin inpuesto
                $headOrden['totalImpuesto'] = $impuestoTotal;//inpuesto
                $headOrden['total'] = $totalMonto;
                $headOrden['totalDescuento'] = 0;
                $headOrden['totalFinal'] = $totalMonto;
                $headOrden['costoEnvio'] = $orden['costoEnvio'];

                $headOrden['idOrden'] = '';
                $headOrden['tipoDocumento'] = 1;//1 boleta, 2 factura
                $headOrden['cuentaBanco'] = $orden['cuentaBanco'];
                $headOrden['idCliente'] = $dataStorage['idCliente'];
                $headOrden['rucCliente'] = $orden['rucCliente'];
                $headOrden['razonSocial'] = $orden['razonSocial'];
                $headOrden['idMoneda'] = 1;
                $headOrden['idOrdenEstado'] = cart\Repositories\CartOrdenEstadoRepository::$PENDIENTE_CANCELAR;
                $headOrden['direccionEnvio'] = $orden['direccionEnvio'];//$oDirDespacho->getDireccion();
                $headOrden['direccionPago'] = $orden['direccionEnvio'];
                $headOrden['fechaEnvio'] = new \DateTime($orden['fechaEnvio']);
                $headOrden['horaEnvio'] = $orden['hora']['horaEnvio'];
                
                $headOrden['codPostal'] = $orden['distrito']['codPostal'];
                $headOrden['idOrdenTipo'] = $orden['razon_compra']['idOrdenTipo'];
                $headOrden['tipoPago'] = $orden['tipoPago'];
                $headOrden['aceptaPolitica'] = $orden['aceptaPolitica'];
                $headOrden['impuestoRatio'] = 0.18;

                $oOrden = $srvOrden->save($headOrden);
//                if (count($cartData['items']) > 0 ) {
                    foreach ($cartData['items'] as $item) {
                        //echo "prod: " . $item['name'] . " ";
                        $detalleOrden = array();
                        $detalleOrden['idOrdenDetalle'] = '';
                        $detalleOrden['cantidad'] = $item['quantity'];
                        $detalleOrden['idproducto'] = $item['sku'];
                        $detalleOrden['tituloConte'] = $item['name'];
                        $detalleOrden['precioUnitario'] = $item['price'];
                        $detalleOrden['precioTotal']  = $item['quantity'] * $item['price'];
                        $oOrdenDetalle = $srvOrdenDetalle->save($detalleOrden, $oOrden);
                    }
//                }
                $em->getConnection()->commit();

                $result['success'] = 1;
                $result['msg'] = "Se proceso la compra correctamente.";
                $this->_helper->json->sendJson($result);
            } catch(Exception $e) {
                $em->getConnection()->rollback();
                $em->close();
                $this->getResponse()->setHttpResponseCode(500);
                echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => $e->getMessage()) );
            }
            
    }

    public function putAction()
    {
        //
    }

    public function deleteAction()
    {
        // action body
    }


}



