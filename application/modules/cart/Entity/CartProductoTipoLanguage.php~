<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartProductoTipoLanguage
 *
 * @ORM\Table(name="cart_producto__tipo_language")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartProductoTipoLanguageRepository")
 */
class CartProductoTipoLanguage
{
    /**
     * @var integer $idProductotipoLanguage
     *
     * @ORM\Column(name="__id_ProductoTipo_Language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProductotipoLanguage;

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
     * @var cart\Entity\CartProductoTipo
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartProductoTipo", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idTipo", referencedColumnName="__idTipo", onDelete="CASCADE")
     * })
     */
    private $tipo;

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
     * Get idProductotipoLanguage
     *
     * @return integer 
     */
    public function getIdProductotipoLanguage()
    {
        return $this->idProductotipoLanguage;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CartProductoTipoLanguage
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
     * @return CartProductoTipoLanguage
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
     * Set tipo
     *
     * @param cart\Entity\CartProductoTipo $tipo
     * @return CartProductoTipoLanguage
     */
    public function setTipo(\cart\Entity\CartProductoTipo $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return cart\Entity\CartProductoTipo 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CartProductoTipoLanguage
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