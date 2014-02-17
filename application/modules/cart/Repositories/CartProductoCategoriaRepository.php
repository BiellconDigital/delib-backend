<?php

namespace cart\Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * CartProductoCategoriaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CartProductoCategoriaRepository extends EntityRepository
{
    public function listRecords($catePadre, $oLanguage, $estado="TODOS", $pageStart=NULL, $pageLimit=NULL) {
        $count= 0;
        if(!$oLanguage instanceof \web\Entity\CmsLanguage)
            $oLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findOneByidLanguage($oLanguage);
        
        if ($catePadre != NULL) {
            $oProductoCategoria = $this->find($catePadre );
            if(!($oProductoCategoria instanceof \cart\Entity\CartProductoCategoria)) {
                throw new \Exception('No existe la categoria del producto.', 1);
            }
        }

        $qbProductoCategoria = $this->_em->createQueryBuilder();
        $qbProductoCategoria->select(
                    '
                    pc.idcontcate, pc.nivelCate, pc.imagenCate, pc.ordenCate, pc.stateCate,
                    pcl.descripcion, pcl.detalle
                    '
                    )->from($this->_entityName,'pc')->innerJoin('pc.languages','pcl')->where('pc.nivelCate > 0')
                    ->andWhere("pcl.language = :lang")->setParameter('lang', $oLanguage)
                   ->orderBy('pc.ordenCate','ASC');
        if ($catePadre != NULL) $qbProductoCategoria->andWhere('pc.contcatePadre = :categoria')->setParameter('categoria', $oProductoCategoria);
        if ($estado != "TODOS") $qbProductoCategoria->andWhere('pc.stateCate = :estado')->setParameter('estado', $estado);
        $qyProductoCategoria = $qbProductoCategoria->getQuery();
        
        if ($pageStart!= NULL and $pageLimit!=NULL) {
            $count = Paginate::getTotalQueryResults($qyProductoCategoria);
            $qyProductoCategoria->setFirstResult($pageStart)->setMaxResults($pageLimit);
        }
        $aProductoCategoria = $qyProductoCategoria->getArrayResult();
        $objRecords = \Tonyprr_lib_Records::getInstance();
        $objRecords->normalizeRecord($aProductoCategoria);
        
        return $aProductoCategoria;
    }
    
    public function getTree($idcatpadre = 1, $language=1, $todos = false) {
        $this->oTree['str'] = '';
        $this->generateTree($idcatpadre, $language, $todos);
        $this->oTree['str'] = "[".$this->oTree['str']."]";
        return $this->oTree;
    }
    
