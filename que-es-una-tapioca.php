<?php
$page = 'que-es-una-tapioca';
require __DIR__ . '/inc/i18n.php';

$article = [
  '@type' => 'Article',
  'headline' => t('meta.tapioca.og_title'),
  'description' => t('meta.tapioca.description'),
  'image' => SITE_BASE_URL . '/uploads/DSC_0056.jpg',
  'inLanguage' => LANG_META[$lang]['hreflang'],
  'about' => 'Brazilian tapioca',
  'publisher' => ['@type' => 'Restaurant', 'name' => 'La Tapioquería'],
  'mainEntityOfPage' => lang_url('que-es-una-tapioca', $lang),
];
if ($lang === 'es') {
    $article['workTranslation'] = [lang_url('que-es-una-tapioca', 'en'), lang_url('que-es-una-tapioca', 'pt')];
} else {
    $article['translationOfWork'] = lang_url('que-es-una-tapioca', 'es');
    $other = $lang === 'en' ? 'pt' : 'en';
    $article['workTranslation'] = [lang_url('que-es-una-tapioca', $other)];
}

$jsonld = [
  '@context' => 'https://schema.org',
  '@graph' => [
    [
      '@type' => 'Restaurant',
      'name' => 'La Tapioquería',
      'image' => SITE_BASE_URL . '/uploads/DSC_0056.jpg',
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
      'hasMenu' => lang_url('menu', $lang),
      'url' => lang_url('que-es-una-tapioca', $lang),
    ],
    $article,
    [
      '@type' => 'BreadcrumbList',
      'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => t('common.brand_name'), 'item' => lang_url('home', $lang)],
        ['@type' => 'ListItem', 'position' => 2, 'name' => strip_tags(str_replace('<br>', ' ', t('tapioca.hero_title'))), 'item' => lang_url('que-es-una-tapioca', $lang)],
      ],
    ],
  ],
];

