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
                    <?php echo form_label("Padre o tutor 2:").form_input( array("name" => "pt2", "class"=>"form-control", "id"=>"pt2") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("Padre o tutor 3:").form_input( array("name" => "pt3", "class"=>"form-control", "id"=>"pt3") ); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-4">
                    <?php echo form_label("QR 1:").form_input( array("name" => "qr1", "class"=>"form-control", "id"=>"qr1") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("QR 2:").form_input( array("name" => "qr2", "class"=>"form-control", "id"=>"qr2") ); ?>
                </div>

                <div class="col-xs-4">
                    <?php echo form_label("QR 3:").form_input( array("name" => "qr3", "class"=>"form-control", "id"=>"qr3") ); ?>
                </div>
            </div>

            <br />

            <?php echo form_submit(array("name" => "guardar", "value"=>"Guardar", "class"=> "btn btn-success pull-right")); ?>

        <?php echo form_close(); ?>
        <div class="form-group row">
            <div class="col-xs-4">
                <meta charset="UTF-8">
                <link rel='stylesheet' href='http://iet.edufy.com.mx/qr/style.css' type='text/css'>
                <!--<button id="generarCodigo">Generar QR</button>--><a href="#" id="descargarCodigo">Descargar</a>
                <div id="codigoQR"></div>
                <script src="http://iet.edufy.com.mx/qr/jquery.min.js"></script>
                <script src="http://iet.edufy.com.mx/qr/qrcode.js"></script>
                <script src="http://iet.edufy.com.mx/qr/main.js"></script>
                <script type="text/javascript">

                var miCodigoQR = new QRCode("codigoQR");
                $(document).ready(function(){
                  $("#qr1").on("focusout",function(){
                    var cadena = $("#qr1").val();
                    if (cadena == "") {
                        alert("Ingresa un texto");
                    }else{
                      $("#descargarCodigo").css("display","inline-block");
                      miCodigoQR.makeCode(cadena);
                    }
                  });
                  $("#descargarCodigo").on("click",function(){
                    var base64 = $("#codigoQR img").attr('src');
                    $("#descargarCodigo").attr('href', base64);
                    $("#descargarCodigo").attr('download', "codigoQR");
                    $("#descargarCodigo").trigger("click");
                  });
                });
                </script>
            </div>
            <div class="col-xs-4">
                <meta charset="UTF-8">
                <link rel='stylesheet' href='http://iet.edufy.com.mx/qr/style.css' type='text/css'>
                <!--<button id="generarCodigo">Generar QR</button>--><a href="#" id="descargarCodigo2">Descargar</a>
                <div id="codigoQR2"></div>
                <script src="http://iet.edufy.com.mx/qr/jquery.min.js"></script>
                <script src="http://iet.edufy.com.mx/qr/qrcode.js"></script>
                <script src="http://iet.edufy.com.mx/qr/main.js"></script>
                <script type="text/javascript">

                var miCodigoQR2 = new QRCode("codigoQR2");
                $(document).ready(function(){
                  $("#qr2").on("focusout",function(){
                    var cadena2 = $("#qr2").val();
                    if (cadena2 == "") {
                        alert("Ingresa un texto");
                    }else{
                      $("#descargarCodigo2").css("display","inline-block");
                      miCodigoQR2.makeCode(cadena2);
                    }
                  });
                  $("#descargarCodigo2").on("click",function(){
                    var base64 = $("#codigoQR2 img").attr('src');
                    $("#descargarCodigo2").attr('href', base64);
                    $("#descargarCodigo2").attr('download', "codigoQR");
                    $("#descargarCodigo2").trigger("click");
                  });
                });
                </script>
            </div>
            <div class="col-xs-3">
                <meta charset="UTF-8">
                <link rel='stylesheet' href='http://iet.edufy.com.mx/qr/style.css' type='text/css'>
                <!--<button id="generarCodigo">Generar QR</button>--><a href="#" id="descargarCodigo3">Descargar</a>
                <div id="codigoQR3"></div>
                <script src="http://iet.edufy.com.mx/qr/jquery.min.js"></script>
                <script src="http://iet.edufy.com.mx/qr/qrcode.js"></script>
                <script src="http://iet.edufy.com.mx/qr/main.js"></script>
                <script type="text/javascript">

                var miCodigoQR3 = new QRCode("codigoQR3");
                $(document).ready(function(){
                  $("#qr3").on("focusout",function(){
                    var cadena3 = $("#qr3").val();
                    if (cadena3 == "") {
                        alert("Ingresa un texto");
                    }else{
                      $("#descargarCodigo3").css("display","inline-block");
                      miCodigoQR3.makeCode(cadena3);
                    }
                  });
                  $("#descargarCodigo3").on("click",function(){
                    var base64 = $("#codigoQR3 img").attr('src');
                    $("#descargarCodigo3").attr('href', base64);
                    $("#descargarCodigo3").attr('download', "codigoQR");
                    $("#descargarCodigo3").trigger("click");
                  });
                });
                </script>
            </div>

        </div>
    </div><!--.col-->

</div><!--.row-->

<script>
    jQuery(document).ready(function($){

        $('.menu-alumnos').addClass('active');

    });

</script>
