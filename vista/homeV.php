 <title> Inicio - Producciones 2.5.1.</title>
<?php 
require_once("contenido/componentes/navegador.php");
 ?>

<div id="background-wrap">
    <div class="bubble x1"></div>
    <div class="bubble x2"></div>
    <div class="bubble x3"></div>
    <div class="bubble x4"></div>
    <div class="bubble x5"></div>
    <div class="bubble x6"></div>
    <div class="bubble x7"></div>
    <div class="bubble x8"></div>
    <div class="bubble x9"></div>
    <div class="bubble x10"></div>
    <div class="bubble x11"></div>
    <div class="bubble x12"></div>
    <div class="bubble x13"></div>
    <div class="bubble x14"></div>
    <div class="bubble x15"></div>
    <div class="bubble x16"></div>
</div>
<br>

<div class="  d-md-grid gap-2 d-md-flex  col-12 justify-content-center m-auto">
 <div class="col-md-9 mt-5 home-md ">
   <div class="alert alert-dismissible  card-header col-md-7 fade show  shadow m-auto " role="alert">
         <h3 class="titulo fw-bold text-center " style="color:  #c79b2d ;">Bienvenido(a)</h3>
        <div class="text-center">
           <h5 class="till2 fw-bold text-center "><?php echo $_SESSION['usuario']; ?></h5>
         </div>
              
        <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   <div class="card-group  mt-5 mb-5">
    <div class="card col-12  col-sm-12 col-md-4 shadow sr m-1">
      <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                
                <div class="carousel-inner">

                  <div class="carousel-item active" data-bs-interval="6000" >
                    <img src="assets/img/img1.png" class="d-block w-100 " alt="...">
                  </div>

                  <div class="carousel-item " data-bs-interval="6000">
                    <img src="assets/img/img2.png" class="d-block w-100 " alt="...">
                  </div>

                  <div class="carousel-item " data-bs-interval="6000">
                    <img src="assets/img/img3.png" class="d-block w-100" alt="...">
                  </div>

                </div>

   </div>
      <div class="card-body">
        <div class="bo1 d-grid col-12 col-md-6  mx-auto " >
           <button class="btn btnP" type="submit" ><a href="?url=ventas" style="text-decoration: none; color: #fff;">VENTAS</a></button>
      </div>
      </div>
    </div>

    <div class="card col-12  col-sm-12 col-md-4 shadow sr m-1">
     <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                
             <div class="carousel-inner">

                  <div class="carousel-item active" data-bs-interval="10000" >
                    <img src="assets/img/11.png" class="d-block w-100 " alt="...">
                  </div>

                  <div class="carousel-item " data-bs-interval="2000">
                    <img src="assets/img/22.png" class="d-block w-100 " alt="...">
                  </div>

                  <div class="carousel-item ">
                    <img src="assets/img/33.png" class="d-block w-100  " alt="...">
                  </div>

             </div>

  </div>
      <div class="card-body">
        <div class="d-grid col-12 col-md-6 mx-auto" >
          <button class="btn btnP" type="submit" ><a href="?url=eventos" style="text-decoration: none; color: #fff;">EVENTOS</a></button>
      </div>
      </div>
    </div>

    <div class="card col-12  col-sm-12 col-md-4 sr shadow m-1">
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                
                <div class="carousel-inner">

                  <div class="carousel-item active" data-bs-interval="10000" >
                    <img src="assets/img/66.png" class="d-block w-100 " alt="...">
                  </div>

                  <div class="carousel-item " data-bs-interval="2000">
                    <img src="assets/img/55.png" class="d-block w-100 " alt="...">
                  </div>

                  <div class="carousel-item ">
                    <img src="assets/img/44.png" class="d-block w-100 " alt="...">
                  </div>

                </div>
              </div>
      <div class="card-body">
        <div class="d-grid col-12 col-md-6  mx-auto" >
           <button class="btn btnP" type="submit" ><a href="?url=cliente" style="text-decoration: none; color: #fff;">CLIENTES</a></button>
      </div>
      </div>
    </div>
  </div>
</div>

<div class=" d-none d-md-block col-md-2 shadow justify-content-end  " style="background: #fff!important;">
  <div class="card-header">
     <div class="text-center p-1 mb-2" >
        <img src="assets/img/11a.png" width="75" height="65" >
      </div>
  </div>
  
  <div class="col-md-7 tex-center justify-content-center m-auto">
     <div class="card-icon d-flex align-items-center justify-content-center card-header col-9 m-auto">
       <i class="ri-shopping-cart-fill icon33 m-2" style="font-size: 50px;"></i>
    </div>
    
      <?php 
      if (isset( $mostrarCantVentas)) { foreach ($mostrarCantVentas as $data) {
        echo "<h3 class='PP fw-bold text-center'>".$data->venta."</h3>";
        } }else{echo "";}

     ?>
     <p class="PP fw-bold text-center MT-2"><b>VENTAS</b></p>

  </div>

  <div class=" col-md-7 tex-center justify-content-center m-auto">
     <div class="card-icon d-flex align-items-center justify-content-center  card-header col-9 m-auto">
       <i class="ri-building-2-line icon33 m-2" style="font-size: 50px;"></i>
    </div>
     <?php 
      if (isset( $mostrarCantEventos)) { foreach ($mostrarCantEventos as $data) {
        echo "<h3 class='PP fw-bold text-center'>".$data->evento."</h3>";
        } }else{echo "";}
     ?>
     <p class=" PP fw-bold text-center MT-2 ">EVENTOS</p>
  </div>

  <div class="col-md-7 tex-center justify-content-center m-auto">
     <div class="card-icon d-flex align-items-center justify-content-center card-header col-9 m-auto">
       <i class="bi bi-people-fill icon33 m-2" style="font-size: 50px;"></i>
    </div>
   
   <?php 
      if (isset( $mostrarCantClientes)) { foreach ($mostrarCantClientes as $data) {
        echo "<h3 class='PP fw-bold text-center'>".$data->clientes."</h3>";
        } }else{echo "";}

     ?>
   <p class=" PP fw-bold text-center MT-2">CLIENTES</p>
  </div>

 <div class="card-header">
 .
 </div>

</div>

</div>

<br>
<br>
<?php 
require_once("contenido/componentes/footer.php")
 ?>