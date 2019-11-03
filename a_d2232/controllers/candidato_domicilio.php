<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Candidato_domicilio extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_candidato_domicilio');
    }
    
    public function index()
    {
        redirect('cliente/home', 'refresh');
    }
    
    public function del()
    {
        $this->m_candidato_domicilio->del($_POST['id']);
    }
    
    public function get_by_Candidato_id()
    {
        $e = $this->m_candidato_domicilio->get_by_Candidato_id( $_POST['candidato_id'] );
        
        echo json_encode( (array) $e );
    }
    
    public function update()
    {
        $data = $_POST;
        $id = $data['id_reg'];
        
        //Limpieza del array
        unset($data['oper']);
        unset($data['id_reg']);
        unset($data['id']);
        
        $this->m_candidato_domicilio->update($data, $id);
    }
    
}