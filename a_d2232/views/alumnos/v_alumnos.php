<div class="row">
    <div class="col-sm-12 bloque-izquierdo">
        <h3>Agregar / Modificar alumno</h3>

        <?php echo form_open("alumnos/add", array("id"=>"frm_alumno")); ?>

            <br />
            <div class="row">
                <div class="col-xs-4">
                    <h4>Datos personales</h4>
                </div>
                <div class="col-xs-4">
                    <input class="form-control" type="text" placeholder="Buscar código" id="alumno_txt">
                </div>
                <div class="col-xs-2">
                    <a class="btn btn-primary" id="buscaralumno">Buscar</a>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <input type="hidden" name="id" value="" id="id_alumno" />

                <div class="col-xs-4">
                    <?php echo form_label("Nombre:").form_input( array("name" => "nombre", "class"=>"form-control", "id"=>"nombre_alumno") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Apellido Paterno:").form_input( array("name" => "apaterno", "class"=>"form-control", "id"=>"apaterno_alumno") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Apellido Materno:").form_input( array("name" => "amaterno", "class"=>"form-control", "id"=>"amaterno_alumno") ); ?>
                </div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-4">
                    <?php echo form_label("Código alumno:" ).form_input( array("name" => "codigoalumno", "class"=>"form-control", "id"=>"codigo_alumno") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Nivel:" ).form_input( array("name" => "nivel", "class"=>"form-control", "id"=>"nivel_alumno") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Grado:" ).form_input( array("name" => "grado", "class"=>"form-control", "id"=>"grado_alumno") ); ?>
                </div>

                
            </div>

            <div class="form-group row">
            	<div class="col-xs-4">
                    <?php echo form_label("Grupo:").form_input( array("name" => "grupo", "class"=>"form-control", "id"=>"grupo_alumno") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Salon:").form_input( array("name" => "salon", "class"=>"form-control", "id"=>"salon_alumno") ); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-4">
                    <?php echo form_label("Padre o tutor 1:").form_input( array("name" => "pt1", "class"=>"form-control", "id"=>"pt1") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("QR 1:").form_input( array("name" => "qr1", "class"=>"form-control", "id"=>"qr1") ); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-4">
                    <?php echo form_label("Padre o tutor 2:").form_input( array("name" => "pt2", "class"=>"form-control", "id"=>"pt2") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("QR 2:").form_input( array("name" => "qr2", "class"=>"form-control", "id"=>"qr2") ); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-4">
                    <?php echo form_label("Padre o tutor 3:").form_input( array("name" => "pt3", "class"=>"form-control", "id"=>"pt3") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("QR 3:").form_input( array("name" => "qr3", "class"=>"form-control", "id"=>"qr3") ); ?>
                </div>
            </div>
            <br />

            <?php echo form_submit(array("name" => "guardar", "value"=>"Guardar", "class"=> "btn btn-success pull-right")); ?>

        <?php echo form_close(); ?>
    </div><!--.col-->

</div><!--.row-->

<script>

    jQuery(document).ready(function($){

        $('.menu-usuarios').addClass('active');

    });

</script>
