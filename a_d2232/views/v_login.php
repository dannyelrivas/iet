<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $page_title; ?></title>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>custom/css/login.css" />
    </head>
    <body>
        <div id="container">
            <div class="c_login">
                <div class="logo"></div>
                <?php 
                    echo form_open('login/entrar')
                        .form_input( array('name' => 'login', 'class'=> 'username','placeholder'=>'Usuario') ) 
                        .form_password( array('name' => 'pwd', 'class'=> 'password','placeholder'=>'•••••••') )
                        .form_submit( array('name' => 'entrar', 'value' => 'Entrar', 'class'=> 'submit') )    
                    .form_close(); 
               
                    if( isset($validaciones) ){   
                        echo '<div class="validaciones">'
                                .$validaciones
                            .'</div>';
                    }
                    echo validation_errors('<div class="validaciones">','</div>'); 
                ?>
            </div><!--c_login-->
        </div><!--container-->
    </body>
</html>
