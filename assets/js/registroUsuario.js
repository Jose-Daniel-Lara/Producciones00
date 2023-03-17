

/////__________--Validacion de Registrar--___________//////

var usuario=document.getElementById("usuario");
var select=document.getElementById("select");
var correo=document.getElementById("correo");
var clave=document.getElementById("clave");
var clave2=document.getElementById("clave2");

var errorUsuario=document.getElementById("errorUsuario");
var errorSelect=document.getElementById("errorSelect");
var errorCorreo=document.getElementById("errorCorreo");
var errorClave=document.getElementById("errorClave");
var errorClave2=document.getElementById("errorClave2");
var errorContraseñas=document.getElementById("errorContraseñas");

document.getElementById("envio").addEventListener("click", e => {
	var error1=""
	var error2= ""
	var error3=""
	var error4=""
	var error5=""
	var error6=""
	var usuarioExp=/^[a-zA-Z0-9ü_]{5,9}$/;
	var claveExp=/^[a-zA-Z0-9_.+-?!#'^*$~@]{8,12}$/;
    var correoExp = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/;
    var enviar=false;
   
    errorUsuario.innerHTML ="";
    errorSelect.innerHTML="";
    errorCorreo.innerHTML ="";
    errorClave.innerHTML ="";
    errorClave2.innerHTML ="";
    errorContraseñas.innerHTML="";
 

    
	  if (!usuarioExp.test(usuario.value)) {
        e.preventDefault();
		 error1+=' <i  class="bi bi-exclamation-triangle-fill"></i> El usuario debe tener de 5-9 carácteres alfanuméricos';
		enviar = true;

	}


	if (select.value =='tipo') {
		e.preventDefault();
		 error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese un tipo de usuario';

	}

    if (!correoExp.test(correo.value)) {
        e.preventDefault();
		 error3+=' <i  class="bi bi-exclamation-triangle-fill"></i> Correo inválido';
		enviar = true;

	}
	  if (!claveExp.test(clave.value)) {
        e.preventDefault();
		 error4+=' <i  class="bi bi-exclamation-triangle-fill"></i> La contraseña debe tener de 8-12 caracteres';
		enviar = true;

	}

	if (!claveExp.test(clave2.value)) {
        e.preventDefault();
		 error5+=' <i  class="bi bi-exclamation-triangle-fill"></i> La contraseña debe tener de 8-12 caracteres';
		enviar = true;

	}

	if(clave.value != clave2.value){
        e.preventDefault();
		 error6+='<i  class="bi bi-exclamation-triangle-fill"></i> Las contraseñas no son iguales';
		 enviar = true;
	}

	if (enviar) {
        errorUsuario.innerHTML = error1
        errorSelect.innerHTML=error2
        errorCorreo.innerHTML = error3
        errorClave.innerHTML = error4
        errorClave2.innerHTML = error5
        errorContraseñas.innerHTML=error6
        
	}

	else{
		enviar = true;
	}
});


