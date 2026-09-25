# Deploy / producción

Estado al 2026-09-25. El sitio corre en **PHP simple** (sin framework, sin Composer, sin build step — ver [../CLAUDE.md](../CLAUDE.md)) desde la migración a 3 idiomas del 2026-09-25; antes (2026-09-18) fue HTML estático puro. Necesita un hosting con PHP (Hostinger lo tiene, hasta PHP 8.5) y `mod_rewrite` habilitado — no alcanza con un host de archivos estáticos puro como antes.

## Qué se dejó listo

- **`index.php` en la raíz es la home real** (no un redirect): contiene el hero, la navegación a las otras 3 secciones y el footer directamente.
- **`robots.txt`**: permite indexar todo el sitio (`Allow: /`).
- **Sitio en 3 idiomas (2026-09-25)**: español (default, sin prefijo), inglés (`/en/`) y portugués de Brasil (`/pt/`) — ver [PAGINAS.md](PAGINAS.md#sistema-de-idiomas-2026-09-25) para el detalle técnico completo (routing, hreflang, canonical, JSON-LD por idioma, diccionarios). Se armó el plan técnico de SEO multi-idioma con el agente `content-marketer` (el mismo usado en el SEO de 2026-09-18) antes de implementar, para no perder indexación al agregar idiomas.
- **`<title>` + `meta description` + Open Graph + `og:locale`** traducidos por idioma en las 4 páginas traducidas.
- **`lang="es"`/`"en"`/`"pt-BR"`** en el `<html>` según corresponda.
- **Imágenes optimizadas** a ≤100KB (ver [IMAGENES.md](IMAGENES.md)) — sin cambios en esta migración, las imágenes son las mismas en los 3 idiomas.
- **CSS externo** en `css/` (uno compartido + uno por página), ahora referenciado con rutas absolutas (`/css/base.css`) porque las páginas en inglés/portugués viven un nivel más profundo (`/en/menu`) y una ruta relativa se rompería ahí.
- **SEO técnico/on-page completo (2026-09-18, extendido 2026-09-25)**:
  - **Datos estructurados JSON-LD** en las 4 páginas traducidas, uno por idioma (no un bloque compartido): `Restaurant` en todas; `Menu`/`MenuSection`/`MenuItem` completo (generado desde `data/menu-items.php`, no escrito a mano) en `menu.php`; `Restaurant` + `FoodEstablishment` en `donde-encontrarnos.php`; `Restaurant` + `Article` (con `workTranslation`/`translationOfWork` entre idiomas) en `que-es-una-tapioca.php`; `BreadcrumbList` en las 3 subpáginas.
  - **Jerarquía de encabezados real en `menu.php`**: `<h1 class="sr-only">` + cada sección/subsección de la carta como `<h2>`/`<h3>` real.
  - **Favicon + manifest**: `assets/favicon.svg` + variantes PNG + `site.webmanifest`.
  - **`og:image`** usa `uploads/tapi_lomo.webp` (Home/Menú) — foto real del plato insignia.
  - **`loading="lazy"`** en las imágenes fuera del viewport inicial.
  - **Dominio: `latapioqueria.com.ar`.** `<link rel="canonical">` self-referencing por idioma (`/en/menu` canonicaliza a sí mismo, no a `/menu`), `og:url` absoluto, `sitemap.xml` con las 12 URLs (4 páginas × 3 idiomas), todas las URLs del JSON-LD absolutas.
- **URLs limpias sin `.html`, ahora con idiomas (2026-09-24, extendido 2026-09-25)**: `.htaccess` reescribe `/en/<página>` y `/pt/<página>` a `<página>.php?lang=en|pt`, y `/<página>` (español) a `<página>.php` — todo rewrite interno, sin redirect visible. Las 4 URLs viejas con `.html` (los archivos ya no existen, ver más abajo) devuelven **301** a su URL limpia en español, para no perder el posicionamiento que ya hubieran ganado. Requiere `mod_rewrite` habilitado (Hostinger lo tiene por defecto).
- **Página `qr.html` (2026-09-24)**: códigos QR propios, solo en español, `noindex`, no está en `sitemap.xml`. Ver [PAGINAS.md](PAGINAS.md#qrhtml--códigos-qr-2026-09-24-solo-español).

## Cómo se probó esta migración antes de darla por lista

Como el sitio pasó a depender de PHP + `mod_rewrite` (algo que no se puede simular con `python3 -m http.server`), se usó el Docker remoto en la HP de la LAN (ver `~/docs/DOCKER_EN_HP.md` en la máquina de desarrollo) para levantar, de punta a punta:

1. Un contenedor `php:8.2-cli` para correr `php -l` sobre los ~15 archivos `.php` nuevos (sin errores de sintaxis) y levantar el servidor embebido de PHP (`php -S`) para probar los 3 idiomas × 4 páginas con `curl` — sin errores/warnings de PHP, sin claves de traducción sin resolver, JSON-LD válido en las 3 versiones, conteo de ítems de la carta idéntico en los 3 idiomas (61 con precio/desc + 6 simples + 5 vinos + 2 "de regalo" = 74).
2. Un contenedor `php:8.2-apache` (con `mod_rewrite` habilitado) para probar el `.htaccess` real: las 12 combinaciones página×idioma devuelven 200, las 4 URLs `.html` viejas devuelven 301 a la URL limpia, y los assets (`css/`, `uploads/`) resuelven bien con rutas absolutas incluso en `/en/menu` y `/pt/menu`.
3. Playwright (apuntando al contenedor Apache) para una verificación visual final — layout, banderas del selector de idioma e íconos de la carta idénticos en los 3 idiomas, sin regresiones.

Los dos contenedores y el directorio sincronizado en la HP se borraron al terminar (`docker rm -f` + `rm -rf`) — no queda nada corriendo ahí.

## Historial: por qué antes existía un redirect

Hasta 2026-09-18 el sitio se construyó en Claude Design, que requería mantener la extensión `.dc.html` en las páginas para poder seguir editándolas visualmente ahí. Eso impedía que la home se llamara `index.html`/`index.php` directamente, así que existía un `index.html` que solo hacía un meta-refresh a `inicio.dc.html`. Al migrar a HTML/CSS convencional esa restricción desapareció, y al migrar después a PHP (2026-09-25) `index.html` pasó a ser `index.php`.

## Pendiente (requiere decisiones que todavía no están tomadas)

- **Elegir el host final** (Hostinger es el candidato — ya se confirmó que soporta PHP 8.5) para publicar bajo `latapioqueria.com.ar` — el dominio ya está definido y todo el sitio ya apunta ahí, pero todavía no está desplegado en ningún proveedor. Al subir, confirmar que el hosting sirva `.php` como default (`DirectoryIndex index.php index.html`, ya está en el `.htaccess`) y que `mod_rewrite` esté activo.
- **Datos que faltan para que el JSON-LD `Restaurant` quede 100% completo** (no se inventó ninguno de estos, hay que confirmarlos con el dueño): horario de atención exacto (`openingHoursSpecification`) y coordenadas de geolocalización (`geo`) de Belgrano 940.
- **Validar el sitio con Google Search Console + Rich Results Test** una vez publicado: dar de alta la propiedad (y sus variantes de idioma, si Search Console las pide por separado), enviar `sitemap.xml`, y correr las 12 URLs por el [Rich Results Test](https://search.google.com/test/rich-results) para confirmar que el hreflang y el JSON-LD se leen sin errores en producción (con HTTPS real).
- **Confirmar con un `curl -I` real** una vez deployado que `/menu`, `/en/menu`, `/pt/menu` y los 301 de las `.html` viejas funcionan igual que en el contenedor de prueba (ver arriba) — el comportamiento de `.htaccess` puede variar levemente entre proveedores.

## Cómo probar el sitio localmente antes de subirlo

Necesita PHP (a diferencia de la versión 100% estática anterior). Con PHP instalado:

```
php -S localhost:8000
```

y abrir `http://localhost:8000/` — funciona para navegar el sitio y ver el texto en español, pero **el servidor embebido de PHP no lee `.htaccess`**, así que las URLs `/en/menu`, `/pt/menu` y los redirects de `.html` no se pueden probar así: para eso hace falta un Apache/LiteSpeed real (por ejemplo un contenedor `php:8.2-apache`, o el propio hosting de producción) — en su defecto, pasar `?lang=en` o `?lang=pt` como query string funciona igual con el servidor embebido, porque el idioma lo lee `inc/i18n.php` de `$_GET['lang']` (el `.htaccess` solo es la capa que convierte `/en/menu` en `menu.php?lang=en` puertas afuera).
