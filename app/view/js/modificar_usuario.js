function modificar(){

    var dni, dni2, nombre, nombre2, apellidos, apellidos2, email, email2, clave, clave2, clave2val;
    dni = document.registro_usuarios.dni_reg.value
    dni2 = document.editar_info.dni_edit.value;
    nombre = document.registro_usuarios.nombre_reg.value;
    nombre2 = document.editar_info.nombre_edit.value;
    apellidos = document.registro_usuarios,apellidos_reg.value;
    apellidos2 = document.editar_info.apellidos_edit.value;
    email = document.registro_usuarios.mail_reg.value;
    email2 = document.editar_info.mail_edit.value;
    clave = document.registro_usuarios.clave_reg.value;
    clave2 = document.editar_info.clave_edit.value;
    clave2val = document.editar_info.clave_valedit.value;

    if (dni2 == "" && nombre2 == "" && apellidos2 == "" && email2 == "" && clave =="" && clave2val ==""){
        window.alert ("Sin cambios");
        document.editar_info.submit();
    } 
    else {
        if (dni2 != ""){
            if (dni != dni2){
                dni = dni2;
            }
        }
        else if (nombre2 != ""){
            if (nombre != nombre2){
                nombre = nombre2;
            }
        }
        else if (apellidos2 != ""){
            if (apellidos != apellidos2){
                apellidos = apellidos2;
            }
        }
        else if (email2 != ""){
            if (email != email2){
                email = email2;
            }
        }
        else if (clave2 != ""){
            if (clave != clave2 && clave2 == clave2val){
                clave = clave2;
            }
        }
        window.alert ("Cambios realizados correctamente");
        document.editar_info.submit();
    }     
}