
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
            <li id="Inicio"><a href="index.php">Inicio</a></li> 
            <li id="Alojamiento"><a>Alojamientos</a>
                <ul>
                    <li><a href="index.php?vista=alojamientos&tipo=parcela_tienda">Tiendas</a></li>
                    <li><a href="index.php?vista=alojamientos&tipo=parcela_caravana">Parcela para Autocaravana</a></li>
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
            <li id="faqs"><a href="index.php?vista=faqs">FAQS</a></li> 
        </ul>
    </nav>
</header>