jQuery(document).ready(function($){
    
    //Autocomplete para estados
    $('#txt_addusr_estado').click(function(){
        $(this).autocomplete('search', '');
    });
    
    $('#txt_addusr_estado').autocomplete({
        source: WROOT+"estado/get_autocomplete",
        minLength: 0,
        autoFocus: true
    });	
    
    //Autocomplete para ciudades
    $('#txt_addusr_ciudad').click(function(){
        $(this).autocomplete('search', '');
    });
    
    $('#txt_addusr_ciudad').autocomplete({
        source: WROOT+"ciudad/get_autocomplete",
        minLength: 0,
        autoFocus: true
    });	

    //Autocomplete de ciudades de la interfaz de reportes
    $('#txt_reportes_ciudad').click(function(){
        $(this).autocomplete('search', '');
    });
    
    $('#txt_reportes_ciudad').autocomplete({
        source: WROOT+"ciudad/get_autocomplete",
        minLength: 0,
        autoFocus: true
    });
    
    //Autocomplete de sucursales de la interfaz de reportes
    $('#txt_reportes_sucursal').click(function(){
        $(this).autocomplete('search', '');
    });
    
    $('#txt_reportes_sucursal').autocomplete({
        source: WROOT+"candidato/get_autocomplete_sucursal",
        minLength: 0,
        autoFocus: true
    });
    
});