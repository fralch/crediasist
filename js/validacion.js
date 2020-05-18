var numeros =  /^[0-9]+$/ ;

$( "#dni" ).keyup(function() {
  var dni = $("#dni").val().length;
  var nums=  $("#dni").val().match(numeros) ? true : false;
  if (!nums && dni!=0) {
    $("#dni").val("");
    Swal.fire({
      icon: 'error',
      title: 'Ups...',
      text: 'Ingrese el numero de su DNI! ',
      footer:'Esto escribio:  '+ $("#dni").val()
      
    })
    
  }
  if (dni >8) {
    $("#dni").val("");
    Swal.fire({
      icon: 'error',
      title: 'Ups...',
      text: 'El DNI debe tener 8 digitos!',
      footer: 'Esto escribio:  '+ $("#dni").val()
    })
  }
});

