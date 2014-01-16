<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsTipoDireccionLanguage
 *
 * @ORM\Table(name="cms_tipo__direccion_language")
 * @ORM\Entity(repositoryClass="web\Repositories\CmsTipoDireccionLanguageRepository")
 */
class CmsTipoDireccionLanguage
{
    /**
     * @var integer $idTipodireccionLanguage
     *
     * @ORM\Column(name="__id_TipoDireccion_Language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipodireccionLanguage;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="__nombre", type="string", length=60, nullable=false)
     */
    private $nombre;

    /**
     * @var web\Entity\CmsTipoDireccion
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsTipoDireccion", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_tipo_direccion", referencedColumnName="__id_tipo_direccion", onDelete="CASCADE")
     * })
     */
    private $idTipoDireccion;

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
     * Get idTipodireccionLanguage
     *
     * @return integer 
     */
    public function getIdTipodireccionLanguage()
    {
        return $this->idTipodireccionLanguage;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CmsTipoDireccionLanguage
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set idTipoDireccion
     *
     * @param web\Entity\CmsTipoDireccion $idTipoDireccion
     * @return CmsTipoDireccionLanguage
     */
    public function setIdTipoDireccion(\web\Entity\CmsTipoDireccion $idTipoDireccion = null)
    {
        $this->idTipoDireccion = $idTipoDireccion;
    
        return $this;
    }

    /**
     * Get idTipoDireccion
     *
     * @return web\Entity\CmsTipoDireccion 
     */
    public function getIdTipoDireccion()
    {
        return $this->idTipoDireccion;
    }

    /**
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CmsTipoDireccionLanguage
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