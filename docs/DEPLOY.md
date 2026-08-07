# Deploy / producción

Estado al 2026-08-06. El sitio es **100% estático** (HTML + CSS inline + JS que corre en el navegador) — no necesita build ni servidor con backend. Cualquier host de archivos estáticos sirve el proyecto tal cual, subiendo la carpeta completa (menos `_unused/`, ver `.gitignore`).

## Qué se dejó listo

- **`index.html` en la raíz**: redirige (meta-refresh + `location.replace`) a `inicio.dc.html`. Existe porque la home real se mantiene como `inicio.dc.html` (ver más abajo el porqué) y casi todo host estático sirve automáticamente el archivo literal `index.html` cuando alguien visita `/` — sin este redirect, la raíz del dominio quedaría en blanco.
- **`robots.txt`**: permite indexar todo el sitio (`Allow: /`).
- **4 páginas con nombres de archivo limpios** (`inicio.dc.html`, `menu.dc.html`, `donde-encontrarnos.dc.html`, `que-es-una-tapioca.dc.html`): minúsculas, sin espacios ni tildes, kebab-case — son URLs públicas, y los espacios/tildes en URLs generan problemas de encoding y links rotos.
- **`<title>` + `meta description` + Open Graph básico** en las 4 páginas (antes no existía ninguno — cada pestaña del navegador y cada resultado de búsqueda mostraban vacío).
- **`lang="es"`** en el `<html>` de las 4 páginas.
- **Link "← Volver" corregido**: apuntaba a un nombre de archivo con guion largo (`—`) que no coincidía con el archivo real (guion normal) — estaba roto en las 3 subpáginas, ya arreglado de paso al renombrar.
- **Imágenes optimizadas** a ≤100KB (ver [IMAGENES.md](IMAGENES.md)).

## Por qué la home no se llama directamente `index.html`

Se decidió mantener la extensión `.dc.html` en las 4 páginas para poder seguir editándolas visualmente desde Claude Design (DesignSync reconoce archivos por esa extensión). Eso significa que la home no puede llamarse `index.html` sin perder esa edición visual — de ahí el redirect. Es la solución más simple y funciona en cualquier host sin configuración adicional, pero tiene una desventaja menor: un buscador que indexe `/` ve técnicamente una redirección en vez del contenido directo (impacto de SEO bajo, pero no nulo).

**Cuando se elija el host de producción**, si ese host soporta reglas de rewrite a nivel de servidor, reemplazar el redirect por una regla real mejora esto:
- **Netlify**: archivo `_redirects` con `/  /inicio.dc.html  200` (rewrite, no redirect — sirve el contenido directamente en `/`).
- **Vercel**: `vercel.json` con un `rewrite` equivalente.
- **Apache (hosting/cPanel tradicional)**: `DirectoryIndex inicio.dc.html` en `.htaccess`.
- **Nginx**: `try_files` / `index inicio.dc.html;` en la config del server block.
- **GitHub Pages**: no soporta rewrites a nivel servidor — ahí el `index.html` redirect actual es la mejor opción disponible.

## Pendiente (requiere decisiones que todavía no están tomadas)

- **Elegir el host/dominio final.** Hoy no hay uno definido, así que no se agregó configuración específica de ningún proveedor (Netlify `_redirects`, Vercel `vercel.json`, etc.) — ver arriba qué agregar según el host elegido.
- **`sitemap.xml`**: no se creó porque requiere URLs absolutas (`https://dominio.com/...`) y todavía no hay dominio. Una vez que se defina, generar uno con las 4 páginas y referenciarlo desde `robots.txt` (`Sitemap: https://dominio.com/sitemap.xml`).
- **`og:url` y `<link rel="canonical">` absolutos**: por la misma razón (falta dominio), las etiquetas Open Graph de cada página no incluyen `og:url` ni hay `canonical` — agregarlos cuando el dominio esté decidido.
- **Contenido faltante** (no es un tema de deploy, pero bloquea que el sitio se vea completo en prod): video de "cómo se hace una tapioca" y las 7 fotos en `<image-slot>` vacíos — ver [../CLAUDE.md](../CLAUDE.md#huecos-de-contenido-conocidos).

## Cómo probar el sitio localmente antes de subirlo

Los `.dc.html` cargan React/ReactDOM desde un CDN (unpkg) en tiempo de ejecución, así que hace falta conexión a internet incluso en local. Para servir la carpeta:

```
npx serve .
```

o cualquier servidor estático equivalente (Python `http.server`, la extensión "Live Server" de VS Code, etc.) — abrir `http://localhost:PUERTO/` debería redirigir a `inicio.dc.html` y navegar el sitio completo.
