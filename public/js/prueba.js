//Ismael Conde Iglesias

var array = null;//Almacenará los productos para realizar las diferentes operaciones

//Ejecta esta función cuando se carga el documento
$(document).ready(function(){
	//Cargamos los datos de nuestra Base de Datos
	array = getData();
	
	//Establecemos los eventos necesarios
	//$('#añadir').click(addProduct);//Evento click del botón Añadir
	//El botón #limpiar ya tiene evento por ser de tipo "reset"
	//La validación de datos se realiza al añadir
	//Los botones para eliminar se crean dinamicamente, y ya llevan el evento click
	
	$('#asd').text('Meow');
});


/**
 * Recupera los datos de la BD con una llamada AJAX
 */
function getData(){
	//Llamada que devuelve el json donde tenemos nuestros datos
	var jqxhr = $.getJSON( "common/lang.json", function() {
					//Transforma los datos recibidos en un objeto JSON más manejable
					array = parseJSON(jqxhr);
					//Carga la tabla
					loadTable(array);
					//alert(JSON.stringify(array, null, 2));
				})
				.fail(function() {
					//Indicamos que se ha producido un error
					alert("No se han podido recuperar datos");
				})
}

/**
 * Recibe un JSON y devuelve un array con los datos de la BD
 */
function parseJSON(json){
	//alert(JSON.stringify(json, null, 2));
	/* Ejemplo de lo que contiene el objeto json
	{"readyState": 4,
	"responseText": "{\r\n  \"ES\": [...",
	"responseJSON": {"ES": [{"contact": "Contacto",...}],
					 "EN": [{"contact": "Contact", ...}]},
	"status": 200,
	"statusText": "OK"}*/
	return json['responseJSON'];//Devolvemos la parte que nos interesa
}

/**
 * Recibe un objeto JSON y pinta la tabla
 */
function loadTable(data){
	var salida = '^^';//Aqui construiremos el html
	//Recuperamos el idioma
	var lang = $('#lang').text();
	//Recorremos el array recibido
	$.each( data[lang][0], function( key, value) {
		//alert(key+' -> '+JSON.stringify(value, null, 2));
		//Por cada elemento, 
		//buscamos el span en el que debemos colocarlo
		lang = $('#'+key).text(value);
		
	});
	
	// Imprimimos la tabla dentro del contenedor resultados.
	$('#asd').text(salida);
	
}