    private function generateTree($idcatpadre, $language, $todos, $profundidad = 0) {
//        header("Content-Type: text/html; charset=ISO-8859-1");
        try {
            $oCategoriaPadre = $this->find( $idcatpadre );
            
            $qbProdCate = $this->_em->createQueryBuilder();
            $qbProdCate->select('ps')->from($this->_entityName,'ps')->andWhere('ps.nivelCate > 0')
                       ->andWhere('ps.contcatePadre = :padre')
                       ->setParameter('padre', $oCategoriaPadre)->orderBy('ps.ordenCate','ASC');
            if (!$todos) $qbProdCate->andWhere('ps.stateCate = :stateCate')->setParameter('stateCate', 1);
//            if ($oProdCategoriacontcatePadre == NULL) $qbProdCate->andWhere('ps.contcatePadre IS NULL');
//            else $qbProdCate->andWhere('ps.contcatePadre = :ocontcatePadre')->setParameter('ocontcatePadre', $oProdCategoriacontcatePadre);
            $qyProductoCategoria = $qbProdCate->getQuery();
            $aProductoCategoria = $qyProductoCategoria->getResult();
            
            $totalItems = count($aProductoCategoria);
            $cont=1;
            if ($totalItems > 0 ) {
                foreach ($aProductoCategoria as $oProdCategoria) {
                    if (!$oProdCategoria instanceof \cart\Entity\CartProductoCategoria)
                        throw new Exception("No existe categoria dentro del arbol.",2);
                    
//                    $oProdCategoria = new CmsProductoCategoria();
//                    $dqlTotalHijos = "SELECT COUNT(ps.idcontcate) from CmsProductoCategoria ps 
//                                    WHERE ps.tipo = :tipo AND ps.contcatePadre = :contcatePadre AND ps.stateCate=1 ORDER BY ps.ordenCate ASC";
//                    if (!$todos) {$dqlTotalHijos .= ""; }
//                    $qyTotalHijos = $this->_em->createQuery($dqlTotalHijos);
//                    $qyTotalHijos->setParameter("tipo", $idcatpadre)->setParameter("contcatePadre", $oProdCategoria);//->getidcontcate()
//                    $iTotalHijos = $qyTotalHijos->getSingleScalarResult();

                    $qbProdCate2 = $this->_em->createQueryBuilder();
                    $qbProdCate2->select('COUNT(ps.idcontcate)')->from('\cart\Entity\CartProductoCategoria','ps')->andWhere('ps.nivelCate > 0');
                    if (!$todos) $qbProdCate2->andWhere('ps.stateCate = :stateCate')->setParameter('stateCate', 1);
                    $qbProdCate2->andWhere('ps.contcatePadre = :padre')->setParameter('padre', $oProdCategoria);
                    $qyProductoCategoria2 = $qbProdCate2->getQuery();
                    $iTotalHijos = $qyProductoCategoria2->getSingleScalarResult();
                    
                    $idsToFilter = array($language);
                    $descrip = $oProdCategoria->getLanguages()->filter(
                                function($oProdCateLang) use ($idsToFilter) {
                                    return in_array($oProdCateLang->getLanguage()->getIdLanguage(), $idsToFilter);
                                }
                        )->first()->getDescripcion();
                    $this->oTree['str'].="{ nameCate:'". $descrip ."',stateCate:".( ($oProdCategoria->getStateCate())?1:0 ).",text:'".  $descrip ."',idcontcate:".$oProdCategoria->getIdcontcate().",nivelCate:".$oProdCategoria->getNivelCate();
                    if($oProdCategoria->getNivelCate() > 2) $css_menu="subsubmenu";
                    else $css_menu="submenu";

                    if($iTotalHijos>0) $this->oTree['str'].=",cls: 'filaGridC',children: [";
                    else $this->oTree['str'].=",leaf: true,cls:'filaGridC'},";
                    $this->generateTree($oProdCategoria->getIdcontcate(), $language, $todos, $profundidad + 1);//->getidcontcate()
                    if($iTotalHijos>0) $this->oTree['str'].= "]},";
                    if ($totalItems == $cont) $this->oTree['str'] = substr($this->oTree['str'], 0, -1);
                    $cont++;
                }
            }
        } catch(\Exception $e) {
            throw new \Exception("Error al generar Menu.".$e->getMessage());
        }
    }
    
    
    /**
     *
     * @param int $id
     * @param boolean $asArray
     * @param boolean $soloActivo
     * @return \web\Entity\CmsContent $oProductoCategoria
     */
    public function getById($id, $language=null, $asArray=true, $soloActivo=false) {
        $oProductoCategoriaLang = null;
        try {
            if ($asArray) {
                $qbProductoCategoria = $this->_em->createQueryBuilder();
                $qbProductoCategoria->select(
                            '
                            pc.idcontcate, pc.nivelCate, pc.imagenCate, pc.ordenCate, pc.stateCate,
                            pcp.idcontcate as idcontcatePadre
                            '
                            )->from($this->_entityName,'pc')->distinct()//, pcpl.descripcion as nombre_padre
                            ->innerJoin('pc.contcatePadre','pcp')
//                            ->innerJoin('pcp.languages','pcpl')
//                            ->andWhere("pcpl.language = :lang")->setParameter('lang', $language)
                            ->andWhere("pc.idcontcate = :id")->setParameter('id', $id);
                if ($soloActivo) $qbProductoCategoria->andWhere('pc.stateCate = :estado')->setParameter('estado', 1);
                $qyProductoCategoria = $qbProductoCategoria->getQuery();
                $oProductoCategoria = $qyProductoCategoria->getArrayResult();
                $objRecords = \Tonyprr_lib_Records::getInstance();
                if (count($oProductoCategoria) != 1)
                    throw new \Exception('No existe este registro o no se encuentra disponible.',1);
                $objRecords->normalizeRecord($oProductoCategoria[0]);
                $oProductoCategoria = $oProductoCategoria[0];
            } else {
                $dqlList = 'SELECT pc FROM \cart\Entity\CartProductoCategoria pc WHERE pc.idcontcate = ?1';
                $qyContent = $this->_em->createQuery($dqlList);
                $qyContent->setParameter(1,$id);
                if($soloActivo) {
                    $dqlList .= ' AND  pc.stateCate = 1';
                }
                try {
                    $oProductoCategoria = $qyContent->getSingleResult();
                    $idsToFilter = array($language);
                    $oProductoCategoriaLang = $oProductoCategoria->getLanguages()->filter(
                            function($oProductoCategoriaLang) use ($idsToFilter) {
                                return in_array($oProductoCategoriaLang->getLanguage(), $idsToFilter);
                            })->first();
                    
                } catch(\Doctrine\ORM\NoResultException $e) {
                    throw new \Exception('No existe este registro o no se encuentra disponible.',1);
                }
            }
            return array($oProductoCategoria, $oProductoCategoriaLang);
        } catch(\Exception $e) {
            if ($e->getCode() == 1) throw new \Exception($e->getMessage(),1);
            else throw new \Exception('Ocurrió un error en el procesamiento, estaremos solucionandolo en breve. ' . $e->getMessage(), 1);
        }
        
    }
    
    
    public function getTreeHtml($idcatpadre = 1, $oLanguage=1, $todos = false) {
        $this->oTree['strHtml'] = '';
        $helBaseUrl = new \Zend_View_Helper_BaseUrl();
        $oCategoriaPadre = $this->find( $idcatpadre );
        if(!$oLanguage instanceof \web\Entity\CmsLanguage)
            $oLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findOneByidLanguage($oLanguage);
        
        $this->generateTreeHtml($oCategoriaPadre, $oLanguage, $todos, $helBaseUrl->baseUrl() . '/' . 'productos' , 0);
        $this->oTree['strHtml'] = '<ul class="topnav">' .$this->oTree['strHtml'] . '</ul>';
        return $this->oTree;
    }
    
