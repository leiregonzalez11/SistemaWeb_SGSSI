# Camping SGSSI
Proyecto desarrollado por: Leire González López, Unai Hernández Gómez y Christian Berrocal Martínez
Las imágenes y vídeos empleados en el proyecto se han extraído de fuentes libres de derechos de autor o en su defecto, limitado por licencia Creative Commons. En concreto, los sitios web en los que se han extraído las imágenes son [Unsplash](https://unsplash.com/) y [Pixabay](https://pixabay.com/es/).
Un porcentaje mínimo del código del proyecto (por ejemplo, carrusel en vista detallada de alojamientos) ha sido extraído de otras fuentes externas, respetando siempre su uso según términos y condiciones de la web de la que se obtiene dicho código y citando la fuente tomada en el código.


Para iniciar el proyecto y trabajar con ello, se requiere tener instalado Docker.
## Pasos a seguir durante la instalación
En la carpeta del proyecto, se puede observar un fichero, denominado Dockerfile. Este fichero se ha empleado para crear la imagen y subirla al repositorio DockerHub.
Para arrancar toda la infraestructura, debe ejecutar el siguiente comando:
```console
docker-compose up
```

## Visualizar el sitio web
Acceda al sitio web entrando en el enlace [127.0.0.1](http://127.0.0.1). Debería aparecer el sitio web en ejecución. De no funcionar (muestra otro sitio web, por ejemplo), es probable que tenga un servidor Apache en ejecución. Es necesario tener dicho servicio inactivo, si no, entrará Docker en conflicto con el servidor Apache que tengamos instalado. El servicio Apache se desactiva mediante el siguiente comando en Linux:
```console
sudo service apache2 stop
```
Si no tiene Apache instalado, pero ha usado Docker con servidores web en otras ocasiones, es probable que necesite desconectar cualquier contenedor en ejecución (primero ejecutando ```docker ps``` para ver el identificador de contenedor -container ID- y luego ejecutando ```docker stop el_id_del_container```) que use el puerto 80 (columna PORTS cuando se listan los contenedores con ```docker ps```, en la parte izquierda de la flecha).

## Preguntas no tan frecuentes
- P: ¿Y la base de datos? ¿No tengo que agregarla manualmente?
- R: Las imágenes Docker de bases de datos contienen un directorio "especial" (```/docker-entrypoint-initdb.d```/), en el cual todo fichero que se ponga ahí, es ejecutado por el SGBD. En este caso se ha creado un volumen que apunta a ese directorio y que tiene como enlace al fichero "database.sql", que contiene el script de creación de tablas.