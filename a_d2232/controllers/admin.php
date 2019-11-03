<?php if( !defined('BASEPATH') ) exit('No direct script access allowed');

    class Admin extends CI_Controller
    {

        private $usuario;

        function __construct()
        {
            parent::__construct();
            $this->load->model(array('m_usuario', 'm_usuario_tipo','m_alumnos'));
            $this->load->library(array('password', 'formulario', 'fechas', 'table'));

            $this->usuario = $this->m_usuario->get($this->session->userdata('id'));
        }

        //Interfaz de entrada de la administracion
        public function index()
        {
            redirect('admin/usuarios', 'refresh');
        }

        /*
         * Administracion de Usuarios de cualquier tipo:
         * Clientes, Administradores y Colaboradores
         */
        public function usuarios()
        {
            $data['page_title'] = 'IET - Administracion de usuarios';

            //Tipos de usuario
            $tipo_admin = $this->m_usuario_tipo->get_by_tipo('ADMIN');
            $tipo_colab = $this->m_usuario_tipo->get_by_tipo('COLABORADOR');
            $tipo_control_escolar = $this->m_usuario_tipo->get_by_tipo('CONTROL ESCOLAR');

            //Administradores
            $data['admins'] = $this->m_usuario->get_by_UsuarioTipo_id($tipo_admin->id);

            //Clientes
            $data['control_escolar'] = $this->m_usuario->get_by_UsuarioTipo_id($tipo_control_escolar->id);

            //Colaboradores
            $data['colabs'] = $this->m_usuario->get_by_UsuarioTipo_id($tipo_colab->id);

            //Dropdown de Tipos de Cuenta
            $data['dropdown_tipos_usuario'] = $this->formulario->dropdown_gen('m_usuario_tipo', 'id', 'tipo');

            //Dropdown de Empresas
            $data['dropdown_empresas'] = $this->formulario->dropdown_gen('m_empresa', 'id', 'nombre');

            $data['usuario'] = $this->usuario;

            $this->load->view('admin/v_head_admin', $data);
            $this->load->view('admin/v_usuarios_admin');
            $this->load->view('admin/v_foot_admin');
        }

        public function alumnos()
        {
            $data['page_title'] = 'IET - Administracion de usuarios';

            $data['alumnos'] = $this->m_alumnos->lista();

            $data['usuario'] = $this->usuario;

            $this->load->view('admin/v_head_admin', $data);
            $this->load->view('alumnos/v_alumnos');
        }

        /*
         * Administracion de Empresas
         */
        public function empresas()
        {
            $data['page_title'] = 'IET - Administraci&oacute;n de empresas';
            $data['empresas'] = $this->m_empresa->getAll();
            $data['usuario'] = $this->usuario;

            $this->load->view('admin/v_head_admin', $data);
            $this->load->view('admin/v_empresas_admin');
            $this->load->view('admin/v_foot_admin');
        }

        function evaluaciones()
        {
            $data['page_title'] = 'IET - Administraci&oacute;n de evaluaciones';

            $data['evaluaciones_sa'] = $this->m_evaluacion->get_by_status('NO ASIGNADO'); //Evaluaciones sin asignar
            $data['evaluaciones_sa'] += $this->m_evaluacion->get_by_status('ASIGNADO'); //Evaluaciones asignadas
            $data['dropdown_colaboradores'] = $this->dropdown_colaboradores();
            $data['usuario'] = $this->usuario;

            $this->load->view('admin/v_head_admin', $data);
            $this->load->view('admin/v_evaluaciones_admin');
            $this->load->view('admin/v_foot_admin');
        }

        public function reportes()
        {
            $this->load->helper('directory');

            $archivos = directory_map('./uploads/reportes/');
            $reportes = array();

            //Separa los "metadatos" del reporte
            foreach( $archivos as $r )
            {
                $meta = explode('_', $r);

                //Agrega la ruta completa del archivo al inicio del array
                array_splice($meta, 0, 0, array($r));

                array_push($reportes, $meta);
            }

            //Si se envio una cadena de busqueda genera la tabla con los resultados
            if( isset($_POST['buscar']) )
            {

                $fInicio = $_POST['fd_aa'] . '-' . $_POST['fd_mm'] . '-' . $_POST['fd_dd'];
                $fFinal = $_POST['fh_aa'] . '-' . $_POST['fh_mm'] . '-' . $_POST['fh_dd'];
                $empresa = $this->m_empresa->get($_POST['empresa_fil']);
                $sucursal = $_POST['sucursal_fil'];

                $data['evaluaciones'] = $this->m_evaluacion->get_for_reportes($this->usuario, $fInicio, $fFinal, $empresa->nombre, $sucursal);
                $data['empresa_reporte'] = $empresa->nombre;

            }

            $data['dropdown_empresas'] = $this->formulario->dropdown_gen('m_empresa', 'id', 'nombre');
            $data['usuario'] = $this->usuario;
            $data['reportes'] = $reportes;

            $data['page_title'] = 'IET - Reportes y consulta de solicitudes';

            $this->load->view('admin/v_head_admin', $data);
            $this->load->view('admin/v_reportes_admin');
            $this->load->view('admin/v_foot_admin');
        }

        private function dropdown_colaboradores()
        {
            $array_res = array();

            $items = $this->m_usuario->get_colaboradores();

            foreach( $items as $i )
            {
                $array_res[ $i->id ] = $i->nombre . ' ' . $i->apellidoPaterno . ' ' . $i->apellidoMaterno;
            }

            return $array_res;

        }

        public function generar_reporte($empresa, $sucursal, $fInicio, $fFinal)
        {

            $folio_reporte = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);

            $evaluaciones = $this->m_evaluacion->get_for_reportes($this->usuario, $fInicio, $fFinal, urldecode($empresa), urldecode($sucursal));

            //Comienza la creacion del archivo XLS
            $base = FCPATH . 'custom/docs/Reporte1.xls';
            $nuevo = urldecode(FCPATH . 'uploads/reportes/' . date('d-m-Y') . '_' . $empresa . '_' . $sucursal . '_' . $fInicio . '_' . $fFinal . '_' . $folio_reporte . '.xls');

            require_once FCPATH . 'vendor/phpexcel/Classes/PHPExcel/IOFactory.php';
            require_once FCPATH . 'vendor/phpexcel/Classes/PHPExcel.php';

            $excel2 = PHPExcel_IOFactory::createReader('Excel5');
            $excel2 = $excel2->load($base);

            $excel2->setActiveSheetIndex(0);

            $ip = 4; //Numero de fila donde inician las partidas

            foreach( $evaluaciones as $i )
            {

                $excel2->getActiveSheet()
                    ->setCellValueByColumnAndRow(0, $ip, $i->folio)
                    ->setCellValueByColumnAndRow(1, $ip, $i->empresa)
                    ->setCellValueByColumnAndRow(2, $ip, $i->reclutador)
                    ->setCellValueByColumnAndRow(3, $ip, $i->fechaRecepcion)
                    ->setCellValueByColumnAndRow(4, $ip, $i->nombreCandidato)
                    ->setCellValueByColumnAndRow(6, $ip, $i->ciudad)
                    ->setCellValueByColumnAndRow(7, $ip, $i->cedis)
                    ->setCellValueByColumnAndRow(8, $ip, $i->puesto)
                    ->setCellValueByColumnAndRow(9, $ip, $i->celular)
                    ->setCellValueByColumnAndRow(10, $ip, $i->fechaEntrega)
                    ->setCellValueByColumnAndRow(11, $ip, $i->analistaCampo)
                    ->setCellValueByColumnAndRow(12, $ip, $i->analistaReferencias)
                    ->setCellValueByColumnAndRow(13, $ip, $i->estatus);

                $ip++;
            }

            $objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel5');
            $objWriter->save($nuevo);

            redirect('admin/reportes');

        }

    }
