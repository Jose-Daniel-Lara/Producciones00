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
              <th class="text-left">${fila.cod_lugar}</th>
              <th class="text-left">${fila.lugar}</th>
              <th class="text-left">${fila.direccion}</th>
              <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                   <button class="btn btn90 fw-bold edit" id="${fila.cod_lugar}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#modificarL" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar"><i class="bi bi-pencil-fill "></i></button>
                   <button class="btn btn11 fw-bold delete" id="${fila.cod_lugar}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#eliminarL" data-bs-toggle="tooltip" data-bs-placement="top" title="Anular" ><i class="bi bi-trash-fill "></i></button>
			  </th>
        
			 </tr>
					`
				})
				$('#tbody').html(lista);
				tabla = $('#tablaL').DataTable({responsive: true});
			}
		})
	}


/////__________--Validacion de Registrar--___________//////

var lugar=document.getElementById("lugar");
var direccion=document.getElementById("direccion");

var errorLugar=document.getElementById("errorLugar");
var errorDireccion=document.getElementById("errorDireccion");


document.getElementById("envio").addEventListener("click", e => {
	var error1=""
	var error2=""
    var enviar=false;
    errorLugar.innerHTML=""
    errorDireccion.innerHTML=""

	if(lugar.value.length < 1){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el Lugar del Evento';
		enviar = true;
	
	}

	
	if(lugar.value.length > 25){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe ser menor a 15 caracteres';
		enviar = true;
	
	}

	if(direccion.value.length < 1){
        e.preventDefault();
		 error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la Dirección';
		enviar = true;
	
	}

	
	if(direccion.value.length > 60){
        e.preventDefault();
		 error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe ser menor a 60 caracteres';
		enviar = true;
	
	}

	if (enviar) {
    errorLugar.innerHTML=error1
    errorDireccion.innerHTML=error2
	}

	else{
		enviar = true;
		registrarLugar();
		e.preventDefault();

	}
});


/////////_______________-- FUNCION REGISTRAR AJAX--___________________//////////

function registrarLugar(){

	var lugar = $("#lugar").val();
	var direccion = $("#direccion").val();

	$.ajax({
		url:"",
		method:"post",
		dataType:"json",
		data:{ registrarL:"registrarL", lugar:lugar, direccion:direccion},
		success(data){

		if (data.resultado === "lugar."){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El lugar <b>'+lugar+'</b> ya está registrado, ingrese otro lugar!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
         
         }

       else if (data.resultado === "direccion."){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La dirección <b>'+direccion+'</b> ya está registrado, ingrese otra dirección!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
            
		}
		else{
			console.log(data);
            tabla.destroy();
            mostrarTabla();
			$('#cerrar').click();
			Swal.fire({
          toast: true,
          position: 'top-end',
          title:'<div class="d-flex"><img src="assets/img/regist.png" width="60" height="60" class="box-shadow p-1 " ><p class="fw-bold p-1 mt-2" style="color: #008f20!important;font-size:20px;"><b>Lugar Registrado!</b></p></div>',
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

var lugar00=document.getElementById("lugar00");
var direccion00=document.getElementById("direccion00");

var errorLugar00=document.getElementById("errorLugar00");
var errorDireccion00=document.getElementById("errorDireccion00");


document.getElementById("modificar").addEventListener("click", e => {
	var error1=""
	var error2=""
    var enviar=false;
    errorLugar00.innerHTML=""
    errorDireccion00.innerHTML=""
	
	

	if(lugar00.value.length < 1){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el Lugar del Evento';
		enviar = true;
	
	}

	
	if(lugar00.value.length > 15){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe ser menor a 15 caracteres';
		enviar = true;
	
	}

	if(direccion00.value.length < 1){
        e.preventDefault();
		 error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la Dirección';
		enviar = true;
	
	}

	
	if(direccion00.value.length > 60){
        e.preventDefault();
		 error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe ser menor a 60 caracteres';
		enviar = true;
	
	}


	
	

	if (enviar) {
    errorLugar00.innerHTML=error1
    errorDireccion00.innerHTML=error2
	}

	else{
		enviar = true;
		modificarLugar();
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
    data: {mostrarL: 'editar', id},
    success(data){
    $('#lugar00').val(data[0].lugar);
    $('#direccion00').val(data[0].direccion);
    }

   })

  });


  //--------------------------------------------------------------------------

  function modificarLugar(){
   let lug = $('#lugar00').val();
   let dir = $('#direccion00').val();

   console.log(lug + dir );
  	$.ajax({
  		url: '',
  		method: 'POST',
  		dataType: 'json',
  		data:{lug, dir, id},
  		success(data){
        if (data.resultado === "error lugar"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El lugar <b>'+lug+'</b> ya está registrado, ingrese otro lugar!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
         
         }

       else if (data.resultado === "error direccion"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La dirección <b>'+dir+'</b> ya está registrada, ingrese otra dirección!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
            
    }
    else{
  			console.log(data);
  			tabla.destroy();
  			mostrarTabla();
  			$('#chao').click();
  			Swal.fire({
                toast: true,
                position: 'top-end',
  		          title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2" style="color:#c79b2d!important;font-size:20px;"><b>Lugar Modificado!</b></p></div>',
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
   id = this.id 
   console.log(id);
   $.ajax({
    url: "",
    dataType: 'json',
    method: "POST",
    data: {mostrarL: 'anular', id},
    success(data){
    $('.anularL').html( '¿Deseas anular el Lugar <b style="color: #040855">'+data[0].lugar+'</b> ?');
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
             title:'<div class="d-flex"><img src="assets/img/pape.png" width="50" height="50" class="box-shadow p-1" > <p class="fw-bold p-1 mt-2" style="color:#cd0000!important;font-size:20px;"><b>Lugar Anulado!</b></p></div>',
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
                    <th class="text-left">${fila.cod_lugar}</th>
                    <th class="text-left" >${fila.lugar}</th>
                    <th class="text-left" >${fila.direccion}</th>
                  
                    <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                        <button id="${fila.cod_lugar}" data-bs-toggle="modal" data-bs-target="#restta" class="btn90 fw-bold  mb-1 col-4 col-md-3 restaurar" type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurar Area" ><i class="bi bi-check2-circle "></i></button>
                    </th>
        
              </tr>
          `
        })
        $('#restaurarL').html(lista2);
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
    data: {mostrarL: 'rest', id},
    success(data){
      $('.mostrarR').html( '¿Deseas restaurar el lugar <b style="color: #040855">'+ data[0].lugar+ '</b> ?');
   
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
         if (data.resultado === "errorL"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El lugar  ya está registrado, restaure otro Dato!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
         
         }

       else if (data.resultado === "errorD"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La dirección ya está registrada, restaure otro Dato!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
            
    }
    else{
        console.log(data);
        $('#cancelar').click();
        Swal.fire({
         toast: true,
          position: 'top-end',
          title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2"  style="color:#c79b2d!important;font-size:20px;"><b>Lugar Restaurado!</b></p></div>',
          showConfirmButton:false,
          timer:2500,
          timerProgressBar:true,
        });
        tabla.destroy();
        mostrarTabla();
        tabla2.destroy();
        mostrarTablaR();
      }

      }
    })
  })