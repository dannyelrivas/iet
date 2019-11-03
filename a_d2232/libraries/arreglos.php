<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arreglos {

    /*
    * Ordena un array muldimensional en orden descendente
    */
    function multiArsort (&$array, $key = 'date') {
                        
        $sorter = array();
        $ret = array();
        reset($array);

        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }
        
        //cambiar la funcion por asort si se quiere en orden ascendente
        arsort($sorter);

        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }

        $array = $ret;

        return $array;
    }
    
    /*
     * Tras enviar un formulario serializado con jQuery y convertirlo a array en php
     * este se contamina agregando ';' a los nombres de los indices del arreglo.
     * Esta funcion limpia las llaves.
     * $a es el array serializado.
     */
    function repararSerialized($s)
    {
        parse_str($s, $a);
        
        foreach($a as $k => $v){
            
            if( strstr($k, ';') ){
                $nk = str_replace(';', '', $k);
                $a[$nk] = $v;
                unset($a[$k]);
            }
        }
        
        return $a;
    }
    
}

