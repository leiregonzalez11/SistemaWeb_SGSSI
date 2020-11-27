# Camping SGSSI
Proyecto desarrollado por: Leire González López, Unai Hernández Gómez y Christian Berrocal Martínez
Las imágenes y vídeos empleados en el proyecto se han extraído de fuentes libres de derechos de autor o en su defecto, limitado por licencia Creative Commons. En concreto, los sitios web en los que se han extraído las imágenes son [Unsplash](https://unsplash.com/) y [Pixabay](https://pixabay.com/es/).
Un porcentaje mínimo del código del proyecto (por ejemplo, carrusel en vista detallada de alojamientos) ha sido extraído de otras fuentes externas, respetando siempre su uso según términos y condiciones de la web de la que se obtiene dicho código y citando la fuente tomada en el código.

# VERSIÓN DE AUDITORÍA
Es necesario realizar los siguientes pasos desde cero para poder realizar las modificaciones pertinentes en el código y comprobar éstas posteriormente de manera eficaz:
 - Eliminar cualquier contenedor docker que se tenga.
 - Crear imagen mediante Dockerfile.
 
 Para:
  - Eliminar contenedores:
    - Listarlos mediante ``` docker images ``` y borrar cada uno mediante ```docker rmi IMAGE_ID```, donde ```IMAGE_ID``` es el valor de la columna ```IMAGE ID``` (usar el argumento --force si da error de borrado).
  - Crear imagen mediante Dockerfile mediante ```docker build -t="web" .```
## Recargando la base de datos tras modificaciones
En el caso de haberse creado un nuevo campo en la base de datos, para que éste aparezca, es necesario eliminar el fichero de base de datos, para que, de ese modo, se ejecute el fichero ```database.sql``` que contiene el script de creación de base de datos.
Para eliminar dicho fichero, es necesario ejecutar el comando ```sudo rm -r mysql```.

#

## Requisitos previos
Para iniciar el proyecto y trabajar con ello, se requiere tener instalado Docker.
## Pasos a seguir durante la instalación
En la carpeta del proyecto, se puede observar un fichero, denominado Dockerfile. Este fichero se ha empleado para crear la imagen y subirla al repositorio DockerHub.
Para arrancar toda la infraestructura, debe ejecutar el siguiente comando:
```console
docker-compose up
```

## Permisos necesarios
Se creará una carpeta en el directorio de trabajo (donde se encuentre el fichero docker-compose), llamada imgs_web. Esta carpeta debe pertenecer al usuario www-data para que el servidor pueda subir imágenes y éstas persistan. Se requiere ejecutar el siguiente comando:
```console
sudo chown www-data imgs_web
```

## Visualizar el sitio web
Acceda al sitio web entrando en el enlace [127.0.0.1](http://127.0.0.1). Debería aparecer el sitio web en ejecución. De no funcionar (muestra otro sitio web, por ejemplo), es probable que tenga un servidor Apache en ejecución. Es necesario tener dicho servicio inactivo, si no, entrará Docker en conflicto con el servidor Apache que tengamos instalado. El servicio Apache se desactiva mediante el siguiente comando en Linux:
```console
sudo service apache2 stop
```
Si no tiene Apache instalado, pero ha usado Docker con servidores web en otras ocasiones, es probable que necesite desconectar cualquier contenedor en ejecución (primero ejecutando ```docker ps``` para ver el identificador de contenedor -container ID- y luego ejecutando ```docker stop el_id_del_container```) que use el puerto 80 (columna PORTS cuando se listan los contenedores con ```docker ps```, en la parte izquierda de la flecha).

## Panel de gestión
Se entrega el sitio web vacío, sin alojamientos, pero con una cuenta de administrador. Para realizar gestiones (agregar alojamientos, modificarlos o borrarlos), inicia sesión con el Nick "Admin" y la contraseña "123abc" (la puedes cambiar en la sección "Editar Usuario").

## Preguntas no tan frecuentes
- P: ¿Y la base de datos? ¿No tengo que agregarla manualmente?
- R: Las imágenes Docker de bases de datos contienen un directorio "especial" (```/docker-entrypoint-initdb.d```/), en el cual todo fichero que se ponga ahí, es ejecutado por el SGBD. En este caso se ha creado un volumen que apunta a ese directorio y que tiene como enlace al fichero "database.sql", que contiene el script de creación de tablas.