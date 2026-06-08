# Manual Técnico

# 1. Instalación del Sistema

## Requisitos

Para ejecutar el sistema se requiere:

- XAMPP instalado.
- PHP 8 o superior.
- MySQL.
- Navegador web moderno.
- Sistema operativo Windows, Linux o macOS.

---

## Instalación

### Paso 1

Descargar e instalar XAMPP.

### Paso 2

Iniciar los servicios de:

- Apache
- MySQL

desde el Panel de Control de XAMPP.

### Paso 3

Copiar la carpeta del proyecto:

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

### Paso 4

Abrir phpMyAdmin:

```text
http://localhost/phpmyadmin
```

### Paso 5

Crear una base de datos llamada:

```sql
MVC_Tickets_eventos
```

### Paso 6

Importar el archivo SQL del proyecto para generar automáticamente las tablas necesarias.

---

# 2. Configuración del Entorno

## Configuración de la Base de Datos

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

---

## Descripción de los Parámetros

| Parámetro | Descripción |
|-----------|-------------|
| host | Servidor de base de datos |
| port | Puerto utilizado por MySQL |
| user | Usuario de acceso |
| pass | Contraseña del usuario |
| db | Nombre de la base de datos |

---

## Configuración del Puerto

El proyecto utiliza:

```php
$port = 3307;
```

Este valor puede variar según la configuración local de cada integrante.

### Ejemplo

| Integrante | Puerto |
|------------|---------|
| Javier | 3307 |
| Jhonatan | 3330 |
| Dylan | 3306 |

Si MySQL utiliza un puerto diferente, únicamente debe modificarse:

```php
$port = 3307;
```

por el puerto correspondiente.

---

## Verificación del Puerto de MySQL

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

# 3. Dependencias

## Servidor Web

- Apache (incluido en XAMPP)

## Lenguaje de Programación

- PHP 8+

## Gestor de Base de Datos

- MySQL

## Librerías

No se utilizan librerías externas ni gestores de dependencias como Composer.

---

# 4. Ejecución del Proyecto

## Paso 1

Iniciar los servicios:

- Apache
- MySQL

desde XAMPP.

## Paso 2

Abrir un navegador web.

## Paso 3

Ingresar la URL:

```text
http://localhost/TICKETS_CONCIERTO_CONVOCATORIA/
```

Si Apache utiliza otro puerto:

```text
http://localhost:8080/TICKETS_CONCIERTO_CONVOCATORIA/
```

---

## Paso 4

Verificar el funcionamiento del sistema:

### Como visitante

- Consultar eventos disponibles.
- Registrarse como cliente.
- Iniciar sesión.

### Como cliente

- Consultar eventos.
- Comprar tickets.
- Consultar sus tickets adquiridos.
- Cerrar sesión.

### Como administrador

- Gestionar eventos.
- Gestionar usuarios.
- Consultar tickets vendidos.
- Registrar nuevos administradores.
- Cerrar sesión.

---

# 5. Estructura del Proyecto

```text
TICKETS_CONCIERTO_CONVOCATORIA
│
├── controlador
│   ├── actualizarEvento.php
│   ├── crearEvento.php
│   ├── crearUsuario.php
│   ├── eliminarEvento.php
│   ├── eliminarUsuario.php
│   ├── login.php
│   ├── logout.php
│   └── comprarTicket.php
│
├── modelo
│   └── conexion.php
│
├── vista
│   ├── formularioCrearEvento.php
│   ├── formularioCrearUsuario.php
│   ├── listaEventos.php
│   ├── listaTickets.php
│   ├── listaUsuarios.php
│   └── login.php
│
├── db
│   └── base.sql
│
└── index.php
```

---

## Descripción de Carpetas

### Modelo

Contiene la conexión a la base de datos.

```text
modelo/
```

### Vista

Contiene las interfaces visuales del sistema.

```text
vista/
```

### Controlador

Contiene la lógica de negocio y las operaciones del sistema.

```text
controlador/
```

### DB

Contiene los scripts SQL necesarios para la creación de la base de datos.

```text
db/
```

---

# 6. Arquitectura del Sistema

El proyecto fue desarrollado utilizando el patrón de arquitectura **MVC (Modelo - Vista - Controlador)**.

---

## Modelo

Ubicación:

```text
modelo/
```

Responsabilidades:

- Gestionar la conexión con la base de datos.
- Ejecutar consultas SQL.
- Manipular los datos almacenados.

Archivo principal:

```text
conexion.php
```

---

## Vista

Ubicación:

```text
vista/
```

Responsabilidades:

- Mostrar formularios.
- Mostrar eventos disponibles.
- Mostrar usuarios registrados.
- Mostrar tickets adquiridos.
- Permitir la interacción con el sistema.

Archivos principales:

```text
listaEventos.php
listaUsuarios.php
listaTickets.php
login.php
```

---

## Controlador

Ubicación:

```text
controlador/
```

Responsabilidades:

- Procesar solicitudes enviadas por las vistas.
- Validar información.
- Gestionar autenticación.
- Gestionar compra de tickets.
- Gestionar eventos y usuarios.

Operaciones implementadas:

- Registro de usuarios.
- Inicio y cierre de sesión.
- Creación de eventos.
- Edición de eventos.
- Eliminación de eventos.
- Compra de tickets.
- Eliminación de usuarios.

---

## Flujo General

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

El usuario interactúa con las vistas, las cuales envían la información a los controladores. Los controladores procesan las solicitudes y utilizan el modelo para acceder a la base de datos. Finalmente, los resultados son mostrados nuevamente al usuario.

---

# 7. Tecnologías Utilizadas

| Tecnología | Descripción |
|------------|-------------|
| PHP | Lógica del sistema |
| MySQL | Base de datos |
| Apache | Servidor web |
| XAMPP | Entorno de desarrollo |
| HTML5 | Estructura de páginas |
| CSS3 | Diseño y estilos |
| phpMyAdmin | Administración de la base de datos |

---

# 8. Roles del Sistema

## Cliente

Puede:

- Registrarse.
- Iniciar sesión.
- Consultar eventos.
- Comprar tickets.
- Consultar sus tickets.

No puede:

- Crear eventos.
- Eliminar eventos.
- Gestionar usuarios.

---

## Administrador

Puede:

- Gestionar eventos.
- Gestionar usuarios.
- Registrar administradores.
- Consultar tickets vendidos.
- Eliminar usuarios.
- Eliminar eventos.

---

# 9. Base de Datos

El sistema está compuesto por tres tablas principales:

### usuarios

Almacena la información de los usuarios registrados.

### eventos

Almacena la información de los eventos disponibles.

### tickets

Almacena las compras realizadas por los usuarios.

Relaciones:

```text
usuarios 1 ---- N tickets
eventos  1 ---- N tickets
```

---

# 10. Autores

Proyecto desarrollado por:

- Javier Alejandro Zapata Ramos
- Jhonatan Mauricio Rojas Mosquera
- Dylan Andrey Arboleda García

---

## Información Académica

**Asignatura:** Profundización de Programación Orientada a Objetos

**Proyecto:** Sistema Web MVC para Gestión de Eventos y Venta de Tickets

**Descripción:**

Sistema desarrollado bajo el patrón MVC que permite la administración de eventos y la venta de tickets. Los clientes pueden registrarse, iniciar sesión, consultar eventos disponibles y comprar tickets. Los administradores pueden gestionar eventos, usuarios y consultar los tickets vendidos.

**Semestre:** 4

**Año:** 2026