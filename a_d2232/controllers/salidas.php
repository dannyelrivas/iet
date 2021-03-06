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
                    $salida_null = $this->m_salidas->existe($alumno_salida->codigoalumno);
                    if(empty($salida_null))
                    {
                        $salida['recoge'] = $alumno_salida->pt3;
                        $salida['idalumno'] = $alumno_salida->codigoalumno;
                        $salida['salon'] = $alumno_salida->salon;

                        $salida_nueva_id = $this->m_salidas->nueva($salida);
                        $salida_nueva = $this->m_salidas->get($salida_nueva_id);
                        $salida_nueva->alumno = $alumno_salida;
                        echo json_encode($salida_nueva);
                    }
                    else
                    {
                        echo json_encode("Ya existe una salida para ese alumno.");
                    }
                }
            }
            else //Encontró el qr2
            {
                $salida_null = $this->m_salidas->existe($alumno_salida->codigoalumno);
                if(empty($salida_null))
                {
                    $salida['recoge'] = $alumno_salida->pt2;
                    $salida['idalumno'] = $alumno_salida->codigoalumno;
                    $salida['salon'] = $alumno_salida->salon;

                    $salida_nueva_id = $this->m_salidas->nueva($salida);
                    $salida_nueva = $this->m_salidas->get($salida_nueva_id);
                    $salida_nueva->alumno = $alumno_salida;
                    echo json_encode($salida_nueva);
                }
                else
                {
                    echo json_encode("Ya existe una salida para ese alumno.");
                }
            }
        }
        else //Encontró el qr1
        {
            $salida_null = $this->m_salidas->existe($alumno_salida->codigoalumno);
            if(empty($salida_null))
            {
                $salida['recoge'] = $alumno_salida->pt1;
                $salida['idalumno'] = $alumno_salida->codigoalumno;
                $salida['salon'] = $alumno_salida->salon;

                $salida_nueva_id = $this->m_salidas->nueva($salida);
                $salida_nueva = $this->m_salidas->get($salida_nueva_id);
                $salida_nueva->alumno = $alumno_salida;
                echo json_encode($salida_nueva);
            }
            else
            {
                echo json_encode("Ya existe una salida para ese alumno.");
            }
        }
    }
    
}