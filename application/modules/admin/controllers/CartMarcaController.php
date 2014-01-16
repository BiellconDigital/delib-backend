<?php
use cart\Services\MarcaService as marcaService;
use cart\Services\MarcaLanguageService as marcaLanguageService;
use Tonyprr\Exception\ValidacionException;

class Admin_CartMarcaController extends Zend_Controller_Action
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
                $srvMarca = new marcaService();
                list($aMarcas,$total) = $srvMarca->aList("TODOS", 1, $pageStart, $pageLimit);
                
                $objRecords=Tonyprr_lib_Records::getInstance();
                $objRecords->normalizeRecords($aMarcas);
                $result['success'] = 1;
                $result['data'] = $aMarcas;
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
                $marcaService = new marcaService();
                $oMarca = $marcaService->save($formData);
            
                $result['idmarca'] = $oMarca->getIdmarca();
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro de Marca correctamente.";
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
                $formData = $this->getRequest()->getParams();
                $daoMarca = new marcaService();
                $aMarca = $daoMarca->getById($this->_getParam('id'));
                $result['success'] = 1;
                $result['data'] = $aMarca;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode(array("success"=>1,"resp"=>0,"msg"=>$e->getMessage()));
        }        
    }
    
    public function deleteAction()
    {
        try {
//            $Producto = new \Models\CmsProducto();
            if ($this->_request->getPost()) {
                if( $this->_getParam('idmarca',0) != 0 ) {
                    $idMarca = $this->_getParam('idmarca');
                    $srvMarca = new marcaService();
                    $srvMarca->delete($idMarca);
                    $result['success'] = 1;
                    $result['msg'] = "Se elimin&oacute; la marca correctamente.";
                } else {
                    $result['success'] = 0;
                    $result['msg'] = "No se envi&oacute; el ID de la Marca a eliminar.";
                }
                echo Zend_Json::encode($result);
            }
        } catch(ValidacionException $e) {
            echo Zend_Json::encode( array("success" => 0,"msg" => $e->getMessage()) );
        } catch(Exception $e) {
            echo Zend_Json::encode( array("success" => 0,"msg" => $e->getMessage()) );
        }
    }

    public function listLanguageAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $marcaService = new marcaLanguageService();
                $aMarcaLanguage = $marcaService->listLanguage($data['idmarca']);
                $result['success'] = 1;
                $result['data'] = $aMarcaLanguage;
                $result['total'] = count($aMarcaLanguage);
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
                $marcaService = new marcaLanguageService();
                $aMarca = $marcaService->saveLanguage($formData);
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }
    }


}



