<?php
use cart\Services\OrdenService;
use cart\Services\OrdenDetalleService;

class Admin_CartOrdenDetalleController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $pageStart = isset($data['start'])?$data['start']:NULL;
                $pageLimit = isset($data['limit'])?$data['limit']:NULL;
                $daoOrden = new OrdenService();
                $oOrden = $daoOrden->getById($data['idOrden'], false);
                
                $daoOrdenDetalle = new OrdenDetalleService();
                list($resultados,$total) = $daoOrdenDetalle->aList($oOrden, $pageStart, $pageLimit);
                $result['success'] = 1;
                $result['data'] = $resultados;
                $result['total'] = $total;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    }


}



