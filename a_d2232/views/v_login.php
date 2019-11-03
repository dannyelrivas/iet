<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $page_title; ?></title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <style type="text/css">
            html,
            body {
                height: 100%;
            }
            html {
                display: table;
                margin: auto;
            }
            body {
                display: table-cell;
                vertical-align: middle;
                background: #0f426c;
            }

            #login-page {
               width: 500px;
            }

            .card {
                 position: absolute;
                 left: 50%;
                 top: 50%;
                 -moz-transform: translate(-50%, -50%)
                 -webkit-transform: translate(-50%, -50%)
                 -ms-transform: translate(-50%, -50%)
                 -o-transform: translate(-50%, -50%)
                 transform: translate(-50%, -50%);
            }
        </style>
      
    </head>
    <body>
        <div id="container">
            <div class="col s12 z-depth-6 card-panel">
                <div class="row">
                    <div class="col s6 offset-s3">
                        <img class="responsive-img" src="../custom/images/login/logo.png">
                    </div>
                </div>
                <div class="row">
                    <?php 
                        echo form_open('login/entrar')
                            .form_input( array('name' => 'login', 'class'=> 'username input-field col s12','placeholder'=>'Usuario') ) 
                            .form_password( array('name' => 'pwd', 'class'=> 'password','placeholder'=>'Contraseña') )
                            .form_submit( array('name' => 'entrar', 'value' => 'Entrar', 'class'=> 'submit btn waves-effect waves-light indigo lighten-2 col s12') )    
                        .form_close(); 
                   
                        if( isset($validaciones) ){   
                            echo '<div class="validaciones">'
                                    .$validaciones
                                .'</div>';
                        }
                        echo validation_errors('<div class="validaciones">','</div>'); 
                    ?>
                </div>
            </div><!--c_login-->
        </div><!--container-->
    </body>
</html>
