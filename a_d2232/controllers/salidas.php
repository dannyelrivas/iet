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
        $salida = array();
        $salida['hora'] = date('Y/m/d H:i:s');
        $salida['id'] = null;

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
                else //Encontró el qr3
                {
                    $salida['recoge'] = $alumno_salida->pt3;
                    $salida['id_alumno'] = $alumno_salida->codigoalumno;
                    $salida['salon'] = $alumno_salida->salon;

                    $salida_nueva = $this->m_salidas->nueva($salida);
                    echo json_encode($salida_nueva);
                }
            }
            else //Encontró el qr2
            {
                $salida['recoge'] = $alumno_salida->pt2;
                $salida['id_alumno'] = $alumno_salida->codigoalumno;
                $salida['salon'] = $alumno_salida->salon;

                $salida_nueva = $this->m_salidas->nueva($salida);
                echo json_encode($salida_nueva);
            }
        }
        else //Encontró el qr1
        {
            $salida['recoge'] = $alumno_salida->pt1;
            $salida['id_alumno'] = $alumno_salida->codigoalumno;
            $salida['salon'] = $alumno_salida->salon;

            $salida_nueva = $this->m_salidas->nueva($salida);
            //print_r($salida);
            echo json_encode($salida_nueva);
        }
    }
    
}