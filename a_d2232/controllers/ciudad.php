<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ciudad extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_ciudad');
    }
    
    /*
     * Retorna una lista en formato JSON que puede ser usada
     * para el plugin autocomplete de jQuery.
     */
    public function get_autocomplete()
    {
        $term = $_GET['term'];
        $ciudades = $this->m_ciudad->get_by_nombre( $term );
        
        //Se acomoda el array de tal forma que sea legible por el autocomplete de jQuery
        foreach( $ciudades as $c ){
            $nombre = $c->nombre;
            $c->value = $nombre;
            unset($c->nombre);
        }
        
        echo json_encode($ciudades);
    }
    
}