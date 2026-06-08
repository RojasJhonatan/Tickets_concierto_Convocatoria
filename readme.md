# Manual Técnico

## 1. Instalación del Sistema

### Requisitos

Para ejecutar el sistema se requiere:

- XAMPP instalado.
- PHP 8 o superior.
- MySQL.
- Navegador web moderno.
- Sistema operativo Windows, Linux o macOS.

### Instalación

1. Descargar e instalar XAMPP.
2. Iniciar los servicios de Apache y MySQL desde el Panel de Control de XAMPP.
3. Copiar la carpeta del proyecto:

```text
TICKETS_CONCIERTO_CONVOCATORIA
```

dentro de:

```text
C:\xampp\htdocs\
```

La ruta final debe quedar:

```text
C:\xampp\htdocs\TICKETS_CONCIERTO_CONVOCATORIA
```

4. Abrir phpMyAdmin:

```text
http://localhost/phpmyadmin
```

5. Crear una base de datos llamada:

```sql
MVC_Tickets_eventos
```

6. Importar el archivo:

```text
db/base.sql
```

para generar automáticamente todas las tablas del sistema.

---

## 2. Configuración del Entorno

### Configuración de la Base de Datos

La conexión se encuentra en:

```text
modelo/conexion.php
```

Configuración utilizada:

```php
$host = "localhost";
$port = 3307;
$user = "root";
$pass = "";
$db = "MVC_Tickets_eventos";
```

### Descripción de los Parámetros

| Parámetro | Descripción |
|-----------|------------|
| host | Servidor de base de datos |
| port | Puerto utilizado por MySQL |
| user | Usuario de acceso |
| pass | Contraseña del usuario |
| db | Nombre de la base de datos |

### Configuración del Puerto

El proyecto utiliza el puerto:

```php
$port = 3307;
```

Este valor puede variar según la configuración local de cada integrante.

Por ejemplo:

| Integrante | Puerto |
|------------|---------|
| Javier | 3307 |
| Tatan | 3330 |
| Dylan | Configurar según su instalación |

Si MySQL utiliza un puerto diferente, únicamente debe modificarse el valor de la variable:

```php
$port = 3307;
```

por el puerto correspondiente.

### Verificación del Puerto de MySQL

Desde XAMPP:

1. Abrir XAMPP Control Panel.
2. Seleccionar MySQL.
3. Clic en Config.
4. Abrir:

```text
my.ini
```

5. Buscar:

```ini
port=3307
```

El valor encontrado debe coincidir con el configurado en:

```text
modelo/conexion.php
```

---

## 3. Dependencias

El proyecto utiliza:

### Servidor Web

- Apache (incluido en XAMPP).

### Lenguaje de Programación

- PHP.

### Gestor de Base de Datos

- MySQL.

### Librerías

No se utilizan librerías externas ni gestores de dependencias como Composer.

---

## 4. Ejecución del Proyecto

### Paso 1

Iniciar los servicios:

- Apache
- MySQL

desde XAMPP.

### Paso 2

Abrir el navegador web.

### Paso 3

Ingresar la URL:

```text
http://localhost/TICKETS_CONCIERTO_CONVOCATORIA/vista/index.php
```

Si Apache utiliza otro puerto, por ejemplo 8080:

```text
http://localhost:8080/TICKETS_CONCIERTO_CONVOCATORIA/vista/index.php
```

### Paso 4

Verificar que el sistema permita:

- Registrar usuarios.
- Crear eventos.
- Crear tickets.
- Actualizar información.
- Eliminar registros.
- Consultar listados de usuarios, eventos y tickets.

---

## 5. Estructura del Proyecto

```text
TICKETS_CONCIERTO_CONVOCATORIA
│
├── controlador
│   ├── actualizarEvento.php
│   ├── actualizarTicket.php
│   ├── actualizarUsuario.php
│   ├── crearEvento.php
│   ├── crearTicket.php
│   ├── crearUsuario.php
│   ├── eliminarEvento.php
│   ├── eliminarTicket.php
│   └── eliminarUsuario.php
│
├── modelo
│   └── conexion.php
│
├── vista
│   ├── index.php
│   ├── formularioActualizarEvento.php
│   ├── formularioActualizarTicket.php
│   ├── formularioCrearEvento.php
│   ├── formularioCrearTicket.php
│   ├── formularioCrearUsuario.php
│   ├── listaEventos.php
│   ├── listaTickets.php
│   └── listaUsuarios.php
│
└── db
    └── base.sql
```

### Descripción

- **Modelo:** administra la conexión con la base de datos.
- **Vista:** contiene las interfaces y formularios.
- **Controlador:** procesa las operaciones CRUD.
- **DB:** contiene el script SQL de creación de la base de datos.

---

## 6. Arquitectura del Sistema

El proyecto fue desarrollado utilizando el patrón de arquitectura **MVC (Modelo - Vista - Controlador)**, el cual permite separar la lógica de negocio, la interfaz de usuario y el acceso a los datos.

### Modelo

Ubicación:

```text
modelo/
```

Responsabilidades:

- Gestionar la conexión con la base de datos.
- Ejecutar consultas SQL.
- Manipular la información almacenada.

Archivo principal:

```text
conexion.php
```

### Vista

Ubicación:

```text
vista/
```

Responsabilidades:

- Mostrar formularios al usuario.
- Presentar la información almacenada.
- Permitir la interacción con el sistema.

Archivos principales:

```text
index.php
listaUsuarios.php
listaEventos.php
listaTickets.php
```

### Controlador

Ubicación:

```text
controlador/
```

Responsabilidades:

- Procesar solicitudes enviadas por las vistas.
- Validar datos.
- Ejecutar operaciones CRUD.
- Coordinar la comunicación entre vistas y base de datos.

Operaciones implementadas:

- Crear registros.
- Consultar registros.
- Actualizar registros.
- Eliminar registros.

### Flujo de Funcionamiento

```text
Usuario
   ↓
Vista
   ↓
Controlador
   ↓
Modelo
   ↓
Base de Datos
```

El usuario interactúa con las vistas, las cuales envían la información a los controladores. Los controladores procesan las solicitudes y utilizan el modelo para acceder a la base de datos. Finalmente, los resultados son enviados nuevamente a la vista para ser mostrados al usuario.

---

## 7. Tecnologías Utilizadas

| Tecnología | Descripción |
|------------|------------|
| PHP | Lenguaje de programación del sistema |
| MySQL | Sistema gestor de bases de datos |
| Apache | Servidor web |
| XAMPP | Entorno de desarrollo local |
| HTML5 | Estructura de las páginas |
| CSS3 | Diseño y estilos de la interfaz |
| phpMyAdmin | Administración de la base de datos |

---

## 8. Autores

Proyecto desarrollado por:

- Javier Alejandro Zapata Ramos
- Jhonatan Mauricio Rojas Mosquera
- Dylan Andrey Arboleda ???

### Información Académica

- Asignatura: Profundización de programación orientada a objetos
- Proyecto: Convocatoria: Sistema de Compra, Venta y Gestión de Reserva de Tickets para Eventos
- Semestre: 4
- Año: 2026