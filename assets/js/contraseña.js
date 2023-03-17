
var correo=document.getElementById("correo");
var modal=document.getElementById("exampleModal");

var errorCorreo=document.getElementById("errorCorreo");

document.getElementById("envio").addEventListener("click", e => {
	var error1=""
	modal=true;
    var correoExp = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/;
    var enviar=false;
   
    errorCorreo.innerHTML =""


    if (!correoExp.test(correo.value)) {
        e.preventDefault();
		error1+='<i class="fa-solid fa-triangle-exclamation" style="color:rgb(173, 39, 39);"></i>Correo Invalido';
		modal=false;
		enviar = true;

	}


	if (enviar) {
        
        errorCorreo.innerHTML = error1
	}

	else{
		enviar = true;
		modal=false;
	}
});