<title> Mesas - Producciones 2.5.1.</title>
<?php
require_once("contenido/componentes/navegador.php");
$carrusel->carruselEventos();
?>

<main class="container" id="table">
    <script>
        const M_STATUS_DISPONIBLE = "<?php echo $M_STATUS_DISPONIBLE ?>";
        const M_STATUS_OCUPADO = "<?php echo $M_STATUS_OCUPADO ?>";
        const M_STATUS_ANULADO = "<?php echo $M_STATUS_ANULADO ?>";
    </script>
    <div>
        <?php echo (isset( $mesa[0]))? ( $mesa[0]== "posicion")?   $mesa[1]:  " " :  " " ?>
        <?php echo (isset( $mesa[0]))? ( $mesa[0]== "entradas")?   $mesa[1]:  " " :  " " ?>
        <?php echo (isset( $mesa[0]))? ( $mesa[0]== "evento")?   $mesa[1]:  " " :  " " ?>
    </div>

    <div class="card mt-4 mb-4 justify-content-center shadow ">
        <div class="card-header card-footer d-grid gap-2 d-md-flex">
            <div class="col-md-9">
                <h4 class="titulo fw-bold text-end mr-2 " data-text="Gestión de Mesas">Mesas</h4>
            </div>
            <div class="d-grid gap-3 d-flex justify-content-md-end justify-content-center col-md-3 text-end">

                <button class=" btn12 fw-bold col-2 col-md-3 col-lg-2 btn-crud-mesa" type="button" data-bs-toggle="modal" data-mesa="0" data-bs-target="#modalCrudMesa" style="box-shadow:none!important;" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrar Mesa" ><i class="bx bxs-edit " style="font-size: 23px!important;"  ></i></button>

                <a href="?url=reporteMesas" target="_blank" class="btn11 col-2 fw-bold col-md-3 col-lg-2 text-center pt-1 " type="button" style="box-shadow:none!important;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Reporte de Mesas"><i class="bi bi-upload " style="font-size: 23px!important;"  ></i></a>

                <a class=" fw-bold  col-2 col-md-3 col-lg-2 text-center mt-1 " type="button" data-bs-toggle="modal" data-bs-target="#papeleraME" data-bs-toggle="tooltip" data-bs-placement="top" title="Papelera Mesa"><i class="bi bi-trash icon999 " style="color: #fff; font-size: 30px;" ></i></a>


            </div>
        </div>

        <div class="card-body shadow">

            <div class="table-responsive bordered ">
                <table class="table table-hover" id="dataTable" >
                    <thead class=" table2 text-center">
                    <tr>
                        <th  scope="col">N° de Mesa</th>
                        <th  scope="col">Evento</th>
                        <th  scope="col">Area</th>
                        <th  scope="col">Posición</th>
                        <th  scope="col">Cant. Asientos</th>
                        <th  scope="col">Precio</th>
                        <th  scope="col col-lg-3">Acciones</th>
                    </tr>
                    </thead>
                    <tbody">
                    <?php
                    if(isset( $listaMesas)) {
                        foreach ($listaMesas['data'] as $data){
                            ?>
                            <tr class="fila" id="M-<?php echo $data->id_mesa ?>">
                                <th class="text-left"><?php echo $data->id_mesa ?></th>
                                <th class="text-left"><?php echo $data->nombre_evento ?></th>
                                <th class="text-left"><?php echo $data->nombArea ?></th>
                                <th class="text-left"><?php echo "C ".$data->posiColumna ."-"."F ".$data->posiFila ?></th>
                                <th class="text-left"><?php echo $data->cantPuesto ?></th>
                                <th class="text-left"><?php echo $data->precio." $" ?> </th>

                                <th class="text-center d-grid gap-2 d-md-flex justify-content-lg-center" >
                                    <button class="btn btn90 fw-bold  mb-1 col-6 col-md-5 btn-crud-mesa" type="button"
                                            data-bs-toggle="modal" data-bs-target="#modalCrudMesa" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Modificar" data-mesa="<?php echo $data->id_mesa ?>"
                                            data-evento="<?php echo $data->evento ?>" data-area="<?php echo $data->area ?>"
                                            data-columna="<?php echo $data->posiColumna ?>" data-fila="<?php echo $data->posiFila ?>"
                                            data-puestos="<?php echo $data->cantPuesto ?>" data-precio="<?php echo $data->precio ?>"
                                            data-status="<?php echo $data->status ?>" data-nombre_evento="<?php echo $data->nombre_evento ?>"
                                            data-status_evento="<?php echo $data->status_evento ?>">
                                        <i class="bi bi-pencil-fill "></i>
                                    </button>

                                    <button class="btn btn11 fw-bold  mb-1 col-6 col-md-5 btn-delete-mesa" type="button" data-bs-toggle="modal"
                                            data-bs-target="" data-bs-toggle="tooltip" data-bs-placement="top" title="Anular"
                                            data-mesa="<?php echo $data->id_mesa ?>" data-status="<?php echo $data->status ?>"
                                            data-evento="<?php echo $data->evento ?>">
                                        <i class="bi bi-trash-fill "></i>
                                    </button>
                                </th>

                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- End Table with stripped rows -->

        </div>
        <div class="card-header"></div>
    </div>


    </div>
</main>

<div class="modal fade mx-auto" id="modalCrudMesa" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content w-500">
            <div class="contenido">
                <div class="card-header p-2">
                    <h4 class="titulo fw-bold text-end mr-2 " data-text="Registrar Mesas">Mesas</h4>
                </div>
                <form class="modal-body" method="POST" id="crudMesa">
                    <input type="hidden" name="hid_op" id="hid_op" value="">
                    <input type="hidden" name="hid_mesa_id" id="hid_mesa_id" value="0">
                    <input type="hidden" name="estatus_mesa" id="estatus_mesa" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <label  class="form-label"><i class="ri-building-2-line icon" style="color: #c79b2d!important;"></i>Nombre del Evento</label><br>
                            <select  name= "selEvento" class="form-select sel col-12" id="selEvento">
                            </select>
                            <p id="errorSelEvento" class="text-center l"></p>
                        </div>

                        <div class="col-md-6">
                            <label  class="form-label"><i class="ri-layout-4-fill icon"style="color: #c79b2d!important;"></i>Area</label>
                            <select  name= "selArea" class="form-select" id="selArea">
                                <option value="" class="opcion" >Areas</option>
                                <?php
                                if(isset( $listaAreas)) {
                                    foreach ($listaAreas['data'] as $data){
                                        ?>
                                        <option value="<?php echo $data->cod_area?>"  class="opcion"><?php echo $data->nombArea ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>

                            <p id="errorSelArea" class="text-center l"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fa-solid fa-chair" style="color: #c79b2d!important;"></i>N° de Asientos</label>

                            <input type="number" min="1" max="99" maxlength="2" class="form-control col-md-6" name="cantPuesto" id="cantPuesto" placeholder="Ingresar la cantidad de asientos"><br>
                            <p id="errorCantPuesto"  class="text-center l"></p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><i class="ri-money-dollar-circle-line icon" style="color: #c79b2d!important;"></i>Precio</label>

                            <input type="number" maxlength="10" class="form-control col-md-6" name="precio" id="precio" placeholder="Ingresar el precio "><br>
                            <p id="errorPrecio"  class="text-center l"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label"><i class="ri-layout-column-fill icon" style="color: #c79b2d!important;"></i>Posicion columna</label>

                            <input type="number" min="1" max="99" maxlength="2" class="form-control" name="posiColumna" id="posiColumna" placeholder="Ingresar numero de columna"><br>
                            <p id="errorPosiColumna"  class="text-center l"></p>
                        </div>

                        <div class="col-md-6">
                            <label  class="form-label"><i class="bi bi-view-stacked icon" style="color: #c79b2d!important;"></i>Posicion Fila</label>
                            <input type="number" min="1" max="99" maxlength="2" class="form-control" name="posiFila" id="posiFila" placeholder="Ingresar numero de fila"><br>
                            <p id="errorPosiFila"  class="text-center l"></p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn11 btn-danger shadow"data-bs-dismiss="modal" id="cerrar22">Cancelar</button>
                        <button class="btn btnP"style="color: #fff;" id="envioDataMesa" type="button">Enviar</button>
                    </div>


                </form>

            </div>


        </div>

    </div>

</div>

<div class="modal fade mx-auto" id="papeleraME" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content w-500">
            <form class="contenido" method="POST">
                <div class="card-header p-2">
                    <h4 class="titulo fw-bold text-end mr-2 " data-text="Papelera">area</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive bordered ">
                        <table class="table table-hover" id="dataTable" >
                            <thead class=" table2 text-center">
                            <tr>
                                <th  scope="col">N° de Mesa</th>
                                <th  scope="col">Evento</th>
                                <th  scope="col">Area</th>
                                <th  scope="col">Precio</th>
                                <th  scope="col">P. Columna</th>
                                <th  scope="col">P. Fila</th>
                                <th  scope="col">Cant. Asientos</th>
                                <th  scope="col col-lg-3">Restaurar</th>
                            </tr>
                            </thead>

                            <tbody">
                            <?php
                            if(isset( $listaPapelera)) {
                                foreach ($listaPapelera['data'] as $data){

                                    ?>
                                    <tr class="fila">
                                        <th class="text-left"><?php echo $data->id_mesa ?></th>
                                        <th class="text-left"><?php echo $data->nombre_evento ?></th>
                                        <th class="text-left"><?php echo $data->nombArea ?></th>
                                        <th class="text-left"><?php echo $data->precio ?> </th>
                                        <th class="text-left"><?php echo $data->posiColumna ?></th>
                                        <th class="text-left"><?php echo $data->posiFila ?></th>
                                        <th class="text-left"><?php echo $data->cantPuesto ?></th>

                                        <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                                            <button value="<?php echo $data->id_mesa ?>" name="restaurarME"
                                                    data-mesa="<?php echo $data->id_mesa ?>" class="btn90 fw-bold  mb-1 col-7 col-md-5 restaurar-mesa" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurar Mesa"><i class="bi bi-check2-circle "></i></button>
                                        </th>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn11  shadow"data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>

        </div>
    </div>
</div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center paArriba fw-bold "><i class="bi bi-arrow-up-short"></i></a>
<script type="text/javascript" src="<?php echo URL;?>assets/js/mesas.js"></script>
<?php
require_once("contenido/componentes/footer.php")
?>