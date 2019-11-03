<div class="row">

    <div class="col-xs-12">

        <div class="page-header">
            <h3>Evaluaci&oacute;n de candidato <small><?php echo ($tipo_evaluacion == 'socioeconomico' ) ? 'Estudio Socioecon&oacute;mico' : 'Referencias Laborales'; ?></small></h3>
            <?php echo anchor('colaborador', 'Regresar', array('class'=>'pull-right')); ?>
        </div>

        <div class="row">
            <div class="col-sm-6">

                <div class="page-header">
                    <h3><?php echo anchor( 'candidato/ver_datos/'.$candidato->id, 'Resumen del candidato', array( 'class' => 'fancybox' ) ) ?></h3>
                </div>

                <p>Candidato: <span class="label label-info"><?php echo @$candidato->nombre.' '.@$candidato->apellidoPaterno.' '.@$candidato->apellidoMaterno; ?></span></p>
                <p>Cliente: <span class="label label-info"><?php echo @$cliente->nombre.' '.@$cliente->apellidoPaterno.' '.@$cliente->apellidoMaterno; ?></span></p>
                <p>Empresa: <span class="label label-info"><?php echo @$empresa->nombre; ?></span></p>
                <p>Fecha de Asignacion: <span class="label label-info"><?php echo $evaluacion->fechaAsignacion; ?></span></p>

            </div><!--c_datos_evaluacion-->

            <div class="col-sm-6">
                <div class="c_frm_evaluacion">

                    <div class="page-header">
                        <h3>Resultado de la evaluaci&oacute;n</h3>
                    </div>


                    <?php echo form_open_multipart('colaborador/finalizar_evaluacion/'.$tipo_evaluacion);?>

                        <input type="hidden" name="evaluacion_id" value="<?php echo $evaluacion->id; ?>" />

                        <div class="form-group">
                            <label for="EvaluacionEstado_id">Estatus</label>
                            <select id="EvaluacionEstado_id" name="EvaluacionEstado_id" class="form-control">
                                <option value="3">VIABLE</option>
                                <option value="4">CON RESERVAS</option>
                                <option value="5">NO VIABLE</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Archivo PDF:</label>
                            <input type="file" name="filePDF" />
                        </div>

                        <div class="form-group">
                            <label>Archivo Excel (XSL | XLSX):</label>
                            <input type="file" name="fileXLS" />
                        </div>

                        <input type="submit" class="pull-right btn btn-success" value="Enviar" />

                    <?php echo form_close(); ?>

                </div>
            </div>

        </div>




    </div><!--.col-->


</div><!--.row-->
