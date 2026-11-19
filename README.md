# Venecia Modas — E-commerce en Laravel

[![Laravel](https://img.shields.io/badge/Laravel_12-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP_8.2-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net)
[![Blade](https://img.shields.io/badge/Blade-f56b57?style=flat-square)](https://laravel.com/docs/blade)

Proyecto académico de la carrera de Análisis de Sistemas: tienda online de indumentaria («Venecia Modas») con catálogo, carrito persistido en base de datos, checkout, historial de pedidos y panel de administración con control de acceso por rol.

La consigna que me impuse fue hacerlo **sin paquetes de terceros**: ni Breeze/Jetstream para autenticación, ni librerías de carrito, ni carts en sesión. Autenticación, carrito, órdenes y guardas del panel están implementados a mano sobre Laravel 12, para entender cada pieza.

## Características

- **Catálogo**: home con hasta 8 productos destacados, listado paginado (12 por página) y ficha de cada producto.
- **Carrito persistido en la base** por usuario autenticado: agregar, cambiar cantidades, quitar ítems o vaciar, con subtotales y total calculados.
- **Checkout** con dirección de envío y regla de envío: **compras de $50.000 o más tienen envío gratis; debajo de eso se suman $5.000**.
- **Órdenes con precio congelado**: cada ítem guarda el precio unitario del momento de la compra, dentro de una transacción de base de datos; el carrito se vacía al confirmar.
- **Historial de pedidos** del cliente con detalle y estado (`pendiente` / `enviado`).
- **Login y registro** con verificación de credenciales y **email de bienvenida** (manejo de errores con log; por defecto `MAIL_MAILER=log`).
- **Panel admin** (`/admin`): dashboard con totales (órdenes, productos, clientes), CRUD de productos con imagen, gestión de órdenes (editar estado y dirección, eliminar) y cambio de contraseña del propio admin.
- **Roles y acceso**: `admin` y `client` en la tabla `usuarios`; el grupo de rutas `/admin/*` está protegido por el middleware `CheckAdmin` (redirige a inicio si no sos admin). El registro público siempre crea clientes.

## Stack

| Capa | Tecnología |
|---|---|
| Backend | Laravel 12.2 · PHP 8.2 · Eloquent |
| Frontend | Blade + **Tailwind CSS y Alpine.js por CDN** (el andamiaje Vite del skeleton quedó sin uso: las vistas no compilan assets) |
| Base de datos | SQLite por defecto (MySQL listo para activar en `.env`) |
| Mail | Mailable `BienvenidaMail` con vista HTML propia |

## Modelo de datos

| Tabla | Contenido |
|---|---|
| `usuarios` | clientes y admins (`nombre`, `email`, `password`, `rol`) — el guard de Laravel autentica contra esta tabla |
| `productos` | nombre, descripción, precio, imagen (binaria) y `destacado` |
| `carrito_items` | un registro por producto en el carrito de cada usuario |
| `ordenes` | total, estado (`pendiente`/`enviado`), dirección de envío |
| `orden_items` | ítems con precio unitario congelado al momento de la compra |

> Nota: la tabla `users` del skeleton de Laravel convive sin uso; el sistema real usa `usuarios`.

## Puesta en marcha

Requisitos: PHP 8.2+, Composer. No hace falta instalar nada de npm: los assets se cargan por CDN.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
# http://localhost:8000
```

Por defecto usa SQLite (`database/database.sqlite`; crealo vacío si no existe). Para MySQL, descomentá el bloque `DB_*` de `.env.example` con tus credenciales.

### Crear el primer admin

El seeder no crea usuarios del sistema (es un proyecto con datos propios), así que el primer admin se crea a mano:

```bash
php artisan tinker
```

```php
App\Models\Usuario::create([
    'nombre'   => 'Admin',
    'email'    => 'admin@ejemplo.com',
    'password' => bcrypt('elegi-una-clave-segura'),
    'rol'      => 'admin',
]);
```

Después podés cargar productos desde `/admin/productos`. En `resources/fotosdeprueba/` hay 10 imágenes de prueba listas para subir.

## Rutas principales

| Área | Rutas |
|---|---|
| Pública | `/` (destacados) · `/productos` · `/productos/{id}` · `/login` · `/registro` |
| Cliente (`auth`) | `/carrito` (+ agregar/actualizar/eliminar/vaciar) · `/checkout` · `/ordenes` |
| Admin (`auth` + `CheckAdmin`) | `/admin/dashboard` · `/admin/productos` (CRUD) · `/admin/ordenes` · `/admin/perfil/cambiar-password` |

## Alcance y limitaciones (honesto)

Es un proyecto de aprendizaje y su alcance es el de la consigna. **No incluye**: pasarela de pagos (no hay ninguna integración ni simulación), control de stock, búsqueda o categorías/filtros, cupones ni reviews. Los tests son los de ejemplo del framework. Algunas decisiones son didácticas y no idiomáticas a propósito, como guardar las imágenes de producto como binario en la base y renderizarlas en base64, o la validación inline en controladores en lugar de Form Requests.

## Estructura

```
app/
├─ Http/
│  ├─ Controllers/          # Producto, Carrito, Orden + Auth/ (login, registro)
│  │                        #   + Admin/ (dashboard, productos, ordenes, perfil)
│  └─ Middleware/           # CheckAdmin: guarda del panel
├─ Mail/BienvenidaMail.php
└─ Models/                  # Usuario, Producto, CarritoItem, Orden, OrdenItem
database/migrations/        # 7 migraciones (usuarios, productos, carrito, ordenes)
resources/views/            # 18 vistas Blade: tienda, auth, carrito, ordenes, admin, email
routes/web.php              # todas las rutas de la app
```

---

*Proyecto académico de Kevin Otto ([@Ona96](https://github.com/Ona96)) para la carrera de Análisis de Sistemas.*
