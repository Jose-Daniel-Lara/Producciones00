/////__________--Validacion de Usuario--___________//////


var usuario=document.getElementById("usuario");
var clave=document.getElementById("clave");

var errorUsuario=document.getElementById("errorUsuario");
var errorClave=document.getElementById("errorClave");

document.getElementById("envio").addEventListener("click", e => {
	var error1=""
	var error2= ""
    var enviar=false;
   
    errorUsuario.innerHTML ="";
    errorClave.innerHTML ="";


	if(usuario.value.length < 1){
        e.preventDefault();
		error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el usuario';
		enviar = true;
	
	}

	if(clave.value.length < 1){
        e.preventDefault();
		error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la contraseña';
		enviar = true;
	}

	if (enviar) {
        errorUsuario.innerHTML = error1
        errorClave.innerHTML = error2
	}

	else{
		enviar = true;
        validarUsuario();
        e.preventDefault();
	}
});