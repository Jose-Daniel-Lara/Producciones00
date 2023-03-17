<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recuperar Contraseña - Producciones 2.5.1</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>assets/css/estilo.css">
     <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>assets/css/bootstrap.min.css">
</head>
<body>

<div  class="container col-xl-9  justify-content-center m-auto mt-5 mb-5">

	<div class="row g-0  orilla">


     <div class="col bg d-none d-lg-block col-lg-6  col-xl-6 col-xxl-5 portada">

            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                
                <div class="carousel-inner">

                  <div class="carousel-item active" data-bs-interval="10000" >
                    <img src="assets/img/logo3.png" class=" logo d-block w-100 ">
                    <img src="assets/img/carru21.png" class="d-block w-100 " alt="...">
                    <div class="carousel-caption d-none d-md-block mt-4">
                    </div>
                  </div>

                  <div class="carousel-item " data-bs-interval="2000">
                    <img src="assets/img/logo3.png" class=" logo d-block w-100 ">
                    <img src="assets/img/carru22.png" class="d-block w-100 " alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                  </div>
                  <div class="carousel-item ">
                    <img src="assets/img/logo3.png" class=" logo d-block w-100 ">
                    <img src="assets/img/carru23.png" class="d-block w-100 " alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                  </div>
                </div>
        
              </div>

        </div>

      <div class="col bg-white p-4" >
             <div class="text-dark mt-6 mb-5 " > 
                <img src="assets/img/logo.png" width="75" >
             </div>
             <h3  class="till fw-bold text-center py-3 mt-6 mb-5">Recuperar Contraseña</h3>
         
             <form method="POST" class="row g-3 mb-5 php-email-form">


                <div class="col-12">
                    <label for="inputEmail4" class="form-label "><i class="bi bi-envelope-fill icon "></i> Email</label>
                    <input type="email" placeholder="Ingresa tu Correo Electrónico" class="form-control" id="correo" name="correo">
                    <p id="errorCorreo" class="error text-center mt-4 " style="color:  #df0000;"  ></p>
                  </div>
                  <div>
                     <?php echo (isset($respuesta[0]))? ($respuesta[0] == "correoI")?  $respuesta[1] :  " " :  " " ?>
                     <?php echo (isset($respuesta[0]))? ($respuesta[0] == "correoN")?  $respuesta[1] :  " " :  " " ?>
                 </div>
                  <div class="d-grid" >
                   <button type="submit" class="btn btn-primary " id="envio">Enviar</button>

                  </div>
                <hr>

                <div class="mt-2 text-center">
                 <p class="link d-inline-block">Ya recuperaste la contraseña?<a  href="?url=usuario"> Inicia sesión </a></p>
                </div>

                </form>
        </div>


    </div>
</div>
<script type="text/javascript" src="<?php echo URL;?>assets/js/contraseña.js"></script>
</body>
</html>