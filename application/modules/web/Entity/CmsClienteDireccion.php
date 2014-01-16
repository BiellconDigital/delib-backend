<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsClienteDireccion
 *
 * @ORM\Table(name="cms_cliente__direccion")
 * @ORM\Entity(repositoryClass="web\Repositories\CmsClienteDireccionRepository")
 */
class CmsClienteDireccion
{
    /**
     * @var integer $idClienteDireccion
     *
     * @ORM\Column(name="__id_cliente_direccion", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClienteDireccion;

    /**
     * @var boolean $dirprinDespacho
     *
     * @ORM\Column(name="__dirprin_despacho", type="boolean", nullable=true)
     */
    private $dirprinDespacho;

    /**
     * @var boolean $dirDespacho
     *
     * @ORM\Column(name="__dir_despacho", type="boolean", nullable=false)
     */
    private $dirDespacho;

    /**
     * @var boolean $dirFactura
     *
     * @ORM\Column(name="__dir_factura", type="boolean", nullable=false)
     */
    private $dirFactura;

    /**
     * @var string $direccion
     *
     * @ORM\Column(name="__direccion", type="string", length=130, nullable=true)
     */
    private $direccion;

    /**
     * @var boolean $estado
     *
     * @ORM\Column(name="__estado", type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @var \DateTime $fechaRegistro
     *
     * @ORM\Column(name="__fecha_Registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime $fechaModificacion
     *
     * @ORM\Column(name="__fecha_Modificacion", type="datetime", nullable=true)
     */
    private $fechaModificacion;

    /**
     * @var integer $userModificacion
     *
     * @ORM\Column(name="__user_modificacion", type="bigint", nullable=true)
     */
    private $userModificacion;

    /**
     * @var web\Entity\CmsCliente
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsCliente", inversedBy="direcciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="_id__cliente", referencedColumnName="__id_cliente", onDelete="CASCADE")
     * })
     */
    private $cliente;

    /**
     * @var web\Entity\CmsTipoDireccion
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsTipoDireccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_tipo_direccion", referencedColumnName="__id_tipo_direccion")
     * })
     */
    private $tipoDireccion;

    /**
     * @var web\Entity\CmsPais
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsPais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_Pais", referencedColumnName="__id_Pais")
     * })
     */
    private $pais;

    /**
     * @var web\Entity\CmsUbigeo
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsUbigeo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__cod_postal", referencedColumnName="__cod_postal")
     * })
     */
    private $ubigeo;


    /**
     * Get idClienteDireccion
     *
     * @return integer 
     */
    public function getIdClienteDireccion()
    {
        return $this->idClienteDireccion;
    }

    /**
     * Set dirprinDespacho
     *
     * @param boolean $dirprinDespacho
     * @return CmsClienteDireccion
     */
    public function setDirprinDespacho($dirprinDespacho)
    {
        $this->dirprinDespacho = $dirprinDespacho;
    
        return $this;
    }

    /**
     * Get dirprinDespacho
     *
     * @return boolean 
     */
    public function getDirprinDespacho()
    {
        return $this->dirprinDespacho;
    }

    /**
     * Set dirDespacho
     *
     * @param boolean $dirDespacho
     * @return CmsClienteDireccion
     */
    public function setDirDespacho($dirDespacho)
    {
        $this->dirDespacho = $dirDespacho;
    
        return $this;
    }

    /**
     * Get dirDespacho
     *
     * @return boolean 
     */
    public function getDirDespacho()
    {
        return $this->dirDespacho;
    }

    /**
     * Set dirFactura
     *
     * @param boolean $dirFactura
     * @return CmsClienteDireccion
     */
    public function setDirFactura($dirFactura)
    {
        $this->dirFactura = $dirFactura;
    
        return $this;
    }

    /**
     * Get dirFactura
     *
     * @return boolean 
     */
    public function getDirFactura()
    {
        return $this->dirFactura;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return CmsClienteDireccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return CmsClienteDireccion
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
     * @return CmsClienteDireccion
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return CmsClienteDireccion
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    
        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set userModificacion
     *
     * @param integer $userModificacion
     * @return CmsClienteDireccion
     */
    public function setUserModificacion($userModificacion)
    {
        $this->userModificacion = $userModificacion;
    
        return $this;
    }

    /**
     * Get userModificacion
     *
     * @return integer 
     */
    public function getUserModificacion()
    {
        return $this->userModificacion;
    }

    /**
     * Set cliente
     *
     * @param web\Entity\CmsCliente $cliente
     * @return CmsClienteDireccion
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

    /**
     * Set tipoDireccion
     *
     * @param web\Entity\CmsTipoDireccion $tipoDireccion
     * @return CmsClienteDireccion
     */
    public function setTipoDireccion(\web\Entity\CmsTipoDireccion $tipoDireccion = null)
    {
        $this->tipoDireccion = $tipoDireccion;
    
        return $this;
    }

    /**
     * Get tipoDireccion
     *
     * @return web\Entity\CmsTipoDireccion 
     */
    public function getTipoDireccion()
    {
        return $this->tipoDireccion;
    }

    /**
     * Set pais
     *
     * @param web\Entity\CmsPais $pais
     * @return CmsClienteDireccion
     */
    public function setPais(\web\Entity\CmsPais $pais = null)
    {
        $this->pais = $pais;
    
        return $this;
    }

    /**
     * Get pais
     *
     * @return web\Entity\CmsPais 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set ubigeo
     *
     * @param web\Entity\CmsUbigeo $ubigeo
     * @return CmsClienteDireccion
     */
    public function setUbigeo(\web\Entity\CmsUbigeo $ubigeo = null)
    {
        $this->ubigeo = $ubigeo;
    
        return $this;
    }

    /**
     * Get ubigeo
     *
     * @return web\Entity\CmsUbigeo 
     */
    public function getUbigeo()
    {
        return $this->ubigeo;
    }
}