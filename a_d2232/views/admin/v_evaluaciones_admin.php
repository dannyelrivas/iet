<div class="row">

    <div class="col-sm-8 bloque-izquierdo">
        <h3>Candidatos sin asignar o evaluar</h3>

        <hr />

            <table class="table table-condensed table-striped table-hover">

                <thead>
                    <tr>
                        <th></th>
                        <th>Fecha de alta</th>
                        <th>Estado</th>
                        <th>Candidato</th>
                        <th>Cliente</th>
                        <th>Socioecon&oacute;mico</th>
                        <th>Referencias</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                        foreach ( $evaluaciones_sa as $e ){

                            //Obtiene los datos del candidato
                            $candidato = $this->m_candidato->get( $e->Candidato_id );
                            $cliente = $this->m_usuario->get( $candidato->Cliente_id );
                            $socioec = $this->m_usuario->get( $e->Colaborador_s_id );
                            $referencias = $this->m_usuario->get( $e->Colaborador_r_id );
                            $eval_estado = $this->m_evaluacion_estado->get( $e->EvaluacionEstado_id );

                            echo '<tr>';
                                echo '<td><input type="checkbox" name="id_eval" class="id_eval" value="'.$e->id.'" /></td>';
                                echo '<td>'.$e->fechaCreacion.'</td>';
                                echo '<td>'. strtolower( $eval_estado->estado ) .'</td>';
                                echo '<td>'.@$candidato->nombre.' '.@$candidato->apellidoPaterno.' '.@$candidato->apellidoMaterno.'</td>';
                                echo '<td>'.@$cliente->nombre.' '.@$cliente->apellidoPaterno.' '.@$cliente->apellidoMaterno.'</td>';

                                echo '<td>'.@$socioec->nombre.' '.@$socioec->apellidoPaterno.'</td>';

                                echo '<td>'.@$referencias->nombre.' '.@$referencias->apellidoPaterno.'</td>';

                            echo '</tr>';
                        }

                    ?>
                </tbody>
            </table>
            <a href="#" class="del_evaluacion btn btn-danger pull-right">Eliminar Seleccionados</a>
        </div><!--.col-->

        <div class="col-sm-4">
            <h3>Colaboradores</h3>

            <hr />

            <label for="sel_socioeconomico">Estudio Socioecon&oacute;mico</label>
            <?php echo form_dropdown('socioeconomico', $dropdown_colaboradores, '', 'id="sel_socioeconomico" class="form-control"'); ?>

            <br />

            <label for="sel_laborales">Referencias Laborales</label>
            <?php echo form_dropdown('laborales', $dropdown_colaboradores, '', 'id="sel_laborales" class="form-control"'); ?>

            <a id="lnk_asignar_colabs" class="btn btn-success right">Asignar</a>
        </div><!--.col-->

    </div><!--.row-->

</div><!--.row-->


<script>

    jQuery(document).ready(function($){

        $('.menu-evaluaciones').addClass('active');

    });

</script>
