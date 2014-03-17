<?php
use cart\Services\Producto;
use cart\Services\ProductoGaleria;
use cart\Services\ProductoLanguage;
use Tonyprr\Exception\ValidacionException;

class Api_ProductoController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

//        $bootstrap = $this->getInvokeArg('bootstrap');   
//        $options = $bootstrap->getOption('resources');   
//        $contextSwitch = $this->_helper->getHelper('contextSwitch'); 
//        $contextSwitch->addActionContext('index', array('xml','json'))->initContext();
        
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
            $idcontCate = isset($data['idcontcate'])?$data['idcontcate']:NULL;
            $textoBusqueda = isset($data['query'])?$data['query']:NULL;
            $srvProducto = new Producto();
            
            if ($data['operacion'] == "lista") {
                list($aProductos, $total, $oProductoCategoria) = $srvProducto->aList($idcontCate, 1 ,1, $pageStart, $pageLimit, $textoBusqueda);
                $objRecords=\Tonyprr_lib_Records::getInstance();
                $objRecords->normalizeRecords($aProductos);
                $result['data'] = $aProductos;
            } else if ($data['operacion'] == "getById") {
                $aProducto = $srvProducto->getById($data['idprod'], 1, true, true);
                $result['data'] = $aProducto;
                $total = 1;
            } else if ($data['operacion'] == "get_galeria") {
                $srvProductoGaleria = new ProductoGaleria();
                list($aProductoGaleria, $total, $oProducto) = $srvProductoGaleria->aList($data['idprod'], 1);
                $result['data'] = $aProductoGaleria;
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
        // action body
//        echo Zend_Json::encode($this->_todo);
//        $this->getResponse()->setBody('Hello World');
//        $this->getResponse()->setHttpResponseCode(200);
    }

    public function putAction()
    {
        
    }

    public function deleteAction()
    {
        // action body
    }


}









