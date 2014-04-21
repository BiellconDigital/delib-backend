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
                $orden = $data['orden'];
                $codigoTransaccion = $orden['codigoTransaccion'];
                $idOrden = $orden['idOrden'];
                $idOrdenEstado = $orden['idOrdenEstado'];
                $montoTotal = $orden['costoEnvio'] + $orden['totalFinal'];
                $ordenService = new OrdenService();
                $result = $ordenService->actualizarOrdenVisa($idOrden, $idOrdenEstado, $montoTotal, $codigoTransaccion);
                
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