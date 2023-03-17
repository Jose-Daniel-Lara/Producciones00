<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Regístrate - Producciones 2.5.1</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>assets/css/estilo.css">
     <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>assets/css/bootstrap.min.css">

   
</head>
<body>

<div class="container col-xl-9  justify-content-center m-auto mt-5 mb-5">

  <div class="row  g-0 orilla">
          <div class="col bg d-none d-lg-block col-lg-6  col-xl-6 col-xxl-5 portada">

            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                
                <div class="carousel-inner">

                  <div class="carousel-item active" data-bs-interval="10000" >
                    <img src="assets/img/logo3.png" class=" logo d-block w-100 ">
                    <img src="assets/img/carru41.png" class="d-block w-100 max-vh-100 " alt="...">
                    <div class="carousel-caption d-none d-md-block ">
                
                      <p class="p">Producciones 2. 5. 1. crean grandes experiencias que emocionan y conectan con tu publico</p>
                    </div>
                  </div>

                  <div class="carousel-item " data-bs-interval="2000">
                    <img src="assets/img/logo3.png" class=" logo d-block w-100 ">
                    <img src="assets/img/carru42.png" class="d-block w-100 max-vh-100 " alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <p class="p">Cada Evento es unico e irrepetible.</p>
                    </div>
                  </div>
                  <div class="carousel-item ">
                    <img src="assets/img/logo3.png" class=" logo d-block w-100 ">
                    <img src="assets/img/carru43.png" class="d-block w-100 max-vh-100 " alt="...">
                    <div class="carousel-caption d-none d-md-block">
                 
                      <p class="p">Comunicate ya!! Para que tus eventos sean Inolvidables.</p>
                    </div>
                  </div>
                </div>
              </div>

        </div>

         <div class="col bg-white p-3" >
             <div class="text-dark mt-4" >
                <img src="assets/img/logo.png" width="70" >
             </div>
             <h1  class="till fw-bold text-center mb-3 mt-2">Regístrate</h1>
             <p  class=" text-center mb-2 mt-2"><b class=" paf">Crea una nueva cuenta</b></p>
        
             <form class="row g-2" method="POST" id="RegistrarUsuario">
              <div class="col-md-6">
                    <label for="text" class="form-label"><i class="bi bi-person-fill icon" style="color: #c79b2d!important;"></i>Usuario</label>
                    <input type="text" class="form-control" placeholder="Nombre de Usuario" name="usuario" id="usuario">
                     <p id="errorUsuario"  class=" text-center l"></p>

                </div>

                <div class="col-md-6">
                    <label for="text" class="form-label" ><i class="bi bi-people-fill icon" style="color: #c79b2d!important;"></i>Tipo de Usuario</label>
                    
                    <select  name= "tipoUsuario" class="form-select" id="select">
                      <option value="tipo" class="opcion" >Tipo de Usuario</option>
                      <option value="Administrador"  class="opcion">Administrador</option>
                      <option value="Encargado"  class="opcion">Encargado</option>
                    </select>
                    <p id="errorSelect" class="text-center l"></p>
                </div>

                <div class="col-12">
                    <label for="inputEmail4" class="form-label"><i class="bi bi-envelope-fill icon " style="color: #c79b2d!important;"></i> Email</label>
                    <input type="email" placeholder="Ingresa tu Correo Electrónico" class="form-control" id="correo" name="correo"><br>
                     <p id="errorCorreo" class="text-center l"></p>
                    
                </div>
        
                <div class="col-md-6">
                    <label for="password" class="form-label"><i class="bx bxs-lock icon" style="color: #c79b2d!important;"></i>Contraseña</label>
                    <input type="password" class="form-control" placeholder="Ingrese una Contraseña" name="clave" id="clave"><br>
                     <p id="errorClave"  class="text-center l"></p>
                      
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label"><i class="bx bxs-lock icon" style="color: #c79b2d!important;"></i>Repetir Contraseña </label>
                    <input type="password" class="form-control" placeholder="Ingrese nuevamente la contraseña" name="repetirClave" id="clave2"><br>
                      <p id="errorClave2" class="text-center l"></p>
                </div>
                  <p id="errorContraseñas" class="text-center l"></p>

                 <div>
                   <?php echo (isset($mensaje[0]))? ($mensaje[0] == "correo")?  $mensaje[1] :  " " :  " " ?>
                   <?php echo (isset($mensaje[0]))? ($mensaje[0] == "usuario")?  $mensaje[1] :  " " :  " " ?>
                 </div>
        
                <div class="d-grid" >
                   <button type="submit" class="btn btn-primary " id="envio"><a style="text-decoration: none; color: #fff;">Registrar</a></button>

                </div>
                 <p class="text-center" style="color: #008f20;" ><?php echo (isset($mensaje[0]))? ($mensaje[0] == "good")?  $mensaje[1] :  " " :  " " ?></p>

                <hr>

                <div class="mt-2 text-center">
                 <p class="link d-inline-block">Ya tienes una cuenta?<a  href="?url=usuario"> Inicia sesión </a></p>
                </div>

              </form>

        </div>
        

    </div>
</div>
<script type="text/javascript" src="<?php echo URL;?>assets/js/registroUsuario.js"></script>
</body>


</html>