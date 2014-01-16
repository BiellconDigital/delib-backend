<?php
use web\Services\PaisService as paisService;

class Admin_WebPaisController extends Zend_Controller_Action
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
                $srvPais = new paisService();
                list($resultados, $total) = $srvPais->aList("TODOS", true, $pageStart, $pageLimit);
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
        try {
            if ($this->_request->getPost()) {
                $formData = $this->_request->getPost();
            
                $srvPais = new paisService();
                $oPais = $srvPais->save($formData);
            
                $result['idPais'] = $oPais->getIdPais();
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro de Pais correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function deleteAction()
    {
        try {
            if ($this->_request->getPost()) {
                if( $this->_getParam('idPais',0) != 0 ) {
                    $idPais = $this->_getParam('idPais');
                    $srvPais = new paisService();
                    $srvPais->delete($idPais);
                    $result['success'] = 1;
                    $result['msg'] = "Se elimin&oacute; Pais correctamente.";
                } else {
                    $result['success'] = 0;
                    $result['msg'] = "No se envi&oacute; el ID de la Pais a eliminar.";
                }
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
                $srvPais = new paisService();
                $aPais = $srvPais->getById($this->_getParam('id'), true, false);
                $result['success'] = 1;
                $result['data'] = $aPais;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode(array("success"=>1,"resp"=>0,"msg"=>$e->getMessage()));
        }        
    }

}









