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
                   <th class="text-left">${fila.id_mesa}</th>
                   <th class="text-left">${fila.evento}</th>
                   <th class="text-left">${fila.area}</th>
                   <th class="text-left">C${fila.posiColumna} - F${fila.posiFila}</th>
                   <th class="text-left">${fila.cantPuesto}</th>
                   <th class="text-left">${fila.precio}</th>
                   <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                   <button class="btn btn90 fw-bold edit" id="${fila.id_mesa}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#modificarMesa" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar"><i class="bi bi-pencil-fill "></i></button>
                   <button class="btn btn11 fw-bold delete" id="${fila.id_mesa}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#eliminarMesa" data-bs-toggle="tooltip" data-bs-placement="top" title="Anular" ><i class="bi bi-trash-fill "></i></button>
			       </th>
        
			      </tr>
					`
				})
				$('#tbody').html(lista);
				tabla = $('#tablaMesas').DataTable({responsive: true});
			}
		})
	}

//----------------------------- AGREGAR SELECT2 ------------------------------------//
$(document).ready(function(){

  $(".registrar").select2({
    theme:'bootstrap-5',
    dropdownParent:$('#exampleRegistrarM .contenido'),
    selectionCssClass:"form-select",
    dropdownCssClass:"select",
    searchCssClass:"buscar",
    width:'100%'
  });

  $(".modificar").select2({
    theme:'bootstrap-5',
    dropdownParent:$('#modificarMesa .contenido'),
    selectionCssClass:"form-select",
    dropdownCssClass:"select",
    searchCssClass:"buscar",
    width:'100%'
  });

  function probandoAjax(){


   let evento = $("#select").val();
   let area = $("#selectArea").val();
   let precio = $("#precio").val();
   let posiColumna= $("#posicionColumna").val();
   let posiFila= $("#posicionFila").val();
   let cantPuesto= $("#numPuesto").val();

      $.ajax({
      url:"",
      method: "POST",
      dataType: "JSON",
      data:{
        probando: true,
        evento,
        area,
        precio,
        posiColumna,
        posiFila,
        cantPuesto
      },
      success: function(data){
        console.log(data);

        if (data.resultado === "posicion repetida."){
         Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La Posición <b> C'+posiColumna+' - F'+posiFila+'</b> ya está registrado, ingrese otra posición!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
         
         }

       else if (data.resultado === "cantidad de entradas."){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">Quedan solamente <b>'+data.cant+'</b> entradas disponibles! </p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
            
    }
     else if (data.resultado === "evento"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El Evento <b>'+evento+'</b> ya no está disponible para las mesas! </p></div>',
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
            swal.fire({
               toast: true,
               position: 'top-end',
               title:'<div class="d-flex"><img src="assets/img/regist.png" width="60" height="60" class="box-shadow p-1 " ><p class="fw-bold p-1 mt-2" style="color: #008f20!important;font-size:20px;"><b>Mesa Registrada!</b></p></div>',
               showConfirmButton:false,
               timer:2500,
               timerProgressBar:true,
          })

         }

}
    })
  }

   

$('#envio').click(function(e){
var select=document.getElementById("select");
var selectArea=document.getElementById("selectArea");
var posicionColumna=document.getElementById("posicionColumna");
var posicionFila=document.getElementById("posicionFila");
var numPuesto=document.getElementById("numPuesto");
var precio=document.getElementById("precio");


var errorSelect=document.getElementById("errorSelect")
var errorSelectArea=document.getElementById("errorSelectArea");
var errorPosicionC=document.getElementById("errorPosicionC");
var errorPosicionF=document.getElementById("errorPosicionF");
var errorPuestos=document.getElementById("errorPuestos");
var errorPrecio=document.getElementById("errorPrecio");


  var error1=""
  var error2= ""
  var error3=""
  var error4=""
  var error5=""
  var error6=""
    var enviar=false;
    var cantidadExp = /^[0-9]+$/;
    var precioExp = /^\d{1,10}\,\d{2}$/;
    errorSelect.innerHTML=""
    errorSelectArea.innerHTML=""
    errorPosicionC.innerHTML =""
    errorPosicionF.innerHTML =""
    errorPuestos.innerHTML=""
    errorPrecio.innerHTML=""
    


  if (select.value =='Eventos') {
    e.preventDefault();
    error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el nombre del Evento';
        enviar = true;
  }


  
  if (selectArea.value =='Areas') {
    e.preventDefault();
     error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el area donde se ubica la mesa';

  }
  
  

  if(posicionColumna.value.length < 1){
        e.preventDefault();
     error3+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la posicion columna de la mesa';
    enviar = true;
  
  }

  if(posicionColumna.value =='0'){
        e.preventDefault();
     error3+='<i class="bi bi-exclamation-triangle-fill"></i> Ingrese número de columna';
    enviar = true;
  }

  if(posicionFila.value.length < 1){
        e.preventDefault();
     error4+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la posición fila de la mesa';
    enviar = true;
  
  }

  if(posicionFila.value =='0'){
        e.preventDefault();
     error4+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese número de fila';
    enviar = true;
  }

  if(!cantidadExp.test(numPuesto.value)){
        e.preventDefault();
     error5+='<i class="bi bi-exclamation-triangle-fill""></i> Ingrese la cantidad de asientos que tendra la mesa';
    enviar = true;
  
  }

  if(numPuesto.value =='0'){
        e.preventDefault();
     error5+='<i  class="bi bi-exclamation-triangle-fill""></i> La cantidad de puestos debe ser mayor a 0';
    enviar = true;
  }

  if(!precioExp.test(precio.value)){
        e.preventDefault();
    error6+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el precio';
     enviar = true;
  }

  if (enviar) {
   errorSelect.innerHTML=error1
    errorSelectArea.innerHTML=error2
    errorPosicionC.innerHTML =error3
    errorPosicionF.innerHTML =error4
    errorPuestos.innerHTML=error5
    errorPrecio.innerHTML=error6
        
  }

  else{
    enviar = true;
    probandoAjax();
    e.preventDefault();

  }

    
  })

});


////---------------------------MOSTRAR SELECT AREA-------------------------------
mostrarArea();
let inpu2;
inpu2= '<option value="Areas" class="opcion" >Areas</option>';
function mostrarArea(){
		$.ajax({
			url: '',
			type: 'POST',
			dataType: 'JSON',
			data: {select2: 'mostrar', inputA:'xd'}, 
			success(response){

				let op = '';
				response.forEach(fila => {
					op += `<option  class="opcion" value="${fila.nombArea}">${fila.nombArea}</option> `
				})
				$('#selectArea').html(inpu2 + op);
			}
		})
	}


////---------------------------MOSTRAR SELECT EVENTO-------------------------------
mostrarEvento();
let input;
input= '<option value="Eventos" class="opcion" >Eventos</option>';
function mostrarEvento(){
		$.ajax({
			url: '',
			type: 'POST',
			dataType: 'JSON',
			data: {select: 'mostrar', input:'xd'}, 
			success(response){

				let opE = '';
				response.forEach(fila => {
					opE += `<option  class="opcion" value="${fila.nombre}">${fila.nombre}</option> `
				})
				$('#select').html(input + opE);
			}
		})
	}


/////__________--Validacion de Registrar--___________//////



/////////_______________-- FUNCION REGISTRAR AJAX--___________________//////////


var id;

//-------------------------------MODIFICAR CON AJAX----------------------------------------
//--------------------------------------------------------------------------
  $(document).on('click', '.edit', function() {
   id = this.id 
   console.log(id);
   $.ajax({
    url: "",
    dataType: 'json',
    method: "POST",
    data: {mostrarM: 'editar', id},
    success(data){
    $('#select00').html(`<option  class="opcion" value="${data[0].evento}">${data[0].evento}</option> `);
    $('#selectArea00').html(`<option  class="opcion" value="${data[0].area}">${data[0].area}</option> `);
    $('.precio0').val(data[0].precio);
    $('#posicionColumna00').val(data[0].posiColumna);
    $('#posicionFila00').val(data[0].posiFila);
    $('#numPuesto00').val(data[0].cantPuesto);
    }

   })

  });

//--------------------------------------------------------------------------
function modificarMesa(){
    let event=$('#select00').val();
    let ar= $('#selectArea00').val();
    let pre=$('.precio0').val();
    let pColumna=$('#posicionColumna00').val();
    let pFila=$('#posicionFila00').val();
    let numPuesto= $('#numPuesto00').val();
     console.log(event + ar+pre+pColumna+pFila);
    $.ajax({
      url: '',
      method: 'POST',
      dataType: 'json',
      data:{modificar:true, event, ar, pre, pColumna, pFila,  id, numPuesto},
      success(data){
        if (data.resultado === "Error Posicion"){
         Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La Posición <b> C'+pColumna+' - F'+pFila+'</b> ya está registrado, ingrese otra posición!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
         
         }

       else if (data.resultado === "cantidad de entradas"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">Quedan <b>'+data.cant+'</b> entradas disponibles! </p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
            
    }
     else if (data.resultado === "NO modificar"){
        Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">No se puede Modificar la Mesa, ya que se han realizado ventas du sus puestos! </p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
            
    }
    else{
            console.log(data);
            tabla.destroy();
            mostrarTabla();
            $('#closed').click();
            swal.fire({
               toast: true,
               position: 'top-end',
               title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold" style="color:#c79b2d!important;font-size:20px;"><b>Mesa Modificada!</b></p></div>',
               showConfirmButton:false,
               timer:2500,
               timerProgressBar:true,
          })

         }

      }
    })

    return false;
  }



/////__________--Validacion de Modificar--___________//////

var posicionColumna00=document.getElementById("posicionColumna00");
var posicionFila00=document.getElementById("posicionFila00");
var precio00=document.getElementById("precio00");
var numPuesto00=document.getElementById("numPuesto00");
var errorPosicionC00=document.getElementById("errorPosicionC00");
var errorPosicionF00=document.getElementById("errorPosicionF00");
var errorPrecio00=document.getElementById("errorPrecio00");
var errorPuestos00=document.getElementById("errorPuestos00");

document.getElementById("modifica").addEventListener("click", e => {
  var error1=""
  var error2= ""
  var error3=""
  var error4=""
    var enviar=false;
    var precioExp = /^\d{1,10}\,\d{2}$/;
    var cantidadExp = /^[0-9]+$/;
    errorPosicionC00.innerHTML =""
    errorPosicionF00.innerHTML =""
    errorPrecio00.innerHTML=""
    errorPuestos00.innerHTML=""
  
  

  if(posicionColumna00.value.length < 1){
        e.preventDefault();
     error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la posicion columna de la mesa';
    enviar = true;
  
  }

  if(posicionColumna00.value =='0'){
        e.preventDefault();
     error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese número de columna';
    enviar = true;
  }

  if(posicionFila00.value.length < 1){
        e.preventDefault();
     error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la posición fila de la mesa';
    enviar = true;
  
  }

  if(posicionFila00.value =='0'){
        e.preventDefault();
     error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese número de fila';
    enviar = true;
  }

  if(!precioExp.test(precio00.value)){
        e.preventDefault();
    error4+='<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el precio';
     enviar = true;
  }

  if(!cantidadExp.test(numPuesto00.value)){
        e.preventDefault();
     error3+='<i class="bi bi-exclamation-triangle-fill""></i> Ingrese la cantidad de asientos que tendra la mesa';
    enviar = true;
  
  }

  if(numPuesto00.value =='0'){
        e.preventDefault();
     error3+='<i  class="bi bi-exclamation-triangle-fill""></i> La cantidad de puestos debe ser mayor a 0';
    enviar = true;
  }
  
  

  if (enviar) {
    errorPosicionC00.innerHTML =error1
    errorPosicionF00.innerHTML =error2
    errorPrecio00.innerHTML=error4
    errorPuestos00.innerHTML=error3
        
  }

  else{
    enviar = true;
          modificarMesa();
          e.preventDefault();

  }
});


  //-------------------------------ANULAR CON AJAX----------------------------------------

  $(document).on('click', '.delete', function() {
    id = this.id;

    $.ajax({
    url: "",
    dataType: 'json',
    method: "POST",
    data: {mostrarM: 'anular', id},
    success(data){
    $('.anularM').html( '¿Deseas anular la Mesa  <b style="color: #040855">'+'N° '+data[0].id_mesa+'</b> ?');
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
        if (data.resultado === "error"){
         Swal.fire({
          toast: true,
          position: 'top-end',
          html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1"> No se puede Anular la Mesa, porque ya se han realizado ventas!</p></div>',
          showConfirmButton:false,
          timer:3000,
          timerProgressBar:3000,
          })
         
        }
        else{
          console.log(data);
          tabla.destroy();
          mostrarTabla();
          $('#closed').click();
          Swal.fire({
          toast: true,
          position: 'top-end',
          title:'<div class="d-flex"><img src="assets/img/pape.png" width="50" height="50" class="box-shadow p-1" > <p class="fw-bold p-1 mt-2" style="color:#cd0000!important;font-size:20px;"><b>Mesa Anulada!</b></p></div>',
          showConfirmButton:false,
          timer:2500,
          timerProgressBar:true,
        });
      }
      }
    })
  })


