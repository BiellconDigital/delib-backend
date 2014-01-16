<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartOrden
 *
 * @ORM\Table(name="cart_orden")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartOrdenRepository")
 */
class CartOrden
{
    /**
     * @var integer $idOrden
     *
     * @ORM\Column(name="__id_orden", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrden;

    /**
     * @var integer $tipoDocumento
     *
     * @ORM\Column(name="__tipo_documento", type="integer", nullable=false)
     */
    private $tipoDocumento;

    /**
     * @var string $direccionEnvio
     *
     * @ORM\Column(name="__direccion_envio", type="string", length=250, nullable=false)
     */
    private $direccionEnvio;

    /**
     * @var string $direccionPago
     *
     * @ORM\Column(name="__direccion_pago", type="string", length=250, nullable=false)
     */
    private $direccionPago;

    /**
     * @var float $subTotal
     *
     * @ORM\Column(name="_sub__total", type="float", nullable=true)
     */
    private $subTotal;

    /**
     * @var float $totalImpuesto
     *
     * @ORM\Column(name="__total_impuesto", type="float", nullable=true)
     */
    private $totalImpuesto;

    /**
     * @var float $impuestoRatio
     *
     * @ORM\Column(name="__impuesto_ratio", type="float", nullable=true)
     */
    private $impuestoRatio;

    /**
     * @var float $total
     *
     * @ORM\Column(name="__total", type="float", nullable=true)
     */
    private $total;

    /**
     * @var float $totalDescuento
     *
     * @ORM\Column(name="__total_descuento", type="float", nullable=true)
     */
    private $totalDescuento;

    /**
     * @var float $totalFinal
     *
     * @ORM\Column(name="__total_final", type="float", nullable=true)
     */
    private $totalFinal;

    /**
     * @var float $costoEnvio
     *
     * @ORM\Column(name="__costo_envio", type="float", nullable=true)
     */
    private $costoEnvio;

    /**
     * @var string $cuentaBanco
     *
     * @ORM\Column(name="__cuenta_banco", type="string", length=150, nullable=true)
     */
    private $cuentaBanco;

    /**
     * @var \DateTime $fechaProcesado
     *
     * @ORM\Column(name="__fecha_procesado", type="datetime", nullable=true)
     */
    private $fechaProcesado;

    /**
     * @var \DateTime $fechaEnvio
     *
     * @ORM\Column(name="__fecha_envio", type="date", nullable=true)
     */
    private $fechaEnvio;

    /**
     * @var string $horaEnvio
     *
     * @ORM\Column(name="__hora_envio", type="string", length=14, nullable=true)
     */
    private $horaEnvio;

    /**
     * @var \DateTime $fechaModificado
     *
     * @ORM\Column(name="__fecha_modificado", type="datetime", nullable=true)
     */
    private $fechaModificado;

    /**
     * @var string $codigoVoucher
     *
     * @ORM\Column(name="__codigo_voucher", type="string", length=30, nullable=true)
     */
    private $codigoVoucher;

    /**
     * @var string $nroFactura
     *
     * @ORM\Column(name="__nro_factura", type="string", length=15, nullable=true)
     */
    private $nroFactura;

    /**
     * @var string $rucCliente
     *
     * @ORM\Column(name="__ruc_cliente", type="string", length=19, nullable=true)
     */
    private $rucCliente;

    /**
     * @var string $razonSocial
     *
     * @ORM\Column(name="__razon_social", type="string", length=140, nullable=true)
     */
    private $razonSocial;

    /**
     * @var string $personaRecepcion
     *
     * @ORM\Column(name="_persona__recepcion", type="string", length=50, nullable=true)
     */
    private $personaRecepcion;

    /**
     * @var \DateTime $fechaDeposito
     *
     * @ORM\Column(name="__fecha_deposito", type="date", nullable=true)
     */
    private $fechaDeposito;

