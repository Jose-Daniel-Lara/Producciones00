
/////__________--Validacion de Control--___________//////

var selectt=document.getElementById("selectt");
var errorSelectt=document.getElementById("errorSelectt");

document.getElementById("envio").addEventListener("click", e => {
	var error2=""
    var enviar=false;
    errorSelectt.innerHTML=""


	if (selectt.value =='Eventos') {
		e.preventDefault();
		 error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el Evento';

	}
	if (enviar) {
    errorSelectt.innerHTML=error2

	}

	else{
		enviar = true;
	}
});