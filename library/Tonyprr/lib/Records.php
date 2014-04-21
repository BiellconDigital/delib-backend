<?php

/**
 * Clase para manipulación de registros de datos
 *
 * @author Antonio Ramos
 */
class Tonyprr_lib_Records {
    
    /**
     * Variable para manipulacion de registros.
     * @var Tonyprr_lib_Records
     */
   private static $instancia; 
    
    /**
     * devuelve la instancia estatica de esta clase.
     *
     * @return Tonyprr_lib_Records
     */
   public static function getInstance() 
   { 
      if (  !self::$instancia instanceof self) 
      { 
         self::$instancia = new self; 
      } 
      return self::$instancia; 
   } 
    
    public static function normalizeRecord(&$record)
    {
        $contador=1;
        foreach ($record as $key => $value) {
            if (is_object($value)) {
                settype($value, 'array');
                foreach ($value as $k => $v) {
                    $record[$key]=$value[$k];
                    break;
                }
            }
            $contador++;
        }
        return $record;
    }

    public static function normalizeRecords(&$records)
    {
        if (count($records) > 0)
            foreach ($records as $num => $record)
            {
                foreach ($record as $key => $field)
                {
                    if (is_a($field,'DateTime'))
                    {
    //                    unset ($record[$key]);
                        $records[$num][$key]=$field->format("Y-m-d H:i:s");
                    }
                    else if(is_array($field)) {
                        $records[$num][$key]= ($field[$key]);
                    } else {
                        $records[$num][$key]= ($field);
                    }
                }
            }
        return $records;
    }
    
}
?>
