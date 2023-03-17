
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión - Producciones 2.5.1</title>
     <link rel="icon" href="assets/img/logo.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>assets/css/estilo.css">
     <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>assets/css/bootstrap.min.css">

   
</head>
<body>
<div class="container col-xl-9  justify-content-center m-auto mt-5 mb-5">

  <div class="row g-0  justify-content-center orilla" >

        <div class="col bg d-none d-lg-block col-lg-6  col-xl-6 col-xxl-5 portada">

            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                
                <div class="carousel-inner">

                  <div class="carousel-item active" data-bs-interval="6000" >
                    <img src="assets/img/logo3.png" class=" logo d-block w-100 ">
                    <img src="assets/img/carru14.png" class="d-block w-100 max-vh-100 " alt="...">
                    <div class="carousel-caption d-none d-md-block ">
                
                      <p class="p">Producciones 2. 5. 1. crean grandes experiencias que emocionan y conectan con tu publico</p>
                    </div>
                  </div>

                  <div class="carousel-item " data-bs-interval="6000">
                    <img src="assets/img/logo3.png" class=" logo d-block w-100 ">
                    <img src="assets/img/carru15.png" class="d-block w-100 max-vh-100 " alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <p class="p">Cada Evento es unico e irrepetible.</p>
                    </div>
                  </div>
                  <div class="carousel-item " data-bs-interval="6000">
                    <img src="assets/img/logo3.png" class=" logo d-block w-100 ">
                    <img src="assets/img/carru16.png" class="d-block w-100 max-vh-100 " alt="...">
                    <div class="carousel-caption d-none d-md-block">
                 
                      <p class="p">Comunicate ya!! Para que tus eventos sean Inolvidables.</p>
                    </div>
                  </div>
                </div>
              </div>

        </div>


        <div class="col bg-white p-4 " >
             <div class="text-dark mt-2" >
                <img src="assets/img/logo.png" width="75" >
             </div>
             <h1  class="till fw-bold text-center py-4  mb-1">Bienvenidos</h1>
             <p  class=" text-center py-2"><b class=" paf"> Inicia sesión con tu cuenta</b></p>

             <form method="POST"> 
                <div class="mb-5">
                    <label for="text" class="form-label"> <i class="bi bi-person-fill icon"></i>Usuario</label>
                    <input type="text" class="form-control" placeholder="Ingrese el Usuario" name="usuario" id="usuario">
                     <p id="errorUsuario"  class=" text-center l">

                </div>

                <div class="mb-5">
                    <label for="password" class="form-label"><i class="bx bxs-lock icon"></i>Contraseña</label>
                    <input type="password" class="form-control" placeholder="Ingrese la Contraseña" name="clave" id="clave" required>
                     <p id="errorClave"   class=" text-center l mb-3">
                   <br> <p class="link"> <a href="?url=recupContrasenia">¿Olvidaste la Contraseña?"</a></p>
                </div>
            

                <div class="d-grid">
                    <button type="submit"  class="btn btn-primary" id="envio"><a  style="text-decoration: none; color: #fff;">Iniciar Sesión</a></button>

                </div>

                <div class="my-1 text-center">
                   <p class="d-inline-block mt-2" style="color:#EB1D36 "><?php echo (isset($mensaje))? $mensaje : " " ; ?></p>
                </div>
              
              <hr>
                <div class="my-3 text-center">
                  <p class="link d-inline-block mb-0 ">¿No tienes una cuenta? <a  href='?url=registroUsuario'>Registrate!</a></p>
                </div>
             </form>
            


        </div>
    </div>
  </div>
<script type="text/javascript" src="<?php echo URL;?>assets/js/usuario.js"></script>
</body>

</html>