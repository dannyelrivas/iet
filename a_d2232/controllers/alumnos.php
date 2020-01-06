<?php if( !defined('BASEPATH') ) exit('No direct script access allowed');

    class Alumnos extends CI_Controller
    {
    	function __construct()
        {
            parent::__construct();
            $this->load->model(array('m_usuario', 'm_usuario_tipo', 'm_alumnos'));
            $this->load->library(array('password', 'formulario', 'fechas', 'table'));

            $this->usuario = $this->m_usuario->get($this->session->userdata('id'));

            //$this->output->enable_profiler(TRUE);
        }

        public function index()
        {
            redirect('admin/usuarios', 'refresh');
        }

        public function add()
        {
        	$data = $_POST;

        	//Comprueba si el usuario es nuevo o se va a actualizar uno existente
	        if( isset( $data['id'] ) && !empty( $data['id'] ) )
	        {
	            //Actualizacion de usuario
	            $id_alumno = $data['id'];

	            //Elimina las variables innecesarias
	            unset($data['guardar']);

	            //Comprueba si se ha modificado el password
	            $this->m_alumnos->update( $data, $id_alumno );

	            redirect('admin/alumnos', 'refresh');
	        }
	        else
	        {
	            unset($data['guardar']);

	            //$data['fechaCreacion'] = date('Y-m-d');

	            $data['alumno_insertado'] = $this->m_alumnos->add( $data );
	        }
        }

        public function update()
        {
        	$data = $_POST;
        	unset($data['guardar']);
        	$data['alumno_insertado'] = $this->m_alumnos->update( $data, $data['id'] );
        }

        public function buscar()
        {
        	$data = $_POST;
        	$alumno = $this->m_alumnos->buscar($data['codigo']);
        	echo json_encode($alumno);
        }
    }

