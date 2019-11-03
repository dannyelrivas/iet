<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_evaluacion extends CI_Model{
    
    function get($id)
    {
        $q = $this->db->get_where( 'Evaluacion', array('id' => $id) );
        return $q->row();
    }

    function getAll()
    {
        $q = $this->db->limit( 50 );
        $q = $this->db->order_by( 'fechaCreacion', 'asc' );
        $q = $this->db->get( 'Evaluacion' );
        return $q->result();
    }
    
    /*
     * Crea una evaluacion para un candidato recien registrado
     */
    function add($candidato_id)
    {
        $this->load->model('m_evaluacion_estado');
        
        $estado = $this->m_evaluacion_estado->get_by_estado( 'NO ASIGNADO' );
        
        $evaluacion = array(
            'fechaCreacion' => date('Y-m-d'),
            'EvaluacionEstado_id' => $estado->id,
            'Candidato_id' => $candidato_id
        );
        
        $this->db->insert('Evaluacion', $evaluacion); 
    }
    
    function update( $evaluacion, $id )
    {
        $this->db->where( 'id', $id );
        $this->db->update('Evaluacion', $evaluacion); 
    }
    
    public function del($id)
    {
        $this->db->delete( 'Evaluacion', array('id' => $id) ); 
    }
    
    /*
     * Retorna las evaluaciones asignadas de estudios socioeconomicos
     * asignadas a un colaborador y que aun no esten evaluadas
     */
    public function get_colaborador_pendientes_s($colaborador_id)
    {
        $q = $this->db->order_by( 'fechaAsignacion', 'asc' );
        $q = $this->db->where( array( 'Colaborador_s_id' => $colaborador_id, 'socioeconomicoXLS' => NULL, 'socioeconomicoPDF' => NULL ) );
        $q = $this->db->get( 'Evaluacion' );
        
        return $q->result();
    }
    
    public function get_colaborador_pendientes_r($colaborador_id)
    {
        $q = $this->db->order_by( 'fechaAsignacion', 'asc' );
        $q = $this->db->where( array( 'Colaborador_r_id' => $colaborador_id, 'referenciasXLS' => NULL, 'referenciasPDF' => NULL ) );
        $q = $this->db->get( 'Evaluacion' );
        
        return $q->result();
    }
    
    public function get_by_Candidato_id( $candidato_id )
    {
        $q = $this->db->where( array( 'Candidato_id' => $candidato_id ) );
        $q = $this->db->get( 'Evaluacion' );
        
        return $q->row();
    }
            
    function getEvaluacion_by_candidatoId($candidato_id)
    {
        
        $q = $this->db  ->select('E.id, E.fechaAsignacion, E.referenciasXLS, E.referenciasPDF, E.socioeconomicoXLS, E.socioeconomicoPDF, E.fechaTermino, E.fechaCreacion, EE.estado, E.Administrador_id')
                        ->from('Evaluacion E')
                        ->join('EvaluacionEstado EE', 'E.EvaluacionEstado_id = EE.id')
                        ->where( array('E.Candidato_id' => $candidato_id) )
                        ->get('Evaluacion');
        
        return $q->row();
    }
    
    /*
     * Retorna las evaluaciones segun el $estado en el que se encuentren:
     * NO ASIGNADO, ASIGNADO, VIABLE, ETC.
     */
    function get_by_status( $estado )
    {
        $this->load->model('m_evaluacion_estado');
        $id_ee = $this->m_evaluacion_estado->get_by_estado( $estado );//Evaluacion estado
        
        $q = $this->db->order_by( 'fechaCreacion', 'desc' );
        $q = $this->db->where( array( 'EvaluacionEstado_id' => $id_ee->id ) );
        $q = $this->db->get( 'Evaluacion' );
        
        return $q->result();
        
    }
    
    /*
     * Evaluaciones segun los parametros requeridos para generar un reporte
     * $usuario se refiere al usuario que realiza la consulta del reporte
     */
    function get_for_reportes($usuario, $fInicio, $fFinal, $empresa, $sucursal )
    {
        $this->load->model('m_empresa');
        
        $q = $this->db->where( "DATE(fechaEntrega) BETWEEN '".$fInicio."' AND '".$fFinal."'" );
        	
        if( !empty($sucursal) && ($sucursal != 'TODOS') )
            $q = $this->db->where( array( 'cedis'=>$sucursal ) );
        
        $q = $this->db->where( array( 'empresa'=>$empresa ) );
        $q = $this->db->get('v_reporte1');
        
        return $q->result();
    }
    
}