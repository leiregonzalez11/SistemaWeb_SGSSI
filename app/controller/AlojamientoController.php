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
                if ($tipo == "parcela_tienda" || $tipo == "parcela_caravana" || $tipo == "caravana" || $tipo == "bungalow") {
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
                            if (isset($_POST['borrar'])) {
                                $this->borrarAlojamiento($_GET['id_alojamiento']);
                            } else if (isset($_POST['actualizar'])) {
                                $this->editarAlojamiento($_GET['id_alojamiento']);
                            } else {
                                $this->crearAlojamiento();
                            }
                        }
                        include("view/php/alojamiento_admin.php");
                        mostrarAlojamientoAdmin($_GET['id_alojamiento']);
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
        $tipoAlojamiento=$_POST['tipo'];
        $capacidad=$_POST['capacidad'];
        $metrosCuadrados=$_POST['espacio'];
        $descripcion=$_POST['descripcion'];

        $alojamiento = new Alojamiento(null, $descripcion, $metrosCuadrados, $capacidad, $tipoAlojamiento);
        $DB = new DBControl();
        $resultadoConsulta=$DB->anadirAlojamiento($alojamiento);
        if($resultadoConsulta!=-1){
            for($i=0;$i<4;$i++){
                $fichero=$_FILES['foto_'.($i+1)];
                if($fichero['name']!=""){
                    //Por https://stackoverflow.com/questions/10368217/how-to-get-the-file-extension-in-php
                    $nombreImg = $_FILES['foto_'.($i+1)]['name'];
                    $ext = pathinfo($nombreImg, PATHINFO_EXTENSION);
                    $dir_subida = '/var/www/html/view/img/web_app/';
                    $nombreCompletoFichero=$dir_subida.$resultadoConsulta."_".($i+1).".".$ext;
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

    public function editarAlojamiento($id)
    {
        $tipoAlojamiento=$_POST['tipo'];
        $capacidad=$_POST['capacidad'];
        $metrosCuadrados=$_POST['espacio'];
        $descripcion=$_POST['descripcion'];

        $alojamiento = new Alojamiento($id, $descripcion, $metrosCuadrados, $capacidad, $tipoAlojamiento);
        //var_dump($alojamiento);
        $DB = new DBControl();
        $resultadoConsulta=$DB->actualizarDatosAlojamiento($alojamiento);
        if($resultadoConsulta==true){
            for($i=0;$i<4;$i++){
                $fichero=$_FILES['foto_'.($i+1)];
                if($fichero['name']!=""){
                    //Por https://stackoverflow.com/questions/10368217/how-to-get-the-file-extension-in-php
                    $nombreImg = $_FILES['foto_'.($i+1)]['name'];
                    $ext = pathinfo($nombreImg, PATHINFO_EXTENSION);
                    $dir_subida = '/var/www/html/view/img/web_app/';
                    $nombreCompletoFichero=$dir_subida.$id."_".($i+1).".".$ext;
                    //Por https://www.php.net/manual/es/features.file-upload.post-method.php
                    $subida=move_uploaded_file($_FILES['foto_'.($i+1)]['tmp_name'], $nombreCompletoFichero);
                    if($subida){
                        $txtFoto="";
                        if(isset($_POST['foto_desc_'.($i+1)])){
                            $txtFoto=$_POST['foto_desc_'.($i+1)];
                        }
                        $galeria= new Galeria($id, $i+1, $txtFoto, $ext);
                        $DB->anadirImagen($galeria);
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
