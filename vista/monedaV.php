 <title> Moneda - Producciones 2.5.1.</title>
<?php 
 require_once("contenido/componentes/navegador.php");
  $carrusel->carruselVentas();
?>
  <div class="d-md-grid gap-2 d-md-flex  col-12 m-2 justify-content-center m-auto">

  <div class="m-2  justify-content-center col-md-9">
  <div class="card mt-4 mb-4 justify-content-center shadow ">
           <div class="card-header card-footer d-grid gap-2 d-flex">
                <div class="col-8">
                  <h4 class="titulo fw-bold text-end mr-2 " data-text="Moneda">Moneda</h4>
                </div>
                 <div class="d-grid gap-2 d-flex justify-content-end col-4 text-end">
                   <button class=" btn12 fw-bold col-5 col-md-2 col-lg-2.5" type="button"  data-bs-toggle="modal" data-bs-target="#exampleRegistrarMO"style="box-shadow:none!important;" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrar Moneda" ><i class="bx bxs-edit " style="font-size: 23px!important;"  ></i></button>

                   <a class=" fw-bold col-5 col-md-2 col-lg-2.5 text-center mt-1 " type="button" data-bs-toggle="modal" data-bs-target="#papeleraMO" data-bs-toggle="tooltip" data-bs-placement="top" title="Papelera Moneda"><i class="bi bi-trash icon999 " style="color: #fff; font-size: 30px;" ></i></a>
                </div>
            </div>

            <div class="card-body shadow">

             <div class="table-responsive bordered ">
                <table class="table table-hover" id="tablaMoneda" >
                   <thead class=" table2 text-center">
                    <tr>
                      <th  scope="col">id</th>
                      <th  scope="col">Moneda</th>
                      <th  scope="col"> En B.s</th>
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
           <button class="btn btn11" type="submit" ><a href="?url=metodoPago" style="text-decoration: none; color: #fff;box-shadow:none!important;">MET. DE PAGO</a></button>
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



  <div class="modal fade mx-auto" id="exampleRegistrarMO" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">

      <div class="contenido">
        
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Registrar Moneda">Moneda</h4>
        </div>
        <form class="modal-body" method="POST" id="registrarMoneda">
    
                 <div class="col-12">
                    <label  class="form-label"><i class="bi bi-coin icon"style="color: #c79b2d!important;"></i>Moneda</label>
                   
                  <input type="text" class="form-control" placeholder="Ingrese nueva Moneda" name="moneda" id="moneda">
                   <p id="errorMoneda"   class=" text-center l"></p>
                  
                </div>

                 <div class="col-12">
                    <label  class="form-label"><i class="ri-sound-module-fill icon"style="color: #c79b2d!important;"></i>Al cambio</label>
                   
                  <input type="number" class="form-control" placeholder="Ingrese su valor en Bs: 0,00" name="cambio" id="bs">
                   <p id="errorBs" class=" text-center l"></p>
                </div>

          <div class="modal-footer">
             <button type="reset" class="btn btn11 btn-danger shadow"data-bs-dismiss="modal" id="cerrar">Cancelar</button>
            <button class="btn btnP"style="color: #fff;" id="envio" type="button">Enviar</button>
         </div>

        </form>
            
       </div>       
      </div>   
    </div>
  </div>   

 
<div class="modal fade mx-auto" id="anularMO" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">
      <form class="contenido" method="POST">

        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Anular Moneda">Moneda</h4>
        </div>
      <div class="modal-body anularMO">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn11 btn  shadow"data-bs-dismiss="modal" id="closed">Cancelar</button>
        <button type="submit" class="btn btnP" id="anular">Anular</button>
      </div>
      </form>
      
    </div>
  </div>
</div>

<div class="modal fade mx-auto" id="modificarMO" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content w-500">

      <div class="contenido">
        
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Modificar Moneda">Moneda</h4>
        </div>
        <form class="modal-body" method="POST">
    
                 <div class="col-12">
                    <label  class="form-label"><i class="bi bi-coin icon"style="color: #c79b2d!important;"></i>Moneda</label>
                   
                  <input type="text" class="form-control" placeholder="Ingrese nueva Moneda" id="moneda00">
                   <p id="errorMoneda00"   class=" text-center l"></p>
                </div>

                 <div class="col-12">
                    <label  class="form-label"><i class="ri-sound-module-fill icon"style="color: #c79b2d!important;"></i>Al cambio</label>
                   
                  <input type="number" class="form-control" placeholder="Ingrese su valor en Bs : 0,00"  id="cambio00">
                   <p id="errorBs00"   class=" text-center l"></p>
                </div>

          <div class="modal-footer">
             <button type="reset" id="close" class="btn btn11 btn-danger shadow"data-bs-dismiss="modal">Cancelar</button>
            <button class="btn btnP"style="color: #fff;" id="modificar" type="button">Modificar</button>
         </div>

        </form>
            
       </div>       
      </div>   
    </div>
  </div>   

  
<div class="modal fade mx-auto" id="papeleraMO" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content w-500">
      <form class="contenido" method="POST">
        <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Papelera">area</h4>
        </div>
      <div class="modal-body">
         <div class="table-responsive bordered ">
                  <table class="table table-hover" id="tablaR" >
                   <thead class=" table2 text-center">
                    <tr>
                      <th  scope="col">id</th>
                      <th  scope="col">Moneda</th>
                      <th  scope="col"> En B.s</th>
                      <th  scope="col col-lg-3">Restaurar</th>
                    </tr>
                  </thead>
              
                  <tbody id="restaurarMO">
              

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
 <script type="text/javascript" src="<?php echo URL;?>assets/js/moneda.js"></script>