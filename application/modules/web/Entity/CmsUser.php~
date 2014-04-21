<?php

namespace web\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * web\Entity\CmsUser
 *
 * @ORM\Table(name="cms_user", indexes={@ORM\Index(name="user_role_idx", columns={"__role"}), @ORM\Index(name="user_email_idx", columns={"__email_user"}), @ORM\Index(name="user_pass_idx", columns={"__pass_user"}), @ORM\Index(name="user_state_idx", columns={"__state_user"})})
 * @ORM\Entity(repositoryClass="web\Repositories\CmsUserRepository")
 */
class CmsUser
{
    /**
     * @var integer $iduser
     *
     * @ORM\Column(name="__idUser", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduser;

    /**
     * @var string $role
     *
     * @ORM\Column(name="__role", type="string", length=6, nullable=false)
     */
    private $role;

    /**
     * @var string $nameUser
     *
     * @ORM\Column(name="__name_user", type="string", length=70, nullable=false)
     */
    private $nameUser;

    /**
     * @var string $addressUser
     *
     * @ORM\Column(name="__address_user", type="string", length=150, nullable=false)
     */
    private $addressUser;

    /**
     * @var string $documentUser
     *
     * @ORM\Column(name="__document_user", type="string", length=20, nullable=true)
     */
    private $documentUser;

    /**
     * @var string $ocupationUser
     *
     * @ORM\Column(name="__ocupation_user", type="string", length=70, nullable=true)
     */
    private $ocupationUser;

    /**
     * @var string $phoneUser
     *
     * @ORM\Column(name="__phone_user", type="string", length=20, nullable=true)
     */
    private $phoneUser;

    /**
     * @var string $mobileUser
     *
     * @ORM\Column(name="__mobile_user", type="string", length=28, nullable=true)
     */
    private $mobileUser;

    /**
     * @var string $emailUser
     *
     * @ORM\Column(name="__email_user", type="string", length=150, nullable=false)
     */
    private $emailUser;

    /**
     * @var string $nickUser
     *
     * @ORM\Column(name="__nick_user", type="string", length=15, nullable=false)
     */
    private $nickUser;

    /**
     * @var string $passUser
     *
     * @ORM\Column(name="__pass_user", type="string", length=60, nullable=false)
     */
    private $passUser;

    /**
     * @var string $typeUser
     *
     * @ORM\Column(name="__type_user", type="string", length=8, nullable=false)
     */
    private $typeUser;

    /**
     * @var boolean $stateUser
     *
     * @ORM\Column(name="__state_user", type="boolean", nullable=false)
     */
    private $stateUser;

    /**
     * @var \DateTime $registrationUser
     *
     * @ORM\Column(name="__registration_user", type="datetime", nullable=true)
     */
    private $registrationUser;

    /**
     * @var \DateTime $modificationDateUser
     *
     * @ORM\Column(name="__modification_date_user", type="datetime", nullable=true)
     */
    private $modificationDateUser;

    /**
     * @var web\Entity\CmsTipoDocumento
     *
     * @ORM\ManyToOne(targetEntity="web\Entity\CmsTipoDocumento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="__type_docu_user", referencedColumnName="__idtipo_documento")
     * })
     */
    private $typeDocuUser;


    /**
     * Get iduser
     *
     * @return integer 
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return CmsUser
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
     * Set nameUser
     *
     * @param string $nameUser
     * @return CmsUser
     */
    public function setNameUser($nameUser)
    {
        $this->nameUser = $nameUser;
    
        return $this;
    }

    /**
     * Get nameUser
     *
     * @return string 
     */
    public function getNameUser()
    {
        return $this->nameUser;
    }

    /**
     * Set addressUser
     *
     * @param string $addressUser
     * @return CmsUser
     */
    public function setAddressUser($addressUser)
    {
        $this->addressUser = $addressUser;
    
        return $this;
    }

    /**
     * Get addressUser
     *
     * @return string 
     */
    public function getAddressUser()
    {
        return $this->addressUser;
    }

    /**
     * Set documentUser
     *
     * @param string $documentUser
     * @return CmsUser
     */
    public function setDocumentUser($documentUser)
    {
        $this->documentUser = $documentUser;
    
        return $this;
    }

    /**
     * Get documentUser
     *
     * @return string 
     */
    public function getDocumentUser()
    {
        return $this->documentUser;
    }

