<?php
$page = 'historia';
require __DIR__ . '/inc/i18n.php';

$article = [
  '@type' => 'Article',
  'headline' => t('meta.historia.og_title'),
  'description' => t('meta.historia.description'),
  'image' => SITE_BASE_URL . '/assets/historia/historia-ch1-trailer.webp',
  'inLanguage' => LANG_META[$lang]['hreflang'],
  'about' => 'La Tapioquería founding story',
  'publisher' => ['@type' => 'Restaurant', 'name' => 'La Tapioquería'],
  'mainEntityOfPage' => lang_url('historia', $lang),
];
if ($lang === 'es') {
    $article['workTranslation'] = [lang_url('historia', 'en'), lang_url('historia', 'pt')];
} else {
    $article['translationOfWork'] = lang_url('historia', 'es');
    $other = $lang === 'en' ? 'pt' : 'en';
    $article['workTranslation'] = [lang_url('historia', $other)];
}

$jsonld = [
  '@context' => 'https://schema.org',
  '@graph' => [
    [
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
      'url' => lang_url('historia', $lang),
    ],
    $article,
    [
      '@type' => 'BreadcrumbList',
      'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => t('common.brand_name'), 'item' => lang_url('home', $lang)],
        ['@type' => 'ListItem', 'position' => 2, 'name' => strip_tags(str_replace('<br>', ' ', t('historia.hero_title'))), 'item' => lang_url('historia', $lang)],
      ],
    ],
  ],
];
?>
<!DOCTYPE html>
<html lang="<?= LANG_META[$lang]['html_lang'] ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= hreflang_block('historia') ?>
<title><?= t('meta.historia.title') ?></title>
<meta name="description" content="<?= t('meta.historia.description') ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= t('meta.historia.og_title') ?>">
<meta property="og:description" content="<?= t('meta.historia.og_description') ?>">
<meta property="og:image" content="<?= SITE_BASE_URL ?>/assets/og-tapioca.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="1200">
<meta property="og:url" content="<?= lang_url('historia', $lang) ?>">
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
<link rel="stylesheet" href="/css/historia.css">
<script type="application/ld+json"><?= json_encode($jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?></script>
</head>
<body>

<?php require __DIR__ . '/inc/wa-fab.php'; ?>

<input type="checkbox" id="historia-video-toggle" class="photo-toggle">
<div class="photo-modal historia-video-modal">
  <label for="historia-video-toggle" class="photo-modal-backdrop"></label>
  <div class="photo-modal-box historia-video-modal-box">
    <label for="historia-video-toggle" class="photo-modal-close" aria-label="<?= t('menu.close_aria') ?>">✕</label>
    <video class="historia-video" src="/assets/historia/tapio_historia_video.mp4" controls playsinline preload="none" poster="/assets/historia/historia-video-poster.webp"></video>
    <p class="historia-video-caption"><?= t('historia.video_caption') ?></p>
  </div>
</div>

<div class="historia-page">

  <header class="historia-hero" data-screen-label="Hero — Nuestra Historia">
    <img class="historia-hero-bg historia-hero-bg--desktop" src="/assets/mural/mural_sombra.webp" alt="" aria-hidden="true">
    <img class="historia-hero-bg historia-hero-bg--mobile" src="/assets/mural/mural_sombra_mb.webp" alt="" aria-hidden="true">
    <img class="historia-hero-plant historia-hero-plant--left" src="/assets/mural/mural_centro.webp" alt="" aria-hidden="true">
    <img class="historia-hero-plant historia-hero-plant--right" src="/assets/mural/mural_derecho.webp" alt="" aria-hidden="true">
    <a class="back-link" href="<?= page_url('home') ?>"><?= t('common.back') ?></a>
    <?php require __DIR__ . '/inc/language-switcher.php'; ?>

    <div class="historia-hero-content">
      <h1 class="historia-hero-title"><?= t('historia.hero_title') ?></h1>
      <div class="historia-hero-subtitle">
        <span class="historia-hero-subtitle-line"></span>
        <span class="historia-hero-subtitle-text"><?= t('historia.hero_eyebrow') ?></span>
        <span class="historia-hero-subtitle-line"></span>
      </div>
      <p class="historia-hero-desc"><?= t('historia.hero_desc') ?></p>
    </div>
  </header>

  <div class="historia-video-cta-wrap">
    <label for="historia-video-toggle" class="historia-video-btn">
      <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"></path></svg>
      <?= t('historia.video_cta') ?>
    </label>
  </div>

  <section class="historia-timeline" data-screen-label="Línea de tiempo">
    <svg class="historia-road" viewBox="0 0 4 1000" preserveAspectRatio="none" aria-hidden="true">
      <path d="M2 0 L2 1000"></path>
    </svg>

    <article class="historia-chapter">
      <div class="historia-chapter-media">
        <img loading="lazy" src="/assets/historia/historia-ch1-trailer.webp" alt="<?= htmlspecialchars(t('historia.ch1_alt')) ?>">
      </div>
      <div class="historia-chapter-text">
        <span class="historia-chapter-year"><?= t('historia.ch1_year') ?></span>
        <span class="eyebrow"><?= t('historia.ch1_eyebrow') ?></span>
        <h2 class="section-title"><?= t('historia.ch1_title') ?></h2>
        <p><?= t('historia.ch1_text') ?></p>
      </div>
    </article>

    <article class="historia-chapter historia-chapter--reverse">
      <div class="historia-chapter-media">
        <img loading="lazy" src="/assets/historia/historia-ch2-san-marcos-sierras.webp" alt="<?= htmlspecialchars(t('historia.ch2_alt')) ?>">
      </div>
      <div class="historia-chapter-text">
        <span class="historia-chapter-year"><?= t('historia.ch2_year') ?></span>
        <span class="eyebrow"><?= t('historia.ch2_eyebrow') ?></span>
        <h2 class="section-title"><?= t('historia.ch2_title') ?></h2>
        <p><?= t('historia.ch2_text') ?></p>
      </div>
    </article>

    <article class="historia-chapter">
      <div class="historia-chapter-media">
        <img loading="lazy" src="/assets/historia/historia-ch3-mudanza-sma.webp" alt="<?= htmlspecialchars(t('historia.ch3_alt')) ?>">
      </div>
      <div class="historia-chapter-text">
        <span class="historia-chapter-year"><?= t('historia.ch3_year') ?></span>
        <span class="eyebrow"><?= t('historia.ch3_eyebrow') ?></span>
        <h2 class="section-title"><?= t('historia.ch3_title') ?></h2>
        <p><?= t('historia.ch3_text') ?></p>
      </div>
    </article>

    <article class="historia-chapter historia-chapter--reverse">
      <div class="historia-chapter-media">
        <img loading="lazy" src="/assets/historia/historia-ch4-playa-bonita.webp" alt="<?= htmlspecialchars(t('historia.ch4_alt')) ?>">
      </div>
      <div class="historia-chapter-text">
        <span class="historia-chapter-year"><?= t('historia.ch4_year') ?></span>
        <span class="eyebrow"><?= t('historia.ch4_eyebrow') ?></span>
        <h2 class="section-title"><?= t('historia.ch4_title') ?></h2>
        <p><?= t('historia.ch4_text') ?></p>
      </div>
    </article>

    <article class="historia-chapter">
      <div class="historia-chapter-media">
        <img loading="lazy" src="/assets/historia/historia-ch5-galeria-maiten.webp" alt="<?= htmlspecialchars(t('historia.ch5_alt')) ?>">
      </div>
      <div class="historia-chapter-text">
        <span class="historia-chapter-year"><?= t('historia.ch5_year') ?></span>
        <span class="eyebrow"><?= t('historia.ch5_eyebrow') ?></span>
        <h2 class="section-title"><?= t('historia.ch5_title') ?></h2>
        <p><?= t('historia.ch5_text') ?></p>
      </div>
    </article>

    <article class="historia-chapter historia-chapter--reverse">
      <div class="historia-chapter-media">
        <img loading="lazy" src="/assets/historia/historia-ch6-resto-bar.webp" alt="<?= htmlspecialchars(t('historia.ch6_alt')) ?>">
      </div>
      <div class="historia-chapter-text">
        <span class="historia-chapter-year"><?= t('historia.ch6_year') ?></span>
        <span class="eyebrow"><?= t('historia.ch6_eyebrow') ?></span>
        <h2 class="section-title"><?= t('historia.ch6_title') ?></h2>
        <p><?= t('historia.ch6_text') ?></p>
      </div>
    </article>
  </section>

  <section class="historia-closing" data-screen-label="Cierre">
    <img loading="lazy" class="historia-closing-img" src="/assets/historia/historia-closing-luci.webp" alt="<?= htmlspecialchars(t('historia.closing_alt')) ?>">
    <div class="historia-closing-text">
      <span class="eyebrow eyebrow--light"><?= t('historia.closing_eyebrow') ?></span>
      <h2 class="section-title section-title--light"><?= t('historia.closing_title') ?></h2>
      <p><?= t('historia.closing_text') ?></p>
      <a class="cta-button" href="<?= page_url('menu') ?>"><?= t('historia.cta') ?></a>
    </div>
  </section>

  <?php $FOOTER_VEGAN_KEY = 'footer_vegan'; require __DIR__ . '/inc/footer.php'; ?>

</div>

<?php require __DIR__ . '/inc/site-signature.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="/js/historia.js"></script>
</body>
</html>
