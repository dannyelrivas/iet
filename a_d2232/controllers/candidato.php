<?php if( !defined('BASEPATH') ) exit('No direct script access allowed');

    class Candidato extends CI_Controller
    {

        function __construct()
        {
            parent::__construct();
            $this->load->model('m_candidato');
            $this->load->model('m_candidato_domicilio');
            $this->load->model('m_candidato_empleo');

            $this->load->library('email');
        }

        /*
         * Limpia el array de empleos enviado desde jQuery.
         * Retorna un array sin los campos indeseados y agrega el campo Candidato_id
         */
        private function limpiaEmpleos($empleos, $candidato_id)
        {
            foreach( $empleos as &$e )
            {

                $e['Candidato_id'] = $candidato_id;

                if( isset($e['id_reg']) ) unset($e['id_reg']);
                unset($e['id']);
            }

            return $empleos;
        }

        /*
         * Limpia el array de empleos enviado desde jQuery.
         * Retorna un array sin los campos indeseados y agrega el campo Candidato_id
         */
        private function limpiaDomicilios($domicilios, $candidato_id)
        {
            foreach( $domicilios as &$d )
            {

                $d['Candidato_id'] = $candidato_id;

                if( isset($d['id_reg']) ) unset($d['id_reg']);
                unset($d['id']);
            }

            return $domicilios;
        }

        public function index()
        {
            redirect('cliente/home', 'refresh');
        }

        public function add()
        {
            $this->load->model('m_evaluacion');
            $this->load->library('arreglos');

            //Se inserta el candidato
            $candidato['form'] = $this->arreglos->repararSerialized($_POST['form']);

            $data = $candidato['form'];

            $candidato = array(
                'nombre'          => $data['nombre'],
                'curp'            => $data['curp'],
                'apellidoPaterno' => $data['apellidoPaterno'],
                'seguroSocial'    => $data['seguroSocial'],
                'apellidoMaterno' => $data['apellidoMaterno'],
                'observaciones'   => $data['observaciones'],
                'fechaNacimiento' => $data['fn_aa'] . '-' . $data['fn_mm'] . '-' . $data['fn_dd'],
                'puesto'          => $data['puesto'],
                'sucursal'        => $data['sucursal'],
                'telefono'        => $data['telefono'],
                'celular'         => $data['celular'],
                'email'           => $data['email'],
                'Cliente_id'      => $data['Cliente_id'],
            );

            $candidato_id = $this->m_candidato->add($candidato);

            //Se crea un proceso de evaluacion vacio
            $this->m_evaluacion->add($candidato_id);

            //Se guardan domicilios y empleos
            if( isset($_POST['empleos']) )
            {
                $empleos = $this->limpiaEmpleos($_POST['empleos'], $candidato_id);

                $this->m_candidato_empleo->addM($empleos);
            }

            if( isset($_POST['domicilios']) )
            {
                $domicilios = $this->limpiaDomicilios($_POST['domicilios'], $candidato_id);

                $this->m_candidato_domicilio->addM($domicilios, $candidato_id);
            }

            //Envia la alerta del candidato creado por email
            $this->mail_alta_candidato($candidato);

        }

        public function update()
        {
            $this->load->library('arreglos');

            $candidato['form'] = $this->arreglos->repararSerialized($_POST['form']);
            $candidato_id = $candidato['form']['candidato_id'];

            $data = $candidato['form'];

            $data = array(
                'nombre'          => $data['nombre'],
                'curp'            => $data['curp'],
                'apellidoPaterno' => $data['apellidoPaterno'],
                'seguroSocial'    => $data['seguroSocial'],
                'apellidoMaterno' => $data['apellidoMaterno'],
                'observaciones'   => $data['observaciones'],
                'fechaNacimiento' => $data['fn_aa'] . '-' . $data['fn_mm'] . '-' . $data['fn_dd'],
                'puesto'          => $data['puesto'],
                'sucursal'        => $data['sucursal'],
                'telefono'        => $data['telefono'],
                'celular'         => $data['celular'],
                'email'           => $data['email'],
                'Cliente_id'      => $data['Cliente_id'],
            );

            $this->m_candidato->update($data, $candidato_id);

            if( isset($_POST['empleos']) )
            {

                //Quita del array de empleos los que ya esten guardados
                $tmp_empleos = array();

                foreach( $_POST['empleos'] as $e )
                {

                    if( empty($e['id_reg']) )
                    {
                        array_push($tmp_empleos, $e);
                    }

                }

                //Guarda los empleos si es que quedo alguno despues de quitar los duplicados
                if( count($tmp_empleos) > 0 )
                {
                    $empleos = $this->limpiaEmpleos($tmp_empleos, $candidato_id);
                    $this->m_candidato_empleo->addM($empleos);
                }

            }

            if( isset($_POST['domicilios']) )
            {

                //Quita del array de domicilios los que ya esten guardados
                $tmp_domicilios = array();

                foreach( $_POST['domicilios'] as $d )
                {

                    if( empty($d['id_reg']) )
                    {
                        array_push($tmp_domicilios, $d);
                    }

                }

                if( count($tmp_domicilios) > 0 )
                {
                    $domicilios = $this->limpiaDomicilios($tmp_domicilios, $candidato_id);
                    $this->m_candidato_domicilio->addM($domicilios);
                }

            }
        }

        /*
         * Retorna un candidato segun su id.
         * Tambien retorna sus empleos y domicilios.
         */
        public function get()
        {
            $c = $this->m_candidato->get($_POST['id']);

            echo json_encode((array)$c);
        }

        public function del()
        {
            $this->m_candidato->del($_POST['id']);
        }

        /*
         * Alerta al crear un candidato
         * $candidato: Datos del candidato creado
         * $cliente: Cliente que dio de alta al candidato
         */
        private function mail_alta_candidato($candidato)
        {
            $this->load->model('m_usuario');
            $this->load->model('m_empresa');
            $this->load->library('email_template');

            //Lista de correos de los administradores
            $admin_emails = $this->m_usuario->get_admins_emails();

            $this->email->from('licipsa@psiconetrh.com.mx', 'Licipsa');
            $this->email->to($admin_emails);

            $this->email->subject('Alta de Candidato');

            //Obtiene los datos del cliente
            $cliente = $this->m_usuario->get($candidato['Cliente_id']);
            $empresa = $this->m_empresa->get($cliente->Empresa_id);

            $tokens = array(
                'CLIENTE'   => $cliente->nombre . ' ' . $cliente->apellidoPaterno . ' ' . $cliente->apellidoMaterno,
                'EMPRESA'   => $empresa->nombre,
                'CANDIDATO' => $candidato['nombre'] . ' ' . $candidato['apellidoPaterno'] . ' ' . $candidato['apellidoMaterno'],
            );

            $plantilla = base_url() . 'custom/html/candidato_alta.html';
            $t = $this->email_template->procesar($plantilla, $tokens);

            $this->email->message($t);

            return $this->email->send();

        }

        /*
         * Retorna una lista en formato JSON que puede ser usada
         * para el plugin autocomplete de jQuery.
         */
        public function get_autocomplete_sucursal()
        {
            $term = $_GET['term'];
            $sucursales = $this->m_candidato->get_distinct_sucursales($term);

            //Se acomoda el array de tal forma que sea legible por el autocomplete de jQuery
            foreach( $sucursales as $i )
            {
                $suc = $i->sucursal;
                $i->value = $suc;
                unset($i->sucursal);
            }

            echo json_encode($sucursales);
        }

        public function ver_datos($candidato_id)
        {

            $this->load->model(array('m_evaluacion', 'm_evaluacion_estado'));

            $data['candidato'] = $this->m_candidato->get($candidato_id);
            $evaluacion = $this->m_evaluacion->getEvaluacion_by_candidatoId($candidato_id);

            $data['empleos'] = $this->m_candidato_empleo->get_by_Candidato_id($candidato_id);
            $data['domicilios'] = $this->m_candidato_domicilio->get_by_Candidato_id($candidato_id);

            $data['r_xls'] = (!empty($evaluacion->referenciasXLS)) ? $evaluacion->referenciasXLS : FALSE;
            $data['r_pdf'] = (!empty($evaluacion->referenciasPDF)) ? $evaluacion->referenciasPDF : FALSE;

            $data['s_xls'] = (!empty($evaluacion->socioeconomicoXLS)) ? $evaluacion->socioeconomicoXLS : FALSE;
            $data['s_pdf'] = (!empty($evaluacion->socioeconomicoPDF)) ? $evaluacion->socioeconomicoPDF : FALSE;

            $this->load->view('candidato/v_home_candidato', $data);

        }

    }