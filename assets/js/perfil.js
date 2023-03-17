/////__________--Validacion de Editar Perfil--___________//////
var usuario=document.getElementById("usuario");
var correo=document.getElementById("correo");

var errorUsuario=document.getElementById("errorUsuario");
var errorCorreo=document.getElementById("errorCorreo");

document.getElementById("envio").addEventListener("click", e => {
	var error1=""
	var error3=""
	var usuarioExp=/^[a-zA-Z0-9ü_]{5,9}$/;
    var correoExp = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/;
    var enviar=false;
    errorImg.innerHTML ="";
    errorUsuario.innerHTML ="";
    errorCorreo.innerHTML ="";
   
    

	if (!usuarioExp.test(usuario.value)) {
        e.preventDefault();
		 error1+=' <i  class="bi bi-exclamation-triangle-fill"></i> El usuario debe tener de 5-9 carácteres alfanuméricos';
		enviar = true;

	}

    if (!correoExp.test(correo.value)) {
        e.preventDefault();
		 error3+=' <i  class="bi bi-exclamation-triangle-fill"></i> Correo inválido';
		enviar = true;

	}

	  
	if (enviar) {
        errorUsuario.innerHTML = error1
        errorCorreo.innerHTML = error3
        errorImg.innerHTML=error4
     
	}

	else{
		enviar = true;
		enviarArchivos();
    e.preventDefault();
	}
});

//-----------FUNCIÓN AJAX ----------------------------

function enviarArchivos(){
    let formulario= new FormData($('#editarP')[0]);
    console.log(formulario);
    $.ajax({
        url: '',
        method: 'POST',
        dataType: 'json',
        data:formulario,
        processData: false, 
        contentType: false,
        success(data){
          console.log(data);
            Swal.fire({
                toast: true,
                position: 'top-end',
                title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" > <p class="fw-bold p-1 mt-2" style="color:#c79b2d!important;font-size:20px;"><b>Perfil Editado!</b></p><div>',
                showConfirmButton:false,
                timer:2500,
                timerProgressBar:true,
            });
        }
    })
}


/////__________--Validacion cambio de contraseña--___________//////
var claveV=document.getElementById("claveV");
var clave=document.getElementById("clave");
var clave2=document.getElementById("clave2");


var errorClaveV=document.getElementById("errorClaveV");
var errorClave=document.getElementById("errorClave");
var errorClave2=document.getElementById("errorClave2");
var errorContraseñas=document.getElementById("errorContraseñas");

document.getElementById("enviar").addEventListener("click", e => {
	var error1=""
	var error2=""
	var error3=""
	var error4=""
    var enviar=false;
    var claveExp=/^[a-zA-Z0-9_.+-?!#'^*$~@]{8,12}$/;
    errorClaveV.innerHTML ="";
    errorClave.innerHTML ="";
    errorClave2.innerHTML ="";
    errorContraseñas.innerHTML="";

    if (!claveExp.test(claveV.value)) {
        e.preventDefault();
		 error1+=' <i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la Contraseña actual';
		enviar = true;

	}


   if (!claveExp.test(clave.value)) {
        e.preventDefault();
		 error2+=' <i  class="bi bi-exclamation-triangle-fill"></i> La contraseña debe tener de 8-12 caracteres';
		enviar = true;

	}

	if (!claveExp.test(clave2.value)) {
        e.preventDefault();
		 error3+=' <i  class="bi bi-exclamation-triangle-fill"></i> La contraseña debe tener de 8-12 caracteres';
		enviar = true;

	}

	if(clave.value != clave2.value){
        e.preventDefault();
		 error4+='<i  class="bi bi-exclamation-triangle-fill"></i> Las contraseñas no son iguales';
		enviar = true;
	}

    
	if (enviar) {
        errorClaveV.innerHTML = error1
        errorClave.innerHTML = error2
        errorClave2.innerHTML=error3
         errorContraseñas.innerHTML=error4
     
	}

	else{
		enviar = true;
		cambioContraseña();
		e.preventDefault();

	}
});

/////////////---FUNCION AJAX----///////////////////


  //--------------------------------------------------------------------------

  function cambioContraseña(){
  	let id=$('#id').val();
  	let password=$('#claveV').val();
  	let newpassword=$('#clave').val();
    let renewpassword = $('#clave2').val();

   console.log(id);
  	$.ajax({
  		url: '',
  		method: 'POST',
  		dataType: 'json',
  		data:{password,newpassword,renewpassword, id},
  		success(data){
  			if (data.resultado === "error"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">Contraseña Inválidad, ingrese nuevamente la contraseña!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
            
			}else{
  			console.log(data);
  			Swal.fire({
                toast: true,
                position: 'top-end',
  				title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" > <p class="fw-bold p-1 mt-2" style="color:#040855!important;font-size:20px;"><b>Contraseña Cambiada!</b></p><div>',
                showConfirmButton:false,
                timer:2500,
                timerProgressBar:true,
  			});
  		}
  		}
  	})

  	return false;

  }



  $('.edita').on('click', function () {
 
    $(".img00").css('display', 'block');
     $('#envio').on('click' ,function(e){
     VALIDA();
     e.preventDefault();
    });
   
})


function VALIDA(){
  var imagen=document.getElementById("imagen");
  var errorImg=document.getElementById("errorImg");
  var error4="";

  if (imagen.value.length < 1) {
     error4=' <i  class="bi bi-exclamation-triangle-fill"></i> Ingrese una imagen';
  }
  else{
    var img = imagen.value;
        var extension = img.split('.').pop().toUpperCase();

        if (extension!="PNG" && extension!="JPG"  ){
           error4=' <i  class="bi bi-exclamation-triangle-fill"></i> debe ser de extención <b>PNG</b> o <b>JPG</b>';
        }
        else{
          error4=" ";
        }

  }

  errorImg.innerHTML=error4;



}