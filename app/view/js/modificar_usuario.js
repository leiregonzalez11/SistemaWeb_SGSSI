function modificar(){

    var dni2, nombre2, apellidos2, email2, clave2, clave2val, telefono2, fechaNac2;
    dni2 = document.editar_info.dni_edit.value;
    nombre2 = document.editar_info.nombre_edit.value;
    apellidos2 = document.editar_info.apellidos_edit.value;
    email2 = document.editar_info.mail_edit.value;
    clave2 = document.editar_info.clave_edit.value;
    clave2val = document.editar_info.clave_valedit.value;
    telefono2 = document.editar_info.telefono_edit.value;
    fechaNac2 = document.editar_info.fechaNac_edit.value;

    if (dni2 == "" && nombre2 == "" && apellidos2 == "" && email2 == "" && clave2 =="" && clave2val ==""){
        window.alert ("Sin cambios");
    } 
    else {
        if (clave2 != clave2val){
            alert ("Las contraseñas no coinciden");
        }
        else if (clave2.length<6 || clave2.length>15){
            alert("La clave tiene que tener entre 6 y 15 caracteres");
            //return false;
        }
        else if ((isNaN(telefono)) || (!revisarLongitudTelefono())){
            alert("El telefono introducido no es válido");
            //return false;
        }
        else if (!dniCorrecto()){
            alert("El DNI no es correcto");
            //return false;
        }
        else if (nombre2.length>30){
            alert("El nombre es muy largo");
            //return false;
        }
        else if (apellidos2.length>120){
            alert("Los apellidos son muy largos");
            //return false;
        }
        else if (!correoCorrecto()){
            alert("El correo electronico introducido no es válido");
            //return false;
        }
         else if (!validarFechaMenorActual(fechaNac2)){
            alert("Fecha no válida");
            //return false;
        }
        else{
            window.alert ("Cambios realizados correctamente");
            document.editar_info.submit();
        }
        
    }     
}

function dniCorrecto(){
    var e = document.editar_info.dni_edit;
    var dni = e.value.toUpperCase();
  
    var letraDNI = dni.substring(8, dni.length);
    var numDNI = parseInt(dni.substring(0, 8));
    var letras ='TRWAGMYFPDXBNJZSQVHLCKET';
    var numero = numDNI%23;
    var letraCorrecta = letras.substring(numero,numero+1);
  
    if(letraDNI==letraCorrecta){
      e.className='input';
      return true;
    }else{
      e.className='fallo';
      return false;
    }
  }

  function correoCorrecto(){
    var email = document.editar_info.mail_edit;
    var data = email.value;
    var exp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if(!exp.test(data)){
      email.className='fallo';
      return false;
    }else{
      email.className='input';
      return true;
    }
  }

  //Algoritmo obtenido en https://blog.reaccionestudio.com/funciones-para-validar-fechas-con-javascript/
  function validarFechaMenorActual(date){
    var x=new Date();
    var fecha = date.split("/");
    x.setFullYear(fecha[2],fecha[1]-1,fecha[0]);
    var today = new Date();

    if (x >= today)
      return false;
    else
      return true;
  }

  function revisarLongitudTelefono(){
    var e = document.editar_info.telefono_edit;
    var data = e.value;
    if(data.length !== 9){
      e.className='fallo';
      return false;
    }else{
      e.className='input';
      return true;
    }
  }