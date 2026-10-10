# Datalkemi Website

Marketing website for Datalkemi, a Perth-based (Cannington, WA) agency: custom software, data engineering, data systems, SEO, and BI. Contact: info@datalkemi.com.

## Stack
- WordPress. This repo is the custom **Datalkemi child theme** on the **Astra** parent theme.
- RankMath (SEO), LiteSpeed Cache, HubSpot (newsletter and lead capture), Brevo (transactional SMTP).
- No build step. Edit PHP, CSS, and JS directly.

## Local development
- Served by **LocalWP**. The canonical working copy is the theme folder LocalWP serves:
  `C:\Users\Naufal\Local Sites\datalkemi\app\public\wp-content\themes\datalkemi`
- Local URL: `http://datalkemi.local`. Local DB (MySQL 8) on 127.0.0.1:10011, user root, password root, database local.
- Edit in this folder so changes appear on the local site. Do not use any other clone.
- Assets are versioned with `filemtime()` in `inc/enqueue.php`, so a normal browser refresh picks up CSS and JS changes. If a change still does not show, purge LiteSpeed: WP Admin, LiteSpeed Cache, Toolbox, Purge All.

## Structure
- `style.css` theme header and CSS design tokens (`--color-*`). `functions.php`, `front-page.php`, `header.php`, `footer.php`, `page-*.php`, `single-*.php`, `archive-project.php`, `404.php`.
- `inc/`: enqueue.php, menus.php, post-types.php (CPTs: project, service, team_member, testimonial), seo-home.php, newsletter.php (HubSpot Forms API), smtp.php (Brevo), client-portal.php, admin-clients.php, configurator-data.php, service-data.php.
- `template-parts/home/`: sections wired into front-page.php are hero, logo-strip, problem, what-we-build, why-datalkemi, how-we-work, cta-band, insights-preview, about-snippet, final-cta. Also present but not wired: services, tech-stack, projects, testimonials, blog-preview, contact, about.
- `template-parts/footer/`: columns, newsletter, legal.
- `page-contact.php` renders `template-parts/home/contact.php` on the Contact page.
- Beyond the homepage: a Client Portal (login gate, admin invite flow) and an 8-step Configurator plus quote flow.

## Design system (Brand Guidelines v2.0, source: OneDrive/Datalkemi Package/Brand)
- Two themes switched by `data-theme` on `<html>`: `light` (default, paper first) and `dark` (ink first). The toggle is in the header, choice saved in `localStorage` as `dk-theme`.
- Never hardcode a theme colour. Use the semantic tokens from `style.css`: `--bg`, `--surface`, `--surface-alt`, `--tint`, `--text`, `--text-muted`, `--text-faint`, `--border`, `--border-strong`, `--action`, `--action-hover`, `--on-action`, `--link`, `--accent`, `--highlight`, `--grad-from`, `--grad-to`. Fixed brand values are `--brand-ink`, `--brand-teal`, `--brand-azure`, `--brand-sky`, `--brand-paper`, `--brand-mist`, `--brand-slate`, `--brand-white`, `--brand-catalyst`. The old `--color-*` names alias to these.
- Ink bands stay dark in both themes: `.hp-hero`, `.hp-cta-band`, `.hp-final-cta`, `.ft-footer`, or any element with `.dk-band`. Inside a band the semantic tokens already resolve to light-on-ink.
- Type: `--font-display` Space Grotesk for headings and big figures (weight 500, display 300), `--font-body` Inter for copy (weight 350), `--font-mono` JetBrains Mono for eyebrows, labels, metadata (`.dk-label`: 0.2em tracking, uppercase). No italics for emphasis.
- Interface kit: 4px radius (`--radius`), 1px borders, no box shadows, no blur, no glow, no hover lifts. Gradients only two blue stops (`--grad-from` to `--grad-to`). Catalyst is for attention only, one per page. Icons are line only, 1.35px stroke.
- Logo: official files live in `assets/brand/` (mark, wordmark, wordmark-tagline, each in colour/ink/white/azure/sky). The mark and the wordmark are never shown together on one surface. Header carries the wordmark with tagline (never below 180px wide), footer and favicon carry the mark. Old logo folders under `assets/images/logos/` are legacy, do not use.

## Project rules
- **No em dashes or en dashes anywhere** (code, comments, UI strings, commit messages, docs). Use a comma, colon, hyphen, or period.
- Commit messages: one line only. No `Co-Authored-By` or any Claude/Anthropic attribution.
- GitHub is the canonical remote (github.com/Datalkemi/website). After a change: `git add`, one-line `git commit`, `git push origin main`.
- Be precise and compact. Validate against the repo or database, do not assume.
- Project planning and Build Log live in Notion (parent page "Website"). Update the Tasks database and Build Log after a change.

## Open items before go-live
- Set `DATALKEMI_ABN` in wp-config.php (footer legal ABN line hidden until set).
- Real Projects and Testimonials content, real blog posts. Configure GA4, Search Console, Clarity. Then deploy to Hostinger.
