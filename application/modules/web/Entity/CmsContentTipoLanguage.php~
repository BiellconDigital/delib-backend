<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsContentTipoLanguage
 *
 * @ORM\Table(name="cms_content__tipo_language", indexes={@ORM\Index(name="contentTipoLang_descripcion_idx", columns={"__descripcion"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsContentTipoLanguageRepository")
 */
class CmsContentTipoLanguage
{
    /**
     * @var integer $idContenttipoLanguage
     *
     * @ORM\Column(name="__id_ContentTipo_Language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContenttipoLanguage;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="__descripcion", type="string", length=100, nullable=false)
     */
    private $descripcion;

    /**
     * @var string $detalle
     *
     * @ORM\Column(name="__detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * @var web\Entity\CmsContentTipo
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsContentTipo", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idTipo", referencedColumnName="__idTipo", onDelete="CASCADE")
     * })
     */
    private $tipo;

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
     * Get idContenttipoLanguage
     *
     * @return integer 
     */
    public function getIdContenttipoLanguage()
    {
        return $this->idContenttipoLanguage;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CmsContentTipoLanguage
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
     * @return CmsContentTipoLanguage
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
     * Set tipo
     *
     * @param web\Entity\CmsContentTipo $tipo
     * @return CmsContentTipoLanguage
     */
    public function setTipo(\web\Entity\CmsContentTipo $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return web\Entity\CmsContentTipo 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CmsContentTipoLanguage
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