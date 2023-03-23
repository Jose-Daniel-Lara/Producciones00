let Descontar = 0.00;
let momentD = false;

function getPorcentajeDescuento(){
    let porc = 0.00;
    if ($('#config').is(":checked")){
        if ($('#configDesc').val().trim().length === 0){
            porc = 0.00;
        }else{
            porc = parseFloat ($('#configDesc').val());
        }
    }else{
        porc = 0.00;
    }
    return porc;
}

$('body').addClass('hidetax hidenote hidedate');
calcularMonto();

function validar(){
    let ok = true;
    $('#ventass #tt #tr').each( function(){
        let fila = $(this);

        let area = fila.find('.select-areas').val();
        let mesa = fila.find('.select-mesas').val();
        let entradas = fila.find('.value-entradas').val();
        let precio   = fila.find('.value-precio').val();
        let pagoExp = /^[0-9]+.[0-9]+$/;

        if (area.trim().length === 0) {
            fila.find('#errorSelectArea').html('<i class="bi bi-exclamation-triangle-fill" ></i> Seleccione el Área');
            ok=false;
        }else{
            fila.find('#errorSelectArea').html("");
        }

        if (mesa.trim().length === 0) {
            fila.find('#errorMesa').html('<i class="bi bi-exclamation-triangle-fill" ></i> Seleccione la Mesa.');
        }else{
            fila.find('#errorMesa').html("");
        }

        if (entradas.trim().length < 1) {
            fila.find('#errorEntrada').html('<i class="bi bi-exclamation-triangle-fill" ></i> Ingrese la cantidad de entradas');
            ok=false;
        }else{
            fila.find('#errorEntrada').html("");
        }

        if(!pagoExp.test(precio)){
            fila.find('#errorPago').html('<i class="bi bi-exclamation-triangle-fill" ></i> Ingrese el Precio');
            ok=false;
        }else{
            fila.find('#errorPago').html("");
        }
    });
    return ok;
}

function validarEncabezado(){
    let ok = true;

    if ($("#cedula").val() == null || $("#cedula").val().trim().length === 0) {
        $("#errorCedula").html('<i class="bi bi-exclamation-triangle-fill"></i>Ingrese la Cédula');
        ok = false;
    }else{
        $("#errorCedula").html("");
    }

    if($("#metPago").val().trim().length === 0){
        $("#errorMetodo").html('<i class="bi bi-exclamation-triangle-fill" ></i>Ingrese el método de pago ');
        ok = false;
    }else{
        $("#errorMetodo").html("");
    }

    if($("#descripcion").val().trim().length === 0){
        $("#errorDescripcion").html('<i class="bi bi-exclamation-triangle-fill" ></i> Ingrese la descripción de la venta');
        ok = false;
    }else{
        $("#errorDescripcion").html("");
    }

    if ($("#selEvento").val() == null || $("#selEvento").val().trim().length === 0) {
        $("#errorSelect").html('<i class="bi bi-exclamation-triangle-fill" ></i> Seleccione el Evento');
        ok = false;
    }else{
        $("#errorSelect").html("");
    }

    if($("#configDesc").val().trim().length === 0){
        $("#errorDescuento").html('<i class="bi bi-exclamation-triangle-fill" ></i> Ingrese el Descuento');
        ok = false;
    }else{
        $("#errorDescuento").html("");
    }

    if ($("#hora").val().trim().length < 1) {
        $("#errorHora").html('<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la hora');
        ok = false;
    }else{
        $("#errorHora").html("");
    }

    if ($("#fecha").val().trim().length < 1) {
        $("#errorFecha").html('<i  class="bi bi-exclamation-triangle-fill"></i> Ingrese la fecha');
        ok = false;
    }else{
        $("#errorFecha").html("");
    }
    return ok;
}

function calcularMonto(){
  var totalDesc = 0;
  var totalDolar = 0;

  Descontar = getPorcentajeDescuento();
  $('#ventass #tt #tr').each( function(){
    let fila = $(this);
    let  precio   = fila.find('.precio input').val();
    let entradas = fila.find('.entradas input').val();
    let sum = entradas * precio;
    let ope = ((Descontar/100)*sum);
    let desc =(sum - ope);
    
    
    totalDolar = totalDolar + sum;
    totalDesc = totalDesc + ope;
    fila.find('.value-subtotal').val( sum.toFixed(2) );
    fila.find('.value-descuento').val( desc.toFixed(2) );
  });

  $('#totalDolar').text(totalDolar.toFixed(2));
  $('#totalDesc').text(totalDesc.toFixed(2));
  let totalGen = totalDolar - totalDesc;
  $('#totalGen').text(totalGen.toFixed(2));
  
}

$('#config').on('click', function () {
  calcularMonto();
})

$('.listaV').on('keyup','input',function(e){
   e.preventDefault();
   validar();
   calcularMonto();
});

$('body').on('click','.eliminar',function(e){
  $(this).closest('tr').remove();
  e.preventDefault();
  calcularMonto();
});


