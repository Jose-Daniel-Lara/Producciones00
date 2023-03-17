
 <title> Clientes - Producciones 2.5.1.</title>

<?php 
 require_once("contenido/componentes/navegador.php");
  $carrusel->carruselVentas();
?>
  
<div class="d-md-grid gap-2 d-md-flex  col-12 m-2 justify-content-center m-auto">

  <div class="m-2  justify-content-center col-md-9">
  <div class="card mt-4 mb-4 justify-content-center shadow ">
           <div class="card-header card-footer d-grid gap-2 d-md-flex">
                <div class="col-md-9">
                   <h4 class="titulo fw-bold text-end mr-2 " data-text="Gestión de Clientes">Clientes</h4>
                </div>
                <div class="d-grid gap-3 d-flex justify-content-md-end justify-content-center col-md-3 text-end">

                 <button class="btn12 fw-bold col-3 col-lg-2.5" type="button" data-bs-toggle="modal" data-bs-target="#exampleRegistrarC"style="box-shadow:none!important;" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrar Clientes" ><i class="bx bxs-edit " style="font-size: 23px!important;"  ></i></button>

                 <a href="?url=reporteClientes" class=" btn11 fw-bold col-3 col-lg-2.5 text-center pt-1 " type="button" style="box-shadow:none!important;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Reporte de Clientes"><i class="bi bi-upload" style="font-size: 23px!important;"  ></i></a>
                  
                  <a class=" fw-bold col-3 col-lg-2.5 text-center mt-1 " type="button" data-bs-toggle="modal" data-bs-target="#papeleraCL" data-bs-toggle="tooltip" data-bs-placement="top" title="Papelera Clientes"><i class="bi bi-trash icon999 " style="color: #fff; font-size: 30px;" ></i></a>


                </div>
            </div>
        
            <div class="card-body shadow">

             <div class="table-responsive bordered ">
                <table class="table table-hover" id="tablaClientes" >
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
              
                
                  <tbody id="tbody">
                 
              
                  </tbody>

                </table>
              </div>

            </div>
        
            <div class="card-header"></div>
            </div>
            
            
          </div>
<div class="col-md-2 d-none d-md-block mt-4">
<div class="shadow"style="background: #fff!important;">
   <div class="card-header">
     <div class="text-center p-1 mb-2" >
        <img src="assets/img/11a.png" width="75" height="65" >
      </div>
  </div>
  
  <div class="col-md-7 tex-center justify-content-center m-auto mb-3">
  
     <div class="bo1 d-grid col-12  mx-auto mt-4 " >
           <button class="btn btn12" type="submit" ><a href="?url=ventas" style="text-decoration: none; color: #fff;box-shadow:none!important;">VENTAS</a></button>
      </div>

  </div>

  <div class=" col-md-7 tex-center justify-content-center m-auto mb-3">
     <div class="bo1 d-grid col-12   mx-auto  " >
           <button class="btn btnP" type="submit" ><a href="?url=home" style="text-decoration: none; color: #fff;box-shadow:none!important;">INICIO</a></button>
      </div>
  </div>

   <div class=" col-md-7 tex-center justify-content-center m-auto mb-4">
     <div class="bo1 d-grid col-12  mx-auto" >
           <button class="btn btn11" type="submit" ><a href="?url=eventos" style="text-decoration: none; color: #fff;box-shadow:none!important;">EVENTOS</a></button>
      </div>
  </div>

 <div class="card card-footer card-header">
 .
 <BR>
 .
 <BR>
 .
 </div>

</div>

          

</div>
</div>
        </div>


  <div class="modal fade mx-auto" id="exampleRegistrarC" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">

      <div class="contenido">
        
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text=" Registrar Clientes">Clientes</h4>
        </div>
        <form class="modal-body" method="POST">
          <div class=" row g-3 mb-3">

                <div class="col-12">
                    <label  class="form-label"><i class="bi bi-person-badge icon" style="color: #c79b2d!important;"></i>Cedula de Identidad</label>
                    <div class="row">
                    <div class="col-3">
                     <select  name= "tipoCI" class="form-select ti" id="select">
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

<div class="modal fade mx-auto" id="eliminarC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">
      <form class="contenido" method="POST" id="eliminarCliente">
      <div class="contenido">
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Anular Cliente">Cliente</h4>
        </div>
      <div class="modal-body anularC">
     
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

 <div class="modal fade mx-auto" id="modificarC" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">

      <div class="contenido">
        
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text=" Modificar Cliente">Clientes</h4>
        </div>
          <form class="modal-body" method="POST" id="modificarCliente">
        
          <div class=" row g-2 ">

                <div class="col-12">
                     <label  class="form-label"><i class="bi bi-person-badge icon" style="color: #c79b2d!important;"></i>Cedula de Identidad</label>

                    <input type="text" class="form-control" placeholder="Cedula del Cliente" id="cedula00" >
                    <p id="errorCedula00" class=" text-center l"></p>
              
                </div>

    
                 <div class="col-md-6">
                     <label  class="form-label"><i class="ri-edit-fill icon "style="color: #c79b2d!important;"></i>Nombre</label>
                   
                   
                   <input type="text" class="form-control" placeholder="Nombre"  id="nombre00">
                 <p id="errorNombre00"  class=" text-center l"></p>
                </div>

                <div class="col-md-6">
                   <label class="form-label"><i class="ri-edit-fill icon" style="color: #c79b2d!important;"></i>Apellido</label>
              
                   <input type="text" class="form-control" placeholder="Apellido" id="apellido00" >
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
                   
                     <input type="number" class="form-control" placeholder="N° Telefono"  id="telefono00">
                     <p id="errorTelefono00"  class=" text-center l"></p>
                
                </div>

                 <div class="col-md-6 email00"  style="display: none;">
                    <label class="form-label"><i class="bi bi-envelope-fill icon " style="color: #c79b2d!important;"></i>Correo Electrónico</label>

                     <input type="text" class="form-control" placeholder="Correo Electrónico"  id="correo00">
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

 <div class="modal fade mx-auto" id="papeleraCL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog modal-dialog-centered modal-xl " role="document">
    <div class="modal-content w-500">
      <form class="contenido" method="POST">
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Papelera">clientes</h4>
        </div>
      <div class="modal-body">
         <div class="table-responsive bordered ">
                  <table class="table table-hover" id="tablaR" >
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
              
                   <tbody id="restaurarC">
                

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

<div class="modal fade mx-auto" id="restta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content w-500">
      <form class="contenido" method="POST">
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Restaurar">area</h4>
        </div>
      <div class="modal-body mostrarR ">
      
      </div>
      <div class="modal-footer">
        <button type="button" id="cancelar" class="btn btn11 btn-danger  shadow cancelar" data-bs-dismiss="modal">Cancelar</button>
         <button  type="button" class="btn btnP " id="lito" >Restaurar</button>
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