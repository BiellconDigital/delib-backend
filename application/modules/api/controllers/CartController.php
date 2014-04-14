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
            $dataStorage = Zend_Auth::getInstance()->getStorage()->read();
            
            if ($data['operacion'] == "lista_pedidos") {
                $srvOrdenService = new OrdenService();
                list($aOrdenesCliente, $total) = $srvOrdenService->listRecordsXClienteThumb($dataStorage['idCliente']);
                $result['data'] = $aOrdenesCliente;
            } else if ($data['operacion'] == "get_pedido") {
                $srvOrdenService = new OrdenService();
                $srvOrdenDetalleService = new OrdenDetalleService();
                $oOrden = $srvOrdenService->getById($data['idOrden']);
                $oOrdenDetalle = $srvOrdenDetalleService->aList($data['idOrden']);
//                var_dump($oOrden);
                $total = 1;
                $result['data']['head'] = $oOrden;
                $result['data']['detalle'] = $oOrdenDetalle[0];
            } else if ($data['prueba']) {
                $clientVisa = new Zend_Soap_Client("http://qas.multimerchantvisanet.com/wsgenerareticket/wseticket.asmx?WSDL");
                $clientVisa->GeneraEticket();
                
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
//            var_dump($cartData);   procesar_compra
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
                if (intval($orden['tipoPago']) == 1)
                    $headOrden['idOrdenEstado'] = cart\Repositories\CartOrdenEstadoRepository::$PENDIENTE_CANCELAR;
                else
                    $headOrden['idOrdenEstado'] = cart\Repositories\CartOrdenEstadoRepository::$TRANSACCION_NO_CONCLUIDA;
                $headOrden['direccionEnvio'] = $orden['direccionEnvio'];//$oDirDespacho->getDireccion();
                $headOrden['direccionPago'] = $orden['direccionEnvio'];
                $headOrden['fechaEnvio'] = new \DateTime($orden['fechaEnvio']);
//                $headOrden['horaEnvio'] = $orden['hora']['horaEnvio'];
                
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
                $result['idOrden'] = $oOrden -> getIdOrden();
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
            $body = $this->getRequest()->getRawBody();
            $cartData = Zend_Json::decode($body);
//            var_dump($cartData);
//            $dataStorage = Zend_Auth::getInstance()->getStorage()->read();
            try {
                if ($data['operacion'] == "confirmar_paypal") {
                    $srvOrden = new OrdenService();
                    $srvOrden->registrarCodigoTransaccion($cartData['idOrden'], $cartData['codigoTransaccion']);
                }
                $result['success'] = 1;
                $result['msg'] = "Se proceso la compra correctamente.";
                $this->_helper->json->sendJson($result);
            } catch(Exception $e) {
                $this->getResponse()->setHttpResponseCode(500);
                echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => $e->getMessage()) );
            }
    }

    public function deleteAction()
    {
        // action body
    }


    	function preparar($xmlDoc){
		//Se arma el XML de requerimiento
		$xmlIn = "";
		$xmlIn = $xmlIn . "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
		$xmlIn = $xmlIn . "<nuevo_eticket>";
		$xmlIn = $xmlIn . "	<parametros>";
		$xmlIn = $xmlIn . "		<parametro id=\"CANAL\">3</parametro>";
		$xmlIn = $xmlIn . "		<parametro id=\"PRODUCTO\">1</parametro>";
		$xmlIn = $xmlIn . "		<parametro id=\"CODTIENDA\">" . $codTienda . "</parametro>";
		$xmlIn = $xmlIn . "		<parametro id=\"NUMORDEN\">" . $numPedido . "</parametro>";
		$xmlIn = $xmlIn . "		<parametro id=\"MOUNT\">" . $mount . "</parametro>";
		
		$xmlIn = $xmlIn . "		<parametro id=\"NOMBRE\">" . $nombre . "</parametro>";
		$xmlIn = $xmlIn . "		<parametro id=\"APELLIDO\">" . $apellido . "</parametro>";
		$xmlIn = $xmlIn . "		<parametro id=\"CIUDAD\">" . $ciudad . "</parametro>";
		$xmlIn = $xmlIn . "		<parametro id=\"DIRECCION\">" . $direccion . "</parametro>";
		$xmlIn = $xmlIn . "		<parametro id=\"CORREO\">" . $correo . "</parametro>";
		
		$xmlIn = $xmlIn . "		<parametro id=\"DATO_COMERCIO\">" . $datoComercio . "</parametro>";
		$xmlIn = $xmlIn . "	</parametros>";
		$xmlIn = $xmlIn . "</nuevo_eticket>";
		
            
        }

	function CantidadMensajes($xmlDoc){
		$cantMensajes= 0;
		$xpath = new DOMXPath($xmlDoc);
		$nodeList = $xpath->query('//mensajes', $xmlDoc);
		
		$XmlNode= $nodeList->item(0);
		
		if($XmlNode==null){
			$cantMensajes= 0;
		}else{
			$cantMensajes= $XmlNode->childNodes->length;
		}
		return $cantMensajes; 
	}
	//Funcion que recupera el valor de uno de los mensajes XML de respuesta
	function RecuperaMensaje($xmlDoc,$iNumMensaje){
		$strReturn = "";
			
			$xpath = new DOMXPath($xmlDoc);
			$nodeList = $xpath->query("//mensajes/mensaje[@id='" . $iNumMensaje . "']");
			
			$XmlNode= $nodeList->item(0);
			
			if($XmlNode==null){
				$strReturn = "";
			}else{
				$strReturn = $XmlNode->nodeValue;
			}
			return $strReturn;
	}
	//Funcion que recupera el valor del Eticket
	function RecuperaEticket($xmlDoc){
		$strReturn = "";
			
			$xpath = new DOMXPath($xmlDoc);
			$nodeList = $xpath->query("//registro/campo[@id='ETICKET']");
			
			$XmlNode= $nodeList->item(0);
			
			if($XmlNode==null){
				$strReturn = "";
			}else{
				$strReturn = $XmlNode->nodeValue;
			}
			return $strReturn;
	}

        
                        }



