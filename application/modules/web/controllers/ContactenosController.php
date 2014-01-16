<?php

class Web_ContactenosController extends Zend_Controller_Action
{
    private $_flashMessenger = null;

    public function init()
    {
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->_flashMessenger->clearCurrentMessages();
        $this->initView();
    }

    public function indexAction()
    {
//        $formData = $this->_request->getParams();
//        if (isset($formData['bad'])) {
//            $this->_flashMessenger->addMessage("Ingrese todos los campos obligatorios.");
//        }
        $authSesion = new Zend_Session_Namespace(SES_USER);
//        $this->_helper->layout->setLayout('web-contactenos');
        $this -> view -> idioma = $authSesion->idioma;
        try {
            $valido = true;
            if ($this->_request->getPost()) {
                $formData = $this->_request->getPost();
                if ($valido) {

                    $fNombre = $formData['contact_nom'];
                    $fApellidos = $formData['contact_apell'];
                    $fEmpresa = $formData['contact_empresa'];
//                    $fPais = $formData['contact_pais'];
//                    $fCiudad = $formData['contact_ciudad'];
                    $fEmail = $formData['contact_correo'];
                    $fTelefono = $formData['contact_telef'];
                    $fMensaje = $formData['contact_msj'];
                    if ($fNombre == "" || $fApellidos == "" || $fEmail == "" || $fMensaje == "") {
//                        $this->_redirect("/contactenos/index/bad/1");
                        $this->_flashMessenger->addMessage("Ingrese todos los campos obligatorios.");
                    } else {

                        $template_email=file_get_contents(PTH_PUBLIC . '/../' . 'application' . DS. 'modules' . DS. 'web'. DS  ."templates/contacto.tpl", true);
                        if($template_email==false) {
                            $error_last=error_get_last();
                            $this->_flashMessenger->addMessage('Error: '.$error_last['message']);
                        } else {
                                $objEmail = new \Tonyprr_Email();
                                $template_email = str_replace("{tpl_nombre}",$fNombre,$template_email);
                                $template_email = str_replace("{tpl_apellidos}",$fApellidos,$template_email);
                                $template_email = str_replace("{tpl_telefono}",$fTelefono,$template_email);
                                $template_email = str_replace("{tpl_empresa}",$fEmpresa,$template_email);
//                                $template_email = str_replace("{tpl_pais}",$fPais,$template_email);
//                                $template_email = str_replace("{tpl_ciudad}",$fCiudad,$template_email);
                                $template_email = str_replace("{tpl_mensaje}",  nl2br($fMensaje),$template_email);

                                $objEmail->setBodyHtml($objEmail->convertString($template_email));
                                $objEmail->addTo($objEmail->getAccount(), $objEmail->convertString($objEmail->getName()) );
                                $objEmail->setFrom($fEmail, $objEmail->convertString($fNombre));

                                $objEmail->setSubject($objEmail->convertString('Contacto Reset - ' . $fNombre . ' '. $fApellidos));
                                $objEmail->send($objEmail->getMailTrans());//$cn_mail
                                $translate = \Zend_Registry::get('Zend_Translate');

                                $this->_flashMessenger->addMessage( $translate->translate("MSJ_ENVIAR") );
                        }
                    }
                    //$this->view->form = $form;
                } else {
//                    $form->populate($formData);
//                    $this->view->form = $form;
                }
            }
        
        } catch (Exception $e) {
            $this->_flashMessenger->addMessage('Ocurrió un error en el proceso de envío. ' . $e->getMessage());
        }
        $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
        
    }

    public function enviarAction()
    {
        $authSesion = new Zend_Session_Namespace(SES_USER);
        $this->_helper->layout->setLayout('web-contactenos');
        $this -> view -> idioma = $authSesion->idioma;
        try {
            $valido = true;
            if ($this->_request->getPost()) {
                $formData = $this->_request->getPost();
                if ($valido) {

                    $fNombre = $formData['contact_nom'];
                    $fApellidos = $formData['contact_apell'];
                    $fEmpresa = $formData['contact_empresa'];
                    $fPais = $formData['contact_pais'];
                    $fCiudad = $formData['contact_ciudad'];
                    $fEmail = $formData['contact_correo'];
                    $fTelefono = $formData['contact_telef'];
                    $fMensaje = $formData['contact_msj'];
                    if ($fNombre == "" || $fApellidos == "" || $fEmail == "" || $fMensaje == "") {
                        $this->_redirect("/contactenos/index/bad/1");
                    } else {

                        $template_email=file_get_contents(PTH_PUBLIC . '/../' . 'application' . DS. 'modules' . DS. 'web'. DS  ."templates/contacto.tpl", true);
                        if($template_email==false) {
                            $error_last=error_get_last();
                            $this->_flashMessenger->addMessage('Error: '.$error_last['message']);
                        } else {
                                $objEmail = new \Tonyprr_Email();
                                $template_email = str_replace("{tpl_nombre}",$fNombre,$template_email);
                                $template_email = str_replace("{tpl_apellidos}",$fApellidos,$template_email);
                                $template_email = str_replace("{tpl_telefono}",$fTelefono,$template_email);
                                $template_email = str_replace("{tpl_empresa}",$fEmpresa,$template_email);
                                $template_email = str_replace("{tpl_pais}",$fPais,$template_email);
                                $template_email = str_replace("{tpl_ciudad}",$fCiudad,$template_email);
                                $template_email = str_replace("{tpl_mensaje}",  nl2br($fMensaje),$template_email);

                                $objEmail->setBodyHtml($objEmail->convertString($template_email));
                                $objEmail->addTo($objEmail->getAccount(), $objEmail->convertString($objEmail->getName()) );
                                $objEmail->setFrom($fEmail, $objEmail->convertString($fNombre));

                                $objEmail->setSubject($objEmail->convertString('Vadimar - Contacto'));
                                $objEmail->send($objEmail->getMailTrans());//$cn_mail
                                $translate = \Zend_Registry::get('Zend_Translate');

                                $this->_flashMessenger->addMessage( $translate->translate("MSJ_ENVIAR") );
                        }
                    }
                    //$this->view->form = $form;
                } else {
//                    $form->populate($formData);
//                    $this->view->form = $form;
                }
            }
        
        } catch (Exception $e) {
            $this->_flashMessenger->addMessage('Ocurrió un error en el proceso de envío. ' . $e->getMessage());
        }
        $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
    }
    
}



