<?php
    $config = array(
        'login/entrar' => array(
            array(
                    'field' => 'login',
                    'label' => 'Usuario',
                    'rules' => 'trim|xss_clean'
                 ),
            array(
                    'field' => 'pwd',
                    'label' => 'Password',
                    'rules' => 'trim|xss_clean'
                 )
        )
    );
?>
