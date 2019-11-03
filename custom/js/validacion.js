$(document).ready(function(){

    function validador( form, ok, obligatorio, numerico, email ){
        //Limpia errores previos
        $('.error_div').remove();
        $( 'input[type="text"], textarea' ).css('border-color', '#aaa');

        var error = new Array();

        for (var i in obligatorio){

            var input = $('input[name="'+i+'"]');

            if( !input.val() ){

                $( input ).css('border-color', '#ff0000');
                error.push('<span style="color:#FF0000">El campo '+obligatorio[i]+' es obligatorio.</span>');

            }

        }

        for (var i in numerico){

            var input = $('input[name="'+i+'"]');

            if( isNaN( input.val() ) ){

                $( input ).css('border-color', '#FF0000');
                error.push('<span style="color:#FF0000">El campo '+numerico[i]+' debe ser numerico.</span>');

            }

        }

        for (var i in email){

            var input = $('input[name="'+i+'"]');

            if( input.val().indexOf('@', 0) === -1 || input.val().indexOf('.', 0) === -1 ){

                $( input ).css('border-color', '#FF0000');
                error.push('<span style="color:#FF0000">El campo '+email[i]+' debe contener una dirección de correo válida.</span>');

            }

        }

        if( error.length > 0 ){

            for( var i in error ){

                $('<div class="error_div clear">'+error[i]+'</div>').appendTo(form);

            }

            return false;

        } else {

            return alert( ok );

        }

    }

    $("#frm_empresa").submit(function () {

        var obligatorio = new Array();
        var numerico = new Array();
        var email = new Array();
        var form = '#frm_empresa';
        var ok = "Tus datos han sido guardados correctamente.";

        obligatorio['razonSocial'] = 'Razon Social';
        obligatorio['nombre'] = 'Nombre';
        obligatorio['calle'] = 'Calle';
        obligatorio['numeroExt'] = 'Numero Exterior';
        obligatorio['colonia'] = 'Colonia';
        obligatorio['estado'] = 'Estado';
        obligatorio['ciudad'] = 'Ciudad';
        obligatorio['cp'] = 'Codigo Postal';
        numerico['cp'] = 'Codigo Postal';

        return validador( form, ok, obligatorio, numerico, email );

    });

    $("#frm_usuario").submit(function () {

        var obligatorio = new Array();
        var numerico = new Array();
        var email = new Array();
        var form = '#frm_usuario';
        var ok = "Tus datos han sido guardados correctamente.";

        obligatorio['nombre'] = 'Nombre';
        obligatorio['apellidoPaterno'] = 'Apellido Paterno';
        obligatorio['apellidoMaterno'] = 'Apellido Materno';
        obligatorio['estado'] = 'Estado';
        obligatorio['ciudad'] = 'Ciudad';
        obligatorio['login'] = 'Login';

        //Si no hay un id en el campo se trata de un nuevo registro, en caso contrario se trata de una actualizacion
        if( $("input[name='id']").val() == "" )
        {
            obligatorio['pwd'] = 'Password';
        }

        numerico['telefono'] = 'Telefono';
        numerico['celular'] = 'Celular';
        email['email'] = 'Email';

        return validador( form, ok, obligatorio, numerico, email );

    });

});
