<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsTipoDocumentoLanguage
 *
 * @ORM\Table(name="cms_tipo__documento_language")
 * @ORM\Entity(repositoryClass="web\Repositories\CmsTipoDocumentoLanguageRepository")
 */
class CmsTipoDocumentoLanguage
{
    /**
     * @var integer $idTipodocuLanguage
     *
     * @ORM\Column(name="__id_tipoDocu_language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipodocuLanguage;

    /**
     * @var string $nombreTdoc
     *
     * @ORM\Column(name="__nombre_tdoc", type="string", length=15, nullable=false)
     */
    private $nombreTdoc;

    /**
     * @var string $descripcionTdoc
     *
     * @ORM\Column(name="__descripcion_tdoc", type="string", length=60, nullable=false)
     */
    private $descripcionTdoc;

    /**
     * @var string $detalle
     *
     * @ORM\Column(name="__detalle_tdoc", type="text", nullable=false)
     */
    private $detalle;

    /**
     * @var web\Entity\CmsTipoDocumento
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsTipoDocumento", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idtipo_documento", referencedColumnName="__idtipo_documento", onDelete="CASCADE")
     * })
     */
    private $idtipoDocumento;

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
     * Get idTipodocuLanguage
     *
     * @return integer 
     */
    public function getIdTipodocuLanguage()
    {
        return $this->idTipodocuLanguage;
    }

    /**
     * Set nombreTdoc
     *
     * @param string $nombreTdoc
     * @return CmsTipoDocumentoLanguage
     */
    public function setNombreTdoc($nombreTdoc)
    {
        $this->nombreTdoc = $nombreTdoc;
    
        return $this;
    }

    /**
     * Get nombreTdoc
     *
     * @return string 
     */
    public function getNombreTdoc()
    {
        return $this->nombreTdoc;
    }

    /**
     * Set descripcionTdoc
     *
     * @param string $descripcionTdoc
     * @return CmsTipoDocumentoLanguage
     */
    public function setDescripcionTdoc($descripcionTdoc)
    {
        $this->descripcionTdoc = $descripcionTdoc;
    
        return $this;
    }

    /**
     * Get descripcionTdoc
     *
     * @return string 
     */
    public function getDescripcionTdoc()
    {
        return $this->descripcionTdoc;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     * @return CmsTipoDocumentoLanguage
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
     * Set idtipoDocumento
     *
     * @param web\Entity\CmsTipoDocumento $idtipoDocumento
     * @return CmsTipoDocumentoLanguage
     */
    public function setIdtipoDocumento(\web\Entity\CmsTipoDocumento $idtipoDocumento = null)
    {
        $this->idtipoDocumento = $idtipoDocumento;
    
        return $this;
    }

    /**
     * Get idtipoDocumento
     *
     * @return web\Entity\CmsTipoDocumento 
     */
    public function getIdtipoDocumento()
    {
        return $this->idtipoDocumento;
    }

    /**
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CmsTipoDocumentoLanguage
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