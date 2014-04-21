<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartOrdenDetalle
 *
 * @ORM\Table(name="cart_orden__detalle")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartOrdenDetalleRepository")
 */
class CartOrdenDetalle
{
    /**
     * @var integer $idOrdenDetalle
     *
     * @ORM\Column(name="__id_orden_detalle", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrdenDetalle;

    /**
     * @var string $productoNombre
     *
     * @ORM\Column(name="__producto_nombre", type="string", length=170, nullable=true)
     */
    private $productoNombre;

    /**
     * @var float $cantidad
     *
     * @ORM\Column(name="__cantidad", type="float", nullable=true)
     */
    private $cantidad;

    /**
     * @var float $precioUnitario
     *
     * @ORM\Column(name="__precio_unitario", type="float", nullable=true)
     */
    private $precioUnitario;

    /**
     * @var float $precioTotal
     *
     * @ORM\Column(name="__precio_total", type="float", nullable=true)
     */
    private $precioTotal;

    /**
     * @var float $impuestoTotal
     *
     * @ORM\Column(name="__impuesto_total", type="float", nullable=true)
     */
    private $impuestoTotal;

    /**
     * @var float $impuestoRatio
     *
     * @ORM\Column(name="__impuesto_ratio", type="float", nullable=true)
     */
    private $impuestoRatio;

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
     * @var cart\Entity\CartOrden
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartOrden", inversedBy="detalle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_orden", referencedColumnName="__id_orden", onDelete="CASCADE")
     * })
     */
    private $orden;

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
     * Get idOrdenDetalle
     *
     * @return integer 
     */
    public function getIdOrdenDetalle()
    {
        return $this->idOrdenDetalle;
    }

    /**
     * Set productoNombre
     *
     * @param string $productoNombre
     * @return CartOrdenDetalle
     */
    public function setProductoNombre($productoNombre)
    {
        $this->productoNombre = $productoNombre;
    
        return $this;
    }

    /**
     * Get productoNombre
     *
     * @return string 
     */
    public function getProductoNombre()
    {
        return $this->productoNombre;
    }

    /**
     * Set cantidad
     *
     * @param float $cantidad
     * @return CartOrdenDetalle
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
     * Set precioUnitario
     *
     * @param float $precioUnitario
     * @return CartOrdenDetalle
     */
    public function setPrecioUnitario($precioUnitario)
    {
        $this->precioUnitario = $precioUnitario;
    
        return $this;
    }

    /**
     * Get precioUnitario
     *
     * @return float 
     */
    public function getPrecioUnitario()
    {
        return $this->precioUnitario;
    }

    /**
     * Set precioTotal
     *
     * @param float $precioTotal
     * @return CartOrdenDetalle
     */
    public function setPrecioTotal($precioTotal)
    {
        $this->precioTotal = $precioTotal;
    
        return $this;
    }

    /**
     * Get precioTotal
     *
     * @return float 
     */
    public function getPrecioTotal()
    {
        return $this->precioTotal;
    }

    /**
     * Set impuestoTotal
     *
     * @param float $impuestoTotal
     * @return CartOrdenDetalle
     */
    public function setImpuestoTotal($impuestoTotal)
    {
        $this->impuestoTotal = $impuestoTotal;
    
        return $this;
    }

    /**
     * Get impuestoTotal
     *
     * @return float 
     */
    public function getImpuestoTotal()
    {
        return $this->impuestoTotal;
    }

    /**
     * Set impuestoRatio
     *
     * @param float $impuestoRatio
     * @return CartOrdenDetalle
     */
    public function setImpuestoRatio($impuestoRatio)
    {
        $this->impuestoRatio = $impuestoRatio;
    
        return $this;
    }

    /**
     * Get impuestoRatio
     *
     * @return float 
     */
    public function getImpuestoRatio()
    {
        return $this->impuestoRatio;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return CartOrdenDetalle
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
     * @return CartOrdenDetalle
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
     * Set orden
     *
     * @param cart\Entity\CartOrden $orden
     * @return CartOrdenDetalle
     */
    public function setOrden(\cart\Entity\CartOrden $orden = null)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return cart\Entity\CartOrden 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set producto
     *
     * @param cart\Entity\CartProducto $producto
     * @return CartOrdenDetalle
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