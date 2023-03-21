imagen_input = document.getElementById("image");
imagen_img = document.getElementById("imgPreview");
imagen_input.onchange = evt => {
	const [file] = imagen_input.files
	if (file) {
		imagen_img.src = URL.createObjectURL(file)
	}
}

$(document).ready(function(e){
	var modalCrud = new bootstrap.Modal(document.getElementById('crudEvento'));

	$(".btn-crud-evento").on("click", function(){
		let evento_id = $(this).data('codigo');
		let op = parseInt(evento_id) > 0 ? 'updateEvento' : 'addEvento';

		if (parseInt(evento_id)>0 && $(this).data('status')===E_STATUS_OCUPADO){
			Swal.fire({
				icon: 'error',
				title: 'Operación No Permitida',
				text: 'El Evento está ' + E_STATUS_OCUPADO,
			})
			return false;
		}

		$('#hid_op').val(op);
		$('#hid_codigo_evento').val(evento_id);
		console.log('op: ' + op);
		console.log('codigo: ' + evento_id);

		if (parseInt(evento_id) >0){
			$("#eventoNombre").empty().val($(this).data('nombre'));
			$("#tipoEvento").val($(this).data('tipo'));
			$("#lugares").val($(this).data('lugar'));
			$("#entradas").empty().val($(this).data('entradas'));
			$("#fecha").empty().val($(this).data('fecha'));
			$("#hora").empty().val($(this).data('hora'));
			if ($(this).data('imagen').trim() === ''){
				$("#imgPreview").attr('src','assets/img/default_placeholder.jpg');
			}else{
				$("#imgPreview").attr('src',$(this).data('imagen'));
			}
			$("#imagen_anterior").empty().val($(this).data('imagen'));
			$("#image").empty();
			$("#estatus_evento").empty().val($(this).data('status'));
		}else{
			$("#eventoNombre").empty();
			$("#entradas").empty();
			$("#fecha").empty();
			$("#hora").empty();
			$("#imgPreview").attr('src','assets/img/default_placeholder.jpg');
			$("#image").empty();
			$("#imagen_anterior").val("");
			$("#estatus_evento").val(E_STATUS_DISPONIBLE);
		}

		//$('#crudEvento').modal({ show:true });
		modalCrud.show();
	});

	$(".btn-delete-evento").on("click", function (){
		let codigo = $(this).data('codigo');
		let status = $(this).data('status');
		if (status===E_STATUS_OCUPADO){
			Swal.fire({
				icon: 'error',
				title: 'Operación No Permitida',
				text: 'El Evento está ' + E_STATUS_OCUPADO,
			})
		}else{
			swal.fire({
				title: '¿Seguro de Anular este Evento?',
				text: "Continúe para confirmar la Anulación...",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, Anular!',
			}).then((result) => {
				if (result.value){
					$.ajax({
						url: '?url=eventos',
						type: 'POST',
						data: {
							op: 'anularEvento',
							codigo: codigo
						},
						dataType: 'json'
					})
						.done(function(response){
							if (response.success){
								swal.fire('Anulado!', 'Evento Anulado', 'success');
							}else{
								swal.fire('Anulado!', response.msj, 'success');
							}
							location.href='?url=eventos';
						})
						.fail(function(){
							swal.fire('Upsss...', '¡Algo salió mal al anular!', 'error');
						});
				} // fin de if (result.value)
			})
		}//fin del else
	})

	$(".restaurar-ev").on("click", function (){
		let codigo = $(this).data('codigo');

		swal.fire({
			title: '¿Seguro de Restaurar este Evento?',
			text: "Continúe para confirmar la Restauración...",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, Restaurar!',
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: '?url=eventos',
					type: 'POST',
					data: {
						op: 'restaurarEvento',
						codigo: codigo
					},
					dataType: 'json'
				})
					.done(function (response) {
						if (response.success) {
							swal.fire('Restaurado!', 'Evento Restaurado', 'success');
						} else {
							swal.fire('Upsss...', response.msj, 'error');
						}
						location.href = '?url=eventos';
					})
					.fail(function () {
						swal.fire('Upsss...', '¡Algo salió mal al anular!', 'error');
					});
			} // fin de if (result.value)
		})
	})

	$('#envioDataEvento').on('click', function () {
		if (validarDataEvento()){
			let msjOperacion = $("#hid_op").val() == 'addEvento' ? 'Registrado' : 'Actualizado';
			let formData = new FormData();
			formData.append('op',$("#hid_op").val());
			formData.append('codigo',$("#hid_codigo_evento").val());
			formData.append('evento',$("#eventoNombre").val().trim());
			formData.append('tipo',$("#tipoEvento").val());
			formData.append('lugar',$("#lugares").val().trim());
			formData.append('entradas',$("#entradas").val());
			formData.append('fecha',$("#fecha").val());
			formData.append('hora',$("#hora").val());
			formData.append('imagen',$("#image").val().trim());
			formData.append('imagen_anterior',$("#imagen_anterior").val().trim());
			formData.append('status',$('#estatus_evento').val())
			let files = $('#image')[0].files[0];
			if (files) {
				formData.append('file',files);
			}
			$.ajax({
				url: '?url=eventos',
				type: 'post',
				data: formData,
				contentType: false,
				processData: false,
				async: false
			})
				.done(function(response) {
					let resp = JSON.parse(response);
					if (resp.success){
						Swal.fire({
							title:'<h3 style="color:#040855!important;"><b>' + msjOperacion + '</b></h3>',
							html:'<p style="color:#bbb!important;">Evento ' + msjOperacion + ' Exitosamente!</p> <br> <div class="modal-footer"> </div>',
							showConfirmButton:false,
							timer:2500,
							timerProgressBar:true,
							imageUrl:'assets/img/check.png',
							imageWidth:'180px',
							imageHeight:'140px',
							imageAlt:'registrado'
						}).then(()=>{
							location.href="?url=eventos";
						})
					}else{
						swal.fire('Upsss...', resp.msj, 'error');
						//location.href="?url=eventos";
					}
				})
			return false;
		}
	})
})

