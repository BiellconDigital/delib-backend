<?php
use web\Services\Content;

class Web_NoticiasController extends Zend_Controller_Action
{

    private $_flashMessenger = null;

    public function init()
    {
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->_flashMessenger->clearCurrentMessages();
        $this->initView();
    }

    public function indexAction()
    {
        $authSesion = new Zend_Session_Namespace(SES_USER);
        $this -> view -> idioma = $authSesion->idioma;
        try {
            $formData = $this->getRequest()->getParams();
            $pageStart = isset($data['start'])?$data['start']:NULL;
            $pageLimit = isset($data['limit'])?$data['limit']:NULL;
            $daoContent = new Content();
            list($aContents, $count, $oContentCategoria) = $daoContent->aList(6, $authSesion->oLanguage, 1, $pageStart, $pageLimit);

            $this -> view -> aContents = $aContents;
        } catch(Exception $e) {
            if ($e->getCode() == 1)
                $this->_flashMessenger->addMessage($e->getMessage());
            else
                $this->_flashMessenger->addMessage('Ocurrió un error en el procesamiento de su requerimiento.');
        }        
        $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
    }

    public function verAction()
    {
        try {
            if( $this->_getParam('id',0) != 0 ) {
                $formData = $this->getRequest()->getParams();
                $authSesion = new Zend_Session_Namespace(SES_USER);
                $daoContent = new Content();
                list($oContent, $oContentLang) = $daoContent->getById($formData['id'], $authSesion->oLanguage, false, true);

                $this -> view -> oContent = $oContent;
                $this -> view -> oContentLang = $oContentLang;
            } else {
                $this->_flashMessenger->addMessage('No se envió el ID del registro.');
            }
            
        } catch(Exception $e) {
            if ($e->getCode() == 1)
                $this->_flashMessenger->addMessage($e->getMessage());
            else
                $this->_flashMessenger->addMessage('Ocurrió un error en el procesamiento de su requerimiento.');
        }        
        $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
    }


}



