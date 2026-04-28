# TechHub Store 🛒

## 📌 Descripción
Sistema web de tienda online desarrollado en PHP utilizando arquitectura MVC.  
Permite a los usuarios registrarse, iniciar sesión, agregar productos al carrito y realizar compras.

---

## 🚀 Tecnologías
- PHP (POO)
- MySQL
- HTML5, CSS3
- JavaScript (AJAX)
- XAMPP

---

## ⚙️ Instalación

1. Clonar repositorio o descargar proyecto
2. Copiar carpeta en `htdocs`
3. Iniciar Apache y MySQL en XAMPP
4. Crear base de datos `techhub_store`
5. Importar archivo `techhub_store.sql`
6. Abrir en navegador:

http://localhost/techhub/public

---

## 👤 Funcionalidades

- Registro de usuario
- Login / Logout
- Visualización de productos
- Carrito de compras
- Finalizar compra (genera orden en BD)

---

## 🏗️ Arquitectura (MVC)

- **Modelos:** acceso a datos (Usuario, Producto)
- **Vistas:** interfaz (productos.php)
- **Controladores:** lógica (ProductoController)

---

## 🗄️ Base de Datos

El sistema utiliza una base de datos MySQL llamada `techhub_store`.

### Tablas principales:

- **usuarios**
  - Almacena información de los usuarios registrados (nombre, correo, contraseña encriptada).

- **productos**
  - Contiene los productos disponibles en la tienda (nombre, descripción, precio).

- **ordenes**
  - Registra cada compra realizada por un usuario.

- **detalle_orden**
  - Relaciona los productos con una orden específica, incluyendo la cantidad.

---

## 📄 Script de Base de Datos

El archivo `techhub_store.sql` incluido en el proyecto contiene:

- Creación de todas las tablas necesarias
- Relaciones entre tablas mediante claves foráneas
- Inserción de datos de prueba (productos)

Este archivo debe importarse en phpMyAdmin para que el sistema funcione correctamente.

---

## 📊 Diagrama MVC

```mermaid
graph TD
A[Usuario] --> B[Vista - productos.php]
B --> C[Controlador]
C --> D[Modelo]
D --> E[Base de Datos]

🔧 Endpoints / Funciones
Usuario
-Registro de usuario
-Inicio de sesión
-Cierre de sesión

Productos
-Listado de productos desde la base de datos

Carrito
-Agregar producto
-Eliminar producto
-Vaciar carrito

Orden
-Finalizar compra (crea orden y detalle en base de datos)

✨ Autor

Miguel Ángel Rios Ojeda