    /**
     * Set ocupationUser
     *
     * @param string $ocupationUser
     * @return CmsUser
     */
    public function setOcupationUser($ocupationUser)
    {
        $this->ocupationUser = $ocupationUser;
    
        return $this;
    }

    /**
     * Get ocupationUser
     *
     * @return string 
     */
    public function getOcupationUser()
    {
        return $this->ocupationUser;
    }

    /**
     * Set phoneUser
     *
     * @param string $phoneUser
     * @return CmsUser
     */
    public function setPhoneUser($phoneUser)
    {
        $this->phoneUser = $phoneUser;
    
        return $this;
    }

    /**
     * Get phoneUser
     *
     * @return string 
     */
    public function getPhoneUser()
    {
        return $this->phoneUser;
    }

    /**
     * Set mobileUser
     *
     * @param string $mobileUser
     * @return CmsUser
     */
    public function setMobileUser($mobileUser)
    {
        $this->mobileUser = $mobileUser;
    
        return $this;
    }

    /**
     * Get mobileUser
     *
     * @return string 
     */
    public function getMobileUser()
    {
        return $this->mobileUser;
    }

    /**
     * Set emailUser
     *
     * @param string $emailUser
     * @return CmsUser
     */
    public function setEmailUser($emailUser)
    {
        $this->emailUser = $emailUser;
    
        return $this;
    }

    /**
     * Get emailUser
     *
     * @return string 
     */
    public function getEmailUser()
    {
        return $this->emailUser;
    }

    /**
     * Set nickUser
     *
     * @param string $nickUser
     * @return CmsUser
     */
    public function setNickUser($nickUser)
    {
        $this->nickUser = $nickUser;
    
        return $this;
    }

    /**
     * Get nickUser
     *
     * @return string 
     */
    public function getNickUser()
    {
        return $this->nickUser;
    }

    /**
     * Set passUser
     *
     * @param string $passUser
     * @return CmsUser
     */
    public function setPassUser($passUser)
    {
        $this->passUser = $passUser;
    
        return $this;
    }

    /**
     * Get passUser
     *
     * @return string 
     */
    public function getPassUser()
    {
        return $this->passUser;
    }

    /**
     * Set typeUser
     *
     * @param string $typeUser
     * @return CmsUser
     */
    public function setTypeUser($typeUser)
    {
        $this->typeUser = $typeUser;
    
        return $this;
    }

    /**
     * Get typeUser
     *
     * @return string 
     */
    public function getTypeUser()
    {
        return $this->typeUser;
    }

    /**
     * Set stateUser
     *
     * @param boolean $stateUser
     * @return CmsUser
     */
    public function setStateUser($stateUser)
    {
        $this->stateUser = $stateUser;
    
        return $this;
    }

    /**
     * Get stateUser
     *
     * @return boolean 
     */
    public function getStateUser()
    {
        return $this->stateUser;
    }

    /**
     * Set registrationUser
     *
     * @param \DateTime $registrationUser
     * @return CmsUser
     */
    public function setRegistrationUser($registrationUser)
    {
        $this->registrationUser = $registrationUser;
    
        return $this;
    }

    /**
     * Get registrationUser
     *
     * @return \DateTime 
     */
    public function getRegistrationUser()
    {
        return $this->registrationUser;
    }

    /**
     * Set modificationDateUser
     *
     * @param \DateTime $modificationDateUser
     * @return CmsUser
     */
    public function setModificationDateUser($modificationDateUser)
    {
        $this->modificationDateUser = $modificationDateUser;
    
        return $this;
    }

    /**
     * Get modificationDateUser
     *
     * @return \DateTime 
     */
    public function getModificationDateUser()
    {
        return $this->modificationDateUser;
    }

    /**
     * Set typeDocuUser
     *
     * @param web\Entity\CmsTipoDocumento $typeDocuUser
     * @return CmsUser
     */
    public function setTypeDocuUser(\web\Entity\CmsTipoDocumento $typeDocuUser = null)
    {
        $this->typeDocuUser = $typeDocuUser;
    
        return $this;
    }

    /**
     * Get typeDocuUser
     *
     * @return web\Entity\CmsTipoDocumento 
     */
    public function getTypeDocuUser()
    {
        return $this->typeDocuUser;
    }
}