 <title> Usuarios - Producciones 2.5.1.</title>

<?php 
  require_once("contenido/componentes/navegador.php");
  $carrusel->carruselVentas();
?>

<div class="d-md-grid gap-2 d-md-flex  col-12 m-2 justify-content-center m-auto">

  <div class="m-2  justify-content-center col-md-9">
  
  <div class="card mt-4 mb-4 justify-content-center shadow ">


             <div class="card-header card-footer d-grid gap-2 d-md-flex">
                <div class="col-md-9">
                 <h4 class="titulo fw-bold text-end mr-2 " data-text="Gestión de usuarios">Usuarios</h4>
                </div>
                <div class="d-grid gap-3 d-flex justify-content-md-end justify-content-center col-md-3 text-end">
                  
                  <button class="btn12 fw-bold col-2 col-md-3 col-lg-2.5" type="button" data-bs-toggle="modal" data-bs-target="#exampleRegistrarU"style="box-shadow:none!important;" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrar Usuario" ><i class="bx bxs-edit " style="font-size: 23px!important;"  ></i></button>
                 
                  <a class=" fw-bold col-2 col-md-3 col-lg-2  text-center mt-1.5 " type="button" data-bs-toggle="modal" data-bs-target="#examplePapeleraU" data-bs-toggle="tooltip" data-bs-placement="top" title="Papelera Usuario"><i class="bi bi-trash icon999 " style="color: #fff; font-size: 30px;" ></i></a>

                </div>
            </div>

            <div class="card-body shadow">

             <div class="table-responsive bordered ">
                <table class="table table-hover" id="tablaUser" >
                   <thead class=" table2 text-center">
                    <tr>
                      <th  scope="col">N°</th>
                      <th  scope="col">Nombre</th>
                      <th  scope="col">Usuario</th>
                      <th  scope="col">Correo</th>
                      <th  scope="col col-lg-3">Acciones</th>
                    </tr>
                  </thead>
              
                
                 <tbody id="tbody">
               
                  </tbody>
                </table>
              </div>
              <!-- End Table with stripped rows -->

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
           <button class="btn btn12" type="submit" ><a href="?url=perfil" style="text-decoration: none; color: #fff;box-shadow:none!important;">PERFIL</a></button>
      </div>

  </div>

  <div class=" col-md-7 tex-center justify-content-center m-auto mb-3">
     <div class="bo1 d-grid col-12   mx-auto  " >
           <button class="btn btnP" type="submit" ><a href="?url=home" style="text-decoration: none; color: #fff;box-shadow:none!important;">INICIO</a></button>
      </div>
  </div>

   <div class=" col-md-7 tex-center justify-content-center m-auto mb-4">
     <div class="bo1 d-grid col-12  mx-auto" >
           <button class="btn btn11" type="submit" ><a href="?url=ventas" style="text-decoration: none; color: #fff;box-shadow:none!important;">VENTAS</a></button>
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
        



<div class="modal fade mx-auto " id="exampleRegistrarU" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="POST" class="modal-dialog modal-dialog-centered  modal-screen " id="registrarUsuario">
    <div class="modal-content w-500">
      <div class="contenido">
      <div class=" card-header p-2">
      
        <h4 class="titulo fw-bold text-end mr-2 " data-text="Registrar Usuario">Usuarios</h4>
      </div>
      <div class="modal-body">
      <div class="row">

                <div class="col-md-6">
                    <label for="text" class="form-label"><i class="bi bi-person-fill icon" style="color: #c79b2d!important;"></i>Usuario</label>
                    <input type="text" class="form-control" placeholder="Nombre de Usuario" id="usuario">
                     <p id="errorUsuario"  class=" text-center l"></p>

                </div>

                <div class="col-md-6">
                    <label for="text" class="form-label" ><i class="bi bi-people-fill icon" style="color: #c79b2d!important;"></i>Tipo de Usuario</label>
                    
                    <select   class="form-select" id="select">
                      <option value="tipo" class="opcion" >Tipo de Usuario</option>
                      <option value="Administrador"  class="opcion">Administrador</option>
                      <option value="Encargado"  class="opcion">Encargado</option>
                    </select>
                    <p id="errorSelect" class="text-center l"></p>
                </div>

                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label"><i class="bi bi-envelope-fill icon " style="color: #c79b2d!important;"></i> Email</label>
                    <input type="email" placeholder="Ingresa tu Correo Electrónico" class="form-control" id="correo" ><br>
                     <p id="errorCorreo" class="text-center l"></p>
                    
                </div>
        
                <div class="col-md-6">
                    <label for="password" class="form-label"><i class="bx bxs-lock icon" style="color: #c79b2d!important;"></i>Contraseña</label>
                    <input type="password" class="form-control" placeholder="Ingrese una Contraseña"  id="clave"><br>
                     <p id="errorClave"  class="text-center l"></p>
                      
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label"><i class="bx bxs-lock icon" style="color: #c79b2d!important;"></i>Repetir Contraseña </label>
                    <input type="password" class="form-control" placeholder="Ingrese nuevamente la contraseña" id="clave2"><br>
                      <p id="errorClave2" class="text-center l"></p>
                </div>
                  <p id="errorContraseñas" class="text-center l"></p>
        
      </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn11 btn-danger  shadow"data-bs-dismiss="modal" id="cerrar">Cancelar</button>
        <button type="submit" class="btn btnP " id="envio">Registrar</button>
      </div>
      </div>
      
    </div>
  </form>
