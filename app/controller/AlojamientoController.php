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
    }

    public function editarAlojamiento($id)
    {
    }


    public function borrarAlojamiento($id)
    {
    }
}
