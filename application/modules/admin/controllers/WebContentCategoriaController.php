<?php
use web\Services\ContentCategoria;

class Admin_WebContentCategoriaController extends Zend_Controller_Action
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

    public function listAction()
    {
        try {
            if ($this->getRequest()->getPost()) {
                $data = $this->getRequest()->getParams();
                if(!isset($data['padre']))
                    throw new Exception("No ha seleccionado categoria.");
                $idpadre = $data['padre'];
                $srvContentCate = new ContentCategoria();
                $aTree = $srvContentCate ->listTree($idpadre, 1, true);
                echo $aTree['str'];
            }
        } catch(Exception $e) {
            echo Zend_Json_Encoder::encode( array("success" => 0,"data" => null,"msg" => "Error: ".$e->getMessage()) );
        }
    }
}



