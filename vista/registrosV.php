 <title> Registros - Producciones 2.5.1.</title>
<?php 
  require_once("contenido/componentes/navR.php");
  $carrusel->carruselVentas();
?>

<main class="container" id="table" method="POST">
  
  <div class="card mt-4 mb-4 justify-content-center shadow ">
            <div class="card-header card-footer d-grid gap-2 d-flex">
                <div class="col-10">
                  <h4 class="titulo fw-bold text-end mr-2 " data-text="Gestión de Ventas de Entradas">Ventas</h4>
                </div>
                 <div class="d-grid gap-3 d-flex justify-content-md-end col-2 text-end justify-content-md-end">

                   <a href="?url=reporteVentas" class="btn11 col-9 fw-bold col-md-4 col-lg-3 text-center pt-1 justify-content-end " type="button" style="box-shadow:none!important;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Reporte de Ventas"><i class="bi bi-upload " style="font-size: 23px!important;"  ></i></a>

                </div>
            </div>
            <div class="card-body shadow" >

             <div class="table-responsive bordered ">
               <table class="table table-hover" id="dataTable">
                <thead class=" table2 text-center">
                     <tr>
                      <th  scope="col">Fecha</th>
                      <th  scope="col">Hora</th>
                      <th  scope="col">Cliente</th>
                      <th  scope="col">Descripcion</th>
                      <th  scope="col">Metodo</th>
                      <th  scope="col">Monto Total</th>
                      <th  scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody">

                     <tr class="fila">
                      <th class="text-left">12/02/23</th>
                      <th class="text-left">12:34 pm</th>
                      <th class="text-left">V-30483987</th>
                      <th class="text-left">Descuento 2X1</th>
                      <th class="text-left">zelle</th>
                      <th class="text-left">120$</th>
                      
                       <th class="text-center d-grid gap-2 d-flex justify-content-lg-center" >
                        <button class="btn btn90 col-5 col-lg-4" type="button" data-bs-toggle="modal" data-bs-target="#detalles" data-bs-toggle="tooltip" data-bs-placement="top" title="detalles"><i class="ri-article-line "></i></button>

                        <a href="?url=reporteDetallesVenta" class="btn12 col-5  col-lg-4 text-center pt-2 " type="button" style="box-shadow:none!important;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Reporte de los detalles de la venta"><i class="bi bi-upload "  ></i></a>

                    </th>
                    </tr>
                     
              
                  </tbody>
            </table>
              </div>
              <!-- End Table with stripped rows -->

            </div>
            <div class="card-header"></div>
          </div>
        

  </main>
 


     
<a href="#" class="back-to-top d-flex align-items-center justify-content-center paArriba fw-bold "><i class="bi bi-arrow-up-short"></i></a>
  
<?php 
require_once("contenido/componentes/footer.php")
 ?>