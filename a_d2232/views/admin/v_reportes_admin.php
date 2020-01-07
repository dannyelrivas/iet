<div class="row">

    <div class="col-xs-12">

        <?php echo form_open('admin/reportes'); ?>

            <h3>Generar reporte</h3>

            <hr />

            <div class="form-group row">

                <div class="col-sm-2">
                    <?php echo form_label("Salón:").form_dropdown('empresa_fil', $dropdown_empresas, '', 'class="form-control"'); ?>
                </div>

                <div class="col-sm-2">
                    <?php echo form_label("ID alumno:").form_input( array('name'=>'sucursal_fil', 'id'=>'txt_reportes_sucursal', "class"=>'form-control') ); ?>
                </div>

                <div class="col-sm-4">
                    <label class="clear">Desde:</label>
                    <br />
                    <div class="col-xs-3"><?php echo form_dropdown('fd_dd', $this->fechas->arrayDay(), date('d'), 'class="form-control"'); ?></div>
                    <div class="col-xs-6"><?php echo form_dropdown('fd_mm', $this->fechas->arrayMonth(), date('m'), 'class="form-control"'); ?></div>
                    <div class="col-xs-3"><?php echo form_dropdown('fd_aa', $this->fechas->arrayYear(), date('Y'), 'class="form-control"'); ?></div>
                </div>

                <div class="col-sm-4">
                    <label class="clear">Hasta:</label>
                    <br />
                    <div class="col-xs-3"><?php echo form_dropdown('fh_dd', $this->fechas->arrayDay(), date('d'), 'class="form-control"'); ?></div>
                    <div class="col-xs-6"><?php echo form_dropdown('fh_mm', $this->fechas->arrayMonth(), date('m'), 'class="form-control"'); ?></div>
                    <div class="col-xs-3">
                        <?php
                            echo form_dropdown('fh_aa', $this->fechas->arrayYear(), date('Y'), 'class="form-control"')
                                .'<br />'
                                .form_submit(array('name' => 'buscar', 'value'=>'Buscar', "class"=>"btn btn-success pull-right"));
                        ?>
                    </div>
                </div>

            </div>


        <?php echo form_close(); ?>

    </div><!--.col-->

</div><!--.row-->


<div class="row">

    <div class="col-xs-12">
        <?php if( !empty( $evaluaciones ) ): ?>

                <h3>Resultados de la busqueda</h3>
                <?php
                    $cedis = ( empty( $_POST['sucursal_fil'] ) ) ? 'TODOS' : $_POST['sucursal_fil'];
                    echo '<p>';
                    echo 'Empresa <span class="label label-info">'.$empresa_reporte.'</span>, '
                            .'CEDIS <span class="label label-info">'.$cedis.'</span> '
                            .'del <span class="label label-info">'.$_POST["fd_dd"].'/'.$_POST["fd_mm"].'/'.$_POST["fd_aa"].'</span> '
                            .'al <span class="label label-info">'.$_POST["fh_dd"].'/'.$_POST["fh_mm"].'/'.$_POST["fh_aa"].'</span> | ';
                    echo anchor('admin/generar_reporte/'.$empresa_reporte.'/'.$cedis.'/'.$_POST["fd_aa"].'-'.$_POST["fd_mm"].'-'.$_POST["fd_dd"].'/'.$_POST["fh_aa"].'-'.$_POST["fh_mm"].'-'.$_POST["fh_dd"], 'Generar Excel');
                    echo '</p>'
                ?>

                <table class="table table-condensed table-striped table-hover">

                    <tr>
                        <th>Folio</th>
                        <th>Empresa</th>
                        <th>Reclutador</th>
                        <th>F.Recepcion</th>
                        <th>F.Entrega</th>
                        <th>Candidato</th>
                        <th>Ciudad</th>
                        <th>CEDIS</th>
                        <th>Puesto</th>
                        <th>Celular</th>
                        <th>Analista Campo</th>
                        <th>Analista Ref.</th>
                        <th>Estatus</th>
                    </tr>

                    <?php

                        foreach ( $evaluaciones as $e ){

                            echo '<tr>';
                                echo '<td>'.$e->folio.'</td>';
                                echo '<td>'.$e->empresa.'</td>';
                                echo '<td>'.$e->reclutador.'</td>';
                                echo '<td>'.$e->fechaRecepcion.'</td>';
                                echo '<td>'.$e->fechaEntrega.'</td>';
                                echo '<td>'.anchor( 'candidato/ver_datos/'.$e->c_id, $e->nombreCandidato, array( 'class' => 'fancybox' ) ).'</td>';
                                echo '<td>'.$e->ciudad.'</td>';
                                echo '<td>'.$e->cedis.'</td>';
                                echo '<td>'.$e->puesto.'</td>';
                                echo '<td>'.$e->celular.'</td>';
                                echo '<td>'.$e->analistaCampo.'</td>';
                                echo '<td>'.$e->analistaReferencias.'</td>';
                                echo '<td>'.$e->estatus.'</td>';
                            echo '</tr>';
                        }

                    ?>

                </table>
            <?php else: ?>

                <p class="text-center">No se encontr&oacute; ning&uacute;n registro o no se han seleccionado filtros.</p>

            <?php endif; ?>
    </div><!--.col-->
</div><!--.row-->


<div class="row">

    <div class="col-xs-12">
        <h3>Reportes Generados <small>Para descargar un reporte: Clic derecho > Guardar enlace como</small></h3>
        
        <hr />
        

        <?php foreach($reportes as $i): ?>

            <div class="panel panel-info col-sm-4">
              <div class="panel-heading text-center"><?php echo anchor(base_url().'/uploads/reportes/'.$i[0], "Descargar Reporte"); ?></div>
              <div class="panel-body">
                <p>Generado el dia: <label class="label label-info"><?php echo isset($i[1]) ? $i[1] : "-"; ?></label></p>
                <p>Empresa: <label class="label label-info"><?php echo isset($i[2]) ? $i[2] : "-"; ?></label></p>
                <p>CEDIS: <label class="label label-info"><?php echo isset($i[3]) ? $i[3] : "-"; ?></label></p>
                <p>Desde: <label class="label label-info"><?php echo isset($i[4]) ? $i[4] : "-"; ?></label></p>
                <p>Hasta: <label class="label label-info"><?php echo isset($i[5]) ? $i[5] : "-"; ?></label></p>
              </div>
            </div>

        <?php endforeach;?>
    </div>

</div><!--.row-->


<script>

    jQuery(document).ready(function($){

        $('.menu-reportes').addClass('active');

    });

</script>
