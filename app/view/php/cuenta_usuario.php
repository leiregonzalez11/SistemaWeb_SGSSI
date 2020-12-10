<?php
function mostrarDatosCuenta(){
  if(!isset($_SESSION['id_usr'])){
    echo "<main><h1>Acceso no autorizado</h1><p>Debes iniciar sesión para visualizar este sitio.</p></main>";
  }else{
  $nick = $_SESSION['id_usr'];
  $DB=new DBControl();
  $usr=$DB->verDatos($nick, $_SESSION['clave']);
  
?>

<main>
  <h1>Editar cuenta de usuario</h1>
  <div id="principal">
    <form id= "formulario_registro" name = "editar_info" action="" method="POST" enctype="multipart/form-data">
      <div id="principales">
        <div id="contenedor_datos">
        <label for="nombre_edit">Nombre:</label>
        <input type="text" name="nombre_edit" id="nombre_edit" value="<?=$usr->getNombre()?>"/>
        <label for="apellidos_edit">Apellidos:</label>
        <input type="text" name="apellidos_edit" id="apellidos_edit" value="<?=$usr->getApellidos()?>"/>
        <label for="dni_edit">DNI:</label>
        <input type="text" name="dni_edit" id="dni_edit" value="<?=$usr->getDNI()?>"/>
        <label for="cuenta_edit">Cuenta Bancaria:</label>
        <input type="text" name="cuenta_edit" id="cuenta_edit" value="<?=$usr->getCuenta()?>"/>
        <label for="telefono_edit">Teléfono:</label>
        <input type="text" name="telefono_edit" id="telefono_edit" value="<?=$usr->getTelefono()?>"/>
        <label for="fechaNac_edit">Fecha de nacimiento:</label>
        <input type="date" name="fechaNac_edit" id="fechaNac_edit" value="<?=$usr->getFechNac()?>"/>
        <label for="mail_edit">Correo electrónico:</label>
        <input type="mail" name="mail_edit" id="mail_edit" value="<?=$usr->getEmail()?>"/>
        <label for="clv_edit">Contraseña:</label>
        <input type="password" name="clave_edit" id="clv_edit" />
        <label for="clv_valedit">Repetir contraseña:</label>
        <input type="password" name="clave_valedit" id="clv_valedit" />
        <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
</div>
      </div>

      <div id="botones">
        <?php
          if($_SESSION['rol_usr']!="Admin"){
        ?>
        <button id="borrar" name="borrar" onclick="return confirm('¿Seguro que quieres eliminar la cuenta? Esta acción es irreversible')">Eliminar cuenta</button>
        <?php
}
        ?>
        
        <input type="button" id="actualizar" name="actualizar" onclick="modificar()" value="Modificar datos">
        <!--<button id="actualizar" name="actualizar" onclick="modificar()">MODIF</button>-->
      </div>
    </form>
  </div>
</main>

<?php
  }
}
?>