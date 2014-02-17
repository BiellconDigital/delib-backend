<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsPais
 *
 * @ORM\Table(name="cms_pais", indexes={@ORM\Index(name="pais_estado_idx", columns={"__estado"}), @ORM\Index(name="pais_nombre_idx", columns={"__nombre"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsPaisRepository")
 */
class CmsPais
{
    /**
     * @var integer $idPais
     *
     * @ORM\Column(name="__id_Pais", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPais;

    /**
     * @var string $numPais
     *
     * @ORM\Column(name="__num_pais", type="string", length=6, nullable=true)
     */
    private $numPais;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="__nombre", type="string", length=140, nullable=false)
     */
    private $nombre;

    /**
     * @var boolean $estado
     *
     * @ORM\Column(name="__estado", type="boolean", nullable=true)
     */
    private $estado;


    /**
     * Get idPais
     *
     * @return integer 
     */
    public function getIdPais()
    {
        return $this->idPais;
    }

    /**
     * Set numPais
     *
     * @param string $numPais
     * @return CmsPais
     */
    public function setNumPais($numPais)
    {
        $this->numPais = $numPais;
    
        return $this;
    }

    /**
     * Get numPais
     *
     * @return string 
     */
    public function getNumPais()
    {
        return $this->numPais;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CmsPais
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
     * Set estado
     *
     * @param boolean $estado
     * @return CmsPais
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }
}