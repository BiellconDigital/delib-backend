<?php
use web\Services\Cliente;

class Api_ClienteController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
    }

    public function indexAction()
    {
        if ($this->_request->isGet()) {
            $this->_forward('get');
        } else {
            $this->getResponse()->setHttpResponseCode(500);
        }
    }

    public function getAction()
    {
        echo "no tiene permisos";
    }

    public function postAction()
    {
        try {
            $body = $this->getRequest()->getRawBody();
            $userData = Zend_Json::decode($body);
            $user = $userData['user'];
            $user['role'] = $user['role']['title'];
            $user['nombres'] = $user['username'];
//            fechaNacimiento
            
            $srvCliente = new Cliente();
            $oCliente = $srvCliente->save($user);

            $result['idCliente'] = $oCliente->getIdCliente();
            $result['success'] = 1;
            $result['msg'] = "Se proceso el registro correctamente.";
            $this->_helper->json->sendJson($result);
        } catch(Exception $e) {
            $this->getResponse()->setHttpResponseCode(500);
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => $e->getMessage()) );
        }
    }

    public function putAction()
    {
        $body = $this->getRequest()->getRawBody();
        $formData = Zend_Json::decode($body);
        try {
            
            if ($formData['operacion'] == "change_password") {
                
                $daoCliente = new Cliente();
                $daoCliente->cambiarClave($formData['idCliente'], $formData['clave'], $formData['claveNueva']);
                $result['success'] = 1;
                $result['msg'] = "Su contraseña ha sido actualizada.";
                $this->_helper->json->sendJson($result);
                
//                $this->getResponse()->setHttpResponseCode(500);
//                echo Zend_Json_Encoder::encode( array("success" => 0, "msg" => "No se ha enviado los parametros necesarios.") );
            }
            
        } catch(Exception $e) {
            $this->getResponse()->setHttpResponseCode(500);
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => $e->getMessage()) );
        }
    }

    public function deleteAction()
    {
        // action body
    }


}



