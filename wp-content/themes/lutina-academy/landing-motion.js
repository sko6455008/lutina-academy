(() => {
  'use strict';
  const root = document.querySelector('.lp');
  if (!root || !('IntersectionObserver' in window) || !Element.prototype.animate) return;

  const preference = window.matchMedia('(prefers-reduced-motion: reduce)');
  const targets = root.querySelectorAll([
    '.lp-section-title', '.lp-policy-title', '.lp-target-lead', '.lp-honeycomb',
    '.lp-promise-intro', '.lp-promise-statement', '.lp-wide-photo', '.lp-feature',
    '.lp-policy-card', '.lp-profile-heading', '.lp-profile-grid', '.lp-profile-genres',
    '.lp-teacher-comment .lp-container > *', '.lp-flow-grid > li', '.lp-course',
    '.lp-voice', '.lp-faq-item', '.lp-final-note', '.lp-section .lp-cta-wrap', '.lp-trial'
  ].join(','));
  const seen = new WeakSet();
  const running = new Set();
  let observer;

  function reveal(element) {
    seen.add(element);
    // Never hide content in CSS: it remains readable without JS or an observer.
    if (preference.matches || element.contains(document.activeElement)) return;
    const siblings = element.parentElement.children;
    const stagger = /grid|faq-list/.test(element.parentElement.className)
      ? (Array.prototype.indexOf.call(siblings, element) % 3) * 90 : 0;
    const animation = element.animate([
      {opacity:0, transform:'translateY(20px)'},
      {opacity:1, transform:'translateY(0)'}
    ], {duration:650, delay:stagger, easing:'cubic-bezier(.22,1,.36,1)', fill:'backwards'});
    running.add(animation);
    animation.onfinish = animation.oncancel = () => running.delete(animation);
  }

  function observe() {
    observer?.disconnect();
    if (preference.matches) {
      running.forEach(animation => animation.cancel());
      return;
    }
    observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        observer.unobserve(entry.target);
        if (!seen.has(entry.target)) reveal(entry.target);
      });
    }, {threshold:0, rootMargin:'0px 0px -36px 0px'});
    targets.forEach(element => {
      if (!seen.has(element)) observer.observe(element);
    });
  }

  // Keyboard navigation must never land in a temporarily transparent element.
  root.addEventListener('focusin', event => {
    running.forEach(animation => {
      if (animation.effect.target.contains(event.target)) animation.cancel();
    });
  });
  window.addEventListener('beforeprint', () => {
    running.forEach(animation => animation.cancel());
  });
  preference.addEventListener('change', observe);
  observe();
})();
