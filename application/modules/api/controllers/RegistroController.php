<?php
use web\Services\Cliente;
use web\Services\KeysService;

class Api_RegistroController extends Zend_Controller_Action
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
            $user['idCliente'] = null;
            $user['role'] = $user['role']['title'];
            $user['nombres'] = $user['username'];
//            fechaNacimiento
            $genClave = 'delib' . rand(10000, 99999);
            //unset ($formData['estado']);
            $user['clave'] = md5($genClave);
            
            $srvCliente = new Cliente();
            $oCliente = $srvCliente->save($user);
            
            $keyValidacion = md5(strval(time()) . strval(rand(10000, 99999)));

            $daoKeys = new KeysService();
            $daoKeys->addKey($keyValidacion, $oCliente);

            $objEmail = new \Tonyprr_Email();
            $params = $oCliente->getEmail() . "/" . $keyValidacion;
            $mensaje = "Bienvenido estimado cliente, sus datos de ingreso son:<br>"; 
            $mensaje .= "Usuario: " . $oCliente->getEmail() . '<br>'; 
            $mensaje .= "Clave: " . $genClave . ' (proceda a cambiarla cuando su cuenta este activa.)<br>'; 
            $mensaje .= 'Para continuar con la activación de su cuenta, vaya al siguiente enlace: <br>
                        <a href="' . DIR_CART . '#/activacion/' . $params . '">activar cuenta</a><br>';

            $objEmail->setBodyHtml($objEmail->convertString($mensaje));
            $objEmail->setFrom($objEmail->getAccount(), $objEmail->convertString($objEmail->getName()) );
            $objEmail->addTo($oCliente->getEmail());
            $objEmail->setSubject($objEmail->convertString("Delibouquet - Activación de cuenta"));
            $objEmail->send($objEmail->getMailTrans());

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
            if (isset($formData['user']) and isset($formData['key'])) {
                $daoCliente = new Cliente();
                $daoCliente->activacionCliente($formData['user'], $formData['key']);
                $result['success'] = 1;
                $result['msg'] = "Se realizó el proceso de activación exitosamente, ahora puede ingresar como cliente en iniciar sesión de nuestra web. Gracias por registrarse como cliente.";
                $this->_helper->json->sendJson($result);
            } else {
                $this->getResponse()->setHttpResponseCode(500);
                echo Zend_Json_Encoder::encode( array("success" => 0, "msg" => "No se ha enviado los parametros necesarios para activar") );
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