    private function generateTreeHtml($oCategoriaPadre, $oLanguage, $todos, $url, $profundidad = 0) {
        try {
            
            $qbProdCate = $this->_em->createQueryBuilder();
            $qbProdCate->select('ps')->from($this->_entityName,'ps')->andWhere('ps.nivelCate > 0')
                       ->andWhere('ps.contcatePadre = :padre')
                       ->setParameter('padre', $oCategoriaPadre)->orderBy('ps.ordenCate','ASC');
            if (!$todos) $qbProdCate->andWhere('ps.stateCate = :stateCate')->setParameter('stateCate', 1);
//            if ($oProdCategoriacontcatePadre == NULL) $qbProdCate->andWhere('ps.contcatePadre IS NULL');
//            else $qbProdCate->andWhere('ps.contcatePadre = :ocontcatePadre')->setParameter('ocontcatePadre', $oProdCategoriacontcatePadre);
            $qyProductoCategoria = $qbProdCate->getQuery();
            $aProductoCategoria = $qyProductoCategoria->getResult();
            
            $totalItems = count($aProductoCategoria);
            $cont=1;
            if ($totalItems > 0 ) {
                foreach ($aProductoCategoria as $oProdCategoria) {
                    if (!$oProdCategoria instanceof \cart\Entity\CartProductoCategoria)
                        throw new Exception("No existe categoria dentro del arbol.",2);

                    $qbProdCate2 = $this->_em->createQueryBuilder();
                    $qbProdCate2->select('COUNT(ps.idcontcate)')->from('\cart\Entity\CartProductoCategoria','ps')->andWhere('ps.nivelCate > 0');
                    if (!$todos) $qbProdCate2->andWhere('ps.stateCate = :stateCate')->setParameter('stateCate', 1);
                    $qbProdCate2->andWhere('ps.contcatePadre = :padre')->setParameter('padre', $oProdCategoria);
                    $qyProductoCategoria2 = $qbProdCate2->getQuery();
                    $iTotalHijos = $qyProductoCategoria2->getSingleScalarResult();
                    
                    if($oProdCategoria->getNivelCate() == 1) {
                        $css_menu=''; $adicional = '';
                        $urlLink = '#';
                    } else {
                        $css_menu="";$adicional = '';
//                            $urlLink = $url . '/index/idlinea/' . $oProdServ->getIdProductoServLinea();
                        $urlLink = "#";
                    }
//                    $cssDesplegable = ($iTotalHijos>0)?'class="desplegable"':'';
                    $textIdent = "";
                    if($iTotalHijos == 0) {
                        $functionLink = ' onclick="loadProductos(' . $oProdCategoria ->getIdcontcate() . ')"';
                        if ($oProdCategoria->getNivelCate() <= 1)
                            $textIdent = "";
                    }
                    else {
                        $functionLink = ' onclick="loadCategorias(' . $oProdCategoria ->getIdcontcate() . ')"';
                    }

                    
                    $idsToFilter = array($oLanguage);
                    $descripcionCate = $oProdCategoria->getLanguages()->filter(
                                function($oProdCateLang) use ($idsToFilter) {
                                    return in_array($oProdCateLang->getLanguage(), $idsToFilter);
                                }
                        )->first()->getDescripcion();
                        

                    if($iTotalHijos>0) {
                        $this->oTree['strHtml'].= '<li ' . $css_menu . '><a href="' . $urlLink . '"  ' . $functionLink . '><div id="divIcoMenuVert">' . $textIdent . '</div>' . $descripcionCate . $adicional . '</a>';
                        $this->oTree['strHtml'].= '<ul>';
                    }
                    else {
                            $this->oTree['strHtml'].= '<li ' . $css_menu . '><a href="' . $urlLink . '"  ' . $functionLink . '><div id="divIcoMenuVert">' . $textIdent . '</div>' . $descripcionCate . $adicional . '</a><ul><li></li></ul></li>';
                    }
                    $this->generateTreeHtml($oProdCategoria, $oLanguage, $todos, $url, $profundidad + 1);//->getIdProductoServLinea()
                    if($iTotalHijos>0) $this->oTree['strHtml'].= "</ul></li>";
                    $cont++;
                }
            }
        } catch(\Exception $e) {
            throw new \Exception("Error al generar Menu. " . $e->getMessage());
        }
    }

    
    public function getTreeRouteHtml($idcatpadre = null, $idprod = null, $oLanguage=1, $todos = false) {
        $this->rutaHtml = '';
        $helBaseUrl = new \Zend_View_Helper_BaseUrl();
        if(!$oLanguage instanceof \web\Entity\CmsLanguage)
            $oLanguage = $this->_em->getRepository("\web\Entity\CmsLanguage")->findOneByidLanguage($oLanguage);
        
        if (!is_null($idcatpadre))
            $oCategoriaPadre = $this->find( $idcatpadre );
        else if (!is_null($idprod)) {
            $oProducto = $this->_em->getRepository("\cart\Entity\CartProducto")->find($idprod);
            $oCategoriaPadre = $oProducto->getContcate();
        }
        
        $this->generateTreeRouteHtml($oCategoriaPadre, $oLanguage, $todos, $helBaseUrl->baseUrl() . '/' . 'productos' , 0);
//        $this->oTree['strHtml'] = $this->oTree['strHtml'];  
        krsort($this->rutaHtml);
        if (!is_null($idprod)) {
            $idsToFilter = array($oLanguage);
            $descripcionProd = $oProducto->getLanguages()->filter(
                        function($oProdLang) use ($idsToFilter) {
                            return in_array($oProdLang->getLanguage(), $idsToFilter);
                        }
                )->first()->getNombre();
            $this->rutaHtml[] = $descripcionProd;
        }
        $strResult = implode(" / ", $this->rutaHtml);
        return " / " . $strResult;
    }
    
