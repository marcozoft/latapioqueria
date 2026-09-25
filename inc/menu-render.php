<?php
/**
 * Funciones para renderizar la carta a partir de data/menu-items.php +
 * el diccionario del idioma activo (lang/*.php). Reemplazan el HTML
 * repetido a mano que tenía menu.html — ahora agregar/cambiar un ítem
 * se hace en UN solo lugar (data/menu-items.php + 'menu_desc' en los 3
 * lang/*.php) y sale reflejado en los 3 idiomas y en el JSON-LD.
 */

function menu_icons_html(array $item): string {
    $out = '';
    $flags = $item['flags'] ?? [];
    if (in_array('picante', $flags, true)) {
        $out .= "\n                    " . '<img class="menu-inline-icon" src="/assets/aji.svg" alt="' . t('menu.legend_picante') . '">';
    }
    if (in_array('vegetariano', $flags, true)) {
        $out .= "\n                    " . '<img class="menu-inline-icon" width="16" height="16" src="/assets/veggie_icon.svg" alt="' . t('menu.legend_veg') . '">';
    }
    if (in_array('recomendada', $flags, true)) {
        $out .= "\n                    " . '<svg width="15" height="15" viewBox="0 0 24 24" fill="#c1502e" aria-label="' . t('menu.legend_recomendada') . '"><path d="M12 2.6l2.9 6 6.5.9-4.7 4.6 1.1 6.5L12 17.5 6.2 20.6l1.1-6.5L2.6 9.5l6.5-.9z"></path></svg>';
    }
    if (!empty($item['photo'])) {
        $name = menu_item_name($item);
        $aria = htmlspecialchars(t('menu.photo_aria', ['{name}' => $name]));
        $out .= "\n                    " . '<label class="menu-photo-btn" for="foto-' . $item['photo'] . '" aria-label="' . $aria . '"><svg viewBox="0 0 24 24" fill="none" stroke="#c1502e" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 8h3l1.6-2.2a1 1 0 01.8-.4h5.2a1 1 0 01.8.4L17 8h3a1 1 0 011 1v9a1 1 0 01-1 1H4a1 1 0 01-1-1V9a1 1 0 011-1z"></path><circle cx="12" cy="13.5" r="3.4"></circle></svg></label>';
    }
    return $out;
}

function menu_desc_html(string $id): string {
    $d = t('menu_desc.' . $id);
    return $d === 'menu_desc.' . $id ? '' : $d;
}

function render_menu_item(array $item, bool $lg = false): void {
    $name = htmlspecialchars(menu_item_name($item));
    $icons = menu_icons_html($item);
    $desc = menu_desc_html($item['id']);
    if (!empty($item['desc_break'])) {
        $desc2 = menu_desc_html($item['id'] . '-2');
        if ($desc2 !== '') {
            $desc .= '<br>' . $desc2;
        }
    }
    $class = 'menu-item' . ($lg ? ' menu-item--lg' : '');
    echo '<div class="' . $class . '">' . "\n";
    echo '  <div class="menu-item-row">' . "\n";
    echo '    <span class="menu-item-name">' . $name . $icons . '</span>' . "\n";
    if (isset($item['price'])) {
        echo '    <span class="menu-item-price">' . menu_price($item['price']) . '</span>' . "\n";
    }
    echo '  </div>' . "\n";
    if ($desc !== '') {
        echo '  <p class="menu-item-desc">' . $desc . '</p>' . "\n";
    }
    if (!empty($item['sublist'])) {
        echo '  <ul class="menu-sublist">';
        foreach ($item['sublist'] as $li) {
            echo '<li>' . htmlspecialchars($li) . '</li>';
        }
        echo '</ul>' . "\n";
    } elseif (!empty($item['sublist_key'])) {
        echo '  <ul class="menu-sublist">';
        foreach (t('menu_sublists.' . $item['sublist_key']) as $li) {
            echo '<li>' . htmlspecialchars($li) . '</li>';
        }
        echo '</ul>' . "\n";
    }
    echo '</div>' . "\n";
}

function render_menu_item_inline(array $item): void {
    $name = htmlspecialchars(menu_item_name($item));
    $desc = menu_desc_html($item['id']);
    echo '<div class="menu-item">' . "\n";
    echo '  <p class="menu-item-desc"><strong>' . $name . ':</strong> ' . $desc . '</p>' . "\n";
    echo '</div>' . "\n";
}

function render_menu_column(array $items): void {
    echo '<div class="menu-col">' . "\n";
    foreach ($items as $item) {
        if (!empty($item['inline'])) {
            render_menu_item_inline($item);
        } else {
            render_menu_item($item);
        }
    }
    echo '</div>' . "\n";
}

function render_comida_section(string $key, array $section): void {
    $title = t('menu_sections.' . $key);
    echo '<section class="menu-section" data-screen-label="' . htmlspecialchars($title) . '">' . "\n";
    echo '  <div class="menu-section-banner menu-section-banner--' . $section['banner'] . '">' . "\n";
    echo '    <h2 class="menu-section-title">' . htmlspecialchars($title) . '</h2>' . "\n";
    echo '  </div>' . "\n";

    if (!empty($section['single'])) {
        echo '  <div class="menu-list--single">' . "\n";
        foreach ($section['items'] as $item) {
            render_menu_item($item, true);
        }
        echo '  </div>' . "\n";
    } else {
        $gridClass = 'menu-grid' . (!empty($section['narrow']) ? ' menu-grid--narrow' : '');
        echo '  <div class="' . $gridClass . '">' . "\n";
        foreach ($section['columns'] as $col) {
            render_menu_column($col);
        }
        echo '  </div>' . "\n";
    }
    echo '</section>' . "\n";
}

