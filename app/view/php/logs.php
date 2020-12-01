<?php
if (isset($_SESSION['rol_usr'])) {
    $rol = $_SESSION['rol_usr'];

    switch ($rol) {
        case "Cliente":
            echo "<main><h1>Acceso no autorizado</h1>";
            echo "<p>Necesitas privilegios de administrador para visualizar este sitio web</p></main>";
            break;
        case "Admin":

            $lh=new LoginHistory();
            $lh->getHistorial();
            ?>
            <main>
                <table>
                    <tr>
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                        <th>D</th>
                    </tr>
                    <tr>
                    <td>A'</td>
                    <td>B'</td>
                    <td>C'</td>
                    <td>D'</td>
                    </tr>
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