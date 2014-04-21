<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsContentCategoria
 *
 * @ORM\Table(name="cms_content__categoria", indexes={@ORM\Index(name="contentCate_nivel_idx", columns={"__nivel_cate"}), @ORM\Index(name="contentCate_estado_idx", columns={"__estado_cate"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsContentCategoriaRepository")
 */
class CmsContentCategoria
{
    /**
     * @var integer $idcontcate
     *
     * @ORM\Column(name="__idContCate", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcontcate;

    /**
     * @var integer $nivelCate
     *
     * @ORM\Column(name="__nivel_cate", type="integer", nullable=true)
     */
    private $nivelCate;

    /**
     * @var string $imagenCate
     *
     * @ORM\Column(name="__imagen_cate", type="string", length=260, nullable=true)
     */
    private $imagenCate;

    /**
     * @var integer $ordenCate
     *
     * @ORM\Column(name="__orden_cate", type="integer", nullable=false)
     */
    private $ordenCate;

    /**
     * @var boolean $estadoCate
     *
     * @ORM\Column(name="__estado_cate", type="boolean", nullable=false)
     */
    private $estadoCate;

    /**
     * @var \DateTime $fechamodfCate
     *
     * @ORM\Column(name="_fechamodf__cate", type="datetime", nullable=true)
     */
    private $fechamodfCate;

    /**
     * @var \DateTime $fecharegCate
     *
     * @ORM\Column(name="__fechareg_cate", type="datetime", nullable=true)
     */
    private $fecharegCate;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="web\Entity\CmsContentCategoriaLanguage", mappedBy="contcate", cascade={"persist"})
     */
    private $languages;

    /**
     * @var web\Entity\CmsContentCategoria
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsContentCategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idContCate_Padre", referencedColumnName="__idContCate", onDelete="CASCADE")
     * })
     */
    private $contcatePadre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idcontcate
     *
     * @return integer 
     */
    public function getIdcontcate()
    {
        return $this->idcontcate;
    }

    /**
     * Set nivelCate
     *
     * @param integer $nivelCate
     * @return CmsContentCategoria
     */
    public function setNivelCate($nivelCate)
    {
        $this->nivelCate = $nivelCate;
    
        return $this;
    }

    /**
     * Get nivelCate
     *
     * @return integer 
     */
    public function getNivelCate()
    {
        return $this->nivelCate;
    }

    /**
     * Set imagenCate
     *
     * @param string $imagenCate
     * @return CmsContentCategoria
     */
    public function setImagenCate($imagenCate)
    {
        $this->imagenCate = $imagenCate;
    
        return $this;
    }

    /**
     * Get imagenCate
     *
     * @return string 
     */
    public function getImagenCate()
    {
        return $this->imagenCate;
    }

    /**
     * Set ordenCate
     *
     * @param integer $ordenCate
     * @return CmsContentCategoria
     */
    public function setOrdenCate($ordenCate)
    {
        $this->ordenCate = $ordenCate;
    
        return $this;
    }

    /**
     * Get ordenCate
     *
     * @return integer 
     */
    public function getOrdenCate()
    {
        return $this->ordenCate;
    }

    /**
     * Set estadoCate
     *
     * @param boolean $estadoCate
     * @return CmsContentCategoria
     */
    public function setEstadoCate($estadoCate)
    {
        $this->estadoCate = $estadoCate;
    
        return $this;
    }

    /**
     * Get estadoCate
     *
     * @return boolean 
     */
    public function getEstadoCate()
    {
        return $this->estadoCate;
    }

    /**
     * Set fechamodfCate
     *
     * @param \DateTime $fechamodfCate
     * @return CmsContentCategoria
     */
    public function setFechamodfCate($fechamodfCate)
    {
        $this->fechamodfCate = $fechamodfCate;
    
        return $this;
    }

    /**
     * Get fechamodfCate
     *
     * @return \DateTime 
     */
    public function getFechamodfCate()
    {
        return $this->fechamodfCate;
    }

    /**
     * Set fecharegCate
     *
     * @param \DateTime $fecharegCate
     * @return CmsContentCategoria
     */
    public function setFecharegCate($fecharegCate)
    {
        $this->fecharegCate = $fecharegCate;
    
        return $this;
    }

    /**
     * Get fecharegCate
     *
     * @return \DateTime 
     */
    public function getFecharegCate()
    {
        return $this->fecharegCate;
    }

    /**
     * Add languages
     *
     * @param web\Entity\CmsContentCategoriaLanguage $languages
     * @return CmsContentCategoria
     */
    public function addLanguage(\web\Entity\CmsContentCategoriaLanguage $languages)
    {
        $this->languages[] = $languages;
    
        return $this;
    }

    /**
     * Remove languages
     *
     * @param web\Entity\CmsContentCategoriaLanguage $languages
     */
    public function removeLanguage(\web\Entity\CmsContentCategoriaLanguage $languages)
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

    /**
     * Set contcatePadre
     *
     * @param web\Entity\CmsContentCategoria $contcatePadre
     * @return CmsContentCategoria
     */
    public function setContcatePadre(\web\Entity\CmsContentCategoria $contcatePadre = null)
    {
        $this->contcatePadre = $contcatePadre;
    
        return $this;
    }

    /**
     * Get contcatePadre
     *
     * @return web\Entity\CmsContentCategoria 
     */
    public function getContcatePadre()
    {
        return $this->contcatePadre;
    }
}