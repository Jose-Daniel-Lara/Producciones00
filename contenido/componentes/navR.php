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
    <title>Producciones 2.5.1.</title>
    <link href="<?php echo URL;?>assets/css/navegador.css" rel="stylesheet">
     <link href="<?php echo URL;?>assets/css/styleSist.css" rel="stylesheet">
</head>
<body>

  <nav class="navbar shadow-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="assets/img/logo.png" alt="" width="70" height="40" class="  d-inline-block align-text-bottom">
      <b>Producciones 2. 5. 1.</b>  
      </a>
     <div class="d-grid gap-3 d-flex justify-content-md-end text-end">
<li class="nav-item dropdown pe-3 justify-content-center m-auto">
       <div clas="justify-content-en text-end">
        <a class="nav-link nav-profile d-flex align-items-center mt-1" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/<?php echo $_SESSION['imagen']; ?>" width="40" height="40"alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block p-2 nombre"><?php echo $_SESSION['usuario']; ?></span>
      </a>

          <ul class="dropdown-menu dropdown-menu-center dropdown-menu-arrow profile card-header">
            <li class="dropdown-header">
              <div class="justify-content-center text-center m-auto">
                 <img src="assets/img/<?php echo $_SESSION['imagen']; ?>" width="75" height="75"alt="Profile" class="rounded-circle mb-2 ">
                 <h6 class="titulo fw-bold" style="color:  #fff;"><?php echo $_SESSION['usuario']; ?></h6>
              <span><?php echo $_SESSION['tipoUsuario']; ?></span>
              </div>
              
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="nav-item">
              <a class="dropdown-item d-flex align-items-center" href="?url=perfil">
                <i class="bi bi-person"></i>
                <span>Mi Perfil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

             <li class="nav-item">
              <a class="dropdown-item d-flex align-items-center" href="?url=cerrar">
                <i class="bi bi-box-arrow-right"></i>
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
        <a class="nav-link "  href="?url=cerrar"  >
       <i class="ri-git-repository-private-fill icon"></i><span class="text">Cerrar Sesión</span>
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