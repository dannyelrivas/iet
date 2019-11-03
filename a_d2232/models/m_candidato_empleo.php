<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_candidato_empleo extends CI_Model{
    
    public function add($empleo)
    {
        $this->db->insert('CandidatoEmpleo', $empleo);
    }
    
    /*
     * Agregar Varios
     */
    public function addM($empleos)
    {
        $this->db->insert_batch('CandidatoEmpleo', $empleos); 
    }
    
    public function del($id)
    {
        $this->db->delete('CandidatoEmpleo', array('id' => $id)); 
    }
    
    /*
     * Actualiza varios empleos (Update Many).
     * En los metodos update siempre debera pasarse el id como parametro
     */
    public function updateM($empleos, $candidato_id)
    {
        //El valor se tiene que pasar por referencia
        foreach($empleos as &$e){
            $e['Candidato_id'] = $candidato_id;
            unset($e['id']);
            unset($e['id_reg']);
        }
        
        $this->db->insert_batch('CandidatoEmpleo', $empleos); 
    }
    
    /*
     * Retorna los empleos de un candidato segun su $id
     */
    public function get_by_Candidato_id($id)
    {
        $q = $this->db->get_where('CandidatoEmpleo', array( 'Candidato_id' => $id ) );
        return $q->result();
    }
    
    public function update($data, $id)
    {
        $this->db->update('CandidatoEmpleo', $data, array('id' => $id)); 
    }
    
}