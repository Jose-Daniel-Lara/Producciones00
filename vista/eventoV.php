 <title> Eventos - Producciones 2.5.1.</title>
<?php 
  require_once("contenido/componentes/navegador.php");
  $carrusel->carruselEventos();
?>

<div class="d-md-grid gap-2 d-md-flex  col-12 m-2 justify-content-center m-auto">

  <div class="m-2  justify-content-center col-md-9">
  <div class="card mt-4 mb-4 justify-content-center shadow ">
           <div class="card-header card-footer d-grid gap-2 d-md-flex">
                <div class="col-md-9">
                  <h4 class="titulo fw-bold text-end mr-2 " data-text="Gestión de Eventos">Usuarios</h4>
                </div>
                <div class="d-grid gap-3 d-flex justify-content-md-end justify-content-center col-md-3 text-end">
                  
                  <button class="btn12 fw-bold col-2 col-md-3 col-lg-2.5" type="button" data-bs-toggle="modal" data-bs-target="#exampleRegistrarE"style="box-shadow:none!important;" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrar Evento" ><i class="bx bxs-edit " style="font-size: 23px!important;"  ></i></button>

                  <a href="?url=reporteEventos" class=" btn11 fw-bold col-2 col-md-3 col-lg-2.5 text-center pt-1" type="button" style="box-shadow:none!important;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Reporte de Eventos"><i class="bx bx-archive-in " style="font-size: 23px!important;"  ></i></a>
                  
                  <a class=" fw-bold  col-2 col-md-3 col-lg-2.5 text-center mt-1 " type="button" data-bs-toggle="modal" data-bs-target="#papeleraE" data-bs-toggle="tooltip" data-bs-placement="top" title="Papelera Eventos"><i class="bi bi-trash icon999 " style="color: #fff; font-size: 30px;" ></i></a>


                </div>
            </div>
            <div class="card-body shadow">

             <div class="table-responsive bordered ">
                <table class="table table-hover" id="tablaE" >
                   <thead class=" table2 text-center">
                    <tr>
                      <th  scope="col">Evento</th>
                      <th  scope="col">Tipo</th>
                      <th  scope="col">lugar</th>
                      <th  scope="col">Entradas</th>
                       <th  scope="col">Fecha</th>
                      <th  scope="col">Hora</th>
                      <th  scope="col">imagen</th>
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
           <button class="btn btn12" type="submit" ><a href="?url=lugares" style="text-decoration: none; color: #fff;box-shadow:none!important;">LUGARES</a></button>
      </div>

  </div>

  <div class=" col-md-7 tex-center justify-content-center m-auto mb-3">
     <div class="bo1 d-grid col-12   mx-auto  " >
           <button class="btn btnP" type="submit" ><a href="?url=home" style="text-decoration: none; color: #fff;box-shadow:none!important;">INICIO</a></button>
      </div>
  </div>

   <div class=" col-md-7 tex-center justify-content-center m-auto mb-4">
     <div class="bo1 d-grid col-12  mx-auto" >
           <button class="btn btn11" type="submit" ><a href="?url=tipoEvento" style="text-decoration: none; color: #fff;box-shadow:none!important;">TIPO DE EVENTO</a></button>
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
        
    
<div class="modal fade mx-auto" id="exampleRegistrarE" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">
      <div class="contenido">
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Eventos">Eventos</h4>
        </div>
      <form class="modal-body"  method="POST" id="registrarE">
      <div class="row">
                <div class="col-md-6">
                    <label for="password" class="form-label"><i class="fa-sharp fa-solid fa-newspaper" style="color: #c79b2d!important;"></i>Nombre</label>

                    <input type="text" class="form-control" placeholder="Nombre del Evento" name="evento" id="evento"><br>
                     <p id="errorEvento"  class="text-center l"></p>
                </div>
                <div class="col-md-6 ">
                     <label for="text" class="form-label" ><i class="fa-solid fa-buildings" style="color: #c79b2d!important;"></i> Tipo de Evento</label>
                    
                    <select  class="form-select mb-3 registrar" id="select">
                     
                    </select>
                    <p id="errorSelect" class="text-center l"></p>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label"><i class="fa-solid fa-map-location-dot" style="color: #c79b2d!important;"></i>lugar</label>

                    <select  class="form-select mb-3 registrar" id="select01">
                     
                    </select>
                     <p id="errorSelect01"  class="text-center l"></p>
                </div>

                 <div class="col-md-6">
                    <label for="password" class="form-label"><i class="fa-solid fa-arrow-up-wide-short"style="color: #c79b2d!important;"></i>Cantidad de Entradas</label>

                    <input type="number" class="form-control" name="entradas" id="entradas"><br>
                     <p id="errorEntra"  class="text-center l"></p>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label"><i class="fa-solid fa-calendar-week" style="color: #c79b2d!important;"></i>Fecha</label>

                    <input type="date" class="form-control" name="fecha" id="fecha" ><br>
                    <p id="errorFecha" class="text-center l"></p>
                  
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label"><i class="fa-solid fa-clock" style="color: #c79b2d!important;"></i>Hora</label>

                    <input type="time" class="form-control" name="hora" id="hora"><br>
                    <p id="errorHora" class="text-center l"></p>
                     
                </div>
                 <div class="col-12">

                    <label for="password" class="form-label"><i class="fa-solid fa-image" style="color: #c79b2d!important;"></i>Imagen: </label>

                    <input type="file" class="form-control" name="imagen" id="imagen" ><br>
                    <p id="errorImg"  class="text-center l"></p>
                </div>


              </div>

            <div class="modal-footer">
              <button type="reset" id="cerrar" class="btn11 btn shadow"data-bs-dismiss="modal">Cancelar</button>
             <button class="btnP btn"style="color: #fff;" id="envio" type="submit">Enviar</button>
           </div>

     </form>
                
     </div>

           
     </div>

  </div>
