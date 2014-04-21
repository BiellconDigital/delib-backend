<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsContentCategoriaLanguage
 *
 * @ORM\Table(name="cms_content__categoria_language", indexes={@ORM\Index(name="contentCateLang_descripcion_idx", columns={"__descripcion"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsContentCategoriaLanguageRepository")
 */
class CmsContentCategoriaLanguage
{
    /**
     * @var integer $idContentcateLanguage
     *
     * @ORM\Column(name="__id_ContentCate_Language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContentcateLanguage;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="__descripcion", type="string", length=140, nullable=false)
     */
    private $descripcion;

    /**
     * @var string $detalle
     *
     * @ORM\Column(name="__detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * @var web\Entity\CmsContentCategoria
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsContentCategoria", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idContCate", referencedColumnName="__idContCate", onDelete="CASCADE")
     * })
     */
    private $contcate;

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
     * Get idContentcateLanguage
     *
     * @return integer 
     */
    public function getIdContentcateLanguage()
    {
        return $this->idContentcateLanguage;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CmsContentCategoriaLanguage
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
     * Set detalle
     *
     * @param string $detalle
     * @return CmsContentCategoriaLanguage
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    
        return $this;
    }

    /**
     * Get detalle
     *
     * @return string 
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set contcate
     *
     * @param web\Entity\CmsContentCategoria $contcate
     * @return CmsContentCategoriaLanguage
     */
    public function setContcate(\web\Entity\CmsContentCategoria $contcate = null)
    {
        $this->contcate = $contcate;
    
        return $this;
    }

    /**
     * Get contcate
     *
     * @return web\Entity\CmsContentCategoria 
     */
    public function getContcate()
    {
        return $this->contcate;
    }

    /**
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CmsContentCategoriaLanguage
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