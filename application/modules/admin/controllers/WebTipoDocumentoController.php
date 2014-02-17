<?php
use web\Services\TipoDocumentoService as tipoDocumentoService;

class Admin_WebTipoDocumentoController extends Zend_Controller_Action
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
                $srvTipoDocumento = new tipoDocumentoService();
                list($resultados, $total) = $srvTipoDocumento->aList("TODOS", 1, true, $pageStart, $pageLimit);
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
            
                $srvTipoDocumento = new tipoDocumentoService();
                $oTipoDocumento = $srvTipoDocumento->save($formData);
            
                $result['idTipoDocumento'] = $oTipoDocumento->getIdTipoDocumento();
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro de TipoDocumento correctamente.";
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
                $srvTipoDocumento = new tipoDocumentoService();
                $aTipoDocumento = $srvTipoDocumento->getById($this->_getParam('id'), true, false);
                $result['success'] = 1;
                $result['data'] = $aTipoDocumento;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode(array("success"=>1,"resp"=>0,"msg"=>$e->getMessage()));
        }        
    }

}









