<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_candidato extends CI_Model{
    
    public function add($candidato)
    {
        $this->db->insert('Candidato', $candidato); 
        return $this->db->insert_id();
    }
    
    public function update($data, $id)
    {
        $this->db->update( 'Candidato', $data, array('id'=>$id) );
    }
    
    public function del($id)
    {
        $this->db->delete( 'Candidato', array('id' => $id) ); 
    }
    
    function get($id)
    {
        $q = $this->db->get_where('Candidato', array( 'id' => $id ) );
        return $q->row();
    }
    
    /*
     * Retorna la lista de candidatos.
     * Si se especifica $usuario_id retorna solo los candidatos
     * creados por ese usuario.
     */
    public function lista($usuario_id = 0)
    {
        $this->load->model('m_evaluacion');
        
        $q = $this->db->order_by('id', 'desc');
        $q = $this->db->limit(15);
        
        if( $usuario_id != 0 ){
            $q = $this->db->where( array( 'Cliente_id' => $usuario_id ) );
        }
        
        $q = $this->db->get('Candidato');
        
        $candidatos = $q->result();
        
        //Despues de obtener la lista de candidatos agrega su evaluacion correspondiente
        foreach($candidatos as $c){
            $e = $this->m_evaluacion->getEvaluacion_by_candidatoId($c->id);
            $c->evaluacion = $e;
        }
        
        return $candidatos;
    }
    
    /*
     * Retorna una lista de las distintas sucursales segun la tabla de Candidatos
     */
    function get_distinct_sucursales( $term )
    {
        $q = $this->db->select('sucursal');
        $q = $this->db->distinct();
        $q = $this->db->like('sucursal', $term);
        $q = $this->db->order_by('sucursal', 'asc');
        $q = $this->db->get('Candidato');
        
        return $q->result();
    }
    
}