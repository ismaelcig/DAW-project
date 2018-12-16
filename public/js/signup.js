$(document).ready(function(){
	$('#regForm').submit(function(e){
	   e.preventDefault();
	   }).validate({
			rules: {
				_pass: {
					//"required", 
					minlength : 5,
				},
				_pass2: {
					//minlength : 5,
					equalTo : "#_pass"
				}
			},
			submitHandler: function(form){
				form.submit();
			}
		})/*,
		highlight: function(label) {
			$(label).closest('.control-group').addClass('error');
		},
		success: function(label) {
			label
				.text('OK!').addClass('valid')
				.closest('.control-group').addClass('success');
		}*/
});