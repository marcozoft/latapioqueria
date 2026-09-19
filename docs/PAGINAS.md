# Páginas del sitio

Contexto detallado de cada página. Ver [../CLAUDE.md](../CLAUDE.md) para la visión general del proyecto.

## `index.html` — Home

- **Hero**: fondo compuesto por capas — `assets/mural/mural_sombra.webp` (`mural_sombra_mb.webp` en mobile, vía media query en `css/inicio.css`) de fondo, y `mural_centro.webp`/`mural_derecho.webp` como flores ancladas abajo a izquierda/derecha, imitando el mural físico del local. Título "LA TAPIOQUERIA" + "RESTO & BAR" + logo `assets/sin_gluten.svg`.
- **Nav a 3 secciones** (tarjetas grandes con hover, fondo negro/marrón oscuro `var(--color-dark-brown)` en las 3 al pasar el mouse): "¿Qué es una tapioca?" → `que-es-una-tapioca.html`; "Ver el menú" → `menu.html`; "¿Dónde encontrarnos?" → `donde-encontrarnos.html`.
- **Footer** común a las 4 páginas: banners "Cocina 100% libre de gluten" / "Opciones veganas", nombre + dirección, fondo tipo mural (`assets/mural/mural_sombra2.webp` + plantas `mural_centro.webp`/`mural_derecho.webp` a los costados, más chicas que en el hero y con una capa clara encima para atenuarlas).
- **SEO**: JSON-LD `Restaurant` en el `<head>` (nombre, dirección, teléfono, redes, `hasMenu` → `menu.html`). `og:image` es `uploads/tapi_lomo.webp` (antes era, por error, un escaneo de la carta de bebidas).
- CSS: `css/base.css` (compartido) + `css/inicio.css` (propio).

## `menu.html` — Carta

- **Hero**: versión corta del hero de Home — mismo mural (`assets/mural/mural_sombra.webp`/`_mb.webp` + plantas `mural_centro.webp`/`mural_derecho.webp`), con el logo `assets/logo-tapioqueria-texto.svg` y el subtítulo "Menú".
- **Leyenda de íconos** (Vegetariano / Picante / Recomendada) arriba de la carta, chip compacto centrado; en mobile queda en una sola línea (fila, no columna), con textos e íconos más chicos para que entre.
- **Tabs "Comidas" / "Bebidas"**: toggle CSS-only (radios ocultos + `label`, sin JS) que muestra un panel u otro. En mobile los botones quedan flotantes y fijos abajo de la pantalla mientras se hace scroll.
- **Panel Comidas** (todas con precios en pesos argentinos, formato `$XX.XXX`):
  - **Tapiocas** (18 variedades: Bien Chida, Cordobesa, Bahiense, "La que pide Messi", Veggie, Patagónica, Napolitana, Bondiola y Miel, Bomba de Roque, Clásica, Fungi, Tapi Milá, etc.)
  - **Para picar** (torrejitas, falafels, coliflor manchurian, pizzetas de mbejú)
  - **Papas fritas** (rústicas, bravas, roque, criollas, salchipapa, americanas)
  - **Platos** (milanesa, omelette, lomo al roque, ensaladas)
