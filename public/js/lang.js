/**
 * Fichero que carga los textos de la web
 * en el idioma que corresponda
 */

//Al cargar el documento
$(document).ready(function(){
	//Cargamos los textos de la página
	loadStrings(null);
});


/**
 * Recupera los textos de un JSON con una llamada AJAX
 * Si recibe un id, carga únicamente ese texto
 * Sino, carga todos los de la página
 */
function loadStrings(id){
	//Llamada que devuelve el json donde tenemos nuestros datos
	var jqxhr = $.getJSON( "common/lang.json", function() {
					//Recuperamos el idioma
					var lang = $('#lang').text();
					if(null == id)//Carga todo
						loadTexts(jqxhr['responseJSON'][lang][0]);
					else//Carga sólo este
						loadText(id, jqxhr['responseJSON'][lang][0]);
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
	//Recorremos el array recibido
	$.each( data, function( key, value) {
		//Colocamos value en el span correspondiente
		if(key == 'searchbar'){
			$("#searchbar").attr("placeholder", value);
		}else{
			$('span[id='+key+']').text(value);
		}
	});
}

/**
 * Carga un texto específico
 */
function loadText(id, data){
	$('span[id='+id+']').text(data[id]);
}