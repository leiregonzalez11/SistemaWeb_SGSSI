<div id="loginWin" class="overlay oculto" >

    <div class="contenedor_datos">
        
        <div class="contenedor_formulario">
            <div class="accion_cierre">
                <a class="cerrar_formulario" id="cerrar_formulario_login">&times;</a>
            </div>
            <h1>Iniciar sesión</h1>
            <form action="" method="POST">
                <!--Email-->
                <label for="mail">Correo electrónico:</label>
                <input type="mail" name="mail" id="mail" placeholder="mail@mail.com" required/>
                <!--Contraseña-->
                <label for="clv">Contraseña:</label>
                <input type="password" name="clave" id="clv" required/>
                <button class="btn" if="btn_login" name="iniciar_sesion">Iniciar sesión</button>
            </form>
            <p>¿No tienes cuenta? <span href="resgister_interface.inc.php" id="goToSignIn">¡Regístrate!</span></p>
        </div>
    </div>
    
</div>