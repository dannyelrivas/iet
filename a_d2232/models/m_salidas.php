<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_salidas extends CI_Model{
	
	public function todas_salidas($salon)
	{
		$q = $this->db->get_where( 'salida', array('salon' => $salon) );
        return $q->result();
	}

	public function nueva($salida)
	{
		$this->db->insert('salida', $salida);
        return $this->db->insert_id();
	}
}