- **Panel Bebidas** (sin precios, solo nombre + ingredientes, tomado de la carta impresa de bebidas): un único banner de portada al inicio del panel con el título "Bebidas" (`.menu-section-banner--bebidas`, foto `uploads/cerveza.webp`), y debajo, todas las subsecciones en su propio `.menu-section-heading` (título chico, sin foto): Clásicos, Raíces de Brasil, Cervezas, Cerveza tirada, Cervezas artesanales, Sidras, Mocktails, Bebidas sin alcohol, Vinos y espumantes. Todo el contenido de este panel (títulos, listas, notas) queda alineado a la izquierda, no centrado como el resto de la carta — ver el bloque "Panel Bebidas" al final de `css/menu.css`.
- **Banner por sección**: cada sección de Comidas tiene un banner rectangular con foto y el título superpuesto encima. Imagen por sección (clases `.menu-section-banner--*` en `css/menu.css`): Tapiocas y Platos → `uploads/tapi_lomo.webp` (placeholder repetido, sin foto propia todavía), Para picar → `uploads/DSC_0025.jpg`, Papas fritas → `uploads/salchipapa.webp`, Bebidas → `uploads/cerveza.webp`.
- Iconos: picante = `assets/aji.svg`, vegetariano = `assets/veggie_icon.svg`, recomendada = estrella SVG inline, sin gluten = `assets/sin_gluten.svg` (estos dos últimos solo en la carta de bebidas).
- **Foto de plato (lightbox CSS-only)**: algunos ítems tienen un ícono de cámara (`.menu-photo-btn`) junto al nombre que abre la foto del plato en un modal a pantalla completa. Es el mismo truco de checkbox oculto + `label` que las tabs (sin JS): los 5 pares `<input type="checkbox" class="photo-toggle">` + `<div class="photo-modal">` viven todos juntos en `.photo-lightboxes`, justo debajo de `<div class="menu-page">`, y el CSS los conecta con el combinador de hermano adyacente (`.photo-toggle:checked + .photo-modal`) — al agregar uno nuevo, mantener el checkbox y su modal como hermanos directos y consecutivos, si no el selector no engancha. Ítems con foto hoy: Torrejitas de cebolla (`DSC_0010.jpg`), Coliflor Manchurian (`DSC_0025.jpg`), Salchipapa (`DSC_0035.webp`), Cordobesa (`tapi_lomo.webp`), Pizzetas de Mbejú (`pizzetas.webp`).
- Link a Instagram `@latapioqueria.sma` en el footer.
- **Nota de mantenimiento**: los precios están hardcodeados en el HTML (sin fuente de datos externa) — actualizar la carta implica editar directamente este archivo. Cada ítem es un bloque `.menu-item` con `.menu-item-row` (nombre + precio) y `.menu-item-desc` (descripción); copiar ese patrón para agregar un plato nuevo. **Importante**: si se agrega/cambia un plato acá, hay que reflejarlo también a mano en el JSON-LD `Menu` del `<head>` (no se generan automáticamente el uno del otro).
- **SEO**: es la única página del sitio que no tenía ningún `<h1>`/`<h2>` real (todos los títulos eran `<span>`). Ahora tiene un `<h1 class="sr-only">` (oculto visualmente, no cambia el diseño) y cada título de sección/subsección es un `<h2>`/`<h3>` real. También lleva el JSON-LD más grande del sitio: `Restaurant` + `Menu` completo (todas las secciones e ítems de Comidas y Bebidas, con precios en Comidas) + `BreadcrumbList`.
- CSS: `css/base.css` (compartido) + `css/menu.css` (propio).

## `donde-encontrarnos.html` — Ubicaciones

- **Hero**: misma estética que el de Menu — mismo mural + plantas a los costados, título/subtítulo en tonos oscuros sobre el fondo claro (antes era una foto oscurecida propia, `uploads/fondo_principal_tapio_h.webp`, ya archivada en `_unused/`).
- **Sección 1 — Resto Bar** (todo el año): Belgrano 940, San Martín de los Andes. Galería de 9 fotos (`uploads/resto_bar (1-9).jpg`) en crossfade automático (`@keyframes crossfade9` en `css/donde-encontrarnos.css`, ciclo de 36s — el desfasaje de cada foto se controla con `animation-delay` inline en cada `<img>`). "Cómo llegar" → https://maps.app.goo.gl/XE2b2TnRdZfLvggk7 (pin real del local).
- **Sección 2 — FoodTruck Lago Lolog** (solo verano, enero-marzo): Playa Bonita. Layout de 2 columnas en desktop (`.donde-foodtruck-layout`, `min-width:861px`) — texto + tarjetas de info a la izquierda, galería vertical a la derecha, porque las fotos son verticales y antes quedaban perdidas en una fila ancha; en mobile se apila igual que antes. La sección (`.donde-section--dark`) tiene su propio padding vertical (antes no tenía, quedaba pegada arriba/abajo). Galería vertical de 4 fotos en crossfade (`uploads/lolog-1.jpg` a `lolog-4.jpg`, `@keyframes crossfade4`, ciclo de 24s) — el foodtruck, tapiocas y papas a orillas del lago. "Cómo llegar" → https://maps.app.goo.gl/Gis15yCYXQ4hHLE49 (Playa Bonita).
- **SEO**: JSON-LD con dos entidades (`Restaurant` para Resto Bar + `FoodEstablishment` para el FoodTruck, cada una con su propia dirección/descripción) más `BreadcrumbList`. Galerías con `loading="lazy"` (están debajo del hero, nunca son la imagen LCP).
- CSS: `css/base.css` (compartido) + `css/donde-encontrarnos.css` (propio).

