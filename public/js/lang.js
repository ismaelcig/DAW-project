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
 * Si display == true, muestra el texto mediante un alert()
 */
function loadStrings(id, display = false){
	//Llamada que devuelve el json donde tenemos nuestros datos
	var jqxhr = $.getJSON( "common/lang.json", function() {
					//Recuperamos el idioma
					var lang = $('#lang').text();
					if(!display){
						if(null == id)//Carga todo
							loadTexts(jqxhr['responseJSON'][lang][0]);
						else//Carga sólo este
							loadText(id, jqxhr['responseJSON'][lang][0]);
					}
					else{//Devolvemos el valor solicitado
						alert(jqxhr['responseJSON'][lang][0][id]);
					}
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
		//Colocamos value en el elemento correspondiente
		if(key.indexOf('_') != -1){//Si contiene _ es un placeholder
			$('[name='+key+']').attr("placeholder", value);
		}else{//Sino, un span
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

/**
 * Muestra un texto mediante alert
 */
function alertText(id){
	loadStrings(id,true);
}