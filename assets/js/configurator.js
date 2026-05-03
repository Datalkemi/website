/**
 * Datalkemi — Project Configurator Wizard v2
 * Step-by-step pricing tool with currency conversion.
 */
(function () {
  'use strict';

  /* ─────────────────────────────────────────────────────────────────
     Currency data (rates vs GBP as base)
  ───────────────────────────────────────────────────────────────── */
  var CURRENCIES = {
    GBP: { symbol: '£',    name: 'British Pound',        rate: 1.00   },
    USD: { symbol: '$',    name: 'US Dollar',             rate: 1.27   },
    EUR: { symbol: '€',    name: 'Euro',                  rate: 1.17   },
    AUD: { symbol: 'A$',   name: 'Australian Dollar',     rate: 1.96   },
    CAD: { symbol: 'C$',   name: 'Canadian Dollar',       rate: 1.73   },
    INR: { symbol: '₹',    name: 'Indian Rupee',          rate: 107.0  },
    SGD: { symbol: 'S$',   name: 'Singapore Dollar',      rate: 1.71   },
    AED: { symbol: 'AED',  name: 'UAE Dirham',            rate: 4.67   },
    CHF: { symbol: 'Fr',   name: 'Swiss Franc',           rate: 1.12   },
    JPY: { symbol: '¥',    name: 'Japanese Yen',          rate: 191.0  },
    MYR: { symbol: 'RM',   name: 'Malaysian Ringgit',     rate: 5.98   },
    ZAR: { symbol: 'R',    name: 'South African Rand',    rate: 23.4   },
    PKR: { symbol: 'Rs',   name: 'Pakistani Rupee',       rate: 353.0  },
    BDT: { symbol: 'Tk',   name: 'Bangladeshi Taka',      rate: 139.0  },
    NGN: { symbol: '₦',    name: 'Nigerian Naira',        rate: 2080.0 },
    KES: { symbol: 'KSh',  name: 'Kenyan Shilling',       rate: 164.0  },
    NZD: { symbol: 'NZ$',  name: 'New Zealand Dollar',    rate: 2.12   },
    SEK: { symbol: 'kr',   name: 'Swedish Krona',         rate: 13.2   },
    NOK: { symbol: 'kr',   name: 'Norwegian Krone',       rate: 13.6   },
    DKK: { symbol: 'kr',   name: 'Danish Krone',          rate: 8.73   },
    SAR: { symbol: 'SR',   name: 'Saudi Riyal',           rate: 4.76   },
    QAR: { symbol: 'QR',   name: 'Qatari Riyal',          rate: 4.62   },
  };

  /* ─────────────────────────────────────────────────────────────────
     Country → currency map
  ───────────────────────────────────────────────────────────────── */
  var COUNTRIES = [
    { name: 'United Kingdom',   flag: '🇬🇧', currency: 'GBP' },
    { name: 'United States',    flag: '🇺🇸', currency: 'USD' },
    { name: 'Australia',        flag: '🇦🇺', currency: 'AUD' },
    { name: 'Canada',           flag: '🇨🇦', currency: 'CAD' },
    { name: 'Germany',          flag: '🇩🇪', currency: 'EUR' },
    { name: 'France',           flag: '🇫🇷', currency: 'EUR' },
    { name: 'Netherlands',      flag: '🇳🇱', currency: 'EUR' },
    { name: 'Spain',            flag: '🇪🇸', currency: 'EUR' },
    { name: 'Italy',            flag: '🇮🇹', currency: 'EUR' },
    { name: 'Ireland',          flag: '🇮🇪', currency: 'EUR' },
    { name: 'Portugal',         flag: '🇵🇹', currency: 'EUR' },
    { name: 'Belgium',          flag: '🇧🇪', currency: 'EUR' },
    { name: 'Austria',          flag: '🇦🇹', currency: 'EUR' },
    { name: 'Finland',          flag: '🇫🇮', currency: 'EUR' },
    { name: 'Switzerland',      flag: '🇨🇭', currency: 'CHF' },
    { name: 'India',            flag: '🇮🇳', currency: 'INR' },
    { name: 'Singapore',        flag: '🇸🇬', currency: 'SGD' },
    { name: 'UAE',              flag: '🇦🇪', currency: 'AED' },
    { name: 'Saudi Arabia',     flag: '🇸🇦', currency: 'SAR' },
    { name: 'Qatar',            flag: '🇶🇦', currency: 'QAR' },
    { name: 'Japan',            flag: '🇯🇵', currency: 'JPY' },
    { name: 'Malaysia',         flag: '🇲🇾', currency: 'MYR' },
    { name: 'New Zealand',      flag: '🇳🇿', currency: 'NZD' },
    { name: 'Sweden',           flag: '🇸🇪', currency: 'SEK' },
    { name: 'Norway',           flag: '🇳🇴', currency: 'NOK' },
    { name: 'Denmark',          flag: '🇩🇰', currency: 'DKK' },
    { name: 'South Africa',     flag: '🇿🇦', currency: 'ZAR' },
    { name: 'Nigeria',          flag: '🇳🇬', currency: 'NGN' },
    { name: 'Kenya',            flag: '🇰🇪', currency: 'KES' },
    { name: 'Pakistan',         flag: '🇵🇰', currency: 'PKR' },
    { name: 'Bangladesh',       flag: '🇧🇩', currency: 'BDT' },
  ];

  /* ─────────────────────────────────────────────────────────────────
     State
  ───────────────────────────────────────────────────────────────── */
  var config        = window.DK_CONFIG  || {};
  var configKeys    = Object.keys(config);
  var TOTAL_STEPS   = window.DK_TOTAL_STEPS || (1 + configKeys.length + 1);

  var currentStep      = 0;
  var selectedCountry  = null;
  var selectedCurrency = 'GBP';
  var selections       = {};   // sectionKey → [{ id, label, price }]
  var animating        = false;

  /* ─────────────────────────────────────────────────────────────────
     DOM refs (set on DOMContentLoaded)
  ───────────────────────────────────────────────────────────────── */
  var stepsWrap, prevBtn, nextBtn, progressFill, stepLabel, stepName;

  /* ─────────────────────────────────────────────────────────────────
     Helpers
  ───────────────────────────────────────────────────────────────── */
  function esc(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function cur() {
    return CURRENCIES[selectedCurrency] || CURRENCIES.GBP;
  }

  function toLocal(gbpPrice) {
    return Math.round(gbpPrice * cur().rate);
  }

  function formatLocal(gbpPrice) {
    return cur().symbol + toLocal(gbpPrice).toLocaleString();
  }

  function getTotalGBP() {
    var total = 0;
    configKeys.forEach(function (key) {
      var section = config[key];
      var items   = selections[key] || [];
      if (section.type === 'radio' && items.length === 0) {
        // Radio default = first option
        var opt = section.options[0];
        if (opt) total += (opt.price || 0);
      } else {
        items.forEach(function (item) { total += (item.price || 0); });
      }
    });
    return total;
  }

  /* ─────────────────────────────────────────────────────────────────
     Animated number counter
  ───────────────────────────────────────────────────────────────── */
  function animateNumber(el, from, to) {
    if (!el) return;
    var duration = 700;
    var start    = performance.now();
    function step(now) {
      var p = Math.min((now - start) / duration, 1);
      var e = 1 - Math.pow(1 - p, 3); // ease-out cubic
      el.textContent = Math.round(from + (to - from) * e).toLocaleString();
      if (p < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }

  /* ─────────────────────────────────────────────────────────────────
     Step 0: Country grid
  ───────────────────────────────────────────────────────────────── */
  function renderCountryGrid(filter) {
    var grid = document.getElementById('cfg-country-grid');
    if (!grid) return;
    var term     = (filter || '').toLowerCase().trim();
    var filtered = COUNTRIES.filter(function (c) {
      return !term || c.name.toLowerCase().indexOf(term) !== -1;
    });

    grid.innerHTML = filtered.map(function (country) {
      var currency   = CURRENCIES[country.currency] || {};
      var isSelected = selectedCountry === country.name;
      return '<button type="button" class="cfg-country-card' + (isSelected ? ' is-selected' : '') + '"' +
        ' data-country="' + esc(country.name) + '"' +
        ' data-currency="' + esc(country.currency) + '">' +
        '<span class="cfg-country-flag" aria-hidden="true">' + country.flag + '</span>' +
        '<span class="cfg-country-name">' + esc(country.name) + '</span>' +
        '<span class="cfg-country-currency">' + esc(country.currency) + '</span>' +
        (isSelected
          ? '<span class="cfg-country-check" aria-hidden="true"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></span>'
          : '') +
        '</button>';
    }).join('');

    if (!filtered.length) {
      grid.innerHTML = '<p class="cfg-country-empty">No countries found. Try a different search.</p>';
    }

    grid.querySelectorAll('.cfg-country-card').forEach(function (card) {
      card.addEventListener('click', function () {
        selectedCountry  = card.dataset.country;
        selectedCurrency = card.dataset.currency;
        renderCountryGrid(filter);
        if (nextBtn) {
          nextBtn.disabled = false;
          nextBtn.classList.add('is-ready');
        }
      });
    });
  }

  /* ─────────────────────────────────────────────────────────────────
     Steps 1–n: Config section steps (generated from DK_CONFIG)
  ───────────────────────────────────────────────────────────────── */
  function generateConfigSteps() {
    var finalStep = document.getElementById('cfg-step-final');
    if (!finalStep) return;

    configKeys.forEach(function (sectionKey, i) {
      var section   = config[sectionKey];
      var stepIndex = i + 1; // step 0 = country
      var isCheckbox = section.type === 'checkbox';
      var inputType  = isCheckbox ? 'checkbox' : 'radio';

      var optionsHtml = section.options.map(function (opt, j) {
        var isDefault = !isCheckbox && j === 0;
        var priceHtml = opt.price > 0
          ? '<span class="cfg-opt-price">+ ' + formatLocal(opt.price) + '</span>'
          : '<span class="cfg-opt-price cfg-opt-incl">Included</span>';
        var checkSvg = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>';

        return '<label class="cfg-opt-card' + (isDefault ? ' is-selected' : '') + '" for="' + esc(sectionKey) + '-' + esc(opt.id) + '">' +
          '<input type="' + inputType + '"' +
            ' id="' + esc(sectionKey) + '-' + esc(opt.id) + '"' +
            ' name="' + esc(sectionKey) + '"' +
            ' value="' + esc(opt.id) + '"' +
            ' data-price="' + (opt.price | 0) + '"' +
            ' data-label="' + esc(opt.label) + '"' +
            ' data-section="' + esc(sectionKey) + '"' +
            (isDefault ? ' checked' : '') + '>' +
          '<span class="cfg-opt-inner">' +
            '<span class="cfg-opt-icon" aria-hidden="true">' + checkSvg + '</span>' +
            '<span class="cfg-opt-body">' +
              '<span class="cfg-opt-label">' + esc(opt.label) + '</span>' +
              '<span class="cfg-opt-desc">' + esc(opt.desc) + '</span>' +
            '</span>' +
            priceHtml +
          '</span>' +
        '</label>';
      }).join('');

      var div = document.createElement('div');
      div.className    = 'cfg-step';
      div.dataset.step = stepIndex;
      div.innerHTML =
        '<div class="cfg-step-header">' +
          '<h2>' + esc(section.label) + '</h2>' +
          (section.note
            ? '<p class="cfg-step-note">' + esc(section.note) + '</p>'
            : '') +
          (isCheckbox
            ? '<p class="cfg-step-note cfg-step-note--dim">Select all that apply — skip if not needed.</p>'
            : '') +
        '</div>' +
        '<div class="cfg-options-list cfg-options--' + inputType + '">' +
          optionsHtml +
        '</div>';

      stepsWrap.insertBefore(div, finalStep);

      // Bind changes
      div.querySelectorAll('input').forEach(function (input) {
        input.addEventListener('change', function () {
          syncSelections(sectionKey, div);
          highlightOptions(div);
        });
      });

      // Initialise default radio selection
      if (!isCheckbox) {
        syncSelections(sectionKey, div);
      }
    });
  }

  function syncSelections(sectionKey, stepDiv) {
    var section    = config[sectionKey];
    var isCheckbox = section.type === 'checkbox';
    var checked    = Array.from(stepDiv.querySelectorAll('input:checked'));

    selections[sectionKey] = checked.map(function (inp) {
      return { id: inp.value, label: inp.dataset.label, price: parseInt(inp.dataset.price, 10) || 0 };
    });

    // For radio: ensure we only keep one
    if (!isCheckbox && selections[sectionKey].length > 1) {
      selections[sectionKey] = [selections[sectionKey][selections[sectionKey].length - 1]];
    }
  }

  function highlightOptions(stepDiv) {
    stepDiv.querySelectorAll('.cfg-opt-card').forEach(function (card) {
      var inp = card.querySelector('input');
      card.classList.toggle('is-selected', !!(inp && inp.checked));
    });
  }

  /* ─────────────────────────────────────────────────────────────────
     Final step: Summary
  ───────────────────────────────────────────────────────────────── */
  function buildSummary() {
    var totalGBP   = getTotalGBP();
    var totalLocal = toLocal(totalGBP);
    var currency   = cur();

    // Update total display
    var symbolEl = document.getElementById('cfg-currency-symbol');
    var totalEl  = document.getElementById('cfg-total-num');
    if (symbolEl) symbolEl.textContent = currency.symbol;
    animateNumber(totalEl, 0, totalLocal);

    // Build breakdown
    var breakdownEl = document.getElementById('cfg-summary-breakdown');
    if (!breakdownEl) return;

    var html = '';
    configKeys.forEach(function (key) {
      var section = config[key];
      var items   = (selections[key] || []).slice();

      // Radio with no explicit selection → use default
      if (section.type === 'radio' && items.length === 0) {
        var opt = section.options[0];
        if (opt) items = [{ id: opt.id, label: opt.label, price: opt.price || 0 }];
      }

      if (!items.length) return;

      html += '<div class="cfg-summary-section">' +
        '<p class="cfg-summary-section-title">' + esc(section.label) + '</p>';

      items.forEach(function (item) {
        var priceStr = item.price > 0
          ? '<span class="cfg-summary-item-price">+&thinsp;' + currency.symbol + toLocal(item.price).toLocaleString() + '</span>'
          : '<span class="cfg-summary-item-price cfg-incl-tag">Included</span>';
        html += '<div class="cfg-summary-item">' +
          '<span class="cfg-summary-item-name">' + esc(item.label) + '</span>' +
          priceStr +
        '</div>';
      });
      html += '</div>';
    });

    breakdownEl.innerHTML = html || '<p style="color:rgba(255,255,255,0.4);font-size:.875rem;">No selections recorded.</p>';
  }

  function buildSummaryText() {
    var currency  = cur();
    var totalGBP  = getTotalGBP();
    var lines     = [
      'Project Configuration Summary',
      'Currency: ' + currency.name + ' (' + selectedCurrency + ')',
      'Country: ' + (selectedCountry || 'Not specified'),
      '',
    ];

    configKeys.forEach(function (key) {
      var section = config[key];
      var items   = (selections[key] || []).slice();
      if (section.type === 'radio' && items.length === 0) {
        var opt = section.options[0];
        if (opt) items = [{ label: opt.label, price: opt.price || 0 }];
      }
      if (!items.length) return;

      lines.push(section.label.toUpperCase());
      items.forEach(function (item) {
        var p = item.price > 0 ? ' (+' + currency.symbol + toLocal(item.price).toLocaleString() + ')' : ' (included)';
        lines.push('  - ' + item.label + p);
      });
      lines.push('');
    });

    lines.push('ESTIMATED TOTAL: ' + currency.symbol + toLocal(totalGBP).toLocaleString() + ' (' + selectedCurrency + ')');
    return lines.join('\n');
  }

  /* ─────────────────────────────────────────────────────────────────
     Navigation
  ───────────────────────────────────────────────────────────────── */
  function getStepEl(index) {
    if (index === TOTAL_STEPS - 1) return document.getElementById('cfg-step-final');
    return stepsWrap ? stepsWrap.querySelector('[data-step="' + index + '"]') : null;
  }

  function navigateTo(newStep, direction) {
    if (animating) return;

    var oldEl = getStepEl(currentStep);
    var newEl = getStepEl(newStep);
    if (!newEl) return;

    animating = true;

    // Update state immediately
    currentStep = newStep;
    updateProgress();
    updateNav();

    if (newStep === TOTAL_STEPS - 1) {
      setTimeout(buildSummary, 350);
    }

    // Scroll wizard into view
    var wizard = document.getElementById('cfg-wizard');
    if (wizard) wizard.scrollIntoView({ behavior: 'smooth', block: 'start' });

    if (oldEl && oldEl !== newEl) {
      // Animate out
      oldEl.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
      oldEl.style.opacity    = '0';
      oldEl.style.transform  = direction > 0 ? 'translateX(-24px)' : 'translateX(24px)';

      setTimeout(function () {
        oldEl.classList.remove('is-active');
        oldEl.style.cssText = '';

        // Animate in
        newEl.style.opacity   = '0';
        newEl.style.transform = direction > 0 ? 'translateX(24px)' : 'translateX(-24px)';
        newEl.classList.add('is-active');

        // Force reflow so transition fires
        void newEl.offsetWidth;
        newEl.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
        newEl.style.opacity    = '1';
        newEl.style.transform  = 'translateX(0)';

        setTimeout(function () {
          newEl.style.cssText = '';
          animating = false;
        }, 270);
      }, 210);
    } else {
      if (newEl) newEl.classList.add('is-active');
      animating = false;
    }
  }

  /* ─────────────────────────────────────────────────────────────────
     Progress bar + step dots
  ───────────────────────────────────────────────────────────────── */
  function renderStepDots() {
    var dotsWrap = document.getElementById('cfg-step-dots');
    if (!dotsWrap) return;
    var html = '';
    for (var i = 0; i < TOTAL_STEPS; i++) {
      html += '<span class="cfg-step-dot' + (i === 0 ? ' is-active' : '') + '" data-dot="' + i + '" role="button" tabindex="0" aria-label="Step ' + (i + 1) + '"></span>';
    }
    dotsWrap.innerHTML = html;

    dotsWrap.querySelectorAll('.cfg-step-dot').forEach(function (dot) {
      dot.addEventListener('click', function () {
        var i = parseInt(dot.dataset.dot, 10);
        if (i < currentStep) navigateTo(i, -1);
      });
    });
  }

  var STEP_NAMES = (function () {
    var names = ['Your location'];
    configKeys.forEach(function (k) { names.push(config[k].label); });
    names.push('Your estimate');
    return names;
  }());

  function updateProgress() {
    var pct = (currentStep / (TOTAL_STEPS - 1)) * 100;
    if (progressFill) progressFill.style.width = pct + '%';
    if (stepLabel) stepLabel.textContent = 'Step ' + (currentStep + 1) + ' of ' + TOTAL_STEPS;
    if (stepName)  stepName.textContent  = STEP_NAMES[currentStep] || '';

    document.querySelectorAll('.cfg-step-dot').forEach(function (dot, i) {
      dot.classList.toggle('is-done',   i < currentStep);
      dot.classList.toggle('is-active', i === currentStep);
    });
  }

  function updateNav() {
    var isFinal = currentStep === TOTAL_STEPS - 1;
    var isFirst = currentStep === 0;
    var isLast  = currentStep === TOTAL_STEPS - 2; // step before final

    if (prevBtn) prevBtn.hidden = isFirst;
    if (!nextBtn) return;

    if (isFinal) {
      nextBtn.hidden = true;
    } else {
      nextBtn.hidden   = false;
      nextBtn.disabled = isFirst && !selectedCountry;

      var label = isLast ? 'See My Estimate' : 'Continue';
      var chevron = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>';
      nextBtn.innerHTML = label + ' ' + chevron;
    }
  }

  /* ─────────────────────────────────────────────────────────────────
     Submit
  ───────────────────────────────────────────────────────────────── */
  function handleSubmit() {
    var nameEl    = document.getElementById('cfg-name');
    var emailEl   = document.getElementById('cfg-email');
    var companyEl = document.getElementById('cfg-company');
    var notesEl   = document.getElementById('cfg-notes');
    var submitBtn = document.getElementById('cfg-submit');
    var successEl = document.getElementById('cfg-success');
    var errorEl   = document.getElementById('cfg-error');

    var name  = nameEl  ? nameEl.value.trim()  : '';
    var email = emailEl ? emailEl.value.trim()  : '';

    if (!name)  { if (nameEl)  nameEl.reportValidity();  return; }
    if (!email || email.indexOf('@') === -1) { if (emailEl) emailEl.reportValidity(); return; }

    var labelEl   = submitBtn ? submitBtn.querySelector('.btn-label')   : null;
    var loadingEl = submitBtn ? submitBtn.querySelector('.btn-loading')  : null;
    if (submitBtn)  submitBtn.disabled = true;
    if (labelEl)    labelEl.hidden     = true;
    if (loadingEl)  loadingEl.hidden   = false;
    if (errorEl)    errorEl.hidden     = true;

    var totalGBP = getTotalGBP();
    var params   = new URLSearchParams({
      action:  'dk_submit_configurator',
      nonce:   (typeof DK_AJAX !== 'undefined' ? DK_AJAX.nonce : ''),
      name:    name,
      email:   email,
      company: companyEl ? companyEl.value.trim() : '',
      notes:   notesEl   ? notesEl.value.trim()   : '',
      summary: buildSummaryText(),
      total:   totalGBP,
    });

    fetch((typeof DK_AJAX !== 'undefined' ? DK_AJAX.url : ''), {
      method:  'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body:    params.toString(),
    })
    .then(function (r) { return r.json(); })
    .then(function (data) {
      if (data.success) {
        if (submitBtn)  submitBtn.style.display = 'none';
        if (successEl)  successEl.hidden        = false;
      } else {
        if (errorEl) {
          errorEl.textContent = data.data || 'Something went wrong. Please try again.';
          errorEl.hidden = false;
        }
        if (submitBtn)  submitBtn.disabled = false;
        if (labelEl)    labelEl.hidden     = false;
        if (loadingEl)  loadingEl.hidden   = true;
      }
    })
    .catch(function () {
      if (errorEl) {
        errorEl.innerHTML = 'Network error. Please email us at <a href="mailto:info@datalkemi.com">info@datalkemi.com</a>.';
        errorEl.hidden = false;
      }
      if (submitBtn)  submitBtn.disabled = false;
      if (labelEl)    labelEl.hidden     = false;
      if (loadingEl)  loadingEl.hidden   = true;
    });
  }

  /* ─────────────────────────────────────────────────────────────────
     Init
  ───────────────────────────────────────────────────────────────── */
  document.addEventListener('DOMContentLoaded', function () {
    stepsWrap    = document.getElementById('cfg-steps-wrap');
    prevBtn      = document.getElementById('cfg-prev');
    nextBtn      = document.getElementById('cfg-next');
    progressFill = document.getElementById('cfg-progress-fill');
    stepLabel    = document.getElementById('cfg-step-label');
    stepName     = document.getElementById('cfg-step-name');

    if (!stepsWrap) return;

    // Build config section steps
    generateConfigSteps();

    // Step dots
    renderStepDots();

    // Show step 0
    var first = getStepEl(0);
    if (first) first.classList.add('is-active');

    // Country search
    var searchInput = document.getElementById('cfg-country-search');
    if (searchInput) {
      searchInput.addEventListener('input', function () {
        renderCountryGrid(this.value);
      });
    }
    renderCountryGrid('');

    // Prev button
    if (prevBtn) {
      prevBtn.addEventListener('click', function () {
        if (currentStep > 0) navigateTo(currentStep - 1, -1);
      });
    }

    // Next button
    if (nextBtn) {
      nextBtn.addEventListener('click', function () {
        if (currentStep < TOTAL_STEPS - 1) navigateTo(currentStep + 1, 1);
      });
    }

    // Submit button
    var submitBtn = document.getElementById('cfg-submit');
    if (submitBtn) submitBtn.addEventListener('click', handleSubmit);

    updateProgress();
    updateNav();
  });

}());
