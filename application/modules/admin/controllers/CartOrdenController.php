<?php
use cart\Services\OrdenService as ordenService;

class Admin_CartOrdenController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    }

    public function indexAction()
    {
    }

    public function listAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $pageStart = isset($data['start'])?$data['start']:NULL;
                $pageLimit = isset($data['limit'])?$data['limit']:NULL;
                $daoOrden = new ordenService();
                list($resultados, $total) = $daoOrden->aList(NULL, 1, $pageStart, $pageLimit);
                $result['success'] = 1;
                $result['data'] = $resultados;
                $result['total'] = $total;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function cambiarEstadoAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $daoOrden = new ordenService();
                $oOrden = $daoOrden->cambiarEstado($data);
                
                $result['msg'] = 'Se registr&oacute; los cambios correctamente.';
                $result['success'] = 1;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "".$e->getMessage()) );
        }
    }


}





