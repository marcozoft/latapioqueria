<?php
$page = 'donde-encontrarnos';
require __DIR__ . '/inc/i18n.php';

$jsonld = [
  '@context' => 'https://schema.org',
  '@graph' => [
    [
      '@type' => 'Restaurant',
      'name' => 'La Tapioquería — Resto Bar',
      'image' => SITE_BASE_URL . '/uploads/resto_bar%20(1).jpg',
      'description' => t('donde.s1_copy'),
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
      'url' => lang_url('donde-encontrarnos', $lang),
    ],
    [
      '@type' => 'FoodEstablishment',
      'name' => 'La Tapioquería — FoodTruck Lago Lolog',
      'image' => SITE_BASE_URL . '/uploads/lolog-1.jpg',
      'description' => t('donde.s2_copy'),
      'servesCuisine' => 'Brazilian',
      'inLanguage' => LANG_META[$lang]['hreflang'],
      'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => 'Lago Lolog, San Martín de los Andes',
        'addressRegion' => 'Neuquén',
        'addressCountry' => 'AR',
      ],
      'sameAs' => [
        'https://www.instagram.com/latapioqueria.sma',
        'https://www.facebook.com/p/Latapioqueriafoodtruck-100051627884903/',
      ],
      'url' => lang_url('donde-encontrarnos', $lang),
    ],
    [
      '@type' => 'BreadcrumbList',
      'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => t('common.brand_name'), 'item' => lang_url('home', $lang)],
        ['@type' => 'ListItem', 'position' => 2, 'name' => t('donde.hero_title') === 'donde.hero_title' ? 'Dónde encontrarnos' : strip_tags(str_replace('<br>', ' ', t('donde.hero_title'))), 'item' => lang_url('donde-encontrarnos', $lang)],
      ],
    ],
  ],
];

