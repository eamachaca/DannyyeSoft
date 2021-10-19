<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Pruebas

```
Crea un proyecto de Laravel nuevo en versión 7

Genera las migraciones y modelos que se indican a detalle más abajo

Instala e implementa la autenticación con Passport

Implementa un Api CRUD para cada una de las tablas mencionadas con todos sus mensajes de error, manejo de excepciones y protegidas con Auth

Crea un método para obtener el detalle de los corporativos, agregando los datos de las tablas relacionadas

Implementa los CORS

Al finalizar crea un proyecto en GitHub y envíanos el enlace para revisar tus resultados

Todas las respuestas deben ir en formato JSON y contener el código de respuesta (422, 404, 200, 201, etc.)

```

## Crear las migraciones y modelos para el siguiente esquema, se deben respetar los tipos de datos, tamaño y definir si es nulo o no.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://spark.adobe.com/page/k6qhcWt1Jgfrw/images/68335d2f-880c-4786-8a20-6e30d6463990.png" alt="Diagrama de DannyyeSoft"></a></p>

## Notas

```
En las tablas con el campo "deleted_at" se implementa borrado lógico (SOFT DELETE), 
en las que no lo tienen el borrado debe ser físico

En los métodos Update el ID debe ir como parámetro en la URL
```

## Implementar en los modelos las relaciones entre las tablas.

He creado las Migraciones basándome en el diagrama de clases que se solicitó arriba.

## Crear un Factory para llenar la tabla tw_corporativos.

El creado la Factory llamada `CorporativoFactory.php`

### Crear un seed para insertar 10 registros a la tabla tw_corporativos ejecutando el Factory creado anteriormente.

He creado el Seeder llamado `CorporativoSeeder.php` para ejecutar solo este

## Ejecutar las migraciones.

Es solo ejecutar `php artisan migrate`

## Crear un Factory para la tabla users con 10 usuarios y contraseña por defecto "12345"

He creado la Factory llamada `UsuarioFactory.php`

## Implementar Login && Implementar Reset Password vía email con un token de seguridad

Para ambos casos he solo he agregado el componente de Laravel UI y configurar el correo

## Crear api crud (insertar, editar, ver, ver todos y borrar) para cada una de las tablas y manejo de excepciones con mensajes de error, las respuestas deben ser en formato JSON.

```
Dentro de los métodos debes validar los datos que recibes y en caso de no pasar la 
validación enviar la respuesta de error indicando los campos que fallaron.
```

Revisar todos los Controladores terminados con `ApiControllers`

Puedes revisar hasta el commit `9715527764058759c56c5233d1fe144487584cbe` para obtener todos los CRUD's creados.

## Crear un método que nos permita obtener todo lo relacionado a un corporativo: le debemos pasar el id del corporativo y el método debe devolver:

```
Empresas asociadas al corporativo
Documentos con el nombre del documento y la url de donde está almacenado
Contactos de ese corporativo
```
Puedes revisar el commit `032023a28e3ca7b9b12803d0a8c01688ef02bb93` para obtener los movimientos que hice para revisar
esta solución.

En todo caso tendrá los ejemplos en la solicitud `Corporate with Relationships` dentro de la carpeta `Corporate`

## Crear un método en el cual le podeos pasar el id de un documento(tw_documentos) y nos muestre todos los documentos que se han cargado en tw_documentos_corporativos correspondientes a ese id y el corporativo al que pertenecen.


## Implementar CORS, permitiendo el header db y todos los orígenes

