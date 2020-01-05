<div class="row">
    <div class="col-sm-7 bloque-izquierdo">
        <h3>Agregar / Modificar usuario</h3>

        <hr />

        <?php echo form_open("usuario/add", array("id"=>"frm_usuario")); ?>

            <br />
            <h4>Datos personales</h4>
            <div class="form-group row">
                <input type="hidden" name="id" value="" />

                <div class="col-xs-4">
                    <?php echo form_label("Nombre:").form_input( array("name" => "nombre", "class"=>"form-control") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Apellido Paterno:").form_input( array("name" => "apellidoPaterno", "class"=>"form-control") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Apellido Materno:").form_input( array("name" => "apellidoMaterno", "class"=>"form-control") ); ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-4">
                    <?php echo form_label("Email:" ).form_input( array("name" => "email", "class"=>"form-control") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Telefono:" ).form_input( array("name" => "telefono", "class"=>"form-control") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Celular:").form_input( array("name" => "celular", "class"=>"form-control") ); ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-6">
                    <?php echo form_label("Estado:" ).form_input( array("name" => "estado", "id"=>"txt_addusr_estado", "class"=>"form-control") ); ?>
                </div>

                <div class="col-xs-6">
                    <?php echo form_label("Ciudad:").form_input( array("name" => "ciudad", "id"=>"txt_addusr_ciudad", "class"=>"form-control") ); ?>
                </div>
            </div>

            <br />
            <h4>Datos de inicio de sesi&oacute;n</h4>
            <div class="form-group row">
                <div class="col-xs-6">
                    <?php echo form_label("Login:").form_input( array("name" => "login", "class"=>"form-control") ); ?>
                </div>

                <div class="col-xs-6">
                    <?php echo form_label("Password:").form_password( array("name" => "pwd", "class"=>"form-control") ); ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-6">
                    <?php echo form_label("Tipo de Cuenta:" ).form_dropdown("UsuarioTipo_id", $dropdown_tipos_usuario, '', 'class="form-control"'); ?>
                </div>
            </div>

            <?php echo form_submit(array("name" => "guardar","value"=>"Guardar", "class"=> "btn btn-success pull-right")); ?>

        <?php echo form_close(); ?>
    </div><!--.col-->

    <div class="col-sm-5">

        <h3>Usuarios registrados | <small class=""><?php echo anchor("admin/usuarios", "nuevo usuario"); ?></small></h3>

        <hr />

        <br />
        <h4>Administradores</h4>
        <?php foreach($admins as $i): ?>
            <div class="well well-sm well-lista">
                <?php echo anchor("", $i->nombre." ".$i->apellidoPaterno." ".$i->apellidoMaterno, array("usuario_id"=>$i->id, "class"=>"item_usuario" )); ?>
                <?php echo anchor("usuario/del", " ", array("usuario_id"=>$i->id, "class" => "right del_usuario" )); ?>
            </div>
        <?php endforeach; ?>

        <br />
        <!<h4>Profesores</h4>
        <?php foreach($colabs as $i): ?>
            <div class="well well-sm well-lista">
                <?php echo anchor("", $i->nombre." ".$i->apellidoPaterno." ".$i->apellidoMaterno, array("usuario_id"=>$i->id, "class"=>"item_usuario" )); ?>
                <?php echo anchor("usuario/del", " ", array("usuario_id"=>$i->id, "class" => "right del_usuario" )); ?>
            </div>
        <?php endforeach; ?>

        <br />
        <h4>Control Escolar</h4>
        <?php foreach($control_escolar as $i): ?>
            <div class="well well-sm well-lista">
                <?php echo anchor("", $i->nombre." ".$i->apellidoPaterno." ".$i->apellidoMaterno, array("usuario_id"=>$i->id, "class"=>"item_usuario" )); ?>
                <?php echo anchor("usuario/del", " ", array("usuario_id"=>$i->id, "class" => "right del_usuario" )); ?>
            </div>
        <?php endforeach; ?>

    </div><!--.col-->

</div><!--.row-->

<script>

    jQuery(document).ready(function($){

        $('.menu-usuarios').addClass('active');

    });

</script>
