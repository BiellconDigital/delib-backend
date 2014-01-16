<?php
use web\Services\ContentGaleria;

class Web_IndexController extends Zend_Controller_Action
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
        try {
            $authSesion = new Zend_Session_Namespace(SES_USER);
//            $idConte = 6;
//            $daoAlbumGaleria = new ContentGaleria();
//            list($aContentGale, $count, $oContent) = $daoAlbumGaleria->aList($idConte, $authSesion->oLanguage);

//            $this -> view -> aGaleria = $aContentGale;
//            $this -> view -> idioma = $authSesion->idioma;
            $this -> view -> messages = $this->_flashMessenger->getCurrentMessages();
        } catch (Exception $e) {
            $this->_flashMessenger->addMessage('Esta página no está disponible. ' . $e->getMessage());
        }
        
    }

    public function cambiarIdiomaAction()
    {
        $idioma = $this->_getParam("idio", "es");
        if (!in_array($idioma, array("es","en"))) $idioma = "es";
        
        $authSesion = new Zend_Session_Namespace(SES_USER);
        $authSesion->idioma = $idioma;
        //$authSesion->lastController ."/" .$authSesion->lastAction .
        $this->_redirect( WEB_DOMAIN . $authSesion->lastUrl);//$authSesion->lastModule
    }

    public function inglesAction()
    {
        // action body
    }


}





