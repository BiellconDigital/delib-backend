<?php
//Zend_Loader::loadClass('Core_Store_Cart_Abstract');
 
class Core_Store_Cart_Abstract_StandardCart extends Core_Store_Cart_Abstract
{
    static private $_instance = null;
 
    protected function __construct()
    {
        parent::__construct();
    }
 
    static public function getInstance()
    {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self();
        }
 
        return self::$_instance;
    }
 
    public function reset($resetDatabase = false)
    {
        $this->_contents = new Core_Store_Cart_Item_Collection();
        $this->_total = 0;
        $this->_weight = 0;
 
        $sessionData = Zend_Registry::getInstance()->get('coreSession');
 
        if (isset($sessionData->cartId)) {
            unset($sessionData->cartId);
        }
    }
 
    public function addCart(Core_Store_Cart_Item $item)
    {
        if ($this->inCart($item->getId())) {
            $this->updateQuantity($item->getId(), $item->getQuantity());
        } else {
            $this->_contents->addItem($item->getId(), $item);
            $this->cleanup();
        }
    }
 
    public function updateQuantity($productId, $quantity, $qtyFromPost = false)
    {
        $item = $this->findProducto($productId);
 
        if ($item !== null) {
            $quantity = ($qtyFromPost === true)? $quantity: $item->getQuantity() + $quantity;
            $item->setQuantity($quantity);
               
            $this->cleanup();
        }
    }
 
    public function cleanup()
    {
        foreach( $this->_contents->getIterator() as $key => $value ) {
            if ( $this->getQuantity($key) <1 ) {
                $this->_contents->detach($key);
            }
        }
    }
 
    public function countContents()
    {
        return (int)$this->_contents->count();
    }
 
    public function getQuantity($productId)
    {
        if ( $this->inCart($productId) ) {
            if(($item = $this->_contents->getItem($productId)) && ($item->getQuantity()> 0) ){
                return $item->getQuantity();
            }
            return 0;
        } else {
            return 0;
        }
    }
 
    public function inCart($productId)
    {
        return $this->_contents->offsetExists($productId);
    }
 
    public function has($productId)
    {
        return $this->inCart($productId);
    }
   
    /**
     *
     * @param mixed $productoId
     * @return Core_Store_Product
     */
    public function findProducto($productoId) {
        if($this->inCart($productoId)){
            return $this->_contents->getItem($productoId);
        }
        return null;
    }
 
    public function remove($productId)
    {
        $product = $this->findProducto($productId);
        if ($product !== null) {
            $this->_contents->detach($product);
        }
    }
 
    public function removeProductos(ArrayAccess $productIds) {
        if ($productIds !== null) {
 
            for($iterator = $productIds->getIterator();
            $iterator->valid();
            $iterator->next()) {
                $this->remove((String)$iterator->current());
            }
        }
    }
 
    public function removeAll()
    {
        $this->reset();
    }
 
    /**
     *
     * @return Core_Store_Cart_Item_Collection 
     */
    public function getProducts()
    {
        $this->calculateTotals();
        return $this->_contents;
    }
 
    public function calculateTotals()
    {
        $this->_total = 0;
        $this->_weight = 0;
 
        foreach ($this->_contents->getIterator() as $productsId => $item)
        {
 
            $this->_weight += ($item->getQuantity() * $item->getWeight());
            $this->_total += $item->getImporte();
        }
    }
 
    public function getContents()
    {
        return $this->_contents;
    }
 
    public function getTotal()
    {
        return (double)$this->_total;
    }
 
    public function getWeight()
    {
        return (double)$this->_weight;
    }
    
    public function getFechaDespacho() {
        return $this->_fechaDespacho;
    }
    
    public function setFechaDespacho($fechaDespacho) {
        $this->_fechaDespacho = $fechaDespacho;
    }
    
    public function getHoraDespacho() {
        return $this->_horaDespacho;
    }
    
    public function setHoraDespacho($horaDespacho) {
        $this->_horaDespacho = $horaDespacho;
    }
    
    public function getPersonaRecepcion() {
        return $this->_personaRecepcion;
    }
    
    public function setPersonaRecepcion($personaRecepcion) {
        $this->_personaRecepcion = $personaRecepcion;
    }

    public function getDireccionDespacho() {
        return $this->_direccionDespacho;
    }

    public function setDireccionDespacho($direccionDespacho) {
        $this->_direccionDespacho = $direccionDespacho;
    }
    
    public function getDireccionFactura() {
        return $this->_direccionFactura;
    }

    public function setDireccionFactura($direccionFactura) {
        $this->_direccionFactura = $direccionFactura;
    }
    
    public function getTotalCombo() {
        return $this->_totalCombo;
    }
    
    public function setTotalCombo($totalCombo) {
        $this->_totalCombo = $totalCombo;
    }
    
    public function getTotalFlete() {
        return $this->_totalFlete;
    }
    
    public function setTotalFlete($totalFlete) {
        $this->_totalFlete = $totalFlete;
    }
    
    public function getCombo() {
        return $this->_combo;
    }
    
    public function setCombo($combo) {
        $this->_combo = $combo;
    }
    
}
