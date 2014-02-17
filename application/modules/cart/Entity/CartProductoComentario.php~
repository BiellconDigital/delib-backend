<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartProductoComentario
 *
 * @ORM\Table(name="cart_producto_comentario")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartProductoComentarioRepository")
 */
class CartProductoComentario
{
    /**
     * @var integer $idProductoComentario
     *
     * @ORM\Column(name="__id_producto_comentario", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProductoComentario;

    /**
     * @var string $titulo
     *
     * @ORM\Column(name="__titulo", type="string", length=45, nullable=true)
     */
    private $titulo;

    /**
     * @var string $comentario
     *
     * @ORM\Column(name="__comentario", type="text", nullable=false)
     */
    private $comentario;

    /**
     * @var boolean $estado
     *
     * @ORM\Column(name="__estado", type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @var \DateTime $fechaRegistro
     *
     * @ORM\Column(name="__fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var cart\Entity\CartProducto
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartProducto", inversedBy="comentarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idProducto", referencedColumnName="__idProducto", onDelete="CASCADE")
     * })
     */
    private $producto;

    /**
     * @var web\Entity\CmsCliente
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsCliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_cliente", referencedColumnName="__id_cliente", onDelete="CASCADE")
     * })
     */
    private $cliente;


    /**
     * Get idProductoComentario
     *
     * @return integer 
     */
    public function getIdProductoComentario()
    {
        return $this->idProductoComentario;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return CartProductoComentario
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
     * Set comentario
     *
     * @param string $comentario
     * @return CartProductoComentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    
        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return CartProductoComentario
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return CartProductoComentario
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    
        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set producto
     *
     * @param cart\Entity\CartProducto $producto
     * @return CartProductoComentario
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
     * Set cliente
     *
     * @param web\Entity\CmsCliente $cliente
     * @return CartProductoComentario
     */
    public function setCliente(\web\Entity\CmsCliente $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return web\Entity\CmsCliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }
}