    private function generateTreeRouteHtml(\cart\Entity\CartProductoCategoria $oCategoria, $oLanguage, $todos, $url, $profundidad = 0) {
        try {
            if (!($oCategoria->getIdcontcate() == 1)) {
                $idsToFilter = array($oLanguage);
                $descripcionCate = $oCategoria->getLanguages()->filter(
                            function($oProdCateLang) use ($idsToFilter) {
                                return in_array($oProdCateLang->getLanguage(), $idsToFilter);
                            }
                    )->first()->getDescripcion();

                $qbProdCate2 = $this->_em->createQueryBuilder();
                $qbProdCate2->select('COUNT(ps.idcontcate)')->from('\cart\Entity\CartProductoCategoria','ps')->andWhere('ps.nivelCate > 0');
//                    if (!$todos) $qbProdCate2->andWhere('ps.stateCate = :stateCate')->setParameter('stateCate', 1);
                $qbProdCate2->andWhere('ps.contcatePadre = :padre')->setParameter('padre', $oCategoria);
                $qyProductoCategoria2 = $qbProdCate2->getQuery();
                $iTotalHijos = $qyProductoCategoria2->getSingleScalarResult();

                if($iTotalHijos == 0)  $functionLink = ' onclick="loadProductos(' . $oCategoria ->getIdcontcate() . ')"';
                else $functionLink = ' onclick="loadCategorias(' . $oCategoria ->getIdcontcate() . ')"';
                    
                $this->rutaHtml[] = '<span class="text_href2" ' . $functionLink . '>' . $descripcionCate . '</span>';// 

                $this->generateTreeRouteHtml($oCategoria->getContcatePadre(), $oLanguage, $todos, $url, $profundidad + 1);
            }
        } catch(\Exception $e) {
            throw new \Exception("Error al generar ruta. " . $e->getMessage());
        }
    }
    
    
    public function delete($idRegistro, $pathProdCategoria) {
        try {
//            $oProducto = new CartProductoCategoria();
            $oProductoCategoria = $this->_em->find($this->_entityName, $idRegistro);
            if(!$oProductoCategoria) 
                throw new \Exception("No exite la Categoria del Producto con el ID ".$idRegistro .".",2);
            
            @unlink($pathProdCategoria . trim($oProductoCategoria->getImagenCate()));
            $this->deleteRecursive($oProductoCategoria, $pathProdCategoria, 0);
            
            /*Eliminar archivos de su galeria*/
//            if ((sizeof($oProducto->getGaleria()) > 0) ) {
//                foreach ($oProducto->getGaleria() as $oFotoGale) {
//                    @unlink($this->_pathProducto . trim($oFotoGale->getImagenGale()) );
//                }
//            }
            
            $dqlList = 'DELETE \cart\Entity\CartProductoCategoria pg WHERE pg.idcontcate = ?1';
            $qyProducto = $this->_em->createQuery($dqlList);
            $qyProducto->setParameter(1, $idRegistro);
            $result = $qyProducto->execute();
            $this->_em->persist($oProductoCategoria);
            $this->_em->flush();
        } catch(\Exception $e) {
            throw new \Exception("Error en el proceso de eliminar la Categoria del Producto.", 1);
        }
    }
    
    
    
