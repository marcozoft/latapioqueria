<?php
/**
 * Footer compartido por las 4 páginas traducidas. Antes este HTML estaba
 * repetido a mano en cada .html (no había forma de compartirlo); ahora
 * que el sitio corre en PHP, un cambio acá se refleja en todas.
 *
 * Variables opcionales que puede setear la página antes de incluir esto:
 *   $FOOTER_HOME       (bool) agrega la clase site-footer--home (solo index)
 *   $FOOTER_NO_GLUTEN  (bool) oculta la cinta de gluten (donde-encontrarnos no la tiene)
 *   $FOOTER_VEGAN_KEY  (string) key dentro de 'common' para la línea vegana
 *                      (menu.php usa 'footer_vegan_menu', el resto 'footer_vegan')
 */
$footerClass = 'site-footer' . (!empty($FOOTER_HOME) ? ' site-footer--home' : '');
$veganKey = $FOOTER_VEGAN_KEY ?? 'footer_vegan';
?>
<footer class="<?= $footerClass ?>" data-screen-label="Pie">
  <img loading="lazy" class="footer-bg" src="/assets/mural/mural_sombra2.webp" alt="" aria-hidden="true">
  <img loading="lazy" class="footer-plant footer-plant--left" src="/assets/mural/mural_centro.webp" alt="" aria-hidden="true">
  <img loading="lazy" class="footer-plant footer-plant--right" src="/assets/mural/mural_derecho.webp" alt="" aria-hidden="true">
  <div class="footer-bg-overlay" aria-hidden="true"></div>

  <?php if (empty($FOOTER_NO_GLUTEN)): ?>
  <div class="footer-ribbon footer-ribbon--gluten">
    <svg viewBox="0 0 760 150" preserveAspectRatio="none" aria-hidden="true"><path fill="#33361f" d="M4 78C20 40 62 26 122 19c68-8 140 8 210 0 72-8 142 10 214 3 62-6 138 8 186 26 22 8 26 30 14 48-12 19-52 32-112 37-84 7-172-6-256 0-88 6-176-3-244-9-56-5-102-16-122-32-8-7-10-11-8-14z"></path></svg>
    <div class="footer-ribbon-content">
      <span class="footer-gluten-line"><?= t('common.footer_gluten') ?></span>
      <span class="footer-gluten-line footer-gluten-line--accent"><?= t('common.' . $veganKey) ?></span>
    </div>
  </div>
  <?php endif; ?>

  <div class="footer-ribbon footer-ribbon--brand">
    <svg viewBox="0 0 800 210" preserveAspectRatio="none" aria-hidden="true"><path fill="#c1502e" d="M6 108C28 62 84 36 156 26c90-13 182 6 274-3 90-9 180 12 260 6 62-5 100 22 102 62 2 40-22 68-84 84-84 22-198 14-298 12-104-2-206 8-282-6-66-12-112-34-128-56-6-8-6-13 6-17z"></path></svg>
    <div class="footer-ribbon-content">
      <span class="footer-brand-name"><?= t('common.brand_name') ?></span>
      <span class="footer-brand-address"><?= t('common.brand_address') ?></span>
    </div>
  </div>

  <div class="social-row">
    <a class="social-icon" href="https://www.instagram.com/latapioqueria.sma" target="_blank" rel="noopener" aria-label="<?= t('common.ig_aria') ?>">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fdf1e0" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><circle cx="17.2" cy="6.8" r="1.1" fill="#fdf1e0" stroke="none"></circle></svg>
    </a>
    <a class="social-icon" href="https://www.facebook.com/p/Latapioqueriafoodtruck-100051627884903/" target="_blank" rel="noopener" aria-label="<?= t('common.fb_aria') ?>">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="#fdf1e0" aria-hidden="true"><path d="M13.5 21v-7.5H16l.5-3H13.5V8.5c0-.9.3-1.5 1.6-1.5H16.5V4.2C16.2 4.2 15.2 4 14 4c-2.4 0-4 1.5-4 4.2V10.5H7.5v3H10V21h3.5z"></path></svg>
    </a>
    <a class="social-icon" href="https://wa.me/5492944905540?text=<?= rawurlencode(t('common.wa_message')) ?>" target="_blank" rel="noopener" aria-label="<?= t('common.wa_footer_aria') ?>">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="#fdf1e0" aria-hidden="true"><path d="M12 2.2a9.8 9.8 0 0 0-8.4 14.8L2.2 21.8l4.9-1.3A9.8 9.8 0 1 0 12 2.2zm0 17.8a8 8 0 0 1-4.1-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8 8 0 1 1 12 20z"></path><path d="M16.6 14c-.2-.1-1.4-.7-1.6-.8-.2-.1-.4-.1-.6.1-.2.2-.6.8-.8 1-.1.2-.3.2-.5.1-.2-.1-1-.4-1.9-1.2-.7-.6-1.2-1.4-1.3-1.6-.1-.2 0-.4.1-.5.1-.1.2-.3.4-.4.1-.2.2-.3.2-.5.1-.2 0-.4 0-.5-.1-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.2-.9.9-.9 2.1s1 2.5 1.1 2.6c.1.2 1.9 2.9 4.7 4.1.7.3 1.2.4 1.6.6.7.2 1.3.2 1.7.1.5-.1 1.5-.6 1.8-1.2.2-.6.2-1 .2-1.2 0-.1-.2-.2-.4-.3z"></path></svg>
    </a>
  </div>
</footer>
