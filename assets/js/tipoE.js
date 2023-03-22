//------------------------------- FUNCION MOSTRAR AJAX ------------------------------//
let tabla;
mostrarTabla();

function mostrarTabla() {
    $.ajax({
        url: '',
        type: 'POST',
        dataType: 'JSON',
        data: {mostrar: 'mostrar', tabla: 'tabla'},
        success(response) {

            let lista = '';
            response.forEach(fila => {
                lista += `
			  <tr class="fila">
              <th class="text-left">${fila.cod_tipo}</th>
              <th class="text-left">${fila.tipo}</th>
              <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                   <button class="btn btn90 fw-bold edit" id="${fila.cod_tipo}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#modificarT" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar"><i class="bi bi-pencil-fill "></i></button>
                   <button class="btn btn11 fw-bold delete" id="${fila.cod_tipo}" mb-1 col-4 col-md-3" type="button" data-bs-toggle="modal" data-bs-target="#anularT" data-bs-toggle="tooltip" data-bs-placement="top" title="Anular" ><i class="bi bi-trash-fill "></i></button>
			  </th>
        
			 </tr>
					`
            })
            $('#tbody').html(lista);
            tabla = $('#tablaTipo').DataTable({responsive: true});
        }
    })
}


/////__________--Validacion de Registrar--___________//////

var tipo = document.getElementById("tipo");

var errorTipo = document.getElementById("errorTipo");


document.getElementById("envio").addEventListener("click", e => {
    var error1 = ""
    var enviar = false;
    errorTipo.innerHTML = ""


    if (tipo.value.length < 1) {
        e.preventDefault();
        error1 += '<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el tipo de Evento';
        enviar = true;

    }


    if (tipo.value.length > 15) {
        e.preventDefault();
        error1 += '<i  class="bi bi-exclamation-triangle-fill"></i> Debe ser menor a 15 caracteres';
        enviar = true;

    }


    if (enviar) {
        errorTipo.innerHTML = error1;

    } else {
        enviar = true;
        registrarTipo();
        e.preventDefault();
    }
});

/////////_______________-- FUNCION REGISTRAR AJAX--___________________//////////

function registrarTipo() {

    var tipo = $("#tipo").val();
    let data = {registrarT: "registrarT", tipo: tipo};
    console.log('Editar TipoEvento:');
    console.log(data);
    $.ajax({
        url: "",
        method: "post",
        dataType: "json",
        data: data,
        success(data) {
            if (data.resultado === "repetido") {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    html: ' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El tipo de Evento <b>' + tipo + '</b> ya está registrado, ingrese otro tipo de Evento!</p></div>',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: 3000,
                })

            } else {
                console.log(data);
                tabla.destroy();
                mostrarTabla();
                $('#cerrar').click();
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    title: '<div class="d-flex"><img src="assets/img/regist.png" width="60" height="60" class="box-shadow p-1 " ><p class="fw-bold p-1 mt-2" style="color: #008f20!important;font-size:20px;"><b>Tipo de Evento Registrado!</b></p></div>',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                })
            }

        }


    });

    return false;

}


/////__________--Validacion de Modificar--___________//////

var tipo00 = document.getElementById("tipo00");

var errorTipo00 = document.getElementById("errorTipo00");


document.getElementById("modificar").addEventListener("click", e => {
    var error1 = ""
    var enviar = false;
    errorTipo00.innerHTML = ""


    if (tipo00.value.length < 1) {
        e.preventDefault();
        error1 += '<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese el tipo de Evento';
        enviar = true;

    }


    if (tipo00.value.length > 15) {
        e.preventDefault();
        error1 += '<i  class="bi bi-exclamation-triangle-fill"></i> Debe ser menor a 15 caracteres';
        enviar = true;

    }


    if (enviar) {
        errorTipo00.innerHTML = error1;

    } else {
        enviar = true;
        modificarTipo();
        e.preventDefault();
    }
});

var id;

//---------------------FUNCION MODIFICAR CON AJAX -----------------------------

$(document).on('click', '.edit', function () {
    id = this.id
    console.log(id);
    $.ajax({
        url: "",
        dataType: 'json',
        method: "POST",
        data: {mostrarT: 'editar', id: id},
        success(data) {
            $('#tipo00').val(data[0].tipo);
        }

    })

});


