<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_usuario_tipo extends CI_Model{
    
    /*
     * Retorna el tipo de usuario segun el $id
     */
    function get($id)
    {
        $q = $this->db->get_where('UsuarioTipo', array('id' => $id));
        return $q->row();
    }
    
    function getAll()
    {
        $q = $this->db->order_by('id', 'asc');
        $q = $this->db->get('UsuarioTipo');
        return $q->result();
    }
    
    function get_by_tipo( $tipo )
    {
        $q = $this->db->get_where('UsuarioTipo', array('tipo' => $tipo));
        return $q->row();
    }
    
}