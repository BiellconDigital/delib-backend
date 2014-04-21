<?php
use cart\Services\OrdenTipoService;
use Tonyprr\Exception\ValidacionException;

class Api_OrdenTipoController extends Zend_Controller_Action
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
            
            $srvOrdenTipo = new OrdenTipoService();
            list($aOrdenTipo, $total) = $srvOrdenTipo->lista();
            $result['data'] = $aOrdenTipo;
            $result['success'] = 1;
            $result['total'] = $total;
            echo Zend_Json::encode($result);
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => $e->getMessage()) );
        }
    
    }

    public function postAction()
    {

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



