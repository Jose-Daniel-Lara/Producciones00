<?php 
use contenido\componentes\componentes as varComponentes;
 $_comp = new varComponentes;
 $_comp->head();

  if (strlen(session_id())<1) 
  session_start();
 ?>
 <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   
    <link href="<?php echo URL;?>assets/css/styleSist.css" rel="stylesheet">
     <link href="<?php echo URL;?>assets/css/burbujas.css" rel="stylesheet">
</head>
<body>

  <nav class="navbar shadow-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="assets/img/logo.png" alt="" width="70" height="40" class="  d-inline-block align-text-bottom">
      <b class="Produc">Producciones 2. 5. 1.</b>  
      </a>
     <div class="d-grid gap-3 d-flex justify-content-end text-end">

      <li class="nav-item dropdown pe-3 justify-content-center m-auto">
       <div clas="justify-content-en text-end">
        
        <a class="nav-link nav-profile d-flex align-items-center mt-1" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo $_SESSION['imagen']; ?>" width="40" height="40"alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block p-2 nombre"><?php echo $_SESSION['usuario']; ?></span>
        </a>

          <ul class="dropdown-menu dropdown-menu-center dropdown-menu-arrow profile card-header mt-2">
            <li class="dropdown-header">
              <div class="justify-content-center text-center m-auto">
                 <img src="<?php echo $_SESSION['imagen']; ?>" width="75" height="75"alt="Profile" class="rounded-circle mb-2 ">
                 <h6 class="titulo fw-bold" style="color:  #fff;"><?php echo $_SESSION['usuario']; ?></h6>
              <span style="color: #c79b2d !important;"><?php echo $_SESSION['tipoUsuario']; ?></span>
              </div>
              
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="nav-item">
              <a class="dropdown-item d-flex align-items-center" href="?url=home">
                <i class="bi bi-house-fill  "></i>
                <span>  Inicio</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="nav-item">
              <a class="dropdown-item d-flex align-items-center" href="?url=perfil">
                <i class="bi bi-person "></i>
                <span> Mi Perfil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

             <li class="nav-item">
              <a class="dropdown-item d-flex align-items-center" href="?url=cerrar">
                <i class="bi bi-box-arrow-right" ></i>
                <span> Cerrar Sesión</span>
              </a>
            </li>

          </ul>
        </li>

      </ul>
      <a class="baa justify-content-end text-end"type="button" data-bs-toggle="modal" data-bs-target="#exampleNav" >
        <i class="bi bi-justify icon4"style="color:#fff; font-size: 42px;"></i>
      </a>
    </div>

       </div>
    </div>
     
  </nav>

<div class="modal fade " id="exampleNav" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content shadow-none navt">
      <div class="content1">
        <aside id="sidebar" class="sidebar close">
        <div class="modal-header">
        <header class="d-flex">

      <div class="image-text ">
        <span class="image  ">
          <img src="assets/img/logo.png" alt="logo" width="55" height="45" class="  d-inline-block align-text-bottom">
        </span>
         
      </div>
      <div class="test header-text pt-4 ">
        <h5 class="name">Menú</h5>
        <p class="name2">Producciones 251</p>
        
      </div>
    </header>
      </div>
      <div class="modal-body">

         <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link "href="?url=home">
           <i class="bi bi-house-fill icon "></i> Inicio
        </a>
     </li>



      <li class="nav-item">
        <a class="nav-link " href="?url=cliente">
           <i class="bi bi-person-plus-fill icon"></i> Clientes
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="?url=ventas">
          <i class="ri-shopping-cart-fill icon"></i> Ventas
        </a>
      </li>

      <li class="nav-item" >
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear-fill icon"></i>Configuración de Pago<i class=" bx bx-caret-down icon2"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

          <li>
            <a class="dropdown-item" href="?url=metodoPago" style="color:#fff ;">  <i class="bi bi-cash-coin icon"></i> Método de Pago</a>
          </li>

          <li>
            <a class="dropdown-item" href="?url=moneda" style="color:#fff;">  <i class="bi bi-coin icon"></i> Moneda</a>
          </li>
         
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="?url=eventos">
          <i class="ri-building-2-line icon"></i> Eventos
        </a>
      </li> 
       <li class="nav-item">
        <a class="nav-link " href="?url=mesas">
        <i class="fa-solid fa-mattress-pillow icon" ></i> Mesas
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed " data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
           <i class="ri-settings-6-fill icon"></i><span class="text">Configuración de Eventos</span><i class=" bx bx-caret-down icon2"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
           
            <a class="dropdown-item" href="?url=tipoEvento" style="color:#fff ;"> <i class="ri-building-fill icon"></i><span class="text">Tipo de Evento</span></a>
            </a>
          </li>
          <li>
           <a class="dropdown-item" href="?url=lugares" style="color:#fff;"><i class="ri-pin-distance-fill icon"></i><span class="text">Lugares</span></a>
          </li>
           <li>
            <a class="dropdown-item" href="?url=area" style="color:#fff;"><i class="ri-layout-4-fill icon"></i> <span class="text">Áreas de las Mesas</span></a>
          </li>
          
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bxs-bar-chart-alt-2 icon"></i><span class="text">Control</span><i class=" bx bx-caret-down icon2"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a class="dropdown-item" href="?url=controlEventos" style="color:#fff ;"><i class="ri-building-2-line icon"></i><span class="text">Control de Eventos</span></a>
          </li>
         <li>
          <a class="dropdown-item" href="?url=controlMesas" style="color:#fff;"><i class="fa-solid fa-mattress-pillow icon"></i><span class="text">Control de Mesas</span></a>
        </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link "  href="?url=gestionarUsuarios" >
        <i class="bi bi-people-fill icon "></i><span class="text">Usuarios</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link "  href="?url=cerrar"  >
       <i class="bi bi-box-arrow-right icon"></i><span class="text">Cerrar Sesión</span>
        </a>
      </li>


    </ul>
   
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btnP shadow-none mb-5 mt-3" style="color: #fff!important;" data-bs-dismiss="modal" aria-label="Close" >cerrar</button>
      </div>
      </div>
      
    </div>
  </div>
</div> 

<?php 
require_once('contenido/componentes/alert.php');
 ?>