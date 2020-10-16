<?php
function mostrarAlojamientoAUsuario($id)
{
  echo "ID:".$id."<br>";
  $DB = new DBControl();
  $alojamiento = $DB->VerAlojamiento($id);

?>
  <main>
    
      <?php
      if ($alojamiento == NULL) {
        echo "<h1>Alojamiento no encontrado</h1>";
        echo "<p>El alojamiento no se ha localizado. Compruebe que los datos son correctos</p>";
      } else {

        $tipoAlojamiento = "";
        $imgs = $DB->VerImagenes($id);
        $lnImgs = sizeof($imgs);

        switch ($alojamiento->getTipo()) {
          case "tienda":
            $tipoAlojamiento = "Tienda";
            break;
          case "parcela_caravana":
            $tipoAlojamiento = "Parcela para caravana";
            break;
          case "caravana":
            $tipoAlojamiento = "Caravana";
            break;
          case "bungalow":
            $tipoAlojamiento = "Bungalow";
            break;
        }
      ?>
      <div id="principal">
        <!-- Slideshow container -->
        <div class="slideshow-container">

          <?php
          for ($i = 0; $i < $lnImgs; $i++) {
          ?>
            <div class="mySlides fade">
              <div class="numbertext"><?= ($i + 1) ?> / <?= $lnImgs ?></div>
              <img src="/view/img/web_app/<?= $imgs[$i]->getIdAlojamiento() ?>_<?= $imgs[$i]->getNum() ?>.<?= $imgs[$i]->getExtension() ?>" style="width:100%">
              <div class="text"><?= $imgs[$i]->getFoto() ?></div>
            </div>
          <?php
          }

          ?>
          <!-- Full-width images with number and caption text -->

          <?php

          if ($lnImgs > 0) {
          ?>
            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>


          <?php

          }
          ?>
        </div>
        <div id="detalles_alojamiento">
          <h1><?=$tipoAlojamiento?></h1>
          <p>Capacidad: <?=$alojamiento->getCapacidad()?></p>
          <p>Espacio (metros cuadrados): <?=$alojamiento->getMetrosCuadrados()?></p>
          <p>Descripción:</p>
          <p><?=$alojamiento->getDescripcion()?></p>
        </div>
    </div>

<?php
      }
?>
  </main>

      <?php
    }
?>