<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartProductoCategoria
 *
 * @ORM\Table(name="cart_producto__categoria")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartProductoCategoriaRepository")
 */
class CartProductoCategoria
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
     * @var boolean $stateCate
     *
     * @ORM\Column(name="__state_cate", type="boolean", nullable=false)
     */
    private $stateCate;

    /**
     * @var \DateTime $fechamodfCate
     *
     * @ORM\Column(name="__fechamodf_cate", type="datetime", nullable=true)
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
     * @ORM\OneToMany(targetEntity="cart\Entity\CartProductoCategoriaLanguage", mappedBy="contcate", cascade={"persist"})
     */
    private $languages;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="cart\Entity\CartProductoCategoriaTipo", mappedBy="contcate", cascade={"persist"})
     */
    private $tipos;

    /**
     * @var cart\Entity\CartProductoCategoria
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartProductoCategoria")
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
        $this->tipos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return CartProductoCategoria
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
     * @return CartProductoCategoria
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
     * @return CartProductoCategoria
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
     * Set stateCate
     *
     * @param boolean $stateCate
     * @return CartProductoCategoria
     */
    public function setStateCate($stateCate)
    {
        $this->stateCate = $stateCate;
    
        return $this;
    }

    /**
     * Get stateCate
     *
     * @return boolean 
     */
    public function getStateCate()
    {
        return $this->stateCate;
    }

    /**
     * Set fechamodfCate
     *
     * @param \DateTime $fechamodfCate
     * @return CartProductoCategoria
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
     * @return CartProductoCategoria
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
     * @param cart\Entity\CartProductoCategoriaLanguage $languages
     * @return CartProductoCategoria
     */
    public function addLanguage(\cart\Entity\CartProductoCategoriaLanguage $languages)
    {
        $this->languages[] = $languages;
    
        return $this;
    }

    /**
     * Remove languages
     *
     * @param cart\Entity\CartProductoCategoriaLanguage $languages
     */
    public function removeLanguage(\cart\Entity\CartProductoCategoriaLanguage $languages)
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
     * Add tipos
     *
     * @param cart\Entity\CartProductoCategoriaTipo $tipos
     * @return CartProductoCategoria
     */
    public function addTipo(\cart\Entity\CartProductoCategoriaTipo $tipos)
    {
        $this->tipos[] = $tipos;
    
        return $this;
    }

    /**
     * Remove tipos
     *
     * @param cart\Entity\CartProductoCategoriaTipo $tipos
     */
    public function removeTipo(\cart\Entity\CartProductoCategoriaTipo $tipos)
    {
        $this->tipos->removeElement($tipos);
    }

    /**
     * Get tipos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTipos()
    {
        return $this->tipos;
    }

    /**
     * Set contcatePadre
     *
     * @param cart\Entity\CartProductoCategoria $contcatePadre
     * @return CartProductoCategoria
     */
    public function setContcatePadre(\cart\Entity\CartProductoCategoria $contcatePadre = null)
    {
        $this->contcatePadre = $contcatePadre;
    
        return $this;
    }

    /**
     * Get contcatePadre
     *
     * @return cart\Entity\CartProductoCategoria 
     */
    public function getContcatePadre()
    {
        return $this->contcatePadre;
    }
}