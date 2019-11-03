jQuery(document).ready(function($){

    //Utilizado para el inline edit de los jqgrid
    var lastSel;

    //Crear el grid para el historial de empleos, el ID seleccionado debe ser una tabla
    $("#tbl_he").jqGrid({
        datatype: "local",
        height: 350,
        autowidth: true,
        colNames:['id', 'id_reg','Empresa', 'Telefono', 'Puesto', 'Jefe', 'Salario', 'Ingreso', 'Egreso'],
        colModel:[
                    {name:'id', index:'id', hidden:true},
                    {name:'id_reg', index:'id_reg', hidden:true},
                    {name:'nombreEmpresa', index:'nombreEmpresa', width:80, align:"center", editable:true},
                    {name:'telefono', index:'telefono', width:90, align:"center", editable:true},
                    {name:'puesto', index:'puesto', width:100, align:"center", editable:true},
                    {name:'nombreJefe', index:'nombreJefe', width:80, align:"center", editable:true},
                    {name:'salario', index:'salario', width:80, align:"right", editable:true},
                    {name:'fechaIngreso', index:'fechaIngreso', width:80, align:"right", editable:true},
                    {name:'fechaEgreso', index:'fechaEgreso', width:80, align:"right", editable:true}
                ],
        caption: 'Lista de Empleos',
        sortname: 'egreso',
        sortorder: 'desc',
        multiselect: true,
        onSelectRow: function(id){

            if(id && id !== lastSel){
                $('#tbl_he').restoreRow(lastSel);
                lastSel = id;
            }

            var id_reg = $("#tbl_he").jqGrid('getCell', id, 'id_reg');

            editparameters = {
                "keys" : true,
                "url" : WROOT+'candidato_empleo/update',
                "extraparam" : { "id_reg" : id_reg }
            }

            $("#tbl_he").jqGrid('editRow',id, editparameters);

          }

    });

    //Crear el grid para el historial de domicilios
    $("#tbl_hd").jqGrid({
        datatype: "local",
        height: 250,
        autowidth: true,
        colNames:['id', 'id_reg', 'Calle', 'Exterior', 'Interior', 'Colonia', 'C.P.', 'Ciudad', 'Estado'],
        colModel:[
                    {name:'id', index:'id', width:60, align:"center", hidden:true},
                    {name:'id_reg', index:'id_reg', hidden:true},
                    {name:'calle', index:'calle', width:80, align:"center", editable:true},
                    {name:'numeroExt', index:'numeroExt', width:90, align:"center", editable:true},
                    {name:'numeroInt', index:'numeroInt', width:100, align:"center", editable:true},
                    {name:'colonia', index:'colonia', width:80, align:"center", editable:true},
                    {name:'cp', index:'cp', width:80, align:"right", sorttype:"int", editable:true},
                    {name:'ciudad', index:'ciudad', width:80, align:"right", editable:true},
                    {name:'estado', index:'estado', width:80, align:"right", editable:true}
                ],
        caption: 'Lista de Domicilios',
        sortname: 'calle',
        sortorder: 'desc',
        multiselect: true,
        onSelectRow: function(id){

           if(id && id !== lastSel){
               $('#tbl_hd').restoreRow(lastSel);
               lastSel = id;
            }

            var id_reg = $("#tbl_hd").jqGrid('getCell', id, 'id_reg');

            editparameters = {
                "keys" : true,
                "url" : WROOT+'candidato_domicilio/update',
                "extraparam" : { 'id_reg' : id_reg },
                "mtype" : "POST"
            }

            $("#tbl_hd").jqGrid('editRow', id, editparameters);
          }
    });

});