$('#config').on('change',function(){
 momentD = !momentD;
  $('body').toggleClass('showtax hidetax');
});


$('#configDesc').on('keyup',function(){
  Descontar= parseFloat($(this).val());
  if (Descontar < 0 ||Descontar > 100){
   Descontar = 0;
  }
  calcularMonto();
});

$(document).ready(function(){
    var modalCrudDetalle = new bootstrap.Modal(document.getElementById('detalleVenta'));
    var modalAnularVenta = new bootstrap.Modal(document.getElementById('modalAnularVenta'));

    $.fn.modal.Constructor.prototype.enforceFocus = function () {};

    $("#cedula").select2({
        theme:'bootstrap-5',
        dropdownParent:$('#registrarV .modal-content'),
        selectionCssClass:"form-select",
        dropdownCssClass:"select",
        searchCssClass:"buscar",
        width:'100%',
        placeholder: 'Seleccione Cliente',
        minimumInputLength: 1,
        minimumResultsForSearch: 20,
        language: "es",
        ajax: {
            url: "?url=cliente",
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                var query = {
                    search: params.term,
                    op: 'clienteSelectList'
                }
                // Query parameters will be ?search=[term]&op=clienteSelectList
                return query;
            },
            processResults: function (response) {
                return {
                    results: response.results
                };
            },
            cache: true
        }
    });

    $("#selEvento").select2({
        theme:'bootstrap-5',
        dropdownParent:$('#registrarV .modal-content'),
        selectionCssClass:"form-select",
        dropdownCssClass:"select",
        searchCssClass:"buscar",
        width:'100%',
        placeholder: 'Seleccione Evento',
        minimumInputLength: 1,
        minimumResultsForSearch: 20,
        language: "es",
        ajax: {
            url: "?url=ventas",
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                var query = {
                    search: params.term,
                    op: 'eventoSelectList'
                }
                // Query parameters will be ?search=[term]&op=eventoSelectList
                return query;
            },
            processResults: function (response) {
                return {
                    results: response.results
                };
            },
            cache: true
        }
    });

    $(".ti").select2({
        theme:'bootstrap-5',
        dropdownParent:$('#registrarV .contenido'),
        selectionCssClass:"form-select",
        dropdownCssClass:"select",
        searchCssClass:"buscar",
        width:'100%'
    });

    $('#selEvento').change(function(){
        cargarArea();
    })

    $('.select-areas').change(function(){
        cargarMesa($(this));
    })

    $('.select-mesas').change(function(){
        var mesa = $(this);
        var obj_precio = $(mesa).closest('#tr').find('.value-precio');
        var precio = $(this).find(':selected').data('precio');

        if (mesa.val() !=="" && obj_precio.val() == ""){
            obj_precio.val(precio.toFixed(2));
        }
    })

    $('.value-entradas').change(function(){
        validar();
        calcularMonto();
    })

    $('.value-precio').change(function(){
        validar();
        calcularMonto();
    })

    $('#configDesc').change(function (){
        validar();
        calcularMonto();
    })

    $('#enviarVenta').on('click', function () {
        if (validarEncabezado() && validar()){
            let formData = getDataForm('ingresarVenta');
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "?url=ventas",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                if (data.success){
                    Swal.fire({
                        title:'<h3 style="color:#040855!important;"><b>Registrado</b></h3>',
                        html:'<p style="color:#bbb!important;">Venta Registrada Exitosamente!</p> <br> <div class="modal-footer"> </div>',
                        showConfirmButton:false,
                        timer:2500,
                        timerProgressBar:true,
                        imageUrl:'assets/img/check.png',
                        imageWidth:'180px',
                        imageHeight:'140px',
                        imageAlt:'registrado'
                    }).then(()=>{
                        location.href="?url=ventas";
                    })
                }else{
                    alert(data.msj);
                }
            }).fail(function (error) {

            });

        }
    })

    $('.btnDetalleVenta').on('click', function () {
        let venta_id = $(this).data('venta');
        cargarDetalleVenta(venta_id);
        modalCrudDetalle.show();
    })

    $('.anular-item_venta').on('click', function (){
        let venta_id = $(this).data('venta');
        $('#anular_venta_id').val(venta_id);
        modalAnularVenta.show();
    })

    $('#btnAnularVenta').on('click', function (){
        let venta_id = $('#anular_venta_id').val();

        swal.fire({
            title: '¿Seguro de Anular esta Venta?',
            text: "Continúe para confirmar la Anulación...",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Anular!',
        }).then((result) => {
            if (result.value){
                $.ajax({
                    url: '?url=ventas',
                    type: 'POST',
                    data: {
                        op: 'anularVenta',
                        venta_id: venta_id
                    },
                    dataType: 'json'
                })
                    .done(function(response){
                        if (response.success){
                            swal.fire('Anulado!', 'Venta Anulada', 'success');
                        }else{
                            swal.fire('Anulado!', response.msj, 'success');
                        }
                        location.href='?url=ventas';
                    })
                    .fail(function(){
                        swal.fire('Upsss...', '¡Algo salió mal al anular!', 'error');
                    });
            } // fin de if (result.value)
        })
    })

});

