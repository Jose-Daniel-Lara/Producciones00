
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
              <th class="text-left">${fila.moneda}</th>
               <th class="text-left">${fila.cambio}</th>
              <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                   <button class="btn btn90 fw-bold edit" id="${fila.id}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#modificarMO" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar"><i class="bi bi-pencil-fill "></i></button>
                   <button class="btn btn11 fw-bold delete" id="${fila.id}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#anularMO" data-bs-toggle="tooltip" data-bs-placement="top" title="Anular" ><i class="bi bi-trash-fill "></i></button>
			  </th>
        
			 </tr>
					`
				})
				$('#tbody').html(lista);
				tabla= $('#tablaMoneda').DataTable({responsive: true});
			}
		})
	}

/////__________--Validacion de Registrar--___________//////

var moneda=document.getElementById("moneda");
var bs=document.getElementById("bs");

var errorLugar=document.getElementById("errorMoneda");
var errorDireccion=document.getElementById("errorBs");


document.getElementById("envio").addEventListener("click", e => {
	var error1=""
	var error2=""
    var enviar=false;
    var valorExp= /^\d{1,10}\.\d{2}$/;
    errorMoneda.innerHTML=""
    errorBs.innerHTML=""
	
	if(moneda.value.length < 1){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el tipo de moneda';
		enviar = true;
	
	}
	
	if(moneda.value.length > 10){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe ser menor a 10 caracteres';
		enviar = true;
	
	}

	if(!valorExp.test(bs.value)){
        e.preventDefault();
		error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el valor al cambio';
		 enviar = true;
	}

	if (enviar) {
    errorMoneda.innerHTML=error1
    errorBs.innerHTML=error2
	}

	else{
		enviar = true;
		registrarMoneda();
        e.preventDefault();
	}
});

function registrarMoneda(){

	var moneda = $("#moneda").val();
	var cambio=$("#bs").val();

	$.ajax({
		url:"",
		method:"post",
		dataType:"json",
		data:{ registrarMO:"registrarMO", moneda, cambio},
		success(data){
			if (data.resultado === "repetido"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La Moneda <b>'+moneda+'</b> ya está registrada, ingrese otra Moneda!</p></div>',
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
          title:'<div class="d-flex"><img src="assets/img/regist.png" width="60" height="60" class="box-shadow p-1 " ><p class="fw-bold p-1 mt-2" style="color: #008f20!important;font-size:20px;"><b>Moneda Registrada!</b></p></div>',
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

var moneda00=document.getElementById("moneda00");
var bs00=document.getElementById("cambio00");

var errorMoneda00=document.getElementById("errorMoneda00");
var errorBs00=document.getElementById("errorBs00");


document.getElementById("modificar").addEventListener("click", e => {
	var error1=""
	var error2=""
    var enviar=false;
    var valorExp=  /^\d{1,10}\.\d{2}$/;
    errorMoneda00.innerHTML=""
    errorBs00.innerHTML=""
	
	if(moneda00.value.length < 1){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el tipo de moneda';
		enviar = true;
	
	}
	
	if(moneda00.value.length > 10){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe ser menor a 10 caracteres';
		enviar = true;
	
	}

	if(!valorExp.test(bs00.value)){
        e.preventDefault();
		error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el valor al cambio';
		 enviar = true;
	}

	if (enviar) {
    errorMoneda00.innerHTML=error1
    errorBs00.innerHTML=error2
	}

	else{
		enviar = true;
		modificarMoneda();
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
    method: "post",
    data: {mostrar2: 'mostrar', id},
    success(data){
    $('#moneda00').val(data[0].moneda);
    $('#cambio00').val(data[0].cambio);
    }

   })

  });


   function modificarMoneda(){
   let mon = $('#moneda00').val();
   let camb = $('#cambio00').val();
   console.log(mon + camb);
  	$.ajax({
  		url: '',
  		method: 'POST',
  		dataType: 'json',
  		data:{mon, camb , id},
  		success(data){
        if (data.resultado === "error Moneda"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La Moneda <b>'+mon+'</b> ya está registrada, ingrese otra Moneda!</p></div>',
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
  				      title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2" style="color:#c79b2d!important;font-size:20px;"><b>Moneda Modificada!</b></p></div>',
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
    data: {mostrar2: 'mostrar', id},
    success(data){
    $('.anularMO').html( '¿Deseas anular la Moneda <b style="color: #040855">'+data[0].moneda+'</b> ?');
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
             title:'<div class="d-flex"><img src="assets/img/pape.png" width="50" height="50" class="box-shadow p-1" > <p class="fw-bold p-1 mt-2" style="color:#cd0000!important;font-size:20px;"><b>Moneda Anulada!</b></p></div>',
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
                    <th class="text-left" >${fila.moneda}</th>
                    <th class="text-left" >${fila.cambio}</th>
                  
                    <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                        <button id="${fila.id}" data-bs-toggle="modal" data-bs-target="#restta" class="btn90 fw-bold  mb-1 col-4 col-md-3 restaurar" type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurar Area" ><i class="bi bi-check2-circle "></i></button>
                    </th>
        
              </tr>
          `
        })
        $('#restaurarMO').html(lista2);
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
    data: {mostrar2: 'mostrar', id},
    success(data){
      $('.mostrarR').html( '¿Deseas restaurar la Moneda <b style="color: #040855">'+ data[0].moneda+'</b> ?');
   
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
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La Moneda ya está registrada, ingrese otra Moneda!</p></div>',
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
          title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2"  style="color:#c79b2d!important;font-size:20px;"><b>Moneda Restaurada!</b></p>',
          icon: 'success',
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
