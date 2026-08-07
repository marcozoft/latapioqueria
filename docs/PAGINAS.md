# Páginas del sitio

Contexto detallado de cada `.dc.html`. Ver [../CLAUDE.md](../CLAUDE.md) para la visión general del proyecto.

## `inicio.dc.html` — Home

- **Hero**: fondo `uploads/fondo_principal_tapio_h.webp` (blureado + nítido superpuesto), emblema circular `uploads/BEBIDAS A4 IMPRESION.png`, tagline "Tapiocas · Açaí · Tragos".
- **Nav a 3 secciones** (tarjetas grandes con hover): "¿Qué es una tapioca?" → `que-es-una-tapioca.dc.html`; "Ver el menú" → `menu.dc.html`; "¿Dónde encontrarnos?" → `donde-encontrarnos.dc.html`.
- **Footer** común a las 4 páginas: banners "Cocina 100% libre de gluten" / "Opciones veganas", nombre + dirección, decoración `fondo_tapio_inf_izq.webp` / `fondo_tapio_inf_der.webp`.

## `menu.dc.html` — Carta

- **Header**: `assets/menu-hero.png` como fondo, botón "← Volver" a Home.
- **Secciones** (todas con precios en pesos argentinos, formato `$XX.XXX`):
  - **Tapiocas** (18 variedades: Bien Chida, Cordobesa, Bahiense, "La que pide Messi", Veggie, Patagónica, Napolitana, Bondiola y Miel, Bomba de Roque, Clásica, Fungi, Tapi Milá, etc.)
  - **Para picar** (torrejitas, falafels, coliflor manchurian, pizzetas de mbejú)
  - **Papas fritas** (rústicas, bravas, roque, criollas, salchipapa, americanas)
  - **Platos** (milanesa, omelette, lomo al roque, ensaladas, plato del día)
- Iconos inline SVG para picante / recomendada / vegetariano, con leyenda en el footer de esta página.
- Link a Instagram `@latapioqueria.sma` en el footer.
- **Nota de mantenimiento**: los precios están hardcodeados en el HTML (sin fuente de datos externa) — actualizar la carta implica editar directamente este archivo.

## `donde-encontrarnos.dc.html` — Ubicaciones

- **Hero**: mismo fondo que Home (`fondo_principal_tapio_h.webp`), oscurecido.
- **Sección 1 — Resto Bar** (todo el año): Belgrano 940, San Martín de los Andes. Galería de 9 fotos (`uploads/resto_bar (1-9).jpg`) en crossfade automático (`animation:crossfade9`, ciclo de 36s). Link a Google Maps.
- **Sección 2 — FoodTruck Lago Lolog** (solo verano, enero-marzo): Playa Bonita. Galería vertical de 4 fotos en crossfade (`uploads/lolog-1.jpg` a `lolog-4.jpg`, `animation:crossfade4`, ciclo de 24s) — el foodtruck, tapiocas y papas a orillas del lago. Link a Google Maps.

## `que-es-una-tapioca.dc.html` — Sobre el producto

- **Hero**: mismo fondo compartido + ilustración `uploads/tapioca_dibujo.webp` con animación de "vapor" (SVG).
- **Sección "La materia prima"**: explica que la tapioca es almidón de mandioca, sin gluten. 4 tarjetas destacadas (ingrediente / gluten / tiempo de cocción / rellenos).
- **Sección "Origen"** (fondo verde oscuro): historia tupí-guaraní de la tapioca en Brasil.
- **Sección "Cómo se hace"**: 3 pasos (hidratar y tamizar / sartén sin aceite / rellenar y doblar). Incluye un `<video>` que referencia `assets/como-se-hace-una-tapioca.mp4` (**archivo inexistente**, ver CLAUDE.md) y 3 `<image-slot>` vacíos ("tapioca-foto-1/2/3").
- **Sección "Resto · Bar"**: 4 fotos fijas de producto (`uploads/DSC_0056.jpg`, `DSC_0010.jpg`, `DSC_0025.jpg`, `DSC_0035.jpg`) con CTA "Ver el menú completo" → `menu.dc.html`.

## Elementos compartidos entre páginas

- **Footer**: idéntico bloque (nombre, dirección, mensajes de gluten/vegano) repetido en las 4 páginas — si cambia la dirección o el mensaje, hay que actualizar los 4 archivos (no hay componente compartido real).
- **Fuentes**: Oswald + Figtree/Poppins vía Google Fonts `<link>` en cada `<helmet>` — cada página declara sus propios pesos, revisar que coincidan si se agregan nuevos usos tipográficos.
- **Paleta y fondos decorativos**: ver [../CLAUDE.md](../CLAUDE.md#diseño-visual-el-sitio-no-sigue-el-sistema-_dsorganic).
