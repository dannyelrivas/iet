<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model( array('m_usuario', 'm_usuario_tipo') );
        $this->load->library('password');
    }

    public function index()
    {
        redirect('usuario/home', 'refresh');
    }

    public function add()
    {
        $data = $_POST;

        //Saltea el password
        $pwd = $this->password->getSalted($data['login'], $data['pwd']);
        $data["password"] = $pwd;

        //Comprueba si el usuario es nuevo o se va a actualizar uno existente
        if( isset( $data['id'] ) && !empty( $data['id'] ) )
        {
            //Actualizacion de usuario
            $id_usr = $data['id'];

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
            unset($data['id']);
            unset($data['pwd']);
            unset($data['guardar']);

            $data['fechaCreacion'] = date('Y-m-d');

            $this->m_usuario->add( $data );
        }

        redirect('admin/usuarios');
    }

    public function del()
    {
        $this->m_usuario->del($_POST['id']);
    }

    public function get_json()
    {
        $u = $this->m_usuario->get( $_POST['id'] );
        $tipo = $this->m_usuario_tipo->get( $u->UsuarioTipo_id );

        $u->tipo = $tipo->tipo;

        echo json_encode( (array) $u );
    }
}
