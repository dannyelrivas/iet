<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formulario{
    
    /*
     * Retorna un array que puede ser utilizado para generar un
     * dropdown en base a un $modelo.
     * 
     * $key y $value son los parametros requeridos por la funcion form_dropdown() de CI.
     */
    public function dropdown_gen( $modelo, $key, $value )
    {
        $CI =& get_instance();
        
        $CI->load->model($modelo);
        
        $array_res = array();
        
        $items = $CI->$modelo->getAll();
        
        foreach ($items as $i) {
            $array_res[$i->$key] = $i->$value;
        }
        
        return $array_res;
    }
    
    /*
     * Retorna una tabla con el encabezado segun el array $encabezado y el $id indicado
     */
    public function tabla_enc($encabezado, $id)
    {
        $CI =& get_instance();
        
        $CI->load->library( 'table' );
        
        $CI->table->set_heading( $encabezado );
        $tmpl = array ( 'table_open'  => '<table id="'.$id.'">' );
        $CI->table->set_template($tmpl);
        
        return $CI->table->generate();
    }
    
}