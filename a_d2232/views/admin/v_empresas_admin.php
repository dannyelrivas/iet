<div class="row">
    <div class="col-sm-7 bloque-izquierdo">
        <h3>Agregar / Modificar Empresa</h3>

        <hr />

        <?php echo form_open("empresa/add", array("id"=>"frm_empresa")); ?>

            <div class="form-group">
                <input type="hidden" name="id" value="" />
                <?php echo form_label("Raz&oacute;n Social:").form_input( array("name" => "razonSocial", "class"=>"form-control") ); ?>
            </div>

            <div class="form-group">
                <?php echo form_label("Nombre:").form_input( array("name" => "nombre", "class"=>"form-control") ); ?>
            </div>

            <div class="form-group">
                <?php echo form_label("Calle:").form_input( array("name" => "calle", "class"=>"form-control") ); ?>
            </div>

            <div class="form-group row">
                <div class="col-xs-6">
                    <?php echo form_label("No. Exterior:" ).form_input( array("name" => "numeroExt", "class"=>"form-control") ); ?>
                </div>

                <div class="col-xs-6">
                    <?php echo form_label("No. Interior:" ).form_input( array("name" => "numeroInt", "class"=>"form-control") ); ?>
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

            <div class="form-group row">
                <div class="col-xs-6">
                    <?php echo form_label("Colonia:").form_input( array("name" => "colonia", "class"=>"form-control") ); ?>
                </div>

                <div class="col-xs-6">
                    <?php echo form_label("C.P.:").form_input( array("name" => "cp", "class"=>"form-control") ); ?>
                </div>
            </div>

            <?php echo form_submit(array("name" => "guardar","value"=>"Guardar", "class"=> "btn btn-success pull-right")); ?>

        <?php echo form_close(); ?>
    </div><!--.col-->

    <div class="col-sm-5">
        <h3>Empresas | <small class=""><?php echo anchor("admin/empresas", "nueva empresa"); ?></small></h3>

        <hr />

        <?php foreach($empresas as $i): ?>
            <div class="well well-sm well-lista">
                <?php echo anchor("", $i->nombre, array( "class"=> "item_empresa", "empresa_id"=>$i->id )); ?>
                <?php echo anchor("empresa/del", " ", array( "class"=> "right del_empresa", "empresa_id"=>$i->id )); ?>
            </div>
        <?php endforeach; ?>

    </div><!--.col-->

</div><!--.row-->

<script>

    jQuery(document).ready(function($){

        $(".menu-empresas").addClass("active");

    });

</script>
