<?php
use web\Services\User;
class Admin_LoginController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = $this->_helper->layout();
        $layout->setLayout('login');
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->initView();
    }

    public function indexAction()
    {
        // action body
    }

    public function accessAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        try {
            if ($this->getRequest()->isPost()) {
                $data = $this->getRequest()->getPost();
                $oUser = new User();
                $resulUser = $oUser->login($data['username'], $data['password']);
                if ($resulUser != null) $oUser->initSession($resulUser);
                $result['success'] = 1;
                $result['resp'] = ($resulUser != null)?1:0;
                $result['msg'] = ($resulUser != null)?"Ingreso correctamente":"No puede acceder al Sistema, revise sus credenciales de acceso.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode(array("success"=>1,"resp"=>0,"msg"=>"Error: ".$e->getMessage()));
        }
    }

    public function logoutAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $oUser = new User();
        $resulUser = $oUser->closeSession();
    }

    public function changeAction()
    {
        // action body
    }


}







