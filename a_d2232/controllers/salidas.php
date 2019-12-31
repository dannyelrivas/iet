<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salidas extends CI_Controller {
    
    private $usuario;
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model( array('m_usuario', 'm_candidato', 'm_alumnos', 'm_salidas') );
        
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

    public function nueva ()
    {
        $data = $_POST;

        $alumno_salida = $this->m_alumnos->buscarqr1($data['qr']);

        if(empty($alumno_salida))
        {
            $alumno_salida = $this->m_alumnos->buscarqr2($data['qr']);

            if(empty($alumno_salida))
            {
                $alumno_salida = $this->m_alumnos->buscarqr3($data['qr']);

                if(empty($alumno_salida))
                {
                    echo json_encode("No se encontró el alumno.");
                }
            }
            else
            {
                echo json_encode($alumno_salida);
            }
        }
        else
        {
            $salida = {
                //Aqui va el desmadre ya que esté la BD
            };
            $this->m_salidas->add($salida);
            echo json_encode($alumno_salida);
        }
    }
    
}