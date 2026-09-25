<?php
$page = 'menu';
require __DIR__ . '/inc/i18n.php';
require __DIR__ . '/inc/menu-render.php';

$jsonldMenu = [
  '@context' => 'https://schema.org',
  '@type' => 'Menu',
  'name' => t('meta.menu.og_title'),
  'inLanguage' => LANG_META[$lang]['hreflang'],
  'hasMenuSection' => menu_jsonld_sections(),
];

$jsonldRestaurant = [
  '@context' => 'https://schema.org',
  '@type' => 'Restaurant',
  'name' => 'La Tapioquería',
  'image' => SITE_BASE_URL . '/uploads/tapi_lomo.webp',
  'servesCuisine' => 'Brazilian',
  'priceRange' => '$$',
  'telephone' => '+5492944905540',
  'inLanguage' => LANG_META[$lang]['hreflang'],
  'address' => [
    '@type' => 'PostalAddress',
    'streetAddress' => 'Belgrano 940',
    'addressLocality' => 'San Martín de los Andes',
    'addressRegion' => 'Neuquén',
    'addressCountry' => 'AR',
  ],
  'sameAs' => [
    'https://www.instagram.com/latapioqueria.sma',
    'https://www.facebook.com/p/Latapioqueriafoodtruck-100051627884903/',
  ],
  'url' => lang_url('menu', $lang),
];

$jsonldBreadcrumb = [
  '@context' => 'https://schema.org',
  '@type' => 'BreadcrumbList',
  'itemListElement' => [
    ['@type' => 'ListItem', 'position' => 1, 'name' => t('common.brand_name'), 'item' => lang_url('home', $lang)],
    ['@type' => 'ListItem', 'position' => 2, 'name' => t('menu.subtitle'), 'item' => lang_url('menu', $lang)],
  ],
];

$data = menu_data();

$photos = [
  'torrejitas' => ['file' => 'DSC_0010.jpg', 'item' => 'torrejitas-de-cebolla'],
  'coliflor' => ['file' => 'coliflor.webp', 'item' => 'coliflor-manchurian'],
  'salchipapa' => ['file' => 'DSC_0035.webp', 'item' => 'salchipapa'],
  'cordobesa' => ['file' => 'tapi_lomo.webp', 'item' => 'cordobesa'],
  'pizzetas' => ['file' => 'pizzetas.webp', 'item' => 'pizzetas-de-mbeju'],
  'lomo-al-roque' => ['file' => 'lomo_al_roque.webp', 'item' => 'lomo-al-roque'],
];

