<?php
/**
 * Selector de idioma: banderas de los OTROS 2 idiomas (nunca el activo).
 * En español se ven Brasil + EE.UU.; en inglés, Brasil + Argentina; en
 * portugués, EE.UU. + Argentina. Son <a href> reales a la URL de esa
 * página en el otro idioma (con hreflang en el propio link) a propósito
 * — así Google puede rastrear el clúster completo, no es un selector
 * solo-JS. Requiere que la página que lo incluye ya haya definido $page.
 */
require_once __DIR__ . '/flags.php';
?>
<nav class="lang-switcher" aria-label="Idiomas">
  <?php foreach (LANG_META as $code => $meta): if ($code === $lang) continue; ?>
    <a class="lang-switcher-link" href="<?= lang_url($page, $code) ?>" hreflang="<?= $meta['hreflang'] ?>" lang="<?= $meta['html_lang'] ?>" aria-label="<?= htmlspecialchars(t('common.switch_to', ['{lang}' => t('common.lang_name_' . $code)])) ?>">
      <?= flag_svg($meta['flag']) ?>
    </a>
  <?php endforeach; ?>
</nav>