function render_bebida_section(string $key, array $section): void {
    $title = t('menu_sections.' . $key);
    echo '<section class="menu-section" data-screen-label="' . htmlspecialchars($title) . '">' . "\n";
    echo '  <div class="menu-section-heading">' . "\n";
    echo '    <h3 class="menu-section-title">' . htmlspecialchars($title) . '</h3>' . "\n";
    if (!empty($section['note']) && $key !== 'vinos') {
        echo '    <p class="menu-note">' . htmlspecialchars(t('menu_notes.' . $section['note'])) . '</p>' . "\n";
    }
    echo '  </div>' . "\n";

    $layout = $section['layout'] ?? 'grid';

    if ($layout === 'note-only') {
        // La nota ya se imprimió arriba, en el heading; esta sección no tiene ítems.
    } elseif ($layout === 'simple') {
        echo '  <div class="menu-simple-list">' . "\n";
        foreach ($section['items'] as $item) {
            $name = htmlspecialchars(menu_item_name($item));
            $icon = '';
            if (!empty($item['icon'])) {
                $icon = ' <img class="menu-inline-icon" src="/assets/' . $item['icon'] . '.svg" alt="' . htmlspecialchars(t('menu.icon_gluten_free')) . '">';
            }
            echo '    <span class="menu-simple-item">' . $name . $icon . '</span>' . "\n";
        }
        echo '  </div>' . "\n";
    } elseif ($layout === 'wine-list') {
        echo '  <ul class="menu-sublist menu-sublist--wine">' . "\n";
        foreach ($section['items'] as $item) {
            echo '    <li>' . htmlspecialchars(menu_item_name($item)) . '</li>' . "\n";
        }
        echo '  </ul>' . "\n";
        if (!empty($section['note'])) {
            echo '  <p class="menu-note menu-note--center">' . htmlspecialchars(t('menu_notes.' . $section['note'])) . '</p>' . "\n";
        }
    } else {
        $gridClass = 'menu-grid' . (!empty($section['narrow']) ? ' menu-grid--narrow' : '');
        echo '  <div class="' . $gridClass . '">' . "\n";
        foreach ($section['columns'] as $col) {
            render_menu_column($col);
        }
        echo '  </div>' . "\n";
    }
    echo '</section>' . "\n";
}

/** Recorre toda la carta (comidas + bebidas) para armar el JSON-LD Menu, en el idioma activo. */
function menu_jsonld_sections(): array {
    $data = menu_data();
    $out = [];

    foreach ($data['comidas'] as $key => $section) {
        $items = !empty($section['single']) ? $section['items'] : array_merge(...$section['columns']);
        $menuItems = [];
        foreach ($items as $item) {
            if (!empty($item['inline'])) {
                continue; // ítems "de regalo" sin precio propio (pesto y cherry, peras y roquefort)
            }
            $mi = ['@type' => 'MenuItem', 'name' => menu_item_name($item)];
            $desc = menu_desc_html($item['id']);
            if (!empty($item['desc_break'])) {
                $desc2 = menu_desc_html($item['id'] . '-2');
                if ($desc2 !== '') {
                    $desc .= '. ' . $desc2;
                }
            }
            if ($desc !== '') {
                $mi['description'] = $desc;
            }
            if (isset($item['price'])) {
                $mi['offers'] = ['@type' => 'Offer', 'price' => (string) $item['price'], 'priceCurrency' => 'ARS'];
            }
            $menuItems[] = $mi;
        }
        $out[] = ['@type' => 'MenuSection', 'name' => t('menu_sections.' . $key), 'hasMenuItem' => $menuItems];
    }

    $bebidaSections = [];
    foreach ($data['bebidas'] as $key => $section) {
        $layout = $section['layout'] ?? 'grid';
        $items = [];
        if ($layout === 'note-only') {
            $items = [];
        } elseif (in_array($layout, ['simple', 'wine-list'], true)) {
            $items = $section['items'];
        } elseif (!empty($section['columns'])) {
            $items = array_merge(...$section['columns']);
        }
        $menuItems = [];
        foreach ($items as $item) {
            $mi = ['@type' => 'MenuItem', 'name' => menu_item_name($item)];
            $desc = menu_desc_html($item['id']);
            if ($desc !== '') {
                $mi['description'] = $desc;
            }
            $menuItems[] = $mi;
        }
        $sec = ['@type' => 'MenuSection', 'name' => t('menu_sections.' . $key)];
        if (!empty($section['note'])) {
            $sec['description'] = t('menu_notes.' . $section['note']);
        }
        if ($menuItems) {
            $sec['hasMenuItem'] = $menuItems;
        }
        $bebidaSections[] = $sec;
    }
    $out[] = ['@type' => 'MenuSection', 'name' => t('menu_sections.bebidas'), 'hasMenuSection' => $bebidaSections];

    return $out;
}
