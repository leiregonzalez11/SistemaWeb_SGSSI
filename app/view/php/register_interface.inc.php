<div id="registro" class="overlay" > <!--Quita el tag style para ver el formulario-->
    <div class="contenedor_datos">
        
        <div class="contenedor_formulario">
            <div class="accion_cierre">
                <a class="cerrar_formulario" id="cerrar_formulario_login">&times;</a>
            </div>
            <h1>Registrarse</h1>
            <form action="" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre"/>
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos"/>
                <label for="dni">DNI:</label>
                <input type="text" name="dni" id="dni"/>
                <label for="mail">Correo electrónico:</label>
                <input type="mail" name="mail" id="mail"/>
                <label for="clv">Contraseña:</label>
                <input type="password" name="clave" id="clave"/>
                <label for="clv_val">Repetir contraseña:</label>
                <input type="password" name="clave_val"/>
                He leído y acepto los <a id="tyc" href="">Términos y condiciones</a><input type="checkbox" value="acepta_tyc"/>
                <button id="btn">Registrarse</button>
            </form>
            <p>¿Ya tienes cuenta? <span href="login_interface.inc.php" id="goToLogin">¡Inicia sesión!</span></p>
        </div>
    </div>