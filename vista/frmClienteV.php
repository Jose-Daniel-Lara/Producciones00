<?php
?>
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
                     <select  name= "tipoCI" class="form-select" id="selectTipoCedula">
                      <option value=".." class="opcion" >..</option>
                      <option value="V-"  class="opcion">V</option>
                      <option value="E-"  class="opcion">E</option>
                    </select>
                     <p id="errorSelectTipoCedula"  class=" text-center l"></p>
                    </div>

                    <div class="col-9"> <input type="number" class="form-control" placeholder="Cedula del cliente" name="cedulaCliente" id="cedulaCliente">
                   <p id="errorCedulaCliente"  class=" text-center l"></p>
                    </div>
                    </div>

                </div>


                 <div class="col-md-6">
                    <label  class="form-label"><i class="ri-edit-fill icon "style="color: #c79b2d!important;"></i>Nombre</label>

                   <input type="text" class="form-control" placeholder="Nombre" name="nombreCliente" id="nombreCliente">
                 <p id="errorNombreCliente"  class=" text-center l"></p>
                </div>

                <div class="col-md-6">
                   <label class="form-label"><i class="ri-edit-fill icon" style="color: #c79b2d!important;"></i>Apellido</label>

                   <input type="text" class="form-control" placeholder="Apellido" name="apellidoCliente" id="apellidoCliente">
                 <p id="errorApellidoCliente"  class=" text-center l"></p>
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

                     <input type="number" class="form-control" placeholder="N° Telefono" name="telefonoCliente" id="telefonoCliente">
                     <p id="errorTelefonoCliente"  class=" text-center l"></p>

                </div>

                 <div class="col-md-6 email"  style="display: none;">
                    <label class="form-label"><i class="bi bi-envelope-fill icon " style="color: #c79b2d!important;"></i>Correo Electrónico</label>

                     <input type="text" class="form-control" placeholder="Correo Electrónico" name="correoCliente" id="correoCliente">
                     <p id="errorCorreoCliente"  class=" text-center l"></p>

                </div>


            </div>

         <div class="modal-footer mt-4">
           <button type="reset" class="btn btn11 btn-danger shadow" data-bs-target="#registrarV" data-bs-toggle="modal" id="cerrar">Cancelar</button>
           <button class="btn btnP"style="color: #fff;" id="envioDataCliente" type="button">Enviar</button>
         </div>

        </form>


      </div>



    </div>
  </div>
</div>
<script>

</script>
