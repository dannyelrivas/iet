<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_template {
    
    /*
     * Lee una $plantilla en HTML y reemplaza todos los $tokens
     * en formato {ETIQUETA} por su valor correspondiente.
     * Retorna una cadena HTML con los valores reemplazados
     */
    function procesar($plantilla, $tokens)
    {
        $template = file_get_contents( $plantilla );
        
        $pattern = '{%s}';

        $map = array();
        foreach($tokens as $var => $value)
        {
            $map[sprintf($pattern, $var)] = $value;
        }

        $output = strtr($template, $map);
        
        return $output;
        
    }

}