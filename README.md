# ⚡ NOVA GYM - High Performance System

<p align="center">
  <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?auto=format&fit=crop&q=80&w=600" width="500" alt="NovaGym Cover" style="border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
</p>

**NovaGym** es una plataforma de software de alto rendimiento desarrollada en **Laravel** y diseñada específicamente para entrenadores, preparadores físicos y administradores de centros deportivos. Ofrece un panel de control avanzado con una estética visual *Obsidian Cyberpunk* (tonos oscuros y acentos cian cyber fluorescentes) que optimiza la experiencia operativa diaria y el seguimiento de atletas de élite.

Este proyecto ha sido desarrollado en el marco de las actividades prácticas de la asignatura de desarrollo web, cumpliendo de manera estricta con todas las especificaciones y entregables solicitados.

---

## 🛠️ Tecnologías Utilizadas

*   **Core Backend:** Laravel (PHP 8.1+)
*   **Database Engine:** MySQL / MariaDB (totalmente modelado mediante migraciones y relaciones Eloquent)
*   **Estilos y UI:** Tailwind CSS (a través de directivas CDN avanzadas)
*   **Fuentes y Tipografía:** Google Fonts (*Inter*, *Space Grotesk*, *Hanken Grotesk*)
*   **Iconografía:** Material Symbols Outlined y FontAwesome 6.4
*   **Interactividad Frontend:** jQuery 3.6 & DataTables 1.13 (con traducción al español e integración estilística Obsidian)
*   **Visualización de Datos:** Chart.js (gráficos analíticos interactivos con conmutadores dinámicos)
*   **Generación de Documentos:** Barryvdh DomPDF para exportación de reportes

---

## ✨ Funcionalidades Principales

1.  **Landing Page Profesional:** Una página de inicio moderna ([welcome.blade.php](resources/views/welcome.blade.php)) que introduce la propuesta de valor del gimnasio con animaciones y micro-interacciones.
2.  **Sistema de Acceso Seguro (Auth):**
    *   Formularios de **Registro** y **Login** totalmente personalizados bajo la estética oscura de la marca.
    *   Restauración de contraseña real a través de la interfaz web ([forgot-password.blade.php](resources/views/auth/forgot-password.blade.php)), configurado con soporte SMTP.
    *   Protección de rutas críticas mediante middlewares de Laravel (`auth` y `guest`).
3.  **Dashboard del Administrador (Home):**
    *   Identificación en tiempo real del usuario activo (`Auth::user()->name`) con insignia de Administrador.
    *   Bento-Grid de métricas principales (Total de ingresos, atletas activos/inactivos, membresías vigentes, rutinas asignadas, instructores y sedes).
    *   **Gráfico Analítico Interactivo:** Integración de Chart.js que visualiza el registro histórico de socios, permitiendo conmutar dinámicamente entre vista mensual y anual.
    *   **NovaGym AI Optimizer:** Módulo visual premium con alertas e indicadores inteligentes sugeridos por IA.
4.  **Gestión de Multi-Perfiles:** Panel exclusivo para que el usuario activo edite su información de perfil (soportando roles de Administrador, Instructor y Cliente) y actualice de forma segura su contraseña y foto.
5.  **CRUDs Completos en Múltiples Módulos:**
    *   **Clientes (Atletas):** Registro completo con validación, filtro por estado y asignación de sedes.
    *   **Instructores:** Administración de entrenadores del staff, especialidades y datos de contacto.
    *   **Sedes (Branches):** Gestión de sedes físicas y locaciones del gimnasio.
    *   **Membresías:** Control de suscripciones, estados de pago y cálculo automático de vigencias.
    *   **Rutinas de Entrenamiento:** Planificación de ejercicios por dificultad y asociación a clientes y entrenadores.
    *   **Nutrición (Meal Plans):** Planes dietéticos estructurados con control calórico.
6.  **Subida Física de Imágenes:** Soporta el guardado y recuperación de fotos en el disco `public` del servidor local, además de la entrada por URL externa para avatares.
7.  **DataTables Integration:** Listados principales integrados con DataTables en español, soporte de ordenamiento, paginado, búsqueda en caliente y filtros avanzados por estado.
8.  **Exportación a PDF:** Generación dinámica de fichas de entrenamiento y planes de nutrición oficiales en PDF de manera rápida y ligera.
9.  **API REST Pública:** Endpoints expuestos en `/api/public/` para el consumo externo de clientes, rutinas e instructores con configuración abierta de CORS (`Access-Control-Allow-Origin: *`).

---

## 💾 Modelado de Base de Datos

La base de datos se modeló mediante migraciones relacionales y claves foráneas robustas con borrado en cascada en las relaciones dependientes:

*   **Tabla `users`:** Administradores y cuentas principales autorizadas en el sistema.
*   **Tabla `branches`:** Sedes del gimnasio a las que pertenecen los atletas.
*   **Tabla `clients`:** Socios deportistas del centro de alto rendimiento.
*   **Tabla `instructors`:** Cuerpo técnico y entrenadores encargados del seguimiento.
*   **Tabla `memberships`:** Suscripciones activas vinculadas a los socios.
*   **Tabla `routines`:** Planes de entrenamiento asociados a un cliente e instructor específicos.
*   **Tabla `meal_plans`:** Planes de alimentación y nutrición vinculados a los clientes.

---

## 🚀 Instrucciones de Instalación y Configuración

Siga los siguientes pasos para ejecutar el proyecto de manera local (entornos como Laragon, XAMPP o PHP puro):

1.  **Clonar o Extraer el Proyecto:**
    Extraiga el archivo comprimido del proyecto en su directorio de trabajo (ej. `C:\laragon\www\novagym`).

2.  **Instalar Dependencias de Composer:**
    Ejecute el siguiente comando en la raíz del proyecto para descargar e instalar todas las dependencias del framework:
    ```bash
    composer install
    ```

3.  **Configurar el Archivo de Entorno:**
    Duplique el archivo `.env.example` y renómbrelo a `.env`. Asegúrese de configurar las credenciales correctas de su base de datos local y servidor de correo SMTP (como el MailCatcher de Laragon o un servicio externo):
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=novagym
    DB_USERNAME=root
    DB_PASSWORD=

    MAIL_MAILER=smtp
    MAIL_HOST=127.0.0.1
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    ```

4.  **Generar Clave de Aplicación:**
    Cree la clave de cifrado única de Laravel ejecutando:
    ```bash
    php artisan key:generate
    ```

5.  **Ejecutar Migraciones y Poblar la Base de Datos:**
    Puede crear las tablas e importar de forma automática el set de datos premium precargados ejecutando el comando de semillas de Laravel:
    ```bash
    php artisan migrate --seed
    ```
    *Nota: Alternativamente, puede importar directamente el archivo `seed_data.sql` incluido en la raíz en su gestor de base de datos (phpMyAdmin / HeidiSQL).*

6.  **Crear el Enlace Simbólico del Almacenamiento (Storage Link):**
    Para habilitar la correcta visualización de las imágenes cargadas físicamente por los usuarios, ejecute:
    ```bash
    php artisan storage:link
    ```

7.  **Iniciar Servidor Local:**
    Levante el servidor de desarrollo integrado de Laravel:
    ```bash
    php artisan serve
    ```
    Acceda al sistema a través de `http://127.0.0.1:8000` o la URL configurada en Laragon (`http://novagym.test`).
