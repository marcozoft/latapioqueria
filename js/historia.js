/* La Tapioquería — interacciones de "Nuestra Historia". */
(function () {
  // ---- Modal del video: lo arranca al abrir, lo pausa al cerrar ----
  // (el abrir/cerrar en sí es CSS puro vía el checkbox .historia-video-toggle,
  // esto es solo para que no siga sonando de fondo una vez cerrado).
  var videoToggle = document.getElementById('historia-video-toggle');
  var video = document.querySelector('.historia-video');
  if (videoToggle && video) {
    videoToggle.addEventListener('change', function () {
      if (videoToggle.checked) {
        video.play().catch(function () {});
      } else {
        video.pause();
      }
    });
  }

  // ---- Animaciones de scroll (GSAP + ScrollTrigger) ----
  // Progressive enhancement: si GSAP no cargó (CDN caído, JS deshabilitado)
  // esta función corta antes de agregar la clase que oculta el contenido
  // para la animación, así que la página queda perfectamente legible sin JS.
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    return;
  }

  gsap.registerPlugin(ScrollTrigger);
  document.documentElement.classList.add('historia-js-ready');

  // ---- Capítulos: revelado al entrar en viewport ----
  gsap.utils.toArray('.historia-chapter').forEach(function (chapter) {
    var media = chapter.querySelector('.historia-chapter-media');
    var text = chapter.querySelector('.historia-chapter-text');
    gsap.to([media, text], {
      opacity: 1,
      y: 0,
      duration: 0.9,
      ease: 'power2.out',
      stagger: 0.15,
      scrollTrigger: {
        trigger: chapter,
        start: 'top 82%',
      },
    });
  });

  // ---- Cierre ----
  var closingImg = document.querySelector('.historia-closing-img');
  var closingText = document.querySelector('.historia-closing-text');
  if (closingImg && closingText) {
    gsap.to([closingImg, closingText], {
      opacity: 1,
      y: 0,
      duration: 0.9,
      ease: 'power2.out',
      stagger: 0.15,
      scrollTrigger: {
        trigger: '.historia-closing',
        start: 'top 78%',
      },
    });
  }

  // ---- Camino que se dibuja al lado de los capítulos ----
  var roadPath = document.querySelector('.historia-road path');
  if (roadPath) {
    var length = roadPath.getTotalLength();
    roadPath.style.strokeDasharray = length;
    roadPath.style.strokeDashoffset = length;
    gsap.to(roadPath, {
      strokeDashoffset: 0,
      ease: 'none',
      scrollTrigger: {
        trigger: '.historia-timeline',
        start: 'top 70%',
        end: 'bottom 80%',
        scrub: true,
      },
    });
  }
})();
