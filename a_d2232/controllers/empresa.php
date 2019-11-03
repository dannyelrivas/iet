<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empresa extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model( array('m_empresa') );
    }
    
    public function index()
    {
        redirect('login/logout', 'refresh');
    }
    
    public function add()
    {
        $data = $_POST;
        
        unset( $data['guardar'] );
        
        if( isset( $data['id'] ) && !empty( $data['id'] ) ){
            $id_usr = $data['id'];
            $this->m_empresa->update( $data, $id_usr );
            
        } else{
            unset( $data['id'] );
            $this->m_empresa->add( $data );
        }
        
        redirect('admin/empresas');
        
    }
    
    public function del()
    {
        $this->m_empresa->del( $_POST['id'] );
    }
    
    public function get_json()
    {
        $u = $this->m_empresa->get( $_POST['id'] );
        
        echo json_encode( (array) $u );
    }
    
}