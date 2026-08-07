# Imágenes — inventario y optimización SEO

Objetivo: toda imagen servida por el sitio pesa **≤100KB** para priorizar velocidad de carga y SEO (Core Web Vitals / LCP). Optimización realizada el 2026-08-06 con **ImageMagick 7.1.2** (instalado vía `winget install ImageMagick.ImageMagick` — no estaba disponible en el sistema antes de esta tarea).

## Imágenes usadas por el sitio (todas ≤100KB)

| Archivo | Página(s) | Uso | Antes | Después |
| --- | --- | --- | --- | --- |
| `assets/menu-hero.jpg` *(antes `.png`)* | Menu | Fondo header carta | 3520KB | 96KB |
| `uploads/fondo_principal_tapio_h.webp` | Home, Donde encontrarnos, Que es una tapioca | Fondo hero compartido | 768KB | 92KB |
| `uploads/fondo_tapio_inf_der.webp` | Home, Menu, Donde encontrarnos, Que es una tapioca | Decoración footer (der.) | 248KB | 36KB |
| `uploads/fondo_tapio_inf_izq.webp` | Home, Menu, Donde encontrarnos, Que es una tapioca | Decoración footer (izq.) | 168KB | 32KB |
| `uploads/BEBIDAS A4 IMPRESION.png` | Home | Emblema circular hero | 80KB | 80KB *(ya estaba bajo el objetivo, sin cambios)* |
| `uploads/tapioca_dibujo.webp` | Que es una tapioca | Ilustración hero | 32KB | 32KB *(ya estaba bajo el objetivo, sin cambios)* |
| `uploads/DSC_0010.jpg` | Que es una tapioca | Foto "Torrejitas de cebolla" | 1684KB | 96KB |
| `uploads/DSC_0025.jpg` | Que es una tapioca | Foto "Coliflor manchurian" | 1408KB | 96KB |
| `uploads/DSC_0035.jpg` | Que es una tapioca | Foto "Salchipapa" | 1212KB | 96KB |
| `uploads/DSC_0056.jpg` | Que es una tapioca | Foto "Birra tirada" | 1644KB | 96KB |
| `uploads/resto_bar (1).jpg` … `(9).jpg` | Donde encontrarnos | Galería crossfade Resto Bar | 1528–2876KB c/u | 96–100KB c/u |

**Peso total de imágenes servidas por el sitio:** ~16.8MB → **~1.06MB** (–94%).

## Cómo se optimizó (para repetir el proceso con fotos nuevas)

Comando base para fotos JPG (producto, galería):

```
magick entrada.jpg -strip -resize "1400x1400>" -sampling-factor 4:2:0 -define jpeg:extent=100KB -quality 85 salida.jpg
```

- `-strip` quita metadata EXIF/color profile (no aporta al usuario final, sí al peso).
- `-resize "1400x1400>"` limita el lado más largo a 1400px sin agrandar imágenes ya chicas (el `>` es clave: evita upscaling).
- `-define jpeg:extent=100KB` hace que ImageMagick ajuste la calidad JPEG de forma iterativa hasta caber en el objetivo de tamaño, en vez de fijar una calidad a ciegas.

Para WebP (fondos/decoración), `jpeg:extent` no aplica — el ajuste de tamaño se hizo a mano probando `-quality` (70-72 dio buen equilibrio calidad/peso para el fondo hero) más `-resize`.

`assets/menu-hero.png` se convirtió a `.jpg` (y se actualizó la referencia en `menu.dc.html`) porque era una fotografía opaca sin transparencia real (`%[opaque]=True` pese a tener canal alfa) — PNG es un formato pobre para fotos comprimidas a ≤100KB manteniendo calidad aceptable; JPEG rinde muchísimo mejor ahí. El resto de los `.png`/`.webp` se mantuvo en su formato original porque ya cumplía el objetivo o transportaba transparencia real usada en el diseño.

Antes de instalar ImageMagick se comprobó que PowerShell/`System.Drawing` (.NET) no puede decodificar `.webp` — de ahí la necesidad de instalar una herramienta externa.

## Imágenes fuera de este objetivo (no tocadas)

- `screenshots/*.png` (6 archivos, 24-32KB c/u): capturas de la propia herramienta de diseño, no referenciadas por ningún `.dc.html` — no forman parte de lo que se sirve al visitante.

## Archivos huérfanos archivados en `_unused/`

Estos archivos **no están referenciados en ningún `.dc.html`** — no afectan el sitio publicado ni el SEO, pero se movieron fuera de `uploads/`/`assets/` para no confundirlos con los activos reales del sitio. Se conservan por si sirven de respaldo/fuente:

| Archivo | Motivo |
| --- | --- |
| `_unused/menu_pages/p1_1.png` … `p4_4.png` (4 archivos, ~13.4MB) | Parecen ser páginas del PDF de la carta exportadas a imagen; sin uso en el sitio (la carta vive como HTML en `menu.dc.html`). |
| `_unused/uploads/pasted-1786058049081-0.png` | Imagen pegada sin uso identificado. |
| `_unused/uploads/BEBIDAS A4 IMPRESION (1).png`, `(2).png`, `.jpg` | Variantes/duplicados del emblema; solo `uploads/BEBIDAS A4 IMPRESION.png` (sin sufijo) está en uso. |
| `_unused/assets/menu-hero.png` | Versión original sin comprimir, reemplazada por `assets/menu-hero.jpg` (ver tabla arriba). |

No tocados (fuera del alcance de esta limpieza, no son imágenes): `uploads/menu.pdf`, `uploads/Menú • La Tapioquería.pdf`, `uploads/Menú • La Tapioquería-5e170f0a.pdf` — tres PDFs de la carta, tampoco referenciados en el sitio, aparentemente redundantes entre sí.

## Pendiente / fuera de alcance de esta tarea

- Los 3 `<image-slot>` de `que-es-una-tapioca.dc.html` y los 4 de `donde-encontrarnos.dc.html` siguen vacíos (ver [PAGINAS.md](PAGINAS.md)) — cuando se carguen esas fotos, aplicar el mismo proceso de compresión antes de subirlas.
