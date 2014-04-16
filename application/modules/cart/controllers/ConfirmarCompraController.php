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
            var_dump($cartData);
            try {
                $srvOrden = new OrdenService();
                $oOrden = $srvOrden->terminarTransaccionVisa($cartData['eticket']);
                
                $this->_redirect("http://www.delibouquet.pe/cart/#/confirmacion-compra?eticket=" . $cartData['ETICKET']);
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



