 <title> Lugares - Producciones 2.5.1.</title>
<?php 
 require_once("contenido/componentes/navegador.php");
 $carrusel->carruselEventos();
?>
  <div class="d-md-grid gap-2 d-md-flex  col-12 m-2 justify-content-center m-auto">

  <div class="m-2  justify-content-center col-md-9">
  <div class="card mt-4 mb-4 justify-content-center shadow ">
           <div class="card-header card-footer d-grid gap-2 d-md-flex">
                <div class="col-9">
                  <h4 class="titulo fw-bold text-end mr-2 " data-text="Lugares">lugares</h4>
                </div>
                <div class="d-grid gap-3 d-flex justify-content-md-end justify-content-center col-md-3 text-end">
                  
                  <button class="btn12 fw-bold col-2 col-md-3 col-lg-2.5" type="button"data-bs-toggle="modal" data-bs-target="#exampleRegistrarL" style="box-shadow:none!important;" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrar Lugar" ><i class="bx bxs-edit " style="font-size: 23px!important;"  ></i></button>

                  <a href="?url=reporteLugar" class="btn11 fw-bold col-2 col-md-3 col-lg-2.5 text-center pt-1" type="button" style="box-shadow:none!important;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Reporte de Lugares"><i class="bi bi-upload " style="font-size: 23px!important;"  ></i></a>
                  
                  <a class=" fw-bold  col-2 col-md-3 col-lg-2.5 text-center mt-1 " type="button" data-bs-toggle="modal" data-bs-target="#papeleraLU" data-bs-toggle="tooltip" data-bs-placement="top" title="Papelera Lugar"><i class="bi bi-trash icon999 " style="color: #fff; font-size: 30px;" ></i></a>


                </div>
            </div>
            <div class="card-body shadow">

             <div class="table-responsive bordered ">
                <table class="table table-hover" id="tablaL" >
                   <thead class=" table2 text-center">
                    <tr>
                      <th  scope="col">Codigo</th>
                      <th  scope="col">Lugar</th>
                      <th  scope="col">Dirección</th>
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
           <button class="btn btn12" type="submit" ><a href="?url=tipoEvento" style="text-decoration: none; color: #fff;box-shadow:none!important;">TIPO DE EVENTO</a></button>
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





  <div class="modal fade mx-auto" id="exampleRegistrarL" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">

      <div class="contenido">
        
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Registrar Lugar de los Eventos">evento</h4>
        </div>
        <form class="modal-body" method="POST" id="registrarLugar">
    
                 <div class="col-12">
                    <label  class="form-label"><i class="fa-solid fa-map-location-dot" style="color: #c79b2d!important;"></i>Lugar</label>
                   
                  <input type="text" class="form-control" placeholder="Ingrese un nuevo Lugar" name="lugar" id="lugar">
                   <p id="errorLugar"  class=" text-center l"></p>
                </div>
                <div class="col-12">
                  <label  class="form-label"><i class="fa-solid fa-location-dot" style="color: #c79b2d!important;"></i>Dirección</label>
                   
                  <input type="text" class="form-control" placeholder="Ingrese la Dirección" name="direccion" id="direccion">
                   <p id="errorDireccion" class=" text-center l"></p>
                </div>

          <div class="modal-footer">
             <button type="reset" class="btn btn11 btn-danger shadow"data-bs-dismiss="modal" id="cerrar">Cancelar</button>
            <button class="btn btnP btn-light"style="color: #fff;" id="envio" type="submit">Enviar</button>
         </div>

        </form>
            
       </div>       
      </div>   
    </div>
  </div>   



<div class="modal fade mx-auto" id="eliminarL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">
      <form class="contenido" method="POST" >
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Anular Lugar de Eventos">Lugar</h4>
        </div>
      <div class="modal-body anularL">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn11 btn-danger shadow" id="closed" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btnP btn-primary" id="anular">Anular</button>
      </div>
      </form>
      
    </div>
  </div>
</div>


<div class="modal fade mx-auto" id="modificarL" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">

      <div class="contenido">
        
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Modificar Lugar de los Eventos">evento</h4>
        </div>

        <form class="modal-body" method="POST" >
         
                 <div class="col-12">
                    <label  class="form-label"><i class="fa-solid fa-map-location-dot" style="color: #c79b2d!important;"></i>Lugar</label>
                   
                  <input type="text" class="form-control" placeholder="Ingrese un nuevo Lugar" name="lug" id="lugar00" >
                   <p id="errorLugar00" style="color:  #df0000;"  class=" text-center l"></p>
                  
                </div>

                <div class="col-12">
                  <label  class="form-label"><i class="fa-solid fa-location-dot" style="color: #c79b2d!important;"></i>Dirección</label>
                   
                  <input type="text" class="form-control" placeholder="Ingrese la Dirección" name="dir" id="direccion00" >
                   <p id="errorDireccion00" style="color:  #df0000;"  class=" text-center l"></p>
                </div>

          <div class="modal-footer">
             <button type="reset" class="btn btn11 btn-danger shadow " id="chao" data-bs-dismiss="modal">Cancelar</button>
            <button class="btn btnP btn-light"style="color: #fff;" id="modificar" type="button">Modificar</button>
         </div>

        </form>
            
       </div>       
      </div>   
    </div>
  </div>   



 <div class="modal fade mx-auto" id="papeleraLU" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content w-500">
      <form class="contenido" method="POST">
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Papelera">evento</h4>
        </div>
      <div class="modal-body">
         <div class="table-responsive bordered ">
                  <table class="table table-hover" id="tablaR" >
                   <thead class=" table2 text-center">
                    <tr>
                      <th  scope="col">Codigo</th>
                      <th  scope="col">Lugar</th>
                      <th  scope="col">Dirección</th>
                      <th  scope="col col-lg-3">Acciones</th>
                    </tr>
                  </thead>
              
                <tbody id="restaurarL">

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
 <script type="text/javascript" src="<?php echo URL;?>assets/js/lugar.js"></script>