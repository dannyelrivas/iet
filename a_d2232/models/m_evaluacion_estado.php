<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_evaluacion_estado extends CI_Model{
    
    function get_by_estado( $estado )
    {
        $e = strtoupper($estado);
        
        $q = $this->db->get_where( 'EvaluacionEstado', array( 'estado'=>$e ) );
        
        return $q->row();
    }
    
    function get( $id )
    {
        $q = $this->db->get_where( 'EvaluacionEstado', array( 'id' => $id ) );
        
        return $q->row();
    }
    
}