$('.más').on('click',function(e){
    if (validar()){
        let clonedRow = $('#tt tr').last().clone(true);
        clonedRow.find('.td-eliminar').append('<a class="control eliminar  pt-3" ><i class="bi bi-trash-fill icon01"  style="color: #040855!important;"></i></a>');
        clonedRow.find('.select-mesas')
            .empty().append('<option selected="selected" value="">¿Mesas?</option>');
        clonedRow.find('.value-entradas').val('');
        clonedRow.find('.value-precio').val('');
        $('#detalleVentas tbody').append(clonedRow);
    }
});

function cargarArea(){
    let formData = {
        op: "areaSelectList",
        evento: $('#selEvento').val(),
    };

    $.ajax({
        type: "POST",
        url: "?url=ventas",
        data: formData,
        dataType: "json",
        encode: true,
    }).done(function (response) {
        if (response.success){
            let option=` `;
            response.data.forEach((row)=>{
                option+=`<option value="${row.cod_area}">${row.nombArea}</option>`
            })
            $('.select-areas').each(function(){
                $(this).append(option);
            })
        }else{
            alert(data.msj);
        }
    }).fail(function (error) {

    });

    return false;
}

function cargarMesa(objArea){
    let mesa = $(objArea).closest('#tr').find('.select-mesas');

    let formData = {
        op: "mesaSelectList",
        evento: $('#selEvento').val(),
        area: objArea.val()
    };

    if (formData.evento !=="" && formData.area !== ""){
        $.ajax({
            type: "POST",
            url: "?url=ventas",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (response) {
            if (response.success){
                let option=` `;
                response.data.forEach((row)=>{
                    option+=`<option value="${row.id_mesa}" data-precio="${row.precio}" data-cantpuestos="${row.cantPuesto}">Mesa ${row.cantPuesto} Ptos. ${row.cantPuesto}$</option>`
                })
                mesa.empty().append('<option selected="selected" value="">¿Mesa?</option>')
                mesa.each(function(){
                    $(this).append(option);
                })
            }else{
                alert(data.msj);
            }
        }).fail(function (error) {

        });
    }
    return true;
}

function getDataForm(operation){
    let arrayDetails = [];
    $('#ventass #tt #tr').each( function(){
        let fila = $(this);
        let subTotal = fila.find('.value-subtotal').val();
        let descuento = subTotal - parseFloat(fila.find('.value-descuento').val());
        let detail = {
            area: fila.find('.select-areas').val(),
            mesa: fila.find('.select-mesas').val(),
            entradas: fila.find('.value-entradas').val(),
            precio: fila.find('.value-precio').val(),
            subtotal: fila.find('.value-subtotal').val(),
            descuento: descuento
        }
        arrayDetails.push(detail);
    })
    return {
        op: operation,
        cedula: $("#cedula").val().trim(),
        metodo: $("#metPago").val().trim(),
        descripcion: $("#descripcion").val().trim(),
        fecha: $("#fecha").val().trim(),
        hora: $("#hora").val().trim(),
        evento: $("#selEvento").val().trim(),
        total: $('#totalGen').text(),
        detalle: arrayDetails
    };
}

function cargarDetalleVenta(venta_id) {
    let data = {
        op: 'showDetalleVenta',
        venta_id: venta_id
    }
    console.log(data);
    $.ajax({
        url: '?url=ventas',
        type: 'POST',
        dataType: 'JSON',
        data: data,
        success(response) {
            let lista = '';
            if (response.success){
                let sum_subtotal = 0.00;
                let sum_descuento = 0.00;
                let sum_total = 0.00;
                let i=1;
                let num_venta = '';
                response.data.forEach(fila => {
                    if (i==1){ num_venta = fila.numeroVenta;}
                    let subtotal = parseFloat(fila.subTotal);
                    let descuento = parseFloat(fila.descuento);
                    let total = subtotal - descuento;
                    sum_subtotal += subtotal;
                    sum_descuento += descuento;
                    sum_total += total;
                    lista += `
                      <tr class="fila">
                      <td class="text-left">${fila.id_detalle}</td>
                      <td class="text-left">${fila.evento}</td>
                      <td class="text-center">${fila.mesa}</td>
                      <td class="text-center">${fila.cant_entradas}</td>
                      <td class="text-center">${fila.precio}</td>  
                      <td class="text-center">${fila.subTotal}</td>
                      <td class="text-center">${fila.descuento}</td>
                      <td class="text-center">${total}</td>
                     </tr>`
                })
                $('.numeroVenta').html('Venta N° ' + num_venta);
                $('#tbody_detalleventa').empty().append(lista);
                $('#monto-total-detalle-venta').html(sum_total);
            }
            else{

            }
        }
    })
}
