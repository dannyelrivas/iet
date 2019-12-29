<?php
    if( !$this->session->userdata('logged_in') ){
        redirect('login', 'refresh');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url(); ?>/custom/images/general/favicon.ico" />
        <link rel='icon' href="<?php echo base_url(); ?>/custom/images/general/favicon.ico"  />

        <title><?php echo $page_title; ?></title>

        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>vendor/jquery-ui/css/start/jquery-ui-1.10.2.custom.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>vendor/jqgrid/css/ui.jqgrid.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>custom/css/general.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>custom/css/style.css" />

        <script src="<?php echo base_url(); ?>vendor/jquery/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url(); ?>vendor/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>vendor/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>vendor/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url(); ?>custom/js/config.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>custom/js/cliente_jqgrid.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>custom/js/cliente_autocomplete.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>custom/js/cliente.js" type="text/javascript"></script>
    </head>
    <body>

        <div class="container-fluid">

            <div class="row" id="page-title">
                <h3 class="text-center">Interfaz de Salón</h3>
            </div><!--row-->

            <div class="row">
                <ul class="nav nav-tabs">
                  <li role="presentation" class="active"><?php echo anchor('salon', 'Salón', array('class'=>'block left menu-evaluaciones')); ?></li>
                  <li role="presentation" class="pull-right"><?php echo anchor('login/logout', 'Cerrar Sesi&oacute;n ['.$usuario->login.']', array('class'=>'action_logout label label-danger')); ?></li>
                </ul>
            </div><!--row-->
