<?php
use cart\Services\MovimientoStockTipoService as movimientoStockTipoService;
class Admin_CartMovimientoStockTipoController extends Zend_Controller_Action
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
                $daoMovimientoStockTipo = new movimientoStockTipoService();
                list($qyMovimientoStockTipo,$total) = $daoMovimientoStockTipo->aList(true, $pageStart, $pageLimit);
                $resultados = $qyMovimientoStockTipo->getArrayResult();
                $objRecords=\Tonyprr_lib_Records::getInstance();
                $objRecords->normalizeRecords($resultados);
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



