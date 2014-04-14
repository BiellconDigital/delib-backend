<?php
use cart\Services\OrdenService;
use Tonyprr\Exception\ValidacionException;

class Cart_ConfirmarCompraController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
    }

    public function indexAction()
    {
    }

    public function visaAction()
    {
        if ($this->getRequest()->getPost()) {
            $cartData = $this->getRequest()->getParams();
            try {
                $srvOrden = new OrdenService();
                $oOrden = $srvOrden->terminarTransaccionVisa($cartData['ETICKET']);
                
                $this->_redirect("http://www.delibouquet.pe/cart/#/confirmacion-compra");
            } catch(ValidacionException $e) {
                echo $e->getMessage();
            } catch(Exception $e) {
                echo "Ocurrió un error en el proceso.";
            }
        } else {
            echo "La peticion no es correcta.";
        }
    }

}



