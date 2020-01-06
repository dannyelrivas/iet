<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_salidas extends CI_Model{
	
	public function todas_salidas($salon)
	{
		$q = $this->db->get_where( 'salida', array('salon' => $salon, 'status' => null) );
        return $q->result();
	}

	public function get($id)
	{
		$q = $this->db->get_where( 'salida', array('id' => $id) );
		return $q->row(); 
	}

	public function nueva($salida)
	{
		$this->db->insert('salida', $salida);
        return $this->db->insert_id();
	}

	public function existe($idalumno)
	{
		//$q = $this->db->get_where('salida', (array('idalumno' => $idalumno)));
		$q = $this->db->get_where('salida', (array('idalumno' => $idalumno,'status'=>null)));
		return $q->row();
	}

	public function dar_salida($id)
	{
		$this->db->update( 'salida', array('status' => true), array('id'=>$id) );
		return $this->db->affected_rows();	
	}
}
