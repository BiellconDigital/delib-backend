<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsUbigeo
 *
 * @ORM\Table(name="cms_ubigeo", indexes={@ORM\Index(name="ubig_dpto_idx", columns={"__dpto"}), @ORM\Index(name="ubig_prov_idx", columns={"__prov"}), @ORM\Index(name="ubig_dist_idx", columns={"__dist"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsUbigeoRepository")
 */
class CmsUbigeo
{
    /**
     * @var string $codPostal
     *
     * @ORM\Column(name="__cod_postal", type="string", length=12, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $codPostal;

    /**
     * @var string $dpto
     *
     * @ORM\Column(name="__dpto", type="string", length=70, nullable=false)
     */
    private $dpto;

    /**
     * @var string $prov
     *
     * @ORM\Column(name="__prov", type="string", length=70, nullable=true)
     */
    private $prov;

    /**
     * @var string $dist
     *
     * @ORM\Column(name="__dist", type="string", length=70, nullable=true)
     */
    private $dist;

    /**
     * @var string $cregion
     *
     * @ORM\Column(name="__cregion", type="string", length=3, nullable=true)
     */
    private $cregion;

    /**
     * @var string $csubregion
     *
     * @ORM\Column(name="__csubregion", type="string", length=3, nullable=true)
     */
    private $csubregion;

    /**
     * @var string $codDpto
     *
     * @ORM\Column(name="__cod_dpto", type="string", length=5, nullable=true)
     */
    private $codDpto;

    /**
     * @var string $codProv
     *
     * @ORM\Column(name="__cod_prov", type="string", length=10, nullable=true)
     */
    private $codProv;

    /**
     * @var web\Entity\CmsPais
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsPais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__id_Pais", referencedColumnName="__id_Pais", onDelete="CASCADE")
     * })
     */
    private $pais;


    /**
     * Set codPostal
     *
     * @param string $codPostal
     * @return CmsUbigeo
     */
    public function setCodPostal($codPostal)
    {
        $this->codPostal = $codPostal;
    
        return $this;
    }

    /**
     * Get codPostal
     *
     * @return string 
     */
    public function getCodPostal()
    {
        return $this->codPostal;
    }

    /**
     * Set dpto
     *
     * @param string $dpto
     * @return CmsUbigeo
     */
    public function setDpto($dpto)
    {
        $this->dpto = $dpto;
    
        return $this;
    }

    /**
     * Get dpto
     *
     * @return string 
     */
    public function getDpto()
    {
        return $this->dpto;
    }

    /**
     * Set prov
     *
     * @param string $prov
     * @return CmsUbigeo
     */
    public function setProv($prov)
    {
        $this->prov = $prov;
    
        return $this;
    }

    /**
     * Get prov
     *
     * @return string 
     */
    public function getProv()
    {
        return $this->prov;
    }

    /**
     * Set dist
     *
     * @param string $dist
     * @return CmsUbigeo
     */
    public function setDist($dist)
    {
        $this->dist = $dist;
    
        return $this;
    }

    /**
     * Get dist
     *
     * @return string 
     */
    public function getDist()
    {
        return $this->dist;
    }

    /**
     * Set cregion
     *
     * @param string $cregion
     * @return CmsUbigeo
     */
    public function setCregion($cregion)
    {
        $this->cregion = $cregion;
    
        return $this;
    }

    /**
     * Get cregion
     *
     * @return string 
     */
    public function getCregion()
    {
        return $this->cregion;
    }

    /**
     * Set csubregion
     *
     * @param string $csubregion
     * @return CmsUbigeo
     */
    public function setCsubregion($csubregion)
    {
        $this->csubregion = $csubregion;
    
        return $this;
    }

    /**
     * Get csubregion
     *
     * @return string 
     */
    public function getCsubregion()
    {
        return $this->csubregion;
    }

    /**
     * Set codDpto
     *
     * @param string $codDpto
     * @return CmsUbigeo
     */
    public function setCodDpto($codDpto)
    {
        $this->codDpto = $codDpto;
    
        return $this;
    }

    /**
     * Get codDpto
     *
     * @return string 
     */
    public function getCodDpto()
    {
        return $this->codDpto;
    }

    /**
     * Set codProv
     *
     * @param string $codProv
     * @return CmsUbigeo
     */
    public function setCodProv($codProv)
    {
        $this->codProv = $codProv;
    
        return $this;
    }

    /**
     * Get codProv
     *
     * @return string 
     */
    public function getCodProv()
    {
        return $this->codProv;
    }

    /**
     * Set pais
     *
     * @param web\Entity\CmsPais $pais
     * @return CmsUbigeo
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
}