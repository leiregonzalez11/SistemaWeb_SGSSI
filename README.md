# Camping SGSSI
Para iniciar el proyecto y trabajar con ello, se requiere tener instalado Docker.
## Pasos a seguir durante la instalación
1. Situarse en la carpeta raíz del proyecto (SGSSI_ProyectoWeb)
1. Ejecutar:
 ```console
docker build -t="web" .
```
3. Una vez se haya creado la imagen "web", arrancamos los containers:
```console
docker-compose up
```

## Visualizar el sitio web
Se accede al sitio web desde [127.0.0.1](http://127.0.0.1), con el puerto 80 por defecto. Es necesario tener el servicio Apache inactivo en Linux, si no, entrará Docker en conflicto con el servidor Apache que tengamos instalado. El servicio Apache se desactiva mediante el siguiente comando:
```console
sudo service apache2 stop
```

## Pruebas con bases de datos
Las pruebas con bases de datos, que requerirán de operaciones con MySQL, se pueden realizar fácilmente mediante la herramienta PHPMyAdmin. Para ello, se accede a través de [127.0.0.1:8890](http://127.0.0.1:8890). Las credenciales (temporales) son el usuario "admin", la contraseña "test" y la base de datos "database" (estos datos todos sin comillas).

## Git y MySQL
El volumen de MySQL genera una carpeta (del mismo nombre) en el directorio raíz del proyecto, dicha carpeta contiene las bases de datos. Se ha programado a través de git evitar subir esta carpeta.