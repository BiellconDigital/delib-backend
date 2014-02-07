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

    public function postAction()
    {
            $varCart = '';
            $redirectCart = '';
            if ($this->getRequest()->getParam("cart", 0) !=0 ) {
                $varCart = 'cart/1';
                $redirectCart = 'compra/despacho';
            }
            
                    
            $form = new web_Forms_LoginCliente(array(
                'action' => $this->_request->getBaseUrl() . '/' . $this->getRequest()->getControllerName() . '/' . $this->getRequest()->getActionName() . '/' . $varCart,
                'submitLabel' => 'Enviar...'
            ));

            if ($this->_request->getPost()) {
                $formData = $this->_request->getPost();
                if ($form->isValid($formData)) {
//                        $daoCliente = new Cliente();
//                        $daoCliente->save($formData);
                        $em = \Zend_Registry::get('em');
//                        $db = Zend_Registry::get('db'); // lee la configuracion de la base datos
                        $authAdapter = new Tonyprr_Auth_Adapter_Doctrine($em);
                        
                        $authAdapter->setEntityName('\Models\CmsCliente'); // selecciono la tabla
                        $authAdapter->setIdentityField('email'); // columna de identidad
                        $authAdapter->setCredentialField('clave'); // columna de credenciales
                        $authAdapter->setConditionsFields(array('estado' => 1));
                        $authAdapter->setIdentity( $form->getValue('email') );
                        $authAdapter->setCredential( md5( $form->getValue('clave') ) );

//                        $authAdapter->setTableClass('\Models\CmsCliente'); // selecciono la tabla
//                        $authAdapter->setIdentityColumn('__email'); // columna de identidad
//                        $authAdapter->setCredentialColumn('__clave'); // columna de credenciales
//                        $authAdapter->setIdentity( $form->getValue('email') );
//                        $authAdapter->setCredential( md5( $form->getValue('clave') ) );
                        // hace la autenticacion
                        $auth = Zend_Auth::getInstance();
                        $result = $auth->authenticate($authAdapter);

                        if ($result->isValid())
                        {//
                                // si es valido guarda los datos
                                $resultData = $authAdapter->getResultRowObject();
                                $auth->getStorage()->write($resultData);
                                $this->_redirect('/' . $redirectCart);
                        } else {
                            $mensajes =$result->getMessages();
                            $this->_flashMessenger->addMessage($mensajes[0]);
                        }
                    
                    
                    $this->view->form = $form;
                } else {
                    $form->populate($formData);
                    $this->view->form = $form;
                }
            } else 
                $this->view->form = $form;
            $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
    }


}



