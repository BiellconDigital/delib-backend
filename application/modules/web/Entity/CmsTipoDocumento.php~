<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsTipoDocumento
 *
 * @ORM\Table(name="cms_tipo__documento")
 * @ORM\Entity(repositoryClass="web\Repositories\CmsTipoDocumentoRepository")
 */
class CmsTipoDocumento
{
    /**
     * @var integer $idtipoDocumento
     *
     * @ORM\Column(name="__idtipo_documento", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipoDocumento;

    /**
     * @var integer $longitudTdoc
     *
     * @ORM\Column(name="__longitud_tdoc", type="integer", nullable=true)
     */
    private $longitudTdoc;

    /**
     * @var boolean $estadoTipodoc
     *
     * @ORM\Column(name="__estado_tipodoc", type="boolean", nullable=false)
     */
    private $estadoTipodoc;

    /**
     * @var \DateTime $tiempoModif
     *
     * @ORM\Column(name="__tiempo_modif", type="datetime", nullable=true)
     */
    private $tiempoModif;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="web\Entity\CmsTipoDocumentoLanguage", mappedBy="idtipoDocumento", cascade={"persist"})
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
     * Get idtipoDocumento
     *
     * @return integer 
     */
    public function getIdtipoDocumento()
    {
        return $this->idtipoDocumento;
    }

    /**
     * Set longitudTdoc
     *
     * @param integer $longitudTdoc
     * @return CmsTipoDocumento
     */
    public function setLongitudTdoc($longitudTdoc)
    {
        $this->longitudTdoc = $longitudTdoc;
    
        return $this;
    }

    /**
     * Get longitudTdoc
     *
     * @return integer 
     */
    public function getLongitudTdoc()
    {
        return $this->longitudTdoc;
    }

    /**
     * Set estadoTipodoc
     *
     * @param boolean $estadoTipodoc
     * @return CmsTipoDocumento
     */
    public function setEstadoTipodoc($estadoTipodoc)
    {
        $this->estadoTipodoc = $estadoTipodoc;
    
        return $this;
    }

    /**
     * Get estadoTipodoc
     *
     * @return boolean 
     */
    public function getEstadoTipodoc()
    {
        return $this->estadoTipodoc;
    }

    /**
     * Set tiempoModif
     *
     * @param \DateTime $tiempoModif
     * @return CmsTipoDocumento
     */
    public function setTiempoModif($tiempoModif)
    {
        $this->tiempoModif = $tiempoModif;
    
        return $this;
    }

    /**
     * Get tiempoModif
     *
     * @return \DateTime 
     */
    public function getTiempoModif()
    {
        return $this->tiempoModif;
    }

    /**
     * Add languages
     *
     * @param web\Entity\CmsTipoDocumentoLanguage $languages
     * @return CmsTipoDocumento
     */
    public function addLanguage(\web\Entity\CmsTipoDocumentoLanguage $languages)
    {
        $this->languages[] = $languages;
    
        return $this;
    }

    /**
     * Remove languages
     *
     * @param web\Entity\CmsTipoDocumentoLanguage $languages
     */
    public function removeLanguage(\web\Entity\CmsTipoDocumentoLanguage $languages)
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