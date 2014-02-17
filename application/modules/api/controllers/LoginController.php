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
        
    }

    public function getAction()
    {
        echo "no tiene permisos";
    }

    public function postAction()
    {
            $body = $this->getRequest()->getRawBody();
            $formData = Zend_Json::decode($body);
            //var_dump($formData);
                        $em = \Zend_Registry::get('em');
                        $authAdapter = new Tonyprr_Auth_Adapter_Doctrine($em);
                        
                        $authAdapter->setEntityName('\web\Entity\CmsCliente'); // selecciono la tabla
                        $authAdapter->setIdentityField('email'); // columna de identidad
                        $authAdapter->setCredentialField('clave'); // columna de credenciales
                        $authAdapter->setConditionsFields(array('estado' => 1));
                        $authAdapter->setIdentity( $formData['username'] );
                        $authAdapter->setCredential( md5( $formData['password'] ) );
                        // hace la autenticacion
                        $auth = Zend_Auth::getInstance();
                        $resultAuth = $auth->authenticate($authAdapter);
                        if ($resultAuth->isValid())
                        {
                            // si es valido guarda los datos
                            $result = $authAdapter->getResultRowObject();
                            $fechaNac =$result['fechaNacimiento']->format("Y-m-d");
                            $auth->getStorage()->write($result);
                            $objRecords=\Tonyprr_lib_Records::getInstance();
                            $objRecords->normalizeRecord($result);
                            
                            $result['fechaNacimiento'] = $fechaNac;
                            $result['success'] = 1;
//                            $result['idCliente'] = $resultData['idCliente'];
//                            $result['email'] = $resultAuth->getIdentity();
                            $result['username'] = $result['nombres'];
                            unset($result['clave']);
//                            $result['role'] = $resultData['role'];
                            
                        } else {
                            $this->getResponse()->setHttpResponseCode(400);
                            $result['success'] = 0;
                            $result['api_key'] = null;
                        }

//                        $this->getResponse()
//                            ->setHeader('Content-type', 'application/json')
//                            ->setBody(json_encode($result));
//
//                        $response = $this->getResponse();
//                        $response->setHeader('Content-type', 'application/json', true);
//                        return $response->setBody(Zend_Json::encode($result));
//                        
//                            $this->getResponse()->setBody('resource created');
                        
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



