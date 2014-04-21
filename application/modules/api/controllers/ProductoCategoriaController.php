<?php
use cart\Services\ProductoCategoria;
use cart\Services\ProductoCategoriaLanguage;
use Tonyprr\Exception\ValidacionException;


class Api_ProductoCategoriaController extends Zend_Controller_Action
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
            $idpadre = isset($data['padre'])?$data['padre']:1;
            $pageStart = isset($data['start'])?$data['start']:NULL;
            $pageLimit = isset($data['limit'])?$data['limit']:NULL;
            $daoProdServ = new ProductoCategoria();
            $aProductoCategoria = $daoProdServ->aList($idpadre, 1, true, $pageStart, $pageLimit);
            $result['success'] = 1;
            $result['data'] = $aProductoCategoria;
            $result['total'] = count($aProductoCategoria);
            echo Zend_Json::encode($result);
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function postAction()
    {
        // action body
//        echo Zend_Json::encode($this->_todo);
//        $this->getResponse()->setBody('Hello World');
//        $this->getResponse()->setHttpResponseCode(200);
    }

    public function putAction()
    {
        echo Zend_Json::encode($this->_todo);
    }

    public function deleteAction()
    {
        // action body
    }


}









