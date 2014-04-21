<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsLanguage
 *
 * @ORM\Table(name="cms_language", indexes={@ORM\Index(name="keys_estado_idx", columns={"__estado"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsLanguageRepository")
 */
class CmsLanguage
{
    /**
     * @var integer $idLanguage
     *
     * @ORM\Column(name="__id_language", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLanguage;

    /**
     * @var string $idioma
     *
     * @ORM\Column(name="__idioma", type="string", length=70, nullable=false)
     */
    private $idioma;

    /**
     * @var string $nombreCorto
     *
     * @ORM\Column(name="__nombre_corto", type="string", length=6, nullable=true)
     */
    private $nombreCorto;

    /**
     * @var boolean $estado
     *
     * @ORM\Column(name="__estado", type="boolean", nullable=false)
     */
    private $estado;


    /**
     * Get idLanguage
     *
     * @return integer 
     */
    public function getIdLanguage()
    {
        return $this->idLanguage;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     * @return CmsLanguage
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;
    
        return $this;
    }

    /**
     * Get idioma
     *
     * @return string 
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set nombreCorto
     *
     * @param string $nombreCorto
     * @return CmsLanguage
     */
    public function setNombreCorto($nombreCorto)
    {
        $this->nombreCorto = $nombreCorto;
    
        return $this;
    }

    /**
     * Get nombreCorto
     *
     * @return string 
     */
    public function getNombreCorto()
    {
        return $this->nombreCorto;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return CmsLanguage
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
     * @var boolean $principal
     *
     * @ORM\Column(name="__principal", type="boolean", nullable=false)
     */
    private $principal;


    /**
     * Set principal
     *
     * @param boolean $principal
     * @return CmsLanguage
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;
    
        return $this;
    }

    /**
     * Get principal
     *
     * @return boolean 
     */
    public function getPrincipal()
    {
        return $this->principal;
    }
}