
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
            <li id="Alojamiento"><a>Alojamientos</a>
                <ul>
                    <li><a href="index.php?vista=alojamientos&tipo=parcela_tienda">Parcela para Tienda</a></li>
                    <li><a href="index.php?vista=alojamientos&tipo=parcela_caravana">Parcela para Caravana</a></li>
                    <li><a href="index.php?vista=alojamientos&tipo=caravana">Caravanas</a></li>
                    <li><a href="index.php?vista=alojamientos&tipo=bungalow">Bungalows</a></li>
                </ul>
            </li>  
            <li id="Instalaciones"><a href="index.php?vista=instalaciones">Instalaciones</a></li>   
            <li id="Quienes_Somos"><a>La Empresa</a>
                <ul>
                    <li><a href="index.php?vista=quienes_somos">Quienes Somos</a></li>
                    <li><a href="index.php?vista=filosofia">Filosofía</a></li>
                    <li><a href="index.php?vista=donde_estamos">Dónde estamos</a></li>
                </ul>
            </li>
            <li id="Contacto"><a href="index.php?vista=contacto">Contacto</a></li> 
        </ul>
    </nav>
</header>