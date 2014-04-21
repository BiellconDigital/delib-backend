<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartProductoCategoriaTipo
 *
 * @ORM\Table(name="cart_producto__categoria_tipo")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartProductoCategoriaTipoRepository")
 */
class CartProductoCategoriaTipo
{
    /**
     * @var integer $idProductocateTipo
     *
     * @ORM\Column(name="__id_ProductoCate_Tipo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProductocateTipo;

    /**
     * @var float $cantidad
     *
     * @ORM\Column(name="__cantidad", type="decimal", nullable=true)
     */
    private $cantidad;

    /**
     * @var boolean $estado
     *
     * @ORM\Column(name="__estado", type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @var cart\Entity\CartProductoCategoria
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartProductoCategoria", inversedBy="tipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idContCate", referencedColumnName="__idContCate", onDelete="CASCADE")
     * })
     */
    private $contcate;

    /**
     * @var cart\Entity\CartProductoTipo
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartProductoTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idTipo", referencedColumnName="__idTipo", onDelete="CASCADE")
     * })
     */
    private $tipo;


    /**
     * Get idProductocateTipo
     *
     * @return integer 
     */
    public function getIdProductocateTipo()
    {
        return $this->idProductocateTipo;
    }

    /**
     * Set cantidad
     *
     * @param float $cantidad
     * @return CartProductoCategoriaTipo
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return CartProductoCategoriaTipo
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
     * Set contcate
     *
     * @param cart\Entity\CartProductoCategoria $contcate
     * @return CartProductoCategoriaTipo
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
     * Set tipo
     *
     * @param cart\Entity\CartProductoTipo $tipo
     * @return CartProductoCategoriaTipo
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
}