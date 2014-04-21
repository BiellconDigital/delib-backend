<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartProducto
 *
 * @ORM\Table(name="cart_producto")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartProductoRepository")
 */
class CartProducto
{
    /**
     * @var integer $idproducto
     *
     * @ORM\Column(name="__idProducto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproducto;

    /**
     * @var string $codigoProducto
     *
     * @ORM\Column(name="__codigo_producto", type="string", length=15, nullable=false)
     */
    private $codigoProducto;

    /**
     * @var float $precio
     *
     * @ORM\Column(name="__precio", type="float", nullable=true)
     */
    private $precio;

    /**
     * @var float $cantidad
     *
     * @ORM\Column(name="__cantidad", type="float", nullable=true)
     */
    private $cantidad;

    /**
     * @var float $cantidadVendidos
     *
     * @ORM\Column(name="__cantidad_vendidos", type="float", nullable=true)
     */
    private $cantidadVendidos;

    /**
     * @var float $peso
     *
     * @ORM\Column(name="__peso", type="float", nullable=true)
     */
    private $peso;

    /**
     * @var string $imagen
     *
     * @ORM\Column(name="__imagen", type="string", length=100, nullable=true)
     */
    private $imagen;

    /**
     * @var string $adjunto
     *
     * @ORM\Column(name="__adjunto", type="string", length=100, nullable=true)
     */
    private $adjunto;

    /**
     * @var integer $orden
     *
     * @ORM\Column(name="__orden", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var boolean $estado
     *
     * @ORM\Column(name="__estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime $fechainipub
     *
     * @ORM\Column(name="__fechaIniPub", type="date", nullable=true)
     */
    private $fechainipub;

    /**
     * @var \DateTime $fechafinpub
     *
     * @ORM\Column(name="__fechaFinPub", type="date", nullable=true)
     */
    private $fechafinpub;

    /**
     * @var \DateTime $fechamodif
     *
     * @ORM\Column(name="__fechamodif", type="datetime", nullable=true)
     */
    private $fechamodif;

