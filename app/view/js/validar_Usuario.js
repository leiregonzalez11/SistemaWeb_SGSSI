function validar(){
    var dni, nombre, apellidos, email, clave, telefono, fechaNac;
    dni = document.getElementById("dni_reg").value;
    nombre = document.getElementById("nombre_reg").value;
    apellidos = document.getElementById("apellidos_reg").value;
    email = document.getElementById("mail_reg").value;
    clave = document.getElementById("clave_reg").value;
    clave2 = document.getElementById("clave_rev").value;
    telefono = document.getElementById("phone_reg").value;
    fechaNac = document.getElementById("fechaNac_reg").value;

    if (nombre == ""|| apellidos == "" || dni== "" || email=="" || clave== "" || telefono =="" || fechaNac ==""){
        alert("Todos los campos son obligatorios");
        return false;
    }
    else if (!dniCorrecto()){
        alert("El DNI no es correcto");
        return false;
    }
    else if (nombre.length>30){
        alert("El nombre es muy largo");
        return false;
    }
    else if (apellidos.length>120){
        alert("Los apellidos son muy largos");
        return false;
    }
    else if (!correoCorrecto()){
        alert("El correo electronico introducido no es válido");
        return false;
    }
    else if (!fechaValida()){
        alert("Fecha no válida");
        return false;
    }
    else if (!isNaN(telefono) || !revisarLongitudTelefono()){
        alert("El telefono introducido no es válido");
        return false;
    }
    else if (clave != clave2){
        alert("Las claves no coinciden");
        return false;
    }
 
}

function dniCorrecto(){
    var e = document.getElementById("dni_reg");
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
    var email = document.getElementById("mail_reg");
    var data = e.value;
    var exp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if(!exp.test(data)){
      email.className='fallo';
      return false;
    }else{
      e.className='input';
      return true;
    }
  }

  function fechaValida(){
    //Para comprobar que la fecha elegida es anterior a la fecha actual
    var e = document.getElementById("fechaNac_reg");
    var x=new Date();
    var fecha = e.split("/");
    x.setFullYear(fecha[2],fecha[1]-1,fecha[0]);
    var today = new Date();
  
    if (x >= today){
      e.className='fallo';
      return false;
    } else{
      e.className='input';
      return true;
    }
  }

  function revisarLongitudTelefono(){
    var e = document.getElementById("phone_reg");
    var data = e.value;
    if(data.length !== 9){
      e.className='fallo';
      return false;
    }else{
      e.className='input';
      return true;
    }
  }
  