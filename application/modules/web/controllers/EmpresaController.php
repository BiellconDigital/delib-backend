<?php
use web\Services\Content;

class Web_EmpresaController extends Zend_Controller_Action
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
        try {
//            $authSesion = new Zend_Session_Namespace(SES_USER);
//            $daoContent = new Content();
//            list($oContent, $oContentLang) = $daoContent->getById(1, $authSesion->oLanguage, false, true);
//
//            $this -> view -> oContent = $oContent;
//            $this -> view -> oContentLang = $oContentLang;
        } catch(Exception $e) {
            if ($e->getCode() == 1)
                $this->_flashMessenger->addMessage($e->getMessage());
            else
                $this->_flashMessenger->addMessage('Ocurrió un error en el procesamiento de su requerimiento.');
        }        
        $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
        
        
    }


}

