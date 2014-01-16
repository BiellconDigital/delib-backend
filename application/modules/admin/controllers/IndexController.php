<?php

class Admin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->initView();
    }

    public function indexAction()
    {
        // action body
    }

    public function configAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $result['success'] = 1;
        $result['msg'] = "OK.";
        echo Zend_Json::encode($result);
    }


}



