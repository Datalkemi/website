/**
 * Datalkemi — Project Configurator
 * Real-time component-based price calculator.
 */
(function () {
	'use strict';

	/* ── State ─────────────────────────────────────────────── */
	let total       = 0;
	let breakdownMap = {};   // sectionKey -> { label, price, items[] }

	/* ── DOM refs ──────────────────────────────────────────── */
	const totalEl     = document.getElementById('config-total-num');
	const listEl      = document.getElementById('config-breakdown-list');
	const submitBtn   = document.getElementById('config-submit');
	const successEl   = document.getElementById('config-success');
	const errorEl     = document.getElementById('config-error');
	const sidebar     = document.getElementById('config-sidebar');

	/* ── Helpers ───────────────────────────────────────────── */
	function formatGBP(n) {
		return n.toLocaleString('en-GB');
	}

	function sectionLabel(key) {
		const labels = {
			project_type:     'Project type',
			design:           'Design',
			pages:            'Pages / screens',
			features:         'Features',
			data_analytics:   'Data & analytics',
			seo:              'SEO',
			infrastructure:   'Infrastructure',
			support:          'Support',
		};
		return labels[key] || key;
	}

	function animateTotal(from, to) {
		const duration = 350;
		const start    = performance.now();
		function step(now) {
			const elapsed  = now - start;
			const progress = Math.min(elapsed / duration, 1);
			const eased    = 1 - Math.pow(1 - progress, 3); // ease-out cubic
			const current  = Math.round(from + (to - from) * eased);
			totalEl.textContent = formatGBP(current);
			if (progress < 1) requestAnimationFrame(step);
		}
		requestAnimationFrame(step);
	}

	function rebuildBreakdown() {
		const sections = Object.keys(breakdownMap);
		if (!sections.length) {
			listEl.innerHTML = '<li class="config-breakdown-empty">Nothing selected yet.</li>';
			return;
		}

		let html = '';
		sections.forEach(function (key) {
			const section = breakdownMap[key];
			if (!section || !section.items || !section.items.length) return;
			section.items.forEach(function (item) {
				html += `<li class="config-breakdown-item">
					<span class="config-breakdown-name">${escHtml(item.label)}</span>
					<span class="config-breakdown-price">${item.price > 0 ? '+&thinsp;£' + formatGBP(item.price) : '<span class="config-incl">Incl.</span>'}</span>
				</li>`;
			});
		});

		listEl.innerHTML = html || '<li class="config-breakdown-empty">Nothing selected yet.</li>';
	}

	function escHtml(str) {
		return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
	}

	function recalculate() {
		const allInputs  = document.querySelectorAll('#config-form input[type="radio"]:checked, #config-form input[type="checkbox"]:checked');
		let newTotal     = 0;
		const newMap     = {};

		allInputs.forEach(function (input) {
			const price   = parseInt(input.dataset.price, 10) || 0;
			const key     = input.dataset.section;
			const label   = input.dataset.label || input.value;
			newTotal     += price;

			if (!newMap[key]) newMap[key] = { items: [] };
			newMap[key].items.push({ label, price });
		});

		const oldTotal = total;
		total          = newTotal;
		breakdownMap   = newMap;

		animateTotal(oldTotal, newTotal);
		rebuildBreakdown();

		// Highlight active options
		document.querySelectorAll('.config-option').forEach(function (label) {
			const inp = label.querySelector('input');
			label.classList.toggle('is-selected', inp && inp.checked);
		});
	}

	/* ── Bind all inputs ───────────────────────────────────── */
	function bindInputs() {
		const inputs = document.querySelectorAll('#config-form input[type="radio"], #config-form input[type="checkbox"]');
		inputs.forEach(function (input) {
			input.addEventListener('change', recalculate);
		});
	}

	/* ── Sticky sidebar ────────────────────────────────────── */
	function initSticky() {
		if (!sidebar) return;
		// CSS handles sticky; this just ensures scrolled-into-view update
	}

	/* ── Build selected summary text (for email) ───────────── */
	function buildSummaryText() {
		let lines = ['Project Configuration Summary', ''];
		Object.keys(breakdownMap).forEach(function (key) {
			const section = breakdownMap[key];
			if (!section || !section.items.length) return;
			lines.push(sectionLabel(key).toUpperCase());
			section.items.forEach(function (item) {
				lines.push('  - ' + item.label + (item.price > 0 ? ' (+£' + formatGBP(item.price) + ')' : ' (included)'));
			});
			lines.push('');
		});
		lines.push('ESTIMATED TOTAL: £' + formatGBP(total));
		return lines.join('\n');
	}

	/* ── Submit ─────────────────────────────────────────────── */
	function handleSubmit() {
		const name    = document.getElementById('cfg-name').value.trim();
		const email   = document.getElementById('cfg-email').value.trim();
		const company = document.getElementById('cfg-company').value.trim();
		const notes   = document.getElementById('cfg-notes').value.trim();

		if (!name || !email) {
			document.getElementById('cfg-name').reportValidity();
			document.getElementById('cfg-email').reportValidity();
			return;
		}

		submitBtn.disabled   = true;
		submitBtn.textContent = 'Sending...';

		const body = new URLSearchParams({
			action:   'dk_submit_configurator',
			nonce:    DK_AJAX.nonce,
			name:     name,
			email:    email,
			company:  company,
			notes:    notes,
			summary:  buildSummaryText(),
			total:    total,
		});

		fetch(DK_AJAX.url, {
			method:  'POST',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			body:    body.toString(),
		})
		.then(function (res) { return res.json(); })
		.then(function (data) {
			if (data.success) {
				document.getElementById('config-submit-wrap').querySelector('button').style.display = 'none';
				successEl.removeAttribute('hidden');
			} else {
				errorEl.removeAttribute('hidden');
				submitBtn.disabled   = false;
				submitBtn.textContent = 'Send My Quote';
			}
		})
		.catch(function () {
			errorEl.removeAttribute('hidden');
			submitBtn.disabled   = false;
			submitBtn.textContent = 'Send My Quote';
		});
	}

	/* ── Init ───────────────────────────────────────────────── */
	document.addEventListener('DOMContentLoaded', function () {
		bindInputs();
		recalculate();   // compute initial state from pre-checked radios
		initSticky();
		if (submitBtn) submitBtn.addEventListener('click', handleSubmit);
	});

})();
