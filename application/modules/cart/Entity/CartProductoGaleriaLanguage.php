<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartProductoGaleriaLanguage
 *
 * @ORM\Table(name="cart_producto__galeria_language")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartProductoGaleriaLanguageRepository")
 */
class CartProductoGaleriaLanguage
{
    /**
     * @var integer $idProductogaleLanguage
     *
     * @ORM\Column(name="__id_ProductoGale_Language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProductogaleLanguage;

    /**
     * @var string $titulo
     *
     * @ORM\Column(name="__titulo", type="string", length=100, nullable=true)
     */
    private $titulo;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="__descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var cart\Entity\CartProductoGaleria
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartProductoGaleria", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idContGale", referencedColumnName="__idContGale", onDelete="CASCADE")
     * })
     */
    private $contgale;

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
     * Get idProductogaleLanguage
     *
     * @return integer 
     */
    public function getIdProductogaleLanguage()
    {
        return $this->idProductogaleLanguage;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return CartProductoGaleriaLanguage
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CartProductoGaleriaLanguage
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
     * Set contgale
     *
     * @param cart\Entity\CartProductoGaleria $contgale
     * @return CartProductoGaleriaLanguage
     */
    public function setContgale(\cart\Entity\CartProductoGaleria $contgale = null)
    {
        $this->contgale = $contgale;
    
        return $this;
    }

    /**
     * Get contgale
     *
     * @return cart\Entity\CartProductoGaleria 
     */
    public function getContgale()
    {
        return $this->contgale;
    }

    /**
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CartProductoGaleriaLanguage
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