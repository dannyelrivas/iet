jQuery(document).ready(function($){
    
    //Autocomplete para estados
    $('#hd_estado').click(function(){
        $(this).autocomplete('search', '');
    });
    
    $('#hd_estado').autocomplete({
        source: WROOT+"estado/get_autocomplete",
        minLength: 0,
        autoFocus: true
    });	
    
    //Autocomplete para ciudades
    $('#hd_ciudad').click(function(){
        $(this).autocomplete('search', '');
    });
    
    $('#hd_ciudad').autocomplete({
        source: WROOT+"ciudad/get_autocomplete",
        minLength: 0,
        autoFocus: true
    });	
    
});