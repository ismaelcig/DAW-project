/**
 * Fichero que carga los textos de la web
 * en el idioma que corresponda
 */

//Al cargar el documento
$(document).ready(function(){
	//Cargamos los textos de la página
	loadStrings();
});


/**
 * Recupera los textos de un JSON con una llamada AJAX
 */
function loadStrings(){
	//Llamada que devuelve el json donde tenemos nuestros datos
	var jqxhr = $.getJSON( "common/lang.json", function() {
					//Carga la tabla
					loadTexts(jqxhr['responseJSON']);
				})
				.fail(function() {
					//Indicamos que se ha producido un error
					alert("No se han podido recuperar los idiomas.");
				})
}

/**
 * Recibe un JSON y carga los textos
 */
function loadTexts(data){
	//Recuperamos el idioma
	var lang = $('#lang').text();
	//Recorremos el array recibido
	$.each( data[lang][0], function( key, value) {
		//Colocamos value en el span correspondiente
		if(key == 'searchbar'){
			$("#searchbar").attr("placeholder", value);
		}else{
			$('span[id='+key+']').text(value);
		}
	});
}