<?php
use cart\Services\OrdenService;
use cart\Services\OrdenDetalleService;
use Tonyprr\Exception\ValidacionException;

class Api_VisaController extends Zend_Controller_Action
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
    }

    public function postAction()
    {
    }

    public function putAction()
    {
        try {
            $body = $this->getRequest()->getRawBody();
            $data = Zend_Json::decode($body);
//            $dataStorage = Zend_Auth::getInstance()->getStorage()->read();
            
            if ($data['operacion'] == "obtener_eticket") {
                $orden = $data['orden'];
                $cliente = $data['cliente'];
                $totalMonto = round(1.0*($orden['subTotal'] + 1.0*$orden['costoEnvio']), 2);
                $ordenService = new OrdenService();
                $result = $ordenService->generarTicketVisa($orden['idOrden'], $totalMonto, $cliente);
            } else if ($data['operacion'] == "actualizar_orden_visa") {
                $srvOrdenService = new OrdenService();
                $srvOrdenDetalleService = new OrdenDetalleService();
                $oOrden = $srvOrdenService->getById($data['idOrden']);
                $oOrdenDetalle = $srvOrdenDetalleService->aList($data['idOrden']);

                //$orden = $data['orden'];
                $codigoTransaccion = $oOrden[0]['codigoTransaccion'];
                $idOrden = $oOrden[0]['idOrden'];
                $idOrdenEstado = $oOrden[0]['idOrdenEstado'];
                $montoTotal = $oOrden[0]['costoEnvio'] + $oOrden[0]['totalFinal'];
//                $ordenService = new OrdenService();
                $result = $srvOrdenService->actualizarOrdenVisa($idOrden, $idOrdenEstado, $montoTotal, $codigoTransaccion);
                
                $result['pedido']['head'] = $oOrden;
                $result['pedido']['detalle'] = $oOrdenDetalle[0];
            }
            echo Zend_Json::encode($result);
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => $e->getMessage()) );
        }
    
    }

    public function deleteAction()
    {
        // action body
    }
}