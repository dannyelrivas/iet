<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente extends CI_Controller {
    
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
        //Tablas historial de empleos y domicilios
        $data['tbl_he'] = $this->formulario->tabla_enc( array( 'Empresa', 'Telefono', 'Puesto', 'Jefe', 'Salario', 'Ingreso', 'Egreso' ), 'tbl_he' );
        $data['tbl_hd'] = $this->formulario->tabla_enc( array( 'Calle', 'Exterior', 'Interior', 'Colonia', 'C.P.', 'Ciudad', 'Estado' ), 'tbl_hd' );
        
        //Datos del cliente
        $data['cliente'] = $this->usuario; 
        
        //Candidatos del cliente
        $data['candidatos'] = $this->m_candidato->lista( $this->usuario->id );
        
        //Obtiene los clientes de la misma empresa y ciudad
        $clientes_otros = $this->m_usuario->get_otros( $this->usuario->id, $this->usuario->Empresa_id, $this->usuario->ciudad, $this->usuario->UsuarioTipo_id );
        $i = 0;
        
        foreach ( $clientes_otros as $co ){
            $data['candidatos_otros'][$i] = $this->m_candidato->lista( $co->id );
            $i++;
        }
        
        $data['page_title'] = 'IET - Panel de Cliente';
        
        $this->load->view('cliente/v_head_cliente', $data);
        $this->load->view('cliente/v_home_cliente');
        $this->load->view('cliente/v_foot_cliente');
    }
    
}