    /**
     * @var \DateTime $fechareg
     *
     * @ORM\Column(name="__fechareg", type="datetime", nullable=true)
     */
    private $fechareg;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="cart\Entity\CartProductoLanguage", mappedBy="producto", cascade={"persist"})
     */
    private $languages;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="cart\Entity\CartProductoGaleria", mappedBy="producto", cascade={"persist"})
     */
    private $galeria;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="cart\Entity\CartProductoComentario", mappedBy="producto", cascade={"persist"})
     */
    private $comentarios;

    /**
     * @var cart\Entity\CartMarca
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartMarca")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idMarca", referencedColumnName="__idMarca")
     * })
     */
    private $marca;

    /**
     * @var cart\Entity\CartProductoCategoria
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartProductoCategoria")
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
     *   @ORM\JoinColumn(name="__idTipo", referencedColumnName="__idTipo")
     * })
     */
    private $tipo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->galeria = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comentarios = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idproducto
     *
     * @return integer 
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Set codigoProducto
     *
     * @param string $codigoProducto
     * @return CartProducto
     */
    public function setCodigoProducto($codigoProducto)
    {
        $this->codigoProducto = $codigoProducto;
    
        return $this;
    }

    /**
     * Get codigoProducto
     *
     * @return string 
     */
    public function getCodigoProducto()
    {
        return $this->codigoProducto;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return CartProducto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set cantidad
     *
     * @param float $cantidad
     * @return CartProducto
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
     * Set cantidadVendidos
     *
     * @param float $cantidadVendidos
     * @return CartProducto
     */
    public function setCantidadVendidos($cantidadVendidos)
    {
        $this->cantidadVendidos = $cantidadVendidos;
    
        return $this;
    }

    /**
     * Get cantidadVendidos
     *
     * @return float 
     */
    public function getCantidadVendidos()
    {
        return $this->cantidadVendidos;
    }

    /**
     * Set peso
     *
     * @param float $peso
     * @return CartProducto
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;
    
        return $this;
    }

    /**
     * Get peso
     *
     * @return float 
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return CartProducto
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    
        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set adjunto
     *
     * @param string $adjunto
     * @return CartProducto
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
     * Set orden
     *
     * @param integer $orden
     * @return CartProducto
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return CartProducto
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
     * Set fechainipub
     *
     * @param \DateTime $fechainipub
     * @return CartProducto
     */
    public function setFechainipub($fechainipub)
    {
        $this->fechainipub = $fechainipub;
    
        return $this;
    }

    /**
     * Get fechainipub
     *
     * @return \DateTime 
     */
    public function getFechainipub()
    {
        return $this->fechainipub;
    }

    /**
     * Set fechafinpub
     *
     * @param \DateTime $fechafinpub
     * @return CartProducto
     */
    public function setFechafinpub($fechafinpub)
    {
        $this->fechafinpub = $fechafinpub;
    
        return $this;
    }

    /**
     * Get fechafinpub
     *
     * @return \DateTime 
     */
    public function getFechafinpub()
    {
        return $this->fechafinpub;
    }

    /**
     * Set fechamodif
     *
     * @param \DateTime $fechamodif
     * @return CartProducto
     */
    public function setFechamodif($fechamodif)
    {
        $this->fechamodif = $fechamodif;
    
        return $this;
    }

    /**
     * Get fechamodif
     *
     * @return \DateTime 
     */
    public function getFechamodif()
    {
        return $this->fechamodif;
    }

    /**
     * Set fechareg
     *
     * @param \DateTime $fechareg
     * @return CartProducto
     */
    public function setFechareg($fechareg)
    {
        $this->fechareg = $fechareg;
    
        return $this;
    }

    /**
     * Get fechareg
     *
     * @return \DateTime 
     */
    public function getFechareg()
    {
        return $this->fechareg;
    }

    /**
     * Add languages
     *
     * @param cart\Entity\CartProductoLanguage $languages
     * @return CartProducto
     */
    public function addLanguage(\cart\Entity\CartProductoLanguage $languages)
    {
        $this->languages[] = $languages;
    
        return $this;
    }

    /**
     * Remove languages
     *
     * @param cart\Entity\CartProductoLanguage $languages
     */
    public function removeLanguage(\cart\Entity\CartProductoLanguage $languages)
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

    /**
     * Add galeria
     *
     * @param cart\Entity\CartProductoGaleria $galeria
     * @return CartProducto
     */
    public function addGaleria(\cart\Entity\CartProductoGaleria $galeria)
    {
        $this->galeria[] = $galeria;
    
        return $this;
    }

    /**
     * Remove galeria
     *
     * @param cart\Entity\CartProductoGaleria $galeria
     */
    public function removeGaleria(\cart\Entity\CartProductoGaleria $galeria)
    {
        $this->galeria->removeElement($galeria);
    }

    /**
     * Get galeria
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGaleria()
    {
        return $this->galeria;
    }

    /**
     * Add comentarios
     *
     * @param cart\Entity\CartProductoComentario $comentarios
     * @return CartProducto
     */
    public function addComentario(\cart\Entity\CartProductoComentario $comentarios)
    {
        $this->comentarios[] = $comentarios;
    
        return $this;
    }

    /**
     * Remove comentarios
     *
     * @param cart\Entity\CartProductoComentario $comentarios
     */
    public function removeComentario(\cart\Entity\CartProductoComentario $comentarios)
    {
        $this->comentarios->removeElement($comentarios);
    }

    /**
     * Get comentarios
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set marca
     *
     * @param cart\Entity\CartMarca $marca
     * @return CartProducto
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

    /**
     * Set contcate
     *
     * @param cart\Entity\CartProductoCategoria $contcate
     * @return CartProducto
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
     * @return CartProducto
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
     * @var float $precio1
     *
     * @ORM\Column(name="__precio1", type="float", nullable=true)
     */
    private $precio1;

    /**
     * @var float $precio2
     *
     * @ORM\Column(name="__precio2", type="float", nullable=true)
     */
    private $precio2;


    /**
     * Set precio1
     *
     * @param float $precio1
     * @return CartProducto
     */
    public function setPrecio1($precio1)
    {
        $this->precio1 = $precio1;
    
        return $this;
    }

    /**
     * Get precio1
     *
     * @return float 
     */
    public function getPrecio1()
    {
        return $this->precio1;
    }

    /**
     * Set precio2
     *
     * @param float $precio2
     * @return CartProducto
     */
    public function setPrecio2($precio2)
    {
        $this->precio2 = $precio2;
    
        return $this;
    }

    /**
     * Get precio2
     *
     * @return float 
     */
    public function getPrecio2()
    {
        return $this->precio2;
    }
}