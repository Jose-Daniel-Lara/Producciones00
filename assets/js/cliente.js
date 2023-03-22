
//------------------------------- FUNCION MOSTRAR AJAX ------------------------------//

let tabla ;
function mostrarTabla(){
    $.ajax({
        url: '',
        type: 'POST',
        dataType: 'JSON',
        encode: true,
        data: {mostrar: 'mostrar', tabla: 'tabla'},
        success(response){
            console.log(response);
            let lista = '';
            if (response.success){
                let data = response.data;
                data.forEach(fila => {
                    lista += `
			       <tr class="fila">
                     <th class="text-left">${fila.cedula}</th>
                     <th class="text-left">${fila.nombre}</th>
                     <th class="text-left">${fila.apellido}</th>
                     <th class="text-left">${fila.telefono}</th>
                     <th class="text-left">${fila.correoElectronico}</th>
                     <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                     <button class="btn btn90 fw-bold edit" id="${fila.cedula}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#modificarC" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar"><i class="bi bi-pencil-fill "></i></button>
                     <button class="btn btn11 fw-bold delete" id="${fila.cedula}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#eliminarC" data-bs-toggle="tooltip" data-bs-placement="top" title="Anular" ><i class="bi bi-trash-fill "></i></button>
			         </th>
        
			       </tr>
					`
                })
            }
            $('#tbody').html(lista);
            tabla = $('#tablaClientes').DataTable({responsive: true});
        }
    })
}

$(document).ready(function(){

    mostrarTabla();

    $(".ti").select2({
        theme:'bootstrap-5',
        dropdownParent:$('#exampleRegistrarC .contenido'),
        selectionCssClass:"form-select",
        dropdownCssClass:"select",
        searchCssClass:"buscar",
        width:'100%'
    });

    $('#config1').on('click', function () {
        var checked = $(this).prop('checked');
        if (checked == true) {
            $(".tel").css('display', 'block');
        } else {
            $(".tel").css('display', 'none');
        }
    })

    $('#config2').on('click', function () {
        var checked = $(this).prop('checked');
        if (checked == true) {
            $(".email").css('display', 'block');
        } else {
            $(".email").css('display', 'none');
        }
    })

    $('#config3').on('click', function () {
        var checked = $(this).prop('checked');
        if (checked == true) {
            $(".tel00").css('display', 'block');
        } else {
            $(".tel00").css('display', 'none');
        }
    })

    $('#config4').on('click', function () {
        var checked = $(this).prop('checked');
        if (checked == true) {
            $(".email00").css('display', 'block');
        } else {
            $(".email00").css('display', 'none');
        }
    })

});


/////__________--Validacion de Registrar--___________//////
var select=document.getElementById("select");
var cedula=document.getElementById('cedula');
var nombre=document.getElementById("nombre");
var apellido=document.getElementById("apellido");


var errorSelect=document.getElementById("errorSelect");
var errorCedula=document.getElementById("errorCedula");
var errorNombre=document.getElementById("errorNombre");
var errorApellido=document.getElementById("errorApellido");



document.getElementById("envio").addEventListener("click", e => {
    var error1=""
    var error2= ""
    var error3=""
    var error4=""
    var enviar=false;
    var checkTel = $('#config1').prop('checked');
    var checkEmail = $('#config2').prop('checked');
    errorSelect.innerHTML="";
    errorCedula.innerHTML ="";
    errorNombre.innerHTML ="";
    errorApellido.innerHTML="";


    if (select.value =='..') {
        e.preventDefault();
        error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Error!';

    }

    if (cedula.value.length < 7) {
        e.preventDefault();
        error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Cédula Inválida';
        enviar = true;

    }

    if(cedula.value =='0'){
        e.preventDefault();
        error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Cédula Inválida';
        enviar = true;
    }

    if(nombre.value.length < 3){
        e.preventDefault();
        error3+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un mínimo de 3 caracteres';
        enviar = true;

    }
    if(nombre.value.length > 10){
        e.preventDefault();
        error3+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un máximo de 10 caracteres';
        enviar = true;

    }

    if(apellido.value.length < 3){
        e.preventDefault();
        error4+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un mínimo de 3 caracteres';
        enviar=true;

    }
    if(apellido.value.length > 10){
        e.preventDefault();
        error4+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un máximo de 10 caracteres';
        enviar = true;

    }

    if (checkTel){
        if (validarT('telefono','errorTelefono') === false){
            e.preventDefault();
            enviar = true;
        }
    }

    if (checkEmail){
        if (validarC('correo','errorCorreo') === false){
            e.preventDefault();
            enviar = true;
        }
    }
    e.preventDefault();

    if (enviar) {
        errorSelect.innerHTML=error1
        errorCedula.innerHTML =error2
        errorNombre.innerHTML =error3
        errorApellido.innerHTML=error4
    }

    else{
        enviar = true;
        registrarCliente();
        e.preventDefault();
    }
});

