<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartOrdenEstadoLanguage
 *
 * @ORM\Table(name="cart_orden__estado_language")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartOrdenEstadoLanguageRepository")
 */
class CartOrdenEstadoLanguage
{
    /**
     * @var integer $idOrdenestadoLanguage
     *
     * @ORM\Column(name="__id_OrdenEstado_Language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOrdenestadoLanguage;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="__nombre", type="string", length=140, nullable=false)
     */
    private $nombre;

    /**
     * @var string $detalle
     *
     * @ORM\Column(name="__detalle", type="text", nullable=true)
     */
    private $detalle;

    /**
     * @var cart\Entity\CartOrdenEstado
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartOrdenEstado", inversedBy="languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_orden_estado", referencedColumnName="__id_orden_estado", onDelete="CASCADE")
     * })
     */
    private $ordenEstado;

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
     * Get idOrdenestadoLanguage
     *
     * @return integer 
     */
    public function getIdOrdenestadoLanguage()
    {
        return $this->idOrdenestadoLanguage;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CartOrdenEstadoLanguage
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
     * Set detalle
     *
     * @param string $detalle
     * @return CartOrdenEstadoLanguage
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
     * Set ordenEstado
     *
     * @param cart\Entity\CartOrdenEstado $ordenEstado
     * @return CartOrdenEstadoLanguage
     */
    public function setOrdenEstado(\cart\Entity\CartOrdenEstado $ordenEstado = null)
    {
        $this->ordenEstado = $ordenEstado;
    
        return $this;
    }

    /**
     * Get ordenEstado
     *
     * @return cart\Entity\CartOrdenEstado 
     */
    public function getOrdenEstado()
    {
        return $this->ordenEstado;
    }

    /**
     * Set language
     *
     * @param web\Entity\CmsLanguage $language
     * @return CartOrdenEstadoLanguage
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