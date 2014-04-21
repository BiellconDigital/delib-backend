<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsContentLanguage
 *
 * @ORM\Table(name="cms_content_language", indexes={@ORM\Index(name="contentLang_descripcion_idx", columns={"__descripcion"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsContentLanguageRepository")
 */
class CmsContentLanguage
{
    /**
     * @var integer $idContentLanguage
     *
     * @ORM\Column(name="__id_Content_Language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContentLanguage;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="__descripcion", type="string", length=160, nullable=true)
     */
    private $descripcion;

    /**
     * @var string $intro
     *
     * @ORM\Column(name="__intro", type="text", nullable=true)
     */
    private $intro;

    /**
     * @var string $detalle
     *
     * @ORM\Column(name="__detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * @var string $imagen
     *
     * @ORM\Column(name="__imagen", type="string", length=100, nullable=true)
     */
    private $imagen;

    /**
     * @var string $adjunto
     *
     * @ORM\Column(name="__adjunto", type="string", length=100, nullable=true)
     */
    private $adjunto;

    /**
     * @var string $url
     *
     * @ORM\Column(name="__url", type="string", length=180, nullable=true)
     */
    private $url;

    /**
     * @var string $adicional1
     *
     * @ORM\Column(name="__adicional1", type="string", length=100, nullable=true)
     */
    private $adicional1;

    /**
     * @var string $adicional2
     *
     * @ORM\Column(name="__adicional2", type="string", length=100, nullable=true)
     */
    private $adicional2;

    /**
     * @var web\Entity\CmsContent
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsContent", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idContent", referencedColumnName="__idContent", onDelete="CASCADE")
     * })
     */
    private $content;

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
     * Get idContentLanguage
     *
     * @return integer 
     */
    public function getIdContentLanguage()
    {
        return $this->idContentLanguage;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CmsContentLanguage
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
     * Set intro
     *
     * @param string $intro
     * @return CmsContentLanguage
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
    
        return $this;
    }

    /**
     * Get intro
     *
     * @return string 
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     * @return CmsContentLanguage
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
     * Set imagen
     *
     * @param string $imagen
     * @return CmsContentLanguage
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
     * Set adjunto
     *
     * @param string $adjunto
     * @return CmsContentLanguage
     */
    public function setAdjunto($adjunto)
    {
        $this->adjunto = $adjunto;
    
        return $this;
    }

    /**
     * Get adjunto
     *
     * @return string 
     */
    public function getAdjunto()
    {
        return $this->adjunto;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return CmsContentLanguage
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set adicional1
     *
     * @param string $adicional1
     * @return CmsContentLanguage
     */
    public function setAdicional1($adicional1)
    {
        $this->adicional1 = $adicional1;
    
        return $this;
    }

    /**
     * Get adicional1
     *
     * @return string 
     */
    public function getAdicional1()
    {
        return $this->adicional1;
    }

    /**
     * Set adicional2
     *
     * @param string $adicional2
     * @return CmsContentLanguage
     */
    public function setAdicional2($adicional2)
    {
        $this->adicional2 = $adicional2;
    
        return $this;
    }

    /**
     * Get adicional2
     *
     * @return string 
     */
    public function getAdicional2()
    {
        return $this->adicional2;
    }

    /**
     * Set content
     *
     * @param web\Entity\CmsContent $content
     * @return CmsContentLanguage
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

    /**
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CmsContentLanguage
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