    public function deleteRecursive($oCategoriaPadre, $pathProdCategoria, $profundidad = 0) {
        try {
            $qbProdCate = $this->_em->createQueryBuilder();
            $qbProdCate->select('ps')->from($this->_entity,'ps')
                       ->andWhere('ps.contcatePadre = :padre')
                       ->setParameter('padre', $oCategoriaPadre)->orderBy('ps.ordenCate','ASC');
            $qyProductoCategoria = $qbProdCate->getQuery();
            $aProductoCategoria = $qyProductoCategoria->getResult();
            
            $totalItems = count($aProductoCategoria);
            $cont=1;
            if ($totalItems > 0 ) {
                foreach ($aProductoCategoria as $oProdCategoria) {
                    if (!$oProdCategoria instanceof $this->_entityName)
                        throw new Exception("No existe categoria dentro del arbol.",2);
                    @unlink($pathProdCategoria . trim($oProdCategoria->getImagenCate()));

                    $qbProducto = $this->_em->createQueryBuilder();
                    $qbProducto->select('p')->from('\cart\Entity\CartProducto','p')
                                ->andWhere('p.contcate = :categoria')->setParameter('categoria', $oProdCategoria);
                    $qyProducto = $qbProducto->getQuery();
                    $aProductos = $qyProducto->getResult();
                    if (count($aProductos) > 0) {
                        foreach ($aProductos as $aProducto) {
                            @unlink($pathProdCategoria . trim($aProducto->getImagen()));
                            @unlink($pathProdCategoria . trim($aProducto->getAdjunto()));
                        }
                    }
                    $this->deleteRecursive($oProdCategoria, $pathProdCategoria, $profundidad + 1);
                    $cont++;
                }
            }
        } catch(\Exception $e) {
            throw new \Exception("Error al borrar categorias. " . $e->getMessage());
        }
    }
    
}
