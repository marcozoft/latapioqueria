# Imágenes y video — inventario y optimización SEO

Objetivo: toda imagen servida por el sitio pesa **≤100KB** para priorizar velocidad de carga y SEO (Core Web Vitals / LCP). Optimización de imágenes realizada el 2026-08-06 con **ImageMagick 7.1.2** (instalado vía `winget install ImageMagick.ImageMagick` — no estaba disponible en el sistema antes de esta tarea). El único video del sitio se comprimió el 2026-08-07 con **FFmpeg** (ver [Video](#video) más abajo).

## Imágenes usadas por el sitio (todas ≤100KB)

| Archivo | Página(s) | Uso | Antes | Después |
| --- | --- | --- | --- | --- |
| `assets/mural/mural_sombra.webp` / `mural_sombra_mb.webp` | Home, Menu, Donde encontrarnos, Que es una tapioca | Fondo de los 4 heros (mural) | — | 18KB / 30KB |
| `assets/mural/mural_sombra2.webp` | Home, Menu, Donde encontrarnos, Que es una tapioca | Fondo footer (mural) | — | 38KB |
| `assets/mural/mural_centro.webp` / `mural_derecho.webp` | Los 4 heros + los 4 footers (más chicas) | Plantas del mural a los costados | — | 61KB / 55KB |
| `uploads/tapioca_dibujo.webp` | Que es una tapioca | Ilustración hero | 32KB | 32KB *(ya estaba bajo el objetivo, sin cambios)* |
| `uploads/DSC_0010.jpg` | Que es una tapioca | Foto "Torrejitas de cebolla" | 1684KB | 96KB |
| `uploads/coliflor.webp` | Que es una tapioca | Foto "Coliflor manchurian" | 1408KB | 96KB |
| `uploads/DSC_0035.jpg` | Que es una tapioca | Foto "Salchipapa" | 1212KB | 96KB |
| `uploads/DSC_0056.jpg` | Que es una tapioca | Foto "Birra tirada" | 1644KB | 96KB |
| `uploads/resto_bar (1).jpg` … `(9).jpg` | Donde encontrarnos | Galería crossfade Resto Bar | 1528–2876KB c/u | 96–100KB c/u |
| `uploads/lolog-1.jpg` … `lolog-4.jpg` | Donde encontrarnos | Galería crossfade FoodTruck Lolog | 980KB–4.4MB c/u *(`.HEIC`)* | 96KB c/u *(`.jpg`)* |

**Peso total de imágenes servidas por el sitio:** ~25.9MB → **~1.44MB** (–94%).

## Cómo se optimizó (para repetir el proceso con fotos nuevas)

Comando base para fotos JPG (producto, galería):

```
magick entrada.jpg -strip -resize "1400x1400>" -sampling-factor 4:2:0 -define jpeg:extent=100KB -quality 85 salida.jpg
```

- `-strip` quita metadata EXIF/color profile (no aporta al usuario final, sí al peso).
- `-resize "1400x1400>"` limita el lado más largo a 1400px sin agrandar imágenes ya chicas (el `>` es clave: evita upscaling).
- `-define jpeg:extent=100KB` hace que ImageMagick ajuste la calidad JPEG de forma iterativa hasta caber en el objetivo de tamaño, en vez de fijar una calidad a ciegas.

Para WebP (fondos/decoración), `jpeg:extent` no aplica — el ajuste de tamaño se hizo a mano probando `-quality` (70-72 dio buen equilibrio calidad/peso para el fondo hero) más `-resize`.

`assets/menu-hero.png` se convirtió a `.jpg` (y se actualizó la referencia en `menu.html`) porque era una fotografía opaca sin transparencia real (`%[opaque]=True` pese a tener canal alfa) — PNG es un formato pobre para fotos comprimidas a ≤100KB manteniendo calidad aceptable; JPEG rinde muchísimo mejor ahí. El resto de los `.png`/`.webp` se mantuvo en su formato original porque ya cumplía el objetivo o transportaba transparencia real usada en el diseño.

Antes de instalar ImageMagick se comprobó que PowerShell/`System.Drawing` (.NET) no puede decodificar `.webp` — de ahí la necesidad de instalar una herramienta externa.

Las 4 fotos del FoodTruck Lolog llegaron como `.HEIC` (formato nativo de iPhone) — **ningún navegador de escritorio ni Android lo soporta**, así que además de comprimirlas hubo que convertirlas a `.jpg`. El comando fue el mismo de arriba sumando `-auto-orient` antes de `-strip`: las HEIC de iPhone traen la imagen guardada "de costado" con un tag EXIF que indica cuánto rotarla al mostrarla, y `-strip` borra ese tag — sin `-auto-orient` primero, las 4 fotos se habrían guardado giradas 90°.

## Video

`assets/como-se-hace-una-tapioca.mp4` (sección "Cómo se hace" de `que-es-una-tapioca.html`) llegó como un archivo de **42MB**: 1080×1920 (vertical, formato teléfono), H.264 a ~12.2 Mbps, 27.5s, con audio AAC. Insostenible para web. Quedó en **4.1MB (–90%)** así:

```
ffmpeg -i entrada.mp4 -vf "scale=720:1280" \
  -c:v libx264 -preset slow -crf 26 -pix_fmt yuv420p \
  -c:a aac -b:a 96k -ac 2 -movflags +faststart salida.mp4
```

- **Se mantiene el formato vertical original** (9:16) — la primera versión lo recortaba a 16:9 para que coincidiera con una caja horizontal, pero eso rompía el encuadre pensado por quien filmó el video. El contenedor en `que-es-una-tapioca.html` se adaptó al video en vez de al revés: `aspect-ratio:9/16` con `width:min(100%,400px)`, centrado — mismo patrón que la galería vertical del FoodTruck Lolog en `donde-encontrarnos.html`.
- **`scale=720:1280`** — el contenido nunca se muestra a más de 400px de ancho en CSS (~800px a 2x retina), así que 720px de ancho alcanza de sobra sin perder nitidez; se preserva la proporción 9:16 exacta del original, sin distorsión.
- **`-crf 26 -preset slow`** — calidad constante orientada a tamaño (no a un bitrate fijo); `slow` gasta más tiempo de encode a cambio de mejor relación calidad/peso. Verificado visualmente extrayendo frames en varios segundos del clip (incluye un cartel con texto, legible sin artefactos).
- **`-movflags +faststart`** — mueve el índice del MP4 (`moov atom`) al principio del archivo para que el video pueda empezar a reproducirse antes de descargarse completo (necesario para servir desde cualquier host estático, sin esto el navegador a veces debe bajar todo el archivo primero).
- El audio original venía a 125kbps; bajó a 96kbps AAC estéreo, imperceptible en este contenido.

También se generó `uploads/tapioca-video-poster.jpg` (88KB, 720×1280) — un frame del propio video, usado como `poster` del `<video>` para que se vea una miniatura real en vez de un cuadro negro antes de reproducir. De paso se sacó el overlay placeholder ("Video: assets/como-se-hace-una-tapioca.mp4" con ícono de play) que tapaba el video real una vez cargado — era un recordatorio visual del editor de diseño para cuando el slot estaba vacío, ya no aplica.

El video autoreproduce en loop y silenciado (`autoplay muted loop`, más `controls` para que se pueda pausar o activar el audio) — los navegadores bloquean el autoplay con sonido, por eso `muted` es obligatorio para que `autoplay` funcione. Son atributos booleanos HTML estándar (`<video controls autoplay muted loop playsinline>`), sin ninguna sintaxis especial.

FFmpeg tampoco estaba instalado (se agregó vía `winget install Gyan.FFmpeg`, mismo criterio que ImageMagick para las imágenes).

## Imágenes fuera de este objetivo (no tocadas)

- `screenshots/*.png` (6 archivos, 24-32KB c/u): capturas de la propia herramienta de diseño, no referenciadas por ninguna página — no forman parte de lo que se sirve al visitante.

## Archivos huérfanos archivados en `_unused/`

Estos archivos **no están referenciados en ninguna página** — no afectan el sitio publicado ni el SEO, pero se movieron fuera de `uploads/`/`assets/` para no confundirlos con los activos reales del sitio. Se conservan por si sirven de respaldo/fuente:

| Archivo | Motivo |
| --- | --- |
| `_unused/menu_pages/p1_1.png` … `p4_4.png` (4 archivos, ~13.4MB) | Parecen ser páginas del PDF de la carta exportadas a imagen; sin uso en el sitio (la carta vive como HTML en `menu.html`). |
| `_unused/uploads/pasted-1786058049081-0.png` | Imagen pegada sin uso identificado. |
| `_unused/uploads/BEBIDAS A4 IMPRESION.png`, `(1).png`, `(2).png`, `.jpg` | Escaneo de la carta de bebidas impresa; se usó como `og:image` de Home y Menú hasta el 2026-09-18, cuando se reemplazó por `uploads/tapi_lomo.webp` (foto real del plato en vez de un escaneo) — quedó sin ningún uso en el sitio. |
| `_unused/assets/menu-hero.png` | Versión original sin comprimir, reemplazada por `assets/menu-hero.jpg` (ver tabla arriba). |
| `_unused/uploads/lolog (1-4).HEIC` | Originales sin comprimir de las fotos del FoodTruck Lolog, reemplazadas por `uploads/lolog-1.jpg` … `lolog-4.jpg` (ver tabla arriba). |
| `_unused/assets/como_se_hace_una_tapioca.mp4` | Video original sin comprimir (42MB), reemplazado por `assets/como-se-hace-una-tapioca.mp4` (ver sección [Video](#video)). |
| `_unused/uploads/fondo_tapio_inf_der.webp`, `fondo_tapio_inf_izq.webp` | Decoración de footer anterior; el footer ahora usa el mismo mural que el hero (`assets/mural/mural_sombra2.webp` + `mural_centro.webp`/`mural_derecho.webp`, ver tabla arriba). |
| `_unused/uploads/fondo_principal_tapio_h.webp` | Fondo anterior (foto oscurecida) de los heros de Donde encontrarnos y Que es una tapioca; ambos pasaron a usar el mismo mural que el hero de Home/Menu (ver tabla arriba). |
| `_unused/assets/menu-hero.jpg` | Fondo anterior del header de Menu, de cuando esa página tenía un header con foto propia en vez del hero tipo mural que comparte con el resto del sitio. |
| `_unused/assets/702142585…jpg`, `702179465…jpg`, `702676893…jpg`, `704467917…jpg`, `704565057…jpg` (5 archivos) | Fotos exportadas de Instagram (nombres de archivo típicos de esa plataforma), sin uso en ninguna página — quedaron sueltas en `assets/`. |
| `_unused/assets/Gemini_Generated_Image_*.jpg` (2 archivos) | Imágenes generadas con IA, sin uso en ninguna página. |
| `_unused/assets/fondo_hero_mural.png`, `.webp` | Candidatos de fondo de hero de una iteración anterior; el hero terminó usando `assets/mural/mural_sombra.webp` en su lugar. |
| `_unused/uploads/DSC_0043.jpg` | Foto de producto sin uso identificado en ninguna página. |
| `_unused/uploads/salchipapa.jpg` | Versión sin optimizar de la foto de Salchipapa; el sitio usa `uploads/salchipapa.webp`. |
| `_unused/assets/mural/mural_sombra.png` (1.4MB), `mural_sombra2.png` (1.6MB) | Originales sin comprimir del mural usado en los heros/footer; el sitio usa `assets/mural/mural_sombra.webp` / `mural_sombra2.webp` (18-38KB). |

No tocados (fuera del alcance de esta limpieza, no son imágenes): `uploads/menu.pdf`, `uploads/Menú • La Tapioquería.pdf`, `uploads/Menú • La Tapioquería-5e170f0a.pdf` — tres PDFs de la carta, tampoco referenciados en el sitio, aparentemente redundantes entre sí.

## Favicon / ícono de la app (agregado 2026-09-18, reemplazado 2026-09-25)

El sitio no tenía favicon (404 en las 4 páginas, confirmado con Playwright). Se creó `assets/favicon.svg` (monograma "T" en terracota sobre círculo, dibujado a mano en SVG — placeholder de marca hasta tener un isotipo real) y sus variantes rasterizadas.

**2026-09-25**: reemplazado por la ilustración de la tapioca (`assets/tapio_dibujo.jpg`, línea terracota sobre fondo crema, la misma que ya se usaba en el hero de "Qué es una tapioca") a pedido del dueño del sitio. Ya no hay favicon en SVG (`assets/favicon.svg` se archivó en `_unused/favicon-monograma-T.svg` — la fuente ahora es un JPG, no un vector, así que no tiene sentido seguir declarando un `<link rel="icon" type="image/svg+xml">`). Generados con Node (`sharp`, `fit:'contain'` sobre fondo `rgb(255,253,240)` para no dejar una costura visible con el fondo casi blanco de la imagen fuente) + `png-to-ico`:

| Archivo | Tamaño | Uso |
| --- | --- | --- |
| `favicon.ico` (raíz) | 16/32/48px multi-resolución | `<link rel="icon" href="/favicon.ico">` — compatibilidad con navegadores viejos y el `/favicon.ico` que algunos piden solos |
| `assets/favicon-16.png` / `favicon-32.png` | 16×16 / 32×32 | ícono de pestaña |
| `assets/apple-touch-icon.png` | 180×180 | iOS "agregar a inicio" |
| `assets/icon-192.png` / `icon-512.png` | 192×192 / 512×512 | `site.webmanifest` (PWA/Android) |

A tamaños chicos (16-32px) el dibujo se ve como una forma redondeada terracota reconocible como taco/tapioca, no legible en detalle — es la naturaleza de reducir una ilustración con líneas finas a ese tamaño, no un error de generación.

## Imagen de vista previa al compartir (og:image, agregado 2026-09-25)

Antes cada página usaba una foto de producto distinta como `og:image` (la que se ve al pegar el link en WhatsApp/redes). Ahora **las 4 páginas usan la misma imagen de marca**: `assets/og-tapioca.jpg` (1200×1200, la ilustración de la tapioca centrada sobre fondo crema, generada de la misma fuente `assets/tapio_dibujo.jpg` que el favicon, con `og:image:width`/`og:image:height` declarados). Se eligió cuadrada (1:1) en vez del clásico 1200×630 porque la ilustración fuente es casi cuadrada (382×419) — meterla en un rectángulo 1.91:1 hubiera dejado franjas vacías grandes a los costados. El JSON-LD de cada página **no** cambió: `image` ahí sigue siendo la foto real de producto/local (Google prefiere fotos reales para resultados enriquecidos, no un ícono de marca).

## Compresión de imágenes en `<img>` (agregado 2026-09-18)

Las imágenes que están fuera del viewport inicial (galerías de `donde-encontrarnos.html`, fotos de Resto·Bar y del lightbox de `menu.html`, footer de las 4 páginas) tienen `loading="lazy"`. Las imágenes del hero de cada página (mural + plantas) se dejaron sin ese atributo a propósito, porque son la imagen LCP (Largest Contentful Paint) y lazy-loadearla empeoraría esa métrica en vez de mejorarla.

## Códigos QR (agregado 2026-09-24)

Página nueva `qr.html` (ver [PAGINAS.md](PAGINAS.md#qrhtml--códigos-qr-2026-09-24)) con un QR por sección del sitio, guardados en `assets/qr/`: `qr-home.webp`, `qr-menu.webp`, `qr-donde-encontrarnos.webp`, `qr-que-es-una-tapioca.webp` y `qr-resena-google.webp` (agregado 2026-09-24, apunta al link de "escribir reseña" de la ficha de Google del local) — ~20KB c/u, 900×900px, WebP **lossless** a propósito — un WebP con pérdida podría introducir artefactos que arruinen la lectura del código. Generados con Node (`qrcode` + `sharp`, error correction level `H`) a partir de las URLs limpias del sitio (`latapioqueria.com.ar/menu`, etc., o la URL de Google en el caso de la reseña) y con el logo `uploads/tapioca_dibujo.webp` superpuesto al centro sobre un fondo redondeado; se verificó que decodifican bien con `jsQR` pese al logo. No dependen de ningún servicio externo (no vencen, no requieren suscripción) — si se necesita regenerarlos (por ejemplo si cambia el dominio) hay que repetir el mismo proceso a mano, no hay un script versionado en el repo para esto.

## Pendiente / fuera de alcance de esta tarea

- La sección de 3 fotos placeholder que tenía `que-es-una-tapioca.html` se quitó (2026-09-18, a pedido del dueño del sitio, en vez de completarla con fotos reales). La galería de `donde-encontrarnos.html` y el video de "Cómo se hace" ya se completaron (2026-08-06 y 2026-08-07 respectivamente).
