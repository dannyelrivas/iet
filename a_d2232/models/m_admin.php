<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admin extends CI_Model{
    
    function setDatos($usuario,$key_id)//Guarda los datos para un usuario tipo admin, colaborador o cliente segun el caso
    {
       if($usuario=='Administrador' || $usuario=='Colaborador')
       {
            $data = array(

                            'nombre' => $_POST['nombre'],
                            'domicilio' => $_POST['domicilio'],
                            'telefono' => $_POST['telefono'],
                            'celular' => $_POST['celular'],  
                            'Usuario_id' => $key_id

                          );
       }
       else if($usuario=='Cliente')
       {
          $data = array(
                       
                        'nombre' => $_POST['nombre'],
                        'apellidoPaterno' => $_POST['paterno'],
                        'apellidoMaterno' => $_POST['materno'],
                        'telefono' => $_POST['telefono'],
                        'celular' => $_POST['celular'], 
                        'Empresa_id' => $_POST['empresa'],
                        'Usuario_id' => $key_id
                       
                      ); 
       }
        
        $this->db->insert($usuario, $data);
    }
    
    function setUsuario($tipo)//Genera una cuenta nueva para cualquier tipo usuario y retorna el id de la cuenta
    {
        $password = $this->encriptacion->getSalted($_POST['login'], $_POST['pwd']);
        $data = array(
                        'login' => $_POST['login'],
                        'password' =>$password,
                        'email' => $_POST['email'],
                        'fechaCreacion' => date('Y-m-d'),
                        'UsuarioTipo_id' => $tipo
            
                      );
        $this->db->insert('Usuario', $data);
        return $this->db->insert_id();
      
    }
    
    function setEmpresa()//Guarda los datos de una empresa nueva
    {
        $data = array(
                        'nombre' => $_POST['nombre'],
                        'razonSocial' => $_POST['razon'],
                        'calle' => $_POST['calle'],
                        'colonia' => $_POST['colonia'],
                        'numeroExt' => $_POST['exterior'],
                        'numeroInt' => $_POST['interior'],
                        'cp' => $_POST['cp']
             );
        
        $this->db->insert('Empresa', $data);
    }
    
    function getEmpresa()//Obtiene las empresas registradas y las muestra en el formulario de clientes 
    {
        $query = $this->db
                        ->order_by('nombre', 'asc')
                        ->get('empresa');
        return $query;
    }
    
    function getTipousuario($tipo)//Busca en la bd los usuarios tipo colaborador y cliente y retorna el id de este
    {
        if($tipo=='colaborador' || $tipo=='COLABORADOR')
        {
            $query = $this->db->like('tipo','COLABORADOR')
                              ->like('tipo','colaborador')
                              ->get('UsuarioTipo');
        }
        else if($tipo=='cliente' || $tipo=='CLIENTE')
        {
            $query = $this->db->like('tipo','cliente')
                              ->like('tipo','CLIENTE')
                              ->get('UsuarioTipo');
            
        }
        return $query->row();
    }
    
    function getLista($list) //Obtiene la lista de las personas de admins,clientes,colaboradores y empresas estan registradas en la BD.
    {
        $q = $this->db->get($list);
        return $q->result();
    }
    
    ///////////Controladores para mostrar la info en los formularios/////////////
    function getUsuarios($tipo,$id)
    {
        if($tipo=='Administrador' || $tipo=='Colaborador')
        {
            $q = $this->db->join('Usuario',$tipo.'.Usuario_id = Usuario.id')
                          ->join('UsuarioTipo','Usuario.UsuarioTipo_id = UsuarioTipo.id')
                          ->get_where($tipo, array( $tipo.'.id' => $id ) );
        }
       
        else if($tipo=='Cliente')
        {
            $q = $this->db->select('Cliente.nombre,apellidoPaterno,apellidoMaterno,telefono,celular,Usuario.login,password,email,Empresa.nombre as dos',FALSE)
                          ->join('Usuario',$tipo.'.Usuario_id = Usuario.id')
                          ->join('Empresa','Cliente.Empresa_id = Empresa.id')

                        ->get_where($tipo, array( $tipo.'.id' => $id ) );
            
        }
        
        else if($tipo=='Empresa')
        {
            $q = $this->db->get_where($tipo, array( $tipo.'.id' => $id ) );
            
        }
        return $q->row();
    }
   //////////////////////////////////////////////////////////////////////////////
    
    
    
    
}