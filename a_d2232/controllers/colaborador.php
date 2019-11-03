<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Colaborador extends CI_Controller {
    
    private $usuario;
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model( array( 'm_usuario', 'm_candidato', 'm_evaluacion', 'm_empresa' ) );
        $this->load->library( array( 'fechas', 'table', 'upload', 'email_template', 'email' ) );
        
        $this->usuario = $this->m_usuario->get( $this->session->userdata('id') );
        
    }
    
    public function index()
    {
        $data['page_title'] = 'Licipsa - Panel de Colaborador';
        
        $data['evals_s'] = $this->m_evaluacion->get_colaborador_pendientes_s( $this->usuario->id );
        $data['evals_r'] = $this->m_evaluacion->get_colaborador_pendientes_r( $this->usuario->id );
        $data['usuario'] = $this->usuario;
        
        $this->load->view('colaborador/v_head_colaborador', $data);
        $this->load->view('colaborador/v_home_colaborador');
        $this->load->view('colaborador/v_foot_colaborador');
    }
    
    function evaluar( $tipo_evaluacion, $evaluacion_id )
    {
        $evaluacion = $this->m_evaluacion->get( $evaluacion_id );
        $candidato = $this->m_candidato->get( $evaluacion->Candidato_id );
        $cliente = $this->m_usuario->get( $candidato->Cliente_id );
        $empresa = $this->m_empresa->get( $cliente->Empresa_id );
        $data['usuario'] = $this->usuario;
        
        $data['tipo_evaluacion'] = $tipo_evaluacion;
        $data['evaluacion'] = $evaluacion;
        $data['candidato'] = $candidato;
        $data['cliente'] = $cliente;
        $data['empresa'] = $empresa;
        $data['page_title'] = 'Licipsa - Evaluacion de Candidato';
        
        $this->load->view('colaborador/v_head_colaborador', $data);
        $this->load->view('colaborador/v_evaluar_colaborador');
        $this->load->view('colaborador/v_foot_colaborador');
    }
    
    function finalizar_evaluacion( $tipo_eval )
    {
        $evaluacion = $this->m_evaluacion->get( $_POST['evaluacion_id'] ); 
        $candidato = $this->m_candidato->get( $evaluacion->Candidato_id );
        
        //Actualiza los datos de la evaluacion
        $evaluacion->EvaluacionEstado_id = $_POST['EvaluacionEstado_id'];
        $evaluacion->fechaTermino = date( 'Y-m-d' );
        
        //Obtiene los nombres de los archivos
        $siglas = ( $tipo_eval ==  'socioeconomico' ) ? 'S' : 'R';
        
        $nombre_archivo = $siglas.$_POST['evaluacion_id'].'_'.$candidato->nombre.'_'.$candidato->apellidoPaterno;
        
        $pdf = $_FILES['filePDF'];
        $xls = $_FILES['fileXLS'];
        
        //Sube los archivos
        //Config general para el upload de archivos
        $pdf_upload = $this->sube_evaluacion($pdf, $nombre_archivo, '*', 'filePDF');
        $xls_upload = $this->sube_evaluacion($xls, $nombre_archivo, '*', 'fileXLS');
        
        if( $tipo_eval ==  'socioeconomico' ){
            if($xls_upload){ $evaluacion->socioeconomicoXLS = $nombre_archivo . '.' .$xls_upload; }
            if($pdf_upload){ $evaluacion->socioeconomicoPDF = $nombre_archivo . '.' .$pdf_upload; } 
        } else {
            if($xls_upload){ $evaluacion->referenciasXLS = $nombre_archivo. '.' .$xls_upload; } 
            if($pdf_upload){ $evaluacion->referenciasPDF = $nombre_archivo. '.' .$pdf_upload; } 
        }			

		//Guarda la evaluacion		
		$this->db->update('Evaluacion', $evaluacion, array('id'=>$evaluacion->id) );

        //Envia un email al administrador
        //Datos del cliente
        $this->mail_finalizar_evaluacion($evaluacion, $tipo_eval);
		
		//Envia un email al cliente
		
        redirect( 'colaborador' );
    }
    
    private function sube_evaluacion($file, $nombre_archivo, $allowed, $usr_field)
    {
        
        if( isset( $file['name'] ) && !empty( $file['name'] ) ){
            
            $config['upload_path'] = './uploads/';
            $config['max_size']	= '20480';

            $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $file_name = $nombre_archivo.'.'.$file_ext;
			
            $config['allowed_types'] = $allowed;
            $config['file_name'] = $file_name;

            $this->upload->initialize($config);

            if ( !$this->upload->do_upload( $usr_field) ){

                echo $this->upload->display_errors();
                return false;

            } else{
                return $file_ext;
            }
            
        } else {
            
            return false;
            
        }

    }
    
    private function mail_finalizar_evaluacion($evaluacion, $tipo)
    {
        //Datos del colaborador
        
        if( $tipo == 'socioeconomico' )
        {
            $colaborador_id = $evaluacion->Colaborador_s_id;
        } 
        else 
        {
            $colaborador_id = $evaluacion->Colaborador_r_id;
        }
        
        $colab = $this->m_usuario->get( $colaborador_id );
        
        //Datos del administrador
        $admin = $this->m_usuario->get( $evaluacion->Administrador_id );

        //Datos del candidato
        $candidato = $this->m_candidato->get( $evaluacion->Candidato_id );
        

        //Datos del cliente
        $cliente = $this->m_usuario->get( $candidato->Cliente_id );
        
        $this->email->from('licipsa@psiconetrh.com.mx', 'Licipsa');
        $this->email->to( $admin->email ); 
        $this->email->cc( $cliente->email ); 
        $this->email->subject('Evaluacion Finalizada');
        
        $tokens = array(
            'COLABORADOR' => $colab->nombre.' '.$colab->apellidoPaterno.' '.$colab->apellidoMaterno,
            'ADMIN' => $admin->nombre.' '.$admin->apellidoPaterno.' '.$admin->apellidoMaterno,
            'TIPO' => $tipo,
            'CLIENTE' => $cliente->nombre,
            'CANDIDATO' => $candidato->nombre.' '.$candidato->apellidoPaterno.' '.$candidato->apellidoMaterno
        );
        
        $plantilla = base_url().'custom/html/finalizar_evaluacion.html';
        $t = $this->email_template->procesar($plantilla, $tokens);
        
        $this->email->message( $t );	

        return $this->email->send();

    }
    
}