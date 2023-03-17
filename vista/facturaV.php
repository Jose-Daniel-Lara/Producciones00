 <title> Factura - Producciones 2.5.1.</title>

<?php 
  require_once("contenido/componentes/navegador.php");
 
?>

<div class="container col-md-6">
  <form method="POST" class="row  justify-content-center mt-3 mb-3">

  <div class="card shadow  col-12 col-md-7 ">
    <div class="card-footer d-flex">
       <img src="assets/img/logo.png" alt="" width="55" height="40" class="  d-inline-block">
             <p class="paf1 fw-bold mt-3 ">Producciones 2. 5. 1.</p>  
            
    </div>

    <div class="card-body">
      <p class="text-end paf1">Cod-AA00F4567</p>
      <p class="paf1">Cedula: </p>
      <p class="paf1">Nombre del Evento: </p>
      <p class="paf1 ">Cantidad de entradas: </p>
      <p class="paf1 ">Monto Total: </p>
      <p class="paf1 ">Fecha: </p>

    </div>
    <div class="card-footer">
      <p></p>
    </div>
    <div class="card-header">
      
    </div>
      <div class="row justify-content-md-end mt-3">
            
              <div class="col-12 col-md-3 mb-3">
                <button type="button" class="btn btn11 col-12"><a href="?url=ventas" style="text-decoration: none; color: #fff;">Cancelar</a></button>
              </div>
                <div class="col-12 col-md-3 mb-3">
                 <button class="btnP btn col-12 "style="color: #fff;" id="envio" type="button"data-bs-toggle="modal" data-bs-target="#exampleFactura">Enviar</button>
              </div>
           </div>
    
  </div>

</form>
<div class="modal fade mx-auto" id="exampleFactura" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content w-500">
      <div class="contenido">
     <div class="card-header p-2">
               <h4 class="titulo fw-bold text-end mr-2 " data-text="Enviar Factura">Mesas</h4>
        </div>
      <div class="modal-body">
               <div class="col-12">
                    <label for="inputEmail4" class="form-label"><i class="fa-solid fa-envelope"></i>Email</label>
                    <input type="email" placeholder="Correo Electrónico" class="form-control" id="correo" name="correo"><br>
                     <p id="errorCorreo" style="color: #df0000;" class="text-center"></p>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn11 btn pb-1.5 pt-1.5 shadow"data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btnP">Enviar</button>
      </div>
      </div>
      
    </div>
  </div>
</div>
</div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center paArriba fw-bold "><i class="bi bi-arrow-up-short"></i></a>


<?php 
require_once("contenido/componentes/footer.php")
 ?>