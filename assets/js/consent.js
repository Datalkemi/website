/**
 * Datalkemi cookie consent.
 *
 * Choice is kept in localStorage as dk-consent: {"v":1,"analytics":true|false,"t":<ms>}.
 * Scripts marked type="text/plain" data-dk-consent="analytics" run only after
 * the visitor accepts. Any element with data-dk-consent-open reopens the banner.
 */
(function () {
  'use strict';

  var KEY = 'dk-consent';
  var VERSION = 1;
  var HUBSPOT_COOKIES = ['__hstc', 'hubspotutk', '__hssc', '__hssrc', 'messagesUtk'];

  function read() {
    try {
      var v = JSON.parse(localStorage.getItem(KEY) || 'null');
      return v && v.v === VERSION ? v : null;
    } catch (e) { return null; }
  }

  function write(analytics) {
    var v = { v: VERSION, analytics: !!analytics, t: Date.now() };
    try { localStorage.setItem(KEY, JSON.stringify(v)); } catch (e) { /* storage blocked: choice lasts this page view */ }
    return v;
  }

  function activate() {
    var held = document.querySelectorAll('script[type="text/plain"][data-dk-consent="analytics"]');
    Array.prototype.forEach.call(held, function (old) {
      var s = document.createElement('script');
      s.src = old.getAttribute('data-dk-src');
      s.async = true;
      if (old.id) s.id = old.id;
      old.parentNode.replaceChild(s, old);
    });
  }

  function clearHubSpot() {
    var host = location.hostname.replace(/^www\./, '');
    HUBSPOT_COOKIES.forEach(function (name) {
      ['', host, '.' + host].forEach(function (d) {
        document.cookie = name + '=; Max-Age=0; path=/' + (d ? '; domain=' + d : '');
      });
    });
  }

  var banner;

  function show() {
    if (!banner) return;
    banner.hidden = false;
    requestAnimationFrame(function () { banner.classList.add('is-visible'); });
    document.body.classList.add('has-consent-banner');
  }

  function hide() {
    if (!banner) return;
    banner.classList.remove('is-visible');
    document.body.classList.remove('has-consent-banner');
    setTimeout(function () { banner.hidden = true; }, 250);
  }

  function choose(all) {
    var before = read();
    write(all);
    if (all) {
      activate();
    } else if (before && before.analytics) {
      // Withdrawn: remove HubSpot's cookies and reload so its running script is gone
      clearHubSpot();
      location.reload();
      return;
    }
    hide();
  }

  function init() {
    banner = document.getElementById('dk-consent');
    var current = read();

    if (current && current.analytics) {
      activate();
    } else if (!current) {
      show();
    }

    document.addEventListener('click', function (e) {
      var choice = e.target.closest('[data-dk-consent-choice]');
      if (choice) {
        choose(choice.getAttribute('data-dk-consent-choice') === 'all');
        return;
      }
      var opener = e.target.closest('[data-dk-consent-open]');
      if (opener) {
        e.preventDefault();
        show();
        var first = banner && banner.querySelector('[data-dk-consent-choice]');
        if (first) first.focus();
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
}());
