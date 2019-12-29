<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salon extends CI_Controller {
    
    private $usuario;
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model( array('m_usuario', 'm_candidato', 'm_salidas') );
        
        $this->load->library( array( 'fechas', 'formulario') );
        
        $this->usuario = $this->m_usuario->get( $this->session->userdata('id') );
    }
    
    public function index()
    {
   		$data['page_title'] = 'IET - Salidas de alumnos';
        $data['usuario'] = $this->usuario;
        $data['salon'] = $this->session->userdata('salon');

        $data['salidas'] = json_encode($this->m_salidas->todas_salidas( $data['salon'] ));
        
        $this->load->view('salon/v_head_salon', $data);
        $this->load->view('salon/v_home_salon');
        $this->load->view('salon/v_foot_salon');
    }
    
}