//--------------------------------------------------------------------------

function modificarTipo() {
    let tip = $('#tipo00').val();
    let data = {
        tip: tip,
        id: id
    }
    console.log(data);
    $.ajax({
        url: '',
        method: 'POST',
        dataType: 'json',
        data: data,
        success(data) {
            if (data.resultado === "errorT") {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    html: ' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El tipo de Evento <b>' + tip + '</b> ya está registrado, ingrese otro tipo de Evento!</p></div>',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: 3000,
                })
            } else {
                console.log(data);
                tabla.destroy();
                mostrarTabla();
                $('#close').click();
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    title: '<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2" style="color:#c79b2d!important;font-size:20px;"><b>Tipo de Evento Modificado!</b></p></div>',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
            }
        }
    })

    return false;

}


//-------------------------------ANULAR CON AJAX----------------------------------------

$(document).on('click', '.delete', function () {
    id = this.id
    console.log(id);
    $.ajax({
        url: "",
        dataType: 'json',
        method: "POST",
        data: {mostrarT: 'anular', id},
        success(data) {
            $('.anularTipo').html('¿Deseas anular el Tipo de Evento <b style="color: #040855">' + data[0].tipo + '</b> ?');
        }

    })

});

//-----------------------------------------------------------------------------------------

$('#anular').click((e) => {
    e.preventDefault();
    $.ajax({
        url: '',
        method: 'post',
        dataType: 'json',
        data: {id, borrar: 'borrar'},
        success(data) {
            console.log(data);
            tabla.destroy();
            mostrarTabla();
            tabla2.destroy();
            mostrarTablaR();
            $('#closed').click();
            Swal.fire({
                toast: true,
                position: 'top-end',
                title: '<div class="d-flex"><img src="assets/img/pape.png" width="50" height="50" class="box-shadow p-1" > <p class="fw-bold p-1 mt-2" style="color:#cd0000!important;font-size:20px;"><b>Tipo de Evento Anulado!</b></p></div>',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
            });
        }
    })
})


//-------------------------------PAPELERA CON AJAX----------------------------------------

//------------------------------------MOSTRAR TABLA-----------------------------------------

let tabla2;
mostrarTablaR();

function mostrarTablaR() {
    $.ajax({
        url: '',
        type: 'POST',
        dataType: 'JSON',
        data: {papelera: 'mostrar', tabla2: 'tabla2'},
        success(response) {

            let lista2 = '';
            response.forEach(fila => {
                lista2 += `
              <tr class="fila">
                    <th class="text-left">${fila.cod_tipo}</th>
                    <th class="text-left" >${fila.tipo}</th>
                  
                    <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                        <button id="${fila.cod_tipo}" data-bs-toggle="modal" data-bs-target="#restta" class="btn90 fw-bold  mb-1 col-4 col-md-3 restaurar" type="button"  data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurar Area" ><i class="bi bi-check2-circle "></i></button>
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
$(document).on('click', '.restaurar', function () {
    id = this.id
    console.log(id);
    $.ajax({
        url: "",
        dataType: 'json',
        method: "POST",
        data: {mostrarT: 'rest', id},
        success(data) {
            $('.mostrarR').html('¿Deseas restaurar el tipo de Evento <b style="color: #040855">' + data[0].tipo + '</b> ?');

        }

    })

})


//--------------------------------------------------------------------------

$('#lito').click((e) => {
    e.preventDefault();
    $.ajax({
        url: '',
        method: 'post',
        dataType: 'json',
        data: {id, restaurar: 'restaurar'},
        success(data) {
            if (data.resultado === "error") {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    html: ' <div class="d-flex"><img src="assets/img/x.png" width="50" height="50" class="box-shadow p-1" > <p class="l p-1">El tipo de Evento ya está registrado, restaure otro tipo de Evento!</p></div>',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: 3000,
                })

            } else {
                console.log(data);
                $('#cancelar').click();
                tabla.destroy();
                mostrarTabla();
                tabla2.destroy();
                mostrarTablaR();
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    title: '<div class="d-flex"><img src="assets/img/modi.png" width="60" height="65" class="box-shadow p-1" ><p class="fw-bold p-1 mt-2"  style="color:#c79b2d!important;font-size:20px;"><b>Tipo de Evento Restaurado</b></p></div>',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });

            }

        }
    })
})