## `que-es-una-tapioca.html` — Sobre el producto

- **Hero**: misma estética que el de Menu (mural + plantas a los costados, texto oscuro sobre fondo claro) + ilustración `uploads/tapioca_dibujo.webp` con animación de "vapor" (SVG, `@keyframes steam`).
- **Sección "La materia prima"**: explica que la tapioca es almidón de mandioca, sin gluten. 4 tarjetas destacadas (ingrediente / gluten / tiempo de cocción / rellenos).
- **Sección "Origen"** (fondo verde oscuro): historia tupí-guaraní de la tapioca en Brasil.
- **Sección "Cómo se hace"**: 3 pasos (hidratar y tamizar / sartén sin aceite / rellenar y doblar). Incluye el video `assets/como-se-hace-una-tapioca.mp4` (con poster `uploads/tapioca-video-poster.jpg`, ver [IMAGENES.md](IMAGENES.md#video)). Ya no tiene la grilla de 3 fotos placeholder que había debajo del video (se quitó, no llegaron a completarse con fotos reales).
- **Sección "Resto · Bar"**: 5 fotos fijas de producto (`uploads/DSC_0056.jpg`, `DSC_0010.jpg`, `DSC_0025.jpg`, `DSC_0035.webp`, `pizzetas.webp`) en una sola fila (`.tapioca-restobar-grid`, `grid-template-columns: repeat(5, 1fr)`; en mobile pasa a fila con scroll horizontal), que se agrandan levemente al pasar el mouse. CTA "Ver el menú completo" → `menu.html`.
- **SEO**: JSON-LD con `Restaurant` + `Article` (sobre el contenido educativo de la página) + `BreadcrumbList`.
- CSS: `css/base.css` (compartido) + `css/que-es-una-tapioca.css` (propio).

## Elementos compartidos entre páginas

- **`css/base.css`**: reset, custom properties de color/tipografía, botón flotante de WhatsApp (`.wa-fab`), link "← Volver" (`.back-link`), footer (`.site-footer`, `.footer-ribbon`, etc.), íconos sociales (`.social-icon`) y la utilidad `.sr-only` (oculta visualmente un elemento sin sacarlo del DOM ni de lectores de pantalla/buscadores — usada hoy solo para el `<h1>` de `menu.html`).
- **Favicon/manifest**: `assets/favicon.svg` (monograma "T", ícono de pestaña) + `assets/favicon-32.png`, `assets/apple-touch-icon.png`, `assets/icon-192.png`, `assets/icon-512.png` + `site.webmanifest`, enlazados en el `<head>` de las 4 páginas junto con `<meta name="theme-color">`.
- **Datos estructurados (JSON-LD)**: cada página tiene al menos un bloque `Restaurant` con nombre/dirección/teléfono/redes sociales (mismos datos repetidos a propósito en las 4, es la práctica recomendada para reforzar señales de NAP local); ver el detalle específico de cada página arriba.
- **Footer**: misma estructura HTML repetida en las 4 páginas (nombre, dirección, mensajes de gluten/vegano) — si cambia la dirección o el mensaje, hay que actualizar los 4 archivos (no hay includes/componentes en HTML plano, así que no hay forma de compartir el markup en sí, solo el CSS).
- **Fuentes**: Oswald + Figtree/Poppins vía Google Fonts `<link>` en cada `<head>` — cada página declara sus propios pesos, revisar que coincidan si se agregan nuevos usos tipográficos.
- **Paleta y fondos decorativos**: ver [../CLAUDE.md](../CLAUDE.md#diseño-visual-el-sitio-no-sigue-el-sistema-_dsorganic-que-ya-no-existe-en-el-repo).
