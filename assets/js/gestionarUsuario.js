//------------------------------- FUNCION MOSTRAR AJAX ------------------------------//

let tabla ;
mostrarTabla();
	function mostrarTabla(){
		$.ajax({
			url: '',
			type: 'POST',
			dataType: 'JSON',
			data: {mostrar: 'mostrar', tabla: 'tabla'}, 
			success(response){

				let lista = '';
				response.forEach(fila => {
					lista += `
			  <tr class="fila">
              <th class="text-left">${fila.id}</th>
              <th class="text-left">${fila.usuario}</th>
              <th class="text-left">${fila.tipoUsuario}</th>
              <th class="text-left">${fila.correo}</th>
              <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                   <button class="btn btn90 fw-bold edit" id="${fila.id}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#modificarU" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar"><i class="bi bi-pencil-fill "></i></button>
                   <button class="btn btn11 fw-bold delete" id="${fila.id}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#eliminarU" data-bs-toggle="tooltip" data-bs-placement="top" title="Anular" ><i class="bi bi-trash-fill "></i></button>
			  </th>
        
			 </tr>
					`
				})
				$('#tbody').html(lista);
				tabla = $('#tablaUser').DataTable({responsive: true});
			}
		})
	}

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
		 registrarUsuario();
         e.preventDefault();
	}
});

/////////_______________-- FUNCION REGISTRAR AJAX--___________________//////////

function registrarUsuario(){

    let usuario = $("#usuario").val();
	let tipoUsuario = $("#select").val();
	let correo = $("#correo").val();
	let clave= $("#clave").val();
	let repetirClave= $("#clave2").val();

	$.ajax({
		url:"",
		method:"post",
		dataType:"json",
		data:{ registrarU:"registrarU", usuario, tipoUsuario, correo, clave, repetirClave},
		success(data){

		if (data.resultado === "correo repetido."){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El correo Electrónico <b>'+correo+'</b> ya está registrado, ingrese otro correo electrónico!</p>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
         
         }

       else if (data.resultado === "usuario repetido."){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El usuario <b>'+usuario+'</b> ya está registrado, ingrese otro nombre de usuario!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
            
		}else{
			console.log(data);
            tabla.destroy();
            mostrarTabla();
			      $('#cerrar').click();
		      	Swal.fire({
            toast: true,
            position: 'top-end',
            title:'<div class="d-flex"><img src="assets/img/regist.png" width="60" height="60" class="box-shadow p-1 " ><p class="fw-bold p-1 mt-2" style="color: #008f20!important;font-size:20px;"><b>Usuario Registrado!</b></p></div>',
            showConfirmButton:false,
            timer:2500,
            timerProgressBar:true,
          })
         }

		}
	  });

	return false;

}



/////__________--Validacion de Modificar--___________//////

var usuario00=document.getElementById("usuario00");
var select00=document.getElementById("select00");
var correo00=document.getElementById("correo00");
var claveM=document.getElementById("claveM");
var claveM2=document.getElementById("claveM2");

var errorUsuario00=document.getElementById("errorUsuario00");
var errorSelect00=document.getElementById("errorSelect00");
var errorCorreo00=document.getElementById("errorCorreo00");
var errorClaveM=document.getElementById("errorClaveM");
var errorClaveM2=document.getElementById("errorClaveM2");
var errorContraseñas00=document.getElementById("errorContraseñas00");

