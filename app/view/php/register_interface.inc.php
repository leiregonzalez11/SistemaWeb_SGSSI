<div id="registroWin" class="overlay oculto" > <!--Quita el tag style para ver el formulario-->
    <div class="contenedor_datos">
        
        <div class="contenedor_formulario">
            <div class="accion_cierre">
                <a class="cerrar_formulario" id="cerrar_formulario_registro">&times;</a>
            </div>
            <h1>Registrarse</h1>
            <form action="" method="POST">
                <label for="nombre_reg">Nombre:</label>
                <input type="text" name="nombre_reg" id="nombre_reg"/>
                <label for="apellidos_reg">Apellidos:</label>
                <input type="text" name="apellidos_reg" id="apellidos_reg"/>
                <label for="dni_reg">DNI:</label>
                <input type="text" name="dni_reg" id="dni_reg"/>
                <label for="mail_reg">Correo electrónico:</label>
                <input type="mail" name="mail_reg" id="mail_reg"/>
                <label for="clv_reg">Contraseña:</label>
                <input type="password" name="clave_reg" id="clv_reg"/>
                <label for="clv_val">Repetir contraseña:</label>
                <input type="password" name="clave_val" id="clv_val"/>
                <div id="terminos">
                <label for="termChk">He leído y acepto los <a id="tyc" href="">Términos y condiciones</a></label><input type="checkbox" id="termChk" value="acepta_tyc"/>
                </div>
                
                <button class="btn" id="btn_reg" name="registrarse">Registrarse</button>
            </form>
            <p>¿Ya tienes cuenta? <span href="login_interface.inc.php" id="goToLogin">¡Inicia sesión!</span></p>
        </div>
    </div>
</div>