<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_ciudad extends CI_Model{
    
    public function get_by_nombre($term)
    {
        $q = $this->db->like('nombre', $term);
        $q = $this->db->order_by('nombre', 'asc');
        $q = $this->db->get('Ciudad');
        
        return $q->result();
    }
    
}