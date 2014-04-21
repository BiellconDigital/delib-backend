<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartOrdenTipo
 *
 * @ORM\Table(name="cart_orden__tipo")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartOrdenTipoRepository")
 */
class CartOrdenTipo
{
    /**
     * @var integer $idOrdenTipo
     *
     * @ORM\Column(name="__id_orden_tipo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrdenTipo;

    /**
     * @var boolean $activo
     *
     * @ORM\Column(name="__activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="cart\Entity\CartOrdenTipoLanguage", mappedBy="ordenTipo", cascade={"persist","remove"})
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
     * Get idOrdenTipo
     *
     * @return integer 
     */
    public function getIdOrdenTipo()
    {
        return $this->idOrdenTipo;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return CartOrdenTipo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    
        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Add languages
     *
     * @param cart\Entity\CartOrdenTipoLanguage $languages
     * @return CartOrdenTipo
     */
    public function addLanguage(\cart\Entity\CartOrdenTipoLanguage $languages)
    {
        $this->languages[] = $languages;
    
        return $this;
    }

    /**
     * Remove languages
     *
     * @param cart\Entity\CartOrdenTipoLanguage $languages
     */
    public function removeLanguage(\cart\Entity\CartOrdenTipoLanguage $languages)
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