$restoAlt = t('donde.gallery_resto_alt');
$lologAlt = t('donde.gallery_lolog_alt');
?>
<!DOCTYPE html>
<html lang="<?= LANG_META[$lang]['html_lang'] ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= hreflang_block('donde-encontrarnos') ?>
<title><?= t('meta.donde.title') ?></title>
<meta name="description" content="<?= t('meta.donde.description') ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= t('meta.donde.og_title') ?>">
<meta property="og:description" content="<?= t('meta.donde.og_description') ?>">
<meta property="og:image" content="<?= SITE_BASE_URL ?>/assets/og-tapioca.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="1200">
<meta property="og:url" content="<?= lang_url('donde-encontrarnos', $lang) ?>">
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
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Figtree:wght@700;800&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/base.css">
<link rel="stylesheet" href="/css/donde-encontrarnos.css">
<script type="application/ld+json"><?= json_encode($jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?></script>
</head>
<body>

<?php require __DIR__ . '/inc/wa-fab.php'; ?>

<div class="donde-page">

  <header class="donde-hero" data-screen-label="Hero — dónde encontrarnos">
    <img class="donde-hero-bg donde-hero-bg--desktop" src="/assets/mural/mural_sombra.webp" alt="" aria-hidden="true">
    <img class="donde-hero-bg donde-hero-bg--mobile" src="/assets/mural/mural_sombra_mb.webp" alt="" aria-hidden="true">
    <img class="donde-hero-plant donde-hero-plant--left" src="/assets/mural/mural_centro.webp" alt="" aria-hidden="true">
    <img class="donde-hero-plant donde-hero-plant--right" src="/assets/mural/mural_derecho.webp" alt="" aria-hidden="true">
    <a class="back-link" href="<?= page_url('home') ?>"><?= t('common.back') ?></a>
    <?php require __DIR__ . '/inc/language-switcher.php'; ?>

    <div class="donde-hero-content">
      <h1 class="donde-hero-title"><?= t('donde.hero_title') ?></h1>
      <div class="donde-hero-subtitle">
        <span class="donde-hero-subtitle-line"></span>
        <span class="donde-hero-subtitle-text"><?= t('donde.hero_subtitle') ?></span>
        <span class="donde-hero-subtitle-line"></span>
      </div>
    </div>
  </header>

  <section class="donde-section" data-screen-label="Resto Bar">
    <div class="donde-section-head">
      <div class="donde-section-heading">
        <span class="donde-section-eyebrow donde-section-eyebrow--light">
          <span class="donde-step-num donde-step-num--1">1</span><?= t('donde.s1_eyebrow') ?></span>
        <h2 class="donde-section-title donde-section-title--light"><?= t('donde.s1_title') ?></h2>
      </div>
      <div class="donde-section-copy donde-section-copy--light">
        <p><?= t('donde.s1_copy') ?></p>
        <a class="donde-map-link donde-map-link--light" href="https://maps.app.goo.gl/XE2b2TnRdZfLvggk7" target="_blank" rel="noopener">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#c1502e" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0116 0z"></path><circle cx="12" cy="10" r="2.6"></circle></svg><?= t('donde.map_link') ?></a>
      </div>
    </div>

    <div class="donde-gallery">
      <?php foreach (range(1, 9) as $i): ?>
      <img loading="lazy" src="/uploads/resto_bar%20(<?= $i ?>).jpg" alt="<?= htmlspecialchars($restoAlt[$i - 1]) ?>" style="animation-delay:<?= ($i - 1) * 4 ?>s">
      <?php endforeach; ?>
      <div class="donde-gallery-fade"></div>
      <div class="donde-gallery-caption">
        <span class="donde-gallery-caption-title"><?= t('donde.gallery_caption_title') ?></span>
        <span class="donde-gallery-caption-sub"><?= t('donde.gallery_caption_sub') ?></span>
      </div>
    </div>

    <div class="donde-info-grid">
      <div class="donde-info-card donde-info-card--light">
        <span class="donde-info-label"><?= t('donde.s1_info_1_label') ?></span>
        <span class="donde-info-value"><?= t('donde.s1_info_1_value') ?></span>
      </div>
      <div class="donde-info-card donde-info-card--light">
        <span class="donde-info-label"><?= t('donde.s1_info_2_label') ?></span>
        <span class="donde-info-value"><?= t('donde.s1_info_2_value') ?></span>
      </div>
      <div class="donde-info-card donde-info-card--light">
        <span class="donde-info-label"><?= t('donde.s1_info_3_label') ?></span>
        <span class="donde-info-value"><?= t('donde.s1_info_3_value') ?></span>
      </div>
    </div>
  </section>

  <section class="donde-section--dark" data-screen-label="FoodTruck Lolog">
    <div class="donde-section-inner">
      <div class="donde-foodtruck-layout">
        <div class="donde-foodtruck-info">
          <div class="donde-section-heading">
            <span class="donde-section-eyebrow donde-section-eyebrow--dark">
              <span class="donde-step-num donde-step-num--2">2</span><?= t('donde.s2_eyebrow') ?></span>
            <h2 class="donde-section-title donde-section-title--dark"><?= t('donde.s2_title') ?></h2>
          </div>
          <div class="donde-section-copy donde-section-copy--dark">
            <p><?= t('donde.s2_copy') ?></p>
            <a class="donde-map-link donde-map-link--dark" href="https://maps.app.goo.gl/Gis15yCYXQ4hHLE49" target="_blank" rel="noopener">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#e08a4a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0116 0z"></path><circle cx="12" cy="10" r="2.6"></circle></svg><?= t('donde.map_link') ?></a>
          </div>

          <div class="donde-info-grid">
            <div class="donde-info-card donde-info-card--dark">
              <span class="donde-info-label"><?= t('donde.s2_info_1_label') ?></span>
              <span class="donde-info-value"><?= t('donde.s2_info_1_value') ?></span>
            </div>
            <div class="donde-info-card donde-info-card--dark">
              <span class="donde-info-label"><?= t('donde.s2_info_2_label') ?></span>
              <span class="donde-info-value"><?= t('donde.s2_info_2_value') ?></span>
            </div>
            <div class="donde-info-card donde-info-card--dark">
              <span class="donde-info-label"><?= t('donde.s2_info_3_label') ?></span>
              <span class="donde-info-value"><?= t('donde.s2_info_3_value') ?></span>
            </div>
          </div>
        </div>

        <div class="donde-gallery-vertical-wrap">
          <div class="donde-gallery-vertical">
            <?php foreach (range(1, 4) as $i): ?>
            <div class="donde-gallery-vertical-slide" style="animation-delay:<?= ($i - 1) * 6 ?>s"><img loading="lazy" src="/uploads/lolog-<?= $i ?>.jpg" alt="<?= htmlspecialchars($lologAlt[$i - 1]) ?>"></div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php $FOOTER_NO_GLUTEN = true; require __DIR__ . '/inc/footer.php'; ?>

</div>

<?php require __DIR__ . '/inc/site-signature.php'; ?>

</body>
</html>
