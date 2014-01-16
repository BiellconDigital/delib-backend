<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsTipoDireccion
 *
 * @ORM\Table(name="cms_tipo__direccion")
 * @ORM\Entity(repositoryClass="web\Repositories\CmsTipoDireccionRepository")
 */
class CmsTipoDireccion
{
    /**
     * @var integer $idTipoDireccion
     *
     * @ORM\Column(name="__id_tipo_direccion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipoDireccion;

    /**
     * @var boolean $estado
     *
     * @ORM\Column(name="__estado", type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="web\Entity\CmsTipoDireccionLanguage", mappedBy="idTipoDireccion", cascade={"persist"})
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
     * Get idTipoDireccion
     *
     * @return integer 
     */
    public function getIdTipoDireccion()
    {
        return $this->idTipoDireccion;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return CmsTipoDireccion
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
     * Add languages
     *
     * @param web\Entity\CmsTipoDireccionLanguage $languages
     * @return CmsTipoDireccion
     */
    public function addLanguage(\web\Entity\CmsTipoDireccionLanguage $languages)
    {
        $this->languages[] = $languages;
    
        return $this;
    }

    /**
     * Remove languages
     *
     * @param web\Entity\CmsTipoDireccionLanguage $languages
     */
    public function removeLanguage(\web\Entity\CmsTipoDireccionLanguage $languages)
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