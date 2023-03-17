<?php 
namespace contenido\componentes;

class carrusel{

	public function carruselEventos(){
		echo ('<div class="col bg d-none d-sm-flex col-sm-12 mb-3 ">

  <div id="carouselExampleDark" class="carousel carousel-dark slide " data-bs-ride="carousel">
                 
                <div class="carousel-inner">

                  <div class="carousel-item active" data-bs-interval="10000" >
                    <img src="assets/img/img00.png" class="d-block vw-100" alt="...">
                  </div>

                  <div class="carousel-item " data-bs-interval="15000">
                    <img src="assets/img/img01.png" class="d-block vw-100" alt="...">
                  </div>

                  <div class="carousel-item ">
                    <img src="assets/img/img03.png" class="d-block vw-100" alt="...">
                  </div>

                </div>

   </div>
</div>');

	}

	public function carruselVentas(){
		echo ('<div class="col bg d-none d-sm-flex col-sm-12 ">

  <div id="carouselExampleDark" class="carousel carousel-dark slide " data-bs-ride="carousel">
                 
                <div class="carousel-inner">

                  <div class="carousel-item active" data-bs-interval="10000" >
                    <img src="assets/img/img11.png" class="d-block vw-100" alt="...">
                  </div>

                  <div class="carousel-item " data-bs-interval="15000">
                    <img src="assets/img/img12.png" class="d-block vw-100" alt="...">
                  </div>

                  <div class="carousel-item ">
                    <img src="assets/img/img13.png" class="d-block vw-100" alt="...">
                  </div>

                </div>

   </div>
</div>');
	}



}

 ?>