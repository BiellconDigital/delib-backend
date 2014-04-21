<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartMarcaLanguage
 *
 * @ORM\Table(name="cart_marca_language")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartMarcaLanguageRepository")
 */
class CartMarcaLanguage
{
    /**
     * @var integer $idMarcaLanguage
     *
     * @ORM\Column(name="__id_Marca_Language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMarcaLanguage;

    /**
     * @var string $detalle
     *
     * @ORM\Column(name="__detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * @var string $adjunto
     *
     * @ORM\Column(name="__adjunto", type="string", length=100, nullable=true)
     */
    private $adjunto;

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
     * @var cart\Entity\CartMarca
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartMarca", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idMarca", referencedColumnName="__idMarca", onDelete="CASCADE")
     * })
     */
    private $marca;


    /**
     * Get idMarcaLanguage
     *
     * @return integer 
     */
    public function getIdMarcaLanguage()
    {
        return $this->idMarcaLanguage;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     * @return CartMarcaLanguage
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
     * Set adjunto
     *
     * @param string $adjunto
     * @return CartMarcaLanguage
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
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CartMarcaLanguage
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

    /**
     * Set marca
     *
     * @param cart\Entity\CartMarca $marca
     * @return CartMarcaLanguage
     */
    public function setMarca(\cart\Entity\CartMarca $marca = null)
    {
        $this->marca = $marca;
    
        return $this;
    }

    /**
     * Get marca
     *
     * @return cart\Entity\CartMarca 
     */
    public function getMarca()
    {
        return $this->marca;
    }
}