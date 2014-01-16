<?php
/**
 * An application resource for initializing your Doctrine2 environment
 *
 * @category   Zend
 * @package    LoSo_Zend_Auth
 * @subpackage Adapter
 * @author     LoÃ¯c Frering <loic.frering@gmail.com>
 */
class Tonyprr_Auth_Adapter_Doctrine implements Zend_Auth_Adapter_Interface
{
    /**
     * Doctrine EntityManager
     *
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * The entity name to check for an identity.
     *
     * @var string
     */
    protected $entityName;

    /**
     * Field to be used as identity.
     *
     * @var string
     */
    protected $identityField;

    /**
     * The field to be used as credential.
     *
     * @var string
     */
    protected $credentialField;

    /**
     *
     * @var mixed 
     */
    protected $_resultRow;
    
    /**
     *
     * @var array 
     */
    protected $_validations;

    /**
     * Constructor sets configuration options.
     *
     * @param  Doctrine\ORM\EntiyManager
     * @param  string
     * @param  string
     * @param  string
     * @return void
     */
    public function __construct($em, $entityName = null, $identityField = null, $credentialField = null)
    {
        $this->em = $em;

        if (null !== $entityName) {
            $this->setEntityName($entityName);
        }

        if (null !== $identityField) {
            $this->setIdentityField($identityField);
        }

        if (null !== $credentialField) {
            $this->setCredentialField($credentialField);
        }
    }

    /**
     * Set entity name.
     *
     * @param  string
     * @return Tonyprr_Auth_Adapter_Doctrine
     */
    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;
        return $this;
    }

    /**
     * Set identity field.
     *
     * @param  string
     * @return Tonyprr_Auth_Adapter_Doctrine
     */
    public function setIdentityField($identityField)
    {
        $this->identityField = $identityField;
        return $this;
    }

    /**
     * Set credential field.
     *
     * @param  string
     * @return Tonyprr_Auth_Adapter_Doctrine
     */
    public function setCredentialField($credentialField)
    {
        $this->credentialField = $credentialField;
        return $this;
    }

    /**
     * Set the value to be used as identity.
     *
     * @param  string
     * @return Tonyprr_Auth_Adapter_Doctrine
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * Set the value to be used as credential.
     *
     * @param  string
     * @return Tonyprr_Auth_Adapter_Doctrine
     */
    public function setCredential($credential)
    {
        $this->credential = $credential;
        return $this;
    }

    /**
     *
     */
    public function getResultRowObject()
    {
        return $this->_resultRow;
    }
    
    
    /**
     * Permite agregar condiciones de validación.
     *
     * @param  array
     * @return void
     */
    public function setConditionsFields(array $validations)
    {
        $this->_validations = $validations;
        return $this;
    }
    
    /**
     *
     * @return boolean 
     */
    protected function _validateConditions() {
        $esValido = true;
//        var_dump($this->_resultRow);
        if (!empty ($this->_validations)) {
            foreach ($this->_validations as $field => $value) {
                if ($this->_resultRow[$field] != $value) {
                    $esValido = false;
                }
            }
            return $esValido;
        } else {
            return true;
        }
    }


    /**
     * Defined by Zend_Auth_Adapter_Interface.  This method is called to
     * attempt an authentication.  Previous to this call, this adapter would have already
     * been configured with all necessary information to successfully connect to a database
     * table and attempt to find a record matching the provided identity.
     *
     * @throws Zend_Auth_Adapter_Exception if answering the authentication query is impossible
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
        $this->_authenticateSetup();
        $query = $this->_getQuery();

        $authResult = array(
            'code'     => Zend_Auth_Result::FAILURE,
            'identity' => null,
            'messages' => array()
        );

        try {
//            $result = $query->execute(array(1 => $this->identity));
            $result = $query->getArrayResult();

            $resultCount = count($result);
            if ($resultCount > 1) {
                $authResult['code'] = Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS;
                $authResult['messages'][] = 'Hay más de un registro que tienen la misma identidad.';
            } else if ($resultCount < 1) {
                $authResult['code'] = Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND;
                $authResult['messages'][] = 'El registro de usuario no existe.';
            } else if (1 == $resultCount) {
//                echo 'mierdaaaaaaaa';
                $this->_resultRow = $result[0];
//                print_r($result);
//                exit;
//                if ($result[0]->$this->credentialField != $this->credential) {
                if ($result[0][$this->credentialField] != $this->credential) {
                    $authResult['code'] = Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID;
                    $authResult['messages'][] = 'Su clave no es válida.';
                    $this->_resultRow = null;
                } else if (!$this->_validateConditions()) {
                    $authResult['code'] = Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID;
                    $authResult['messages'][] = 'El usuario ya no esta habilitado.';
                    $this->_resultRow = null;
                } else {
                    $authResult['code'] = Zend_Auth_Result::SUCCESS;
                    $authResult['identity'] = $this->identity;
                    $authResult['messages'][] = 'Autentificación exitosa.';
                }
            }
        } catch (\Doctrine\ORM\Query\QueryException $qe) {
            $authResult['code'] = Zend_Auth_Result::FAILURE_UNCATEGORIZED;
            $authResult['messages'][] = $qe->getMessage();
        }

        return new Zend_Auth_Result(
            $authResult['code'],
            $authResult['identity'],
            $authResult['messages']
        );
    }

    /**
     * This method abstracts the steps involved with
     * making sure that this adapter was indeed setup properly with all
     * required pieces of information.
     *
     * @throws Zend_Auth_Adapter_Exception - in the event that setup was not done properly
     */
    protected function _authenticateSetup()
    {
        $exception = null;

        if (null === $this->em || !$this->em instanceof \Doctrine\ORM\EntityManager) {
            $exception = 'A Doctrine2 EntityManager must be supplied for the Zend_Auth_Adapter_Doctrine2 authentication adapter.';
        } elseif (empty($this->identityField)) {
            $exception = 'An identity field must be supplied for the Zend_Auth_Adapter_Doctrine2 authentication adapter.';
        } elseif (empty($this->credentialField)) {
            $exception = 'A credential field must be supplied for the Zend_Auth_Adapter_Doctrine2 authentication adapter.';
        } elseif (empty($this->identity)) {
            $exception = 'A value for the identity was not provided prior to authentication with Zend_Auth_Adapter_Doctrine2.';
        } elseif (empty($this->credential)) {
            $exception = 'A credential value was not provided prior to authentication with Zend_Auth_Adapter_Doctrine2.';
        }

        if (null !== $exception) {
            /**
             * @see Zend_Auth_Adapter_Exception
             */
            throw new Zend_Auth_Adapter_Exception($exception);
        }
    }

    /**
     * Construct the Doctrine query.
     *
     * @return Doctrine\ORM\Query
     */
    protected function _getQuery()
    {
        $qb = $this->em->createQueryBuilder()
            ->select( 'e')//'e.' . $this->credentialField . , 
            ->from($this->entityName, 'e')
//            ->where('e.' . $this->identityField . ' = ?1');
            ->where('e.' . $this->identityField . ' = :' . $this->identityField )->setParameter($this->identityField, $this->identity);

        return $qb->getQuery();
    }
}
