<div align="center">

# 🫓 La Tapioquería

**Tapiocas brasileñas, açaí y tragos — San Martín de los Andes, Argentina**

![Hero de La Tapioquería](screenshots/cover.png)

</div>

Sitio web de **La Tapioquería**, resto bar de tapiocas brasileñas en Belgrano 940, San Martín de los Andes. Cuatro páginas — inicio, carta, ubicaciones y la historia del producto — en **HTML + CSS estático convencional**, sin build ni framework.

## ✨ Trabajo realizado

Este repo arrancó como una exportación directa de la herramienta de diseño: imágenes de varios MB sin optimizar, nombres de archivo con espacios y tildes, cero metadata SEO y un link interno roto. Quedó así:

| Antes | Después |
| --- | --- |
| Imágenes del sitio pesaban hasta **3.5MB cada una** (~25.9MB en total) | Todas optimizadas a **≤100KB** (~1.44MB en total) → **‑94%** |
| El video de "Cómo se hace" pesaba **42MB** (vertical, sin comprimir) | Comprimido a **4.1MB** (‑90%) manteniendo su formato vertical original, con contenedor y poster propios |
| Sin `<title>`, `meta description` ni Open Graph en ninguna página | Las 4 páginas con SEO on-page completo (`title`, `description`, `og:*`, `lang="es"`, datos estructurados JSON-LD, favicon/manifest) |
| Nombres de archivo con espacios y tildes (`"Donde encontrarnos.dc.html"`) | Kebab-case limpio (`donde-encontrarnos.html`) — URLs estables y sin problemas de encoding |
| El link **"← Volver"** apuntaba a un nombre de archivo con guion largo (`—`) que no coincidía con el archivo real | Corregido — el link funcionaba mal en las 3 subpáginas y nadie lo había notado |
| Sin redes sociales ni contacto directo (solo un link de texto a Instagram en 2 de 4 páginas) | Instagram, Facebook y WhatsApp en el footer de las 4 páginas + botón flotante de WhatsApp |
| Huecos de contenido: 7 slots de imagen vacíos y un `<video>` sin fuente | Las 4 fotos del FoodTruck Lolog y el video ya están cargados; no quedan huecos de contenido |
| ~14MB de archivos huérfanos mezclados con los assets reales del sitio | Archivados en `_unused/` (fuera del repo, en `.gitignore`) |
| Sin repo, sin punto de entrada para hosting estático | Git inicializado + `index.html` como home real + `robots.txt`, listo para desplegar en cualquier host estático |
| Construido en Claude Design (`.dc.html`, estilos inline, runtime propietario) | Migrado a HTML + CSS estático convencional (`css/base.css` + un CSS por página), sin dependencias de ninguna plataforma |

Detalle completo de cada punto en [`docs/`](docs/).

## 🗺️ Páginas

| Página | Contenido |
| --- | --- |
| [`index.html`](index.html) | Hero, acceso a las otras 3 secciones |
| [`menu.html`](menu.html) | Carta completa con precios (tapiocas, para picar, papas, platos) |
| [`donde-encontrarnos.html`](donde-encontrarnos.html) | Resto Bar (todo el año) + FoodTruck en el Lago Lolog (verano) |
| [`que-es-una-tapioca.html`](que-es-una-tapioca.html) | Qué es una tapioca, origen brasileño, cómo se hace |

<div align="center">
<img src="screenshots/footer4.png" alt="Footer del sitio" width="640">
</div>

## 🧱 Stack

HTML + CSS estático convencional: 4 páginas `.html`, un `css/base.css` compartido (tokens de color/tipografía, footer, botón de WhatsApp, íconos sociales) y un CSS propio por página. Sin paso de build, sin `package.json`, sin dependencias de ninguna plataforma — se sirve como archivos estáticos en cualquier host. Detalle completo en [`CLAUDE.md`](CLAUDE.md).

## 📚 Documentación

- [`CLAUDE.md`](CLAUDE.md) — arquitectura del proyecto, convenciones, huecos de contenido conocidos.
- [`docs/PAGINAS.md`](docs/PAGINAS.md) — contenido y estructura de cada página.
- [`docs/IMAGENES.md`](docs/IMAGENES.md) — inventario de imágenes y video, método de optimización y resultados.
- [`docs/DEPLOY.md`](docs/DEPLOY.md) — checklist de qué está listo para producción y qué falta definir (host, sitemap, canonical).

## 🚀 Correrlo local

Es 100% estático, sin dependencias en tiempo de ejecución (salvo Google Fonts y un iframe de terceros en el footer):

```bash
npx serve .
```

Abrir `http://localhost:PUERTO/` — muestra `index.html` directamente.

---

<div align="center">
<sub>📍 Belgrano 940, San Martín de los Andes · <a href="https://www.instagram.com/latapioqueria.sma">@latapioqueria.sma</a></sub>
</div>
