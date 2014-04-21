<?php
use cart\Services\ProductoGaleria;
use cart\Services\ProductoGaleriaLanguage;

class Admin_CartProductoGaleriaController extends Zend_Controller_Action
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

    public function listGaleriaAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $idProducto = isset($data['idproducto'])?$data['idproducto']:0;
                //$tipoGale = isset($data['tipoGale'])?$data['tipoGale']:1;
                $srvProductoGaleria = new ProductoGaleria();
                list($aProductoGaleria, $total) = $srvProductoGaleria->aList($idProducto, 1);
                $objRecords = \Tonyprr_lib_Records::getInstance();
                $objRecords->normalizeRecords($aProductoGaleria);
                $result['success'] = 1;
                $result['data'] = $aProductoGaleria;
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
                    $srvProductoGaleria = new ProductoGaleria();
                    $srvProductoGaleria->delete($idRegistro);
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
                $srvProductoGaleria = new ProductoGaleria();
                $oProductoGale = $srvProductoGaleria->save($formData);
                $result['success'] = 1;
                $result['idcontgale'] = $oProductoGale->getIdcontgale();
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
                $srvProductoGaleria = new ProductoGaleriaLanguage();
                $aProductoGaleriaLanguage = $srvProductoGaleria->listLanguage($data['idcontgale']);
                $result['success'] = 1;
                $result['data'] = $aProductoGaleriaLanguage;
                $result['total'] = count($aProductoGaleriaLanguage);
                echo Zend_Json::encode($result);
            //actualizar    
            } else if ($this->getRequest()->isPost()) {//isPut
                $body = $this->getRequest()->getRawBody();
                $formData = Zend_Json::decode($body);
                //print_r($data);
                //$formData = $this->getRequest()->getParams();

                $srvProductoGaleriaLanguage = new ProductoGaleriaLanguage();
                $oProductoGaleriaLanguage = $srvProductoGaleriaLanguage->saveLanguage($formData);
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













