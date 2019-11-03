<div class="row">
    <div class="col-sm-12 bloque-izquierdo">
        <h3>Agregar / Modificar alumno</h3>

        <hr />

        <?php echo form_open("alumnos/add", array("id"=>"frm_alumno")); ?>

            <br />
            <h4>Datos personales</h4>
            <div class="form-group row">
                <input type="hidden" name="id" value="" />

                <div class="col-xs-4">
                    <?php echo form_label("Nombre:").form_input( array("name" => "nombre", "class"=>"form-control") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Apellido Paterno:").form_input( array("name" => "apaterno", "class"=>"form-control") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Apellido Materno:").form_input( array("name" => "amaterno", "class"=>"form-control") ); ?>
                </div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-4">
                    <?php echo form_label("Codigo:" ).form_input( array("name" => "codigoalumno", "class"=>"form-control") ); ?>
                </div>
                <div class="col-xs-4">
                    <?php echo form_label("Nivel:" ).form_input( array("name" => "nivel", "class"=>"form-control") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Grado:" ).form_input( array("name" => "grado", "class"=>"form-control") ); ?>
                </div>
                
            </div>

            <div class="form-group row">
            	<div class="col-xs-4">
                    <?php echo form_label("Grupo:").form_input( array("name" => "grupo", "class"=>"form-control") ); ?>
                </div>
                <div class="col-xs-4">
                    <?php echo form_label("Salon:").form_input( array("name" => "salon", "class"=>"form-control") ); ?>
                </div>
            </div>

            <br />
            

            <?php echo form_submit(array("name" => "guardar","value"=>"Guardar", "class"=> "btn btn-success pull-right")); ?>

        <?php echo form_close(); ?>
    </div><!--.col-->

</div><!--.row-->

<script>

    jQuery(document).ready(function($){

        $('.menu-usuarios').addClass('active');

    });

</script>
