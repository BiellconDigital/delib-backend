<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartMovimientoStockTipo
 *
 * @ORM\Table(name="cart_movimiento__stock_tipo")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartMovimientoStockTipoRepository")
 */
class CartMovimientoStockTipo
{
    /**
     * @var integer $idMovimientoStockTipo
     *
     * @ORM\Column(name="__id_movimiento_stock_tipo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMovimientoStockTipo;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="__nombre", type="string", length=65, nullable=true)
     */
    private $nombre;

    /**
     * @var integer $signo
     *
     * @ORM\Column(name="signo", type="integer", nullable=true)
     */
    private $signo;

    /**
     * @var \DateTime $fechaRegistro
     *
     * @ORM\Column(name="__fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime $fechaActualizacion
     *
     * @ORM\Column(name="__fecha_actualizacion", type="datetime", nullable=true)
     */
    private $fechaActualizacion;


    /**
     * Get idMovimientoStockTipo
     *
     * @return integer 
     */
    public function getIdMovimientoStockTipo()
    {
        return $this->idMovimientoStockTipo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CartMovimientoStockTipo
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
     * Set signo
     *
     * @param integer $signo
     * @return CartMovimientoStockTipo
     */
    public function setSigno($signo)
    {
        $this->signo = $signo;
    
        return $this;
    }

    /**
     * Get signo
     *
     * @return integer 
     */
    public function getSigno()
    {
        return $this->signo;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return CartMovimientoStockTipo
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
     * @return CartMovimientoStockTipo
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
}