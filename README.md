<div align="center">

# 🫓 La Tapioquería

**Tapiocas brasileñas, açaí y tragos — San Martín de los Andes, Argentina**

![Hero de La Tapioquería](screenshots/cover.png)

</div>

Sitio web de **La Tapioquería**, resto bar de tapiocas brasileñas en Belgrano 940, San Martín de los Andes. Cuatro páginas — inicio, carta, ubicaciones y la historia del producto — construidas visualmente en **Claude Design**, sin build ni framework: HTML servido tal cual, con estilos inline y un runtime liviano que corre en el navegador.

## ✨ Trabajo realizado

Este repo arrancó como una exportación directa de la herramienta de diseño: imágenes de varios MB sin optimizar, nombres de archivo con espacios y tildes, cero metadata SEO y un link interno roto. Quedó así:

| Antes | Después |
| --- | --- |
| Imágenes del sitio pesaban hasta **3.5MB cada una** (~25.9MB en total) | Todas optimizadas a **≤100KB** (~1.44MB en total) → **‑94%** |
| El video de "Cómo se hace" pesaba **42MB** (vertical, sin comprimir) | Comprimido a **4.1MB** (‑90%) manteniendo su formato vertical original, con contenedor y poster propios |
| Sin `<title>`, `meta description` ni Open Graph en ninguna página | Las 4 páginas con SEO on-page completo (`title`, `description`, `og:*`, `lang="es"`) |
| Nombres de archivo con espacios y tildes (`"Donde encontrarnos.dc.html"`) | Kebab-case limpio (`donde-encontrarnos.dc.html`) — URLs estables y sin problemas de encoding |
| El link **"← Volver"** apuntaba a un nombre de archivo con guion largo (`—`) que no coincidía con el archivo real | Corregido — el link funcionaba mal en las 3 subpáginas y nadie lo había notado |
| Sin redes sociales ni contacto directo (solo un link de texto a Instagram en 2 de 4 páginas) | Instagram, Facebook y WhatsApp en el footer de las 4 páginas + botón flotante de WhatsApp |
| Huecos de contenido: 7 `<image-slot>` vacíos y un `<video>` sin fuente | Las 4 fotos del FoodTruck Lolog y el video ya están cargados; quedan 3 slots en "Qué es una tapioca" |
| ~14MB de archivos huérfanos mezclados con los assets reales del sitio | Archivados en `_unused/` (fuera del repo, en `.gitignore`) |
| Sin repo, sin punto de entrada para hosting estático | Git inicializado + `index.html` + `robots.txt`, listo para desplegar en cualquier host estático |

Detalle completo de cada punto en [`docs/`](docs/).

## 🗺️ Páginas

| Página | Contenido |
| --- | --- |
| [`inicio.dc.html`](inicio.dc.html) | Hero, acceso a las otras 3 secciones |
| [`menu.dc.html`](menu.dc.html) | Carta completa con precios (tapiocas, para picar, papas, platos) |
| [`donde-encontrarnos.dc.html`](donde-encontrarnos.dc.html) | Resto Bar (todo el año) + FoodTruck en el Lago Lolog (verano) |
| [`que-es-una-tapioca.dc.html`](que-es-una-tapioca.dc.html) | Qué es una tapioca, origen brasileño, cómo se hace |

<div align="center">
<img src="screenshots/footer4.png" alt="Footer del sitio" width="640">
</div>

## 🧱 Stack

Páginas `.dc.html` (formato nativo de Claude Design): una etiqueta `<x-dc>` con un `<helmet>` interno equivalente al `<head>`, compilada a React en el navegador vía `support.js`. Sin paso de build, sin `package.json` — se sirve como archivos estáticos. Detalle completo en [`CLAUDE.md`](CLAUDE.md).

## 📚 Documentación

- [`CLAUDE.md`](CLAUDE.md) — arquitectura del proyecto, convenciones, huecos de contenido conocidos.
- [`docs/PAGINAS.md`](docs/PAGINAS.md) — contenido y estructura de cada página.
- [`docs/IMAGENES.md`](docs/IMAGENES.md) — inventario de imágenes y video, método de optimización y resultados.
- [`docs/DEPLOY.md`](docs/DEPLOY.md) — checklist de qué está listo para producción y qué falta definir (host, sitemap, canonical).

## 🚀 Correrlo local

Es 100% estático, pero carga React desde CDN en tiempo de ejecución, así que hace falta conexión a internet incluso en local:

```bash
npx serve .
```

Abrir `http://localhost:PUERTO/` — redirige automáticamente a `inicio.dc.html`.

---

<div align="center">
<sub>📍 Belgrano 940, San Martín de los Andes · <a href="https://www.instagram.com/latapioqueria.sma">@latapioqueria.sma</a></sub>
</div>
