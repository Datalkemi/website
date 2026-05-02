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

  // ── Contact form AJAX ───────────────────────────────────────────────────
  const contactForm = document.getElementById('dk-contact-form');
  if (contactForm && typeof DK_AJAX !== 'undefined') {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const btn     = document.getElementById('dk-contact-submit');
      const success = document.getElementById('dk-contact-success');
      const error   = document.getElementById('dk-contact-error');
      const label   = btn.querySelector('.btn-label');
      const loading = btn.querySelector('.btn-loading');

      btn.disabled = true;
      label.style.display  = 'none';
      loading.style.display = '';
      error.style.display  = 'none';

      const data = new FormData(contactForm);
      data.append('action', 'dk_contact_submit');
      data.append('nonce',  DK_AJAX.contact_nonce);

      try {
        const res  = await fetch(DK_AJAX.url, { method: 'POST', body: data });
        const json = await res.json();
        if (json.success) {
          contactForm.style.display = 'none';
          success.style.display     = 'flex';
        } else {
          error.textContent    = json.data || 'Something went wrong. Please try again.';
          error.style.display  = 'block';
          btn.disabled         = false;
          label.style.display  = '';
          loading.style.display = 'none';
        }
      } catch {
        error.textContent    = 'Network error. Please try again or email us directly.';
        error.style.display  = 'block';
        btn.disabled         = false;
        label.style.display  = '';
        loading.style.display = 'none';
      }
    });
  }

  // ── Post reactions (likes / dislikes) ───────────────────────────────────
  if (typeof DK_AJAX !== 'undefined') {
    document.querySelectorAll('.reaction-btn[data-reaction]').forEach(btn => {
      btn.addEventListener('click', async () => {
        if (btn.disabled) return;
        const postId   = btn.dataset.post;
        const reaction = btn.dataset.reaction;

        const data = new FormData();
        data.append('action',   'dk_post_reaction');
        data.append('nonce',    DK_AJAX.reaction_nonce);
        data.append('post_id',  postId);
        data.append('reaction', reaction);

        try {
          const res  = await fetch(DK_AJAX.url, { method: 'POST', body: data });
          const json = await res.json();
          if (json.success) {
            const count = btn.querySelector('.reaction-count');
            if (count) count.textContent = json.data.count;
            btn.classList.add('is-voted');
            // Disable all reaction buttons for this post
            document.querySelectorAll(`.reaction-btn[data-post="${postId}"]`).forEach(b => {
              b.disabled = true;
            });
          }
        } catch { /* silent fail */ }
      });
    });
  }

});
