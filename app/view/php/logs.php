<?php
if (isset($_SESSION['rol_usr'])) {
    $rol = $_SESSION['rol_usr'];

    switch ($rol) {
        case "Cliente":
            echo "<main><h1>Acceso no autorizado</h1>";
            echo "<p>Necesitas privilegios de administrador para visualizar este sitio web</p></main>";
            break;
        case "Admin":

            $lhist=new LoginHistory();
            $lh=$lhist->getHistorial();
            ?>
            <main>
                <table>
                    <tr>
                        <th>Nombre de usuario</th>
                        <th>Dirección IP</th>
                        <th>Fecha de inicio de sesión</th>
                        <th>¿Inicio de sesión correcto?</th>
                    </tr>
                    <?php
                    for($i=0; $i<sizeof($lh); $i++){
                        ?>
                        <tr>
                        <td><?=$lh[$i]->getUsuario()?></td>
                        <td><?=$lh[$i]->getIpAddr()?></td>
                        <?php
                            $fecha=date("d-m-Y H:i",$lh[$i]->getLoginDate());;
                            
                        ?>
                        <td><?=$fecha?></td>
                        <td><?=$lh[$i]->isSuccessful()=="True" ? "Sí" : "No"?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </main>
            <?php
            break;
    }
} else {
    echo "<main><h1>Acceso no autorizado</h1>";
    echo "<p>Debes iniciar sesión para visualizar este sitio web</p></main>";
}
?>