</div>

<div class="modal fade mx-auto" id="eliminarU" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">
      <form class="contenido" method="POST" id="eliminarUsuario">
       
      <div class="contenido">
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Anular Usuario">Usuario</h4>
        </div>
      <div class="modal-body anularU">
      
      </div>
      <div class="modal-footer">
        <button type="button" id="closed" class="btn btn11 btn-danger shadow"data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" id="anular" class="btn btnP ">Anular</button>
      </div>
      </div>
      </form>
      
    </div>
  </div>
</div>


<div class="modal fade mx-auto " id="modificarU" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="POST" class="modal-dialog modal-dialog-centered   modal-screen " id="modificarUsuario">
    
    <div class="modal-content w-500">
      <div class="contenido">
      <div class=" card-header p-2">
      
        <h4 class="titulo fw-bold text-end mr-2 " data-text="Modificar Usuario">Usuarios</h4>
      </div>
      <div class="modal-body">
      <div class="row">

              <div class="col-md-6">
                     <label for="text" class="form-label"><i class="bi bi-person-fill icon" style="color: #c79b2d!important;"></i>Usuario</label>

                    <input type="text" class="form-control"  placeholder="Nombre de Usuario"  id="usuario00">
                     <p id="errorUsuario00" class=" text-center l"></p>
                    
             </div>

                <div class="col-md-6">
                     <label for="text" class="form-label" ><i class="bi bi-people-fill icon" style="color: #c79b2d!important;"></i>Tipo de Usuario</label>
                    
                    <select  class="form-select" id="select00">
                      <option value="Administrador"  class="opcion">Administrador</option>
                      <option value="Encargado"  class="opcion">Encargado</option>
                    </select>
                    <p id="errorSelect00" class="text-center l"></p>
                </div>

                <div class="col-12">
                     <label for="inputEmail4" class="form-label"><i class="bi bi-envelope-fill icon " style="color: #c79b2d!important;"></i> Email</label>

                    <input type="email" placeholder="Ingresa tu Correo Electrónico" class="form-control" id="correo00" ><br>

                     <p id="errorCorreo00" class="text-center l"></p>

                </div>
        
                <div class="col-md-6">
                     <label for="password" class="form-label"><i class="bx bxs-lock icon" style="color: #c79b2d!important;"></i>Contraseña</label>
                    <input type="password" class="form-control" placeholder="Ingrese una Contraseña" id="claveM" ><br>
                     <p id="errorClaveM" class="text-center l"></p>
                </div>
                <div class="col-md-6 ">
                    <label for="password" class="form-label"><i class="bx bxs-lock icon" style="color: #c79b2d!important;"></i>Repetir Contraseña </label>
                    <input type="password" class="form-control" placeholder="Ingrese nuevamente la contraseña"  id="claveM2"><br>
                      <p id="errorClaveM2" class="text-center l"></p>
                </div>
                 <p id="errorContraseñas00"class="text-center l"></p>
      </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn11   shadow"data-bs-dismiss="modal" id="close">Cancelar</button>
        <button type="button" class="btn btnP " id="modificar" >Modificar</button>
      </div>
      </div>
      
    </div>
  </form>
</div>

 <div class="modal fade mx-auto" id="examplePapeleraU" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content w-500">
      <form class="contenido" method="POST">
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Papelera">usuario</h4>
        </div>
      <div class="modal-body">
         <div class="table-responsive bordered ">
                  <table class="table table-hover" id="tablaR" >
                   <thead class=" table2 text-center">
                    <tr>
                      <th  scope="col">N°</th>
                      <th  scope="col">Nombre</th>
                      <th  scope="col">Usuario</th>
                      <th  scope="col">Correo</th>
                      <th  scope="col col-lg-3">Restaurar</th>
                    </tr>
                  </thead>
              
                  <tbody id="restaurarU">
                
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
 <script type="text/javascript" src="<?php echo URL;?>assets/js/gestionarUsuario.js"></script>
</body>