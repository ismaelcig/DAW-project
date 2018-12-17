$(document).ready(function(){
	
	
	//Por cada elemento
	$('.btn-box').val(function(){
		//Referencia a los botones
		var btnAdd = $(this).find('.add-bucket');
		var btnRem = $(this).find('.rem-bucket');
		
		//Recuperamos las variables
		var bookId = $(this).find('#book_id').val();
		var bookLang = $(this).find('#book_lang').val();
		var bookPrice = $(this).find('#book_price').val();
		
		/*Añadir al carro*/
		btnAdd.click(function() {
			if(!$(this).prop('disabled')){//Si no está deshabilitado
			console.log('add-bucket');
			
				//Se añade
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
						alertText(data.msg);
						if('added'){//Si lo ha eliminado
							btnAdd.addClass('hidden');//Ocultamos "añadir"
							btnRem.removeClass('hidden');// Mostramos "eliminar"
							//Actualizamos el nº de elementos
							$('#cartAmount').text(data.newAmount);
						}
					}
				});
			}
		});
		
		/*Eliminar del carro*/
		btnRem.click(function() {
			if(!$(this).prop('disabled')){//Si no está deshabilitado
			console.log('rem-bucket');
			
				//Se elimina
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
							btnRem.addClass('hidden');//Ocultamos "eliminar"
							btnAdd.removeClass('hidden');// Mostramos "añadir"
							//Actualizamos el nº de elementos
							$('#cartAmount').text(data.newAmount);
						}
					}
				});
			}
		});
	});
	
});