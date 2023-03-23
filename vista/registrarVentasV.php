<title> Registrar Ventas - Producciones 2.5.1.</title>
<?php
require_once("contenido/componentes/navegador.php");
$carrusel->carruselVentas();
?>

<main class="container" id="table" method="POST">
    <div class="card mt-4 mb-4 justify-content-center shadow ">
        <div class="card-header card-footer d-grid gap-2 d-md-flex">
            <div class="col-md-9">
                <h4 class="titulo fw-bold text-end mr-2 " data-text="Gestión de Ventas de Entradas">Ventas</h4>
            </div>
            <div class="d-grid gap-3 d-flex justify-content-md-end col-md-3 text-end justify-content-center">
                <button class=" btn12 fw-bold col-3 col-lg-2" type="button"data-bs-toggle="modal" data-bs-target="#registrarV" style="box-shadow:none!important;" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrar Venta"><i class="bx bxs-edit " style="font-size: 23px!important;"  ></i></button>
                <a href="?url=reporteVentas" target="_blank" class="btn11 col-2 fw-bold col-md-3 col-lg-2 text-center pt-1 " type="button" style="box-shadow:none!important;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Reporte de Ventas"><i class="bi bi-upload " style="font-size: 23px!important;"  ></i></a>
                <!--<a class=" fw-bold col-lg-2 col-3 text-center mt-1 " type="button" data-bs-toggle="modal" data-bs-target="#papeleraME" data-bs-toggle="tooltip" data-bs-placement="top" title="Papelera Venta"><i class="bi bi-trash icon999 " style="color: #fff; font-size: 30px;" ></i></a>-->


            </div>
        </div>
        <div class="card-body shadow" >

            <div class="table-responsive bordered ">
                <table class="table table-hover" id="dataTable">
                    <thead class=" table2 text-center">
                    <tr>
                        <th  scope="col">Fecha</th>
                        <th  scope="col">Hora</th>
                        <th  scope="col">Cliente</th>
                        <th  scope="col">Descripcion</th>
                        <th  scope="col">Metodo</th>
                        <th  scope="col">Monto Total</th>
                        <th  scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody">
                    <?php
                    if(isset($dataVentas)) {
                        foreach ($dataVentas['data'] as $data){
                            ?>
                            <tr class="fila" id="V-<?php echo $data->numeroVenta ?>">
                                <td class="text-left"><?php echo $data->fecha ?></td>
                                <td class="text-left"><?php echo $data->hora ?></td>
                                <td class="text-left"><?php echo "(" . $data->cedula . ") " . $data->apellido . " " . $data->nombre ?></td>
                                <td class="text-left"><?php echo $data->descripcionVenta ?></td>
                                <td class="text-left"><?php echo $data->metodo ?></td>
                                <td class="text-left"><?php echo ($data->montoTotal - $data->descuento) ?></td>
                                <td class="text-center d-grid gap-3 d-flex justify-content-lg-center" >
                                    <button class="btn btn90 col-3.5 col-md-3 btnDetalleVenta" type="button"
                                            title="Detalles de Venta" data-venta="<?php echo $data->numeroVenta ?>">
                                        <i class="ri-article-line "></i>
                                    </button>

                                    <a href="?url=reporteDetallesVenta&id=<?php echo $data->numeroVenta ?>" target="_blank" class="btn12 col-3.5 col-md-3 text-center pt-2 " type="button" style="box-shadow:none!important;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Reporte de los detalles de la venta"><i class="bi bi-upload "  ></i></a>

                                    <button class="btn btn11 col-3.5 col-md-3 anular-item_venta" type="button"
                                            title="Anular Venta" data-venta="<?php echo $data->numeroVenta ?>">
                                        <i class="bi bi-trash-fill "></i>
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                    }else{
                        " ";
                    }
                    ?>

                    </tbody>
                </table>
            </div>
            <!-- End Table with stripped rows -->

        </div>
        <div class="card-header"></div>
    </div>


</main>

<div class="modal fade mx-auto vent " id="registrarV" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" class="modal-dialog modal-dialog-centered  modal-fullscreen">
        <div class="modal-content vh-100 mod ">
            <div class="">
                <div class=" card-header p-2">
                    <h4 class="titulo fw-bold text-end mr-2 " data-text="Registrar Nueva Venta">Usuarios</h4>
                </div>
                <div class="contenido p-4 val " id="form-Ventas">

                    <div class=" row g-2 mb-3">
                        <div class="col-12" width="45%">
                            <label  class="form-label"><i class="bi bi-person-fill icon" style="color: #c79b2d!important;">
                                </i>Cliente</label>&nbsp;&nbsp;&nbsp;<button id="addClient" type="button" data-bs-toggle="modal" data-bs-target="#exampleRegistrarC" class="btn btn-link btn-sm">[+]</button><br>

                            <select  name= "cedula" class="form-select" id="cedula">

                            </select>
                            <p id="errorCedula" class=" l"></p>
                        </div>

                        <div class="col-12 col-md-5 col-lg-3 mb-3">
                            <label  class="form-label"><i class="bi bi-cash-coin"  style="color: #c79b2d!important;"></i> Método de Pago</label><br>
                            <select  name= "metodoPago" class="form-select" id="metPago">
                                <option value="" class="opcion" >Seleccionar Método</option>
                                <?php
                                if(isset( $metodoPago)) {
                                    foreach ($metodoPago['data'] as $data){
                                        ?>
                                        <option value="<?php echo $data->id_metodo?>"  class="opcion"><?php echo $data->metodo?></option>
                                        <?php
                                    }
                                }else{
                                    " ";
                                }
                                ?>
                            </select>

                            <p id="errorMetodo"   class=" text-center l"></p>
                        </div>
                        <div class="col-12 col-md-7 col-lg-5 col-xxl-5  mb-3">
                            <label  class="form-label"> <i class="ri-shopping-cart-fill"  style="color: #c79b2d!important;"></i>Descripcion de la venta</label>

                            <input type="textarea" class="form-control" placeholder="ingrese la Descripción" id="descripcion" name="descripcion">
                            <p id="errorDescripcion" class=" text-center l"></p>
                        </div>

                        <div class="col-6 col-md-6 col-lg-2 mb-3">
                            <label  class="form-label"><i class="bx bxs-calendar-edit"  style="color: #c79b2d!important;"></i> Fecha</label>
                            <input type="date" class="form-control" name="fechaPago" placeholder="fecha de pago" id="fecha">
                            <p id="errorFecha"   class=" text-center l"></p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-2  mb-3">
                            <label  class="form-label"><i class="bi bi-alarm"  style="color: #c79b2d!important;"></i> Hora</label>
                            <input type="time" class="form-control" name="hora" id="hora">
                            <p id="errorHora"   class=" text-center l"></p>
                        </div>

                    </div>
                    <div class="d-grid gap-2 d-flex ">
                        <div class=" col-md-10 col-8">
                            <label  class="form-label"><i class="ri-building-2-line "
                                                          style="color: #c79b2d!important;"></i> Evento</label><br>

                            <select  name= "selEvento" class="form-select sele3" id="selEvento">

                            </select>
                            <p id="errorSelect" class=" l"></p>

                        </div>
                        <div class="col-4 col-md-2 m-auto-end justify-content-end " >
                            <label  class="form-label"> <i class="bi bi-bar-chart "  style="color: #c79b2d!important;"></i> Descuento</label>
                            <input type="checkbox" id="config">
                            <label class="des justify-content-center" style="display: block;">
                                <div class="col-8 justify-content-center">
                                    <input type="number" min="0" max="100" maxlength="5" id="configDesc" class="form-control text-center" value="10">
                                    <p id="errorDescuento" class="text-center l"></p>
                                </div>

                            </label>
                        </div>
                    </div>


                    <div class="listaV" id="ventass">
                        <div class="table-responsive bordered ">
                            <table class=" table table-striped" id="detalleVentas">
                                <thead class=" table1 text-center p-2">
                                <tr >
                                    <td style="width: 4%" scope="col"></td>
                                    <td style="width: 20%" scope="col">Area</td>
                                    <td style="width: 20%" scope="col">Mesas</td>
                                    <td style="width: 10%" scope="col">Entradas</td>
                                    <td style="width: 15%" scope="col">Precio</td>
                                    <td style="width: 15%" scope="col">subTotal</td>
                                    <td style="width: 15%"  width="16%" class=""  scope="col">Descuento</td>
                                </tr>
                                </thead>
                                <tbody id="tt">
                                <tr id="tr">

                                    <td class="pt-4 td-eliminar">

                                    </td>

                                    <td width="17%" class="p-2 area">
                                        <select  name= "area" class="form-select mt-3 select-areas campo ">
                                            <option value="" >¿Area?</option>
                                        </select>
                                        <p id="errorSelectArea" class="text-center l mesa "></p>
                                    </td>

                                    <td width="17%"class="p-2 mesa ">
                                        <select  name= "mesa" class="form-select mt-3 campo select-mesas">
                                            <option value="" class="opcion" >¿Mesa?</option>
                                        </select>
                                        <p id="errorMesa"   class=" text-center l"></p>
                                    </td>

                                    <td width="15%" class="entradas">
                                        <input style="text-align: right" type="number" min="0" max="999" maxlength="3" class="form-control campo mt-3 value-entradas" value="">
                                        <p id="errorEntrada" class="text-center l" ></p>
                                    </td>

                                    <td width="15%" class="precio">
                                        <input style="text-align: right" step="0.01" type="number" class="form-control campo mt-3 value-precio" value="">
                                        <p id="errorPago" class="text-center l "></p>
                                    </td>

                                    <td width="10%" class="text-center mt-3" >
                                        <input style="text-align: right" type="text" class="form-control campo mt-3 value-subtotal" value="0" disabled="disabled">
                                        <p id="errorSubTotal" class="text-center l "></p>
                                    </td>

                                    <td style="width: 10%" class="desc des text-center mt-3 ">
                                        <input style="text-align: right" type="text" class="form-control campo mt-3 value-descuento" value="0" disabled="disabled">
                                        <p id="errorDescuento" class="text-center l "></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="error"></div>
                        <a class="control más"><i class="bi bi-plus-circle-fill icon00"  style="color: #040855!important;"></i></a>
                    </div>
                    <!--.invoice-body-->
                    <div class="invoicelist-footer">
                        <table>
                            <tbody style="text-align: right">
                            <tr class="totalN " style="alignment: right">
                                <td class="d-flex" style="text-align: right;"><strong style="color: #040855!important;">Sub-Total:</strong>$  <p id="totalDolar">0.00</p></td>
                            </tr>
                            <tr class="totalD " style="display: block; alignment: right">
                                <td class="d-flex" style="text-align: right;"><strong style="color: #040855!important;">Descuento:</strong>$  <p id="totalDesc">0.00</p></td>
                            </tr>
                            <tr class="totalG " style="display: block; alignment: right">
                                <td class="d-flex" style="text-align: right;"><strong style="color: #040855!important;">Total:</strong>$  <p id="totalGen">0.00</p></td>
                            </tr>
                            </tbody>
                            <tr style="font-size: 20px;">
                                <td ><B style="color:#df0000 !important;" >Al cambio:</B>Bs 2,026</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer mb-2">
                <button type="reset" class="btn btn11 btn-danger shadow"data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btnP"style="color: #fff;" id="enviarVenta" type="button">Enviar</button>
            </div>
        </div>
    </form>
</div>

<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->


<div class="modal fade mx-auto" id="modalAnularVenta" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content w-500">
            <div class="contenido">
                <div class="card-header p-2">
                    <h4 class="titulo fw-bold text-end mr-2 " data-text="Anular Venta">Venta</h4>
                </div>
                <div class="modal-body">
                    <form class="contenido" method="POST" id="anularVenta">
                        <input type="hidden" id="anular_venta_id" value="">
                    </form>
                    ¿Deseas Anular esta Venta?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn11 btn-danger shadow"data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnAnularVenta" class="btn btnP btn-primary">Anular</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="modal fade mx-auto" id="detalleVenta" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl">
        <div class="modal-content w-500">
            <div class="contenido">
                <div class="card-header p-2">
                    <h4 class="titulo fw-bold text-end mr-2 " data-text="Detalles de la Venta">Venta</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive bordered ">
                        <h2 class="fw-bold numeroVenta" style="color: #c79b2d!important;">Venta N°</h2>
                        <table class="table table-hover" id="dataTable">
                            <thead class=" card-header text-center" style="color: #fff;">
                            <tr>
                                <th  scope="col">Código</th>
                                <th  scope="col">Evento</th>
                                <th  scope="col">N° de Mesa</th>
                                <th  scope="col">N° de Entradas</th>
                                <th  scope="col">Precio</th>
                                <th  scope="col">SubTotal</th>
                                <th  scope="col">Descuento</th>
                                <th  scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody id="tbody_detalleventa">

                            </tbody>
                        </table>
                        <table class="table table-hover">
                            <thead class="d-grid gap-2 d-flex" >
                            <tr class="col-10 card-header text-end"style="color: #fff;">
                                <th class="text-end">Monto Total:</th>
                            </tr>
                            <tr class=" col-2 fila text-end">
                                <th id="monto-total-detalle-venta" class="text-end"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn11 btn-danger shadow"data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>

        </div>
    </div>
</div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center paArriba fw-bold "><i class="bi bi-arrow-up-short"></i></a>

<?php
include  "vista/frmClienteV.php";?>
<script type="text/javascript" src="<?php echo URL;?>assets/js/registrarVentas.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/clientProcess.js"></script>
<?php
require_once("contenido/componentes/footer.php")
?>
