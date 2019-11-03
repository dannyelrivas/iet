<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_candidato_domicilio extends CI_Model{
    
    public function add($domicilio)
    {
        $this->db->insert('CandidatoDomicilio', $domicilio);
    }
    
    public function del($id)
    {
        $this->db->delete('CandidatoDomicilio', array('id' => $id)); 
    }
    
    public function update($data, $id)
    {
        $this->db->update('CandidatoDomicilio', $data, array('id' => $id)); 
    }
    
    /*
     * Agregar Varios
     */
    public function addM($domicilios)
    {
        $this->db->insert_batch('CandidatoDomicilio', $domicilios); 
    }
    
    public function get_by_Candidato_id($candidato_id)
    {
        $q = $this->db->get_where('CandidatoDomicilio', array( 'Candidato_id' => $candidato_id ) );
        return $q->result();
    }
    
}