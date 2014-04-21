<?php

namespace cart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cart\Entity\CartProductoGaleria
 *
 * @ORM\Table(name="cart_producto__galeria")
 * @ORM\Entity(repositoryClass="cart\Repositories\CartProductoGaleriaRepository")
 */
class CartProductoGaleria
{
    /**
     * @var integer $idcontgale
     *
     * @ORM\Column(name="__idContGale", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcontgale;

    /**
     * @var integer $ordenGale
     *
     * @ORM\Column(name="__orden_gale", type="integer", nullable=false)
     */
    private $ordenGale;

    /**
     * @var string $imagenGale
     *
     * @ORM\Column(name="__imagen_gale", type="string", length=260, nullable=true)
     */
    private $imagenGale;

    /**
     * @var \DateTime $fecharegGale
     *
     * @ORM\Column(name="__fechareg_gale", type="datetime", nullable=true)
     */
    private $fecharegGale;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="cart\Entity\CartProductoGaleriaLanguage", mappedBy="contgale", cascade={"persist"})
     */
    private $languages;

    /**
     * @var cart\Entity\CartProducto
     *
     * @ORM\ManyToOne(targetEntity="cart\Entity\CartProducto", inversedBy="galeria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idProducto", referencedColumnName="__idProducto", onDelete="CASCADE")
     * })
     */
    private $producto;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idcontgale
     *
     * @return integer 
     */
    public function getIdcontgale()
    {
        return $this->idcontgale;
    }

    /**
     * Set ordenGale
     *
     * @param integer $ordenGale
     * @return CartProductoGaleria
     */
    public function setOrdenGale($ordenGale)
    {
        $this->ordenGale = $ordenGale;
    
        return $this;
    }

    /**
     * Get ordenGale
     *
     * @return integer 
     */
    public function getOrdenGale()
    {
        return $this->ordenGale;
    }

    /**
     * Set imagenGale
     *
     * @param string $imagenGale
     * @return CartProductoGaleria
     */
    public function setImagenGale($imagenGale)
    {
        $this->imagenGale = $imagenGale;
    
        return $this;
    }

    /**
     * Get imagenGale
     *
     * @return string 
     */
    public function getImagenGale()
    {
        return $this->imagenGale;
    }

    /**
     * Set fecharegGale
     *
     * @param \DateTime $fecharegGale
     * @return CartProductoGaleria
     */
    public function setFecharegGale($fecharegGale)
    {
        $this->fecharegGale = $fecharegGale;
    
        return $this;
    }

    /**
     * Get fecharegGale
     *
     * @return \DateTime 
     */
    public function getFecharegGale()
    {
        return $this->fecharegGale;
    }

    /**
     * Add languages
     *
     * @param cart\Entity\CartProductoGaleriaLanguage $languages
     * @return CartProductoGaleria
     */
    public function addLanguage(\cart\Entity\CartProductoGaleriaLanguage $languages)
    {
        $this->languages[] = $languages;
    
        return $this;
    }

    /**
     * Remove languages
     *
     * @param cart\Entity\CartProductoGaleriaLanguage $languages
     */
    public function removeLanguage(\cart\Entity\CartProductoGaleriaLanguage $languages)
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
     * Set producto
     *
     * @param cart\Entity\CartProducto $producto
     * @return CartProductoGaleria
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
}