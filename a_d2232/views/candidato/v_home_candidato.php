<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url(); ?>/custom/images/general/favicon.ico" />
        <link rel='icon' href="<?php echo base_url(); ?>/custom/images/general/favicon.ico"  />

        <title><?php echo $page_title; ?></title>

        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>custom/css/general.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>custom/css/style.css" />

        <script src="<?php echo base_url(); ?>vendor/jquery/jquery-1.9.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="col-xs-12">

                        <div class="page-header">
                            <h2><?php echo $candidato->nombre.' '.$candidato->apellidoPaterno.' '.$candidato->apellidoMaterno; ?></h2>
                        </div>

                        <h4>Archivos de la evaluaci&oacute;n: </h4>

                        <p>
                            <?php if( $r_xls || $r_pdf ){ ?>
                                Referencias Laborales: <?php  if( $r_xls ) echo anchor( base_url().'uploads/'.$r_xls, ' XLS | ' ); if( $r_pdf ) echo anchor( base_url().'uploads/'.$r_pdf, ' PDF ' ); ?>
                            <?php } ?>
                        </p>

                        <p>
                            <?php if( $s_xls || $s_pdf ){ ?>
                                Estudio Socioeconomico: <?php  if( $s_xls ) echo anchor( base_url().'uploads/'.$s_xls, ' XLS | ' ); if( $s_pdf ) echo anchor( base_url().'uploads/'.$s_pdf, ' PDF ' ); ?>
                            <?php } ?>
                        </p>

                        <br />
                        <br />

                        <table class="table table-condensed">

                            <tr>
                                <th colspan="9">Datos Generales</th>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Celular</th>
                                <th>Fecha de Nacimiento</th>
                                <th>CURP</th>
                                <th>NSS</th>
                                <th>Observaciones</th>
                                <th>Puesto</th>
                                <th>CEDIS</th>
                            </tr>

                            <tr>
                                <td><?php echo $candidato->email; ?></td>
                                <td><?php echo $candidato->telefono; ?></td>
                                <td><?php echo $candidato->celular; ?></td>
                                <td><?php echo $candidato->fechaNacimiento; ?></td>
                                <td><?php echo $candidato->curp; ?></td>
                                <td><?php echo $candidato->seguroSocial; ?></td>
                                <td><?php echo $candidato->observaciones; ?></td>
                                <td><?php echo $candidato->puesto; ?></td>
                                <td><?php echo $candidato->sucursal; ?></td>
                            </tr>

                        </table>

                        <br />

                        <table class="table table-condensed">

                            <tr>
                                <th colspan="7">Historial de Empleos</th>
                            </tr>

                            <tr>
                                <th>Empresa</th>
                                <th>Telefono</th>
                                <th>Puesto</th>
                                <th>Salario</th>
                                <th>Jefe</th>
                                <th>F. Ingreso</th>
                                <th>F. Egreso</th>
                            </tr>

                            <?php
                                foreach( $empleos as $i ){

                                    echo '<tr>';

                                        echo '<td>'.$i->nombreEmpresa.'</td>';
                                        echo '<td>'.$i->telefono.'</td>';
                                        echo '<td>'.$i->puesto.'</td>';
                                        echo '<td>'.$i->salario.'</td>';
                                        echo '<td>'.$i->nombreJefe.'</td>';
                                        echo '<td>'.$i->fechaIngreso.'</td>';
                                        echo '<td>'.$i->fechaEgreso.'</td>';

                                    echo '</tr>';

                                }
                            ?>

                        </table>

                        <br />

                        <table class="table table-condensed">

                            <tr>
                                <th colspan="7">Historial de Domicilios</th>
                            </tr>

                            <tr>
                                <th>Calle</th>
                                <th>No. Exterior</th>
                                <th>No. Interior</th>
                                <th>Colonia</th>
                                <th>C.P.</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                            </tr>

                            <?php
                                foreach( $domicilios as $i ){

                                    echo '<tr>';

                                        echo '<td>'.$i->calle.'</td>';
                                        echo '<td>'.$i->numeroExt.'</td>';
                                        echo '<td>'.$i->numeroInt.'</td>';
                                        echo '<td>'.$i->colonia.'</td>';
                                        echo '<td>'.$i->cp.'</td>';
                                        echo '<td>'.$i->ciudad.'</td>';
                                        echo '<td>'.$i->estado.'</td>';

                                    echo '</tr>';

                                }
                            ?>

                        </table>


                </div><!--c_panel_admin-->
            </div><!--main-->
        </div><!--container-->

    </body>
</html>
