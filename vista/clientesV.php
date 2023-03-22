
<title> Clientes - Producciones 2.5.1.</title>

<?php
require_once("contenido/componentes/navegador.php");
$carrusel->carruselVentas();
?>
<main class="container" id="table">
    <div>
        <?php echo (isset($mensaje[0]))? ($mensaje[0] == "cedula")?  $mensaje[1] :  " " :  " " ?>
    </div>

    <div class="card mt-4 mb-4 justify-content-center shadow ">
        <div class="card-header card-footer d-grid gap-2 d-md-flex">
            <div class="col-md-9">
                <h4 class="titulo fw-bold text-end mr-2 " data-text="Gestión de Clientes">Clientes</h4>
            </div>
            <div class="d-grid gap-3 d-flex justify-content-md-end justify-content-center col-md-3 text-end">

                <button class="btn12 fw-bold col-3 col-lg-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleRegistrarC"style="box-shadow:none!important;" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrar Clientes" ><i class="bx bxs-edit " style="font-size: 23px!important;"  ></i></button>

                <a href="?url=reporteClientes" class=" btn11 fw-bold col-3 col-lg-2 text-center pt-1 " type="button" style="box-shadow:none!important;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Reporte de Clientes"><i class="bi bi-upload" style="font-size: 23px!important;"  ></i></a>

                <a class=" fw-bold col-3 col-lg-2 text-center mt-1 " type="button" data-bs-toggle="modal" data-bs-target="#papeleraCL" data-bs-toggle="tooltip" data-bs-placement="top" title="Papelera Clientes"><i class="bi bi-trash icon999 " style="color: #fff; font-size: 30px;" ></i></a>


            </div>
        </div>

        <div class="card-body shadow">

            <div class="table-responsive bordered ">
                <table class="table table-hover" id="dataTable" >
                    <thead class=" table2 text-center">
                    <tr>
                        <th  scope="col">Cedula</th>
                        <th  scope="col">Nombre</th>
                        <th  scope="col">Apellido</th>
                        <th  scope="col">Telefono</th>
                        <th  scope="col">Correo</th>
                        <th  scope="col col-lg-3">Acciones</th>
                    </tr>
                    </thead>


                    <tbody">
                    <?php
                    if(isset( $mostrarClientes)) {
                        foreach ($mostrarClientes['data'] as $data){

                            ?>
                            <tr class="fila">
                                <th class="text-left"><?php echo $data->cedula ?></th>
                                <th class="text-left"><?php echo $data->nombre ?></th>
                                <th class="text-left"><?php echo $data->apellido ?></th>
                                <th class="text-left"><?php echo $data->telefono ?></th>
                                <th class="text-left"><?php echo $data->correoElectronico  ?></th>

                                <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                                    <button class="btn btn90 fw-bold  mb-1 col-6 col-md-4" type="button" data-bs-toggle="modal" data-bs-target="#exampleModificarC<?php echo $data->cedula ?>"data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar" ><i class="bi bi-pencil-fill "></i></button>
                                    <button class="btn btn11 fw-bold  mb-1 col-6 col-md-4" type="button" data-bs-toggle="modal" data-bs-target="#exampleEliminarC<?php echo $data->cedula ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Anular"><i class="bi bi-trash-fill "></i></button>
                                </th>

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

        </div>

        <div class="card-header"></div>
    </div>


    </div>


    <div class="modal fade mx-auto" id="exampleRegistrarC" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class=" modal-dialog modal-dialog-centered ">
            <div class="modal-content w-500">

                <div class="contenido">

                    <div class="card-header p-2">
                        <h4 class="titulo fw-bold text-end mr-2 " data-text=" Registrar Clientes">Clientes</h4>
                    </div>
                    <form class="modal-body" method="POST" id="registrarCliente">
                        <div class=" row g-3 mb-3">

                            <div class="col-12">
                                <label  class="form-label"><i class="bi bi-person-badge icon" style="color: #c79b2d!important;"></i>Cedula de Identidad</label>
                                <div class="row">
                                    <div class="col-3">
                                        <select  name= "tipoCI" class="form-select" id="select">
                                            <option value=".." class="opcion" >..</option>
                                            <option value="V-"  class="opcion">V</option>
                                            <option value="E-"  class="opcion">E</option>
                                        </select>
                                        <p id="errorSelect"  class=" text-center l"></p>
                                    </div>

                                    <div class="col-9"> <input type="number" class="form-control" placeholder="Cedula del cliente" name="cedula" id="cedula">
                                        <p id="errorCedula"  class=" text-center l"></p>
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-6">
                                <label  class="form-label"><i class="ri-edit-fill icon "style="color: #c79b2d!important;"></i>Nombre</label>

                                <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre">
                                <p id="errorNombre"  class=" text-center l"></p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><i class="ri-edit-fill icon" style="color: #c79b2d!important;"></i>Apellido</label>

                                <input type="text" class="form-control" placeholder="Apellido" name="apellido" id="apellido">
                                <p id="errorApellido"  class=" text-center l"></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6" >
                                <label  class="form-label"> Registrar Teléfono</label>
                                <input type="checkbox" id="config1">

                            </div>
                            <div class="col-6" >
                                <label  class="form-label"> Registrar Correo</label>
                                <input type="checkbox" id="config2">

                            </div>

                        </div>

                        <div class="row inputV">

                            <div class="col-md-6 tel "  style="display: none;">
                                <label  class="form-label"><i class="ri-phone-fill icon" style="color: #c79b2d!important;"></i>Telefono</label>

                                <input type="number" class="form-control" placeholder="N° Telefono" name="telefono" id="telefono">
                                <p id="errorTelefono"  class=" text-center l"></p>

                            </div>

                            <div class="col-md-6 email"  style="display: none;">
                                <label class="form-label"><i class="bi bi-envelope-fill icon " style="color: #c79b2d!important;"></i>Correo Electrónico</label>

                                <input type="text" class="form-control" placeholder="Correo Electrónico" name="correo" id="correo">
                                <p id="errorCorreo"  class=" text-center l"></p>

                            </div>


                        </div>

                        <div class="modal-footer mt-4">
                            <button type="reset" class="btn btn11 btn-danger shadow"data-bs-dismiss="modal" id="cerrar">Cancelar</button>
                            <button class="btn btnP"style="color: #fff;" id="envio" type="submit">Enviar</button>
                        </div>

                    </form>


                </div>



            </div>
        </div>
    </div>



</main>
<?php
if(isset($mostrarClientes)) {
    foreach ($mostrarClientes['data'] as $data){

        ?>

        <div class="modal fade mx-auto" id="exampleEliminarC<?php echo $data->cedula ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class=" modal-dialog modal-dialog-centered ">
                <div class="modal-content w-500">
                    <form class="contenido" method="POST" id="eliminarCliente">
                        <input type="hidden" name="cedula" value="<?php echo $data->cedula ?>">
                        <div class="contenido">
                            <div class="card-header p-2">
                                <h4 class="titulo fw-bold text-end mr-2 " data-text="Anular Cliente">Cliente</h4>
                            </div>
                            <div class="modal-body">
                                ¿Deseas anular al Cliente <b style="color: #040855"><?php echo $data->nombre ." ". $data->apellido  ?></b> ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class=" btn btn11 btn-danger shadow"data-bs-dismiss="modal" id="closed">Cancelar</button>
                                <button  type="submit" class="btn btnP" id="anular">Anular</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="modal fade mx-auto" id="exampleModificarC<?php echo $data->cedula ?>" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class=" modal-dialog modal-dialog-centered ">
                <div class="modal-content w-500">

                    <div class="contenido">

                        <div class="card-header p-2">
                            <h4 class="titulo fw-bold text-end mr-2 " data-text=" Modificar Cliente">Clientes</h4>
                        </div>
                        <form class="modal-body" method="POST" id="modificarCliente">
                            <input type="hidden" name="cod" value="<?php echo $data->cedula ?>" >
                            <div class=" row g-2 ">

                                <div class="col-12">
                                    <label  class="form-label"><i class="bi bi-person-badge icon" style="color: #c79b2d!important;"></i>Cedula de Identidad</label>

                                    <input type="text" class="form-control" placeholder="Cedula del Cliente" name="cedula00" id="cedula00" value="<?php echo $data->cedula ?>">
                                    <p id="errorCedula00" class=" text-center l"></p>

                                </div>


                                <div class="col-md-6">
                                    <label  class="form-label"><i class="ri-edit-fill icon "style="color: #c79b2d!important;"></i>Nombre</label>


                                    <input type="text" class="form-control" placeholder="Nombre" name="nombre00" id="nombre00" value="<?php echo $data->nombre ?>">
                                    <p id="errorNombre00"  class=" text-center l"></p>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="ri-edit-fill icon" style="color: #c79b2d!important;"></i>Apellido</label>

                                    <input type="text" class="form-control" placeholder="Apellido" name="apellido00" id="apellido00" value="<?php echo $data->apellido ?>">
                                    <p id="errorApellido00"  class=" text-center l"></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6" >
                                    <label  class="form-label"> Modificar Teléfono</label>
                                    <input type="checkbox" id="config3">

                                </div>
                                <div class="col-6" >
                                    <label  class="form-label"> Modificar Correo</label>
                                    <input type="checkbox" id="config4">

                                </div>

                            </div>
                            <div class="row inputV">

                                <div class="col-md-6 tel00 "  style="display: none;">
                                    <label  class="form-label"><i class="ri-phone-fill icon"  style="color: #c79b2d!important;"></i>Telefono</label>

                                    <input type="number" class="form-control" value="<?php echo $data->telefono ?>" placeholder="N° Telefono" name="tel00" id="telefono00">
                                    <p id="errorTelefono00"  class=" text-center l"></p>

                                </div>

                                <div class="col-md-6 email00"  style="display: none;">
                                    <label class="form-label"><i class="bi bi-envelope-fill icon " style="color: #c79b2d!important;"></i>Correo Electrónico</label>

                                    <input type="text" class="form-control"  value="<?php echo $data->correoElectronico ?>" placeholder="Correo Electrónico" name="corr00" id="correo00">
                                    <p id="errorCorreo00"  class=" text-center l"></p>

                                </div>


                            </div>

                            <div class="modal-footer mt-4">
                                <button type="reset" class="btn btn11 btn-danger shadow"data-bs-dismiss="modal" id="close">Cancelar</button>
                                <button class="btn btnP"style="color: #fff;" id="modifica" type="submit">Modificar</button>
                            </div>

                        </form>


                    </div>



                </div>
            </div>
        </div>

        <?php
    }
}else{
    " ";
}
?>


<div class="modal fade mx-auto" id="papeleraCL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content w-500">
            <form class="contenido" method="POST">
                <div class="card-header p-2">
                    <h4 class="titulo fw-bold text-end mr-2 " data-text="Papelera">clientes</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive bordered ">
                        <table class="table table-hover" id="dataTable" >
                            <thead class=" table2 text-center">
                            <tr>
                                <th  scope="col">Cedula</th>
                                <th  scope="col">Nombre</th>
                                <th  scope="col">Apellido</th>
                                <th  scope="col">Telefono</th>
                                <th  scope="col">Email</th>
                                <th  scope="col col-lg-3">Restaurar</th>
                            </tr>
                            </thead>

                            <tbody">
                            <?php
                            if(isset( $papeleraClientes)) {
                                foreach ($papeleraClientes['data'] as $data){

                                    ?>
                                    <tr class="fila">
                                        <th class="text-left"><?php echo $data->cedula ?></th>
                                        <th class="text-left"><?php echo $data->nombre ?></th>
                                        <th class="text-left"><?php echo $data->apellido ?></th>
                                        <th class="text-left"><?php echo $data->telefono ?> </th>
                                        <th class="text-left"><?php echo $data->correoElectronico ?></th>

                                        <th class="text-center justify-content-center" >
                                            <button value="<?php echo $data->cedula ?>" name="restaurarCL" class="btn90 fw-bold  mb-1 col-9 col-md-7" type="submit" ><i class="bi bi-check2-circle "></i></button>
                                        </th>

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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn11 btn-danger  shadow"data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center paArriba fw-bold "><i class="bi bi-arrow-up-short"></i></a>
<?php
require_once("contenido/componentes/footer.php")
?>
<script type="text/javascript" src="<?php echo URL;?>assets/js/cliente.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/back.js"></script>