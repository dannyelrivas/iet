<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estado extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_estado');
    }
    
    /*
     * Retorna una lista en formato JSON que puede ser usada
     * para el plugin autocomplete de jQuery.
     */
    public function get_autocomplete()
    {
        $term = $_GET['term'];
        $estados = $this->m_estado->get_by_nombre( $term );
        
        //Se acomoda el array de tal forma que sea legible por el autocomplete de jQuery
        foreach( $estados as $e ){
            $nombre = $e->nombre;
            $e->value = $nombre;
            unset( $e->nombre );
        }
        
        echo json_encode($estados);
    }
}