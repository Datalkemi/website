/**
 * Datalkemi — main.js
 */

document.addEventListener('DOMContentLoaded', () => {

  // ── Sticky header ───────────────────────────────────────────────────────
  const header = document.getElementById('masthead');
  if (header) {
    const onScroll = () => {
      header.classList.toggle('scrolled', window.scrollY > 20);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  // ── Mobile nav toggle ───────────────────────────────────────────────────
  const toggle = document.querySelector('.nav-toggle');
  const menuWrap = document.querySelector('.nav-menu-wrap');
  if (toggle && menuWrap) {
    toggle.addEventListener('click', () => {
      const expanded = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!expanded));
      menuWrap.classList.toggle('is-open');
    });
  }

  // ── Smooth scroll for anchor links ──────────────────────────────────────
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', e => {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth' });
        // Close mobile menu if open
        if (menuWrap) menuWrap.classList.remove('is-open');
      }
    });
  });

  // ── Scroll-to-top button ────────────────────────────────────────────────
  const scrollBtn = document.querySelector('.scroll-to-top');
  if (scrollBtn) {
    window.addEventListener('scroll', () => {
      scrollBtn.classList.toggle('visible', window.scrollY > 400);
    }, { passive: true });
    scrollBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ── Intersection observer: fade-in sections ─────────────────────────────
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });

  document.querySelectorAll('section').forEach(section => {
    section.classList.add('fade-in');
    observer.observe(section);
  });

});
