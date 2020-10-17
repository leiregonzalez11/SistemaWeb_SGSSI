<?php

function mostrarAlojamientoAdmin($id)
{
  $alojamiento=null;

  $DB = new DBControl();
  if($id!="nuevo"){
    $alojamiento = $DB->VerAlojamiento($id);
  }
?>

  <main>

    <?php

    $imgs=null;
    $lnImgs=0;
    if($id!="nuevo"){
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
              <option value="caravana_parcela" <?= $selCaravanaParcela ?>>Parcela para caravana</option>
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
            <label for="foto_1">Imagen 1:</label>
            <input type="file" name="foto_1" id="foto_1" />
            <input type="text" name="foto_desc_1" placeholder="Descripción fotografía 1..."/>
            <label for="foto_2">Imagen 2:</label>
            <input type="file" name="foto_2" id="foto_2" />
            <input type="text" name="foto_desc_2" placeholder="Descripción fotografía 2..."/>
            <label for="foto_3">Imagen 3:</label>
            <input type="file" name="foto_3" id="foto_3" />
            <input type="text" name="foto_desc_3" placeholder="Descripción fotografía 3..."/>
            <label for="foto_4">Imagen 4:</label>
            <input type="file" name="foto_4" id="foto_4" />
            <input type="text" name="foto_desc_4" placeholder="Descripción fotografía 4..."/>
          </div>
        </div>
        <?php
        if ($alojamiento == null) { //INPUT PARA DISCRIMINAR EDICIÓN Y CREACIÓN
        ?>
          <input type="hidden" name="nuevo" value="nuevo" />
        <?php
        }


        if ($alojamiento != null && $lnImgs!=0) {
        ?>
          <div id="galeria_borrar">
            <p>Eliminar fotos de galería</p>
            <div id="contenedor_fotos_borrar">
              <p>Imagen</p>
              <p>Seleccionado para borrar</p>
              <?php
              for ($i = 0; $i < $lnImgs; $i++) {
              ?>
                <img src="/view/img/web_app/<?= $imgs[$i]->getIdAlojamiento() ?>_<?= $imgs[$i]->getNum() ?>.<?= $imgs[$i]->getExtension() ?>" /><input type="checkbox" name="borrar_<?= ($i + 1) ?>" />
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