function menu_item_name_by_id(string $id): string {
    $data = menu_data();
    foreach ($data['comidas'] as $section) {
        $items = !empty($section['single']) ? $section['items'] : array_merge(...$section['columns']);
        foreach ($items as $item) {
            if ($item['id'] === $id) {
                return menu_item_name($item);
            }
        }
    }
    return $id;
}
?>
<!DOCTYPE html>
<html lang="<?= LANG_META[$lang]['html_lang'] ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= hreflang_block('menu') ?>
<title><?= t('meta.menu.title') ?></title>
<meta name="description" content="<?= t('meta.menu.description') ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= t('meta.menu.og_title') ?>">
<meta property="og:description" content="<?= t('meta.menu.og_description') ?>">
<meta property="og:image" content="<?= SITE_BASE_URL ?>/assets/og-tapioca.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="1200">
<meta property="og:url" content="<?= lang_url('menu', $lang) ?>">
<?= og_locale_block() ?>
<meta name="twitter:card" content="summary_large_image">
<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16.png">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-32.png">
<link rel="apple-touch-icon" href="/assets/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">
<meta name="theme-color" content="#c1502e">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Poppins:ital,wght@0,400;0,500;1,400;1,500;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/base.css">
<link rel="stylesheet" href="/css/menu.css">
<script type="application/ld+json"><?= json_encode($jsonldRestaurant, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?></script>
<script type="application/ld+json"><?= json_encode($jsonldMenu, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?></script>
<script type="application/ld+json"><?= json_encode($jsonldBreadcrumb, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?></script>
</head>
<body>

<?php require __DIR__ . '/inc/wa-fab.php'; ?>

<div class="menu-page">

<div class="photo-lightboxes">
  <?php foreach ($photos as $id => $p): $name = menu_item_name_by_id($p['item']); ?>
  <input type="checkbox" id="foto-<?= $id ?>" class="photo-toggle">
  <div class="photo-modal">
    <label for="foto-<?= $id ?>" class="photo-modal-backdrop"></label>
    <div class="photo-modal-box">
      <label for="foto-<?= $id ?>" class="photo-modal-close" aria-label="<?= t('menu.close_aria') ?>">✕</label>
      <img loading="lazy" src="/uploads/<?= $p['file'] ?>" alt="<?= htmlspecialchars($name) ?>">
    </div>
  </div>
  <?php endforeach; ?>
</div>

  <header class="menu-hero" data-screen-label="Menú — portada">
    <img class="menu-hero-bg menu-hero-bg--desktop" src="/assets/mural/mural_sombra.webp" alt="" aria-hidden="true">
    <img class="menu-hero-bg menu-hero-bg--mobile" src="/assets/mural/mural_sombra_mb.webp" alt="" aria-hidden="true">
    <img class="menu-hero-plant menu-hero-plant--left" src="/assets/mural/mural_centro.webp" alt="" aria-hidden="true">
    <img class="menu-hero-plant menu-hero-plant--right" src="/assets/mural/mural_derecho.webp" alt="" aria-hidden="true">
    <a class="back-link" href="<?= page_url('home') ?>"><?= t('common.back') ?></a>
    <?php require __DIR__ . '/inc/language-switcher.php'; ?>
    <div class="menu-hero-content">
      <h1 class="sr-only"><?= t('menu.h1_sr') ?></h1>
      <img class="menu-hero-logo" src="/assets/logo-tapioqueria-texto.svg" alt="La Tapioquería">
      <div class="menu-hero-subtitle">
        <span class="menu-hero-subtitle-line"></span>
        <span class="menu-hero-subtitle-text"><?= t('menu.subtitle') ?></span>
        <span class="menu-hero-subtitle-line"></span>
      </div>
    </div>
  </header>

  <main class="menu-main">

    <div class="menu-legend">
      <span class="menu-legend-item">
        <img width="18" height="18" src="/assets/veggie_icon.svg" alt=""><?= t('menu.legend_veg') ?></span>
      <span class="menu-legend-item">
        <img width="18" height="18" src="/assets/aji.svg" alt=""><?= t('menu.legend_picante') ?></span>
      <span class="menu-legend-item">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="#c1502e"><path d="M12 2.6l2.9 6 6.5.9-4.7 4.6 1.1 6.5L12 17.5 6.2 20.6l1.1-6.5L2.6 9.5l6.5-.9z"></path></svg><?= t('menu.legend_recomendada') ?></span>
    </div>

    <?php if (t('menu.currency_note')): ?>
    <p class="menu-note" style="margin: -14px auto 22px; max-width: 640px;"><?= t('menu.currency_note') ?></p>
    <?php endif; ?>

    <div class="menu-tabs">
      <input type="radio" name="menu-tab" id="tab-comidas" class="menu-tab-input" checked>
      <input type="radio" name="menu-tab" id="tab-bebidas" class="menu-tab-input">

      <div class="menu-tabs-nav">
        <label class="menu-tab-btn" for="tab-comidas"><?= t('menu.tab_comidas') ?></label>
        <label class="menu-tab-btn" for="tab-bebidas"><?= t('menu.tab_bebidas') ?></label>
      </div>

      <div class="menu-tab-panel menu-tab-panel--comidas">
        <?php foreach ($data['comidas'] as $key => $section): render_comida_section($key, $section); endforeach; ?>
      </div>

      <div class="menu-tab-panel menu-tab-panel--bebidas">
        <div class="menu-section-banner menu-section-banner--bebidas">
          <h2 class="menu-section-title"><?= t('menu_sections.bebidas') ?></h2>
        </div>
        <?php foreach ($data['bebidas'] as $key => $section): render_bebida_section($key, $section); endforeach; ?>
      </div>
    </div>

  </main>

  <?php $FOOTER_VEGAN_KEY = 'footer_vegan_menu'; require __DIR__ . '/inc/footer.php'; ?>

</div>

<?php require __DIR__ . '/inc/site-signature.php'; ?>

</body>
</html>
