<?php if( !defined('BASEPATH') ) exit('No direct script access allowed');

    class Alumnos extends CI_Controller
    {
    	function __construct()
        {
            parent::__construct();
            $this->load->model(array('m_usuario', 'm_usuario_tipo','m_alumnos'));
            $this->load->library(array('password', 'formulario', 'fechas', 'table'));

            $this->usuario = $this->m_usuario->get($this->session->userdata('id'));
        }

        //Interfaz de entrada de la administracion
        public function index()
        {
            redirect('admin/usuarios', 'refresh');
        }

        public function add()
        {
        	$data = $_POST;
        	/*
        	if( isset( $data['id'] ) && !empty( $data['id'] ) )
        {
            //Actualizacion de usuario
            /*$id_usr = $data['id'];

            //Si el password está vacio, no se guarda
            if($data["pwd"] == "")
            {
              unset($data["password"]);
            }

            //Elimina las variables innecesarias
            unset($data['pwd']);
            unset($data['guardar']);

            //Comprueba si se ha modificado el password
            $this->m_usuario->update( $data, $id_usr );
        }
        else
        {
            //Usuario nuevo
            //Limpia y acomoda el array para insercion
            
            /*unset($data['nombre']);
            unset($data['apaterno']);
            unset($data['amaterno']);
            unset($data['codigoalumno']);
            unset($data['nivel']);
            unset($data['grado']);
            unset($data['grupo']);
            unset($data['salon']);*/
            //unset($data['id']);
            unset($data['guardar']);

            $this->m_alumnos->add($data);

            redirect('admin/alumnos');
        //}

        }
    }