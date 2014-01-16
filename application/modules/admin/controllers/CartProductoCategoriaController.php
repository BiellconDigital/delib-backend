<?php
use cart\Services\ProductoCategoria;
use cart\Services\ProductoCategoriaLanguage;

class Admin_CartProductoCategoriaController extends Zend_Controller_Action
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
                $idpadre = isset($data['padre'])?$data['padre']:1;
                $daoProdServ = new ProductoCategoria();
                $aTree = $daoProdServ ->listTree($idpadre, 1, true);
                echo $aTree['str'];
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
            
                $srvProductoCategoria = new ProductoCategoria();
                $oProductoCategoria = $srvProductoCategoria->save($formData);
            
                $result['idcontcate'] = $oProductoCategoria->getIdcontcate();
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro de Producto correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
           echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function formAction()
    {
        try {
            if( $this->_getParam('id',0) != 0 ) {
                $data = $this->getRequest()->getParams();
                $srvProductoCategoria = new ProductoCategoria();
                list($aProductoCategoria, $aProductoCategoriaLang) = $srvProductoCategoria->getById($data['id']);
                $result['success'] = 1;
                $result['data'] = $aProductoCategoria;
                echo Zend_Json::encode($result);
            } else {
                throw new \Exception('No se ha enviado el parametro de la consulta.');
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => $e->getMessage()) );
        }
    }

    public function listLanguageAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $srvProductoCateLanguage = new ProductoCategoriaLanguage();
                $aProductoLanguage = $srvProductoCateLanguage->listLanguage($data['idcontcate']);
                $result['success'] = 1;
                $result['data'] = $aProductoLanguage;
                $result['total'] = count($aProductoLanguage);
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function saveLanguageAction()
    {
        try {
            if ($this->_request->getPost()) {
                $formData = $this->_request->getPost();
                $srvProductoCateLanguage = new ProductoCategoriaLanguage();
                $oProductoCategoria = $srvProductoCateLanguage->saveLanguage($formData);
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => $e->getMessage()) );
        }
    }

    public function deleteAction()
    {
        try {
//            $Producto = new \Models\CmsProducto();
            if ($this->_request->getPost()) {
                if( $this->_getParam('idcontcate',0) != 0 ) {
                    $idContcate = $this->_getParam('idcontcate');
                    $srvProductoCate = new ProductoCategoria();
                    $srvProductoCate->delete($idContcate);
                    $result['success'] = 1;
                    $result['msg'] = "Se elimin&oacute; Categoria y todo su contenido correctamente.";
                } else {
                    $result['success'] = 0;
                    $result['msg'] = "No se envi&oacute; el ID de la Producto a eliminar.";
                }
                echo Zend_Json::encode($result);
            }
        } catch(ValidacionException $e) {
            echo Zend_Json::encode( array("success" => 0,"msg" => $e->getMessage()) );
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0, "msg" => $e->getMessage()) );
        }
    }


}













