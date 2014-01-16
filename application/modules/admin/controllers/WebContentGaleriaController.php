<?php
use web\Services\ContentGaleria;
use web\Services\ContentGaleriaLanguage;

class Admin_WebContentGaleriaController extends Zend_Controller_Action
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
                $idContent = isset($data['idcontent'])?$data['idcontent']:0;
                $srvContentGaleria = new ContentGaleria();
                list($aContentGaleria, $total) = $srvContentGaleria->aList($idContent, 1);
                $objRecords = \Tonyprr_lib_Records::getInstance();
                $objRecords->normalizeRecords($aContentGaleria);
                $result['success'] = 1;
                $result['data'] = $aContentGaleria;
                $result['total'] = $total;
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }        
    }

    public function deleteAction()
    {
        try {
            if ($this->_request->getPost()) {
                if( $this->_getParam('idcontgale',0) != 0 ) {
                    $idRegistro = $this->_getParam('idcontgale');
                    $srvContentGaleria = new ContentGaleria();
                    $srvContentGaleria->delete($idRegistro);
                    $result['success'] = 1;
                    $result['msg'] = "Se elimin&oacute; Foto correctamente.";
                } else {
                    $result['success'] = 0;
                    $result['msg'] = "No se envi&oacute; el ID de la Foto a eliminar.";
                }
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }        
    }

    public function saveAction()
    {
        try {
            if ($this->_request->getPost()) {
                $formData = $this->_request->getPost();
                $srvContentGaleria = new ContentGaleria();
                $oContentGale = $srvContentGaleria->save($formData);
                $result['success'] = 1;
                $result['idcontgale'] = $oContentGale->getIdcontgale();
                $result['msg'] = "Se guard&oacute; el registro correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function listLanguageAction()
    {
    }

    public function saveLanguageAction()
    {
    }

    public function languageAction()
    {
        try {
            //listar
            if ($this->getRequest()->isGet()) {
                $data = $this->getRequest()->getParams();
                $srvContentGaleria = new ContentGaleriaLanguage();
                $aContentGaleriaLanguage = $srvContentGaleria->listLanguage($data['idcontgale']);
                $result['success'] = 1;
                $result['data'] = $aContentGaleriaLanguage;
                $result['total'] = count($aContentGaleriaLanguage);
                echo Zend_Json::encode($result);
            //actualizar    
            } else if ($this->getRequest()->isPost()) {//isPut
                $body = $this->getRequest()->getRawBody();
                $formData = Zend_Json::decode($body);
                //print_r($data);
                //$formData = $this->getRequest()->getParams();

                $srvContentGaleriaLanguage = new ContentGaleriaLanguage();
                $oContentGaleriaLanguage = $srvContentGaleriaLanguage->saveLanguage($formData);
                $result['data'] = $formData;
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    }


}













