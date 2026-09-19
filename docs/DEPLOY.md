# Deploy / producción

Estado al 2026-09-18. El sitio es **100% estático** (HTML + CSS + `<video>`/animaciones CSS) — no necesita build ni servidor con backend, ni conexión a un CDN externo en tiempo de ejecución. Cualquier host de archivos estáticos sirve el proyecto tal cual, subiendo la carpeta completa (menos `_unused/`, ver `.gitignore`).

## Qué se dejó listo

- **`index.html` en la raíz es la home real** (no un redirect): contiene el hero, la navegación a las otras 3 secciones y el footer directamente. Cualquier host estático sirve `index.html` automáticamente al visitar `/`, sin configuración adicional.
- **`robots.txt`**: permite indexar todo el sitio (`Allow: /`).
- **4 páginas con nombres de archivo limpios** (`index.html`, `menu.html`, `donde-encontrarnos.html`, `que-es-una-tapioca.html`): minúsculas, sin espacios ni tildes, kebab-case.
- **`<title>` + `meta description` + Open Graph básico** en las 4 páginas.
- **`lang="es"`** en el `<html>` de las 4 páginas.
- **Imágenes optimizadas** a ≤100KB (ver [IMAGENES.md](IMAGENES.md)).
- **CSS externo** en `css/` (uno compartido + uno por página) — nada de estilos inline ni de mecanismos de compilador propietario.
- **SEO técnico/on-page completo (2026-09-18)**:
  - **Datos estructurados JSON-LD** en las 4 páginas: `Restaurant` (nombre, dirección, teléfono, redes) en todas; `Menu`/`MenuSection`/`MenuItem` completo con los ~74 ítems de la carta (precios incluidos en Comidas) en `menu.html`; dos `FoodEstablishment` (Resto Bar + FoodTruck) en `donde-encontrarnos.html`; `Article` en `que-es-una-tapioca.html`; `BreadcrumbList` en las 3 subpáginas.
  - **Jerarquía de encabezados real en `menu.html`**: antes no tenía ningún `<h1>`/`<h2>` (todo eran `<span>`); ahora tiene un `<h1>` accesible (oculto visualmente con la clase `.sr-only` de `base.css`, no cambia el diseño) y cada sección/subsección de la carta es un `<h2>`/`<h3>` real.
  - **Favicon + manifest**: no existía ninguno (404 en todas las páginas, confirmado con Playwright). Se creó `assets/favicon.svg` (monograma "T" en terracota) + variantes PNG (`favicon-32.png`, `apple-touch-icon.png`, `icon-192.png`, `icon-512.png`) y `site.webmanifest`, enlazados en las 4 páginas junto con `<meta name="theme-color">`.
  - **`og:image` corregido** en Home y Menú: usaban un escaneo de la carta de bebidas (`BEBIDAS A4 IMPRESION.png`) como imagen de previsualización al compartir el link; ahora usan `uploads/tapi_lomo.webp` (foto real y apetitosa del plato insignia).
  - **`loading="lazy"`** en las imágenes fuera del viewport inicial (galerías de `donde-encontrarnos.html`, fotos de Resto·Bar y lightbox de `menu.html`, footer de las 4 páginas) para mejorar Core Web Vitals — las imágenes del hero (LCP) se dejaron sin lazy a propósito.
  - **Dominio confirmado (2026-09-18): `latapioqueria.com.ar`.** Con ese dato ya se agregó `<link rel="canonical">` + `og:url` absolutos en las 4 páginas, `og:image` pasó a ser una URL absoluta, se generó `sitemap.xml` (las 4 páginas) referenciado desde `robots.txt` (`Sitemap: https://latapioqueria.com.ar/sitemap.xml`), y todas las URLs del JSON-LD (`url`, `hasMenu`, `item` de los `BreadcrumbList`, `image`) quedaron absolutas.

## Historial: por qué antes existía un redirect

Hasta 2026-09-18 el sitio se construyó en Claude Design, que requería mantener la extensión `.dc.html` en las 4 páginas para poder seguir editándolas visualmente ahí (DesignSync reconoce archivos por esa extensión). Eso impedía que la home se llamara `index.html` directamente, así que existía un `index.html` que solo hacía un meta-refresh a `inicio.dc.html`. Al migrar el sitio a HTML/CSS convencional (ver [../CLAUDE.md](../CLAUDE.md)) esa restricción desapareció: `index.html` pasó a ser la home real y el redirect se eliminó. Ya no aplica ninguna de las notas de rewrite/DirectoryIndex que existían acá antes — no hacen falta.

## Pendiente (requiere decisiones que todavía no están tomadas)

- **Elegir el host final** (Hostinger, Vercel, Netlify, etc.) para publicar bajo `latapioqueria.com.ar` — el dominio ya está definido y todo el sitio (canonical, og:url, sitemap.xml, JSON-LD) ya apunta ahí, pero todavía no está desplegado en ningún proveedor.
- **Datos que faltan para que el JSON-LD `Restaurant` quede 100% completo** (no se inventó ninguno de estos, hay que confirmarlos con el dueño): horario de atención exacto (`openingHoursSpecification`, hoy no está en el schema) y coordenadas de geolocalización (`geo`) de Belgrano 940 — se pueden sacar del pin real de Google Maps.
- **Validar el sitio con Google Search Console + Rich Results Test** una vez publicado en el dominio final: dar de alta la propiedad, enviar `sitemap.xml`, y correr las 4 páginas por el [Rich Results Test](https://search.google.com/test/rich-results) de Google para confirmar que el JSON-LD se lee sin errores en producción (con HTTPS real, no en local).
- **Reseñas de Google + muro de Instagram en la Home** (pedido 2026-09-18, todavía sin resolver): mostrar un feed real y en vivo de cualquiera de los dos requiere sí o sí una de estas vías, no hay forma gratuita y sin configuración de lograrlo con un sitio 100% estático:
  - Widget de terceros (Elfsight, SnapWidget, etc.): cuenta gratuita del lado del dueño del sitio, conectar Instagram/Google Business, y pegar el código embed acá.
  - Google Places API para las reseñas específicamente: requiere un proyecto en Google Cloud con facturación habilitada (hay cuota gratis mensual) y una API key restringida al dominio del sitio.
  - Alternativa sin cuentas ni configuración: una sección estática con el link real a "Ver reseñas en Google" y "Seguinos en Instagram" (sin inventar reseñas ni posts, ya que fabricar testimonios falsos no es aceptable), que no se actualiza sola.
  El dueño del sitio todavía está evaluando cuál prefiere — no implementar ninguna de las tres sin confirmar.

## Cómo probar el sitio localmente antes de subirlo

Es HTML/CSS puro, sin dependencias externas en tiempo de ejecución (no hace falta internet salvo para las fuentes de Google Fonts y el video de terceros embebido en el footer). Para servir la carpeta:

```
npx serve .
```

o cualquier servidor estático equivalente (Python `python3 -m http.server`, la extensión "Live Server" de VS Code, etc.) — abrir `http://localhost:PUERTO/` muestra `index.html` directamente y desde ahí se navega el sitio completo.
