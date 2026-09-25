<?php
/**
 * Infraestructura de idiomas. La incluye cada página (index.php, menu.php,
 * donde-encontrarnos.php, que-es-una-tapioca.php) al principio, después de
 * definir $page (el slug de la página: 'home'|'menu'|'donde-encontrarnos'|
 * 'que-es-una-tapioca').
 *
 * El idioma llega por querystring (?lang=en|pt), seteado por .htaccess al
 * reescribir /en/<pagina> y /pt/<pagina> — nunca lo escribe un visitante a
 * mano, pero igual se valida contra la lista blanca por las dudas.
 */

const SITE_BASE_URL = 'https://latapioqueria.com.ar';

const LANG_META = [
  'es' => ['hreflang' => 'es-AR', 'og_locale' => 'es_AR', 'html_lang' => 'es', 'flag' => 'ar'],
  'en' => ['hreflang' => 'en', 'og_locale' => 'en_US', 'html_lang' => 'en', 'flag' => 'us'],
  'pt' => ['hreflang' => 'pt-BR', 'og_locale' => 'pt_BR', 'html_lang' => 'pt-BR', 'flag' => 'br'],
];

$lang = $_GET['lang'] ?? 'es';
if (!array_key_exists($lang, LANG_META)) {
    $lang = 'es';
}

$T = require __DIR__ . '/../lang/' . $lang . '.php';
$MENU_DATA = null; // se carga con menu_data() solo en menu.php, para no pesar en las otras páginas

/** Busca una clave anidada ("menu.tab_comidas") en el diccionario del idioma activo. */
function t(string $key, array $vars = []) {
    global $T;
    $val = $T;
    foreach (explode('.', $key) as $part) {
        if (!is_array($val) || !array_key_exists($part, $val)) {
            return $key; // visible a propósito: una key rota se nota en la página, no se traga en silencio
        }
        $val = $val[$part];
    }
    if (is_string($val) && $vars) {
        $val = strtr($val, $vars);
    }
    return $val;
}

/** URL absoluta de una página ('home'|'menu'|...) en un idioma dado. */
function lang_url(string $page, string $lang): string {
    $slug = $page === 'home' ? '' : $page;
    $prefix = $lang === 'es' ? '' : '/' . $lang;
    $url = SITE_BASE_URL . $prefix . '/' . $slug;
    return $page === 'home' ? rtrim($url, '/') . '/' : $url;
}

/** URL de una página en el idioma ACTUAL (para navegación interna: back-link, nav, cta). */
function page_url(string $page): string {
    global $lang;
    return lang_url($page, $lang);
}

/** Bloque <link rel="canonical"> + hreflang recíproco (x-default -> español) para el <head>. */
function hreflang_block(string $page): string {
    global $lang;
    $out = '<link rel="canonical" href="' . lang_url($page, $lang) . "\">\n";
    foreach (LANG_META as $code => $meta) {
        $out .= '<link rel="alternate" hreflang="' . $meta['hreflang'] . '" href="' . lang_url($page, $code) . "\">\n";
    }
    $out .= '<link rel="alternate" hreflang="x-default" href="' . lang_url($page, 'es') . "\">\n";
    return $out;
}

/** og:locale + og:locale:alternate para las otras dos versiones. */
function og_locale_block(): string {
    global $lang;
    $out = '<meta property="og:locale" content="' . LANG_META[$lang]['og_locale'] . "\">\n";
    foreach (LANG_META as $code => $meta) {
        if ($code !== $lang) {
            $out .= '<meta property="og:locale:alternate" content="' . $meta['og_locale'] . "\">\n";
        }
    }
    return $out;
}

/** Carga (con cache estática) la estructura de la carta, independiente del idioma. */
function menu_data(): array {
    global $MENU_DATA;
    if ($MENU_DATA === null) {
        $MENU_DATA = require __DIR__ . '/../data/menu-items.php';
    }
    return $MENU_DATA;
}

/** Nombre de un ítem de la carta: traducido si está en 'menu_names', si no el de siempre. */
function menu_item_name(array $item): string {
    return t('menu_names.' . $item['id']) !== 'menu_names.' . $item['id']
        ? t('menu_names.' . $item['id'])
        : $item['name'];
}

/** Precio formateado al estilo argentino ($26.000), igual en los 3 idiomas (misma moneda real). */
function menu_price(int $price): string {
    return '$' . number_format($price, 0, ',', '.');
}
