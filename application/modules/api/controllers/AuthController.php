<?php

class Api_AuthController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
    }

  public function noauthAction()
  {
    $this->getResponse()->setHttpResponseCode(401);
    $this->_helper->json(array("mensaje" => "Usuario no autorizado"));
  }

}



