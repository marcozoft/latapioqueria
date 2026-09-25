# La Tapioquería — sitio web

Sitio web de **La Tapioquería**, restô bar de tapiocas brasileñas en San Martín de los Andes, Argentina (Belgrano 940). Es un sitio **PHP simple** (sin framework, sin Composer, sin `package.json`, sin build step): páginas `.php` que usan `include`/`require` para compartir estructura y arrays de PHP como diccionario de traducciones. Cualquier hosting con PHP (Hostinger incluido) lo sirve tal cual, subiendo la carpeta completa.

> **Nota histórica**: hasta 2026-09-18 este sitio se construyó en Claude Design ("Omelette"), después se migró a HTML/CSS estático convencional, y el 2026-09-25 se migró de nuevo — esta vez de HTML estático a PHP — para poder agregar español/inglés/portugués sin triplicar archivos a mano. Ver `git log` para arqueología de ambas migraciones.

## Idiomas (agregado 2026-09-25)

El sitio existe en **3 idiomas**: español (`es`, default, sin prefijo de URL), inglés (`en`, prefijo `/en/`) y portugués de Brasil (`pt`, prefijo `/pt/`). Ejemplos: `/menu` (es) · `/en/menu` (en) · `/pt/menu` (pt). El selector de idioma en cada página son 2 banderitas (SVG inline) con las de los otros 2 idiomas — nunca la del idioma activo: en español se ven 🇧🇷🇺🇸, en inglés 🇧🇷🇦🇷, en portugués 🇺🇸🇦🇷.

`qr.html` es la única página que se queda **solo en español** (es utilitaria, para imprimir, y ya tiene `noindex`) — no participa de este esquema.

Ver [docs/PAGINAS.md](docs/PAGINAS.md) para el detalle completo de cómo funciona el ruteo, los diccionarios y el SEO multi-idioma (hreflang, canonical, JSON-LD por idioma).

## Estructura del proyecto

```
index.php                        → Home (hero, 3 accesos, footer)
menu.php                         → Carta completa (precios, ítems y JSON-LD se generan desde data/menu-items.php)
donde-encontrarnos.php           → Resto Bar (todo el año) + FoodTruck Lolog (verano)
que-es-una-tapioca.php           → Qué es la tapioca, origen, cómo se hace
qr.html                          → Códigos QR de cada sección, para imprimir (solo español, noindex, no está en el sitemap)
inc/
  i18n.php                       → detección de idioma, función t(), URLs por idioma, bloque hreflang/canonical/og:locale
  menu-render.php                → funciones que arman el HTML de la carta (y el JSON-LD Menu) a partir de data/menu-items.php
  flags.php                      → banderas SVG inline (Argentina/Brasil/EE.UU.)
  language-switcher.php          → el `<nav>` con las 2 banderas del selector de idioma
  wa-fab.php, footer.php, site-signature.php → partials compartidos por las 4 páginas
lang/
  es.php, en.php, pt.php         → diccionario de textos de cada idioma (un array PHP por idioma)
data/
  menu-items.php                 → estructura de la carta (precios, banderas picante/veggie/recomendada, fotos, columnas) — independiente del idioma
css/
  base.css                       → reset, tokens de color/tipografía, botón WhatsApp, footer, redes sociales, back-link, selector de idioma — compartido por todas las páginas
  inicio.css                     → hero del mural + nav de accesos (solo home)
  menu.css                       → header + grillas de platos (solo menú)
  donde-encontrarnos.css         → hero + galerías crossfade (solo esa página)
  que-es-una-tapioca.css         → hero + pasos + video (solo esa página)
  qr.css                         → hero + grilla de tarjetas QR (solo esa página)
robots.txt                       → Permite indexación completa (Allow: /) + referencia a sitemap.xml
.htaccess                        → mod_rewrite: /en/<pagina> y /pt/<pagina> → <pagina>.php?lang=..; /<pagina> → <pagina>.php; 301 de las .html viejas
assets/                          → imágenes/video propios de cada página (mural/, sin_gluten.svg, qr/)
uploads/                         → fotografía de producto/local + PDFs de la carta
_unused/                         → archivos huérfanos archivados, ignorado por git (ver docs/IMAGENES.md)
docs/                            → documentación de contexto de este proyecto
```

