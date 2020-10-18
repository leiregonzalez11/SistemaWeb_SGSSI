
<?php
    function mostrarListado($pTipo){
        $tipoAlojamiento="";
        $descripcionAlojamiento="";
        $fotoAlojamientos="";

        switch($pTipo){
            case "tienda":
                $tipoAlojamiento="Tienda";
                $descripcionAlojamiento="La mejor opción para los amantes de la naturaleza. Les ofrecemos el poder alojarse en una tienda de campaña para vivir en un contacto constante con la naturaleza pero con todas las comodidades que les podamos ofrecer.";
                $fotoAlojamientos="view/img/fotosalojamiento/tiendas/tienda21.jpg";
            break;
            case "parcela_caravana":
                $tipoAlojamiento="Parcela para caravana";
                $descripcionAlojamiento="Un lugar donde aparcar la caravana junto a otros amantes de las caravanas. ";
                $fotoAlojamientos="view/img/fotosalojamiento/Parcelas_Autocaravana/parcela_para_caravana3.jpg";
            break;
            case "caravana":
                $tipoAlojamiento="Caravana";
                $descripcionAlojamiento="Ponemos a tú disposición una caravana que ofrece una gran comodidad para los huéspedes que se desean queda. Dispone de todas las comodidades necesarias incluidas: baño, cocina y cama.";
                $fotoAlojamientos="view/img/fotosalojamiento/Caravana_EspecialParejas/caravanatipo21.jpeg";
            break;
            case "bungalow":
                $tipoAlojamiento="Bungalow";
                $descripcionAlojamiento="El bungalow es lo más cercano que puedes encontrar a una casa tradicional. El cual dispone de un baño con todas las comodides, dormitorio de pareja o familiar según el número de personas, cocina con tosdos los electrodomésticos necesarios y con un jardín donde pasar el día.";
                $fotoAlojamientos="view/img/fotosalojamiento/Bungalow_Especial_Familias/bungalow2_(2).jpg";
            break;
        }
    
?>
<main>
    <div id="tipo_alojamiento">
        <?php /*DEPENDIENDO DEL TIPO DE ALOJAMIENTO, 
        AQUÍ HABRÁ UNA FOTO DISTINTA*/?>
        <div id="container_foto">
            <img src="<?=$fotoAlojamientos?>">
        </div>
        <div id="container_texto">
            <h1><?=$tipoAlojamiento?></h1>
            <p><?=$descripcionAlojamiento?></p>
        </div>
    </div>
    <section id="listado_alojamientos">
<?php
        $DB = new DBControl();
        $arrayAlojamientos=$DB->VerAlojamientosPorTipo(null, $pTipo);
        
        for($i=0; $i<sizeof($arrayAlojamientos); $i++){
            $fotoPortada=$DB->VerImagen($arrayAlojamientos[$i]->getIdAlojamiento(), 1);
?>  
        <a href="?vista=alojamientos&id_alojamiento=<?=$arrayAlojamientos[$i]->getIdAlojamiento();?>">
            <div class="elem_alojamiento">
                <div class="container_foto_listado">
                <?php
                    $imagen="/view/img/camping.png";
                    if($fotoPortada!=NULL){
                        $imagen="/view/img/web_app/".$arrayAlojamientos[$i]->getIdAlojamiento()."_1.".$fotoPortada->getExtension();
                    }
                ?>
                    <img src="<?=$imagen?>"/>
                </div>
                <div class="txt_listado">
                    <p>Tipo: <?=$tipoAlojamiento?></p>
                    <p>Metros cuadrados: <?=$arrayAlojamientos[$i]->getMetrosCuadrados();?></p>
                </div>
                <div class="accion_listado">
                    <p>&gt;</p>
                </div>
            </div>
        </a>
    <?php
        }
    ?>

    </section>
    
</main>

<?php

    }

    ?>