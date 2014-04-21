<?php
use cart\Services\Producto;
use cart\Services\ProductoLanguage;
use Tonyprr\Exception\ValidacionException;

class Admin_CartProductoController extends Zend_Controller_Action
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
                $idcontCate = isset($data['idcontcate'])?$data['idcontcate']:NULL;
                $textoBusqueda = isset($data['query'])?$data['query']:NULL;
                
                $srvProducto = new Producto();
                list($aProductos, $total, $oProductoCategoria) = $srvProducto->aList($idcontCate, 1 ,"TODOS", $pageStart, $pageLimit, $textoBusqueda);
                $objRecords=\Tonyprr_lib_Records::getInstance();
                $objRecords->normalizeRecords($aProductos);
                $result['success'] = 1;
                $result['data'] = $aProductos;
                $result['total'] = $total;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function saveAction()
    {
        try {
            if ($this->_request->getPost()) {
                $formData = $this->_request->getPost();
            
                $srvProducto = new Producto();
                $oProducto = $srvProducto->save($formData);
            
                $result['idproducto'] = $oProducto->getIdproducto();
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro de Producto correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
           echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function deleteAction()
    {
        try {
//            $Producto = new \Models\CmsProducto();
            if ($this->_request->getPost()) {
                if( $this->_getParam('idproducto',0) != 0 ) {
                    $idProducto = $this->_getParam('idproducto');
                    $srvProducto = new Producto();
                    $srvProducto->delete($idProducto);
                    $result['success'] = 1;
                    $result['msg'] = "Se elimin&oacute; Producto correctamente.";
                } else {
                    $result['success'] = 0;
                    $result['msg'] = "No se envi&oacute; el ID de la Producto a eliminar.";
                }
                echo Zend_Json::encode($result);
            }
        } catch(ValidacionException $e) {
            echo Zend_Json::encode( array("success" => 0,"msg" => $e->getMessage()) );
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => $e->getMessage()) );
        }
    }

    public function listLanguageAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $srvProductoLanguage = new ProductoLanguage();
                $aProductoLanguage = $srvProductoLanguage->listLanguage($data['idproducto']);
                $result['success'] = 1;
                $result['data'] = $aProductoLanguage;
                $result['total'] = count($aProductoLanguage);
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => $e->getMessage()) );
        }
    }

    public function saveLanguageAction()
    {
        try {
            if ($this->_request->getPost()) {
                $formData = $this->_request->getPost();
                $srvProductoLanguage = new ProductoLanguage();
                $oProducto = $srvProductoLanguage->saveLanguage($formData);
//                $result['idProductocateLanguage'] = $oProdCategoria->getLanguages()->get($formData['idLanguage'])->getIdProductocateLanguage();
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => $e->getMessage()) );
        }
    }

}











