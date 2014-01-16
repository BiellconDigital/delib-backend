<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsContent
 *
 * @ORM\Table(name="cms_content", indexes={@ORM\Index(name="content_estado_idx", columns={"__estado"}), @ORM\Index(name="content_fechainipub_idx", columns={"__fecha_FinPub"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsContentRepository")
 */
class CmsContent
{
    /**
     * @var integer $idcontent
     *
     * @ORM\Column(name="__idContent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcontent;

    /**
     * @var string $imagen
     *
     * @ORM\Column(name="__imagen", type="string", length=100, nullable=true)
     */
    private $imagen;

    /**
     * @var string $imagen2
     *
     * @ORM\Column(name="__imagen2", type="string", length=100, nullable=true)
     */
    private $imagen2;

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
     * @var string $adicional3
     *
     * @ORM\Column(name="__adicional3", type="string", length=100, nullable=true)
     */
    private $adicional3;

    /**
     * @var integer $orden
     *
     * @ORM\Column(name="__orden", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var boolean $estado
     *
     * @ORM\Column(name="__estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime $fechainipub
     *
     * @ORM\Column(name="__fecha_IniPub", type="date", nullable=true)
     */
    private $fechainipub;

    /**
     * @var \DateTime $fechafinpub
     *
     * @ORM\Column(name="__fecha_FinPub", type="date", nullable=true)
     */
    private $fechafinpub;

    /**
     * @var \DateTime $fechamodf
     *
     * @ORM\Column(name="__fecha_modf", type="datetime", nullable=true)
     */
    private $fechamodf;

    /**
     * @var \DateTime $fechareg
     *
     * @ORM\Column(name="__fecha_reg", type="datetime", nullable=true)
     */
    private $fechareg;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="web\Entity\CmsContentLanguage", mappedBy="content", cascade={"persist","remove"})
     */
    private $languages;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="web\Entity\CmsContentGaleria", mappedBy="content", cascade={"persist","remove"})
     */
    private $galeria;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="web\Entity\CmsContentComentario", mappedBy="content", cascade={"persist","remove"})
     */
    private $comentarios;

    /**
     * @var web\Entity\CmsContentCategoria
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsContentCategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idContCate", referencedColumnName="__idContCate", onDelete="CASCADE")
     * })
     */
    private $contcate;

    /**
     * @var web\Entity\CmsContentTipo
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsContentTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idTipo", referencedColumnName="__idTipo", onDelete="CASCADE")
     * })
     */
    private $tipo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->galeria = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comentarios = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idcontent
     *
     * @return integer 
     */
    public function getIdcontent()
    {
        return $this->idcontent;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return CmsContent
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
     * Set imagen2
     *
     * @param string $imagen2
     * @return CmsContent
     */
    public function setImagen2($imagen2)
    {
        $this->imagen2 = $imagen2;
    
        return $this;
    }

    /**
     * Get imagen2
     *
     * @return string 
     */
    public function getImagen2()
    {
        return $this->imagen2;
    }

    /**
     * Set adjunto
     *
     * @param string $adjunto
     * @return CmsContent
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
     * @return CmsContent
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
     * @return CmsContent
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
     * @return CmsContent
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
     * Set adicional3
     *
     * @param string $adicional3
     * @return CmsContent
     */
    public function setAdicional3($adicional3)
    {
        $this->adicional3 = $adicional3;
    
        return $this;
    }

    /**
     * Get adicional3
     *
     * @return string 
     */
    public function getAdicional3()
    {
        return $this->adicional3;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     * @return CmsContent
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
     * @return CmsContent
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
     * Set fechainipub
     *
     * @param \DateTime $fechainipub
     * @return CmsContent
     */
    public function setFechainipub($fechainipub)
    {
        $this->fechainipub = $fechainipub;
    
        return $this;
    }

    /**
     * Get fechainipub
     *
     * @return \DateTime 
     */
    public function getFechainipub()
    {
        return $this->fechainipub;
    }

    /**
     * Set fechafinpub
     *
     * @param \DateTime $fechafinpub
     * @return CmsContent
     */
    public function setFechafinpub($fechafinpub)
    {
        $this->fechafinpub = $fechafinpub;
    
        return $this;
    }

    /**
     * Get fechafinpub
     *
     * @return \DateTime 
     */
    public function getFechafinpub()
    {
        return $this->fechafinpub;
    }

    /**
     * Set fechamodf
     *
     * @param \DateTime $fechamodf
     * @return CmsContent
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
     * @return CmsContent
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
     * @param web\Entity\CmsContentLanguage $languages
     * @return CmsContent
     */
    public function addLanguage(\web\Entity\CmsContentLanguage $languages)
    {
        $this->languages[] = $languages;
    
        return $this;
    }

    /**
     * Remove languages
     *
     * @param web\Entity\CmsContentLanguage $languages
     */
    public function removeLanguage(\web\Entity\CmsContentLanguage $languages)
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
     * Add galeria
     *
     * @param web\Entity\CmsContentGaleria $galeria
     * @return CmsContent
     */
    public function addGaleria(\web\Entity\CmsContentGaleria $galeria)
    {
        $this->galeria[] = $galeria;
    
        return $this;
    }

    /**
     * Remove galeria
     *
     * @param web\Entity\CmsContentGaleria $galeria
     */
    public function removeGaleria(\web\Entity\CmsContentGaleria $galeria)
    {
        $this->galeria->removeElement($galeria);
    }

    /**
     * Get galeria
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGaleria()
    {
        return $this->galeria;
    }

    /**
     * Add comentarios
     *
     * @param web\Entity\CmsContentComentario $comentarios
     * @return CmsContent
     */
    public function addComentario(\web\Entity\CmsContentComentario $comentarios)
    {
        $this->comentarios[] = $comentarios;
    
        return $this;
    }

    /**
     * Remove comentarios
     *
     * @param web\Entity\CmsContentComentario $comentarios
     */
    public function removeComentario(\web\Entity\CmsContentComentario $comentarios)
    {
        $this->comentarios->removeElement($comentarios);
    }

    /**
     * Get comentarios
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set contcate
     *
     * @param web\Entity\CmsContentCategoria $contcate
     * @return CmsContent
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
     * Set tipo
     *
     * @param web\Entity\CmsContentTipo $tipo
     * @return CmsContent
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
}