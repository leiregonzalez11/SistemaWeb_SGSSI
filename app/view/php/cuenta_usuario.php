<main>
  <h1>Editar cuenta de usuario</h1>
  <div id="principal">
    <form name = "Formulario_editar" action="" method="POST" enctype="multipart/form-data">
      <div id="principales">
        <div id="contenedor_datos">
        <label for="nombre_edit">Nombre:</label>
        <input type="text" name="nombre_edit" id="nombre_edit" />
        <label for="apellidos_edit">Apellidos:</label>
        <input type="text" name="apellidos_edit" id="apellidos_edit" />
        <label for="dni_edit">DNI:</label>
        <input type="text" name="dni_edit" id="dni_edit" />
        <label for="mail_edit">Correo electrónico:</label>
        <input type="mail" name="mail_edit" id="mail_edit" />
        <label for="clv_edit">Contraseña:</label>
        <input type="password" name="clave_edit" id="clv_edit" />
        <label for="clv_valedit">Repetir contraseña:</label>
        <input type="password" name="clave_valedit" id="clv_valedit" />
</div>
      </div>

      <div id="botones">
        <button id="borrar" name="borrar">Eliminar cuenta</button><button id="actualizar" name="actualizar" onclick="modificar()">Actualizar datos</button>
      </div>
    </form>
  </div>
</main>