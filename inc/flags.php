<?php
/**
 * Banderas en SVG inline (sin archivos externos, sin depender de la
 * fuente de emoji del sistema operativo, que a veces ni siquiera dibuja
 * la banderita y muestra el código de país en texto). Simplificadas a
 * propósito para verse bien a 20px.
 */
function flag_svg(string $code): string {
    switch ($code) {
        case 'ar': // Argentina — celeste/blanco/celeste + sol
            return '<svg viewBox="0 0 24 16" width="20" height="14" aria-hidden="true">'
                . '<rect width="24" height="16" fill="#fff"/>'
                . '<rect width="24" height="5.33" fill="#74acdf"/>'
                . '<rect y="10.67" width="24" height="5.33" fill="#74acdf"/>'
                . '<circle cx="12" cy="8" r="1.8" fill="#f6b40e" stroke="#85340a" stroke-width="0.3"/>'
                . '</svg>';
        case 'br': // Brasil — verde, rombo amarillo, círculo azul
            return '<svg viewBox="0 0 24 16" width="20" height="14" aria-hidden="true">'
                . '<rect width="24" height="16" fill="#009c3b"/>'
                . '<polygon points="12,2 22,8 12,14 2,8" fill="#ffdf00"/>'
                . '<circle cx="12" cy="8" r="4.2" fill="#002776"/>'
                . '</svg>';
        case 'us': // EE.UU. — franjas + cantón azul (simplificado)
            return '<svg viewBox="0 0 24 16" width="20" height="14" aria-hidden="true">'
                . '<rect width="24" height="16" fill="#fff"/>'
                . '<g fill="#B22234">'
                . '<rect y="0" width="24" height="1.23"/><rect y="2.46" width="24" height="1.23"/>'
                . '<rect y="4.92" width="24" height="1.23"/><rect y="7.38" width="24" height="1.23"/>'
                . '<rect y="9.84" width="24" height="1.23"/><rect y="12.3" width="24" height="1.23"/>'
                . '<rect y="14.76" width="24" height="1.23"/>'
                . '</g>'
                . '<rect width="10" height="8.6" fill="#3C3B6E"/>'
                . '</svg>';
        default:
            return '';
    }
}
