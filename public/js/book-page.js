$(document).ready(function() {
	/**/
	var nInitialChars = 550; //Intial characters to display
	var fullText = $('.synopsis').text();//Texto completo
	var widthCambio = 975;//Breakpoint de css

    if (fullText.length > nInitialChars) {
		//Texto corto
		var sText = fullText.substr(0, nInitialChars);
		//Resto del texto
		var eText = fullText.substr(nInitialChars, fullText.length - nInitialChars);
		
		//En resoluciones pequeñas ya se muestra el texto completo
		if($(window).width() >=widthCambio){
			//Ponemos el texto corto
			$('.synopsis').text(sText + '...');
		}
		//Añadimos evento para cambiar entre uno y otro
		$('.more-less').click(changeMoreLess);
		
		
		
		function changeMoreLess(){
			//Comprobamos si existe
			if ($('#readMore').length){
				//Cambiamos el botón
				$('#readMore').attr('id', 'readLess');
				loadStrings('readLess');
				//Cambiamos el texto
				$('.synopsis').text(sText + eText);
			}
			else{
				//Cambiamos el botón
				$('#readLess').attr('id', 'readMore');
				loadStrings('readMore');
				//Cambiamos el texto
				$('.synopsis').text(sText + '...');
			}
		}
    }
	else{//Si el texto es corto
		$('.more-less').hide();//Ocultamos el "Leer más..."
	}
	
	
	
	
	
	/*Evento al redimensionar la ventana*/
	var resizeTimer;
	$(window).on('resize', function(){
		//Para que sólo se llame una vez al evento
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function() {//Lo que hace realmente el evento
			
			var win = $(this); //this = window
			//Al agrandar la ventana
			if (win.width() >= widthCambio) {
				//Nos aseguramos que el botón dice lo que debe
				if ($('#readMore').length){//Si existe
					$('#readMore').attr('id', 'readLess');
					loadStrings('readLess');
				}
			}
			//Al encogerla
			else{//Nos aseguramos de que se muestra todo el texto
				$('.synopsis').text(fullText);
			}
			
		}, 150);
		
	});
	
	
	
	
	
	/*Añadir a cesta*/
	//Comprobamos que no esté deshabilitado
	if(!$('.add-bucket').prop('disabled')){
		$('.add-bucket').click(function() {
			console.log('add-bucket');
			//Recuperamos las variables
			var bookId = $('#book_id').val();
			var bookLang = $('#book_lang').val();
			var bookPrice = $('#book_price').val();
			
			//Lo añadimos
			$.ajax({
				type: "POST",
				url: "common/includes/book-functions.php",
				dataType: 'json',
				data: {
					action: 'add-bucket',
					book_id: bookId,
					book_lang: bookLang,
					book_price: bookPrice
				}
			}).done(function(data) {
				console.log('done');
				if('' != data.msg){
					console.log(data);
					alertText(data.msg);
					if('added'){//Si lo ha añadido
						$('.add-bucket').addClass('hidden');//Ocultamos "añadir"
						$('.rem-bucket').removeClass('hidden');// Mostramos "eliminar"
						//Actualizamos el nº de elementos
						$('#cartAmount').text(data.newAmount);
					}
				}
			});
		});
	}
	/*Eliminar de la cesta*/
	//Comprobamos que no esté deshabilitado
	if(!$('.rem-bucket').prop('disabled')){
		$('.rem-bucket').click(function() {
			console.log('rem-bucket');
			//Recuperamos las variables
			var bookId = $('#book_id').val();
			var bookLang = $('#book_lang').val();
			
			//Hacemos cositas
			$.ajax({
				type: "POST",
				url: "common/includes/book-functions.php",
				dataType: 'json',
				data: {
					action: 'rem-bucket',
					book_id: bookId,
					book_lang: bookLang
				}
			}).done(function(data) {
				console.log('done');
				if('' != data.msg){
					alertText(data.msg);
					if('removed'){//Si lo ha eliminado
						$('.rem-bucket').addClass('hidden');//Ocultamos "eliminar"
						$('.add-bucket').removeClass('hidden');// Mostramos "añadir"
						//Actualizamos el nº de elementos
						$('#cartAmount').text(data.newAmount);
					}
				}
			});
		});
	}
	
	
	
	
	/*Añadir a favoritos*/
	$('.add-wish').click(function() {
		console.log('add-wish');
		//Recuperamos las variables
		var bookId = $('#book_id').val();
		var bookLang = $('#book_lang').val();
		
		//Se añade
		$.ajax({
			type: "POST",
			url: "common/includes/book-functions.php",
			dataType: 'json',
			data: {
				action: 'add-wish',
				book_id: bookId,
				book_lang: bookLang
			}
		}).done(function(data) {
			console.log('done');
			if('' != data.msg){
				alertText(data.msg);
				if('faved'){//Si lo ha añadido
					$('.add-wish').addClass('hidden');//Ocultamos "añadir"
					$('.rem-wish').removeClass('hidden');// Mostramos "eliminar"
				}
			}
		});
	});
	/*Eliminar de favoritos*/
	$('.rem-wish').click(function() {
		console.log('rem-wish');
		//Recuperamos las variables
		var bookId = $('#book_id').val();
		var bookLang = $('#book_lang').val();
		
		//Se elimina
		$.ajax({
			type: "POST",
			url: "common/includes/book-functions.php",
			dataType: 'json',
			data: {
				action: 'rem-wish',
				book_id: bookId,
				book_lang: bookLang
			}
		}).done(function(data) {
			console.log('done');
			if('' != data.msg){
				alertText(data.msg);
				if('unfaved'){//Si lo ha eliminadp
					$('.rem-wish').addClass('hidden');//Ocultamos "eliminar"
					$('.add-wish').removeClass('hidden');// Mostramos "añadir"
				}
			}
		});
	});
  
});