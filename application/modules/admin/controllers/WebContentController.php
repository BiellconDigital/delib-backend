<?php
use web\Services\Content;
use web\Services\ContentLanguage;

class Admin_WebContentController extends Zend_Controller_Action
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
                $idcontCate = isset($data['idcontcate'])?$data['idcontcate']:2;
                $textoBusqueda = isset($data['query'])?$data['query']:NULL;
                
                $srvContent = new Content();
                list($aContents, $total, $oContentCategoria) = $srvContent->aList($idcontCate, 1 ,"TODOS", $pageStart, $pageLimit, $textoBusqueda);
                $objRecords=\Tonyprr_lib_Records::getInstance();
                $objRecords->normalizeRecords($aContents);
                $result['success'] = 1;
                $result['data'] = $aContents;
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
            
                $srvContent = new Content();
                $oContent = $srvContent->save($formData);
            
                $result['idcontent'] = $oContent->getIdcontent();
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro de Content correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
           echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function deleteAction()
    {
        try {
//            $Content = new \Models\CmsContent();
            if ($this->_request->getPost()) {
                if( $this->_getParam('idcontent',0) != 0 ) {
                    $idContent = $this->_getParam('idcontent');
                    $srvContent = new Content();
                    $srvContent->delete($idContent);
                    $result['success'] = 1;
                    $result['msg'] = "Se elimin&oacute; Content correctamente.";
                } else {
                    $result['success'] = 0;
                    $result['msg'] = "No se envi&oacute; el ID de la Content a eliminar.";
                }
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }
    }

    public function listLanguageAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                $srvContentLanguage = new ContentLanguage();
                $aContentLanguage = $srvContentLanguage->listLanguage($data['idcontent']);
                $result['success'] = 1;
                $result['data'] = $aContentLanguage;
                $result['total'] = count($aContentLanguage);
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
                $srvContentLanguage = new ContentLanguage();
                $oContent = $srvContentLanguage->saveLanguage($formData);
//                $result['idContentcateLanguage'] = $oProdCategoria->getLanguages()->get($formData['idLanguage'])->getIdContentcateLanguage();
                $result['success'] = 1;
                $result['msg'] = "Se guard&oacute; el registro correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }
    }

}











