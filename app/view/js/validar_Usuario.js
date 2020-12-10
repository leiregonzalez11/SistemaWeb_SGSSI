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
    cuentabanc = document.getElementById("cuenta_reg").value;

    if (nombre == ""|| apellidos == "" || dni== "" || email=="" || clave== "" || telefono =="" || fechaNac =="" || nickname==""){
        alert("Todos los campos marcados con * son obligatorios");
        //return false;
    }
    /*else if (cuentabanc != ""){
      if (!checkIBAN()){
        alert("La cuenta bancaria introducida no es correcta");
        //return false;
      }
    }*/
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
    else if (!validarFechaMenorActual(fechaNac)){
        alert("Fecha no válida");
        //return false;
    }
    else if ((isNaN(telefono)) || (!revisarLongitudTelefono())){
        alert("El telefono introducido no es válido");
        //return false;
    }
    else if (clave != clave2){
        alert("Las claves no coinciden");
        //return false;
    }
    else if (clave.length<8 || clave.length>15){
        alert("La clave tiene que tener entre 8 y 15 caracteres");
        //return false;
    }
    else if (!validarContrasena()){
      alert("La clave debe tener al menos una mayúscula, una minúscula, un dígito y un caracter especial (!,@,#,$,%,^,&,*,?,_,~,-)");
        //return false;
    }else if(cuentabanc!="" && !IBAN.isValid(cuentabanc)){
      alert("La cuenta bancaria especificada es incorrecta. Debe seguir el formato IBAN y no contener ningún espacio");
    }

    else{
      window.alert ("Registro Completado Correctamente");
      document.registro_usuarios.submit();
      //return true;
    }
 
}

function validarContrasena(){
	var e = document.getElementById("clave_reg");
	var data = e.value;
	var exp=/^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ](?=.*[!,@,#,$,%,^,&,*,?,_,~,-])/
	if(!exp.test(data)){
	  e.className='fallo';
	  return false;
	}else{
	  e.className='input';
	  return true;
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

  /*function fechaValida(){
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
  }*/

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
  
  /* ALGORITMO 1 CUENTA BANCARIA
  //Obtenido de: https://trellat.es/funcion-validacion-de-iban-en-javascript/
  function fn_ValidateIBAN() {

    var e = document.getElementById("cuenta_reg");
    var IBAN = e.value;
    //Se pasa a Mayusculas
    IBAN = IBAN.toUpperCase();
    //Se quita los blancos de principio y final.
    IBAN = IBAN.trim();
    IBAN = IBAN.replace(/\s/g, ""); //Y se quita los espacios en blanco dentro de la cadena

    var letra1,letra2,num1,num2;
    var isbanaux;
    var numeroSustitucion;
    //La longitud debe ser siempre de 24 caracteres
    if (IBAN.length != 24) {
      e.className='fallo';  
      return false;
    }

    // Se coge las primeras dos letras y se pasan a números
    letra1 = IBAN.substring(0, 1);
    letra2 = IBAN.substring(1, 2);
    num1 = getnumIBAN(letra1);
    num2 = getnumIBAN(letra2);
    //Se sustituye las letras por números.
    isbanaux = String(num1) + String(num2) + IBAN.substring(2);
    // Se mueve los 6 primeros caracteres al final de la cadena.
    isbanaux = isbanaux.substring(6) + isbanaux.substring(0,6);

    //Se calcula el resto, llamando a la función modulo97, definida más abajo
    resto = modulo97(isbanaux);
    if (resto == 1){
      e.className='input';
        return true;
    }else{
        e.className='fallo';
        return false;
    }
}

function modulo97(iban) {
    var parts = Math.ceil(iban.length/7);
    var remainer = "";

    for (var i = 1; i <= parts; i++) {
        remainer = String(parseFloat(remainer+iban.substr((i-1)*7, 7))%97);
    }

    return remainer;
}

function getnumIBAN(letra) {
    ls_letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return ls_letras.search(letra) + 10;
}*/

/* ALGORITMO 2 CUENTA BANCARIA
//Código obtenido de https://www.lawebdelprogramador.com/codigo/JavaScript/4548-Verificar-cuenta-bancaria-con-IBAN-en-JavaScript.html
function checkIBAN(){
  var e = document.getElementById("cuenta_reg");
  var iban = e.value;
	if(iban.length==24){
		var digitoControl=getCodigoControl_IBAN(iban.substr(0,2).toUpperCase(), iban.substr(4));
		if(digitoControl==iban.substr(2,2)){
      e.className='input';
      return true;
    }
  }
  e.className='fallo';
	return false;
}
 
//Funcion que devuelve el codigo de verificacion de una cuenta bancaria
function getCodigoControl_IBAN(codigoPais,cc){
	//Cada letra de pais tiene un valor
	valoresPaises = {
		'A':'10', 'B':'11', 'C':'12', 'D':'13', 'E':'14', 'F':'15','G':'16','H':'17','I':'18','J':'19',
		'K':'20','L':'21','M':'22','N':'23','O':'24','P':'25','Q':'26','R':'27','S':'28','T':'29',
		'U':'30','V':'31','W':'32','X':'33','Y':'34','Z':'35'};
 
	// Reemplazamos cada letra por su valor numerico y ponemos los valores mas dos ceros al final de la cuenta
	var dividendo = cc+valoresPaises[codigoPais.substr(0,1)]+valoresPaises[codigoPais.substr(1,1)]+'00';
 
	//Calculamos el modulo 97 sobre el valor numerico y lo restamos al valor 98
	var digitoControl = 98-modulo(dividendo, 97);
 
	// Si el digito de control es un solo numero, añadimos un cero al delante
	if(digitoControl.length==1){
		digitoControl='0'+digitoControl;
	}
	return digitoControl;
}
 
 //Funcion para calcular el modulo

function modulo(valor, divisor) {
	var resto=0;
	var dividendo=0;
	for (var i=0;i<valor.length;i+=10) {
		dividendo = resto + "" + valor.substr(i, 10);
		resto = dividendo % divisor;
	}
	return resto;
}
 
if(checkIBAN("ES000000000000000000000"))
{
	return true;
}else{
	return false;
}*/

