<main>
    <div id="tipo_alojamiento">
        <?php /*DEPENDIENDO DEL TIPO DE ALOJAMIENTO, 
        AQUÍ HABRÁ UNA FOTO DISTINTA*/?>
        <div id="container_foto">
            <img src="/view/img/alojamiento_bungalow.jpg">
        </div>
        <div id="container_texto">
            <h1>[TIPO_ALOJAMIENTO AQUÍ]</h1>
            <p>[DESCRIPCIÓN_BREVE_POMPOSA_AQUÍ]</p>
        </div>
    </div>
    <section id="listado_alojamientos">
        <a href="[ENLACE_ALOJAMIENTO]">
            <div class="elem_alojamiento">
                <div class="container_foto_listado">
                    <img src="/view/img/alojamiento_bungalow.jpg"/>
                </div>
                <div class="txt_listado">
                    <p>Tipo: [TIPO]</p>
                    <p>Metros cuadrados: [METROS_CUADRADOS]</p>
                </div>
                <div class="accion_listado">
                    <p>&gt;</p>
                </div>
            </div>
        </a>

        <a href="[ENLACE_ALOJAMIENTO]">
            <div class="elem_alojamiento">
                <div class="container_foto_listado">
                    <img src="/view/img/alojamiento_bungalow.jpg"/>
                </div>
                <div class="txt_listado">
                    <p>Tipo: [TIPO]</p>
                    <p>Metros cuadrados: [METROS_CUADRADOS]</p>
                </div>
                <div class="accion_listado">
                    <p>&gt;</p>
                </div>
            </div>
        </a>
    </section>
    
</main>