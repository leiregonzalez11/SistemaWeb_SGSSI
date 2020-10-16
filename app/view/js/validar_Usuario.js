function validar(){

  
    var dni, nickname, nombre, apellidos, email, clave, telefono, fechaNac;
    dni = document.getElementById("dni_reg").value;
    nickname = document.getElementById("nickname_reg").value;
    nombre = document.getElementById("nombre_reg").value;
    apellidos = document.getElementById("apellidos_reg").value;
    email = document.getElementById("mail_reg").value;
    clave = document.getElementById("clave_reg").value;
    clave2 = document.getElementById("clave_val").value;
    telefono = document.getElementById("phone_reg").value;
    fechaNac = document.getElementById("fechaNac_reg").value;

    if (nombre == ""|| apellidos == "" || dni== "" || email=="" || clave== "" || telefono =="" || fechaNac =="" || nickname==""){
        alert("Todos los campos son obligatorios");
        //return false;
    }
    else if (!dniCorrecto()){
        alert("El DNI no es correcto");
        //return false;
    }
    else if (nickname.length>30 || nickname.length<6){
        alert("El nickname tiene que tener entre 6 y 30 caracteres");
        //return false;
    }
    else if (nombre.length>30){
        alert("El nombre es muy largo");
        //return false;
    }
    else if (apellidos.length>120){
        alert("Los apellidos son muy largos");
        //return false;
    }
    else if (!correoCorrecto()){
        alert("El correo electronico introducido no es válido");
        //return false;
    }
    else if (!fechaValida()){
        alert("Fecha no válida");
        //return false;
    }
    else if (!isNaN(telefono) || !revisarLongitudTelefono()){
        alert("El telefono introducido no es válido");
        //return false;
    }
    else if (clave != clave2){
        alert("Las claves no coinciden");
        //return false;
    }
    else if (clave.length<6 || clave.length>15){
        alert("La clave tiene que tener entre 6 y 15 caracteres");
        //return false;
    }
    else{
      window.alert ("Registro Completado Correctamente");
      document.registro_usuarios.submit();
      //return true;
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
    var exp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/
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
  

