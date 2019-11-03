<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_alumnos extends CI_Model{

	public function add($alumno)
    {
        $this->db->insert('alumnos', $alumno); 
        return $this->db->insert_id();
    }
    
    public function update($data, $id)
    {
        $this->db->update( 'alumnos', $data, array('id'=>$id) );
    }
    
    public function del($id)
    {
        $this->db->delete( 'alumnos', array('id' => $id) ); 
    }
    
    function get($id)
    {
        $q = $this->db->get_where('alumnos', array( 'id' => $id ) );
        return $q->row();
    }

    public function lista()
    {
    	$q = $this->db->order_by('id', 'desc');
    	$q = $this->db->get('alumnos');
        
        $alumnos = $q->result();
        return $alumnos;
    }

}