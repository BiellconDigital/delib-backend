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
            if ($_SERVER['HTTP_ORIGIN'] === DOMINIO_VISA) {
                $cartData = $this->getRequest()->getParams();
//                var_dump($_SERVER);
                try {
                    $srvOrden = new OrdenService();
                    $oOrden = $srvOrden->terminarTransaccionVisa($cartData['eticket']);

                    $this->_redirect("http://www.delibouquet.pe/cart/#/confirmacion-compra?eticket=" . $cartData['eticket']);
                } catch(ValidacionException $e) {
                    echo $e->getMessage();
                } catch(\Exception $e) {
                    echo "Ocurrio un error en el proceso.";// . $e->getMessage();
                }
            } else {
                echo "No esta autorizado para realizar esta transaccion.";
            }
        } else {
            echo "La peticion no es correcta.";
        }
    }

}



