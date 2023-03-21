<title> Control de mesas - Producciones 2.5.1.</title>
<?php
require_once("contenido/componentes/navegador.php");
$carrusel->carruselEventos();
?>
<script>
    <?php
    if (isset($grafico)){
    ?>
    const serie = JSON.parse('<?php echo $grafico['data']['series'] ?>');
    <?php
    }else{
    ?>
    const serie = [];
    <?php
    }
    ?>
</script>
<div class="d-md-grid gap-2 d-md-flex  col-12 m-2 justify-content-center m-auto">

    <div class="col-md-7">
        <div class=" card container shadow mt-3  mb-3">
            <div class="card-header p-2 text-end">
                <div class="col-12">
                    <h4 class="titulo fw-bold text-end mr-2 " data-text="Control de Mesas">Eventos</h4>
                </div>
            </div>
            <form method="POST">
                <div class="col-md-7 container">
                    <label  class="form-label mt-4 mb-3"><i class="ri-building-2-line icon"style="color:#c79b2d!important; "></i>Seleccione el Evento de las mesas</label>
                    <select  name= "reporte" class="form-select" id="selectt">
                        <option value="--" class="opcion" ></option>
                        <?php
                        if(isset( $consultarEvento) && $consultarEvento['success']) {
                            foreach ($consultarEvento['data'] as $data){
                                ?>
                                <option value="<?php echo $data->codigo ?>"  class="opcion"><?php echo $data->nombre ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <p id="errorSelectt" class="text-center l"></p>
                </div>

                <div class=" card-footer p-2 text-end">
                    <button class="btn btn12 btn-light"style="color: #fff;" id="envio" type="submit">Enviar</button>
                </div>
            </form>


        </div>

        <?php if(isset($control) && is_array($control) && count($control)>0) {
            $nombreEvento = $control[0]->nombre_evento;
        }else {
            $nombreEvento="";
        }?>
            <div class=" mt-2 mb-3 justify-content-center m-auto ">
                <div class="card mb-3">
                    <div class="card-header col-12 ">
                        <h4 class="titulo fw-bold text-end mr-1 " data-text="<?php echo $nombreEvento ?>"><?php echo $nombreEvento ?></h4>
                    </div>
                    <div class="card-header" style="background: #bd0000!important;"></div>
                    <div class="card-body">

                        <div class="table-responsive shadow">
                            <table class="table table-hover">
                                <thead class=" card-header text-center">
                                <tr>
                                    <th  scope="col" style="color: #fff;">Mesa</th>
                                    <th  scope="col" style="color: #fff;">Area</th>
                                    <th  scope="col"  style="color: #fff;">Posicion</th>
                                    <th  scope="col"  style="color: #fff;">Asientos</th>
                                    <th  scope="col"  style="color: #fff;">Precio</th>
                                    <th  scope="col"  style="color: #fff;">Estado</th>

                                </tr>
                                </thead>
                                <tbody">
                                <?php
                                if(isset($control)){
                                    foreach ( $control as $data){
                                        ?>
                                        <tr class="fila">
                                            <th class="text-left"><?php echo $data->id_mesa ?></th>
                                            <th class="text-left"><?php echo $data->nombArea ?></th>
                                            <th class="text-left">F<?php echo $data->posiFila ?> - C<?php echo $data->posiColumna ?></th>
                                            <th class="text-left"><?php echo $data->cantPuesto ?></th>
                                            <th class="text-left"><?php echo $data->precio ?>$ </th>
                                            <th class="text-left"> <span class="badge bg-secondary"><?php echo $data->status?></span> </th>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-header"></div>
                </div>
            </div>

    </div>
    <div class="col-md-4 shadow mt-3 ">
        <div class="card-header p-2 text-center">
            <h5 class="titulo fw-bold " style="color: #fff!important;">Mesas por Evento</h5>
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
                            name: 'Mesas',
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
                            data: serie
                        }]
                    });
                });
            </script>

        </div>

    </div>

</div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center paArriba fw-bold "><i class="bi bi-arrow-up-short"></i></a>
<?php
require_once("contenido/componentes/footer.php")
?>

<script type="text/javascript" src="<?php echo URL;?>assets/js/control.js"></script>
