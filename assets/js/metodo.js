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
              <th class="text-left">${fila.id_metodo}</th>
              <th class="text-left">${fila.metodo}</th>
              <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                   <button class="btn btn90 fw-bold edit" id="${fila.id_metodo}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#modificarME" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar"><i class="bi bi-pencil-fill "></i></button>
                   <button class="btn btn11 fw-bold delete" id="${fila.id_metodo}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#eliminarME" data-bs-toggle="tooltip" data-bs-placement="top" title="Anular" ><i class="bi bi-trash-fill "></i></button>
			  </th>
        
			 </tr>
					`
				})
				$('#tbody').html(lista);
				tabla= $('#tablaMetodo').DataTable({responsive: true});
			}
		})
	}


/////__________--Validacion de Registrar--___________//////

var metodo=document.getElementById("metodo");
var errorMetodo=document.getElementById("errorMetodo");


document.getElementById("envio").addEventListener("click", e => {
	var error1=""
    var enviar=false;
    errorMetodo.innerHTML=""

	if(metodo.value.length < 1){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el método de pago';
		enviar = true;
	
	}

	
	if(metodo.value.length > 15){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe ser menor a 15 carácteres';
		enviar = true;
	
	}

	if (enviar) {
    errorMetodo.innerHTML=error1
        
	}

	else{
		enviar = true;
        registrarMetodo();
        e.preventDefault();
	}
});

/////////_______________-- FUNCION REGISTRAR AJAX--___________________//////////

function registrarMetodo(){

	var metodo = $("#metodo").val();

	$.ajax({
		url:"",
		method:"post",
		dataType:"json",
		data:{ registrarM:"registrarM", metodo},
		success(data){
			if (data.resultado === "repetido."){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El Método de Pago <b>'+metodo+'</b> ya está registrado, ingrese otro Método de Pago!</p></div>',
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
             title:'<div class="d-flex"><img src="assets/img/regist.png" width="60" height="60" class="box-shadow p-1 " ><p class="fw-bold p-1 mt-2" style="color: #008f20!important;font-size:20px;"><b>Método de Pago Registrado!</b></p></div>',
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

var metodo00=document.getElementById("met00");
var errorMetodo00=document.getElementById("errorMetodo00");


document.getElementById("modificar").addEventListener("click", e => {
	var error1=""
    var enviar=false;
    errorMetodo00.innerHTML=""
    
	
	

	if(metodo00.value.length < 1){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el método de pago';
		enviar = true;
	
	}

	
	if(metodo00.value.length > 15){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe ser menor a 15 carácteres';
		enviar = true;
	
	}

	if (enviar) {
    errorMetodo00.innerHTML=error1
        
	}

	else{
		enviar = true;
        modificarMetodo();
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
    data: {mostrarME:'modificar', id},
    success(data){
    $('#met00').val(data[0].metodo);
    }

   })

  });


  //--------------------------------------------------------------------------

  function modificarMetodo(){
   let met = $('#met00').val();
   console.log(met);
  	$.ajax({
  		url: '',
  		method: 'POST',
  		dataType: 'json',
  		data:{met, id},
  		success(data){
        if (data.resultado === "error Metodo"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El Método de Pago <b>'+met+'</b> ya está registrado, ingrese otro Método de Pago!</p></div>',
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
  		    title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold" style="color:#c79b2d!important;font-size:20px;"><b>Metodo de Pago Modificado!</b></p></div>',
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
    data: {mostrarME: 'anular', id},
    success(data){
    $('.anularME').html( '¿Deseas anular el Método de Pago <b style="color: #040855">'+data[0].metodo+'</b> ?');
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
             title:'<div class="d-flex"><img src="assets/img/pape.png" width="50" height="50" class="box-shadow p-1" > <p class="fw-bold p-1 mt-2" style="color:#cd0000!important;font-size:20px;"><b>Método de Pago Anulado!</b></p></div>',
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
                    <th class="text-left">${fila.id_metodo}</th>
                    <th class="text-left" >${fila.metodo}</th>
                  
                    <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                        <button id="${fila.id_metodo}" data-bs-toggle="modal" data-bs-target="#restta" class="btn90 fw-bold  mb-1 col-4 col-md-3 restaurar" type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurar Area" ><i class="bi bi-check2-circle "></i></button>
                    </th>
        
              </tr>
          `
        })
        $('#restaurarME').html(lista2);
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
    data: {mostrarME: 'rest', id},
    success(data){
      $('.mostrarR').html( '¿Deseas restaurar el Método de Pago <b style="color: #040855">'+ data[0].metodo+ '</b> ?');
   
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
    if (data.resultado === "error"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El Método de Pago ya está registrado, restaure otro Método de Pago!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
            
    }else{
        console.log(data);
        $('#cancelar').click();
        Swal.fire({
         toast: true,
          position: 'top-end',
          title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2" style="color:#c79b2d!important;font-size:20px;"><b>Método de Pago Restaurado!</b></p></div>',
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