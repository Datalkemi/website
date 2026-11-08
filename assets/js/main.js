/**
 * Datalkemi main.js
 */

document.addEventListener('DOMContentLoaded', () => {

  // ── Theme toggle (light / dark) ─────────────────────────────────────────
  const root = document.documentElement;
  const syncToggleLabels = () => {
    const isDark = root.getAttribute('data-theme') === 'dark';
    document.querySelectorAll('[data-theme-toggle]').forEach((btn) => {
      btn.setAttribute('aria-pressed', String(isDark));
      btn.setAttribute('aria-label', isDark ? 'Switch to light theme' : 'Switch to dark theme');
    });
  };
  const themeMeta = document.getElementById('dk-theme-color');
  const applyTheme = (t) => {
    root.setAttribute('data-theme', t);
    if (themeMeta) themeMeta.setAttribute('content', t === 'dark' ? '#022D3F' : '#F5FAFD');
    syncToggleLabels();
  };
  const savedTheme = () => {
    try { const s = localStorage.getItem('dk-theme'); return (s === 'light' || s === 'dark') ? s : null; } catch (e) { return null; }
  };
  document.querySelectorAll('[data-theme-toggle]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      try { localStorage.setItem('dk-theme', next); } catch (e) { /* storage blocked */ }
      applyTheme(next);
    });
  });
  // Until the visitor picks a theme, follow the device as it changes (for example at sunset)
  if (window.matchMedia) {
    const schemeMq = window.matchMedia('(prefers-color-scheme: dark)');
    schemeMq.addEventListener('change', (e) => { if (!savedTheme()) applyTheme(e.matches ? 'dark' : 'light'); });
  }
  syncToggleLabels();

  // ── Sticky header ───────────────────────────────────────────────────────
  const header = document.getElementById('masthead');
  if (header) {
    const adminBar = document.getElementById('wpadminbar');
    const threshold = adminBar ? adminBar.offsetHeight + 20 : 20;
    const onScroll = () => {
      header.classList.toggle('scrolled', window.scrollY > threshold);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // set correct initial state on page load
  }

  // ── Expose the header height for sticky elements below it ──────────────
  const setHeaderH = () => {
    const h = document.getElementById('masthead');
    if (h) root.style.setProperty('--dk-header-h', h.offsetHeight + 'px');
  };
  setHeaderH();
  window.addEventListener('resize', setHeaderH, { passive: true });

  // ── Mobile drawer menu (slides in from the right below 1024px) ─────────
  const toggle   = document.querySelector('.nav-toggle');
  const menuWrap = document.querySelector('.nav-menu-wrap');
  const backdrop = document.querySelector('.nav-backdrop');
  const mobileMq = window.matchMedia('(max-width: 1023px)');
  let lastFocus  = null;

  const openMenu = () => {
    if (!menuWrap) return;
    lastFocus = document.activeElement;
    menuWrap.classList.add('is-open');
    document.body.classList.add('nav-open');
    if (backdrop) { backdrop.hidden = false; requestAnimationFrame(() => backdrop.classList.add('is-visible')); }
    if (toggle) { toggle.setAttribute('aria-expanded', 'true'); toggle.setAttribute('aria-label', 'Close menu'); }
    const first = menuWrap.querySelector('.nav-drawer-close');
    if (first) setTimeout(() => first.focus(), 250);
  };
  const closeMenu = () => {
    if (!menuWrap || !menuWrap.classList.contains('is-open')) return;
    menuWrap.classList.remove('is-open');
    document.body.classList.remove('nav-open');
    if (backdrop) { backdrop.classList.remove('is-visible'); setTimeout(() => { backdrop.hidden = true; }, 250); }
    if (toggle) { toggle.setAttribute('aria-expanded', 'false'); toggle.setAttribute('aria-label', 'Open menu'); }
    if (lastFocus && lastFocus.focus) lastFocus.focus();
  };
  if (toggle && menuWrap) {
    toggle.addEventListener('click', () => {
      menuWrap.classList.contains('is-open') ? closeMenu() : openMenu();
    });
    document.querySelectorAll('[data-nav-close]').forEach((el) => el.addEventListener('click', closeMenu));
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeMenu(); });
    mobileMq.addEventListener('change', (e) => { if (!e.matches) closeMenu(); });
    menuWrap.querySelectorAll('a').forEach((a) => a.addEventListener('click', () => {
      if (mobileMq.matches && !a.closest('.nav-has-dropdown > a') ) closeMenu();
    }));

    // Submenus become accordions inside the drawer
    menuWrap.querySelectorAll('.nav-has-dropdown').forEach((li) => {
      const link = li.querySelector(':scope > a');
      if (!link) return;
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'nav-sub-toggle';
      btn.setAttribute('aria-expanded', 'false');
      btn.setAttribute('aria-label', 'Show ' + link.textContent.trim() + ' pages');
      btn.innerHTML = '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>';
      link.after(btn);
      btn.addEventListener('click', () => {
        const open = li.classList.toggle('is-expanded');
        btn.setAttribute('aria-expanded', String(open));
      });
    });

    // Swipe right to close
    let startX = null;
    menuWrap.addEventListener('touchstart', (e) => { startX = e.touches[0].clientX; }, { passive: true });
    menuWrap.addEventListener('touchend', (e) => {
      if (startX !== null && e.changedTouches[0].clientX - startX > 70) closeMenu();
      startX = null;
    }, { passive: true });
  }

  // ── Footer link columns collapse into accordions on phones ──────────────
  const footMq = window.matchMedia('(max-width: 640px)');
  document.querySelectorAll('.ft-col').forEach((col) => {
    const head = col.querySelector('.ft-col-heading');
    if (!head) return;
    head.setAttribute('role', 'button');
    head.setAttribute('tabindex', '0');
    const flip = () => {
      if (!footMq.matches) return;
      const open = col.classList.toggle('is-open');
      head.setAttribute('aria-expanded', String(open));
    };
    head.addEventListener('click', flip);
    head.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); flip(); } });
    head.setAttribute('aria-expanded', 'false');
  });

  // ── Smooth scroll for anchor links ──────────────────────────────────────
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', e => {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth' });
        // Close mobile menu if open
        closeMenu();
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

  // ── Get a Quote page form AJAX ─────────────────────────────────────────
  const quoteForm = document.getElementById('dk-quote-form');
  if (quoteForm && typeof DK_AJAX !== 'undefined') {
    quoteForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const btn     = document.getElementById('dk-quote-submit');
      const success = document.getElementById('dk-quote-success');
      const error   = document.getElementById('dk-quote-error');
      const origHtml = btn.innerHTML;

      btn.disabled = true;
      btn.textContent = 'Sending...';
      error.style.display = 'none';

      const data = new FormData(quoteForm);
      data.append('action', 'dk_quote_submit');
      data.append('nonce',  DK_AJAX.quote_nonce);

      const fail = (msg) => {
        error.textContent   = msg;
        error.style.display = 'block';
        btn.disabled  = false;
        btn.innerHTML = origHtml;
      };

      try {
        const res  = await fetch(DK_AJAX.url, { method: 'POST', body: data });
        const json = await res.json();
        if (json.success) {
          quoteForm.style.display = 'none';
          success.style.display   = 'flex';
          success.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
          fail(json.data || 'Something went wrong. Please try again.');
        }
      } catch {
        fail('Network error. Please try again or email info@datalkemi.com directly.');
      }
    });
  }

  // ── Newsletter form AJAX ───────────────────────────────────────────────
  const newsletterForm = document.querySelector('.ft-newsletter-form');
  if (newsletterForm && typeof DK_AJAX !== 'undefined') {
    newsletterForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const btn      = newsletterForm.querySelector('.ft-newsletter-btn');
      const feedback = newsletterForm.querySelector('.ft-newsletter-feedback');
      const fieldRow = newsletterForm.querySelector('.ft-newsletter-field-row');
      const privacy  = newsletterForm.querySelector('.ft-newsletter-privacy');
      const origText = btn.textContent;

      btn.disabled    = true;
      btn.textContent = 'Subscribing…';
      feedback.className   = 'ft-newsletter-feedback';
      feedback.textContent = '';

      const data = new FormData(newsletterForm);
      data.set('page_uri',  window.location.href);
      data.set('page_name', document.title);

      try {
        const res  = await fetch(DK_AJAX.url, { method: 'POST', body: data });
        const json = await res.json();
        if (json.success) {
          if (fieldRow) fieldRow.style.display = 'none';
          if (privacy)  privacy.style.display  = 'none';
          feedback.className   = 'ft-newsletter-feedback is-success';
          feedback.textContent = "Thanks. You’re subscribed.";
        } else {
          const msgs = {
            invalid_email: 'Please enter a valid email address.',
            rate_limited:  'Too many attempts. Please try again later.',
          };
          feedback.className   = 'ft-newsletter-feedback is-error';
          feedback.textContent = msgs[json.data] || 'Something went wrong. Please try again or email info@datalkemi.com.';
          btn.disabled    = false;
          btn.textContent = origText;
        }
      } catch {
        feedback.className   = 'ft-newsletter-feedback is-error';
        feedback.textContent = 'Something went wrong. Please try again or email info@datalkemi.com.';
        btn.disabled    = false;
        btn.textContent = origText;
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
