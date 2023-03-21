<title> Eventos - Producciones 2.5.1.</title>
<?php
require_once("contenido/componentes/navegador.php");
$carrusel->carruselEventos();

?>
<main class="container-fluid" id="table">
    <script>
        const E_STATUS_DISPONIBLE = "<?php echo $E_STATUS_DISPONIBLE ?>";
        const E_STATUS_OCUPADO = "<?php echo $E_STATUS_OCUPADO ?>";
        const E_STATUS_ANULADO = "<?php echo $E_STATUS_ANULADO ?>";
    </script>
    <div>
        <!--
         <?php /*echo (isset($evento[0]))? ($evento[0] == "errorF")?  $evento[1] :  " " :  " " */?>
         <?php /*echo (isset($modificarEvento[0]))? ($modificarEvento[0] == "errorE")?  $modificarEvento[1] :  " " :  " " */?>
         <?php /*echo (isset($evento[0]))? ($evento[0] == "nombre")?  $evento[1] :  " " :  " " */?>
         <?php /*echo (isset($evento[0]))? ($evento[0] == "fech")?  $evento[1] :  " " :  " " */?>
         <?php /*echo (isset( $restaurarEvento[0]))? ( $restaurarEvento[0] == "RE")?   $restaurarEvento[1] :  " " :  " " */?>
         -->
    </div>

    <div class="card mt-4 mb-4 justify-content-center shadow ">
        <div class="card-header card-footer d-grid gap-2 d-md-flex">
            <div class="col-md-9">
                <h4 class="titulo fw-bold text-end mr-2 " data-text="Gestión de Eventos">Usuarios</h4>
            </div>
            <div class="d-grid gap-3 d-flex justify-content-md-end justify-content-center col-md-3 text-end">
                <button class="btn12 fw-bold col-2 col-md-3 col-lg-2 btn-crud-evento" type="button" data-codigo="0" data-bs-toggle="modal" data-bs-target="#crudEvento" style="box-shadow:none!important;" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrar Evento" >
                    <i class="bx bxs-edit " style="font-size: 23px!important;"  ></i>
                </button>
                <a href="?url=reporteEventos" class=" btn11 fw-bold col-2 col-md-3 col-lg-2 text-center pt-1" type="button" style="box-shadow:none!important;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Reporte de Eventos">
                    <i class="bx bx-archive-in " style="font-size: 23px!important;"  ></i>
                </a>
                <a class=" fw-bold  col-2 col-md-3 col-lg-2 text-center mt-1 " type="button" data-bs-toggle="modal" data-bs-target="#papeleraE" data-bs-toggle="tooltip" data-bs-placement="top" title="Papelera Eventos">
                    <i class="bi bi-trash icon999 " style="color: #fff; font-size: 30px;" ></i>
                </a>
            </div>
        </div>
        <div class="card-body shadow">

            <div class="table-responsive bordered ">
                <table class="table table-hover" id="dataTable" >
                    <thead class=" table2 text-center">
                    <tr>
                        <th  scope="col">Evento</th>
                        <th  scope="col">Tipo</th>
                        <th  scope="col">Lugar</th>
                        <th  scope="col">Entradas</th>
                        <th  scope="col">Fecha</th>
                        <th  scope="col">Hora</th>
                        <th  scope="col">Estatus</th>
                        <th  scope="col">Imagen</th>
                        <th  scope="col col-lg-3">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset( $listaEventos)) {
                    foreach ($listaEventos['data'] as $data){
                    ?>
                    <tr class="fila" id="e-<?php echo $data->codigo?>">
                        <th class="text-left"><?php echo $data->nombre ?></th>
                        <th class="text-left"><?php echo $data->nombre_tipoevento ?></th>
                        <th class="text-left"><?php echo $data->nombre_lugar ?>
                        <th class="text-left"><?php echo $data->entradas ?></th>
                        <th class="text-left"><?php echo $data->fecha?></th>
                        <th  class ="text-left"><?php echo $data->hora ?></th>
                        <th  class ="text-center"><?php echo $data->status ?></th>
                        <th  class ="text-center">
                            <?php
                            if (strlen($data->imagen)>0){
                                ?>
                                <img src="<?php echo $data->imagen ?>" width="50" height="42" class="box-shadow" >
                                <?php
                            }else{
                                ?>
                                <img src="assets/img/default_placeholder.jpg" width="50" height="42" class="box-shadow" >
                                <?php
                            }
                            ?>
                        </th>

                        <th class="text-center d-grid gap-2 d-flex justify-content-center" >
                            <button class="btn btn90 fw-bold  mb-1 col-6 col-md-4 mt-2 btn-crud-evento"
                                    type="button" data-codigo="<?php echo $data->codigo?>" data-nombre="<?php echo $data->nombre ?>"
                                    data-tipo="<?php echo $data->tipoEvento ?>" data-lugar="<?php echo $data->lugar?>"
                                    data-entradas="<?php echo $data->entradas?>" data-fecha="<?php echo $data->fecha?>"
                                    data-hora="<?php echo $data->hora?>" data-status="<?php echo $data->status?>"
                                    data-imagen="<?php echo $data->imagen ?>"
                            ><i class="bi bi-pencil-fill "></i></button>
                            <button class="btn btn11 fw-bold  mb-1 col-6 col-md-4 mt-2 btn-delete-evento" type="button"
                                    data-codigo="<?php echo $data->codigo?>" data-status="<?php echo $data->status?>">
                                <i class="bi bi-trash-fill "></i></button>
                        </th>
                        <?php
                        } //Fin del Foreach
                        } //Fin del If
                        ?>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- End Table with stripped rows -->

        </div>
        <div class="card-header"></div>
    </div>

