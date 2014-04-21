<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartProductoLanguage
 *
 * @ORM\Table(name="cart_producto_language")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartProductoLanguageRepository")
 */
class CartProductoLanguage
{
    /**
     * @var integer $idProductoLanguage
     *
     * @ORM\Column(name="__id_Producto_Language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProductoLanguage;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="__nombre", type="string", length=120, nullable=true)
     */
    private $nombre;

    /**
     * @var string $intro
     *
     * @ORM\Column(name="__intro", type="text", nullable=true)
     */
    private $intro;

    /**
     * @var string $ficha
     *
     * @ORM\Column(name="__ficha", type="text", nullable=true)
     */
    private $ficha;

    /**
     * @var string $adjunto
     *
     * @ORM\Column(name="__adjunto", type="string", length=150, nullable=true)
     */
    private $adjunto;

    /**
     * @var cart\Entity\CartProducto
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartProducto", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idProducto", referencedColumnName="__idProducto", onDelete="CASCADE")
     * })
     */
    private $producto;

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
     * Get idProductoLanguage
     *
     * @return integer 
     */
    public function getIdProductoLanguage()
    {
        return $this->idProductoLanguage;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CartProductoLanguage
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
     * Set intro
     *
     * @param string $intro
     * @return CartProductoLanguage
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
     * Set ficha
     *
     * @param string $ficha
     * @return CartProductoLanguage
     */
    public function setFicha($ficha)
    {
        $this->ficha = $ficha;
    
        return $this;
    }

    /**
     * Get ficha
     *
     * @return string 
     */
    public function getFicha()
    {
        return $this->ficha;
    }

    /**
     * Set adjunto
     *
     * @param string $adjunto
     * @return CartProductoLanguage
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
     * Set producto
     *
     * @param cart\Entity\CartProducto $producto
     * @return CartProductoLanguage
     */
    public function setProducto(\cart\Entity\CartProducto $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return cart\Entity\CartProducto 
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CartProductoLanguage
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