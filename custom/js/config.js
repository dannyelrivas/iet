/*
 * Archivo de configuracion y funciones de proposito general
 *
 */
var WDIR = 'iet/index.php/';
//var WDIR = 'licipsa/'; //Change to '' if is on root
var WROOT = location.protocol+'//'+document.location.hostname+'/' + WDIR;

function inputVal(form_id, campo)
{
    return $('input[name="'+campo+'"]', form_id).val();
}

function setInputVal(form_id, campo, value)
{
    $('input[name="'+campo+'"]', form_id).val( value );
}

function selVal(form_id, campo)
{
    return $('select[name="'+campo+'"]', form_id).val();
}

/*
 * Separa una fecha con formato YYYY-MM-DD HH:MM:SS
 * en un array para cada valor posible y retorna un
 * array con dichos valores.
 * Funciona para fechas de tipo DATETIME
 */
function splitFechaDT(fecha)
{
    var r = new Array();
    var s = fecha.toString();

    //Separa la fecha de la hora
    var afh = s.split(' ');

    //Array que contiene la fecha;
    var af = afh[0].toString();
    var taf = af.split('-');
    r['aa'] = taf[0];
    r['mm'] = taf[1];
    r['dd'] = taf[2];

    //Array que contiene la hora;
    var ah = afh[1].toString();
    var tah = ah.split(':');
    r['hh'] = tah[0];
    r['ii'] = tah[1];
    r['ss'] = tah[2];

    return r;
}

/*
 * Separa una fecha con formato YYYY-MM-DD HH:MM:SS
 * en un array para cada valor posible y retorna un
 * array con dichos valores.
 * Funciona para fechas de tipo DATE
 */
function splitFecha(fecha)
{
    var r = new Array();
    var s = fecha.toString();
    var taf = s.split('-');

    r['aa'] = taf[0];
    r['mm'] = taf[1];
    r['dd'] = taf[2];

    return r;
}

/*
 * Limpia el jqgrid indicado
 */
function limpiaGrid(grid)
{
    // get IDs of all the rows odf jqGrid
    var rowIds = $(grid).jqGrid('getDataIDs');

    // iterate through the rows and delete each of them
    for(var i=0; i <= rowIds.length; i++){
        var currRow = rowIds[i];
        $(grid).jqGrid('delRowData', currRow);
    }
}

/*
 * Retorna el siguiente id para insersion en un jqgrid
 */
function getRowID(grid)
{
    return $(grid).jqGrid('getGridParam', 'records') + 1;
}
