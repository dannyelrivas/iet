<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() 
    {
        parent::__construct();
        $this->load->model('m_usuario');
        $this->load->model('m_usuario_tipo');
        $this->load->model('m_profesores');
        $this->load->library('password');
    }
    
    /*
     * Establece las variables de sesion cuando un usuario se loguea
     */
    private function setSesion($usuario)
    {
        if( !$this->session->userdata('logged_in') ){
            $sesion = array(
                'id' => $usuario->id,
                'logged_in' => TRUE,
                'ciudad' => $usuario->ciudad,
                'UsuarioTipo_id' => $usuario->UsuarioTipo_id
            );
            if($sesion['UsuarioTipo_id']==5){
                $profesor = $this->m_profesores->getsalon($usuario->login);
                $sesion['salon'] = $profesor->salon;
            }
            $this->session->set_userdata($sesion);
        }
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        
        redirect('login', 'refresh');  
    }

    public function index()
    {
        redirect('login/entrar', 'refresh');
    }
    
    public function entrar()
    {
        /*
        * Si no se han recibido los datos del formulario de inicio de sesion
        */
        if( !isset($_POST['login']) ){ 
            
            /*
            * Si el usuario ya tiene una sesion activa es redirigido al panel de usuario,
            * de lo contrario se muestra el formulario de inicio de sesion
            */
            if( $this->session->userdata('logged_in') ){
                
                $UsuarioTipo_id = $this->session->userdata('UsuarioTipo_id');
                $tipo = $this->m_usuario_tipo->get( $UsuarioTipo_id );
                $seccion = strtolower( $tipo->tipo );
                
                redirect($seccion, 'refresh');
                
            } else {
                
                $data['page_title'] = 'Entrar - IET';
                $this->load->view('v_login', $data);
                
            }
        } else {
            /*
            * Valida el formulario: 
            * Si no se recibio login y pwd se muestra el error.
            * Si se recibieron los parametros valida el usuario.
            */
            if( $this->form_validation->run() == FALSE ){
                
                $data['page_title'] = 'Usuario o password incorrectos';
                $this->load->view('v_login', $data);
             
            } else {
                
                $l = $_POST['login'];
                $p = $this->password->getSalted($l, $_POST['pwd']);
                       
                $usuario = $this->m_usuario->getUsuario($l, $p);
                
                //Si se encontro el usuario, busca el tipo de usuario al que pertenece.
                if( !$usuario ){
                    
                    $data = array(
                        'page_title'=>'Usuario o password incorrectos',
                        'validaciones'=>'Usuario o password incorrectos'
                    );
                    
                    $this->load->view('v_login', $data);
                    
                } else {
                    
                    $tipo = $this->m_usuario_tipo->get( $usuario->UsuarioTipo_id );
                    $seccion = strtolower( $tipo->tipo );
                    
                    $this->setSesion($usuario);
                    
                    redirect($seccion, 'refresh');
                }
            }
        }
    }
}