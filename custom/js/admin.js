jQuery(document).ready(function($){

   $(".fancybox").fancybox({
       'width'             : '1150px',
       'height'            : '100%',
       'autoScale'         : true,
       'type'              : 'iframe'
   });

   /*
    * Boton para Asignar colaboradores de solicitudes no asignadas
    */
   $('#lnk_asignar_colabs').click(function(e){
       e.preventDefault();

       var colaborador_s_id = $('#sel_socioeconomico').val();
       var colaborador_r_id = $('#sel_laborales').val();

       $('.id_eval:checked').each(function(){

          var evaluacion_id = $(this).val();

          $.ajax({
                url: WROOT+'evaluacion/asignar',
                type: 'POST',
                data: {
                    'evaluacion_id' : evaluacion_id,
                    'colaborador_s_id' : colaborador_s_id,
                    'colaborador_r_id' : colaborador_r_id
                }
           });

       });

       alert( 'Evaluacion Actualizada' );
       location.reload();

   });

   /*
    * Boton para eliminar usuario
    */
   $('.del_usuario').click(function(e){
       e.preventDefault();

       var id = $(this).attr('usuario_id');
	   if(id==13){
			alert("Lo sentimos, este usuario no puede ser eliminado.");
	   }
		else{
			var parent = $(this).parent('div');
			var div = $('<div>Estas seguro que deseas eliminar la cuenta?</div>');
			div.dialog({
				title: "Confirmacion",
				buttons: [
							{
								text: "Si",
								click: function () {


									$.ajax({
										url: WROOT+'usuario/del',
										type: 'POST',
										data: { 'id':id }
									}).done(function(){
										parent.fadeOut();
										div.dialog("close");
									});
								}
							},
							{
								text: "No",
								click: function () {
									div.dialog("close");
								}
							}
						]
			});
		}

    });

    /*
    * Boton para eliminar empresa
    */
   $('.del_empresa').click(function(e){
       e.preventDefault();

       var id = $(this).attr('empresa_id');
       var parent = $(this).parent('div');
	   var div = $('<div>Estas seguro que deseas eliminar esta empresa?</div>');
		div.dialog({
			title: "Confirmacion",
			buttons: [
						{
							text: "Si",
							click: function () {


								$.ajax({
									url: WROOT+'empresa/del',
									type: 'POST',
									data: { 'id':id }
								}).done(function(){
									parent.fadeOut();
									div.dialog("close");
								});
							}
						},
						{
							text: "No",
							click: function () {
								div.dialog("close");
							}
						}
					]
		});

    });

    /*
     * Eliminar evaluaciones
     */
    $('.del_evaluacion').click(function(e){
        e.preventDefault();

        $('.id_eval:checked').each(function(){

            var evaluacion_id = $(this).val();
            var parent = $(this).parents('tr');
			var div = $('<div>Estas seguro que deseas eliminar esta evaluacion?</div>');
			div.dialog({
				title: "Confirmacion",
				buttons: [
							{
								text: "Si",
								click: function () {


									$.ajax({
										 url: WROOT+'evaluacion/del',
										 type: 'POST',
										 data: { 'id':evaluacion_id }
									 }).done(function(){
										 parent.fadeOut();
										 div.dialog("close");
									 });
								}
							},
							{
								text: "No",
								click: function () {
									div.dialog("close");
								}
							}
						]
			});


       });

    });

   /*
    * Habilita y dehabilita el select de empresas segun el tipo de usuario
    */
   $('select[name="Empresa_id"]').attr('disabled', 'true');
   $('select[name="UsuarioTipo_id"]').change(function(){

       var tipo = $('select[name="UsuarioTipo_id"] option:selected').text();

       switch( tipo ){

           case 'CLIENTE':
               $('select[name="Empresa_id"]').removeAttr('disabled');
               break;

           default:
               $('select[name="Empresa_id"]').attr('disabled', 'true');
               break;
       }

   });


    $('.item_usuario').click(function(e){
        e.preventDefault();

        var id = $(this).attr('usuario_id');

        $.ajax({
            url: WROOT+'usuario/get_json',
            type: 'POST',
            data: { 'id':id }
        }).done(function(res){

           var u = $.parseJSON(res);
           var form_id = '#frm_usuario';

           setInputVal(form_id, 'id', u.id);
           setInputVal(form_id, 'nombre', u.nombre);
           setInputVal(form_id, 'apellidoPaterno', u.apellidoPaterno);
           setInputVal(form_id, 'apellidoMaterno', u.apellidoMaterno);
           setInputVal(form_id, 'estado', u.estado);
           setInputVal(form_id, 'ciudad', u.ciudad);
           setInputVal(form_id, 'telefono', u.telefono);
           setInputVal(form_id, 'celular', u.celular);
           setInputVal(form_id, 'login', u.login);
        //    setInputVal(form_id, 'pwd', u.password);
           setInputVal(form_id, 'email', u.email);
           $("option:selected", $('select[name="tipo_usuario"]')).text(u.tipo)

       });

    });

    $('.item_empresa').click(function(e){
        e.preventDefault();

        var id = $(this).attr('empresa_id');

        $.ajax({
            url: WROOT+'empresa/get_json',
            type: 'POST',
            data: { 'id' : id }
       }).done(function(res){

           var em = $.parseJSON(res);
           var form_id = '#frm_empresa';

           setInputVal(form_id, 'id', em.id);
           setInputVal(form_id, 'razonSocial', em.razonSocial);
           setInputVal(form_id, 'nombre', em.nombre);
           setInputVal(form_id, 'calle', em.calle);
           setInputVal(form_id, 'numeroExt', em.numeroExt);
           setInputVal(form_id, 'numeroInt', em.numeroInt);
           setInputVal(form_id, 'colonia', em.colonia);
           setInputVal(form_id, 'ciudad', em.ciudad);
           setInputVal(form_id, 'estado', em.estado);
           setInputVal(form_id, 'cp', em.cp);

       });

    });

});
