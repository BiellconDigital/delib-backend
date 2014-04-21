<?php
/**
 * Description of Tonyprr_Thumb
 *
 * @author Antonio
 */
class Tonyprr_Thumb {
/*FUNCION PARA OBTENER UNA IMAGEN ESCALADA*/
    function thumbjpeg ($imagen,$anchura,$altura,$prefijo,$ratio="") {
        $dir_thumb = "";
        $prefijo_thumb = $prefijo;
        $camino_nombre=explode(DIRECTORY_SEPARATOR,$imagen);
        $nombre=end($camino_nombre);
        $camino=substr($imagen,0,strlen($imagen)-strlen($nombre));
        $retorno=false;
        if (!file_exists($camino.$dir_thumb))
            mkdir ($camino.$dir_thumb, 0777);// or die("<BR>PROBLEMAS CON EL DIRECTORIO $dir_thumb")
//        if (!file_exists($camino.$dir_thumb.$prefijo_thumb.$nombre)) {
            $img = imagecreatefromjpeg($imagen);// or die("<BR>No se encuentra la imagen $camino$nombre")
            $datos = getimagesize($imagen);// or die("<BR>PROBLEMAS CON $camino$nombre")
            if($anchura!="" and $altura!="" and $ratio!="") {
                $anchura = ($datos[0] / $ratio);
                $altura = ($datos[1] / $ratio);
            }
            else if($anchura!="" and $altura=="") {
                if($datos[0]!=$anchura) {
                    $ratio=$anchura/$datos[0];
                    $altura=$datos[1]*$ratio;
                }
            }
            else if($anchura=="" and $altura!="") {
                if($datos[1]!=$altura) {
                    $ratio=$altura/$datos[1];
                    $anchura=$datos[0]*$ratio;
                }
            }
            $thumb = imagecreatetruecolor($anchura,$altura);
            imagecopyresampled ($thumb, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);
            $retorno=imagejpeg($thumb, $camino.$dir_thumb.$prefijo_thumb.$nombre);
//        }
        return $retorno;
    //	return array($retorno,$camino.$dir_thumb.$prefijo_thumb.$nombre);
    }

    /*
     * Redimensiona una imagen a una altura o anchura maxima si la imagen sobrepasa los limites
     */
    function thumbjpeg_replace($imagen_name,$anchura_max=1020,$altura_max=520) {
        $retorno=false;
        $datos = getimagesize($imagen_name);
        if($datos[0]>$anchura_max){
            $ratio = ($datos[0] / $anchura_max);
            $altura = ($datos[1] / $ratio);
            $img = imagecreatefromjpeg($imagen_name);
            $img_redim = imagecreatetruecolor($anchura_max,$altura);
            imagecopyresampled ($img_redim, $img, 0, 0, 0, 0, $anchura_max, $altura, $datos[0], $datos[1]);
            $retorno=imagejpeg($img_redim,$imagen_name);
        }
            $datos = getimagesize($imagen_name);
        if($datos[1]>$altura_max){
            $ratio = ($datos[1] / $altura_max);
            $anchura = ($datos[0] / $ratio);
            $img = imagecreatefromjpeg($imagen_name);
            $img_redim = imagecreatetruecolor($anchura,$altura_max);
            imagecopyresampled ($img_redim, $img, 0, 0, 0, 0, $anchura, $altura_max, $datos[0], $datos[1]);
            $retorno=imagejpeg($img_redim,$imagen_name);
        }
        return $retorno;
    }

    /*
     * Redimensiona una imagen a un tamaño fijo o a una ancho o altura determinada
     */
    function thumbjpeg_replace_fijo($imagen_name,$anchura="",$altura="") {
        $retorno=false;
        $datos = getimagesize($imagen_name);//anchura, altura
            if($anchura!="" and $altura==""){
                if($datos[0]!=$anchura){
                    $ratio=$anchura/$datos[0];
                    $altura=$datos[1]*$ratio;
                    $img = imagecreatefromjpeg($imagen_name);
                    $img_redim = imagecreatetruecolor($anchura,$altura);
                    imagecopyresampled ($img_redim, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);
                    $retorno=imagejpeg($img_redim,$imagen_name);
                }
            }
            else if($anchura=="" and $altura!=""){
                if($datos[1]!=$altura){
                    $ratio=$altura/$datos[1];
                    $anchura=$datos[0]*$ratio;
                    $img = imagecreatefromjpeg($imagen_name);
                    $img_redim = imagecreatetruecolor($anchura,$altura);
                    imagecopyresampled ($img_redim, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);
                    $retorno=imagejpeg($img_redim,$imagen_name);
                }
            }
            else if($anchura!="" and $altura!=""){
                if($datos[0]!=$anchura and $datos[1]!=$altura){
                        $img = imagecreatefromjpeg($imagen_name);
                        $img_redim = imagecreatetruecolor($anchura,$altura);
                        imagecopyresampled ($img_redim, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);
                        $retorno=imagejpeg($img_redim,$imagen_name);
                }
            }
        return $retorno;
    }

    function thumbjpeg_replace_fijo2($imagen_name,$anchura,$altura) {
        $retorno=false;
        $datos = getimagesize($imagen_name);
        if($datos[0]!=$anchura or $datos[1]!=$altura){
            $img = imagecreatefromjpeg($imagen_name);
            $img_redim = imagecreatetruecolor($anchura,$altura);
            imagecopyresampled ($img_redim, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);
    //		ImageDestroy($img);
    //		unlink($imagen_name);
            $retorno=imagejpeg($img_redim,$imagen_name);
        }
        return $retorno;
    }

}
?>
