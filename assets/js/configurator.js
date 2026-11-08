/**
 * Datalkemi Project Configurator Wizard v3
 *
 * Flow: purpose, currency, then the sections that purpose uses, then the
 * estimate. Prices arrive in AUD from inc/configurator-data.php and are
 * shown in AUD, USD, or INR, each with its own rate, rounding, and digit
 * grouping.
 */
(function () {
  'use strict';

  var data       = window.DK_CONFIG || {};
  var CURRENCIES = data.currencies || { AUD: { symbol: 'A$', name: 'Australian dollars', rate: 1 } };
  var PURPOSES   = (data.purposes && data.purposes.options) || [];
  var SECTIONS   = data.sections || {};

  var currentStep  = 0;
  var purpose      = null;      // selected purpose object
  var currency     = 'AUD';
  var stepKeys     = [];        // section keys for the selected purpose
  var selections   = {};        // sectionKey => [{ id, label, price }]
  var animating    = false;

  var stepsWrap, prevBtn, nextBtn, progressFill, stepLabel, stepName;

  function esc(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }
  function cur() { return CURRENCIES[currency] || CURRENCIES.AUD; }
  function toLocal(aud) {
    var step = Math.max(1, Number(cur().round) || 1);
    return Math.round((aud * cur().rate) / step) * step;
  }
  function fmt(n) { return Number(n).toLocaleString(cur().locale || 'en-AU'); }
  function money(aud) { return cur().symbol + fmt(toLocal(aud)); }

  function isQuote() { return !!(purpose && purpose.quote); }
  function totalSteps() { return isQuote() ? 2 : 2 + stepKeys.length + 1; }
  function finalIndex() { return totalSteps() - 1; }

  /* Options visible for the chosen purpose, with per-purpose prices applied */
  function optionsFor(sectionKey) {
    var section = SECTIONS[sectionKey];
    if (!section || !purpose) return [];
    return section.options.filter(function (o) {
      return !o['for'] || o['for'].indexOf(purpose.id) !== -1;
    }).map(function (o) {
      var price = (o.prices && typeof o.prices[purpose.id] === 'number') ? o.prices[purpose.id] : (o.price || 0);
      return { id: o.id, label: o.label, desc: o.desc, price: price };
    });
  }

  function getTotalAUD() {
    var total = purpose ? (purpose.price || 0) : 0;
    stepKeys.forEach(function (key) {
      var items = selections[key] || [];
      items.forEach(function (i) { total += i.price || 0; });
    });
    return total;
  }

  function animateNumber(el, from, to) {
    if (!el) return;
    var start = performance.now();
    function step(now) {
      var p = Math.min((now - start) / 700, 1);
      var e = 1 - Math.pow(1 - p, 3);
      el.textContent = fmt(Math.round(from + (to - from) * e));
      if (p < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }

  /* Step 0: purpose */
  function renderPurposes() {
    var grid = document.getElementById('cfg-purpose-grid');
    if (!grid) return;
    grid.innerHTML = PURPOSES.map(function (p) {
      var selected = purpose && purpose.id === p.id;
      return '<button type="button" class="cfg-choice-card' + (selected ? ' is-selected' : '') + '" data-id="' + esc(p.id) + '">' +
        '<span class="cfg-choice-label">' + esc(p.label) + '</span>' +
        '<span class="cfg-choice-desc">' + esc(p.desc) + '</span>' +
        '<span class="cfg-choice-meta">' + (p.quote ? 'Quote on request' : 'from ' + money(p.price)) + '</span>' +
        '</button>';
    }).join('');
    grid.querySelectorAll('.cfg-choice-card').forEach(function (card) {
      card.addEventListener('click', function () {
        var next = PURPOSES.filter(function (p) { return p.id === card.dataset.id; })[0];
        if (!next) return;
        if (!purpose || purpose.id !== next.id) {
          purpose = next;
          buildSectionSteps();
        }
        renderPurposes();
        updateProgress();
        updateNav();
      });
    });
  }

  /* Step 1: currency */
  function renderCurrencies() {
    var grid = document.getElementById('cfg-currency-grid');
    if (!grid) return;
    grid.innerHTML = Object.keys(CURRENCIES).map(function (code) {
      var c = CURRENCIES[code];
      return '<button type="button" class="cfg-choice-card cfg-choice-card--currency' + (currency === code ? ' is-selected' : '') + '" data-code="' + esc(code) + '">' +
        '<span class="cfg-choice-label">' + esc(c.symbol) + ' ' + esc(code) + '</span>' +
        '<span class="cfg-choice-desc">' + esc(c.name) + '</span>' +
        '</button>';
    }).join('');
    grid.querySelectorAll('.cfg-choice-card').forEach(function (card) {
      card.addEventListener('click', function () {
        currency = card.dataset.code;
        renderCurrencies();
        renderPurposes();
        refreshPrices();
      });
    });
  }

  /* Steps 2..n: sections for the purpose */
  function buildSectionSteps() {
    var finalStep = document.getElementById('cfg-step-final');
    if (!finalStep || !stepsWrap) return;

    stepsWrap.querySelectorAll('.cfg-step[data-generated]').forEach(function (el) { el.remove(); });
    selections = {};
    stepKeys   = (purpose && purpose.steps ? purpose.steps : []).filter(function (k) {
      return SECTIONS[k] && optionsFor(k).length > 0;
    });

    stepKeys.forEach(function (key, i) {
      var section    = SECTIONS[key];
      var isCheckbox = section.type === 'checkbox';
      var inputType  = isCheckbox ? 'checkbox' : 'radio';
      var options    = optionsFor(key);
      var stepIndex  = i + 2;

      var optionsHtml = options.map(function (opt, j) {
        var isDefault = !isCheckbox && j === 0;
        return '<label class="cfg-opt-card' + (isDefault ? ' is-selected' : '') + '" for="' + esc(key) + '-' + esc(opt.id) + '">' +
          '<input type="' + inputType + '" id="' + esc(key) + '-' + esc(opt.id) + '" name="' + esc(key) + '" value="' + esc(opt.id) + '"' +
            ' data-price="' + (opt.price | 0) + '" data-label="' + esc(opt.label) + '"' + (isDefault ? ' checked' : '') + '>' +
          '<span class="cfg-opt-inner">' +
            '<span class="cfg-opt-icon" aria-hidden="true"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span>' +
            '<span class="cfg-opt-body"><span class="cfg-opt-label">' + esc(opt.label) + '</span><span class="cfg-opt-desc">' + esc(opt.desc) + '</span></span>' +
            '<span class="cfg-opt-price" data-aud="' + (opt.price | 0) + '">' + (opt.price > 0 ? '+ ' + money(opt.price) : 'Included') + '</span>' +
          '</span>' +
        '</label>';
      }).join('');

      var div = document.createElement('div');
      div.className = 'cfg-step';
      div.dataset.step = stepIndex;
      div.dataset.generated = '1';
      div.innerHTML =
        '<div class="cfg-step-header"><h2>' + esc(section.label) + '</h2>' +
          (section.note ? '<p class="cfg-step-note">' + esc(section.note) + '</p>' : '') +
          (isCheckbox ? '<p class="cfg-step-note cfg-step-note--dim">Select all that apply, or skip if none are needed.</p>' : '') +
        '</div>' +
        '<div class="cfg-options-list cfg-options--' + inputType + '">' + optionsHtml + '</div>';

      stepsWrap.insertBefore(div, finalStep);

      div.querySelectorAll('input').forEach(function (input) {
        input.addEventListener('change', function () { syncSelections(key, div); highlightOptions(div); });
      });
      if (!isCheckbox) syncSelections(key, div);
    });

    renderStepDots();
    updateProgress();
  }

  function refreshPrices() {
    if (!stepsWrap) return;
    stepsWrap.querySelectorAll('.cfg-opt-price[data-aud]').forEach(function (el) {
      var aud = parseInt(el.dataset.aud, 10) || 0;
      el.textContent = aud > 0 ? '+ ' + money(aud) : 'Included';
      el.classList.toggle('cfg-opt-incl', aud === 0);
    });
  }

  function syncSelections(key, stepDiv) {
    var checked = Array.prototype.slice.call(stepDiv.querySelectorAll('input:checked'));
    selections[key] = checked.map(function (inp) {
      return { id: inp.value, label: inp.dataset.label, price: parseInt(inp.dataset.price, 10) || 0 };
    });
  }
  function highlightOptions(stepDiv) {
    stepDiv.querySelectorAll('.cfg-opt-card').forEach(function (card) {
      var inp = card.querySelector('input');
      card.classList.toggle('is-selected', !!(inp && inp.checked));
    });
  }

  /* Final step */
  function summaryRows() {
    var rows = [];
    if (purpose) rows.push({ title: data.purposes.label, items: [ { label: purpose.label, price: purpose.price, base: true } ] });
    stepKeys.forEach(function (key) {
      var items = selections[key] || [];
      if (items.length) rows.push({ title: SECTIONS[key].label, items: items });
    });
    return rows;
  }

  function buildSummary() {
    var quotePanel = document.getElementById('cfg-quote-panel');
    var sumPanel   = document.getElementById('cfg-summary-panel');
    var titleEl    = document.getElementById('cfg-contact-title');
    var cnoteEl    = document.getElementById('cfg-contact-note');
    var btnLabel   = document.querySelector('#cfg-submit .btn-label');
    var heading    = document.querySelector('#cfg-step-final .cfg-step-header h2');
    var hnote      = document.querySelector('#cfg-step-final .cfg-step-header .cfg-step-note');
    if (quotePanel) quotePanel.hidden = !isQuote();
    if (sumPanel)   sumPanel.hidden   = isQuote();
    if (titleEl)    titleEl.textContent = isQuote() ? 'Request a scoping call' : 'Send me this quote';
    if (cnoteEl)    cnoteEl.textContent = isQuote() ? 'Share what you can. A senior engineer will reply within one business day to arrange a call.' : 'We review every submission personally and reply within one business day.';
    if (btnLabel)   btnLabel.textContent = isQuote() ? 'Request a call' : 'Send My Quote';
    if (heading)    heading.textContent = isQuote() ? 'Talk to our sales team' : 'Your project estimate';
    if (hnote)      hnote.textContent   = isQuote() ? 'Enterprise work is priced after a scoping conversation, not from a list.' : 'Review your build below, then send it to us for a full proposal.';
    if (isQuote()) return;

    var totalAUD = getTotalAUD();
    var symbolEl = document.getElementById('cfg-currency-symbol');
    var totalEl  = document.getElementById('cfg-total-num');
    if (symbolEl) symbolEl.textContent = cur().symbol;
    animateNumber(totalEl, 0, toLocal(totalAUD));

    var noteEl = document.getElementById('cfg-total-note');
    if (noteEl) {
      noteEl.textContent = currency === 'AUD'
        ? 'Starting estimate in Australian dollars, excluding GST. Confirmed after a 30-minute scoping call.'
        : currency === 'INR'
          ? 'Starting estimate in Indian rupees at our pricing for clients in India. Confirmed in writing after a 30-minute scoping call.'
          : 'Indicative figure converted from Australian dollars. Confirmed in writing after a 30-minute scoping call.';
    }

    var el = document.getElementById('cfg-summary-breakdown');
    if (!el) return;
    el.innerHTML = summaryRows().map(function (row) {
      return '<div class="cfg-summary-section"><p class="cfg-summary-section-title">' + esc(row.title) + '</p>' +
        row.items.map(function (item) {
          var price = item.price > 0
            ? '<span class="cfg-summary-item-price">' + (item.base ? '' : '+ ') + money(item.price) + '</span>'
            : '<span class="cfg-summary-item-price cfg-incl-tag">Included</span>';
          return '<div class="cfg-summary-item"><span class="cfg-summary-item-name">' + esc(item.label) + '</span>' + price + '</div>';
        }).join('') + '</div>';
    }).join('');
  }

  function buildSummaryText() {
    if (isQuote()) {
      return 'Enterprise platform: request for a sales scoping call.\nNo configurator estimate applies.';
    }
    var lines = [ 'Project configuration summary', 'Currency: ' + cur().name + ' (' + currency + ')', '' ];
    summaryRows().forEach(function (row) {
      lines.push(row.title.toUpperCase());
      row.items.forEach(function (item) {
        lines.push('  - ' + item.label + (item.price > 0 ? ' (' + (item.base ? '' : '+') + money(item.price) + ')' : ' (included)'));
      });
      lines.push('');
    });
    lines.push('ESTIMATED TOTAL: ' + money(getTotalAUD()) + ' (' + currency + ')');
    if (currency !== 'AUD') lines.push('In Australian dollars: A$' + getTotalAUD().toLocaleString('en-AU'));
    return lines.join('\n');
  }

  /* Navigation */
  function getStepEl(index) {
    if (index === finalIndex()) return document.getElementById('cfg-step-final');
    return stepsWrap ? stepsWrap.querySelector('.cfg-step[data-step="' + index + '"]') : null;
  }

  function navigateTo(newStep, direction) {
    if (animating) return;
    var oldEl = getStepEl(currentStep);
    var newEl = getStepEl(newStep);
    if (!newEl) return;
    animating = true;
    currentStep = newStep;
    updateProgress();
    updateNav();
    if (newStep === finalIndex()) setTimeout(buildSummary, 350);

    var wizard = document.getElementById('cfg-wizard');
    if (wizard) wizard.scrollIntoView({ behavior: 'smooth', block: 'start' });

    if (oldEl && oldEl !== newEl) {
      oldEl.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
      oldEl.style.opacity = '0';
      oldEl.style.transform = direction > 0 ? 'translateX(-24px)' : 'translateX(24px)';
      setTimeout(function () {
        oldEl.classList.remove('is-active');
        oldEl.style.cssText = '';
        newEl.style.opacity = '0';
        newEl.style.transform = direction > 0 ? 'translateX(24px)' : 'translateX(-24px)';
        newEl.classList.add('is-active');
        void newEl.offsetWidth;
        newEl.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
        newEl.style.opacity = '1';
        newEl.style.transform = 'translateX(0)';
        setTimeout(function () { newEl.style.cssText = ''; animating = false; }, 270);
      }, 210);
    } else {
      newEl.classList.add('is-active');
      animating = false;
    }
  }

  function stepNames() {
    var names = [ 'Purpose', 'Currency' ];
    stepKeys.forEach(function (k) { names.push(SECTIONS[k].label); });
    names.push('Your estimate');
    return names;
  }

  function renderStepDots() {
    var wrap = document.getElementById('cfg-step-dots');
    if (!wrap) return;
    var html = '';
    if (!purpose) { wrap.innerHTML = ''; return; }
    for (var i = 0; i < totalSteps(); i++) {
      html += '<span class="cfg-step-dot" data-dot="' + i + '" role="button" tabindex="0" aria-label="Step ' + (i + 1) + '"></span>';
    }
    wrap.innerHTML = html;
    wrap.querySelectorAll('.cfg-step-dot').forEach(function (dot) {
      dot.addEventListener('click', function () {
        var i = parseInt(dot.dataset.dot, 10);
        if (i < currentStep) navigateTo(i, -1);
      });
    });
  }

  function updateProgress() {
    var names = stepNames();
    var pct = (currentStep / (totalSteps() - 1)) * 100;
    if (progressFill) progressFill.style.width = (purpose ? pct : 0) + '%';
    if (stepLabel) stepLabel.textContent = purpose ? 'Step ' + (currentStep + 1) + ' of ' + totalSteps() : 'Step 1';
    if (stepName)  stepName.textContent  = names[currentStep] || '';
    document.querySelectorAll('.cfg-step-dot').forEach(function (dot, i) {
      dot.classList.toggle('is-done',   i < currentStep);
      dot.classList.toggle('is-active', i === currentStep);
    });
  }

  function updateNav() {
    var isFinal = currentStep === finalIndex();
    if (prevBtn) prevBtn.hidden = currentStep === 0;
    if (!nextBtn) return;
    nextBtn.hidden   = isFinal;
    nextBtn.disabled = currentStep === 0 && !purpose;
    nextBtn.classList.toggle('is-ready', !nextBtn.disabled);
    var label = currentStep === finalIndex() - 1 ? 'See my estimate' : 'Continue';
    nextBtn.innerHTML = label + ' <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>';
  }

  /* Submit */
  function handleSubmit() {
    var nameEl = document.getElementById('cfg-name'), emailEl = document.getElementById('cfg-email');
    var companyEl = document.getElementById('cfg-company'), notesEl = document.getElementById('cfg-notes');
    var submitBtn = document.getElementById('cfg-submit'), successEl = document.getElementById('cfg-success'), errorEl = document.getElementById('cfg-error');
    var name = nameEl ? nameEl.value.trim() : '', email = emailEl ? emailEl.value.trim() : '';
    if (!name) { if (nameEl) nameEl.reportValidity(); return; }
    if (!email || email.indexOf('@') === -1) { if (emailEl) emailEl.reportValidity(); return; }

    var labelEl = submitBtn ? submitBtn.querySelector('.btn-label') : null;
    var loadingEl = submitBtn ? submitBtn.querySelector('.btn-loading') : null;
    if (submitBtn) submitBtn.disabled = true;
    if (labelEl) labelEl.hidden = true;
    if (loadingEl) loadingEl.hidden = false;
    if (errorEl) errorEl.hidden = true;

    var params = new URLSearchParams({
      action:   'dk_submit_configurator',
      nonce:    (typeof DK_CFG !== 'undefined' ? DK_CFG.nonce : ''),
      name:     name,
      email:    email,
      company:  companyEl ? companyEl.value.trim() : '',
      notes:    notesEl ? notesEl.value.trim() : '',
      summary:  buildSummaryText(),
      total:    isQuote() ? 0 : getTotalAUD(),
      currency: currency,
      display:  isQuote() ? 'Quote on request' : money(getTotalAUD()),
      purpose:  purpose ? purpose.label : '',
    });

    function reset() {
      if (submitBtn) submitBtn.disabled = false;
      if (labelEl) labelEl.hidden = false;
      if (loadingEl) loadingEl.hidden = true;
    }

    fetch((typeof DK_CFG !== 'undefined' ? DK_CFG.url : ''), {
      method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: params.toString(),
    }).then(function (r) { return r.json(); }).then(function (res) {
      if (res.success) {
        if (submitBtn) submitBtn.style.display = 'none';
        if (successEl) successEl.hidden = false;
      } else {
        if (errorEl) { errorEl.textContent = res.data || 'Something went wrong. Please try again.'; errorEl.hidden = false; }
        reset();
      }
    }).catch(function () {
      if (errorEl) { errorEl.innerHTML = 'Network error. Please email us at <a href="mailto:info@datalkemi.com">info@datalkemi.com</a>.'; errorEl.hidden = false; }
      reset();
    });
  }

  /* Init */
  document.addEventListener('DOMContentLoaded', function () {
    stepsWrap    = document.getElementById('cfg-steps-wrap');
    prevBtn      = document.getElementById('cfg-prev');
    nextBtn      = document.getElementById('cfg-next');
    progressFill = document.getElementById('cfg-progress-fill');
    stepLabel    = document.getElementById('cfg-step-label');
    stepName     = document.getElementById('cfg-step-name');
    if (!stepsWrap) return;

    // Preselect a purpose from ?purpose= or a legacy ?service= link
    var qs = new URLSearchParams(window.location.search);
    var pre = qs.get('purpose') || '';
    var svc = qs.get('service') || '';
    if (!pre && svc) {
      if (/design|development/.test(svc)) pre = 'business';
      else if (/dashboard|intelligence|analytics/.test(svc)) pre = 'dashboard';
    }
    if (pre) purpose = PURPOSES.filter(function (p) { return p.id === pre; })[0] || null;

    renderPurposes();
    renderCurrencies();
    buildSectionSteps();

    var first = getStepEl(0);
    if (first) first.classList.add('is-active');

    if (prevBtn) prevBtn.addEventListener('click', function () { if (currentStep > 0) navigateTo(currentStep - 1, -1); });
    if (nextBtn) nextBtn.addEventListener('click', function () { if (currentStep < finalIndex()) navigateTo(currentStep + 1, 1); });
    var submitBtn = document.getElementById('cfg-submit');
    if (submitBtn) submitBtn.addEventListener('click', handleSubmit);

    updateProgress();
    updateNav();
  });
}());