</main>

<div class="modal fade mx-auto" id="crudEvento" data-bs-backdrop="static"  data-bs-keyboard="false"  tabindex="-1" aria-labelledby="Evento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content w-500">
            <div class="contenido">
                <div class="card-header p-2">
                    <h4 class="titulo fw-bold text-end mr-2 " data-text="Eventos">Eventos</h4>
                </div>
                <form class="modal-body"  method="POST" id="frmEvento" enctype="multipart/form-data">
                    <input type="hidden" name="hid_op" id="hid_op" value="">
                    <input type="hidden" name="hid_codigo_evento" id="hid_codigo_evento" value="0">
                    <input type="hidden" name="estatus_evento" id="estatus_evento" value="">
                    <input type="hidden" name="imagen_anterior" id="imagen_anterior" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="password" class="form-label">
                                <i class="fa-sharp fa-solid fa-newspaper" style="color: #c79b2d!important;"></i>Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre del Evento" name="eventoNombre" id="eventoNombre"><br>
                            <p id="errorEventoNombre"  class="text-center l"></p>
                        </div>
                        <div class="col-md-6 ">
                            <label for="text" class="form-label">
                                <i class="fa-solid fa-buildings" style="color: #c79b2d!important;"></i> Tipo de Evento</label>

                            <select  name= "tipoEvento" class="form-select mb-3" id="tipoEvento">
                                <option value="" class="" >Tipo de Evento</option>
                                <?php
                                if(isset( $listaTipos)) {
                                    foreach ($listaTipos['data'] as $data){
                                        ?>
                                        <option value="<?php echo $data->cod_tipo ?>" class="opcion" ><?php echo $data->tipo ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <p id="errorTipoEvento" class="text-center l"></p>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label"><i class="fa-solid fa-map-location-dot" style="color: #c79b2d!important;"></i>Lugar</label>

                            <select  name= "lugares" class="form-select mb-3" id="lugares">
                                <option value="" class="opcion" >Lugares</option>
                                <?php
                                if(isset( $listaLugares)) {
                                    foreach ($listaLugares['data'] as $data){
                                        ?>
                                        <option value="<?php echo $data->cod_lugar?>" class="opcion" ><?php echo $data->lugar?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <p id="errorLugares" style="color: #df0000;" class="text-center l"></p>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">
                                <i class="fa-solid fa-arrow-up-wide-short"style="color: #c79b2d!important;"></i>Cantidad de Entradas</label>

                            <input type="number" min="0" class="form-control" name="entradas" id="entradas"><br>
                            <p id="errorEntradas"  class="text-center l"></p>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">
                                <i class="fa-solid fa-calendar-week" style="color: #c79b2d!important;"></i>Fecha</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" ><br>
                            <p id="errorFecha" class="text-center l"></p>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">
                                <i class="fa-solid fa-clock" style="color: #c79b2d!important;"></i>Hora</label>
                            <input type="time" min="08:00" max="23:00" required class="form-control" name="hora" id="hora"><br>
                            <p id="errorHora" class="text-center l"></p>
                        </div>
                        <div class="col-12">
                            <!--<label for="password" class="form-label">
                                <i class="fa-solid fa-image" style="color: #c79b2d!important;"></i>Imagen: </label>
                            <input type="file" class="form-control" name="imagen" id="imagen"><br>
                            <p id="errorImagen"  class="text-center l"></p>-->
                            <div class="card" style="width: 18rem;">
                                <img id="imgPreview" class="card-img-top" src="assets/img/default_placeholder.jpg">
                                <div class="card-body">
                                    <h5 class="card-title">Imagen del Evento</h5>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <input type="file" accept="image/jpeg,image/png" class="form-control-file" name="image" id="image">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" id="btnCancelar" class="btn11 btn shadow"data-bs-dismiss="modal">Cancelar</button>
                        <button class="btnP btn"style="color: #fff;" id="envioDataEvento" type="button">Enviar</button>
                    </div>

                </form>

            </div>


        </div>

    </div>
</div>

<div class="modal fade" id="papeleraE" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content w-500">
            <form class="contenido" method="POST">
                <div class="card-header p-2">
                    <h4 class="titulo fw-bold text-end mr-2 " data-text="Papelera">evento</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive bordered ">
                        <table class="table table-hover" id="dataTable" >
                            <thead class=" table2 text-center">
                            <tr>
                                <th  scope="col">Evento</th>
                                <th  scope="col">Tipo</th>
                                <th  scope="col">lugar</th>
                                <th  scope="col">Entradas</th>
                                <th  scope="col">Fecha</th>
                                <th  scope="col">Hora</th>
                                <th  scope="col">Disponible</th>
                                <th  scope="col">Acciones</th>
                            </tr>
                            </thead>

                            <tbody">
                            <?php
                            if(isset( $listaPapelera)) {
                                foreach ($listaPapelera['data'] as $data){
                                    ?>
                                    <tr class="fila" id="ep-<?php echo $data->codigo?>">
                                        <th class="text-left"><?php echo $data->nombre ?></th>
                                        <th class="text-left"><?php echo $data->tipoEvento ?></th>
                                        <th class="text-left"><?php echo $data->lugar ?>
                                        <th class="text-left"><?php echo $data->entradas ?></th>
                                        <th class="text-left"><?php echo $data->fecha?></th>
                                        <th  class ="text-left"><?php echo $data->hora ?></th>
                                        <th  class ="text-left"><?php echo $data->status ?></th>
                                        <th class="text-center justify-content-center" >
                                            <button value="bep-<?php echo $data->codigo ?>" data-codigo="<?php echo $data->codigo?>" name="restaurarEvento" class="btn90 btn fw-bold  mb-1 col-9 col-md-7 restaurar-ev" type="button">
                                                <i class="bi bi-check2-circle "></i>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn11 btn  shadow"data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center paArriba fw-bold "><i class="bi bi-arrow-up-short"></i></a>
<?php
require_once("contenido/componentes/footer.php")
?>
<script type="text/javascript" src="<?php echo URL;?>assets/js/evento.js"></script>
