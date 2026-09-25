<?php
$page = 'home';
require __DIR__ . '/inc/i18n.php';

$jsonld = [
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
  'hasMenu' => lang_url('menu', $lang),
  'url' => lang_url('home', $lang),
];
?>
<!DOCTYPE html>
<html lang="<?= LANG_META[$lang]['html_lang'] ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= hreflang_block('home') ?>
<title><?= t('meta.home.title') ?></title>
<meta name="description" content="<?= t('meta.home.description') ?>">
<meta property="og:type" content="restaurant.restaurant">
<meta property="og:title" content="<?= t('meta.home.og_title') ?>">
<meta property="og:description" content="<?= t('meta.home.og_description') ?>">
<meta property="og:image" content="<?= SITE_BASE_URL ?>/assets/og-tapioca.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="1200">
<meta property="og:url" content="<?= lang_url('home', $lang) ?>">
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
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Figtree:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/base.css">
<link rel="stylesheet" href="/css/inicio.css">
<script type="application/ld+json"><?= json_encode($jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?></script>
</head>
<body>

<?php require __DIR__ . '/inc/wa-fab.php'; ?>

<section class="hero" data-screen-label="Portada">
  <img class="hero-bg hero-bg--desktop" src="/assets/mural/mural_sombra.webp" alt="" aria-hidden="true">
  <img class="hero-bg hero-bg--mobile" src="/assets/mural/mural_sombra_mb.webp" alt="" aria-hidden="true">

  <img class="mural-plant mural-plant--left" src="/assets/mural/mural_centro.webp" alt="" aria-hidden="true">
  <img class="mural-plant mural-plant--right" src="/assets/mural/mural_derecho.webp" alt="" aria-hidden="true">

  <?php require __DIR__ . '/inc/language-switcher.php'; ?>

  <div class="hero-content">
    <h1 class="hero-title"><img class="hero-title-img" src="/assets/logo-tapioqueria-texto.svg" alt="La Tapioquería"></h1>
    <div class="hero-subtitle">
      <span class="hero-subtitle-line"></span>
      <span class="hero-subtitle-text"><?= t('home.hero_subtitle') ?></span>
      <span class="hero-subtitle-line"></span>
    </div>
    <img class="hero-gluten-badge" src="/assets/sin_gluten.svg" alt="<?= t('home.gluten_badge_alt') ?>">
  </div>

  <div class="hero-scroll-hint">
    <div class="hero-scroll-chip">
      <span class="hero-scroll-label"><?= t('home.scroll_label') ?></span>
      <div class="hero-scroll-track">
        <span class="hero-scroll-dot"></span>
      </div>
    </div>
  </div>
</section>

<section class="landing" data-screen-label="Menú principal">
  <div class="landing-glow landing-glow--top"></div>
  <div class="landing-glow landing-glow--bottom"></div>

  <header class="landing-header">
    <span class="landing-eyebrow"><?= t('home.eyebrow') ?></span>
    <h2 class="landing-title"><?= t('home.landing_title') ?></h2>
  </header>

  <nav class="landing-nav">
    <a class="nav-card nav-card--cream" href="<?= page_url('que-es-una-tapioca') ?>">
      <span class="nav-card-index">01</span>
      <span class="nav-card-label"><?= t('home.nav_tapioca') ?><span class="nav-card-arrow">→</span></span>
    </a>
    <a class="nav-card nav-card--terracota" href="<?= page_url('menu') ?>">
      <span class="nav-card-index">02</span>
      <span class="nav-card-label"><?= t('home.nav_menu') ?><span class="nav-card-arrow">→</span></span>
    </a>
    <a class="nav-card nav-card--sage" href="<?= page_url('donde-encontrarnos') ?>">
      <span class="nav-card-index">03</span>
      <span class="nav-card-label"><?= t('home.nav_donde') ?><span class="nav-card-arrow">→</span></span>
    </a>
  </nav>

  <p class="landing-tagline"><?= t('home.tagline') ?></p>
</section>

<section class="social-proof" data-screen-label="Instagram y reseñas">
  <script async src="https://feeds.marcosoft.com.ar/embed.js"></script>

  <div class="social-proof-block">
    <header class="social-proof-heading">
      <span class="landing-eyebrow"><?= t('home.social_ig_eyebrow') ?></span>
      <h2 class="landing-title social-proof-title"><?= t('home.social_ig_title') ?></h2>
    </header>
    <div class="social-proof-widget">
      <social-wall data-id="352a0cf8424f24ad"></social-wall>
    </div>
  </div>

  <div class="social-proof-block">
    <header class="social-proof-heading">
      <span class="landing-eyebrow"><?= t('home.social_reviews_eyebrow') ?></span>
      <h2 class="landing-title social-proof-title"><?= t('home.social_reviews_title') ?></h2>
    </header>
    <div class="social-proof-widget">
      <social-wall data-id="030acb474d661400"></social-wall>
    </div>
  </div>
</section>

<?php $FOOTER_HOME = true; require __DIR__ . '/inc/footer.php'; ?>

<?php require __DIR__ . '/inc/site-signature.php'; ?>

</body>
</html>
