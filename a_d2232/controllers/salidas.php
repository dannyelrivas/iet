<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salidas extends CI_Controller {
    
    private $usuario;
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model( array('m_usuario', 'm_candidato') );
        
        $this->load->library( array( 'fechas', 'formulario') );
        
        $this->usuario = $this->m_usuario->get( $this->session->userdata('id') );
    }
    
    public function index()
    {
   		$data['page_title'] = 'IET - Salidas de alumnos';
        $data['usuario'] = $this->usuario;

        $this->load->view('salidas/v_head_salidas', $data);
        $this->load->view('salidas/v_salidas_salidas');
        $this->load->view('salidas/v_foot_salidas');
    }
    
}