function validarC(objCorreo, objCorreoError){//VALIDAR CORREO
    var correo=document.getElementById(objCorreo);
    var errorCorreo=document.getElementById(objCorreoError);
    var error5=""
    var correoExp = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/;
    var ok = true;

    if (!correoExp.test(correo.value)) {
        error5=' <i  class="bi bi-exclamation-triangle-fill"></i> Correo inválido';
        ok=false;
    }
    else{
        error5="";
        ok = true;
    }
    errorCorreo.innerHTML=error5
    return ok;
}

function validarT(objTel, objTelError){//VALIDAR TELEFONO
    var telefono=document.getElementById(objTel);
    var errorTelefono=document.getElementById(objTelError);
    var error6=""
    var ok = true;

    if (telefono.value.length < 1) {
        error6='<i  class="bi bi-exclamation-triangle-fill"></i>Ingrese el número de teléfono';
        ok=false;
    }
    else{
        error6="";
        ok= true;
    }
    errorTelefono.innerHTML=error6
    return ok;
}



///////////////////////////////////////////////////////

function validarCT(){//VALIDAR EL CHECK

    $('#config1').on('click', function () {
        var activarT = $('#config1').prop('checked');
        if (activarT == true) {
            $(".tel").css('display', 'block');
            $('#envio').on('click' ,function(e){
                validarT();
            });
        } else {
            $(".tel").css('display', 'none');
        }
    })

    $('#config2').on('click', function () {
        var activarC = $('#config2').prop('checked');
        if (activarC == true) {
            $(".email").css('display', 'block');
            $('#envio').on('click' ,function(e){
                validarC();
            });

        } else {
            $(".email").css('display', 'none');
        }
    })

}

/////////_______________-- FUNCION REGISTRAR AJAX--___________________//////////

