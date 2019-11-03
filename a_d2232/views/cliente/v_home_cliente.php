<div class="row">

    <div class="col-sm-9">
        <h3>Alta de Candidato | <small class=""><?php echo anchor("cliente", "nuevo perfil"); ?></small></h3>

        <hr />
        <?php echo form_open('candidato/add', array('id'=>'frm_candidato')); ?>

        <h4>Datos personales</h4>
        <div class="form-group row">
            <input type="hidden" name="candidato_id" value="" id="candidato_id" />

            <div class="col-sm-6">
                <?php echo form_label("Nombre(s):", "nombre").form_input(array("name" => "nombre", "class" => "form-control")); ?>
            </div>

            <div class="col-sm-3">
                <?php echo form_label("Apellido Paterno:","apellidoPaterno").form_input(array("name" => "apellidoPaterno", "class" => "form-control")); ?>
            </div>

            <div class="col-sm-3">
                <?php echo form_label("Apellido Materno:","apellidoMaterno").form_input(array("name" => "apellidoMaterno", "class" => "form-control")); ?>
            </div>
        </div>

        <div class="form-group row">

            <div class="col-sm-6">
                <label class="clear">Fecha de nacimiento:</label>
                <br />
                <div class="col-xs-3"><?php echo form_dropdown('fn_dd', $this->fechas->arrayDay(), date('d'), 'class="form-control"'); ?></div>
                <div class="col-xs-5"><?php echo form_dropdown('fn_mm', $this->fechas->arrayMonth(), date('m'), 'class="form-control"'); ?></div>
                <div class="col-xs-4"><?php echo form_dropdown('fn_aa', $this->fechas->arrayYear(), date('Y'), 'class="form-control"'); ?></div>
            </div>

            <div class="col-sm-3">
                <?php echo form_label("CURP:", "curp").form_input(array("name" => "curp", "class" => "form-control")); ?>
            </div>

            <div class="col-sm-3">
                <?php echo form_label("NSS:","seguroSocial").form_input(array("name" => "seguroSocial", "class" => "form-control")); ?>
            </div>

        </div>

        <div class="form-group">
            <?php echo form_label("Observaciones:","observaciones").form_textarea(array("name" => "observaciones", "class" => "form-control", "rows" => "3")); ?>
        </div>

        <br />
        <h4>Vacante</h4>
        <div class="form-group row">
            <div class="col-sm-6"><?php echo form_label("Puesto:","puesto").form_input(array("name" => "puesto", "class" => "form-control")); ?></div>
            <div class="col-sm-6"><?php echo form_label("Sucursal:","sucursal").form_input(array("name" => "sucursal", "class" => "form-control")); ?></div>
        </div>

        <br />
        <div class="row">
          <div class="col-sm-6">
              <h4>Agregar empleo</h4>

              <div class="form-group row">

                <div class="col-sm-6">
                  <?php echo form_label('Empresa:','he_empresa').form_input(array("name" => "he_empresa", "class" => "form-control")); ?>
                </div>
                <div class="col-sm-6">
                  <?php echo form_label('Tel&eacute;fono:','he_telefono').form_input(array("name" => "he_telefono", "class" => "form-control")); ?>
                </div>

              </div>

              <div class="form-group row">

                <div class="col-sm-6">
                  <?php echo form_label('Puesto:','he_puesto').form_input(array("name" => "he_puesto", "class" => "form-control")); ?>
                </div>
                <div class="col-sm-6">
                  <?php echo form_label('Salario:','he_salario').form_input(array("name" => "he_salario", "class" => "form-control")); ?>
                </div>

              </div>

              <div class="form-group">
                <?php echo form_label('Jefe directo:','he_jefe').form_input(array("name" => "he_jefe", "class" => "form-control")); ?>
              </div>

              <div class="col-xs-12 row">
                  <label class="clear">Ingreso:</label>
                  <br />
                  <div class="col-xs-3"><?php echo form_dropdown('fi_dd', $this->fechas->arrayDay(), date('d'), 'class="form-control"'); ?></div>
                  <div class="col-xs-6"><?php echo form_dropdown('fi_mm', $this->fechas->arrayMonth(), date('m'), 'class="form-control"'); ?></div>
                  <div class="col-xs-3"><?php echo form_dropdown('fi_aa', $this->fechas->arrayYear(), date('Y'), 'class="form-control"'); ?></div>
              </div>

              <div class="col-xs-12 row">
                  <label class="clear">Egreso:</label>
                  <br />
                  <div class="col-xs-3"><?php echo form_dropdown('fe_dd', $this->fechas->arrayDay(), date('d'), 'class="form-control"'); ?></div>
                  <div class="col-xs-6"><?php echo form_dropdown('fe_mm', $this->fechas->arrayMonth(), date('m'), 'class="form-control"'); ?></div>
                  <div class="col-xs-3"><?php echo form_dropdown('fe_aa', $this->fechas->arrayYear(), date('Y'), 'class="form-control"'); ?></div>
              </div>

              <?php echo form_button(array('id'=>'btn_he_add', 'content'=>'Agregar Empleo', 'class'=>'btn btn-success pull-right')); ?>

          </div><!--.col-->

          <div class="col-sm-6">
            <?php
                /*
                 * Tabla del historia de empleos (_he)
                 */
                echo $tbl_he;
                echo anchor('#', 'Borrar Seleccionados',array('id'=>'lnk_he_del', "class"=>"label label-danger pull-right"));
            ?>
          </div><!--.col-->

        </div><!--.row-->


        <br />
        <br />
        <br />
        <div class="row">
          <div class="col-sm-6">
              <h4>Agregar domicilio</h4>

              <div class="form-group row">

                <div class="col-sm-4">
                  <?php echo form_label('Calle:','hd_calle').form_input(array("name" => "hd_calle", "class" => "form-control")); ?>
                </div>

                <div class="col-sm-4">
                  <?php echo form_label('Numero Exterior:','hd_numeroExt').form_input(array("name" => "hd_numeroExt", "class" => "form-control")); ?>
                </div>

                <div class="col-sm-4">
                  <?php echo form_label('Numero Interior:','hd_numeroInt').form_input(array("name" => "hd_numeroInt", "class" => "form-control")); ?>
                </div>
              </div>

              <div class="form-group row">

                <div class="col-sm-6">
                  <?php echo form_label('Estado:','hd_estado').form_input(array("name" => "hd_estado", "class" => "form-control")); ?>
                </div>
                <div class="col-sm-6">
                  <?php echo form_label('Ciudad:','hd_ciudad').form_input(array("name" => "hd_ciudad", "class" => "form-control")); ?>
                </div>

              </div>

              <div class="form-group row">

                <div class="col-sm-6">
                  <?php echo form_label('C&oacute;digo Postal:','hd_cp').form_input(array("name" => "hd_cp", "class" => "form-control")); ?>
                </div>

                <div class="col-sm-6">
                  <?php echo form_label('Colonia:','hd_colonia').form_input(array("name" => "hd_colonia", "class" => "form-control")); ?>
                </div>

              </div>

              <?php echo form_button(array('id'=>'btn_hd_add', 'content'=>'Agregar Domicilio', 'class'=>'btn btn-success pull-right')); ?>

          </div><!--.col-->

          <div class="col-sm-6">
            <?php
                /*
                 * Tabla del historia de empleos (_he)
                 */
                echo $tbl_hd;
                echo anchor('#', 'Borrar Seleccionados',array('id'=>'lnk_hd_del', "class"=>"label label-danger pull-right"));
            ?>
          </div><!--.col-->

        </div><!--.row-->

        <h4>Datos de contacto</h4>
        <div class="form-group row">

          <div class="col-sm-6">
            <?php echo form_label('Telefono:','telefono').form_input(array("name" => "telefono", "class" => "form-control")); ?>
          </div>

          <div class="col-sm-6">
            <?php echo form_label('Celular:','celular').form_input(array("name" => "celular", "class" => "form-control")); ?>
          </div>

        </div>

        <div class="form-group">
          <?php echo form_label('Email:','email').form_input(array("name" => "email", "class" => "form-control")); ?>
          <?php echo form_hidden('Cliente_id', $cliente->id); ?>
        </div>

        <?php echo form_submit(array('id'=>'btn_add_candidato', 'name' => 'enviar', 'value'=>'Agregar Perfil', 'class'=>'btn btn-success pull-right')); ?>

        <?php form_close(); ?>
    </div><!--.col-->

    <div class="col-sm-3">

        <h3>Mis Candidatos</h3>

        <hr />

        <div id="c_lista">
            <?php

                foreach($candidatos as $c){

                    if( isset($c->evaluacion->estado) ){
                        switch ($c->evaluacion->estado){
                            case 'NO ASIGNADO': $clase = 'c_noAsignado'; break;
                            case 'ASIGNADO': $clase = 'c_asignado'; break;
                            case 'VIABLE': $clase = 'c_viable'; break;
                            case 'CON RESERVAS': $clase = 'c_conReservas'; break;
                            case 'NO VIABLE': $clase = 'c_noViable'; break;
                            case 'CANCELADO': $clase = 'c_cancelado'; break;
                            default: $clase = 'c_noAsignado'; break;
                        }

                        echo '<div class="'.$clase.'">';
                            echo anchor('', $c->nombre.' '.$c->apellidoPaterno.' '.$c->apellidoMaterno, array( 'class'=> 'block left item_candidato', 'candidato_id'=>$c->id ));

                            if( $clase != 'c_cancelado' && $clase != 'c_viable' && $clase != 'c_conReservas' && $clase != 'c_noViable' ){
                                echo anchor('candidato/cancelar', ' ', array( 'class'=> 'block right del_candidato', 'candidato_id'=>$c->id ));
                            }

                            if( !empty( $c->evaluacion->referenciasXLS ) || !empty( $c->evaluacion->referenciasPDF ) || !empty( $c->evaluacion->socioeconomicoXLS ) || !empty( $c->evaluacion->socioeconomicoPDF ) ){
                                echo '<hr class="clear" style="margin-top:25px;" />';
                            }

                            if( !empty( $c->evaluacion->referenciasXLS ) && !empty( $c->evaluacion->referenciasPDF ) ){

                                echo '<p style="margin:0;" class="clear">Referencias Laborales:';

                                if( !empty( $c->evaluacion->referenciasXLS ) ) {
                                        echo anchor(base_url().'uploads/'.$c->evaluacion->referenciasXLS, ' ', array( 'class'=> 'block right item_xls' ) );
                                    }

                                    if( !empty( $c->evaluacion->referenciasPDF ) ){
                                        echo anchor(base_url().'uploads/'.$c->evaluacion->referenciasPDF, ' ', array( 'class'=> 'block right item_pdf' ) );
                                    }

                                echo '</p>';

                            }
                            if( !empty( $c->evaluacion->socioeconomicoXLS ) || !empty( $c->evaluacion->socioeconomicoPDF ) ){

                                echo '<p style="margin:0;margin-top:10px;">Estudio Socioecon&oacute;mico:';

                                    if( !empty( $c->evaluacion->socioeconomicoXLS ) ){
                                        echo anchor(base_url().'uploads/'.$c->evaluacion->socioeconomicoXLS, ' ', array( 'class'=> 'block right item_xls' ) );
                                    }

                                    if( !empty( $c->evaluacion->socioeconomicoPDF ) ){
                                        echo anchor(base_url().'uploads/'.$c->evaluacion->socioeconomicoPDF, ' ', array( 'class'=> 'block right item_pdf' ) );
                                    }

                                echo '</p>';

                            }

                        echo '</div>';
                    }

                }

            ?>
        </div><!--c_lista-->

        <h3>Otros Candidatos</h3>
        <div id="c_lista" class="c_lista_otros">
            <?php
                $nCandidatos = count($candidatos_otros);

                for($i = 0; $i < $nCandidatos; $i++){

                    foreach($candidatos_otros[$i] as $c){

                        if( isset($c->evaluacion->estado) ){
                            switch ($c->evaluacion->estado){
                                case 'NO ASIGNADO': $clase = 'c_noAsignado'; break;
                                case 'ASIGNADO': $clase = 'c_asignado'; break;
                                case 'VIABLE': $clase = 'c_viable'; break;
                                case 'CON RESERVAS': $clase = 'c_conReservas'; break;
                                case 'NO VIABLE': $clase = 'c_noViable'; break;
                                case 'CANCELADO': $clase = 'c_cancelado'; break;
                                default: $clase = 'c_noAsignado'; break;
                            }

                            echo '<div class="'.$clase.'">';
                            echo anchor('', $c->nombre.' '.$c->apellidoPaterno.' '.$c->apellidoMaterno, array( 'class'=> 'block left item_candidato', 'candidato_id'=>$c->id ));

                            echo '<hr class="clear" style="margin-top:25px;" />';


                            if( !empty( $c->evaluacion->referenciasXLS ) && !empty( $c->evaluacion->referenciasPDF ) ){

                                echo '<p style="margin:0;">Referencias Laborales:';
                                    if( !empty( $c->evaluacion->referenciasXLS ) ) echo anchor(base_url().'uploads/'.$c->evaluacion->referenciasXLS, ' ', array( 'class'=> 'block right item_xls' ) );
                                    if( !empty( $c->evaluacion->referenciasPDF ) ) echo anchor(base_url().'uploads/'.$c->evaluacion->referenciasPDF, ' ', array( 'class'=> 'block right item_pdf' ) );
                                echo '</p>';

                            }

                            if( !empty( $c->evaluacion->socioeconomicoXLS ) && !empty( $c->evaluacion->socioeconomicoPDF ) ){

                                echo '<p style="margin:0;">Estudio Socioecon&oacute;mico:';
                                    if( !empty( $c->evaluacion->socioeconomicoXLS ) ) echo anchor(base_url().'uploads/'.$c->evaluacion->socioeconomicoXLS, ' ', array( 'class'=> 'block right item_xls' ) );
                                    if( !empty( $c->evaluacion->socioeconomicoPDF ) ) echo anchor(base_url().'uploads/'.$c->evaluacion->socioeconomicoPDF, ' ', array( 'class'=> 'block right item_pdf' ) );
                                echo '</p>';

                            }
                        echo '</div>';
                        }

                    }

                }

            ?>
        </div><!--c_lista-->

        <hr />
        <h4>Simbolog&iacute;a</h4>
        <div id="candidatos_simbologia">
            <div class="c_noAsignado">No Asignado</div>
            <div class="c_asignado">Asignado</div>
            <div class="c_viable">Viable</div>
            <div class="c_conReservas">Con Reservas</div>
            <div class="c_noViable">No Viable</div>
            <div class="c_cancelado">Cancelado</div>
        </div><!--candidatos_simbologia-->
    </div><!--.col-->

</div><!--.row-->
