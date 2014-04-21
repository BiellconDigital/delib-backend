<?php

/**
 * Serie de funciones para utilizar en un proyecto
 *
 * @author Antonio Ramos
 */
class Tonyprr_Functions {
    
//   private static $instancia; 
//    
//   public static function getInstance() 
//   { 
//      if (  !self::$instancia instanceof self) 
//      { 
//         self::$instancia = new self; 
//      } 
//      return self::$instancia; 
//   } 
    
    function getIPUsuario(){
     if ($_SERVER) {
        if ( isset ($_SERVER["HTTP_X_FORWARDED_FOR"]) ) {
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif ( isset ($_SERVER["HTTP_CLIENT_IP"]) ) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
     } else {
         if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
            $realip = getenv( 'HTTP_X_FORWARDED_FOR' );
         } elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
            $realip = getenv( 'HTTP_CLIENT_IP' );
         } else {
            $realip = getenv( 'REMOTE_ADDR' );
         }
     }
     return $realip;
    }

    function CompressURL($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://to.ly/api.php?longurl=".urlencode($url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $shorturl = curl_exec ($ch);
        curl_close ($ch);

        return $shorturl;
    }

//    function getNotCaracFiles(){
//        return array("+", "-","/","à","è","ì","ò","ù","À","È","Ì","Ò","Ù","á","�","í","ó","ú","Á","É","Í","Ó","Ú","ä","ë","ï","ö","ü","Ä","Ë","Ö","Ü","ñ","Ñ");
//    }

    function cortarParrafos($cadena,$numCarac=210){
        $cadena=substr($cadena,0,$numCarac);
        $pos=strrpos($cadena," ");
        if($pos!=false) $cadena=substr($cadena,0,$pos);
        return $cadena;
    }

    function fecha_format($fecha,$formato="Y-m-d")
    {
        if($fecha=="") return "";
        $fecha_int=strtotime($fecha);
        if($fecha_int==-1) return "";
        $fecha = date ($formato,$fecha_int);
        return $fecha;
    }

    function ffecha_Ymd($fecha)
    {
          $fecha_int=strtotime($fecha);
          $fecha = date ("Y-m-d",$fecha_int);
          return $fecha;
    }

    function ffecha_dmY($fecha)
    {
          $fecha_int=strtotime($fecha);
          $fecha = date ("d-m-Y",$fecha_int);
          return $fecha;

    }
    function de_dmy_ymd($fecha,$caracter,$caracter2)
    {
    $fecha1=explode($caracter,$fecha);
    return trim($fecha1[2].$caracter2.$fecha1[1].$caracter2.$fecha1[0]);
    }

    function getFechasIntervalo($str_fecha_ini,$str_fecha_fin,$excluir_sab=true,$excluir_dom=true){
        $fechaInicio=strtotime($str_fecha_ini);
        $fechaFin=strtotime($str_fecha_fin);
        for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
            if($excluir_sab)
                if(date("w", $i)==6)
                        continue;
            if($excluir_dom)
                if(date("w", $i)==0)
                        continue;
            $arrayFechas[date("d-m-Y", $i)]['nro_dia'] = date("w", $i);
    //        $arrayFechas[]['dia'] = date("l", $i);
        }
        return $arrayFechas;
    }

    function lastDay($fecha,$format="%Y-%m-%d")
    {
        list($mon,$year) = explode('-',$fecha);
        return strftime($format="%Y-%m-%d", mktime(0, 0, 0, $mon+1, 0, $year));
    }

    function firstDay($fecha,$format="%Y-%m-%d")
    {
        list($mon,$year) = explode('-',$fecha);
        return strftime($format="%Y-%m-%d", mktime(0, 0, 0, $mon, 1, $year));
    }

    function getListAnios($anio_limit,$num_anios,$as_json=false){
        $anio_ini=$anio_limit-$num_anios;
        if($as_json){
            foreach (range($anio_ini, $anio_limit) as $anio) {
                $arrAnios[]=array("anio"=>$anio,"name_anio"=>$anio);
            }
            return Zend_Json::encode($arrAnios);
        }
        else
            return range($anio_ini, $anio_limit);
    }

    function generar_id($num_carac,$num_id)
    {
        $id="P";
        $year=date("y");
        $id=$id.$year;

        $cant_cero=$num_carac-strlen($id.$num_id);
        for($i=1;$i<=$cant_cero;$i++)
        {
            $id=$id."0";
        }
        $id=$id.$num_id;
        return $id;
    }

    function lpad($num_carac,$cadena,$cadena_ini='',$carac_relleno='0')
    {
        $id=$cadena_ini;

        $cant_cero=$num_carac-strlen($id.$cadena);
        for($i=1;$i<=$cant_cero;$i++)
        {
            $id=$id.$carac_relleno;
        }
        $id=$id.$cadena;
        return $id;
    }

    function format_array($array)
    {
        $var='';
        $var=str_replace("[","",$array);
        $var=str_replace("]","",$var);
        return $var;
    }
    function limpiaTildesMayusculas($texto)
{
        $texto=str_replace("á",'a',$texto);
        $texto=str_replace("�",'e',$texto);
        $texto=str_replace("í",'i',$texto);
		$texto=str_replace("ó",'o',$texto);
        $texto=str_replace("Ñ",'n',$texto);
        $texto=str_replace("ñ",'n',$texto);
		$texto=str_replace("ú",'u',$texto);
        $texto=str_replace("É",'E',$texto);
		$texto=str_replace("Í",'I',$texto);
		$texto=str_replace("Ó",'O',$texto);
		$texto=str_replace("Ú",'U',$texto);
        $texto=str_replace("Á",'A',$texto);


	return $texto;
}

    function remove_accent($str)
    {
      $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', '�', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
      $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
      return str_replace($a, $b, $str);
    }

    function post_slug($str)
    {
      return strtolower(preg_replace(array('/[^a-zA-Z0-9 -.]/', '/[ -]+/', '/^-|-$/'),
      array('', '-', ''), $this->remove_accent($str)));
    }

    function getFechasIntervalo2($str_fecha_ini,$str_fecha_fin,$dia){
        
        $arrayFechas=array();
        $fechaInicio=strtotime($str_fecha_ini);
        $fechaFin=strtotime($str_fecha_fin);
        for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
                if($dia != date("w", $i) ){
                continue;
                }
                $arrayFechas[]=array("fecha"=>date("Y-m-d", $i),"dia"=>strftime("%d de %B", $i));
        }
        return $arrayFechas;
    }

    function lastDay2($fecha,$format="%Y-%m-%d")
    {
        list($year,$mon) = explode('-',$fecha);
        return strftime($format="%Y-%m-%d", mktime(0, 0, 0, $mon+1, 0, $year));
    }

    function firstDay2($fecha,$format="%Y-%m-%d")
    {
        list($year,$mon) = explode('-',$fecha);
        return strftime($format="%Y-%m-%d", mktime(0, 0, 0, $mon, 1, $year));
    }


function diferenciaMinutos($hora1,$hora2){
    $separar[1]=explode(':',$hora1);
    $separar[2]=explode(':',$hora2);

    $total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1];
    $total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1];
    $total_minutos_trasncurridos = $total_minutos_trasncurridos[1]-$total_minutos_trasncurridos[2];
    return $total_minutos_trasncurridos;
}



}
?>
