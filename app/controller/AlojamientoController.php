<?php

class AlojamientoController
{



    public function __construct()
    {
    }

    /**
     * En función de ciertas acciones tomadas por el usuario, se determinará la vista
     * a mostrar
     */
    public function determinarVista()
    {
        if (!isset($_GET['id_alojamiento'])) {
            if (isset($_GET['tipo'])) {
                $tipo = $_GET['tipo'];
                if ($tipo == "tienda" || $tipo == "parcela_caravana" || $tipo == "caravana" || $tipo == "bungalow") {
                    include("view/php/alojamientos.php");
                    mostrarListado($tipo);
                } else {
                    echo "<main><h1>Recurso no encontrado</h1><p>Por favor compruebe si ha escrito el enlace correctamente</p></main>";

                }
            } else {
                echo "<main><h1>Recurso no encontrado</h1><p>Por favor compruebe si ha escrito el enlace correctamente</p></main>";
            }
        } else {
            //JUZGAMOS, ADMIN O USUARIO NORMAL (CON SESIÓN INICIADA!)
            if (isset($_SESSION['rol_usr'])) {
                $rol = $_SESSION['rol_usr'];

                switch ($rol) {
                    case "Cliente":
                        include("view/php/alojamiento_usuario.php");
                        mostrarAlojamientoAUsuario($_GET['id_alojamiento']);
                        break;
                    case "Admin":
                        if (isset($_POST['borrar']) || isset($_POST['actualizar']) || isset($_POST['nuevo_alojamiento'])) {
                            if (isset($_POST['borrar']) && $_POST['token']==$_SESSION['token']) {
                                $this->borrarAlojamiento($_GET['id_alojamiento']);
                            } else if (isset($_POST['actualizar']) && $_POST['token']==$_SESSION['token']) {
                                $this->editarAlojamiento($_GET['id_alojamiento']);
                            } else {
                                $this->crearAlojamiento();
                            }
                        }
                        include("view/php/alojamiento_admin.php");
                        mostrarAlojamientoAdmin(test_input($_GET['id_alojamiento']));
                        break;
                }
            } else {
                echo "<main><h1>Acceso no autorizado</h1>";
                echo "<p>Debes iniciar sesión para visualizar este sitio web</p></main>";
            }
        }
    }


    public function crearAlojamiento()
    {
        $tipoAlojamiento=test_input($_POST['tipo']);
        $capacidad=test_input($_POST['capacidad']);
        $metrosCuadrados=test_input($_POST['espacio']);
        $descripcion=test_input($_POST['descripcion']);

        $alojamiento = new Alojamiento(null, $descripcion, $metrosCuadrados, $capacidad, $tipoAlojamiento);
        $DB = new DBControl();
        $resultadoConsulta=$DB->anadirAlojamiento($alojamiento);
        if($resultadoConsulta!=-1){
            $_SESSION['alojamientoCreado']="Se ha creado correctamente el alojamiento: Puedes comprobar sus datos <a href='index.php?vista=alojamientos&id_alojamiento=$resultadoConsulta'>aquí</a>";
            for($i=0;$i<4;$i++){
                
                $fichero=$_FILES['foto_'.($i+1)];

                if($fichero['name']!=""){
                    //Por https://norfipc.com/inf/como-subir-fotos-imagenes-servidor-web.php
                    $ficheroApto=true;
                    $tamanofichero = $_FILES['foto_'.($i+1)]['size'];

                    //Por https://stackoverflow.com/questions/10368217/how-to-get-the-file-extension-in-php
                    
                    $nombreImg = $_FILES['foto_'.($i+1)]['name'];
                    $ext = pathinfo($nombreImg, PATHINFO_EXTENSION);
                    $dir_subida = '/var/www/html/view/img/web_app/';
                    $nombreCompletoFichero=$dir_subida.$resultadoConsulta."_".($i+1).".".$ext;
                    
                    if ($tamanofichero>8000000){
                        $_SESSION['tam_excesivo']="El archivo es mayor que 8MB, debes reducirlo antes de subirlo";
                        $ficheroApto=false;
                    }
                    
                    if (!($ext =="jpeg" || $ext =="png" || $ext =="jpg" || $ext=="gif")){
                        $_SESSION['formato_no_admitido']="Tu archivo tiene que ser JPG o PNG. Otros archivos no son permitidos";
                        $ficheroApto=false;
                    }

                    
                    
                    if ($ficheroApto){
                        //Por https://www.php.net/manual/es/features.file-upload.post-method.php
                        $subida=move_uploaded_file($_FILES['foto_'.($i+1)]['tmp_name'], $nombreCompletoFichero);
                        if($subida){
                            $txtFoto="";
                            if(isset($_POST['foto_desc_'.($i+1)])){
                                $txtFoto=$_POST['foto_desc_'.($i+1)];
                            }
                            $galeria= new Galeria($resultadoConsulta, $i+1, $txtFoto, $ext);
                            $DB->anadirImagen($galeria);
                        }
                    }
                }
            }
        }
        
    }

