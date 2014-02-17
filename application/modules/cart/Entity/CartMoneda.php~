<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartMoneda
 *
 * @ORM\Table(name="cart_moneda")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartMonedaRepository")
 */
class CartMoneda
{
    /**
     * @var integer $idMoneda
     *
     * @ORM\Column(name="__id_moneda", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMoneda;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="__nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string $isoCode
     *
     * @ORM\Column(name="__iso_code", type="string", length=4, nullable=false)
     */
    private $isoCode;

    /**
     * @var string $signo
     *
     * @ORM\Column(name="__signo", type="string", length=8, nullable=false)
     */
    private $signo;

    /**
     * @var boolean $activo
     *
     * @ORM\Column(name="__activo", type="boolean", nullable=false)
     */
    private $activo;

    /**
     * @var boolean $principal
     *
     * @ORM\Column(name="__principal", type="boolean", nullable=false)
     */
    private $principal;

    /**
     * @var float $conversion
     *
     * @ORM\Column(name="__conversion", type="float", nullable=false)
     */
    private $conversion;

    /**
     * @var \DateTime $fechaActualizacion
     *
     * @ORM\Column(name="__fecha_actualizacion", type="datetime", nullable=true)
     */
    private $fechaActualizacion;

    /**
     * @var \DateTime $fechaRegistro
     *
     * @ORM\Column(name="__fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;


    /**
     * Get idMoneda
     *
     * @return integer 
     */
    public function getIdMoneda()
    {
        return $this->idMoneda;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CartMoneda
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set isoCode
     *
     * @param string $isoCode
     * @return CartMoneda
     */
    public function setIsoCode($isoCode)
    {
        $this->isoCode = $isoCode;
    
        return $this;
    }

    /**
     * Get isoCode
     *
     * @return string 
     */
    public function getIsoCode()
    {
        return $this->isoCode;
    }

    /**
     * Set signo
     *
     * @param string $signo
     * @return CartMoneda
     */
    public function setSigno($signo)
    {
        $this->signo = $signo;
    
        return $this;
    }

    /**
     * Get signo
     *
     * @return string 
     */
    public function getSigno()
    {
        return $this->signo;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return CartMoneda
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    
        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set principal
     *
     * @param boolean $principal
     * @return CartMoneda
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;
    
        return $this;
    }

    /**
     * Get principal
     *
     * @return boolean 
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Set conversion
     *
     * @param float $conversion
     * @return CartMoneda
     */
    public function setConversion($conversion)
    {
        $this->conversion = $conversion;
    
        return $this;
    }

    /**
     * Get conversion
     *
     * @return float 
     */
    public function getConversion()
    {
        return $this->conversion;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return CartMoneda
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return CartMoneda
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
}