<?php

namespace cart\Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * CartProductoCategoriaLanguageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CartProductoCategoriaLanguageRepository extends EntityRepository
{
    public function listLanguage($oProductoCategoria, $isArray = true) {
        $oProductoCategoriaLanguage = array();
        if (!$oProductoCategoria instanceof \cart\Entity\CartProductoCategoria)
            $oProductoCategoria = $this->_em->find("\cart\Entity\CartProductoCategoria", $oProductoCategoria);
        if ($isArray) {
            $dqlList = "SELECT pl.idProductocateLanguage, pl.descripcion, pl.detalle
                        ,p.idcontcate, l.idLanguage, l.idioma 
                        from " . $this->_entityName . " pl 
                        INNER JOIN pl.language l INNER JOIN pl.contcate p 
                        WHERE pl.contcate = ?1 AND l.estado = 1";
            
            $qbProductoLanguage =$this->_em->createQuery($dqlList);
            $qbProductoLanguage->setParameter(1, $oProductoCategoria);
            $oProductoCategoriaLanguage = $qbProductoLanguage->getResult();
            $objRecords=  \Tonyprr_lib_Records::getInstance();
            $objRecords->normalizeRecords($oProductoCategoriaLanguage);
        } else {
            $oProductoCategoriaLanguage = $this->_em->getRepository($this->_entityName)->findOneBy(array("contcate"=>$oProductoCategoria));//createQuery($dqlList)
        }
        return $oProductoCategoriaLanguage;
    }
    
}
