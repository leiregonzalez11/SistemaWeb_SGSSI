/**
 * Funciones de validación del sitio web
 */

function revisar(e){
    if(e.value==''){
      e.className='fallo';
      return false;
    }else{
      e.className='input';
      return true;
    }
  }
  function escribirSoloNumeros(){
    if ((event.keyCode < 48) || (event.keyCode > 57))
            event.returnValue = false;
  }
  function soloNumeros(){
    var elemento = document.getElementById("telefono");
    if(elemento.value !== ''){
      var data = elemento.value;
      if(isNaN(data)){
        elemento.className = 'fallo';
        return false;
      }else{
        elemento.className = 'input';
        return true;
      }
    }
  }
  function revisarLongitudTelefono(){
    var e = document.getElementById("telefono");
    var data = e.value;
    if(data.length !== 9){
      e.className='fallo';
      return false;
    }else{
      e.className='input';
      return true;
    }
  }
  function correoCorrecto(){
    var e = document.getElementById("email");
    var data = e.value;
    var exp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if(!exp.test(data)){
      e.className='fallo';
      return false;
    }else{
      e.className='input';
      return true;
    }
  }
  
  function dniCorrecto(){
    var e = document.getElementById("DNI");
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
  function validarFormatoFecha(){//validamos que el formato sea d/m/A
    var e = document.getElementById("fechNac");
    var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
    if ((e.match(RegExPattern)) && (e!='')) {
      e.className='input';
      return true;
    }else {
      e.className='fallo';
      return false;
    }
  }
  function fechaValida(){
    //miramos que la fecha sea anterior a hoy
    var e = document.getElementById("fechNac");
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
  
  function validarUsuario(){
    var r,p,n,a,d,t,c,na;
    r = document.getElementById("rol");
    p = document.getElementById("clave");
    //p2 = document.getElementById("contra2");
    n = document.getElementById("nombre");
    a = document.getElementById("apellidos");
    d = document.getElementById("DNI");
    na = document.getElementById("fechNac");
    t = document.getElementById("telefono");
    c = document.getElementById("email");
    if(!revisar(r) || !revisar(p)|| /*!revisar(p2) ||*/ !revisar(n) ||!revisar(c) || !revisar(d) || !revisar(t)){
      alert("Complete todos los campos por favor");
      return false;
    }else if(p.value.length<6){ //longitud de la password>6
      alert("La clave debe tener mas de 6 caracteres");
      return false;
    }/*else if(p2.value !== p.value){//las contraseñas tienen que ser iguales
      alert("Tus password son distintas");
      return false;}*/
    else if(!revisarLongitudTelefono() || !soloNumeros()){
      alert("Introduzca un numero de telefono valido");
      return false;
    }else if(!correoCorrecto()){ //comprobar correo
      alert("Introduzca un correo electronico valido");
      return false;
    }
  }