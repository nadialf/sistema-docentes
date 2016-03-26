$(document).ready(function(){
	console.log("Iniciando Sitio");

	$("#form").validate({		//id en jQuery se especifica anteponiendo #
		rules: {
			titulo: {
				required: true,
				alphas: true
			},
			sinopsis: {
				required: true,
				alphas: true
			},
			genero: {
				required: true,
				alphas: true
			},
			calificacion: {
				required: true,
				numbers: true
			},
			price: {
				required: true,
				precio: true
			}/*,
			userfile: {
				required: true
			}*/
		},

		/*messages: {
			nombre: "Ingrese su nombre.",
			edad: "Ingrese su edad."
		},*/

		submitHandler: function(form){
			form.submit();
		},

		highlight: function(element){
			$(element).parent().removeClass('has-success').addClass('has-error'); 
		},

		success: function(element){
			$(element).parent().removeClass('has-error').addClass('has-success'); 
		}
	});

	jQuery.validator.addMethod("alphas", function(value, element) {
  // allow any non-whitespace characters as the host part
  return this.optional( element ) || /^[a-zA-Z\s]+$/.test( value );
}, 'Sólo caracteres.');

	jQuery.validator.addMethod("numbers", function(value, element) {
  // allow any non-whitespace characters as the host part
  return this.optional( element ) || /^[1-9]+$/.test( value );
}, 'Solo numeros.');

	jQuery.validator.addMethod("precio", function(value, element) {
  // allow any non-whitespace characters as the host part
  return this.optional( element ) || /^[0-9.]+$/.test( value );
}, ' Formato HH:MM.');

	$("#guardar").prop('disabled', 'disabled');

	$("#form").on('keyup blur', function(){ //Evento cada que se presione una tecla o posición
		if ($("#form").valid()){
			//Habilitamos
			$("#guardar").prop('disabled', false);
		}else{
			//Deshabilitado
			$("#guardar").prop('disabled', 'disabled');
		}
	});


});