$gallery = t('tapioca.gallery');
$galleryImgs = ['DSC_0056.jpg', 'DSC_0010.jpg', 'coliflor.webp', 'DSC_0035.webp', 'pizzetas.webp'];
?>
<!DOCTYPE html>
<html lang="<?= LANG_META[$lang]['html_lang'] ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= hreflang_block('que-es-una-tapioca') ?>
<title><?= t('meta.tapioca.title') ?></title>
<meta name="description" content="<?= t('meta.tapioca.description') ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= t('meta.tapioca.og_title') ?>">
<meta property="og:description" content="<?= t('meta.tapioca.og_description') ?>">
<meta property="og:image" content="<?= SITE_BASE_URL ?>/assets/og-tapioca.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="1200">
<meta property="og:url" content="<?= lang_url('que-es-una-tapioca', $lang) ?>">
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
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Figtree:wght@700;800&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/base.css">
<link rel="stylesheet" href="/css/que-es-una-tapioca.css">
<script type="application/ld+json"><?= json_encode($jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?></script>
</head>
<body>

<?php require __DIR__ . '/inc/wa-fab.php'; ?>

<div class="tapioca-page">

  <header class="tapioca-hero" data-screen-label="Hero — qué es una tapioca">
    <img class="tapioca-hero-bg tapioca-hero-bg--desktop" src="/assets/mural/mural_sombra.webp" alt="" aria-hidden="true">
    <img class="tapioca-hero-bg tapioca-hero-bg--mobile" src="/assets/mural/mural_sombra_mb.webp" alt="" aria-hidden="true">
    <img class="tapioca-hero-plant tapioca-hero-plant--left" src="/assets/mural/mural_centro.webp" alt="" aria-hidden="true">
    <img class="tapioca-hero-plant tapioca-hero-plant--right" src="/assets/mural/mural_derecho.webp" alt="" aria-hidden="true">
    <a class="back-link" href="<?= page_url('home') ?>"><?= t('common.back') ?></a>
    <?php require __DIR__ . '/inc/language-switcher.php'; ?>

    <div class="tapioca-hero-content">
      <span class="tapioca-illustration-wrap">
        <svg class="tapioca-steam" viewBox="0 0 120 70" fill="none" stroke="#c1502e" stroke-width="6" stroke-linecap="round" aria-hidden="true">
          <path d="M30 66c-7-10 7-16 0-26s5-16 1-24"></path>
          <path d="M60 68c-7-11 7-17 0-27s5-17 1-25"></path>
          <path d="M90 66c-7-10 7-16 0-26s5-16 1-24"></path>
        </svg>
        <img class="tapioca-illustration" src="/uploads/tapioca_dibujo.webp" alt="<?= t('tapioca.illustration_alt') ?>">
      </span>
      <h1 class="tapioca-hero-title"><?= t('tapioca.hero_title') ?></h1>
      <p class="tapioca-hero-desc"><?= t('tapioca.hero_desc') ?></p>
    </div>
  </header>

  <section class="tapioca-intro" data-screen-label="Qué es">
    <img class="tapioca-mandioca-bg" src="/uploads/mandioca.webp" alt="" aria-hidden="true">
    <div class="tapioca-intro-text">
      <span class="eyebrow"><?= t('tapioca.intro_eyebrow') ?></span>
      <h2 class="section-title"><?= t('tapioca.intro_title') ?></h2>
      <p><?= t('tapioca.intro_p1') ?></p>
      <p><?= t('tapioca.intro_p2') ?></p>
    </div>

    <div class="stat-grid">
      <div class="stat-card stat-card--cream">
        <span class="stat-number"><?= t('tapioca.stat1_num') ?></span>
        <span class="stat-label"><?= t('tapioca.stat1_label') ?></span>
        <span class="stat-desc"><?= t('tapioca.stat1_desc') ?></span>
      </div>
      <div class="stat-card stat-card--sage">
        <span class="stat-number"><?= t('tapioca.stat2_num') ?></span>
        <span class="stat-label"><?= t('tapioca.stat2_label') ?></span>
        <span class="stat-desc"><?= t('tapioca.stat2_desc') ?></span>
      </div>
      <div class="stat-card stat-card--terracota">
        <span class="stat-number"><?= t('tapioca.stat3_num') ?></span>
        <span class="stat-label"><?= t('tapioca.stat3_label') ?></span>
        <span class="stat-desc"><?= t('tapioca.stat3_desc') ?></span>
      </div>
      <div class="stat-card stat-card--cream">
        <span class="stat-number stat-number--sage-accent"><?= t('tapioca.stat4_num') ?></span>
        <span class="stat-label"><?= t('tapioca.stat4_label') ?></span>
        <span class="stat-desc"><?= t('tapioca.stat4_desc') ?></span>
      </div>
    </div>
  </section>

  <section class="tapioca-origen" data-screen-label="Origen">
    <div class="tapioca-origen-inner">
      <div class="tapioca-origen-heading">
        <span class="eyebrow eyebrow--dark"><?= t('tapioca.origen_eyebrow') ?></span>
        <h2 class="section-title section-title--light"><?= t('tapioca.origen_title') ?></h2>
      </div>
      <div class="tapioca-origen-grid">
        <p><?= t('tapioca.origen_p1') ?></p>
        <p><?= t('tapioca.origen_p2') ?></p>
        <p><?= t('tapioca.origen_p3') ?></p>
      </div>
      <img class="tapioca-origen-flag" src="/assets/brasil.svg" alt="<?= t('tapioca.flag_alt') ?>">
    </div>
  </section>

  <section class="tapioca-steps" data-screen-label="Cómo se hace">
    <div class="tapioca-steps-heading">
      <span class="eyebrow"><?= t('tapioca.steps_eyebrow') ?></span>
      <h2 class="section-title"><?= t('tapioca.steps_title') ?></h2>
    </div>

    <div class="tapioca-steps-grid">
      <div class="step-card">
        <span class="step-number">01</span>
        <h3 class="step-title"><?= t('tapioca.step1_title') ?></h3>
        <p class="step-desc"><?= t('tapioca.step1_desc') ?></p>
      </div>
      <div class="step-card">
        <span class="step-number">02</span>
        <h3 class="step-title"><?= t('tapioca.step2_title') ?></h3>
        <p class="step-desc"><?= t('tapioca.step2_desc') ?></p>
      </div>
      <div class="step-card">
        <span class="step-number">03</span>
        <h3 class="step-title"><?= t('tapioca.step3_title') ?></h3>
        <p class="step-desc"><?= t('tapioca.step3_desc') ?></p>
      </div>
    </div>

    <figure class="tapioca-video-figure">
      <div class="tapioca-video-frame">
        <video src="/assets/como-se-hace-una-tapioca.mp4" poster="/uploads/tapioca-video-poster.jpg" controls autoplay muted loop playsinline preload="auto"></video>
      </div>
      <figcaption class="tapioca-video-caption"><?= t('tapioca.video_caption') ?></figcaption>
    </figure>
  </section>

  <section class="tapioca-restobar" data-screen-label="Resto Bar">
    <div class="tapioca-restobar-inner">
      <div class="tapioca-restobar-head">
        <div class="tapioca-restobar-heading">
          <span class="eyebrow"><?= t('tapioca.restobar_eyebrow') ?></span>
          <h2 class="section-title"><?= t('tapioca.restobar_title') ?></h2>
        </div>
        <p class="tapioca-restobar-desc"><?= t('tapioca.restobar_desc') ?></p>
      </div>

      <div class="tapioca-restobar-grid">
        <?php foreach ($galleryImgs as $i => $file): ?>
        <figure>
          <img loading="lazy" src="/uploads/<?= $file ?>" alt="<?= htmlspecialchars($gallery[$i]['alt']) ?>">
          <figcaption><?= htmlspecialchars($gallery[$i]['caption']) ?></figcaption>
        </figure>
        <?php endforeach; ?>
      </div>

      <div class="tapioca-cta-wrap">
        <a class="cta-button" href="<?= page_url('menu') ?>"><?= t('tapioca.cta') ?></a>
      </div>
    </div>
  </section>

  <?php $FOOTER_VEGAN_KEY = 'footer_vegan'; require __DIR__ . '/inc/footer.php'; ?>

</div>

<?php require __DIR__ . '/inc/site-signature.php'; ?>

</body>
</html>
