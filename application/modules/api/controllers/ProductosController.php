<?php
use cart\Services\Producto;
use cart\Services\ProductoLanguage;
use Tonyprr\Exception\ValidacionException;

class Api_ProductosController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

//        $bootstrap = $this->getInvokeArg('bootstrap');   
//        $options = $bootstrap->getOption('resources');   
//        $contextSwitch = $this->_helper->getHelper('contextSwitch'); 
//        $contextSwitch->addActionContext('index', array('xml','json'))->initContext();
        
        $this->_todo = array (
            array("id" => "1", "nombre" => "producto 1"),
            array("id" => "2", "nombre" => "producto 2"),
            array("id" => "3", "nombre" => "producto 3"),
        );    
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
            $idcontCate = isset($data['idcontcate'])?$data['idcontcate']:2;
            $textoBusqueda = isset($data['query'])?$data['query']:NULL;

            $srvProducto = new Producto();
            list($aProductos, $total, $oProductoCategoria) = $srvProducto->aList($idcontCate, 1 ,"TODOS", $pageStart, $pageLimit, $textoBusqueda);
            $objRecords=\Tonyprr_lib_Records::getInstance();
            $objRecords->normalizeRecords($aProductos);
            $result['success'] = 1;
            $result['data'] = $aProductos;
            $result['total'] = $total;
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









