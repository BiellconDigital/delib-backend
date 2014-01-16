<?php
use web\Services\Cliente;

class Admin_WebClienteController extends Zend_Controller_Action
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
                $srvCliente = new Cliente();
                list($resultados, $total) = $srvCliente->aList("TODOS", true, $pageStart, $pageLimit);
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
            
                $srvCliente = new Cliente();
                $oCliente = $srvCliente->save($formData);
            
                $result['idCliente'] = $oCliente->getIdCliente();
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro de Cliente correctamente.";
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
                if( $this->_getParam('idCliente',0) != 0 ) {
                    $idCliente = $this->_getParam('idCliente');
                    $srvCliente = new Cliente();
                    $srvCliente->delete($idCliente);
                    $result['success'] = 1;
                    $result['msg'] = "Se elimin&oacute; Cliente correctamente.";
                } else {
                    $result['success'] = 0;
                    $result['msg'] = "No se envi&oacute; el ID de la Cliente a eliminar.";
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
                $srvCliente = new Cliente();
                $aCliente = $srvCliente->getById($this->_getParam('id'), true, false);
                $result['success'] = 1;
                $result['data'] = $aCliente;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode(array("success"=>1,"resp"=>0,"msg"=>$e->getMessage()));
        }        
    }

}









