<main>
  <h1>Editar cuenta de usuario</h1>
  <div id="principal">
    <form action="" method="POST" enctype="multipart/form-data">
      <div id="principales">
        <div id="contenedor_datos">
        <label for="nombre_reg">Nombre:</label>
        <input type="text" name="nombre_reg" id="nombre_reg" />
        <label for="apellidos_reg">Apellidos:</label>
        <input type="text" name="apellidos_reg" id="apellidos_reg" />
        <label for="dni_reg">DNI:</label>
        <input type="text" name="dni_reg" id="dni_reg" />
        <label for="mail_reg">Correo electrónico:</label>
        <input type="mail" name="mail_reg" id="mail_reg" />
        <label for="clv_reg">Contraseña:</label>
        <input type="password" name="clave_reg" id="clv_reg" />
        <label for="clv_val">Repetir contraseña:</label>
        <input type="password" name="clave_val" id="clv_val" />
</div>
      </div>

      <div id="botones">
        <button id="borrar" name="borrar">Eliminar cuenta</button><button id="actualizar" name="actualizar">Actualizar datos</button>
      </div>
    </form>
  </div>
</main>