<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartProductoCategoriaLanguage
 *
 * @ORM\Table(name="cart_producto__categoria_language")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartProductoCategoriaLanguageRepository")
 */
class CartProductoCategoriaLanguage
{
    /**
     * @var integer $idProductocateLanguage
     *
     * @ORM\Column(name="__id_ProductoCate_Language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProductocateLanguage;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="__descripcion", type="string", length=100, nullable=false)
     */
    private $descripcion;

    /**
     * @var string $detalle
     *
     * @ORM\Column(name="__detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * @var cart\Entity\CartProductoCategoria
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartProductoCategoria", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idContCate", referencedColumnName="__idContCate", onDelete="CASCADE")
     * })
     */
    private $contcate;

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
     * Get idProductocateLanguage
     *
     * @return integer 
     */
    public function getIdProductocateLanguage()
    {
        return $this->idProductocateLanguage;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CartProductoCategoriaLanguage
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
     * Set detalle
     *
     * @param string $detalle
     * @return CartProductoCategoriaLanguage
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
     * Set contcate
     *
     * @param cart\Entity\CartProductoCategoria $contcate
     * @return CartProductoCategoriaLanguage
     */
    public function setContcate(\cart\Entity\CartProductoCategoria $contcate = null)
    {
        $this->contcate = $contcate;
    
        return $this;
    }

    /**
     * Get contcate
     *
     * @return cart\Entity\CartProductoCategoria 
     */
    public function getContcate()
    {
        return $this->contcate;
    }

    /**
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CartProductoCategoriaLanguage
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