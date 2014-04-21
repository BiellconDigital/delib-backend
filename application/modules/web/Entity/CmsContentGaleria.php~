<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsContentGaleria
 *
 * @ORM\Table(name="cms_content__galeria", indexes={@ORM\Index(name="contentGale_estado_idx", columns={"__orden_gale"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsContentGaleriaRepository")
 */
class CmsContentGaleria
{
    /**
     * @var integer $idcontgale
     *
     * @ORM\Column(name="__idContGale", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcontgale;

    /**
     * @var integer $ordenGale
     *
     * @ORM\Column(name="__orden_gale", type="integer", nullable=false)
     */
    private $ordenGale;

    /**
     * @var string $imagenGale
     *
     * @ORM\Column(name="__imagen_gale", type="string", length=100, nullable=true)
     */
    private $imagenGale;

    /**
     * @var \DateTime $fecharegGale
     *
     * @ORM\Column(name="__fechareg_gale", type="datetime", nullable=true)
     */
    private $fecharegGale;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="web\Entity\CmsContentGaleriaLanguage", mappedBy="contgale", cascade={"persist","remove"})
     */
    private $languages;

    /**
     * @var web\Entity\CmsContent
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsContent", inversedBy="galeria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idContent", referencedColumnName="__idContent", onDelete="CASCADE")
     * })
     */
    private $content;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idcontgale
     *
     * @return integer 
     */
    public function getIdcontgale()
    {
        return $this->idcontgale;
    }

    /**
     * Set ordenGale
     *
     * @param integer $ordenGale
     * @return CmsContentGaleria
     */
    public function setOrdenGale($ordenGale)
    {
        $this->ordenGale = $ordenGale;
    
        return $this;
    }

    /**
     * Get ordenGale
     *
     * @return integer 
     */
    public function getOrdenGale()
    {
        return $this->ordenGale;
    }

    /**
     * Set imagenGale
     *
     * @param string $imagenGale
     * @return CmsContentGaleria
     */
    public function setImagenGale($imagenGale)
    {
        $this->imagenGale = $imagenGale;
    
        return $this;
    }

    /**
     * Get imagenGale
     *
     * @return string 
     */
    public function getImagenGale()
    {
        return $this->imagenGale;
    }

    /**
     * Set fecharegGale
     *
     * @param \DateTime $fecharegGale
     * @return CmsContentGaleria
     */
    public function setFecharegGale($fecharegGale)
    {
        $this->fecharegGale = $fecharegGale;
    
        return $this;
    }

    /**
     * Get fecharegGale
     *
     * @return \DateTime 
     */
    public function getFecharegGale()
    {
        return $this->fecharegGale;
    }

    /**
     * Add languages
     *
     * @param web\Entity\CmsContentGaleriaLanguage $languages
     * @return CmsContentGaleria
     */
    public function addLanguage(\web\Entity\CmsContentGaleriaLanguage $languages)
    {
        $this->languages[] = $languages;
    
        return $this;
    }

    /**
     * Remove languages
     *
     * @param web\Entity\CmsContentGaleriaLanguage $languages
     */
    public function removeLanguage(\web\Entity\CmsContentGaleriaLanguage $languages)
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
     * Set content
     *
     * @param web\Entity\CmsContent $content
     * @return CmsContentGaleria
     */
    public function setContent(\web\Entity\CmsContent $content = null)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return web\Entity\CmsContent 
     */
    public function getContent()
    {
        return $this->content;
    }
}