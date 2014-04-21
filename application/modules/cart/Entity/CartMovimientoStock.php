<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartMovimientoStock
 *
 * @ORM\Table(name="cart_movimiento__stock")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartMovimientoStockRepository")
 */
class CartMovimientoStock
{
    /**
     * @var integer $idMovimientoStock
     *
     * @ORM\Column(name="__id_movimiento_stock", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMovimientoStock;

    /**
     * @var integer $cantidad
     *
     * @ORM\Column(name="__cantidad", type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @var integer $iduser
     *
     * @ORM\Column(name="__idUser", type="integer", nullable=true)
     */
    private $iduser;

    /**
     * @var \DateTime $fechaCaducidad
     *
     * @ORM\Column(name="__fecha_caducidad", type="datetime", nullable=true)
     */
    private $fechaCaducidad;

    /**
     * @var \DateTime $fechaRegistro
     *
     * @ORM\Column(name="__fecha_registro", type="datetime", nullable=false)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime $fechaActualizacion
     *
     * @ORM\Column(name="__fecha_actualizacion", type="datetime", nullable=true)
     */
    private $fechaActualizacion;

    /**
     * @var cart\Entity\CartOrden
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartOrden")
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
     * @var cart\Entity\CartMovimientoStockTipo
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartMovimientoStockTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_movimiento_stock_tipo", referencedColumnName="__id_movimiento_stock_tipo")
     * })
     */
    private $movimientoStockTipo;


    /**
     * Get idMovimientoStock
     *
     * @return integer 
     */
    public function getIdMovimientoStock()
    {
        return $this->idMovimientoStock;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return CartMovimientoStock
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     * @return CartMovimientoStock
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    
        return $this;
    }

    /**
     * Get iduser
     *
     * @return integer 
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set fechaCaducidad
     *
     * @param \DateTime $fechaCaducidad
     * @return CartMovimientoStock
     */
    public function setFechaCaducidad($fechaCaducidad)
    {
        $this->fechaCaducidad = $fechaCaducidad;
    
        return $this;
    }

    /**
     * Get fechaCaducidad
     *
     * @return \DateTime 
     */
    public function getFechaCaducidad()
    {
        return $this->fechaCaducidad;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return CartMovimientoStock
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
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return CartMovimientoStock
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;
    
        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime 
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * Set orden
     *
     * @param cart\Entity\CartOrden $orden
     * @return CartMovimientoStock
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
     * @return CartMovimientoStock
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

    /**
     * Set movimientoStockTipo
     *
     * @param cart\Entity\CartMovimientoStockTipo $movimientoStockTipo
     * @return CartMovimientoStock
     */
    public function setMovimientoStockTipo(\cart\Entity\CartMovimientoStockTipo $movimientoStockTipo = null)
    {
        $this->movimientoStockTipo = $movimientoStockTipo;
    
        return $this;
    }

    /**
     * Get movimientoStockTipo
     *
     * @return cart\Entity\CartMovimientoStockTipo 
     */
    public function getMovimientoStockTipo()
    {
        return $this->movimientoStockTipo;
    }
    
    /**
     * @var \DateTime $fechaIngreso
     *
     * @ORM\Column(name="__fecha_ingreso", type="datetime", nullable=true)
     */
    private $fechaIngreso;


    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     * @return CartMovimientoStock
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;
    
        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime 
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }
}