<?php

function mostrarAlojamientoAdmin($id)
{
  $DB = new DBControl();
  $alojamiento = $DB->VerAlojamiento($id);
?>

  <main>

    <?php
    if ($alojamiento == NULL) {
      echo "<h1>Alojamiento no encontrado</h1>";
      echo "<p>El alojamiento no se ha localizado. Compruebe que los datos son correctos</p>";
    } else {

      $imgs = $DB->VerImagenes($id);
      $lnImgs = sizeof($imgs);
      $tipo = $alojamiento->getTipo();

      $selTienda = "";
      $selCaravanaParcela = "";
      $selCaravana = "";
      $selBungalow = "";

      switch ($alojamiento->getTipo()) {
        case "tienda":
          $selTienda = "selected";
          break;
        case "parcela_caravana":
          $selCaravanaParcela = "selected";
          break;
        case "caravana":
          $selCaravana = "selected";
          break;
        case "bungalow":
          $selBungalow = "selected";
          break;
      }
    ?>
      <h1>Editar alojamiento</h1>
      <div id="principal">
        <form action="" method="POST" enctype="multipart/form-data">
          <div id="principales">
            <p>Datos principales</p>
            <div id="contenedor_datos">
              <label for="tipo">Tipo alojamiento:</label>
              <select name="tipo" id="tipo">

                <option value="tienda" <?= $selTienda ?>>Tienda</option>
                <option value="caravana_parcela" <?= $selCaravanaParcela ?>>Parcela para caravana</option>
                <option value="caravana" <?= $selCaravana ?>>Caravana</option>
                <option value="bungalow" <?= $selBungalow ?>>Bungalow</option>
              </select>
              <label for="capacidad">Aforo máximo:</label>
              <input type="number" name="capacidad" id="capacidad" value="<?= $alojamiento->getCapacidad() ?>" />
              <label for="espacio">Espacio (en metros cuadrados):</label>
              <input type="text" name="espacio" id="espacio" value="<?= $alojamiento->getMetrosCuadrados() ?>" />
              <label for="descripcion">Descripción detallada del alojamiento:</label>
              <textarea name="descripcion" id="descripcion" placeholder="Escriba aquí la descripción..."><?= $alojamiento->getDescripcion() ?></textarea>
            </div>
          </div>
          <div id="galeria">
            <p>Subir fotos de galería (máximo 4)</p>
            <div id="contenedor_fotos">
              <label for="foto_1">Imagen 1:</label>
              <input type="file" name="foto_1" id="foto_1" />
              <label for="foto_2">Imagen 2:</label>
              <input type="file" name="foto_2" id="foto_2" />
              <label for="foto_3">Imagen 3:</label>
              <input type="file" name="foto_3" id="foto_3" />
              <label for="foto_4">Imagen 4:</label>
              <input type="file" name="foto_4" id="foto_4" />
            </div>
          </div>
          <div id="galeria_borrar">
            <p>Eliminar fotos de galería</p>
            <div id="contenedor_fotos_borrar">
              <p>Imagen</p>
              <p>Seleccionado para borrar</p>
              <?php
              for ($i = 0; $i < $lnImgs; $i++) {
              ?>
                <img src="/view/img/web_app/<?= $imgs[$i]->getIdAlojamiento() ?>_<?= $imgs[$i]->getNum() ?>.<?= $imgs[$i]->getExtension() ?>" /><input type="checkbox" name="borrar_<?=($i+1)?>" />
              <?php
              }
              ?>

            </div>
          </div>
          <div id="botones">
            <button id="borrar" name="borrar" onclick="return confirm('¿Seguro que quieres eliminar el alojamiento?');">Eliminar alojamiento</button><button id="actualizar" name="actualizar">Actualizar</button>
          </div>
        </form>
      </div>
  </main>


<?php
    }
  }
?>