function validarDataEvento(){
	let ok = true;

	if($("#eventoNombre").val().trim().length < 10 || $("#eventoNombre").val().trim().length>30){
		$("#errorEventoNombre").html('<i class="bi bi-exclamation-triangle-fill" ></i>El nombre del Evento debe contener entre 10 y 30 caracteres.');
		ok = false;
	}else{
		$("#errorEventoNombre").html("");
	}

	if ($("#tipoEvento").val() == null || $("#tipoEvento").val().trim().length === 0) {
		$("#errortipoEvento").html('<i class="bi bi-exclamation-triangle-fill"></i>Seleccione el Tipo de Evento.');
		ok = false;
	}else{
		$("#errortipoEvento").html("");
	}

	if ($("#lugares").val() == null || $("#lugares").val().trim().length === 0) {
		$("#errorLugares").html('<i class="bi bi-exclamation-triangle-fill"></i>Seleccione el Lugar.');
		ok = false;
	}else{
		$("#errorLugares").html("");
	}

	if($("#entradas").val().trim().length === 0){
		$("#errorEntradas").html('<i class="bi bi-exclamation-triangle-fill" ></i>Ingrese la Cantidad de Entradas.');
		ok = false;
	}else{
		$("#errorEntradas").html("");
	}

	if ($("#fecha").val().trim().length < 1) {
		$("#errorFecha").html('<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la fecha');
		ok = false;
	}else{
		$("#errorFecha").html("");
	}

	if ($("#hora").val().trim().length < 1) {
		$("#errorHora").html('<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la hora');
		ok = false;
	}else{
		$("#errorHora").html("");
	}
	return ok;
}