document.getElementById("modificar").addEventListener("click", e => {
	var error1=""
	var error2= ""
	var error3=""
	var error4=""
	var error5=""
	var error6=""
	var usuarioExp=/^[a-zA-Z0-9ü_]{5,9}$/;
	var claveExp=/^[a-zA-Z0-9_.+-?!#'^*$~@]+$/;
    var correoExp = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/;
    var enviar=false;
    errorUsuario00.innerHTML ="";
    errorSelect00.innerHTML="";
    errorCorreo00.innerHTML ="";
    errorClaveM.innerHTML ="";
    errorClaveM2.innerHTML ="";
    errorContraseñas00.innerHTML="";

     if (!usuarioExp.test(usuario00.value)) {
        e.preventDefault();
		 error1+=' <i  class="bi bi-exclamation-triangle-fill"></i>El usuario debe tener de 5-9 carácteres alfanuméricos';
		enviar = true;

	}

	if (select00.value =='tipo') {
		e.preventDefault();
		 error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese un tipo de usuario';

	}

    if (!correoExp.test(correo00.value)) {
        e.preventDefault();
		 error3+=' <i  class="bi bi-exclamation-triangle-fill"></i> Correo inválido';
		enviar = true;

	}

    if (!claveExp.test(claveM.value)) {
        e.preventDefault();
		 error4+=' <i  class="bi bi-exclamation-triangle-fill"></i> La contraseña debe tener de 8-12 caracteres';
		enviar = true;

	}

	if (!claveExp.test(claveM2.value)) {
        e.preventDefault();
		 error5+=' <i  class="bi bi-exclamation-triangle-fill"></i> La contraseña debe tener de 8-12 caracteres';
		enviar = true;

	}

	if(claveM.value != claveM2.value){
        e.preventDefault();
		 error6+='<i  class="bi bi-exclamation-triangle-fill"></i> Las contraseñas no son iguales';
		 enviar = true;
	}

	if (enviar) {
        errorUsuario00.innerHTML = error1
        errorSelect00.innerHTML=error2
        errorCorreo00.innerHTML = error3
        errorClaveM.innerHTML = error4
        errorClaveM2.innerHTML = error5
        errorContraseñas00.innerHTML=error6
	}

	else{
		enviar = true;
		 modificarUsuario();
         e.preventDefault();
	}
});

var id;

//---------------------FUNCION MODIFICAR CON AJAX -----------------------------

  $(document).on('click', '.edit', function() {
   id = this.id 
   console.log(id);
   $.ajax({
    url: "",
    dataType: 'json',
    method: "POST",
    data: {mostrarU: 'editar', id},
    success(data){
      $("#usuario00").val(data[0].usuario);
      $("#select00").val(data[0].tipoUsuario);
      $("#correo00").val(data[0].correo);
      $("#claveM").val(data[0].clave);
      $("#claveM2").val(data[0].repetirClave);


    }

   })

  });

  //--------------------------------------------------------------------------

  function modificarUsuario(){
      let user= $("#usuario00").val();
      let tUser= $("#select00").val();
      let email= $("#correo00").val();
      let cla=$("#claveM").val();
      let rCla=$("#claveM2").val();
  	$.ajax({
  		url: '',
  		method: 'POST',
  		dataType: 'json',
  		data:{user, tUser, email, cla, rCla, id},
  		success(data){
        if (data.resultado === "error correo"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El correo Electrónico <b>'+email+'</b> ya está registrado, ingrese otro correo electrónico!</p>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
         
         }

       else if (data.resultado === "error Usuario"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El usuario <b>'+user+'</b> ya está registrado, ingrese otro nombre de usuario!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
            
    }else{
  			console.log(data);
  			tabla.destroy();
  			mostrarTabla();
  			$('#close').click();
  			Swal.fire({
                toast: true,
                position: 'top-end',
  				      title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2" style="color:#c79b2d!important;font-size:20px;"><b>Usuario Modificado!</b></p></div>',
                showConfirmButton:false,
                timer:2500,
                timerProgressBar:true,
  			});
      }
  		}
  	})

  	return false;

  }

//-------------------------------ANULAR CON AJAX----------------------------------------

  $(document).on('click', '.delete', function() {
    id = this.id;

    $.ajax({
    url: "",
    dataType: 'json',
    method: "POST",
    data: {mostrarU: 'anular', id},
    success(data){
    $('.anularU').html( '¿Deseas anular al Usuario <b style="color: #040855">'+data[0].usuario+'</b> ?');
    }

   })

  });

  //-----------------------------------------------------------------------------------------
  
  $('#anular').click((e)=>{
    e.preventDefault();
    $.ajax({
      url: '',
      method: 'post',
      dataType: 'json',
      data:{id , borrar: 'borrar'},
      success(data){
        console.log(data);
        tabla.destroy();
        mostrarTabla();
        tabla2.destroy();
        mostrarTablaR();
        $('#closed').click();
        Swal.fire({
         toast: true,
          position: 'top-end',
          title:'<div class="d-flex"><img src="assets/img/pape.png" width="50" height="50" class="box-shadow p-1" > <p class="fw-bold p-1 mt-2" style="color:#cd0000!important;font-size:20px;"><b>Usuario Anulado!</b></p></div>',
          showConfirmButton:false,
          timer:2500,
          timerProgressBar:true,
        });
      }
    })
  })


//-------------------------------PAPELERA CON AJAX----------------------------------------

  //------------------------------------MOSTRAR TABLA-----------------------------------------

let tabla2 ;
mostrarTablaR();
  function mostrarTablaR(){
    $.ajax({
      url: '',
      type: 'POST',
      dataType: 'JSON',
      data: {papelera: 'mostrar', tabla2: 'tabla2'}, 
      success(response){

        let lista2 = '';
        response.forEach(fila => {
          lista2 += `
              <tr class="fila">
                      <th class="text-left">${fila.id}</th>
                      <th class="text-left">${fila.usuario}</th>
                      <th class="text-left">${fila.tipoUsuario}</th>
                      <th class="text-left">${fila.correo}</th>
                  
                    <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                        <button id="${fila.id}" data-bs-toggle="modal" data-bs-target="#restta" class="btn90 fw-bold  mb-1 col-4 col-md-3 restaurar" type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurar Area" ><i class="bi bi-check2-circle "></i></button>
                    </th>
        
              </tr>
          `
        })
        $('#restaurarU').html(lista2);
        tabla2 = $('#tablaR').DataTable({responsive: true});
      }
    })
  }

//------------------------------RESTAURAR CON AJAX-----------------------------------------
 $(document).on('click', '.restaurar', function() {
   id = this.id 
   console.log(id);
   $.ajax({
    url: "",
    dataType: 'json',
    method: "POST",
    data: {mostrarU: 'ehhh', id},
    success(data){
      $('.mostrarR').html( '¿Deseas restaurar al Usuario <b style="color: #040855">'+ data[0].usuario + '</b> ?');
   
    }

   })

  })

//--------------------------------------------------------------------------

  $('#lito').click((e)=>{
    e.preventDefault();
    $.ajax({
      url: '',
      method: 'post',
      dataType: 'json',
      data:{id , restaurar: 'restaurar'},
      success(data){
        if (data.resultado === "errorC"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El correo Electrónico ya está registrado, restaure otra cuenta!</p>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
         
         }

       else if (data.resultado === "errorU"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El usuario ya está registrado, restaure otra cuenta!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
            
    }else{
        console.log(data);
        $('.cancelar').click();
        Swal.fire({
         toast: true,
          position: 'top-end',
          title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2"  style="color:#c79b2d!important;font-size:20px;"><b>Usuario Restaurado!</b></p></div>',
          showConfirmButton:false,
          timer:2500,
          timerProgressBar:true,
        })
        tabla.destroy();
        mostrarTabla();
        tabla2.destroy();
        mostrarTablaR();
      }

      }
    })
  })
