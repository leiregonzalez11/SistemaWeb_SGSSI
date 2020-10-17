<?php

function mostrarAlojamientoAdmin($id)
{
  $alojamiento = null;

  $DB = new DBControl();
  if ($id != "nuevo") {
    $alojamiento = $DB->VerAlojamiento($id);
  }
?>

  <main>

    <?php

    $imgs = null;
    $lnImgs = 0;
    if ($id != "nuevo") {
      $imgs = $DB->VerImagenes($id);
      $lnImgs = sizeof($imgs);
    }

    $selTienda = "";
    $selCaravanaParcela = "";
    $selCaravana = "";
    $selBungalow = "";
    if ($alojamiento != NULL) {
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
    }
    ?>


    <?php
    if ($alojamiento != NULL) {
    ?>
      <h1>Editar alojamiento</h1>
    <?php
    } else {

    ?>
      <h1>Nuevo alojamiento</h1>
    <?php
    }
    ?>
    <div id="principal">
      <form action="" method="POST" enctype="multipart/form-data">
        <div id="principales">
          <p>Datos principales</p>
          <div id="contenedor_datos">
            <label for="tipo">Tipo alojamiento:</label>
            <select name="tipo" id="tipo">

              <option value="parcela_tienda" <?= $selTienda ?>>Tienda</option>
              <option value="parcela_caravana" <?= $selCaravanaParcela ?>>Parcela para caravana</option>
              <option value="caravana" <?= $selCaravana ?>>Caravana</option>
              <option value="bungalow" <?= $selBungalow ?>>Bungalow</option>
            </select>
            <label for="capacidad">Aforo máximo:</label>
            <input type="number" name="capacidad" id="capacidad" value="<?php if ($alojamiento != NULL) echo $alojamiento->getCapacidad(); ?>" />
            <label for="espacio">Espacio (en metros cuadrados):</label>
            <input type="text" name="espacio" id="espacio" value="<?php if ($alojamiento != NULL) echo $alojamiento->getMetrosCuadrados(); ?>" />
            <label for="descripcion">Descripción detallada del alojamiento:</label>
            <textarea name="descripcion" id="descripcion" placeholder="Escriba aquí la descripción..."><?php if ($alojamiento != NULL) echo $alojamiento->getDescripcion(); ?></textarea>
          </div>
        </div>
        <div id="galeria">
          <p>Subir fotos de galería (máximo 4)</p>
          <div id="contenedor_fotos">
            <?php
            for ($i = 0; $i < 4; $i++) {
              $encontrado = false;
              for ($j = 0; $j < $lnImgs; $j++) {
                $imagenComparada = $imgs[$j];
                if (($i + 1) == $imagenComparada->getNum()) {
                  $encontrado = true;
                }
              }

              if (!$encontrado) {
            ?>
                <label for="foto_<?= ($i + 1) ?>">Imagen ranura <?= ($i + 1) ?> <?php if ($i==0) echo "(portada)";?>:</label>
                <input type="file" name="foto_<?= ($i + 1) ?>" id="foto_<?= ($i + 1) ?>" />
                <input type="text" name="foto_desc_<?=($i+1)?>" placeholder="Descripción fotografía ranura <?=($i+1)?>..." />
            <?php
              }
            }
            ?>

          </div>
        </div>
        <?php
        if ($alojamiento == null) { //INPUT PARA DISCRIMINAR EDICIÓN Y CREACIÓN
        ?>
          <input type="hidden" name="nuevo" value="nuevo" />
        <?php
        }


        if ($alojamiento != null && $lnImgs != 0) {
        ?>
          <div id="galeria_borrar">
            <p>Eliminar fotos de galería</p>
            <div id="contenedor_fotos_borrar">
              <p>Imagen</p>
              <p>Seleccionado para borrar</p>
              <?php
              for ($i = 0; $i < $lnImgs; $i++) {
              ?>
                <img src="/view/img/web_app/<?= $imgs[$i]->getIdAlojamiento() ?>_<?= $imgs[$i]->getNum() ?>.<?= $imgs[$i]->getExtension() ?>" /><input type="checkbox" name="borrar_<?= $imgs[$i]->getNum() ?>" />
              <?php
              }
              ?>

            </div>
          <?php
        }
          ?>
          </div>
          <div id="botones">
            <?php
            if ($alojamiento != null) {
            ?>
              <button id="borrar" name="borrar" onclick="return confirm('¿Seguro que quieres eliminar el alojamiento?');">Eliminar alojamiento</button>
              <button id="actualizar" name="actualizar">Actualizar</button>
            <?php
            } else {
            ?>
              <button id="nuevo" name="nuevo_alojamiento">Crear</button>

            <?php

            }
            ?>
          </div>
      </form>
    </div>
  </main>


<?php

}
?>