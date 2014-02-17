<?php

class Api_LogoutController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
    }

    public function indexAction()
    {
    }

    public function getAction()
    {
    }

    public function postAction()
    {
            $auth = Zend_Auth::getInstance();
            $auth->clearIdentity();
            $result['success'] = 1;
            $result['msj'] = "Se salio correctamente.";
            $this->_helper->json->sendJson($result);
            
    }

    public function putAction()
    {
        //
    }

    public function deleteAction()
    {
        // action body
    }


}



