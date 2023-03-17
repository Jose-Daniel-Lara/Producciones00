
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
              <th class="text-left">${fila.cod_area}</th>
              <th class="text-left">${fila.nombArea}</th>
              <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                   <button class="btn btn90 fw-bold edit" id="${fila.cod_area}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModificarA" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar"><i class="bi bi-pencil-fill "></i></button>
                   <button class="btn btn11 fw-bold delete" id="${fila.cod_area}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleEliminarA" data-bs-toggle="tooltip" data-bs-placement="top" title="Anular" ><i class="bi bi-trash-fill "></i></button>
			  </th>
        
			 </tr>
					`
				})
				$('#tbody').html(lista);
				tabla = $('#tablaArea').DataTable({responsive: true});
			}
		})
	}



	/////__________--Validacion de Registrar--___________//////


var area=document.getElementById("area");

var errorArea=document.getElementById("errorArea");


document.getElementById("envio").addEventListener("click", e => {
	var error1=""
    var enviar=false;
    errorArea.innerHTML=""

	if(area.value.length < 1){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill" ></i> Ingrese el area';
		enviar = true;
	
	}

	
	if(area.value.length > 15){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe ser menor a 15 caracteres';
		enviar = true;
	
	}


	if (enviar) {
    errorArea.innerHTML=error1
        
	}

	else{
		enviar = true;
      
        registrarArea();
        e.preventDefault();
	}
});



/////////_______________-- FUNCION REGISTRAR AJAX--___________________//////////

function registrarArea(){

	var area = $("#area").val();

	$.ajax({
		url:"",
		method:"post",
		dataType:"json",
		data:{ registrarA:"registrarA", area},
		success(data){
			if (data.resultado === "El area ya esta registrado"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La área <b>'+area+'</b> ya está registrada, ingrese otra área!</p></div>',
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
          title:' <div class="d-flex"><img src="assets/img/regist.png" width="60" height="60" class="box-shadow p-1 " > <p class="fw-bold p-1 mt-2" style="color: #008f20!important;font-size:20px;"><b>Área Registrada!</b></p></div>',
          showConfirmButton:false,
          timer:2500,
          timerProgressBar:true,
          })
         }

		}



	});

	return false;

}




var id;

//-------------------------------MODIFICAR CON AJAX----------------------------------------


/////__________--Validacion de Modificar--___________//////

var area00=document.getElementById("area00");
var errorArea00=document.getElementById("errorArea00");

document.getElementById("modificar").addEventListener("click", e => {
	var error1=""
    var enviar=false;
    errorArea00.innerHTML=""

	if(area00.value.length < 1){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el area';
		enviar = true;
	
	}

	
	if(area00.value.length > 15){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe ser menor a 15 caracteres';
		enviar = true;
	
	}

	if (enviar) {
    errorArea00.innerHTML=error1
        
	}

	else{
		enviar = true;
        modificarArea();
        e.preventDefault();
	  
	}
});

//--------------------------------------------------------------------------

  $(document).on('click', '.edit', function() {
   id = this.id 
   console.log(id);
   $.ajax({
    url: "",
    dataType: 'json',
    method: "POST",
    data: {mostraE: 'editar', id},
    success(data){
    $('#area00').val(data[0].nombArea);
    }

   })

  });


  //--------------------------------------------------------------------------

  function modificarArea(){
   let nombreEdit = $('#area00').val();
   console.log(nombreEdit);
  	$.ajax({
  		url: '',
  		method: 'POST',
  		dataType: 'json',
  		data:{nombreEdit , id},
  		success(data){
          if (data.resultado === "error Area"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La área <b>'+nombreEdit+'</b> ya existe, ingrese otro nombre de área!</p></div>',
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
  				title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" > <p class="fw-bold p-1 mt-2" style="color:#c79b2d!important;font-size:20px;"><b>Área Modificada!</b></p><div>',
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
    data: {mostraE: 'anular', id},
    success(data){
    $('.anularA').html( '¿Deseas anular el Área <b style="color: #040855">'+data[0].nombArea+'</b> ?');
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
  			$('#borrar').click();
  			Swal.fire({
  			 toast: true,
          position: 'top-end',
          title:'<div class="d-flex"><img src="assets/img/pape.png" width="50" height="50" class="box-shadow p-1" > <p class="fw-bold p-1 mt-2" style="color:#cd0000!important;font-size:20px;"><b>Área Anulada!</b></p><div>',
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
                    <th class="text-left">${fila.cod_area}</th>
                    <th class="text-left" >${fila.nombArea}</th>
                  
                    <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                        <button id="${fila.cod_area}" data-bs-toggle="modal" data-bs-target="#restta" class="btn90 fw-bold  mb-1 col-4 col-md-3 restaurar" type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurar Area" ><i class="bi bi-check2-circle "></i></button>
                    </th>
        
              </tr>
          `
        })
        $('#restaurarA').html(lista2);
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
    data: {mostraE: 'ehhh', id},
    success(data){
      $('.mostrarR').html( '¿Deseas restaurar el Área <b style="color: #040855">'+ data[0].nombArea+'</b> ?');
   
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
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La área ya existe en el registro, restaure otra área!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
            
      }else{
        console.log(data);
        $('.cancelar').click();
        tabla.destroy();
        mostrarTabla();
        tabla2.destroy();
        mostrarTablaR();
        Swal.fire({
         toast: true,
          position: 'top-end',
          title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2"  style="color:#c79b2d!important;font-size:20px;"><b>Área Restaurada!</b></p></div>',
          showConfirmButton:false,
          timer:2500,
          timerProgressBar:true,
        })
       
      }
        

      }
    })
  })



