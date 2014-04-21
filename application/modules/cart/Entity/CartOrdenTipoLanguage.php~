<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartOrdenTipoLanguage
 *
 * @ORM\Table(name="cart_orden__tipo_language")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartOrdenTipoLanguageRepository")
 */
class CartOrdenTipoLanguage
{
    /**
     * @var integer $idOrdentipoLanguage
     *
     * @ORM\Column(name="__id_OrdenTipo_Language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrdentipoLanguage;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="__descripcion", type="string", length=140, nullable=false)
     */
    private $descripcion;

    /**
     * @var string $detalle
     *
     * @ORM\Column(name="__detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * @var cart\Entity\CartOrdenTipo
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartOrdenTipo", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_orden_tipo", referencedColumnName="__id_orden_tipo", onDelete="CASCADE")
     * })
     */
    private $ordenTipo;

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
     * Get idOrdentipoLanguage
     *
     * @return integer 
     */
    public function getIdOrdentipoLanguage()
    {
        return $this->idOrdentipoLanguage;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CartOrdenTipoLanguage
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
     * @return CartOrdenTipoLanguage
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
     * Set ordenTipo
     *
     * @param cart\Entity\CartOrdenTipo $ordenTipo
     * @return CartOrdenTipoLanguage
     */
    public function setOrdenTipo(\cart\Entity\CartOrdenTipo $ordenTipo = null)
    {
        $this->ordenTipo = $ordenTipo;
    
        return $this;
    }

    /**
     * Get ordenTipo
     *
     * @return cart\Entity\CartOrdenTipo 
     */
    public function getOrdenTipo()
    {
        return $this->ordenTipo;
    }

    /**
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CartOrdenTipoLanguage
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