 <title> Tipos de Eventos - Producciones 2.5.1.</title>
<?php 
  require_once("contenido/componentes/navegador.php");
  $carrusel->carruselEventos();
?>
<div class="d-md-grid gap-2 d-md-flex  col-12 m-2 justify-content-center m-auto">

  <div class="m-2  justify-content-center col-md-9">
  <div class="card mt-4 mb-4 justify-content-center shadow ">
          <div class="card-header card-footer d-grid gap-2 d-flex">
                <div class="col-9">
                  <h4 class="titulo fw-bold text-end mr-2 " data-text="Tipos de Eventos">Evento</h4>
                </div>
                <div class="d-grid gap-2 d-flex  justify-content-end col-3 text-end">

                  <button class="btn12 fw-bold co-5  col-md-3 col-lg-2.5" type="button" data-bs-toggle="modal" data-bs-target="#exampleRegistrarTE"style="box-shadow:none!important;" id="asdasd"><i class="bx bxs-edit " style="font-size: 23px!important;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Registrar Tipo de Evento" ></i></button>
                  
                   <a class=" fw-bold col-5 col-md-3 col-lg-2.5 text-center mt-1 " type="button" data-bs-toggle="modal" data-bs-target="#papeleraTI"  data-bs-toggle="tooltip" data-bs-placement="top" title="Papelera Tipo Evento"><i class="bi bi-trash icon999 " style="color: #fff; font-size: 30px;" ></i></a>
                </div>
            </div>
            <div class="card-body shadow">

             <div class="table-responsive bordered ">
                <table class="table table-hover" id="tablaTipo" >
                   <thead class=" table2 text-center">
                    <tr>
                      <th  scope="col">Codigo</th>
                      <th  scope="col">Tipo de Evento</th>
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




  <div class="modal fade mx-auto" id="exampleRegistrarTE" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">

      <div class="contenido">
        
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Registrar Tipo de Evento">evento</h4>
        </div>
        <form class="modal-body" method="POST" id="registrarTipo">
    
                 <div class="col-12">
                    <label  class="form-label"><i class="fa-sharp fa-solid fa-newspaper"style="color: #c79b2d!important;"></i>Tipo de Evento</label>
                   
                  <input type="text" class="form-control" placeholder="Ingrese un nuevo tipo de evento" name="tipo" id="tipo">
                   <p id="errorTipo"  class=" text-center l"></p>
                </div>

          <div class="modal-footer">
             <button type="reset" id="cerrar" class="btn btn11 btn-danger shadow"data-bs-dismiss="modal">Cancelar</button>
            <button class="btn btnP"style="color: #fff;" id="envio" type="submit">Enviar</button>
         </div>

        </form>
            
       </div>       
      </div>   
    </div>
  </div>   


<div class="modal fade mx-auto" id="anularT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">
      <form class="contenido" method="POST">
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Anular Tipo de Evento">Moneda</h4>
        </div>
      <div class="modal-body anularTipo">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn11 btn-danger shadow" id="closed" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btnP" id="anular">Anular</button>
      </div>
      </form>
      
    </div>
  </div>
</div>


<div class="modal fade mx-auto" id="modificarT" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">

      <div class="contenido">
        
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text=" Modificar Tipo de  Evento">evento</h4>
        </div>
        <form class="modal-body" method="POST">
    
                 <div class="col-12">
                    <label  class="form-label"><i class="fa-sharp fa-solid fa-newspaper"style="color: #c79b2d!important;"></i>Tipo de Evento</label>
                   
                  <input type="text" class="form-control" placeholder="Ingrese un nuevo tipo de evento" name="tip" id="tipo00" value="">
                    <p id="errorTipo00"  class=" text-center l "></p>
                </div>

          <div class="modal-footer">
             <button type="reset" id="close" class=" btn btn11 btn-danger shadow"data-bs-dismiss="modal">Cancelar</button>
            <button class="btn btnP"style="color: #fff;" id="modificar"  type="button">Modificar</button>
         </div>

        </form>
            
       </div>       
      </div>   
    </div>
  </div>   

 <div class="modal fade mx-auto" id="papeleraTI" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
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
                      <th  scope="col">Tipo de Evento</th>
                      <th  scope="col col-lg-3">Acciones</th>
                    </tr>
                  </thead>
              
                <tbody id="restaurarT">
                    
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
 <script type="text/javascript" src="<?php echo URL;?>assets/js/tipoE.js"></script>