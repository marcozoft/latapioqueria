# La Tapioquería — sitio web

Sitio web de **La Tapioquería**, restô bar de tapiocas brasileñas en San Martín de los Andes, Argentina (Belgrano 940). Construido en **Claude Design** (plataforma "Omelette"), no es HTML/JS estándar de un stack tradicional (sin build, sin framework, sin package.json).

## Qué es un archivo `.dc.html`

Cada página es un archivo `*.dc.html`. No es HTML plano: usa una etiqueta raíz `<x-dc>` con un `<helmet>` interno (equivalente al `<head>`) y el resto del markup se compila a React en tiempo de ejecución vía `support.js` (bundle generado, **no editar a mano** — regenerado desde `dc-runtime/src/*.ts` en otro repo). Al editar contenido/estilos de una página, se edita directamente el HTML dentro de `<x-dc>`; los estilos van inline (`style="..."`), no hay hojas de estilo por componente.

`image-slot.js` define el custom element `<image-slot>`, un placeholder de imagen "soltar para completar" usado en canvas/mockup — en el sitio publicado, si un slot no tiene imagen cargada, no se ve nada útil (ver "Huecos de contenido" abajo).

**Atributos booleanos (`controls`, `autoplay`, `muted`, `loop`, `disabled`, etc.) — nunca escribirlos "pelados".** El compilador parsea el HTML y convierte cada atributo en un prop de React; un atributo sin valor (`<video controls>`) parsea como `value=""`, y React puede tratar un string vacío como "false" para props booleanas de ese tipo — el atributo termina sin aplicarse, sin ningún error visible. Escribir siempre `controls="{{true}}"` (la sintaxis `{{...}}` evalúa la expresión y `resolve()` convierte el string `"true"` en el booleano real `true`). Mismo cuidado con nombres de prop en camelCase que no son válidos como atributo HTML (`autoPlay`, `playsInline`, `viewBox`, etc.): escribirlos tal cual en el HTML (`autoPlay="{{true}}"`) — el compilador tiene un paso previo (`sc-camel-`) que preserva la mayúscula intermedia a través del parseo HTML, que de otro modo la perdería (HTML no distingue mayúsculas en nombres de atributo). Ver el `<video>` de `que-es-una-tapioca.dc.html` como ejemplo de referencia.

## Estructura del proyecto

```
index.html                      → Redirect estático a inicio.dc.html (entry point para hosting)
inicio.dc.html                   → Home (hero, 3 accesos, footer)
menu.dc.html                     → Carta completa con precios
donde-encontrarnos.dc.html       → Resto Bar (todo el año) + FoodTruck Lolog (verano)
que-es-una-tapioca.dc.html       → Qué es la tapioca, origen, cómo se hace
robots.txt                      → Permite indexación completa (Allow: /)
support.js                      → runtime generado (dc-runtime) — no editar
image-slot.js                   → custom element de placeholders de imagen
assets/                         → imágenes/video propios de cada página (menu-hero.jpg)
uploads/                        → fotografía de producto/local + PDFs de la carta
_ds/organic-.../                → sistema de diseño "Organic" (tokens, componentes de referencia)
_unused/                        → archivos huérfanos archivados, ignorado por git (ver docs/IMAGENES.md)
docs/                           → documentación de contexto de este proyecto
```

Los 4 nombres de página son kebab-case en minúsculas sin espacios ni tildes a propósito — son nombres de archivo que terminan siendo URLs públicas. **Mantienen la extensión `.dc.html`** (no `.html` plano) para seguir siendo editables desde Claude Design/DesignSync; ver [docs/DEPLOY.md](docs/DEPLOY.md) para por qué existe `index.html` como redirect separado.

## Navegación entre páginas

Enlaces relativos directos entre los 4 `.dc.html` (sin router): Home → las otras 3; cada subpágina tiene un link "← Volver" a Home y links cruzados (p. ej. "Ver el menú completo" desde "Que es una tapioca"). *(Hasta la limpieza de 2026-08-06 el link "← Volver" apuntaba a un nombre de archivo con guion largo ("—") que no coincidía con el archivo real — estaba roto. Ya está corregido.)*

## Diseño visual (el sitio NO sigue el sistema `_ds/organic`)

`_ds/organic-.../readme.md` documenta un sistema de diseño "Organic" con tokens CSS (`var(--color-*)`, tipografía Caprasimo + Figtree). **Las páginas reales no usan esas clases ni esos tokens** — todo el estilo está hardcodeado inline con su propia paleta:

- Fondo cálido: `#f0e2c6` / `#f2e5cf` (crema), `#17110d` / `#1d1610` (marrón oscuro, hero)
- Acento principal: `#c1502e` (terracota)
- Acento secundario: `#56633f` / `#33361f` (verde salvia oscuro)
- Tipografía: **Oswald** (títulos, mayúsculas, tracking amplio) + **Figtree**/**Poppins** (cuerpo), cargadas por Google Fonts — no Caprasimo.

Si se retoca el diseño, mantener esta paleta/tipografía real (no la del readme de `_ds`, que quedó desactualizada respecto al sitio).

## Huecos de contenido conocidos

- **`que-es-una-tapioca.dc.html`**: tiene 3 `<image-slot>` sin imagen cargada ("Foto de tapioca 1/2/3"). Para completarlos, reemplazar el `<image-slot>` por un `<img>` normal apuntando a `uploads/` (igual que el resto del sitio) — es el patrón que ya siguen todas las demás imágenes del sitio.

`donde-encontrarnos.dc.html` ya no tiene `<image-slot>` (se completaron las 4 fotos del FoodTruck del Lolog el 2026-08-06) ni el `<script src="./image-slot.js">` — si se vuelve a necesitar un slot vacío en esta página, hay que reagregar ese script. El video de `que-es-una-tapioca.dc.html` (`assets/como-se-hace-una-tapioca.mp4`) también se completó el 2026-08-07 — ver [docs/IMAGENES.md](docs/IMAGENES.md#video) para cómo se comprimió.

## Imágenes y SEO

Ver [docs/IMAGENES.md](docs/IMAGENES.md) para el inventario completo, qué imágenes usa cada página y el estado de optimización (objetivo: ≤100KB por imagen para SEO/performance). Cada página ya tiene `<title>`, `meta description` y Open Graph básicos en su `<helmet>` — al agregar una página nueva, replicar ese bloque con contenido propio.

## Deploy / producción

Ver [docs/DEPLOY.md](docs/DEPLOY.md) — checklist de qué se hizo para dejar el sitio listo para hosting estático y qué falta definir (dominio/host elegido, sitemap.xml, canonical/og:url absolutos).

## Ver también

- [docs/PAGINAS.md](docs/PAGINAS.md) — contenido y estructura de cada página.
- [_ds/organic-.../readme.md](_ds/organic-af514621-106e-4ebf-b7a1-58be1ce19f00/readme.md) — guía del sistema de diseño (no aplicado en el sitio actual, ver arriba).
