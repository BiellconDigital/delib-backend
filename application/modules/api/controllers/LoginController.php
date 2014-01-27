<?php

class Api_LoginController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
    }

    public function indexAction()
    {
        // action body
    }

    public function noAuthAction()
    {
        echo "no tiene permisos";
    }


}



