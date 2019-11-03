<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluacion extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model( array('m_evaluacion', 'm_evaluacion_estado', 'm_usuario', 'm_candidato') );
        $this->load->library( array('email_template', 'email') );
    }
    
    public function del()
    {
        $this->m_evaluacion->del( $_POST['id'] );
    }
    
    public function asignar()
    {
        //Obtiene el nuevo estado de la evaluacion
        $nEstado = $this->m_evaluacion_estado->get_by_estado( 'ASIGNADO' );
        
        //Recupera la Evaluacion
        $eval = $this->m_evaluacion->get( $_POST['evaluacion_id'] );
        
        //Elimina el campo id para evitar problemas con el update
        unset( $eval->id );
        
        //Recupera el id del administrador
        $eval->fechaAsignacion = date( 'Y-m-d' );
        $eval->EvaluacionEstado_id = $nEstado->id;
        $eval->Colaborador_r_id = $_POST['colaborador_r_id'];
        $eval->Colaborador_s_id = $_POST['colaborador_s_id'];
        $eval->Administrador_id = $this->session->userdata('id');
        
        //Asigna los colaboradores
        $this->m_evaluacion->update( $eval, $_POST['evaluacion_id'] );
        
        //Alerta por correo a los colaboradores
        $this->mail_asignacion_evaluacion($eval, $_POST['colaborador_r_id'],'Referencias Laborales');
        $this->mail_asignacion_evaluacion($eval, $_POST['colaborador_s_id'], 'Estudio Socioeconomico');
        
    }
    
    private function mail_asignacion_evaluacion($evaluacion, $colaborador_id, $tipo)
    {
        //Datos del colaborador
        $colab = $this->m_usuario->get( $colaborador_id );
        
        //Datos del administrador
        $admin = $this->m_usuario->get( $evaluacion->Administrador_id );
        
        //Datos del candidato
        $candidato = $this->m_candidato->get( $evaluacion->Candidato_id );
        
        //Datos del cliente
        $cliente = $this->m_usuario->get( $candidato->Cliente_id );
        
        $this->email->from('no-reply@psiconetrh.com.mx', 'Licipsa');
        $this->email->to( $colab->email ); 
        $this->email->subject('Evaluacion Asignada');
        
        $tokens = array(
            'ADMIN' => $admin->nombre.' '.$admin->apellidoPaterno.' '.$admin->apellidoMaterno,
            'TIPO' => $tipo,
            'CLIENTE' => $cliente->nombre,
            'CANDIDATO' => $candidato->nombre.' '.$candidato->apellidoPaterno.' '.$candidato->apellidoMaterno
        );
        
        $plantilla = base_url().'custom/html/asignacion_evaluacion.html';
        $t = $this->email_template->procesar($plantilla, $tokens);
        
        $this->email->message( $t );	

        return $this->email->send();

    }
    
    /*
    * Cambiar el estatus de un candidato a cancelado
    */
    public function cancelar()
    {
        //Obtiene el estado cancelado
        $estatus = $this->m_evaluacion_estado->get_by_estado( 'CANCELADO' );
        
        //Recupera la evaluacion para actualizarla
        $evaluacion = $this->m_evaluacion->get_by_Candidato_id( $_POST['candidato_id'] );
        $evaluacion->EvaluacionEstado_id =  $estatus->id;

        $this->m_evaluacion->update( $evaluacion, $evaluacion->id );
        
    }
    
}