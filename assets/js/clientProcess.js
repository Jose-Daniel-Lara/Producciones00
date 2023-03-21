$('#config1').on('click', function () {
    var checked = $('#config1').prop('checked');
    if (checked == true) {
        $(".tel").css('display', 'block');
    } else {
        $(".tel").css('display', 'none');
    }
})
$('#config2').on('click', function () {
    var checked = $('#config2').prop('checked');
    if (checked == true) {
        $(".email").css('display', 'block');
    } else {
        $(".email").css('display', 'none');
    }
})
/////__________--Validacion de Registrar--___________//////
var select=document.getElementById("selectTipoCedula");
var cedula=document.getElementById('cedulaCliente');
var nombre=document.getElementById("nombreCliente");
var apellido=document.getElementById("apellidoCliente");


var errorSelect=document.getElementById("errorSelectTipoCedula");
var errorCedula=document.getElementById("errorCedulaCliente");
var errorNombre=document.getElementById("errorNombreCliente");
var errorApellido=document.getElementById("errorApellidoCliente");

function validarRegistroCliente(){
    var error1=""
    var error2= ""
    var error3=""
    var error4=""
    var ok = true;
    errorSelect.innerHTML="";
    errorCedula.innerHTML ="";
    errorNombre.innerHTML ="";
    errorApellido.innerHTML="";
    var checkTel = $('#config1').prop('checked');
    var checkEmail = $('#config2').prop('checked');

    if (select.value =='..') {
        error1+='<i  class="bi bi-exclamation-triangle-fill"></i> Error!';
        ok=false;
    }

    if (cedula.value.length < 7) {
        error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Cédula Inválida';
        ok=false;
    }

    if(cedula.value =='0'){
        error2+='<i  class="bi bi-exclamation-triangle-fill"></i> Cédula Inválida';
        ok=false;
    }

    if(nombre.value.length < 3){
        error3+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un mínimo de 3 caracteres';
        ok=false;
    }
    if(nombre.value.length > 10){
        error3+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un máximo de 10 caracteres';
        ok=false;
    }

    if(apellido.value.length < 3){
        error4+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un mínimo de 3 caracteres';
        ok=false;
    }
    if(apellido.value.length > 10){
        error4+='<i  class="bi bi-exclamation-triangle-fill"></i> Debe contener un máximo de 10 caracteres';
        ok=false;
    }

    if (checkTel){
        if (validarT() === false){
            ok = false;
        }
    }

    if (checkEmail){
        if (validarC() === false){
            ok = false;
        }
    }

    if (ok === false) {
        errorSelect.innerHTML=error1
        errorCedula.innerHTML =error2
        errorNombre.innerHTML =error3
        errorApellido.innerHTML=error4
    }

    return ok;
}

function validarC(){
    var correo = document.getElementById('correoCliente');
    var errorCorreo = document.getElementById('errorCorreoCliente');
    var error5 = "";
    var correoExp = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/;
    var ok = true;

    if (!correoExp.test(correo.value)) {
        error5=' <i  class="bi bi-exclamation-triangle-fill"></i> Correo inválido';
        ok = false
    }
    errorCorreo.innerHTML=error5;

    return ok;
}

function validarT(){
    var telefono = document.getElementById("telefonoCliente");
    var errorTelefono = document.getElementById("errorTelefonoCliente");
    var error6="";
    var ok = true;

    if (telefono.value.length < 1) {
        error6='<i  class="bi bi-exclamation-triangle-fill"></i>Ingrese el número de teléfono';
        ok=false;
    }
    errorTelefono.innerHTML=error6
    return ok;
}







/////__________--Validacion de 	Eliminar--___________//////
/*
$(document).ready(function(e){

     $("#anular").on("click", function(){

      eliminarCliente();

       e.preventDefault();

    });
  });

*/
/////////_______________-- FUNCIONES SAJAX--___________________//////////
$('#envioDataCliente').on('click', function () {
    var esValido = validarRegistroCliente();
    if (esValido) {
        registrarCliente();
    }

});

function registrarCliente(){
    var formData = {
        op: "clienteStore",
        tipo: $("#selectTipoCedula").val(),
        cedula: $("#cedulaCliente").val(),
        nombre : $("#nombreCliente").val(),
        apellido: $("#apellidoCliente").val(),
        telefono: $("#telefonoCliente").val(),
        correo: $("#correoCliente").val()
    };

    $.ajax({
        type: "POST",
        url: "?url=cliente",
        data: formData,
        dataType: "json",
        encode: true,
    }).done(function (data) {
        if (data.success){
            Swal.fire({
                title:'<h3 style="color:#040855!important;"><b>Registrado</b></h3>',
                html:'<p style="color:#bbb!important;" >Cliente Registrado Exitosamente!</p> <br> <div class="modal-footer"> </div>',
                showConfirmButton:false,
                timer:2500,
                timerProgressBar:true,
                imageUrl:'assets/img/check.png',
                imageWidth:'180px',
                imageHeight:'140px',
                imageAlt:'registrado'

            })
        }else{
            alert(data.msj);
        }
    }).fail(function (error) {

    });

/*
    $.ajax({
        method:"POST",
        url:"",
        data:datos,
        success:function(e){

            $('#registrarCliente').trigger('reset');
            $('#cerrar').click();
            Swal.fire({
                title:'<h3 style="color:#040855!important;"><b>Registrado</b></h3>',
                html:'<p style="color:#bbb!important;" >Cliente Registrado Exitosamente!</p> <br> <div class="modal-footer"> </div>',
                showConfirmButton:false,
                timer:2500,
                timerProgressBar:true,
                imageUrl:'assets/img/check.png',
                imageWidth:'180px',
                imageHeight:'140px',
                imageAlt:'registrado'

            })

        }

    });

   */ return false;
}

///////////////////////////////////////////////////////////////////////////////////////

function modificarCliente(){
    var datos=$("#modificarCliente").serialize();

    $.ajax({

        method:"POST",
        url:"",
        data:datos,
        success:function(e){
            $('#modificarCliente').trigger('reset');

            $('#close').click();
            Swal.fire({
                title:'<h3 style="color:#040855!important;"><b>Modificado</b></h3>',
                html:'<p style="color:#bbb!important;" >Cliente Modificado Exitosamente!</p> <br> <div class="modal-footer"> </div>',
                showConfirmButton:false,
                timer:2500,
                timerProgressBar:true,
                imageUrl:'assets/img/check.png',
                imageWidth:'180px',
                imageHeight:'140px',
                imageAlt:'regist'




            })
        }

    });
    return false;
}

///////////////////////////////////////////////////////////////////////////////////////

function eliminarCliente(){
    var datos=$("#eliminarCliente").serialize();

    $.ajax({

        method:"POST",
        url:"",
        data:datos,
        success:function(e){
            $('#closed').click();
            Swal.fire({
                title:'<h3 style="color:#040855!important;"><b>Anulado</b></h3>',
                html:'<p style="color:#bbb!important;" >Cliente Anulado Exitosamente!</p> <br> <div class="modal-footer"> </div>',
                showConfirmButton:false,
                timer:2500,
                timerProgressBar:true,
                imageUrl:'assets/img/check.png',
                imageWidth:'180px',
                imageHeight:'140px',
                imageAlt:'registr'




            })

        }



    });

    return false;
}