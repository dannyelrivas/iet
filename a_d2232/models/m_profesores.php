<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_profesores extends CI_Model{
	public function getsalon($login)
	{
		$q = $this->db->get_where( 'profesor', array('login' => "profesor") );
        return $q->row();
	}	
}
