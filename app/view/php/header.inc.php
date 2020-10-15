
<header>
    <nav>
        <ul id="login_nav">
        <?php
            if(!$sesioniniciada){
        ?>
            <li class="datos_identificacion_reg">
                <a id="registro">REGISTRO</a>
            </li>
            <li class="datos_identificacion_log">
                <a id="login">INICIAR SESIÓN</a>
            </li>
            <?php
            }else{ ?>
                <li class="datos_identificacion_log">
                    <a href="index.php?accion=logout">CERRAR SESIÓN</a>
                </li>
            <?php
        }
        ?>
        </ul>
        <ul id="menu">
            <li id="Alojamiento"><a href="#">Alojamientos</a>
                <ul>
                    <li><a href="">Parcela para Tienda</a></li>
                    <li><a href="">Parcela para Caravana</a></li>
                    <li><a href="">Caravanas</a></li>
                    <li><a href="">Bungalows</a></li>
                </ul>
            </li>  
            <li id="Instalaciones"><a href="/view/php/instalaciones.php">Instalaciones</a></li>   
            <li id="Quienes_Somos"><a href="#">La Empresa</a>
                <ul>
                    <li><a href="/view/php/quienessomos.php">Quienes Somos</a></li>
                    <li><a href="/view/php/filosofia.php">Filosofía</a></li>
                    <li><a href="/view/php/dondeestamos.php">Dónde estamos</a></li>
                </ul>
            </li>
            <li id="Contacto"><a href="/view/php/formulariocontacto.php">Contacto</a></li> 
        </ul>
    </nav>
</header>