<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsContentComentario
 *
 * @ORM\Table(name="cms_content_comentario", indexes={@ORM\Index(name="contentComen_estado_idx", columns={"__estado"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsContentComentarioRepository")
 */
class CmsContentComentario
{
    /**
     * @var integer $idContentComentario
     *
     * @ORM\Column(name="__id_content_comentario", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContentComentario;

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
     * @var web\Entity\CmsContent
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsContent", inversedBy="comentarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__idContent", referencedColumnName="__idContent", onDelete="CASCADE")
     * })
     */
    private $content;

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
     * Get idContentComentario
     *
     * @return integer 
     */
    public function getIdContentComentario()
    {
        return $this->idContentComentario;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return CmsContentComentario
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
     * @return CmsContentComentario
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
     * @return CmsContentComentario
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
     * @return CmsContentComentario
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
     * Set content
     *
     * @param web\Entity\CmsContent $content
     * @return CmsContentComentario
     */
    public function setContent(\web\Entity\CmsContent $content = null)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return web\Entity\CmsContent 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set cliente
     *
     * @param web\Entity\CmsCliente $cliente
     * @return CmsContentComentario
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