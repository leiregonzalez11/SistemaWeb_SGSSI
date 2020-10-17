/**
 * Funciones interactivas del sitio web
 */
window.onload=function(){
    var winLogin=document.getElementById("loginWin");
    if(winLogin!=null && winLogin!=undefined){
        document.getElementById("cerrar_formulario_login").addEventListener("click", function(){
            winLogin.classList.add("oculto");
        }, true);
    }
    var winSignIn=document.getElementById("registroWin");
    if(winSignIn!=null && winLogin!=undefined){
        document.getElementById("cerrar_formulario_registro").addEventListener("click", function(){
            winSignIn.classList.add("oculto");
        }, true);
    }

    var signInBtn = document.getElementById("registro");
    if(winSignIn!=null && winSignIn!=undefined){
        signInBtn.addEventListener("click",function(){
            winSignIn.classList.remove("oculto");
        }, true);
    }
    var loginBtn = document.getElementById("login");
    if(winLogin!=null && winLogin!=undefined){
        loginBtn.addEventListener("click",function(){
            winLogin.classList.remove("oculto");
        }, true);
    }

    var goToSignIn=document.getElementById("goToSignIn");
    if(goToSignIn!=null && goToSignIn!=undefined){
        goToSignIn.addEventListener("click", function(){
            winSignIn.classList.remove("oculto");
            winLogin.classList.add("oculto");
        },true);
    }

    var goToLogin=document.getElementById("goToLogin");
    if(goToLogin!=null && goToLogin!=undefined){
        goToLogin.addEventListener("click", function(){
            winSignIn.classList.add("oculto");
            winLogin.classList.remove("oculto");
        },true);
    }

    var errorInicioSesion=document.getElementById("error_inicio_sesion");
    if(errorInicioSesion!=null && errorInicioSesion!=undefined){
        winLogin.classList.remove("oculto");
    }

    var errorRegistro=document.getElementById("error_registro");
    if(errorRegistro!=null && errorRegistro!=undefined){
        winSignIn.classList.remove("oculto");
    }
}