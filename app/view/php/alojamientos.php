
<?php
    function mostrarListado($pTipo){
        $tipoAlojamiento="";
        $descripcionAlojamiento="";
        $fotoAlojamientos="";

        switch($pTipo){
            case "parcela_tienda":
                $tipoAlojamiento="Parcela para tienda";
                $descripcionAlojamiento="El lugar idóneo para realizar una acampada tanto para mayores como pequeños. Ponemos a tu disposición una parcela en la ue poder colocar tú tienda.";
                $fotoAlojamientos="";
            break;
            case "parcela_caravana":
                $tipoAlojamiento="Parcela para caravana";
                $descripcionAlojamiento="Un lugar donde aparcar la caravana junto a otros amantes de las caravanas. ";
                $fotoAlojamientos="";
            break;
            case "caravana":
                $tipoAlojamiento="Caravana";
                $descripcionAlojamiento="Ponemos a tú disposición una caravana ";
                $fotoAlojamientos="";
            break;
            case "bungalow":
                $tipoAlojamiento="Bungalow";
                $descripcionAlojamiento="A ESPECIFICAR (4)";
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
                    <img src="/view/img/alojamiento_bungalow.jpg"/>
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