<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsContentGaleriaLanguage
 *
 * @ORM\Table(name="cms_content__galeria_language", indexes={@ORM\Index(name="contentGaleLang_titulo_idx", columns={"__titulo"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsContentGaleriaLanguageRepository")
 */
class CmsContentGaleriaLanguage
{
    /**
     * @var integer $idContentgaleLanguage
     *
     * @ORM\Column(name="__id_ContentGale_Language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContentgaleLanguage;

    /**
     * @var string $titulo
     *
     * @ORM\Column(name="__titulo", type="string", length=100, nullable=true)
     */
    private $titulo;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="__descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var web\Entity\CmsContentGaleria
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsContentGaleria", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idContGale", referencedColumnName="__idContGale", onDelete="CASCADE")
     * })
     */
    private $contgale;

    /**
     * @var web\Entity\CmsLanguage
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsLanguage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_language", referencedColumnName="__id_language", onDelete="CASCADE")
     * })
     */
    private $language;


    /**
     * Get idContentgaleLanguage
     *
     * @return integer 
     */
    public function getIdContentgaleLanguage()
    {
        return $this->idContentgaleLanguage;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return CmsContentGaleriaLanguage
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CmsContentGaleriaLanguage
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set contgale
     *
     * @param web\Entity\CmsContentGaleria $contgale
     * @return CmsContentGaleriaLanguage
     */
    public function setContgale(\web\Entity\CmsContentGaleria $contgale = null)
    {
        $this->contgale = $contgale;
    
        return $this;
    }

    /**
     * Get contgale
     *
     * @return web\Entity\CmsContentGaleria 
     */
    public function getContgale()
    {
        return $this->contgale;
    }

    /**
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CmsContentGaleriaLanguage
     */
    public function setLanguage(\web\Entity\CmsLanguage $language = null)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return web\Entity\CmsLanguage 
     */
    public function getLanguage()
    {
        return $this->language;
    }
}