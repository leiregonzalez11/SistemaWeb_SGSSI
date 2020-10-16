
<?php
public function mostrarAlojamientoAUsuario($id){


?>
<main>
  <div id="principal">
    <!-- Slideshow container -->
    <div class="slideshow-container">

      <!-- Full-width images with number and caption text -->
      <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="/view/img/promo_1.jpg" style="width:100%">
        <div class="text">Caption Text</div>
      </div>

      <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="/view/img/promo_2.jpg" style="width:100%">
        <div class="text">Caption Two</div>
      </div>

      <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="/view/img/promo_3.jpg" style="width:100%">
        <div class="text">Caption Three</div>
      </div>

      <!-- Next and previous buttons -->
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <div id="detalles_alojamiento">
      <h1>[TIPO_ALOJAMIENTO]</h1>
      <p>Capacidad: [CAPACIDAD]</p>
      <p>Espacio (metros cuadrados): [ESPACIO]</p>
      <p>Descripción:</p>
      <p>[DESCRIPCIÓN_ALOJAMIENTO]</p>
    </div>
  </div>
</main>	

<?php
}
?>