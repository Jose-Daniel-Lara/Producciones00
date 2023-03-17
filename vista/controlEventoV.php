 <title> Control de Eventos - Producciones 2.5.1.</title>

<?php 
 require_once("contenido/componentes/navegador.php");
 $carrusel->carruselEventos();
?>

<div class="d-md-grid gap-2 d-md-flex  col-12 m-3 justify-content-center m-auto">
  <div class="col-md-7 ">
    <div class=" card container shadow mt-3  mb-3">
  <div class="card-header p-2 text-end">
          <div class="col-12">
                  <h4 class="titulo fw-bold text-end mr-2 " data-text="Control de Eventos">Eventos</h4>
          </div>
  </div>
<form method="POST">
   <div class=" container col-md-6">
      <label  class="form-label mt-4 mb-3"><i class="ri-building-2-line icon"style="color:#c79b2d!important; "></i>Seleccione el Evento</label>
          <select  name= "reporte" class="form-select" id="selectt">
            <option value="Eventos" class="opcion" ></option>
                 <?php
                    if(isset( $consultarEvento)) {
                    foreach ($consultarEvento as $data){
                    
                 ?>
             <option value="<?php echo $data->codigo ?>"  class="opcion"><?php echo $data->nombre ?></option>
            <?php 
               }
               }else{
                " "; 
               }
              ?>
            </select>
                    <p id="errorSelectt"  class="text-center l"></p>
                </div>

  <div class=" card-footer p-2 text-end">
           <button class="btn btn12 btn-light"style="color: #fff;" id="envio" type="submit">Enviar</button>
  </div>
</form>
 

</div>

 <div class="mb-3">
  <div class="row">
   <?php if(isset($control )) { foreach ( $control as $data){ 
    date_default_timezone_set("america/caracas");
     $hoy=date("Y/m/d");
    
     $dias=(strtotime($hoy )-strtotime($data->fecha))/86400;
     $dias=abs($dias); $dias=floor($dias);

     ?>

  <div class="justify-content-center m-auto">
    <div class="card mb-4">
            <div class="row g-0">
              <div class=" d-block col-md-4  imgR">
                <img src="assets/img/<?php echo $data->imagen ?>"  class="img-fluid rounded-start h-100"  alt="...">
              </div>
              <div class="col-md-8">
               <div class="card-header  ">
                 <h4 class="titulo fw-bold text-end mr-1 " data-text="<?php echo $data->nombre ?>" >event</h4>
              </div>
                <div class="card-body">
                 <div class=" d-grid gap-2 d-lg-flex my-2 mt-1" >
                    <p class="card-text col-6"><b  style="color:#040855!important;">Fecha:</b> <?php echo $data->fecha?> </p>
                  
                    <p class="card-text col-6"><b style="color:#040855!important;">Faltan:</b> <?php echo $dias?> día(s) </p>    
                  </div>
                  <div class=" d-grid gap-2 d-lg-flex my-2 mt-1" >
                    <p class="card-text col-6"><b style="color:#040855!important;">Hora:</b> <?php echo $data->hora ?>  </p>
                    <p class="card-text col-6"><b style="color:#040855!important;">Entradas:</b> <?php echo $data->entradas ?> </p>    
                  </div>
                  <div class=" d-grid gap-2 d-lg-flex my-2 mt-1" >
                    <div class="col-md-6">
                       <p class="card-text"><b style="color:#040855!important;">Entradas Vendidas:</b> </p>
                    <div class="progress mt-3">
                        <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                    </div>

                    </div>
                    <div class="col-md-6">
                       <p class="card-text"><b style="color:#040855!important;">Estado: </b><span class="badge bg-secondary"><?php echo $data->status?></span> </p>
                    </div>
                  
                    


                  </div>
                
                </div>

                </div>
              </div>
            </div>

    </div>
 <?php } }else{    " ";   } ?>

</div>
</div>

  </div> 

<div class="col-md-4 shadow mt-3">
  <div class="card-header p-2 text-center">
    <h5 class="titulo fw-bold " style="color: #fff!important;">Eventos</h5>
  </div>
<div class="card-body pb-0 ">

              <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    series: [{
                      name: 'Evento',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: [{
                          value: 4800,
                          name: 'lasso'
                        },
                        {
                          value: 10000,
                          name: 'Queen'
                        },
                        {
                          value: 8000,
                          name: 'the Beatles'
                        },
                        {
                          value: 5000,
                          name: 'the Jonas Brothers'
                        },
                        {
                          value: 6000,
                          name: 'Ed Sheren'
                        }
                      ]
                    }]
                  });
                });
              </script>

            </div>

          </div>
</div><!-- End Website Traffic -->



 <a href="#" class="back-to-top d-flex align-items-center justify-content-center paArriba fw-bold "><i class="bi bi-arrow-up-short"></i></a>        
<?php 
require_once("contenido/componentes/footer.php")
 ?>
<script type="text/javascript" src="<?php echo URL;?>assets/js/reporteMesa.js"></script>
