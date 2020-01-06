<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salon extends CI_Controller {
    
    private $usuario;
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model( array('m_usuario', 'm_candidato', 'm_salidas', 'm_alumnos') );
        
        $this->load->library( array( 'fechas', 'formulario') );
        
        $this->usuario = $this->m_usuario->get( $this->session->userdata('id') );
    }
    
    public function index()
    {
   		$data['page_title'] = 'IET - Salidas de alumnos';
        $data['usuario'] = $this->usuario;
        $data['salon'] = $this->session->userdata('salon');

        $data['salidas'] = $this->m_salidas->todas_salidas( $data['salon'] );

        for($i = 0; $i < count($data['salidas']); $i++)
        {
            $id_alumno = $data['salidas'][$i]->idalumno;
            $alumno = $this->m_alumnos->buscar($id_alumno);
            $data['salidas'][$i]->nombre = $alumno->nombre;
            $data['salidas'][$i]->apaterno = $alumno->apaterno;
            $data['salidas'][$i]->amaterno = $alumno->amaterno;
        }
        
        $this->load->view('salon/v_head_salon', $data);
        $this->load->view('salon/v_home_salon');
        $this->load->view('salon/v_foot_salon');
    }
    
    public function dar_salida()
    {
        $id = $_POST['id'];
        $affected_rows = $this->m_salidas->dar_salida($id);
        echo $affected_rows;
    }
}