<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsCliente
 *
 * @ORM\Table(name="cms_cliente", indexes={@ORM\Index(name="cliente_role_idx", columns={"__role"}), @ORM\Index(name="cliente_nombres_idx", columns={"__nombres"}), @ORM\Index(name="cliente_apepat_idx", columns={"__apellido_paterno"}), @ORM\Index(name="cliente_apemat_idx", columns={"__apellido_materno"}), @ORM\Index(name="cliente_mail_idx", columns={"__email"}), @ORM\Index(name="cliente_clave_idx", columns={"__clave"}), @ORM\Index(name="cliente_estado_idx", columns={"__estado"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsClienteRepository")
 */
class CmsCliente
{
    /**
     * @var integer $idCliente
     *
     * @ORM\Column(name="__id_cliente", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCliente;

    /**
     * @var string $role
     *
     * @ORM\Column(name="__role", type="string", length=6, nullable=false)
     */
    private $role;

    /**
     * @var string $nombres
     *
     * @ORM\Column(name="__nombres", type="string", length=70, nullable=false)
     */
    private $nombres;

    /**
     * @var string $apellidoPaterno
     *
     * @ORM\Column(name="__apellido_paterno", type="string", length=25, nullable=true)
     */
    private $apellidoPaterno;

    /**
     * @var string $apellidoMaterno
     *
     * @ORM\Column(name="__apellido_materno", type="string", length=25, nullable=true)
     */
    private $apellidoMaterno;

    /**
     * @var string $email
     *
     * @ORM\Column(name="__email", type="string", length=150, nullable=false)
     */
    private $email;

    /**
     * @var string $nroDocumento
     *
     * @ORM\Column(name="__nro_documento", type="string", length=45, nullable=true)
     */
    private $nroDocumento;

    /**
     * @var string $genero
     *
     * @ORM\Column(name="__genero", type="string", length=1, nullable=true)
     */
    private $genero;

    /**
     * @var \DateTime $fechaNacimiento
     *
     * @ORM\Column(name="__fecha_nacimiento", type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var string $telefonoCasa
     *
     * @ORM\Column(name="__telefono_casa", type="string", length=30, nullable=true)
     */
    private $telefonoCasa;

    /**
     * @var string $telefonoOficina
     *
     * @ORM\Column(name="__telefono_oficina", type="string", length=30, nullable=true)
     */
    private $telefonoOficina;

    /**
     * @var string $movil
     *
     * @ORM\Column(name="__movil", type="string", length=30, nullable=true)
     */
    private $movil;

    /**
     * @var string $clave
     *
     * @ORM\Column(name="__clave", type="string", length=70, nullable=true)
     */
    private $clave;

    /**
     * @var boolean $recibirOfertasMail
     *
     * @ORM\Column(name="__recibir_ofertas_mail", type="boolean", nullable=true)
     */
    private $recibirOfertasMail;

    /**
     * @var boolean $recibirOfertasMovil
     *
     * @ORM\Column(name="__recibir_ofertas_movil", type="boolean", nullable=true)
     */
    private $recibirOfertasMovil;

    /**
     * @var boolean $estado
     *
     * @ORM\Column(name="__estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * @var string $foto
     *
     * @ORM\Column(name="__foto", type="string", length=150, nullable=true)
     */
    private $foto;

    /**
     * @var \DateTime $fechaModificacion
     *
     * @ORM\Column(name="__fecha_modificacion", type="datetime", nullable=true)
     */
    private $fechaModificacion;

    /**
     * @var \DateTime $fechaRegistro
     *
     * @ORM\Column(name="__fecha_Registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="web\Entity\CmsClienteDireccion", mappedBy="cliente", cascade={"persist","remove"})
     */
    private $direcciones;

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
     * @var web\Entity\CmsTipoDocumento
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsTipoDocumento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idtipo_documento", referencedColumnName="__idtipo_documento")
     * })
     */
    private $tipoDocumento;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->direcciones = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idCliente
     *
     * @return integer 
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return CmsCliente
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     * @return CmsCliente
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    
        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidoPaterno
     *
     * @param string $apellidoPaterno
     * @return CmsCliente
     */
    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellidoPaterno = $apellidoPaterno;
    
        return $this;
    }

    /**
     * Get apellidoPaterno
     *
     * @return string 
     */
    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }

    /**
     * Set apellidoMaterno
     *
     * @param string $apellidoMaterno
     * @return CmsCliente
     */
    public function setApellidoMaterno($apellidoMaterno)
    {
        $this->apellidoMaterno = $apellidoMaterno;
    
        return $this;
    }

    /**
     * Get apellidoMaterno
     *
     * @return string 
     */
    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return CmsCliente
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nroDocumento
     *
     * @param string $nroDocumento
     * @return CmsCliente
     */
    public function setNroDocumento($nroDocumento)
    {
        $this->nroDocumento = $nroDocumento;
    
        return $this;
    }

    /**
     * Get nroDocumento
     *
     * @return string 
     */
    public function getNroDocumento()
    {
        return $this->nroDocumento;
    }

    /**
     * Set genero
     *
     * @param string $genero
     * @return CmsCliente
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    
        return $this;
    }

    /**
     * Get genero
     *
     * @return string 
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return CmsCliente
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    
        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set telefonoCasa
     *
     * @param string $telefonoCasa
     * @return CmsCliente
     */
    public function setTelefonoCasa($telefonoCasa)
    {
        $this->telefonoCasa = $telefonoCasa;
    
        return $this;
    }

    /**
     * Get telefonoCasa
     *
     * @return string 
     */
    public function getTelefonoCasa()
    {
        return $this->telefonoCasa;
    }

    /**
     * Set telefonoOficina
     *
     * @param string $telefonoOficina
     * @return CmsCliente
     */
    public function setTelefonoOficina($telefonoOficina)
    {
        $this->telefonoOficina = $telefonoOficina;
    
        return $this;
    }

    /**
     * Get telefonoOficina
     *
     * @return string 
     */
    public function getTelefonoOficina()
    {
        return $this->telefonoOficina;
    }

    /**
     * Set movil
     *
     * @param string $movil
     * @return CmsCliente
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;
    
        return $this;
    }

    /**
     * Get movil
     *
     * @return string 
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set clave
     *
     * @param string $clave
     * @return CmsCliente
     */
    public function setClave($clave)
    {
        $this->clave = $clave;
    
        return $this;
    }

    /**
     * Get clave
     *
     * @return string 
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set recibirOfertasMail
     *
     * @param boolean $recibirOfertasMail
     * @return CmsCliente
     */
    public function setRecibirOfertasMail($recibirOfertasMail)
    {
        $this->recibirOfertasMail = $recibirOfertasMail;
    
        return $this;
    }

    /**
     * Get recibirOfertasMail
     *
     * @return boolean 
     */
    public function getRecibirOfertasMail()
    {
        return $this->recibirOfertasMail;
    }

    /**
     * Set recibirOfertasMovil
     *
     * @param boolean $recibirOfertasMovil
     * @return CmsCliente
     */
    public function setRecibirOfertasMovil($recibirOfertasMovil)
    {
        $this->recibirOfertasMovil = $recibirOfertasMovil;
    
        return $this;
    }

    /**
     * Get recibirOfertasMovil
     *
     * @return boolean 
     */
    public function getRecibirOfertasMovil()
    {
        return $this->recibirOfertasMovil;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return CmsCliente
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
     * Set foto
     *
     * @param string $foto
     * @return CmsCliente
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    
        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return CmsCliente
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return CmsCliente
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
     * Add direcciones
     *
     * @param web\Entity\CmsClienteDireccion $direcciones
     * @return CmsCliente
     */
    public function addDireccione(\web\Entity\CmsClienteDireccion $direcciones)
    {
        $this->direcciones[] = $direcciones;
    
        return $this;
    }

    /**
     * Remove direcciones
     *
     * @param web\Entity\CmsClienteDireccion $direcciones
     */
    public function removeDireccione(\web\Entity\CmsClienteDireccion $direcciones)
    {
        $this->direcciones->removeElement($direcciones);
    }

    /**
     * Get direcciones
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDirecciones()
    {
        return $this->direcciones;
    }

    /**
     * Set pais
     *
     * @param web\Entity\CmsPais $pais
     * @return CmsCliente
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
     * Set tipoDocumento
     *
     * @param web\Entity\CmsTipoDocumento $tipoDocumento
     * @return CmsCliente
     */
    public function setTipoDocumento(\web\Entity\CmsTipoDocumento $tipoDocumento = null)
    {
        $this->tipoDocumento = $tipoDocumento;
    
        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return web\Entity\CmsTipoDocumento 
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }
}