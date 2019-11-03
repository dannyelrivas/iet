<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password {
    
    /*
    * Retorna la contraseña junto con el SALT correspondiente para el login dado.
    */
    function getSalted($login, $pwd)
    {
        return sha1( md5($login) ).sha1($pwd);
    }
}