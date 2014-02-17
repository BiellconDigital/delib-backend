<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartOrdenEstado
 *
 * @ORM\Table(name="cart_orden__estado")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartOrdenEstadoRepository")
 */
class CartOrdenEstado
{
    /**
     * @var integer $idOrdenEstado
     *
     * @ORM\Column(name="__id_orden_estado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrdenEstado;

    /**
     * @var boolean $activo
     *
     * @ORM\Column(name="__activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var string $color
     *
     * @ORM\Column(name="__color", type="string", length=15, nullable=true)
     */
    private $color;

    /**
     * @var boolean $envioEmail
     *
     * @ORM\Column(name="__envio_email", type="boolean", nullable=true)
     */
    private $envioEmail;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="cart\Entity\CartOrdenEstadoLanguage", mappedBy="ordenEstado", cascade={"persist","remove"})
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
     * Get idOrdenEstado
     *
     * @return integer 
     */
    public function getIdOrdenEstado()
    {
        return $this->idOrdenEstado;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return CartOrdenEstado
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
     * Set color
     *
     * @param string $color
     * @return CartOrdenEstado
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set envioEmail
     *
     * @param boolean $envioEmail
     * @return CartOrdenEstado
     */
    public function setEnvioEmail($envioEmail)
    {
        $this->envioEmail = $envioEmail;
    
        return $this;
    }

    /**
     * Get envioEmail
     *
     * @return boolean 
     */
    public function getEnvioEmail()
    {
        return $this->envioEmail;
    }

    /**
     * Add languages
     *
     * @param cart\Entity\CartOrdenEstadoLanguage $languages
     * @return CartOrdenEstado
     */
    public function addLanguage(\cart\Entity\CartOrdenEstadoLanguage $languages)
    {
        $this->languages[] = $languages;
    
        return $this;
    }

    /**
     * Remove languages
     *
     * @param cart\Entity\CartOrdenEstadoLanguage $languages
     */
    public function removeLanguage(\cart\Entity\CartOrdenEstadoLanguage $languages)
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