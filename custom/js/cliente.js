jQuery(document).ready(function($){
    
    //Agregar al grid de historial de empleos
    $('#btn_he_add').click(function(e){
        e.preventDefault();
        
        var form_id = '#frm_candidato';
        var rowID = getRowID('#tbl_he');

        var fila = {
            id: rowID,
            nombreEmpresa: inputVal(form_id, 'he_empresa'),
            telefono: inputVal(form_id, 'he_telefono'),
            puesto: inputVal(form_id, 'he_puesto'),
            salario: inputVal(form_id, 'he_salario'),
            fechaIngreso: selVal(form_id, 'fi_aa') + '-' + selVal(form_id, 'fi_mm') + '-' + selVal(form_id, 'fi_dd'),
            fechaEgreso: selVal(form_id, 'fe_aa') + '-' + selVal(form_id, 'fe_mm') + '-' + selVal(form_id, 'fe_dd'),
            nombreJefe: inputVal(form_id, 'he_jefe')
        };

        $("#tbl_he").jqGrid('addRowData', rowID, fila);

    });
    
    //Agregar al grid de historial de domicilios
    $('#btn_hd_add').click(function(e){
        e.preventDefault();
        
        var form_id = '#frm_candidato';
        var rowID = getRowID('#tbl_hd');

        var fila = {
            id:rowID, 
            calle: inputVal(form_id, 'hd_calle'), 
            cp: inputVal(form_id, 'hd_cp'), 
            numeroExt: inputVal(form_id, 'hd_numeroExt'), 
            numeroInt: inputVal(form_id, 'hd_numeroInt'), 
            estado: inputVal(form_id, 'hd_estado'), 
            ciudad: inputVal(form_id, 'hd_ciudad'), 
            colonia: inputVal(form_id, 'hd_colonia') 
        };

        $("#tbl_hd").jqGrid('addRowData', rowID, fila);
        
    });

    //Eliminar selecciones de la tabla de historial de empleos
    $("#lnk_he_del").click(function(e) {
        e.preventDefault();

        var s = $("#tbl_he").jqGrid('getGridParam','selarrrow').toString();
        var ids = s.split(',');
        var id_reg;
        var guardado;

        for(var i = 0; i < ids.length; i++){
            
            id_reg = $("#tbl_he").jqGrid('getCell', ids[i], 'id_reg');
            
            guardado = ( id_reg === undefined || id_reg === '' ) ? false : true ;
            
            //Si el elemento ya se guardo, se elimina primero de la BD
            if( guardado ){
                $.ajax({
                    url: WROOT+'empleo/del',
                    type: 'POST',
                    data: { 'id' : id_reg }
               });
            }
            
            $("#tbl_he").jqGrid('delRowData', ids[i]);
        }
    });
    
    //Eliminar selecciones de la tabla de historial de domicilios
    $("#lnk_hd_del").click(function(e) {
        e.preventDefault();

        var s = $("#tbl_hd").jqGrid('getGridParam','selarrrow').toString();
        var ids = s.split(',');
        var id_reg;
        var guardado;

        for(var i = 0; i < ids.length; i++){
            
            id_reg = $("#tbl_hd").jqGrid('getCell', ids[i], 'id_reg');
            
            guardado = ( id_reg === undefined || id_reg === '' ) ? false : true ;
            
            //Si el elemento ya se guardo, se elimina primero de la BD
            if( guardado ){
                $.ajax({
                    url: WROOT+'candidato_domicilio/del',
                    type: 'POST',
                    data: {
                        'id':id_reg
                    }
               });
            }
            
            $("#tbl_hd").jqGrid('delRowData', ids[i]);
        }
    });
    
    //Boton final del formulario para agregar un candidato
    $('#btn_add_candidato').click(function(e){
        e.preventDefault();

        if( 
            $('input[name="nombre"]').val() == "" ||
            $('input[name="apellidoPaterno"]').val() == "" ||
            $('input[name="apellidoMaterno"]').val() == "" 
         ){
            alert('Nombre y apellidos son obligatorios');
            return false;
        }

        var form_id = '#frm_candidato';
        var form = $(form_id).serialize();
        var empleos = $("#tbl_he").jqGrid('getRowData');
        var domicilios = $("#tbl_hd").jqGrid('getRowData');
        var candidato_id = $('#candidato_id').val();
        
        //Comprueba si el candidato se va a actualizar o se creara uno nuevo
        var agregar = (candidato_id === "" || candidato_id === undefined) ? true : false;
        var url = (agregar) ? WROOT+'candidato/add' : WROOT+'candidato/update';
        
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                'form':form,
                'empleos':empleos,
                'domicilios':domicilios
            }
       }).done(function(res){
           if(agregar){
               alert('Candidato Agregado');
           } else{
               alert('Perfil Actualizado');
           }
           location.reload();
       });

    });
    
    //Enlaces de la lista de candidatos
    $('.item_candidato').click(function(e){
        e.preventDefault();
        
        var item_candidato = $(this);
        
        //Marca el candidato como activo en la lista de candidatos
        $('.item_candidato').removeClass('candidatoActivo');
        $(this).addClass('candidatoActivo');
        
        //Limpia los grids
        limpiaGrid('#tbl_he');
        limpiaGrid('#tbl_hd');
        
        var id = $(this).attr('candidato_id');
        
        //Obtener los datos del candidato
        $.ajax({
            url: WROOT+'candidato/get',
            type: 'POST',
            data: { 'id':id }
        }).done(function(res){
           
            var c = $.parseJSON(res);
            var form_id = '#frm_candidato';
            
            //Modifica los botones y titulos del formulario por edicion
            $('#titulo_candidato').text('Candidato: '+c.nombre+' '+c.apellidoPaterno+' '+c.apellidoMaterno);
            
            if( item_candidato.parents('div').hasClass('c_noAsignado') || item_candidato.parents('div').hasClass('c_asignado') || item_candidato.parents('.c_lista_otros').lenght > 1 ){
                $('#btn_add_candidato').val('Actualizar Perfil');
                $('#btn_add_candidato').show();
            } else {
                $('#btn_add_candidato').hide();
            }
            
            
            $('#cliente_id').val(c.id);
            
            //Carga de los campos de texto
            setInputVal(form_id, 'nombre', c.nombre);
            setInputVal(form_id, 'curp', c.curp);
            setInputVal(form_id, 'apellidoPaterno', c.apellidoPaterno);
            setInputVal(form_id, 'apellidoMaterno', c.apellidoMaterno);
            setInputVal(form_id, 'email', c.email);
            setInputVal(form_id, 'telefono', c.telefono);
            setInputVal(form_id, 'celular', c.celular);
            setInputVal(form_id, 'seguroSocial', c.seguroSocial);
            setInputVal(form_id, 'observaciones', c.observaciones);
            setInputVal(form_id, 'puesto', c.puesto);
            setInputVal(form_id, 'sucursal', c.sucursal);
            setInputVal(form_id, 'candidato_id', c.id);

            //Carga de los campos de fecha
            var fechaNac = splitFecha(c.fechaNacimiento);
            $('select[name="fn_aa"]').val(fechaNac.aa);
            $('select[name="fn_dd"]').val(fechaNac.dd);
            $('select[name="fn_mm"]').val(fechaNac.mm);

            //Carga del jqgrid del historial de empleos
            $.ajax({
                url: WROOT+'candidato_empleo/get_by_Candidato_id',
                type: 'POST',
                data: { 'id' : c.id }
            }).done(function(res_he){
                
                var empleos = $.parseJSON(res_he);
                
                for(var i = 0; i <= empleos.length; i++){
                    
                    var e = empleos[i];
                    var rowID = $('#tbl_he').jqGrid('getGridParam', 'records') + 1;

                    var fila = {
                        id: rowID, 
                        id_reg: e.id, 
                        nombreEmpresa: e.nombreEmpresa, 
                        telefono: e.telefono, 
                        puesto: e.puesto, 
                        salario: e.salario, 
                        fechaIngreso: e.fechaIngreso, 
                        fechaEgreso: e.fechaEgreso, 
                        nombreJefe: e.nombreJefe
                    };

                    $("#tbl_he").jqGrid('addRowData', rowID, fila);
                }
                
            });/*ajax del historial empleos*/
            
            //Carga del jqgrid del historial de domicilios
            $.ajax({
                url: WROOT+'candidato_domicilio/get_by_Candidato_id',
                type: 'POST',
                data: { 'candidato_id':c.id }
            }).done(function(res_hd){
                
                var domicilios = $.parseJSON(res_hd);
                
                for(var i = 0; i <= domicilios.length; i++){
                    
                    var d = domicilios[i];
                    var rowID = $('#tbl_hd').jqGrid('getGridParam', 'records') + 1;

                    var fila = {
                        id:rowID, 
                        id_reg: d.id, 
                        calle:d.calle, 
                        cp:d.cp, 
                        numeroExt:d.numeroExt, 
                        numeroInt:d.numeroInt, 
                        estado:d.estado, 
                        ciudad:d.ciudad, 
                        colonia:d.colonia 
                    };

                    $("#tbl_hd").jqGrid('addRowData', rowID, fila);
                }
                
            });/*ajax del historial de domicilios*/
        
       });/*ajax del candidato*/
        
    });/*click - item_candidato*/
    
    $('.del_candidato').click(function(e){
       e.preventDefault();
       
       var id = $(this).attr('candidato_id');
       var parent = $(this).parent('div');
       
       $.ajax({
            url: WROOT+'evaluacion/cancelar',
            type: 'POST',
            data: { 'candidato_id':id }
        }).done(function(){
            parent.fadeOut();
            location.reload();
        });
       
    });
    
});