<div id="loginWin" class="overlay oculto">

    <div class="contenedor_datos">

        <div class="contenedor_formulario">
            <div class="accion_cierre">
                <a class="cerrar_formulario" id="cerrar_formulario_login">&times;</a>
            </div>
            <h1>Iniciar sesión</h1>
            <?php
            if (isset($_SESSION['inicio_sesion_incorrecto'])) {
                echo "<p id='error_inicio_sesion'>" . $_SESSION['inicio_sesion_incorrecto'] . "</p>";
                unset($_SESSION['inicio_sesion_incorrecto']);
            }
            ?>
            <form action="" method="POST">
                <!--Email-->
                <label for="nickname">Nickname:</label>
                <input type="text" name="nickname" id="nickname_inicio" placeholder="Ejemplo: lamari33" />
                <!--Contraseña-->
                <label for="clv">Contraseña:</label>
                <input type="password" name="clave" id="clave_inicio" placeholder="Introduzca su contraseña" />
                <button class="btn" if="btn_login" name="iniciar_sesion">Iniciar sesión</button>
            </form>
            <p>¿No tienes cuenta? <span href="resgister_interface.inc.php" id="goToSignIn">¡Regístrate!</span></p>
        </div>
    </div>

</div>