    /**
     * @var string $horaDeposito
     *
     * @ORM\Column(name="__hora_deposito", type="string", length=10, nullable=true)
     */
    private $horaDeposito;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="cart\Entity\CartOrdenDetalle", mappedBy="orden", cascade={"persist","remove"})
     */
    private $detalle;

    /**
     * @var cart\Entity\CartCarrito
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartCarrito")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_carrito", referencedColumnName="__id_carrito")
     * })
     */
    private $carrito;

    /**
     * @var web\Entity\CmsCliente
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsCliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_cliente", referencedColumnName="__id_cliente")
     * })
     */
    private $cliente;

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
     * @var cart\Entity\CartOrdenEstado
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartOrdenEstado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_orden_estado", referencedColumnName="__id_orden_estado")
     * })
     */
    private $ordenEstado;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detalle = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idOrden
     *
     * @return integer 
     */
    public function getIdOrden()
    {
        return $this->idOrden;
    }

    /**
     * Set tipoDocumento
     *
     * @param integer $tipoDocumento
     * @return CartOrden
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    
        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return integer 
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set direccionEnvio
     *
     * @param string $direccionEnvio
     * @return CartOrden
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
     * @return CartOrden
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
     * Set subTotal
     *
     * @param float $subTotal
     * @return CartOrden
     */
    public function setSubTotal($subTotal)
    {
        $this->subTotal = $subTotal;
    
        return $this;
    }

    /**
     * Get subTotal
     *
     * @return float 
     */
    public function getSubTotal()
    {
        return $this->subTotal;
    }

    /**
     * Set totalImpuesto
     *
     * @param float $totalImpuesto
     * @return CartOrden
     */
    public function setTotalImpuesto($totalImpuesto)
    {
        $this->totalImpuesto = $totalImpuesto;
    
        return $this;
    }

    /**
     * Get totalImpuesto
     *
     * @return float 
     */
    public function getTotalImpuesto()
    {
        return $this->totalImpuesto;
    }

    /**
     * Set impuestoRatio
     *
     * @param float $impuestoRatio
     * @return CartOrden
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
     * Set total
     *
     * @param float $total
     * @return CartOrden
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set totalDescuento
     *
     * @param float $totalDescuento
     * @return CartOrden
     */
    public function setTotalDescuento($totalDescuento)
    {
        $this->totalDescuento = $totalDescuento;
    
        return $this;
    }

    /**
     * Get totalDescuento
     *
     * @return float 
     */
    public function getTotalDescuento()
    {
        return $this->totalDescuento;
    }

    /**
     * Set totalFinal
     *
     * @param float $totalFinal
     * @return CartOrden
     */
    public function setTotalFinal($totalFinal)
    {
        $this->totalFinal = $totalFinal;
    
        return $this;
    }

    /**
     * Get totalFinal
     *
     * @return float 
     */
    public function getTotalFinal()
    {
        return $this->totalFinal;
    }

    /**
     * Set costoEnvio
     *
     * @param float $costoEnvio
     * @return CartOrden
     */
    public function setCostoEnvio($costoEnvio)
    {
        $this->costoEnvio = $costoEnvio;
    
        return $this;
    }

    /**
     * Get costoEnvio
     *
     * @return float 
     */
    public function getCostoEnvio()
    {
        return $this->costoEnvio;
    }

    /**
     * Set cuentaBanco
     *
     * @param string $cuentaBanco
     * @return CartOrden
     */
    public function setCuentaBanco($cuentaBanco)
    {
        $this->cuentaBanco = $cuentaBanco;
    
        return $this;
    }

    /**
     * Get cuentaBanco
     *
     * @return string 
     */
    public function getCuentaBanco()
    {
        return $this->cuentaBanco;
    }

    /**
     * Set fechaProcesado
     *
     * @param \DateTime $fechaProcesado
     * @return CartOrden
     */
    public function setFechaProcesado($fechaProcesado)
    {
        $this->fechaProcesado = $fechaProcesado;
    
        return $this;
    }

    /**
     * Get fechaProcesado
     *
     * @return \DateTime 
     */
    public function getFechaProcesado()
    {
        return $this->fechaProcesado;
    }

    /**
     * Set fechaEnvio
     *
     * @param \DateTime $fechaEnvio
     * @return CartOrden
     */
    public function setFechaEnvio($fechaEnvio)
    {
        $this->fechaEnvio = $fechaEnvio;
    
        return $this;
    }

    /**
     * Get fechaEnvio
     *
     * @return \DateTime 
     */
    public function getFechaEnvio()
    {
        return $this->fechaEnvio;
    }

    /**
     * Set horaEnvio
     *
     * @param string $horaEnvio
     * @return CartOrden
     */
    public function setHoraEnvio($horaEnvio)
    {
        $this->horaEnvio = $horaEnvio;
    
        return $this;
    }

    /**
     * Get horaEnvio
     *
     * @return string 
     */
    public function getHoraEnvio()
    {
        return $this->horaEnvio;
    }

    /**
     * Set fechaModificado
     *
     * @param \DateTime $fechaModificado
     * @return CartOrden
     */
    public function setFechaModificado($fechaModificado)
    {
        $this->fechaModificado = $fechaModificado;
    
        return $this;
    }

    /**
     * Get fechaModificado
     *
     * @return \DateTime 
     */
    public function getFechaModificado()
    {
        return $this->fechaModificado;
    }

    /**
     * Set codigoVoucher
     *
     * @param string $codigoVoucher
     * @return CartOrden
     */
    public function setCodigoVoucher($codigoVoucher)
    {
        $this->codigoVoucher = $codigoVoucher;
    
        return $this;
    }

    /**
     * Get codigoVoucher
     *
     * @return string 
     */
    public function getCodigoVoucher()
    {
        return $this->codigoVoucher;
    }

    /**
     * Set nroFactura
     *
     * @param string $nroFactura
     * @return CartOrden
     */
    public function setNroFactura($nroFactura)
    {
        $this->nroFactura = $nroFactura;
    
        return $this;
    }

    /**
     * Get nroFactura
     *
     * @return string 
     */
    public function getNroFactura()
    {
        return $this->nroFactura;
    }

    /**
     * Set rucCliente
     *
     * @param string $rucCliente
     * @return CartOrden
     */
    public function setRucCliente($rucCliente)
    {
        $this->rucCliente = $rucCliente;
    
        return $this;
    }

    /**
     * Get rucCliente
     *
     * @return string 
     */
    public function getRucCliente()
    {
        return $this->rucCliente;
    }

    /**
     * Set razonSocial
     *
     * @param string $razonSocial
     * @return CartOrden
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;
    
        return $this;
    }

    /**
     * Get razonSocial
     *
     * @return string 
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * Set personaRecepcion
     *
     * @param string $personaRecepcion
     * @return CartOrden
     */
    public function setPersonaRecepcion($personaRecepcion)
    {
        $this->personaRecepcion = $personaRecepcion;
    
        return $this;
    }

    /**
     * Get personaRecepcion
     *
     * @return string 
     */
    public function getPersonaRecepcion()
    {
        return $this->personaRecepcion;
    }

    /**
     * Set fechaDeposito
     *
     * @param \DateTime $fechaDeposito
     * @return CartOrden
     */
    public function setFechaDeposito($fechaDeposito)
    {
        $this->fechaDeposito = $fechaDeposito;
    
        return $this;
    }

    /**
     * Get fechaDeposito
     *
     * @return \DateTime 
     */
    public function getFechaDeposito()
    {
        return $this->fechaDeposito;
    }

    /**
     * Set horaDeposito
     *
     * @param string $horaDeposito
     * @return CartOrden
     */
    public function setHoraDeposito($horaDeposito)
    {
        $this->horaDeposito = $horaDeposito;
    
        return $this;
    }

    /**
     * Get horaDeposito
     *
     * @return string 
     */
    public function getHoraDeposito()
    {
        return $this->horaDeposito;
    }

    /**
     * Add detalle
     *
     * @param cart\Entity\CartOrdenDetalle $detalle
     * @return CartOrden
     */
    public function addDetalle(\cart\Entity\CartOrdenDetalle $detalle)
    {
        $this->detalle[] = $detalle;
    
        return $this;
    }

    /**
     * Remove detalle
     *
     * @param cart\Entity\CartOrdenDetalle $detalle
     */
    public function removeDetalle(\cart\Entity\CartOrdenDetalle $detalle)
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
     * Set carrito
     *
     * @param cart\Entity\CartCarrito $carrito
     * @return CartOrden
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
     * Set cliente
     *
     * @param web\Entity\CmsCliente $cliente
     * @return CartOrden
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

    /**
     * Set moneda
     *
     * @param cart\Entity\CartMoneda $moneda
     * @return CartOrden
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
     * Set ordenEstado
     *
     * @param cart\Entity\CartOrdenEstado $ordenEstado
     * @return CartOrden
     */
    public function setOrdenEstado(\cart\Entity\CartOrdenEstado $ordenEstado = null)
    {
        $this->ordenEstado = $ordenEstado;
    
        return $this;
    }

    /**
     * Get ordenEstado
     *
     * @return cart\Entity\CartOrdenEstado 
     */
    public function getOrdenEstado()
    {
        return $this->ordenEstado;
    }
    
    /**
     * @var web\Entity\CmsUbigeo
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsUbigeo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_ubigeo", referencedColumnName="__cod_postal")
     * })
     */
    private $ubigeo;


    /**
     * Set ubigeo
     *
     * @param web\Entity\CmsUbigeo $ubigeo
     * @return CartOrden
     */
    public function setUbigeo(\web\Entity\CmsUbigeo $ubigeo = null)
    {
        $this->ubigeo = $ubigeo;
    
        return $this;
    }

    /**
     * Get ubigeo
     *
     * @return web\Entity\CmsUbigeo 
     */
    public function getUbigeo()
    {
        return $this->ubigeo;
    }
}