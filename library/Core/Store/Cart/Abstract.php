<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Abstract
 *
 * @author aramosr
 */
//Zend_Loader::loadClass('Core_Store_Cart_Item_Collection');
 
abstract class Core_Store_Cart_Abstract
{
    protected $_contents = null;
 
    protected $_total = 0;
 
    protected $_weight = 0;
   
    protected $_totalTax = 0;
   
    protected $_taxValue = 19;
 
    protected $_fechaDespacho = '';
 
    protected $_horaDespacho = '';
    
    protected $_personaRecepcion = '';
    
    protected $_direccionDespacho = '';
    
    protected $_direccionFactura = '';
    
    protected $_totalCombo = 0;
    
    protected $_totalFlete = 0;
    
    protected $_combo = '';
    
    protected function __construct()
    {
        $this->reset();
    }
 
    abstract public function reset($reset_database = false);
 
    abstract public function addCart(Core_Store_Cart_Item $item);
 
    abstract public function updateQuantity($products_id, $quantity);
 
    abstract public function cleanup();
 
    abstract public function countContents();
 
    abstract public function getQuantity($products_id);
 
    abstract public function inCart($products_id);
    
    /**
     *
     * @param mixed $productoId
     * @return Core_Store_Product
     */
    abstract public function findProducto($productoId);
    
 
    abstract public function remove($products_id);
 
    abstract public function removeAll();
 
    /**
     *
     * @return Core_Store_Cart_Item_Collection 
     */
    abstract public function getProducts();
 
    abstract public function getContents();
 
    abstract public function getTotal();
 
    abstract public function getWeight();
 
    abstract public function getFechaDespacho();
 
    abstract public function setFechaDespacho($fechaDespacho);
 
    abstract public function getHoraDespacho();
 
    abstract public function setHoraDespacho($horaDespacho);
 
    abstract public function getPersonaRecepcion();
 
    abstract public function setPersonaRecepcion($personaRecepcion);
 
    abstract public function getDireccionDespacho();
 
    abstract public function setDireccionDespacho($direccionDespacho);
    
    abstract public function getDireccionFactura();
 
    abstract public function setDireccionFactura($direccionFactura);
    
    abstract public function getTotalCombo();
    
    abstract public function setTotalCombo($totalCombo);
    
    abstract public function getTotalFlete();
    
    abstract public function setTotalFlete($totalFlete);
    
    abstract public function getCombo();
    
    abstract public function setCombo($combo);
    
    public function save()
    {
        try {
            $sessionData = Zend_Registry::get('coreSession');
 
            if (isset($sessionData->cart)) {
                unset($sessionData->cart);
            }
 
            $sessionData->cart = $this;
 
        } catch (Exception $e) {
            print "Message: " . $e->getMessage() . "\n";
        }
    }
}
?>
