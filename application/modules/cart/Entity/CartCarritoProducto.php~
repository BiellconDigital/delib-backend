<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartCarritoProducto
 *
 * @ORM\Table(name="cart_carrito__producto")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartCarritoProductoRepository")
 */
class CartCarritoProducto
{
    /**
     * @var integer $idCarritoProducto
     *
     * @ORM\Column(name="__id_carrito_producto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCarritoProducto;

    /**
     * @var float $cantidad
     *
     * @ORM\Column(name="__cantidad", type="float", nullable=false)
     */
    private $cantidad;

    /**
     * @var float $precio
     *
     * @ORM\Column(name="__precio", type="float", nullable=false)
     */
    private $precio;

    /**
     * @var \DateTime $fechaRegistro
     *
     * @ORM\Column(name="__fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime $fechaModificacion
     *
     * @ORM\Column(name="__fecha_modificacion", type="datetime", nullable=true)
     */
    private $fechaModificacion;

    /**
     * @var cart\Entity\CartCarrito
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartCarrito", inversedBy="detalle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_carrito", referencedColumnName="__id_carrito", onDelete="CASCADE")
     * })
     */
    private $carrito;

    /**
     * @var cart\Entity\CartProducto
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idProducto", referencedColumnName="__idProducto", onDelete="CASCADE")
     * })
     */
    private $producto;


    /**
     * Get idCarritoProducto
     *
     * @return integer 
     */
    public function getIdCarritoProducto()
    {
        return $this->idCarritoProducto;
    }

    /**
     * Set cantidad
     *
     * @param float $cantidad
     * @return CartCarritoProducto
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return CartCarritoProducto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return CartCarritoProducto
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    
        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return CartCarritoProducto
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    
        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set carrito
     *
     * @param cart\Entity\CartCarrito $carrito
     * @return CartCarritoProducto
     */
    public function setCarrito(\cart\Entity\CartCarrito $carrito = null)
    {
        $this->carrito = $carrito;
    
        return $this;
    }

    /**
     * Get carrito
     *
     * @return cart\Entity\CartCarrito 
     */
    public function getCarrito()
    {
        return $this->carrito;
    }

    /**
     * Set producto
     *
     * @param cart\Entity\CartProducto $producto
     * @return CartCarritoProducto
     */
    public function setProducto(\cart\Entity\CartProducto $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return cart\Entity\CartProducto 
     */
    public function getProducto()
    {
        return $this->producto;
    }
}