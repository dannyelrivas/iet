<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_empresa extends CI_Model{
    
    function add( $empresa )
    {
        $this->db->insert('Empresa', $empresa); 
        return $this->db->insert_id();
    }
    
    public function get( $id )
    {
        $q = $this->db->get_where( 'Empresa', array('id' => $id) );
        return $q->row();
    }
    
    public function update($data, $id)
    {
        $this->db->update( 'Empresa', $data, array('id'=>$id) );
    }
    
    public function del($id)
    {
        $this->db->delete( 'Empresa', array('id' => $id) ); 
    }
    
    public function getAll()
    {
        $q = $this->db->order_by( 'nombre', 'asc' );
        $q = $this->db->get( 'Empresa' );
        return $q->result();
    }
    
}