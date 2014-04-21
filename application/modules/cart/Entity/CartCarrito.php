<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartCarrito
 *
 * @ORM\Table(name="cart_carrito")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartCarritoRepository")
 */
class CartCarrito
{
    /**
     * @var integer $idCarrito
     *
     * @ORM\Column(name="__id_carrito", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCarrito;

    /**
     * @var boolean $procesado
     *
     * @ORM\Column(name="__procesado", type="boolean", nullable=true)
     */
    private $procesado;

    /**
     * @var string $secureKey
     *
     * @ORM\Column(name="__secure_key", type="string", length=32, nullable=true)
     */
    private $secureKey;

    /**
     * @var boolean $reciclar
     *
     * @ORM\Column(name="__reciclar", type="boolean", nullable=true)
     */
    private $reciclar;

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
     * @var string $direccionEnvio
     *
     * @ORM\Column(name="__direccion_envio", type="string", length=250, nullable=true)
     */
    private $direccionEnvio;

    /**
     * @var string $direccionPago
     *
     * @ORM\Column(name="__direccion_pago", type="string", length=250, nullable=true)
     */
    private $direccionPago;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="cart\Entity\CartCarritoProducto", mappedBy="carrito", cascade={"persist","remove"})
     */
    private $detalle;

    /**
     * @var cart\Entity\CartMoneda
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartMoneda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_moneda", referencedColumnName="__id_moneda")
     * })
     */
    private $moneda;

    /**
     * @var web\Entity\CmsCliente
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsCliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_cliente", referencedColumnName="__id_cliente", onDelete="CASCADE")
     * })
     */
    private $cliente;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detalle = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idCarrito
     *
     * @return integer 
     */
    public function getIdCarrito()
    {
        return $this->idCarrito;
    }

    /**
     * Set procesado
     *
     * @param boolean $procesado
     * @return CartCarrito
     */
    public function setProcesado($procesado)
    {
        $this->procesado = $procesado;
    
        return $this;
    }

    /**
     * Get procesado
     *
     * @return boolean 
     */
    public function getProcesado()
    {
        return $this->procesado;
    }

    /**
     * Set secureKey
     *
     * @param string $secureKey
     * @return CartCarrito
     */
    public function setSecureKey($secureKey)
    {
        $this->secureKey = $secureKey;
    
        return $this;
    }

    /**
     * Get secureKey
     *
     * @return string 
     */
    public function getSecureKey()
    {
        return $this->secureKey;
    }

    /**
     * Set reciclar
     *
     * @param boolean $reciclar
     * @return CartCarrito
     */
    public function setReciclar($reciclar)
    {
        $this->reciclar = $reciclar;
    
        return $this;
    }

    /**
     * Get reciclar
     *
     * @return boolean 
     */
    public function getReciclar()
    {
        return $this->reciclar;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return CartCarrito
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
     * @return CartCarrito
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
     * Set direccionEnvio
     *
     * @param string $direccionEnvio
     * @return CartCarrito
     */
    public function setDireccionEnvio($direccionEnvio)
    {
        $this->direccionEnvio = $direccionEnvio;
    
        return $this;
    }

    /**
     * Get direccionEnvio
     *
     * @return string 
     */
    public function getDireccionEnvio()
    {
        return $this->direccionEnvio;
    }

    /**
     * Set direccionPago
     *
     * @param string $direccionPago
     * @return CartCarrito
     */
    public function setDireccionPago($direccionPago)
    {
        $this->direccionPago = $direccionPago;
    
        return $this;
    }

    /**
     * Get direccionPago
     *
     * @return string 
     */
    public function getDireccionPago()
    {
        return $this->direccionPago;
    }

    /**
     * Add detalle
     *
     * @param cart\Entity\CartCarritoProducto $detalle
     * @return CartCarrito
     */
    public function addDetalle(\cart\Entity\CartCarritoProducto $detalle)
    {
        $this->detalle[] = $detalle;
    
        return $this;
    }

    /**
     * Remove detalle
     *
     * @param cart\Entity\CartCarritoProducto $detalle
     */
    public function removeDetalle(\cart\Entity\CartCarritoProducto $detalle)
    {
        $this->detalle->removeElement($detalle);
    }

    /**
     * Get detalle
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set moneda
     *
     * @param cart\Entity\CartMoneda $moneda
     * @return CartCarrito
     */
    public function setMoneda(\cart\Entity\CartMoneda $moneda = null)
    {
        $this->moneda = $moneda;
    
        return $this;
    }

    /**
     * Get moneda
     *
     * @return cart\Entity\CartMoneda 
     */
    public function getMoneda()
    {
        return $this->moneda;
    }

    /**
     * Set cliente
     *
     * @param web\Entity\CmsCliente $cliente
     * @return CartCarrito
     */
    public function setCliente(\web\Entity\CmsCliente $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return web\Entity\CmsCliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }
}