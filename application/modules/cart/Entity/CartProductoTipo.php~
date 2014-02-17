<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartProductoTipo
 *
 * @ORM\Table(name="cart_producto__tipo")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartProductoTipoRepository")
 */
class CartProductoTipo
{
    /**
     * @var integer $idTipo
     *
     * @ORM\Column(name="__idTipo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipo;

    /**
     * @var string $imagen
     *
     * @ORM\Column(name="__imagen", type="string", length=260, nullable=true)
     */
    private $imagen;

    /**
     * @var integer $orden
     *
     * @ORM\Column(name="__orden", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var boolean $estado
     *
     * @ORM\Column(name="__estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime $fechamodf
     *
     * @ORM\Column(name="__fechamodf", type="datetime", nullable=true)
     */
    private $fechamodf;

    /**
     * @var \DateTime $fechareg
     *
     * @ORM\Column(name="__fechareg", type="datetime", nullable=true)
     */
    private $fechareg;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="cart\Entity\CartProductoTipoLanguage", mappedBy="tipo", cascade={"persist"})
     */
    private $languages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idTipo
     *
     * @return integer 
     */
    public function getIdTipo()
    {
        return $this->idTipo;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return CartProductoTipo
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    
        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     * @return CartProductoTipo
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return CartProductoTipo
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

    /**
     * Set fechamodf
     *
     * @param \DateTime $fechamodf
     * @return CartProductoTipo
     */
    public function setFechamodf($fechamodf)
    {
        $this->fechamodf = $fechamodf;
    
        return $this;
    }

    /**
     * Get fechamodf
     *
     * @return \DateTime 
     */
    public function getFechamodf()
    {
        return $this->fechamodf;
    }

    /**
     * Set fechareg
     *
     * @param \DateTime $fechareg
     * @return CartProductoTipo
     */
    public function setFechareg($fechareg)
    {
        $this->fechareg = $fechareg;
    
        return $this;
    }

    /**
     * Get fechareg
     *
     * @return \DateTime 
     */
    public function getFechareg()
    {
        return $this->fechareg;
    }

    /**
     * Add languages
     *
     * @param cart\Entity\CartProductoTipoLanguage $languages
     * @return CartProductoTipo
     */
    public function addLanguage(\cart\Entity\CartProductoTipoLanguage $languages)
    {
        $this->languages[] = $languages;
    
        return $this;
    }

    /**
     * Remove languages
     *
     * @param cart\Entity\CartProductoTipoLanguage $languages
     */
    public function removeLanguage(\cart\Entity\CartProductoTipoLanguage $languages)
    {
        $this->languages->removeElement($languages);
    }

    /**
     * Get languages
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLanguages()
    {
        return $this->languages;
    }
}