    public function editarAlojamiento($id){
        $tipoAlojamiento=test_input($_POST['tipo']);
        $capacidad=test_input($_POST['capacidad']);
        $metrosCuadrados=test_input($_POST['espacio']);
        $descripcion=test_input($_POST['descripcion']);

        $alojamiento = new Alojamiento($id, $descripcion, $metrosCuadrados, $capacidad, $tipoAlojamiento);
        //var_dump($alojamiento);
        $DB = new DBControl();
        $resultadoConsulta=$DB->actualizarDatosAlojamiento($alojamiento);
        if($resultadoConsulta==true){
            $_SESSION['alojamientoEditado']="Se han guardado los cambios correctamente";
            for($i=0;$i<4;$i++){
                
                $fichero=$_FILES['foto_'.($i+1)];
                if($fichero['name']!=""){
                    //Por https://norfipc.com/inf/como-subir-fotos-imagenes-servidor-web.php
                    $ficheroApto=true;
                    $tamanofichero = $_FILES['foto_'.($i+1)]['size'];

                    //Por https://stackoverflow.com/questions/10368217/how-to-get-the-file-extension-in-php
                    $nombreImg = $_FILES['foto_'.($i+1)]['name'];
                    $ext = pathinfo($nombreImg, PATHINFO_EXTENSION);
                    $dir_subida = '/var/www/html/view/img/web_app/';
                    $nombreCompletoFichero=$dir_subida.$id."_".($i+1).".".$ext;

                    if ($tamanofichero>8000000){
                        $_SESSION['tam_excesivo']="El archivo es mayor que 8MB, debes reducirlo antes de subirlo";
                        $ficheroApto=false;
                    }
                    $tipofichero = $_FILES['foto_'.($i+1)]['type'];
                    if (!($ext =="jpeg" || $ext =="png" || $ext =="jpg" || $ext=="gif") ){
                        $_SESSION['formato_no_admitido']="Tu archivo tiene que ser JPG, PNG o GIF. Otros archivos no son permitidos";
                        $ficheroApto=false;
                    }
                    
                    //Por https://www.php.net/manual/es/features.file-upload.post-method.php
                    if ($ficheroApto){
                        //Por https://www.php.net/manual/es/features.file-upload.post-method.php
                        $subida=move_uploaded_file($_FILES['foto_'.($i+1)]['tmp_name'], $nombreCompletoFichero);
                        if($subida){
                            $txtFoto="";
                            if(isset($_POST['foto_desc_'.($i+1)])){
                                $txtFoto=test_input($_POST['foto_desc_'.($i+1)]);
                            }
                            $galeria= new Galeria($id, $i+1, $txtFoto, $ext);
                            $DB->anadirImagen($galeria);
                        }else{
                            var_dump($_FILES['foto_'.($i+1)]);
                        }
                    }
                }
            }
        }
        $dir_subida = '/var/www/html/view/img/web_app/';
        for($i=0; $i<4; $i++){
            if(isset($_POST['borrar_'.($i+1)])){
                $img = $DB->VerImagen($id, ($i+1));
                $resultado=$DB->eliminarImagen($id, $i+1);
                if($resultado){
                    $rutaFichero=$dir_subida.$id."_".($i+1).".".$img->getExtension();
                    $ficheroExiste=file_exists($rutaFichero);
                    if($ficheroExiste){
                        unlink($rutaFichero);
                    }
                }
            }
        }
    }


    public function borrarAlojamiento($id)
    {
        $dir_subida = '/var/www/html/view/img/web_app/';
        $DB=new DBControl();
        $imagenesGaleria=$DB->VerImagenes($id);
        for($i=0; $i<sizeof($imagenesGaleria);$i++){
            $resultado=true;
            $resultado=$DB->eliminarImagen($id, $imagenesGaleria[$i]->getNum());
            if($resultado){
                $rutaFichero=$dir_subida.$id."_".$imagenesGaleria[$i]->getNum().".".$imagenesGaleria[$i]->getExtension();
                $ficheroExiste=file_exists($rutaFichero);
                if($ficheroExiste){
                    unlink($rutaFichero);
                }
            }
        }
        $eliminacion=$DB->eliminarAlojamiento($id);
        if($eliminacion){
            echo "<script>window.location.replace('index.php');</script>";
        }
    }
    
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
}
