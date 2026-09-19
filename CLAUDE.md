# La Tapioquería — sitio web

Sitio web de **La Tapioquería**, restô bar de tapiocas brasileñas en San Martín de los Andes, Argentina (Belgrano 940). Es un **sitio HTML estático convencional**: HTML + CSS + un puñado de `<video>`/animaciones CSS, sin build, sin framework, sin `package.json`. Cualquier servidor de archivos estáticos lo sirve tal cual.

> **Nota histórica**: hasta 2026-09-18 este sitio se construyó en Claude Design ("Omelette"), con páginas `.dc.html` (`<x-dc>`/`<helmet>`, estilos inline, runtime `support.js`). Se migró por completo a HTML/CSS estándar — ver `git log` si hace falta arqueología de esa etapa. No quedan restos de esa arquitectura en el repo (`support.js`, `image-slot.js`, `_ds/` y los `*.dc.html` se borraron).

## Estructura del proyecto

```
index.html                       → Home (hero, 3 accesos, footer) — es la página real, no un redirect
menu.html                        → Carta completa con precios
donde-encontrarnos.html          → Resto Bar (todo el año) + FoodTruck Lolog (verano)
que-es-una-tapioca.html          → Qué es la tapioca, origen, cómo se hace
css/
  base.css                       → reset, tokens de color/tipografía, botón WhatsApp, footer, redes sociales, back-link — compartido por las 4 páginas
  inicio.css                     → hero del mural + nav de accesos (solo home)
  menu.css                       → header + grillas de platos (solo menú)
  donde-encontrarnos.css         → hero + galerías crossfade (solo esa página)
  que-es-una-tapioca.css         → hero + pasos + video + placeholders de fotos (solo esa página)
robots.txt                       → Permite indexación completa (Allow: /)
assets/                          → imágenes/video propios de cada página (menu-hero.jpg, mural/, sin_gluten.svg)
uploads/                         → fotografía de producto/local + PDFs de la carta
_unused/                         → archivos huérfanos archivados, ignorado por git (ver docs/IMAGENES.md)
docs/                            → documentación de contexto de este proyecto
```

Los 4 nombres de página son kebab-case en minúsculas sin espacios ni tildes a propósito — son nombres de archivo que terminan siendo URLs públicas.

## Convenciones de código

- **Sin estilos inline.** Todo el CSS vive en `css/`. `base.css` tiene lo compartido (colores/tipografía como custom properties en `:root`, el botón flotante de WhatsApp, el footer, los íconos sociales, el link "← Volver"); cada página tiene su propio archivo para lo que le es exclusivo (hero, grillas, animaciones específicas). Si agregás una página nueva, seguí el mismo patrón: un `css/<nombre-de-la-página>.css` propio + `css/base.css`.
- **Hover en CSS real.** Los estados hover son `:hover` normales sobre clases (`.nav-card:hover`, `.social-icon:hover`, etc.) — no hay ningún mecanismo especial de por medio.
- **Atributos booleanos normales.** `<video controls autoplay muted loop playsinline>` — atributos HTML estándar, sin `="{{true}}"` ni nada parecido (eso era una particularidad del compilador viejo, ya no aplica).
- **Elementos vacíos (`<img>`) sin etiqueta de cierre** — `<img src="..." alt="">`, no `<img ...></img>`.

## Navegación entre páginas

Enlaces relativos directos entre las 4 páginas (sin router): Home → las otras 3; cada subpágina tiene un link "← Volver" a Home (`index.html`) y links cruzados (p. ej. "Ver el menú completo" desde "Que es una tapioca").

## Diseño visual (el sitio NO sigue el sistema `_ds/organic`, que ya no existe en el repo)

Todo el estilo está en `css/` con su propia paleta (no hay ningún design system externo):

- Fondo cálido: `#f0e2c6` / `#f2e5cf` (crema), `#17110d` / `#1d1610` (marrón oscuro, hero)
- Acento principal: `#c1502e` (terracota)
- Acento secundario: `#56633f` / `#33361f` (verde salvia oscuro)
- Tipografía: **Oswald** (overlines, mayúsculas, tracking amplio) + **Figtree** (título del hero de home) + **Poppins** (cuerpo de las subpáginas), cargadas por Google Fonts (`<link>` en cada `<head>`).

Estos valores están como custom properties en `css/base.css` (`--color-terracota`, `--font-heading`, etc.) — usar esas variables antes que hardcodear un hex nuevo.

## Contenido

No quedan huecos de contenido conocidos: `donde-encontrarnos.html` tiene las 4 fotos del FoodTruck del Lolog completas, `que-es-una-tapioca.html` tiene el video (`assets/como-se-hace-una-tapioca.mp4`) completo — ver [docs/IMAGENES.md](docs/IMAGENES.md#video) para cómo se comprimió — y ya no tiene la sección de fotos placeholder que tenía antes (se quitó, ver [docs/PAGINAS.md](docs/PAGINAS.md)).

## Imágenes y SEO

Ver [docs/IMAGENES.md](docs/IMAGENES.md) para el inventario completo, qué imágenes usa cada página y el estado de optimización (objetivo: ≤100KB por imagen para SEO/performance). Cada página ya tiene `<title>`, `meta description` y Open Graph básicos en su `<head>` — al agregar una página nueva, replicar ese bloque con contenido propio.

## Deploy / producción

Ver [docs/DEPLOY.md](docs/DEPLOY.md) — checklist de qué se hizo para dejar el sitio listo para hosting estático y qué falta definir (dominio/host elegido, sitemap.xml, canonical/og:url absolutos).

## Ver también

- [docs/PAGINAS.md](docs/PAGINAS.md) — contenido y estructura de cada página.