</div>


<div class="modal fade mx-auto" id="eliminarE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">
      <form class="contenido" method="POST" id="AnularE">
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Anular Evento">Eventos</h4>
        </div>
      <div class="modal-body anularT">
      </div>
      <div class="modal-footer">
        <button type="button" id="closed" class="btn11 btn shadow"data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="anular" class="btnP btn">Anular</button>
      </div>
      </form >
      
    </div>
  </div>
</div>



<div class="modal fade mx-auto" id="modificarE" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">

      <div class="contenido">


        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Modificar Eventos">Eventos</h4>
        </div>

      <form class="modal-body"  method="POST">

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label"><i class="fa-sharp fa-solid fa-newspaper" style="color: #c79b2d!important;"></i>Nombre</label>

                    <input type="text" class="form-control" placeholder="Nombre del Evento" name="nom" id="evento00" value=""><br>

                     <p id="errorEvento00"  class="text-center l"></p>
                </div>

                <div class="col-md-6 ">
                     <label for="text" class="form-label" ><i class="fa-solid fa-buildings" style="color: #c79b2d!important;"></i> Tipo de Evento</label>
                    
                    <select  name= "tip" class="form-select modificar" id="select00">
                      <option  name= "tip" value="" class="opcion">
                      
                    </select>
                    <p id="errorSelect00" class="text-center l"></p>
                </div>

                <div class="col-md-6">
                    <label  class="form-label"><i class="fa-solid fa-map-location-dot" style="color: #c79b2d!important;"></i>lugar</label>

                    <select  name= "lug" class="form-select modificar" id="select2">
                       <option name= "lug" value="lugar" class="opcion" >Lugar</option>
                    </select>
                     <p id="errorSelect2" class="text-center l"></p>
                </div>

                 <div class="col-md-6">
                    <label class="form-label"><i class="fa-solid fa-arrow-up-wide-short"style="color: #c79b2d!important;"></i>Cantidad de Entradas</label>

                    <input type="number" class="form-control" name="ent" id="entradas00"  ><br>
                     <p id="errorEntra00"  class="text-center l"></p>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label"><i class="fa-solid fa-calendar-week" style="color: #c79b2d!important;"></i>Fecha</label>

                    <input type="date" class="form-control" name="fec" id="fecha00" ><br>
                    <p id="errorFecha00" class="text-center l"></p>
                  
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label"><i class="fa-solid fa-clock" style="color: #c79b2d!important;"></i>Hora</label>

                    <input type="time" class="form-control" name="hor" id="hora00"><br>
                    <p id="errorHora00" class="text-center l"></p>
                     
                </div>
                 <div class="col-12">

                    <label for="password" class="form-label"><i class="fa-solid fa-image" style="color: #c79b2d!important;"></i>Imagen: </label>

                    <input type="file" class="form-control" name="img" id="imagen00" ><br>
                    <p id="errorImg00"  class="text-center l"></p>
                </div>


              </div>

            <div class="modal-footer">
              <button type="reset" class="btn11 btn shadow" id="close" data-bs-dismiss="modal">Cancelar</button>
             <button class="btnP btn"style="color: #fff;" id="modificar" type="submit">Modificar</button>
           </div>

     </form>
                
     </div>

           
     </div>

  </div>
</div>


 <div class="modal fade mx-auto" id="papeleraE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog modal-dialog-centered modal-xl " role="document">
    <div class="modal-content w-500 ">
      <form class="contenido" method="POST">
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Papelera">evento</h4>
        </div>
      <div class="modal-body">
         <div class="table-responsive bordered ">
                  <table class="table table-hover" id="tablaR" >
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
              
                <tbody id="restaurarT">
                 

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


<div class="modal fade mx-auto" id="restta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class=" modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content w-500">
      <form class="contenido" method="POST">
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Restaurar">area</h4>
        </div>
      <div class="modal-body mostrarR " id="mostrarR">
      
      </div>
      <div class="modal-footer">
        <button type="button" id="cancelar" class="btn btn11 btn-danger  shadow"data-bs-dismiss="modal">Cancelar</button>
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
<script type="text/javascript" src="<?php echo URL;?>assets/js/evento.js"></script>
