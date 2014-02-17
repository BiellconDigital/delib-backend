<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsKeys
 *
 * @ORM\Table(name="cms_keys", indexes={@ORM\Index(name="keys_consumido_idx", columns={"__consumido"}), @ORM\Index(name="keys_fechaInicio_idx", columns={"__fecha_inicio"}), @ORM\Index(name="keys_fechaFin_idx", columns={"__fecha_fin"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsKeysRepository")
 */
class CmsKeys
{
    /**
     * @var string $idKeys
     *
     * @ORM\Column(name="__id_keys", type="string", length=32, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idKeys;

    /**
     * @var boolean $consumido
     *
     * @ORM\Column(name="__consumido", type="boolean", nullable=false)
     */
    private $consumido;

    /**
     * @var \DateTime $fechaInicio
     *
     * @ORM\Column(name="__fecha_inicio", type="datetime", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime $fechaFin
     *
     * @ORM\Column(name="__fecha_fin", type="datetime", nullable=true)
     */
    private $fechaFin;

    /**
     * @var integer $usuarioCreacion
     *
     * @ORM\Column(name="__usuario_creacion", type="bigint", nullable=true)
     */
    private $usuarioCreacion;


    /**
     * Set idKeys
     *
     * @param string $idKeys
     * @return CmsKeys
     */
    public function setIdKeys($idKeys)
    {
        $this->idKeys = $idKeys;
    
        return $this;
    }

    /**
     * Get idKeys
     *
     * @return string 
     */
    public function getIdKeys()
    {
        return $this->idKeys;
    }

    /**
     * Set consumido
     *
     * @param boolean $consumido
     * @return CmsKeys
     */
    public function setConsumido($consumido)
    {
        $this->consumido = $consumido;
    
        return $this;
    }

    /**
     * Get consumido
     *
     * @return boolean 
     */
    public function getConsumido()
    {
        return $this->consumido;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return CmsKeys
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    
        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return CmsKeys
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    
        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set usuarioCreacion
     *
     * @param integer $usuarioCreacion
     * @return CmsKeys
     */
    public function setUsuarioCreacion($usuarioCreacion)
    {
        $this->usuarioCreacion = $usuarioCreacion;
    
        return $this;
    }

    /**
     * Get usuarioCreacion
     *
     * @return integer 
     */
    public function getUsuarioCreacion()
    {
        return $this->usuarioCreacion;
    }
}