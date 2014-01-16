<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsContentTipo
 *
 * @ORM\Table(name="cms_content__tipo", indexes={@ORM\Index(name="contentTipo_estado_idx", columns={"__estado"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsContentTipoRepository")
 */
class CmsContentTipo
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
     * @ORM\Column(name="__imagen", type="string", length=100, nullable=true)
     */
    private $imagen;

    /**
     * @var integer $orden
     *
     * @ORM\Column(name="__orden_cate", type="integer", nullable=false)
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
     * @ORM\OneToMany(targetEntity="web\Entity\CmsContentTipoLanguage", mappedBy="tipo", cascade={"persist"})
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
     * @return CmsContentTipo
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
     * @return CmsContentTipo
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
     * @return CmsContentTipo
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
     * @return CmsContentTipo
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
     * @return CmsContentTipo
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
     * @param web\Entity\CmsContentTipoLanguage $languages
     * @return CmsContentTipo
     */
    public function addLanguage(\web\Entity\CmsContentTipoLanguage $languages)
    {
        $this->languages[] = $languages;
    
        return $this;
    }

    /**
     * Remove languages
     *
     * @param web\Entity\CmsContentTipoLanguage $languages
     */
    public function removeLanguage(\web\Entity\CmsContentTipoLanguage $languages)
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