<?php

class Api_ProductosController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

//        $bootstrap = $this->getInvokeArg('bootstrap');   
//        $options = $bootstrap->getOption('resources');   
//        $contextSwitch = $this->_helper->getHelper('contextSwitch'); 
//        $contextSwitch->addActionContext('index', array('xml','json'))->initContext();
        
          $this->_todo = array (
            "1" => "Buy milk",
            "2" => "Pour glass of milk",
            "3" => "Eat cookies"
          );    
    }

    public function indexAction()
    {
        $apiKey = $this->getRequest()->getHeader('CommonApikey');
        // get the hash of the request
        $requestHash = $this->getRequest()->getHeader('CommonRequestHash');
        echo 'apiKey: ' . $apiKey . '  --  requestHash: ' . $requestHash;
        echo Zend_Json::encode($this->_todo);
    }

    public function getAction()
    {
//        echo Zend_Json::encode($this->_todo);
//        $this->getResponse()->setBody('Hello World');
//        $this->getResponse()->setHttpResponseCode(200);
    }

    public function postAction()
    {
        // action body
        echo Zend_Json::encode($this->_todo);
        $this->getResponse()->setBody('Hello World');
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function putAction()
    {
        echo Zend_Json::encode($this->_todo);
    }

    public function deleteAction()
    {
        // action body
    }


}









