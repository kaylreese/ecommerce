# E-Commerce Molla

## About E-Commerce Molla
Este proyecto es un sistema de E-Commerce construido con Laravel 10, diseñado para ofrecer una plataforma robusta y escalable para la venta de productos. Incluye funcionalidades como gestión de productos, usuarios, pagos en línea y un panel de administración.

# **Ecommerce Laravel 10**

---

## **Descripción del Proyecto**
Este es un ecommerce construido con **Laravel 10**, enfocado en ofrecer una experiencia moderna, segura y escalable. Cuenta con funcionalidades avanzadas como gestión de productos, usuarios, pasarelas de pago y un panel administrativo.

---

## **Características**
- **Gestión de Productos:**  
  CRUD completo para productos con imágenes, precios y stock.
- **Carrito de Compras:**  
  Los clientes pueden agregar productos al carrito y realizar el checkout.
- **Pasarelas de Pago:**  
  Integración con Stripe.
- **Autenticación y Roles:**  
  Sistema de inicio de sesión/registro con roles (admin y cliente).
- **Panel Administrativo:**  
  Gestión centralizada de productos, pedidos, usuarios y reportes.
- **Responsividad:**  
  Diseño adaptable a dispositivos móviles.
- **Framework Moderno:**  
  Utiliza las últimas características de Laravel 10, incluyendo el sistema de validación, invocables y componentes Blade.

---

## **Requisitos Previos**
Asegúrate de tener lo siguiente instalado:
- **PHP:** >= 8.1  
- **Composer:** >= 2.0  
- **Node.js:** >= 18.x  
- **NPM o Yarn.**  
- **MySQL:** >= 8.0 o **PostgreSQL** >= 10.  
- **Servidor Web:** Apache/Nginx.

---

## **Instalación**
### 1. **Clonar el Repositorio**
```bash
git clone https://github.com/tu-usuario/ecommerce.git
cd ecommerce-laravel10
```

### 2. **Instalar Dependencias**
```bash
composer install
npm install
npm run build
```

### 3. **Configurar el Archivo `.env`**
Copia el archivo `.env.example` y personalízalo:
```bash
cp .env.example .env
```
Configura las variables de entorno en `.env`:
```env
APP_NAME=EcommerceLaravel
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### 4. Stripe API Keys
STRIPE_KEY=pk_test_XXXXXXXXXXXXXXXXXXXXXXXX
STRIPE_SECRET=sk_test_XXXXXXXXXXXXXXXXXXXXXXXX


### 5. **Generar Claves y Migrar la Base de Datos**
```bash
php artisan key:generate
php artisan migrate --seed
```

### 6. **Iniciar el Servidor**
```bash
php artisan serve
```
Accede al proyecto en [http://localhost:8000](http://localhost:8000).

---

## **Funcionalidades Clave**
1. **Frontend del Ecommerce:**  
   - Página principal con productos destacados y búsqueda avanzada.
   - Búsqueda de Productos usando filtros: Por Categoría, Color, Marca y Precio
   - Sección de Blog
   - Gestión de usuarios: registro, inicio de sesión y recuperación de contraseñas.

2. **Carrito y Checkout:**  
   - Agregar y eliminar productos del carrito.
   - Procesamiento de pagos seguro Cash y Credicard con Stripe.

3. **Panel Administrativo:**  
   - CRUD de productos, usuarios y pedidos.
   - CRUD Clientes.
   - Configuraciones de E-Commerce.
   - Configuración de Email
   - Descuentos
   - Otros


---

## **Despliegue en Producción**
Sigue estos pasos para implementar el proyecto en un servidor de producción:
1. **Configurar las variables de entorno:** Asegúrate de que las claves de producción estén configuradas en `.env` (APP_ENV=production, APP_DEBUG=false).
2. **Optimizar la Aplicación:**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
3. **Configurar el Servidor Web:**  
   Asegúrate de que el directorio raíz (`DocumentRoot`) apunte a la carpeta `public/`.

---

## **Licencia**
Este proyecto está bajo la [Licencia MIT](https://opensource.org/licenses/MIT).

---

## **Contacto**
Para consultas:
- **Email:** samuel.bocanegrad@gmail.com  
- **Website:** [https://kaylreese.xyz](https://kaylreese.xyz)  
- **GitHub:** [kaylreese](https://github.com/kaylreese)
