# Inmobiliaria

## Descripción
Inmobiliaria es una aplicación web diseñada para gestionar propiedades y dueños. Permite a los usuarios agregar, editar, eliminar y listar propiedades, así como gestionar la información de los dueños de estas propiedades. La aplicación está desarrollada utilizando el patrón de diseño MVC (Modelo-Vista-Controlador) para mantener una estructura ordenada y escalable.

### Características
- **Gestión de Dueños**:
  - Listar todos los dueños.
  - Ver detalles de un dueño específico.
  - Agregar un nuevo dueño.
  - Editar la información de un dueño.
  - Eliminar un dueño (con restricciones de integridad referencial).

- **Gestión de Propiedades**:
  - Listar todas las propiedades.
  - Ver detalles de una propiedad específica.
  - Filtrar propiedades por dueño.
  - Agregar una nueva propiedad.
  - Editar la información de una propiedad.
  - Eliminar una propiedad.

- **Autenticación**:
  - Registro de nuevos usuarios.
  - Inicio de sesión y cierre de sesión.
  - Middleware de autenticación para proteger rutas.

## Instalación
Para instalar la aplicación en tu entorno local:

1. Clonar el repositorio:
    ```bash
    git clone https://github.com/fernandocordeschi/tpe-web2-2024.git
    ```

2. Configurar la base de datos:
    - Crear una base de datos en tu servidor MySQL.
    - Importar el archivo `db_inmobiliaria.sql` para crear las tablas necesarias.
    - Configurar las credenciales de la base de datos en el archivo `config.php`.

3. Accede a la aplicación en tu navegador:
    ```
    http://localhost.......
    ```

Datos de ingreso:
Usuario: "webadmin"
Password: "admin"

## Uso
Una vez que la aplicación esté en funcionamiento, con la misma podrás:

- **Gestionar Dueños**: Navegar a la sección de dueños para listar, agregar, editar o eliminar dueños.
- **Gestionar Propiedades**: Navegar a la sección de propiedades para listar, agregar, editar o eliminar propiedades.
- **Autenticarse**: Registrar nuevos usuarios, iniciar sesión y cerrar sesión.


Integrantes:

Barberena Jose, dni 26.664.694, e-mail: jibbarberena@gmail.com

Fernando Cordeschi, dni 29.555.240, e-mail: fernandocordeschi@hotmail.com



1. Obtener todos los propietarios

    Ruta: http://localhost/tpe_parte3/api/owner
    Método: GET
    Descripción: Lista todos los propietarios.
    Parámetros: Ninguno.
    

2. Obtener todos los propietarios ordenados por nombre

    Ruta: http://localhost/tpe_parte3/api/owner?orderBy=nombre
    Método: GET
    Descripción: Lista todos los propietarios ordenados por el campo 'nombre'.
    Parámetros: nombre.


3. Obtener todos los propietarios ordenados por id

    Ruta: http://localhost/tpe_parte3/api/owner?orderBy=id
    Método: GET
    Descripción: Lista todos los propietarios ordenados por el campo 'id' de manera ascedente.
    Parámetros: orderBy=id.


4. Obtener todos los propietarios ordenados por id de manera descendente

    Ruta: http://localhost/tpe_parte3/api/owner?orderBy=idDESC
    Método: GET
    Descripción: Lista todos los propietarios ordenados por el campo 'id' de manera descente.
    Parámetros: orderBy=idDESC.


5. Obtener un propietario por ID

    Ruta: http://localhost/tpe_parte3/api/owner/7
    Método: GET
    Descripción: Obtiene un propietario específico por su ID.
    Parámetros:
        id: 7
    Ejemplo de respuesta:
        {
        "id_duenio": 7,
        "nombre_duenio": "dsfsd",
        "apellido_duenio": "sfs",
        "email_duenio": "sfe@dgs.com"
        }

    Para que devuelva '404'

    Ruta: http://localhost/tpe_parte3/api/owner/1
    Método: GET
    Descripción: Obtiene un propietario específico por su ID.
    Parámetros:
        id: 1
    Ejemplo de respuesta:
    "Error: No se encontró dueño", 404 

6. Crear un propietario

    Ruta: /owner
    Método: POST
    Descripción: Crea un nuevo propietario.
    Cuerpo de la solicitud:

{
    "nombre": "Carlos Martínez",
    "email": "carlos@ejemplo.com"
}

Ejemplo de respuesta:

    {
        "id": 3,
        "nombre": "Carlos Martínez",
        "email": "carlos@ejemplo.com"
    }

7. Actualizar un propietario

    Ruta: /owner/:id
    Método: PUT
    Descripción: Actualiza los datos de un propietario específico.
    Parámetros:
        id: ID del propietario.
    Cuerpo de la solicitud:

{
    "nombre": "Carlos Martínez Actualizado",
    "email": "carlos_nuevo@ejemplo.com"
}

Ejemplo de respuesta:

    {
        "id": 3,
        "nombre": "Carlos Martínez Actualizado",
        "email": "carlos_nuevo@ejemplo.com"
    }

8. Eliminar un propietario

    Ruta: /owner/:id
    Método: DELETE
    Descripción: Elimina un propietario específico por su ID.
    Parámetros:
        id: ID del propietario a eliminar.
    Ejemplo de respuesta:

    {
        "message": "Propietario eliminado con éxito."
    }

9. Obtener token de usuario

    Ruta: /usuarios/token
    Método: GET
    Descripción: Obtiene un token JWT para el usuario autenticado.
    Ejemplo de respuesta:

    {
        "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwiZXhwIjoxNjA4NjA2MzI5fQ.DycdLVZW9FwL9gbt1z9u2kP8Qx0NS-Mm4-3ht1YqVgo"
    }

Códigos de Respuesta

La API devuelve los siguientes códigos de estado HTTP:

    200 OK: La solicitud se procesó correctamente.
    201 Created: El recurso se creó con éxito.
    400 Bad Request: La solicitud es inválida, por ejemplo, falta un parámetro requerido.
    404 Not Found: El recurso solicitado no existe.

Requerimientos No Funcionales

    Autenticación JWT: Los endpoints de creación y actualización (POST, PUT) requieren un token JWT válido.
    Filtrado, ordenado y paginado: Algunos de los servicios permiten filtrar, ordenar y paginar los resultados de las colecciones.