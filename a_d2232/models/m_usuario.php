<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_usuario extends CI_Model{
    
    //funcion que devuelve los datos de un usuario si este esta en la BD.
    function getUsuario($login, $pwd)
    {
        $q = $this->db->get_where('Usuario', array('login' => $login, 'password' => $pwd));
        return $q->row();
    }
    
    function get($id)
    {
        $q = $this->db->get_where( 'Usuario', array('id' => $id) );
        return $q->row();
    }
    
    function add( $usuario )
    {
        $this->db->insert('Usuario', $usuario); 
        return $this->db->insert_id();
    }
    
    public function update($data, $id)
    {
        $this->db->update( 'Usuario', $data, array('id'=>$id) );
    }
    
    public function del($id)
    {
        $this->db->delete( 'Usuario', array('id' => $id) ); 
    }
    
    function get_by_UsuarioTipo_id( $UsuarioTipo_id )
    {
        $q = $this->db->order_by( 'nombre', 'asc' );
        $q = $this->db->where( array('UsuarioTipo_id' => $UsuarioTipo_id) );
        $q = $this->db->get( 'Usuario' );
        return $q->result();
    }
    
    /*
     * Retorna los candidatos que se encuentren en la misma $empresa_id y $ciudad que
     * el $cliente_id
     */
    function get_otros($cliente_id, $empresa_id, $ciudad, $usuariotipo_id)
    {
        $q = $this->db->order_by('nombre', 'asc');
        $q = $this->db->where( 'id !=', $cliente_id );
        $q = $this->db->where( array('Empresa_id' => $empresa_id, 'ciudad' => $ciudad, 'UsuarioTipo_id' => $usuariotipo_id ) );
        $q = $this->db->get( 'Usuario');
        return $q->result();
    }
    
    /*
     * Retorna la lista de colaboradores
     */
    function get_colaboradores()
    {
        $this->load->model('m_usuario_tipo');
        
        $id_tipo = $this->m_usuario_tipo->get_by_tipo( 'COLABORADOR' );
        
        $q = $this->db->order_by('nombre', 'asc');
        $q = $this->db->where( array('UsuarioTipo_id' => $id_tipo->id ) );
        $q = $this->db->get( 'Usuario' );
        return $q->result();
    }
    
    /*
     * Retorna la lista de correos de los administradores del sistema
     * Utilizada para enviar alerta de email
     */
    function get_admins_emails()
    {
        $this->load->model('m_usuario_tipo');
        
        //id del UsuarioTipo = ADMIN
        $id_admin = $this->m_usuario_tipo->get_by_tipo( 'ADMIN' );
        
        $q = $this->db->get_where('Usuario', array( 'UsuarioTipo_id' => $id_admin->id ) );
        $res = $q->result();
        
        $emails = array();
        
        foreach( $res as $a ){
            
            if( isset( $a->email ) && !empty( $a->email ) ){
                
                array_push($emails, $a->email);
                
            }
            
        }
        
        return $emails;
        
    }
    
}