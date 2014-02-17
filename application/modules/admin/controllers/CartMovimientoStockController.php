<?php
use cart\Services\MovimientoStockService as movimientoStockService;
class Admin_CartMovimientoStockController extends Zend_Controller_Action
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
                $daoMovimientoStock = new movimientoStockService();
                list($resultados, $total) = $daoMovimientoStock->aList(NULL, 1, true, $pageStart, $pageLimit);
                $result['success'] = 1;
                $result['data'] = $resultados;
                $result['total'] = $total;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function saveAction()
    {
        $em = \Zend_Registry::get('em');
        $em->getConnection()->beginTransaction();
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $access_admin = new \Zend_Session_Namespace ( SES_ADMIN );
                $data['iduser'] = $access_admin->userId;
                $daoMovimientoStock = new movimientoStockService();
                $oMovimientoStock = $daoMovimientoStock->save($data);
                
                $result['msg'] = 'Se registr&oacute; el movimiento correctamente.';
                $result['success'] = 1;
                $em->getConnection()->commit();
                $em->getConnection()->close();
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            $em->getConnection()->rollBack();
            $em->getConnection()->close();
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    }


}





