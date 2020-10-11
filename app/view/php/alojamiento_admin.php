<main>
  <h1>Editar alojamiento</h1>
  <div id="principal">
    <form action="" method="POST" enctype="multipart/form-data">
      <div id="principales">
        <p>Datos principales</p>
        <div id="contenedor_datos">
          <label for="tipo">Tipo alojamiento:</label>
          <select name="tipo" id="tipo">
            <option value="tienda">Parcela para tienda</option>
            <option value="caravana_parcela">Parcela para caravana</option>
            <option value="caravana">Caravana</option>
            <option value="bungalow">Bungalow</option>
          </select>
          <label for="capacidad">Aforo máximo:</label>
          <input type="number" name="capacidad" id="capacidad" />
          <label for="espacio">Espacio (en metros cuadrados):</label>
          <input type="text" name="espacio" id="espacio" />
          <label for="descripcion">Descripción detallada del alojamiento:</label>
          <textarea name="descripcion" id="descripcion" placeholder="Escriba aquí la descripción..."></textarea>
        </div>
      </div>
      <div id="galeria">
        <p>Subir fotos de galería (máximo 4)</p>
        <div id="contenedor_fotos">
          <label for="foto_1">Imagen 1:</label>
          <input type="file" name="foto_1" id="foto_1"/>
          <label for="foto_2">Imagen 2:</label>
          <input type="file" name="foto_2" id="foto_2"/>
          <label for="foto_3">Imagen 3:</label>
          <input type="file" name="foto_3" id="foto_3"/>
          <label for="foto_4">Imagen 4:</label>
          <input type="file" name="foto_4" id="foto_4"/>
        </div>
      </div>
      <div id="galeria_borrar">
        <p>Eliminar fotos de galería</p>
        <div id="contenedor_fotos_borrar">
          <p>Imagen</p><p>Seleccionado para borrar</p>
          <img src="view/img/promo_1.jpg"/><input type="checkbox" name="borrar_1"/>
        </div>
      </div>
      <div id="botones">
        <button id="borrar" name="borrar">Eliminar alojamiento</button><button id="actualizar" name="actualizar">Actualizar</button>
      </div>
    </form>
  </div>
</main>