/*

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
              <th class="text-left">${fila.nombre}</th>
              <th class="text-left">${fila.tipoEvento}</th>
              <th class="text-left">${fila.lugar}</th>
              <th class="text-left">${fila.entradas}</th>
              <th class="text-left">${fila.fecha}</th>
              <th class="text-left">${fila.hora}</th>
             <th  class ="text-center">
                       <img src="assets/img/${fila.imagen}" width="50" height="42" class="box-shadow" >
                     </th>
              <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                   <button class="btn btn90 fw-bold edit" id="${fila.codigo}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#modificarE" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar"><i class="bi bi-pencil-fill "></i></button>
                   <button class="btn btn11 fw-bold delete" id="${fila.codigo}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#eliminarE" data-bs-toggle="tooltip" data-bs-placement="top" title="Anular" ><i class="bi bi-trash-fill "></i></button>
			  </th>
        
			 </tr>
					`
				})
				$('#tbody').html(lista);
				tabla = $('#tablaE').DataTable({responsive: true});
			}
		})

}

$(document).ready(function(){

  $(".registrar").select2({
    theme:'bootstrap-5',
    dropdownParent:$('#exampleRegistrarE .contenido'),
    selectionCssClass:"form-select",
    dropdownCssClass:"select",
    searchCssClass:"buscar",
    width:'100%'
  });

  $(".modificar").select2({
    theme:'bootstrap-5',
    dropdownParent:$('#modificarE .contenido'),
    selectionCssClass:"form-select",
    dropdownCssClass:"select",
    searchCssClass:"buscar",
    width:'100%'
  });

});

mostrarLugar();
let inpu2;
inpu2= '<option value="lugar" class="opcion" >Lugares</option>';
function mostrarLugar(){
		$.ajax({
			url: '',
			type: 'POST',
			dataType: 'JSON',
			data: {select2: 'mostrar', inputL:'xd'}, 
			success(response){

				let op = '';
				response.forEach(fila => {
					op += `<option  class="opcion" value="${fila.lugar}">${fila.lugar}</option> `
				})
				$('#select').html(inpu2 + op);
			}
		})
	}


////---------------------------MOSTRAR SELECT EVENTO-------------------------------
mostrartipo();
let input;
input= '<option value="tipo" class="opcion" >Tipo de Evento</option>';
function mostrartipo(){
		$.ajax({
			url: '',
			type: 'POST',
			dataType: 'JSON',
			data: {select: 'mostrar', input:'xd'}, 
			success(response){

				let opE = '';
				response.forEach(fila => {
					opE += `<option  class="opcion" value="${fila.tipo}">${fila.tipo}</option> `
				})
				$('#select01').html(input + opE);
			}
		})
	}


/////__________--Validacion de Registrar--___________//////

var evento=document.getElementById("evento");
var select=document.getElementById("select");
var select01=document.getElementById("select01");
var entradas=document.getElementById("entradas");
var imagen=document.getElementById("imagen");
var hora=document.getElementById("hora");
var fecha=document.getElementById("fecha");

var errorEvento=document.getElementById("errorEvento")
var errorSelect=document.getElementById("errorSelect");
var errorSelect01=document.getElementById("errorSelect01");
var errorEntra=document.getElementById("errorEntra");
var errorImg=document.getElementById("errorImg");
var errorHora=document.getElementById("errorHora");
var errorFecha=document.getElementById("errorFecha");

document.getElementById("envio").addEventListener("click", e => {
	var error1=""
	var error2= ""
	var error3=""
	var error4=""
	var error5=""
	var error6=""
	var error7=""
    var enviar=false;
    var cantidadExp = /^[0-9]+$/;
    errorEvento.innerHTML =""
    errorSelect.innerHTML=""
    errorSelect01.innerHTML =""
    errorEntra.innerHTML =""
    errorImg.innerHTML=""
    errorHora.innerHTML=""
    errorFecha.innerHTML=""


	if(evento.value.length < 10){
        e.preventDefault();
	    error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un mínimo de 10 caracteres';
		enviar = true;
	
	}
	if(evento.value.length > 30){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un maximo de 30 caracteres';
		enviar = true;
	
	}

	if (select.value =='tipo') {
		e.preventDefault();
		 error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el tipo de Evento';

	}

	if (select01.value =='lugar') {
		e.preventDefault();
		 error3+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el lugar de Evento';

	}

	

	if(!cantidadExp.test(entradas.value)){
        e.preventDefault();
	    error4+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la cantidad de asientos que tendra la mesa';
		enviar = true;
	
	}

	if(entradas.value =='0'){
        e.preventDefault();
		 error4+='<i  class="bi bi-exclamation-triangle-fill"></i> La cantidad de entradas del evento debe ser mayor a 0';
		enviar = true;
	}

	if (imagen.value.length < 1) {
		e.preventDefault();
		error5+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese una imagen';
		enviar = true;
	}
	
	if (hora.value.length < 1) {
		e.preventDefault();
		error6+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la hora';
		enviar = true;
	}
	if (fecha.value.length < 1 ) {
		e.preventDefault();
		error7+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la fecha';
		enviar = true;
	}


	if (enviar) {
    errorEvento.innerHTML =error1
    errorSelect.innerHTML=error2
    errorSelect01.innerHTML =error3
    errorEntra.innerHTML =error4
    errorImg.innerHTML=error5
    errorHora.innerHTML=error6
    errorFecha.innerHTML=error7
        
	}

	else{
		enviar = true;
		registrarEvento();
		e.preventDefault();
	}
});

/////__________--Validacion de Modificar--___________//////

var evento00=document.getElementById("evento00");
var select00=document.getElementById("select00");
var select2=document.getElementById("select2");
var entradas00=document.getElementById("entradas00");
var imagen00=document.getElementById("imagen00");
var hora00=document.getElementById("hora00");
var fecha00=document.getElementById("fecha00");

var errorEvento00=document.getElementById("errorEvento00")
var errorSelect00=document.getElementById("errorSelect00");
var errorSelect2=document.getElementById("errorSelect2");
var errorEntra00=document.getElementById("errorEntra00");
var errorImg00=document.getElementById("errorImg00");
var errorHora00=document.getElementById("errorHora00");
var errorFecha00=document.getElementById("errorFecha00");

document.getElementById("modificar").addEventListener("click", e => {
	var error1=""
	var error2= ""
	var error3=""
	var error4=""
	var error5=""
	var error6=""
	var error7=""
    var enviar=false;
    var cantidadExp = /^[0-9]+$/;
    errorEvento00.innerHTML =""
    errorSelect00.innerHTML=""
    errorSelect2.innerHTML=""
    errorEntra00.innerHTML =""
    errorImg00.innerHTML=""
    errorHora00.innerHTML=""
    errorFecha00.innerHTML=""


	if(evento00.value.length < 10){
        e.preventDefault();
	    error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un mínimo de 10 caracteres';
		enviar = true;
	
	}
	if(evento00.value.length > 30){
        e.preventDefault();
		 error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un maximo de 30 caracteres';
		enviar = true;
	
	}

	if (select00.value =='tipo') {
		e.preventDefault();
		 error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el tipo de Evento';

	}

	if (select2.value =='lugar') {
		e.preventDefault();
		 error3+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el lugar de Evento';

	}

	

	if(!cantidadExp.test(entradas00.value)){
        e.preventDefault();
	    error4+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la cantidad de asientos que tendra la mesa';
		enviar = true;
	
	}

	if(entradas00.value =='0'){
        e.preventDefault();
		 error4+='<i  class="bi bi-exclamation-triangle-fill"></i> La cantidad de entradas del evento debe ser mayor a 0';
		enviar = true;
	}

	if (imagen00.value.length < 1) {
		e.preventDefault();
		error5+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese una imagen';
		enviar = true;
	}
	if (hora00.value.length < 1) {
		e.preventDefault();
		error6+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la hora';
		enviar = true;
	}
	if (fecha00.value.length < 1 ) {
		e.preventDefault();
		error7+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la fecha';
		enviar = true;
	}



	if (enviar) {
    errorEvento00.innerHTML =error1
    errorSelect00.innerHTML=error2
    errorSelect2.innerHTML =error3
    errorEntra00.innerHTML =error4
     errorImg00.innerHTML=error5
    errorHora00.innerHTML=error6
    errorFecha00.innerHTML=error7
        
	}

	else{
		enviar = true;
		//modificarE();
		//e.preventDefault();
	}
});



var id;


//-------------------------------ANULAR CON AJAX----------------------------------------

  $(document).on('click', '.delete', function() {
   id = this.id 
   console.log(id);
   $.ajax({
    url: "",
    dataType: 'json',
    method: "POST",
    data: {mostrarT: 'anular', id},
    success(data){
    $('.anularT').html( '¿Deseas anular el Evento <b style="color: #040855">'+data[0].nombre+'</b> ?');
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
             title:'<div class="d-flex"><img src="assets/img/pape.png" width="50" height="50" class="box-shadow p-1" > <p class="fw-bold p-1 mt-2" style="color:#cd0000!important;font-size:20px;"><b>Evento Anulado!</b></p></div>',
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
                    <th class="text-left">${fila.nombre}</th>
                    <th class="text-left">${fila.tipoEvento}</th>
                    <th class="text-left">${fila.lugar}</th>
                    <th class="text-left">${fila.entradas}</th>
                    <th class="text-left">${fila.fecha}</th>
                    <th class="text-left">${fila.hora}</th>
                   <th  class ="text-center">
                       <img src="assets/img/${fila.imagen}" width="50" height="42" class="box-shadow" >
                     </th>
                  
                    <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                        <button id="${fila.nombre}" data-bs-toggle="modal" data-bs-target="#restta" class="btn90 fw-bold  mb-1 col-4 col-md-3 restaurar " type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurar Area" ><i class="bi bi-check2-circle "></i></button>
                    </th>
        
              </tr>
          `
        })
        $('#restaurarT').html(lista2);
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
    data: {mostrarT: 'MUESTRA', id},
    success(data){
    $('#mostrarR').html( '¿Deseas restaurar el Evento <b style="color: #040855">'+data[0].nombre+'</b> ?');
    }

   })

  });
   

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
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El Evento  ya está registrado, restaure otro evento!</p></div>',
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
          title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2" style="color:#c79b2d!important;font-size:20px;"><b>Evento Restaurado!</b></p></div>',
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
  })*/