Los nombres de página son kebab-case en minúsculas sin espacios ni tildes a propósito — son nombres de archivo que terminan siendo URLs públicas.

## Convenciones de código

- **Sin estilos inline.** Todo el CSS vive en `css/` (ver arriba). Si agregás una página nueva, seguí el mismo patrón: un `css/<nombre-de-la-página>.css` propio + `css/base.css`.
- **Todas las URLs a `css/`, `assets/` y `uploads/` son absolutas** (`/css/base.css`, no `css/base.css`) — a propósito, porque con los prefijos de idioma la misma página vive a distinta profundidad (`/menu` vs `/en/menu` vs `/pt/menu`) y una ruta relativa se rompería en las versiones con prefijo.
- **Nada de texto hardcodeado en los `.php` de página.** Todo texto visible sale de `t('clave.anidada')` (ver `inc/i18n.php`) leyendo de `lang/es.php` / `lang/en.php` / `lang/pt.php`. Si agregás un texto nuevo, agregá la clave en los 3 archivos (si falta en alguno, `t()` devuelve la clave misma en vez de tragarse el error en silencio — se nota enseguida en la página).
- **Los enlaces entre páginas usan `page_url('<pagina>')`** (queda en el idioma actual) o `lang_url('<pagina>', '<es|en|pt>')` (fuerza un idioma) — nunca un string relativo tipo `href="menu"`, porque tiene que resolver distinto según el idioma activo.
- **Hover en CSS real.** Los estados hover son `:hover` normales sobre clases (`.nav-card:hover`, `.social-icon:hover`, etc.) — no hay ningún mecanismo especial de por medio.
- **Atributos booleanos normales.** `<video controls autoplay muted loop playsinline>` — atributos HTML estándar.
- **Elementos vacíos (`<img>`) sin etiqueta de cierre** — `<img src="..." alt="">`, no `<img ...></img>`.

## Diseño visual (el sitio NO sigue el sistema `_ds/organic`, que ya no existe en el repo)

Todo el estilo está en `css/` con su propia paleta (no hay ningún design system externo):

- Fondo cálido: `#f0e2c6` / `#f2e5cf` (crema), `#17110d` / `#1d1610` (marrón oscuro, hero)
- Acento principal: `#c1502e` (terracota)
- Acento secundario: `#56633f` / `#33361f` (verde salvia oscuro)
- Tipografía: **Oswald** (overlines, mayúsculas, tracking amplio) + **Figtree** (título del hero de home) + **Poppins** (cuerpo de las subpáginas), cargadas por Google Fonts (`<link>` en cada `<head>`).

Estos valores están como custom properties en `css/base.css` (`--color-terracota`, `--font-heading`, etc.) — usar esas variables antes que hardcodear un hex nuevo.

## Contenido

No quedan huecos de contenido conocidos. La carta completa (~74 ítems) vive en `data/menu-items.php` + `lang/*.php` — actualizar un precio o agregar un plato se hace ahí, una sola vez, y sale reflejado en los 3 idiomas y en el JSON-LD automáticamente (ver [docs/PAGINAS.md](docs/PAGINAS.md)).

## Imágenes y SEO

Ver [docs/IMAGENES.md](docs/IMAGENES.md) para el inventario de imágenes. Cada página tiene `<title>`, `meta description`, Open Graph y JSON-LD **traducidos por idioma**, con `hreflang`/canonical self-referencing (ver [docs/PAGINAS.md](docs/PAGINAS.md) para el detalle técnico completo).

## Deploy / producción

Ver [docs/DEPLOY.md](docs/DEPLOY.md) — checklist de qué se hizo para dejar el sitio listo para hosting con PHP y qué falta definir.

## Ver también

- [docs/PAGINAS.md](docs/PAGINAS.md) — contenido y estructura de cada página, y el detalle técnico del sistema de idiomas.
