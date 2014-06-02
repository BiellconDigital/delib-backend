<?php
use web\Services\User;
class Admin_WebUserController extends Zend_Controller_Action
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

    public function changeEmailClaveAction()
    {
        try {
            if ($this->_request->getPost()) {
                $formData = $this->_request->getPost();
                $access_admin = new \Zend_Session_Namespace ( SES_ADMIN );
            
                $srvUser = new User();
                $srvUser->changeEmailClave($access_admin->userId, $formData['e-mail'], $formData['password']);
                if ($formData['e-mail'] != "")
                    $access_admin->email = $formData['e-mail'];
            
                $result['success'] = 1;
                $result['msg'] = "Se cambio los datos correctamente.";
                echo Zend_Json::encode($result);
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"msg" => "Error: ".$e->getMessage()) );
        }
    }

}