function registrarCliente(){

    let tipoCI = $("#select").val();
    let cedula = $("#cedula").val();
    let nombre = $("#nombre").val();
    let apellido= $("#apellido").val();
    let telefono= $("#telefono").val();
    let correo= $("#correo").val();

    $.ajax({
        url:"",
        method:"post",
        dataType:"json",
        data:{ registrarC:"registrarC", tipoCI, cedula, nombre, apellido, telefono, correo},
        success(data){
            if (data.resultado === "error cedula"){
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La Cédula <b>'+cedula+'</b> ya está registrada, ingrese otra cédula!</p></div>',
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
                    title:'<div class="d-flex"><img src="assets/img/regist.png" width="60" height="60" class="box-shadow p-1 " ><p class="fw-bold p-1 mt-2" style="color: #008f20!important;font-size:20px;"><b>Cliente Registrado!</b></p></div>',
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

var cedula00=document.getElementById('cedula00');
var nombre00=document.getElementById("nombre00");
var apellido00=document.getElementById("apellido00");

var errorCedula00=document.getElementById("errorCedula00");
var errorNombre00=document.getElementById("errorNombre00");
var errorApellido00=document.getElementById("errorApellido00");

document.getElementById("modifica").addEventListener("click", e => {
    var error2= ""
    var error3=""
    var error4=""
    var enviar=false;
    var checkTel = $('#config3').prop('checked');
    var checkEmail = $('#config4').prop('checked');
    errorCedula00.innerHTML ="";
    errorNombre00.innerHTML ="";
    errorApellido00.innerHTML="";

    if (cedula00.value.length < 9) {
        e.preventDefault();
        error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Cédula Inválida';
        enviar = true;

    }

    if(cedula00.value =='0'){
        e.preventDefault();
        error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Cédula Inválida';
        enviar = true;
    }

    if(nombre00.value.length < 3){
        e.preventDefault();
        error3+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un mínimo de 3 caracteres';
        enviar = true;

    }
    if(nombre00.value.length > 10){
        e.preventDefault();
        error3+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un máximo de 10 caracteres';
        enviar = true;

    }

    if(apellido00.value.length < 3){
        e.preventDefault();
        error4+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un mínimo de 3 caracteres';
        enviar=true;

    }
    if(apellido00.value.length > 10){
        e.preventDefault();
        error4+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un máximo de 10 caracteres';
        enviar = true;

    }

    if (checkTel){
        if (validarT('telefono00','errorTelefono00') === false){
            e.preventDefault();
            enviar = true;
        }
    }

    if (checkEmail){
        if (validarC('correo00','errorCorreo00') === false){
            e.preventDefault();
            enviar = true;
        }
    }
    //validarCT00();
    e.preventDefault();


    if (enviar) {
        errorCedula00.innerHTML =error2
        errorNombre00.innerHTML =error3
        errorApellido00.innerHTML=error4
    }

    else{
        enviar = true;
        modificarCliente();
        e.preventDefault();
    }
});




/////////////////////////////////////////////////////////////


function validarC00(){//VALIDAR CORREO EN MODIFICAR
    var correo00=document.getElementById('correo00');
    var errorCorreo00=document.getElementById('errorCorreo00');
    var error5=""
    var correoExp = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/;

    if (!correoExp.test(correo00.value)) {
        error5=' <i  class="bi bi-exclamation-triangle-fill"></i> Correo inválido';
    }
    else{
        error5="";
    }

    errorCorreo00.innerHTML=error5
}

function validarT00(){ //VALIDAR TELEFONO EN MODIFICAR
    var telefono00=document.getElementById("telefono00");
    var errorTelefono00=document.getElementById("errorTelefono00");
    var error6=""

    if (telefono00.value.length < 1) {
        error6='<i  class="bi bi-exclamation-triangle-fill"></i>Ingrese el número de teléfono';
    }
    else{
        error6="";
    }
    errorTelefono00.innerHTML=error6

}

function validarCT00(){//VALIDAR CHECK EN MODIFICAR

    $('#config3').on('click', function () {
        var activarT = $('#config3').prop('checked');
        if (activarT == true) {
            $(".tel00").css('display', 'block');
            $('#modifica').on('click' ,function(e){
                validarT00();
            });
        } else {
            $(".tel00").css('display', 'none');
        }
    })

    $('#config4').on('click', function () {
        var activarC = $('#config4').prop('checked');
        if (activarC == true) {
            $(".email00").css('display', 'block');
            $('#modifica').on('click' ,function(e){
                validarC00();
            });

        } else {
            $(".email00").css('display', 'none');
        }
    })

}

//--------------------------------------------------------------------------

$(document).on('click', '.edit', function() {
    id = this.id
    console.log(id);
    $.ajax({
        url: "",
        dataType: 'json',
        method: "POST",
        data: {mostrarC: 'editar', id},
        success(data){
            $('#cedula00').val(data[0].cedula);
            $('#nombre00').val(data[0].nombre);
            $('#apellido00').val(data[0].apellido);
            $('#telefono00').val(data[0].telefono);
            $('#correo00').val(data[0].correoElectronico);
        }

    })

});

//--------------------------------------------------------------------------

function modificarCliente(){
    let cedula00=$('#cedula00').val();
    let nombre00=$('#nombre00').val();
    let apellido00=$('#apellido00').val();
    let tel00=$('#telefono00').val();
    let corr00=$('#correo00').val();
    console.log(cedula00+ nombre00+ apellido00+ tel00+ corr00);
    $.ajax({
        url: '',
        method: 'POST',
        dataType: 'json',
        data:{cedula00, nombre00, apellido00,tel00,corr00, id},
        success(data){
            if (data.resultado === "error CI"){
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    html:' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">La Cédula <b>'+cedula00+'</b> ya está registrada, ingrese otra cédula!</p></div>',
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
                    title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2" style="color:#c79b2d!important;font-size:20px;"><b>Cliente Modificado!</b></p></div>',
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
        data: {mostrarC: 'anular', id},
        success(data){
            $('.anularC').html( '¿Deseas anular al Cliente <b style="color: #040855">'+data[0].nombre+' '+data[0].apellido+'</b> ?');
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
                title:'<div class="d-flex"><img src="assets/img/pape.png" width="50" height="50" class="box-shadow p-1" > <p class="fw-bold p-1 mt-2" style="color:#cd0000!important;font-size:20px;"><b>Cliente Anulado!</b></p></div>',
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
        encode:true,
        data: {papelera: 'mostrar', tabla2: 'tabla2'},
        success(response){
            let lista2 = '';
            if (response.success){
                let data = response.data;
                data.forEach(fila => {
                    lista2 += `
              <tr class="fila">
                     <th class="text-left">${fila.cedula}</th>
                     <th class="text-left">${fila.nombre}</th>
                     <th class="text-left">${fila.apellido}</th>
                     <th class="text-left">${fila.telefono}</th>
                     <th class="text-left">${fila.correoElectronico}</th>
                  
                    <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                        <button id="${fila.cedula}" data-bs-toggle="modal" data-bs-target="#restta" class="btn90 fw-bold  mb-1 col-6 col-md-5 restaurar" type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurar Area" ><i class="bi bi-check2-circle "></i></button>
                    </th>
        
              </tr>
          `
                })
            }
            $('#restaurarC').html(lista2);
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
        data: {mostrarC: 'ehhh', id},
        success(data){
            $('.mostrarR').html( '¿Deseas restaurar al Cliente <b style="color: #040855">'+ data[0].nombre+' '+ data[0].apellido+'</b> ?');

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

            console.log(data);
            $('.cancelar').click();
            Swal.fire({
                toast: true,
                position: 'top-end',
                title:'<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2" style="color:#c79b2d!important;font-size:20px;"><b>Cliente Restaurado!</b></p></div>',
                showConfirmButton:false,
                timer:2500,
                timerProgressBar:true,
            })
            tabla.destroy();
            mostrarTabla();
            tabla2.destroy();
            mostrarTablaR();

        }
    })
})
