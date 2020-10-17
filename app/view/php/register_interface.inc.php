<div id="registroWin" class="overlay oculto">
    <!--Quita el tag style para ver el formulario-->
    <div class="contenedor_datos">

        <div class="contenedor_formulario">
            <div class="accion_cierre">
                <a class="cerrar_formulario" id="cerrar_formulario_registro">&times;</a>
            </div>
            <h1>Registrarse</h1>
            <?php

            if (isset($_SESSION['registro_incorrecto'])) {
                echo "<p id='error_registro'>" . $_SESSION['registro_incorrecto'] . "</p>";
                unset($_SESSION['registro_incorrecto']);
            }
            ?>
            <form id="formulario_registro" name="registro_usuarios" action="index.php" method="POST" class="form-register">
                <!--Nickname-->
                <label for="nickname_reg">Nickname:</label>
                <input type="text" id="nickname_reg" name="nickname_reg" placeholder="Ejemplo: lamari33" pattern=[A-Z\sa-z]{3,20}>
                <!--Nombre-->
                <label for="nombre_reg">Nombre:</label>
                <input type="text" id="nombre_reg" name="nombre_reg" placeholder="Ejemplo: Maripili" pattern=[A-Z\sa-z]{3,20}>
                <!--Apellidos-->
                <label for="apellidos_reg">Apellidos:</label>
                <input type="text" id="apellidos_reg" name="apellidos_reg" placeholder="Ejemplo: Gonzalez Martinez" pattern=[A-Z\sa-z]{3,20}>
                <!--DNI-->
                <label for="dni_reg">DNI:</label>
                <input type="text" id="dni_reg" name="dni_reg" placeholder="Ejemplo: 12345678K" />
                <!--Fecha Nacimiento-->
                <label for="fechaNac_reg">Fecha Nacimiento:</label>
                <input type="date" id="fechaNac_reg" name="fechaNac_reg" placeholder="dd-mm-aaaa" />
                <!--Telefono-->
                <label for="phone_reg">Telefono:</label>
                <input type="text" id="phone_reg" name="phone_reg" placeholder="Ejemplo: 987654321" />
                <!--Email-->
                <label for="mail_reg">Correo electrónico:</label>
                <input type="mail" id="mail_reg" name="mail_reg" placeholder="mail@mail.com" />
                <!--Clave de Registro-->
                <label for="clv_reg">Contraseña:</label>
                <input type="password" id="clave_reg" name="clave_reg" placeholder="Ejemplo: abcdefg" />
                <!--Clave de validación-->
                <label for="clv_val">Repita su contraseña:</label>
                <input type="password" name="clave_val" id="clave_val" />
                <div id="terminos">
                    <label for="termChk">He leído y acepto los <a id="tyc" href="">Términos y condiciones</a></label><input type="checkbox" id="termChk" value="acepta_tyc" />
                </div>
                <input type="button" class="btn" id="btn_reg" name="registrarse" onclick="validar()" value="Registrarse">
            </form>

            <p>¿Ya tienes cuenta? <span href="login_interface.inc.php" id="goToLogin">¡Inicia sesión!</span></p>
        </div>
    </div>
</div>