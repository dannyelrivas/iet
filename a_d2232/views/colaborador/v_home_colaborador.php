<div class="row">

    <div class="col-sm-6">
        <div class="page-header">
            <h3>Estudios socioeconomicos</h3>
        </div>
        <?php

            foreach($evals_s as $i){

                //Datos del candidato
                $c = $this->m_candidato->get( $i->Candidato_id );

                echo '<div class="well">';
                    echo anchor(
                            'colaborador/evaluar/socioeconomico/'.$i->id,
                            'Candidato: '.$c->nombre.' '.$c->apellidoPaterno.' '.$c->apellidoMaterno.' <br />Fecha de asignaci&oacute;n: '.$i->fechaAsignacion,
                            array( 'class'=> 'item_evaluacion', 'evaluacion_id'=>$i->id )
                        );
                echo '</div>';

            }

        ?>
    </div><!--.col-->

    <div class="col-sm-6">
        <div class="page-header">
            <h3>Referencias laborales</h3>
        </div>

        <?php

            foreach($evals_r as $i){

                //Datos del candidato
                $c = $this->m_candidato->get( $i->Candidato_id );

                echo '<div class="well">';
                    echo anchor(
                            'colaborador/evaluar/laborales/'.$i->id,
                            'Candidato: '.$c->nombre.' '.$c->apellidoPaterno.' '.$c->apellidoMaterno.'<br />Fecha de asignaci&oacute;n: '.$i->fechaAsignacion,
                            array( 'class'=> 'item_evaluacion', 'evaluacion_id'=>$i->id )
                        );
                echo '</div>';

            }

        ?>
    </div><!--.col-->

</div><!--.row-->
