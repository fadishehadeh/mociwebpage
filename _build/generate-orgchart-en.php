<?php
/**
 * Organizational chart page generator (English).
 * Run with: php _build/generate-orgchart-en.php
 */

$root = dirname(__DIR__);
$css  = file_get_contents($root . '/assets/css/style.css');
$js   = file_get_contents($root . '/assets/js/main.js');

function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

function page_shell(string $title, string $desc, string $body, string $css, string $js): string
{
    return <<<HTML
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{$title}</title>
<meta name="description" content="{$desc}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
<style>
{$css}
</style>
</head>
<body>
{$body}
<script>
{$js}
</script>
</body>
</html>
HTML;
}

$year = date('Y');

$header = <<<HTML
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header">
    <div class="utility-bar">
        <div class="container utility-bar__inner">
            <button type="button" class="icon-btn" aria-label="Accessibility options">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="5" r="2"/><path d="M4 8.5 12 10l8-1.5M12 10v5m0 0-3 7m3-7 3 7"/></svg>
            </button>
            <button type="button" class="icon-btn" aria-label="My account">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c1.6-4 5-6 8-6s6.4 2 8 6"/></svg>
            </button>
            <a class="icon-btn lang-switch" href="../orgchart.html" aria-label="التبديل إلى العربية">AR</a>
            <button type="button" class="icon-btn" aria-label="Search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
            </button>
        </div>
    </div>
    <div class="container main-nav-row">
        <a href="index.html" class="brand">
            <span class="brand__crest" aria-hidden="true">MOCI</span>
            <span class="brand__text">
                <span class="brand__title">Ministry of Commerce and Industry</span><br>
                <span class="brand__subtitle">State of Qatar</span>
            </span>
        </a>
        <nav class="main-nav" id="mainNav" aria-label="Main navigation">
            <ul class="main-nav__list">
                <li><a href="index.html">Home</a></li>
                <li class="is-active"><a href="ministry-departments.html">About the Ministry</a></li>
                <li><a href="#">Services Center</a></li>
                <li><a href="#">E-Services</a></li>
                <li><a href="#">Media Center</a></li>
                <li><a href="#">Invest in Qatar</a></li>
                <li><a href="#">Single Window</a></li>
            </ul>
        </nav>
        <button type="button" class="nav-toggle" id="navToggle" aria-label="Open menu" aria-expanded="false" aria-controls="mainNav">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
    </div>
    <div class="breadcrumb-bar">
        <div class="container breadcrumb-bar__inner">
            <a class="breadcrumb-back" href="ministry-departments.html">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M11 18l-6-6 6-6"/></svg>
                Back to Ministry Departments
            </a>
            <div class="breadcrumb-trail">
                <a href="index.html">Home</a>
                <span class="sep">/</span>
                <a href="ministry-departments.html">About the Ministry</a>
                <span class="sep">/</span>
                <span class="current">Organizational Structure</span>
            </div>
        </div>
    </div>
</header>
HTML;

$footer = <<<HTML
<footer class="site-footer">
    <div class="container footer-top">
        <div class="footer-apps">
            <div class="footer-apps__badges">
                <a class="store-badge" href="https://itunes.apple.com/us/app/mec-qatar/id735953928">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M16.4 12.3c0-2.5 2-3.7 2.1-3.8-1.1-1.7-2.9-1.9-3.5-1.9-1.5-.2-2.9.9-3.7.9-.8 0-2-.9-3.2-.8-1.6 0-3.1 1-4 2.4-1.7 3-.4 7.4 1.2 9.8.8 1.2 1.8 2.5 3.1 2.4 1.2-.1 1.7-.8 3.2-.8s1.9.8 3.2.8c1.3 0 2.2-1.2 3-2.4.6-.9 1.1-1.9 1.4-3-1.8-.7-2.8-2.4-2.8-4.6ZM13.9 4.9c.7-.8 1.1-1.9 1-3-1 .1-2.1.7-2.8 1.5-.6.7-1.1 1.8-1 2.9 1.1.1 2.1-.5 2.8-1.4Z"/></svg>
                    <span>App Store</span>
                </a>
                <a class="store-badge" href="https://play.google.com/store/apps/details?id=com.mbt.mbt">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M4.4 2.7c-.3.3-.5.7-.5 1.3v16c0 .6.2 1 .5 1.3l.1.1L13.6 12 4.5 2.6l-.1.1ZM16.7 15l-2.6-2.6.9-.9L18.5 15l-1.8 1Zm2.6-1.5L14.5 12l4.8-4.9.1 1c1 .6 1 1.6 0 2.2l-.1.1ZM5.4 21.2l8.2-8.2 2.6 2.6-9.6 5.6c-.4.3-.9.3-1.2 0Zm8.2-9.9L5.4 3.1c.3-.3.8-.3 1.2 0l9.5 5.5-2.5 2.7Z"/></svg>
                    <span>Google Play</span>
                </a>
            </div>
            <div class="footer-social">
                <a href="https://www.facebook.com/MOCIQatar" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 21v-8h2.7l.4-3h-3.1V8c0-.9.3-1.5 1.6-1.5H17V4c-.3 0-1.3-.1-2.4-.1-2.4 0-4.1 1.5-4.1 4.1V10H8v3h2.5v8h3Z"/></svg></a>
                <a href="https://www.twitter.com/MOCIQatar" aria-label="X (Twitter)"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h4.6l4 5.5L16.4 3H21l-6.9 8.4L21.5 21h-4.6l-4.4-6-5 6H3l7.3-8.8L3 3Z"/></svg></a>
                <a href="https://www.instagram.com/MOCIQatar" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg></a>
                <a href="https://www.youtube.com/c/MOCIQatar" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M21.6 7.2s-.2-1.5-.8-2.2c-.8-.8-1.7-.8-2.1-.9C15.9 4 12 4 12 4s-3.9 0-6.7.1c-.4 0-1.3.1-2.1.9-.6.7-.8 2.2-.8 2.2S2 9 2 10.7v1.6C2 14 2.2 15.8 2.2 15.8s.2 1.5.8 2.2c.8.8 1.8.8 2.3.9 1.7.1 6.7.1 6.7.1s3.9 0 6.7-.1c.4 0 1.3-.1 2.1-.9.6-.7.8-2.2.8-2.2s.2-1.8.2-3.5v-1.6c0-1.7-.2-3.5-.2-3.5ZM10 14.6V8.9l5 2.9-5 2.8Z"/></svg></a>
                <a href="https://www.linkedin.com/company/MOCIQatar" aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5a2 2 0 1 1 0 4 2 2 0 0 1 0-4ZM3 9h4v12H3V9Zm7 0h3.8v1.7h.1c.5-.9 1.8-1.9 3.7-1.9 4 0 4.7 2.6 4.7 6V21h-4v-5.4c0-1.3 0-3-1.9-3s-2.1 1.4-2.1 2.9V21h-4V9Z"/></svg></a>
            </div>
        </div>
        <div class="footer-contact">
            <a href="tel:16001" style="display:block;margin-bottom:8px;">16001</a>
            <a href="https://api.whatsapp.com/send?phone=97466111400" style="display:block;">+974 6611 1400</a>
        </div>
    </div>
    <div class="container footer-columns">
        <div><h3>Media Center</h3><ul><li><a href="#">News</a></li><li><a href="#">Forms &amp; Reports</a></li><li><a href="#">Resources</a></li></ul></div>
        <div><h3>Invest in Qatar</h3><ul><li><a href="#">Why Qatar</a></li><li><a href="#">Investment Steps</a></li><li><a href="#">International Partnerships</a></li></ul></div>
        <div><h3>Services Center</h3><ul><li><a href="#">Consumer Services</a></li><li><a href="#">Industry Services Platform</a></li><li><a href="#">Local Investor Services</a></li></ul></div>
        <div><h3>About the Ministry</h3><ul><li><a href="ministry-departments.html">Ministry Departments</a></li><li><a href="leadership.html">Ministry Undersecretaries</a></li><li><a href="#">Contact Us</a></li></ul></div>
    </div>
    <div class="container footer-bottom">
        <span>&copy; {$year} Ministry of Commerce and Industry. All rights reserved.</span>
        <div class="footer-legal"><a href="#">Sitemap</a><a href="#">Terms of Use</a><a href="#">Privacy Policy</a></div>
    </div>
</footer>
<button type="button" class="back-to-top" id="backToTop" aria-label="Back to top">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
</button>
HTML;

$floatingMenu = <<<HTML
<a class="floating-menu-btn" href="ministry-departments.html" aria-label="Main menu">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
    Main Menu
</a>
HTML;

$orgchartCss = <<<CSS

/* ===================== Org Chart ===================== */
.orgchart-section { padding: 3rem 0 4rem; background: linear-gradient(180deg, #faf8f5 0%, #fff 40%, #faf8f5 100%); }
.orgchart-intro { text-align: center; max-width: 680px; margin: 0 auto 3rem; color: #555; font-size: .92rem; line-height: 1.9; padding: 1.2rem 2rem; background: #fff; border-radius: 12px; box-shadow: 0 1px 8px rgba(107,29,58,.06); border-left: 4px solid #6b1d3a; }

.orgchart { --oc-maroon: #6b1d3a; --oc-maroon-light: #8a2950; --oc-gold: #b89a5a; --oc-gold-light: #d4bc82; --oc-bg: #fff; --oc-bg-sub: #faf7f1; --oc-line: #c8a96e; --oc-radius: 12px; --oc-shadow: 0 2px 12px rgba(107,29,58,.08); --oc-shadow-hover: 0 4px 20px rgba(107,29,58,.14); }

.oc-tree { display: flex; flex-direction: column; align-items: center; gap: 0; }

.oc-minister { text-align: center; }
.oc-minister__title { font-size: 1.15rem; font-weight: 900; color: #fff; margin: 0; letter-spacing: .01em; }
.oc-minister__badge { display: inline-flex; align-items: center; justify-content: center; gap: .6rem; background: linear-gradient(135deg, var(--oc-maroon) 0%, var(--oc-maroon-light) 100%); color: #fff; padding: .9rem 2.2rem; border-radius: 50px; box-shadow: 0 4px 20px rgba(107,29,58,.25); position: relative; }
.oc-minister__badge::before { content: ''; position: absolute; inset: -3px; border-radius: 54px; background: linear-gradient(135deg, var(--oc-gold) 0%, var(--oc-gold-light) 100%); z-index: -1; }


.oc-vline { width: 2px; height: 32px; background: linear-gradient(180deg, var(--oc-gold) 0%, var(--oc-line) 100%); margin: 0 auto; position: relative; }
.oc-vline::after { content: ''; position: absolute; bottom: -3px; left: 50%; transform: translateX(-50%); width: 8px; height: 8px; background: var(--oc-gold); border-radius: 50%; }
.oc-vline--short { width: 2px; height: 16px; background: var(--oc-line); margin: 0 auto; }
.oc-vline--plain { width: 2px; height: 32px; background: var(--oc-line); margin: 0 auto; }
.oc-vline--plain::after { display: none; }

.oc-node { background: linear-gradient(135deg, var(--oc-maroon) 0%, var(--oc-maroon-light) 100%); color: #fff; padding: .7rem 1.8rem; border-radius: 50px; font-weight: 700; font-size: .88rem; text-align: center; max-width: 320px; margin: 0 auto; line-height: 1.5; box-shadow: 0 3px 12px rgba(107,29,58,.18); letter-spacing: .01em; }
.oc-node--gold { background: linear-gradient(135deg, var(--oc-gold) 0%, #c9ab6a 100%); box-shadow: 0 3px 12px rgba(184,154,90,.25); }

.oc-sub { background: #fff; border: 1px solid #e8e1d5; border-radius: 8px; padding: .55rem 1rem; font-size: .8rem; font-weight: 500; color: var(--clr-text); text-align: center; line-height: 1.55; transition: all .25s ease; box-shadow: 0 1px 3px rgba(0,0,0,.04); }
.oc-sub:hover { background: #fdf8ee; border-color: var(--oc-gold); box-shadow: 0 2px 8px rgba(184,154,90,.15); transform: translateY(-1px); }
a.oc-sub { text-decoration: none; color: var(--clr-text); }
.oc-sub--office { border: 1.5px dashed var(--oc-gold-light); background: linear-gradient(135deg, #fefcf7 0%, #fdf8ee 100%); font-size: .76rem; color: #8a7550; }

.oc-minister-wrapper { position: relative; width: fit-content; }
.oc-minister-deps { position: absolute; top: 50%; transform: translateY(-50%); right: calc(100% + 1.5rem); display: flex; flex-direction: column; gap: .5rem; padding: .8rem; background: #fff; border-radius: var(--oc-radius); box-shadow: var(--oc-shadow); border-top: 3px solid var(--oc-gold); white-space: nowrap; }
.oc-minister-dep { display: block; background: linear-gradient(135deg, var(--oc-maroon) 0%, var(--oc-maroon-light) 100%); color: #fff; padding: .5rem 1.2rem; border-radius: 8px; font-size: .76rem; font-weight: 600; text-align: center; line-height: 1.5; transition: transform .2s, box-shadow .2s; text-decoration: none; }
.oc-minister-dep:hover { transform: translateY(-1px); box-shadow: 0 3px 10px rgba(107,29,58,.2); }
.oc-minister-dep--gold { background: linear-gradient(135deg, var(--oc-gold) 0%, #c9ab6a 100%); }

.oc-state-branch { display: flex; flex-direction: column; align-items: center; align-self: flex-start; margin-inline-start: 15%; }

.oc-under-subs { display: flex; gap: .8rem; justify-content: center; flex-wrap: wrap; margin-bottom: .5rem; }

.oc-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem 2rem; width: 100%; max-width: 940px; margin: 0 auto; }

.oc-card { background: #fff; border: 1px solid #ece6da; border-radius: var(--oc-radius); overflow: hidden; display: flex; flex-direction: column; box-shadow: var(--oc-shadow); transition: box-shadow .3s, transform .3s; }
.oc-card:hover { box-shadow: var(--oc-shadow-hover); transform: translateY(-2px); }
.oc-card__head { background: linear-gradient(135deg, var(--oc-maroon) 0%, var(--oc-maroon-light) 100%); color: #fff; padding: .85rem 1.2rem; font-weight: 700; font-size: .84rem; text-align: center; line-height: 1.55; position: relative; }
.oc-card__head::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 40px; height: 3px; background: var(--oc-gold); border-radius: 3px 3px 0 0; }
.oc-card__body { padding: .8rem .8rem 1rem; display: flex; flex-direction: column; gap: .4rem; }
.oc-card__icon { display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: linear-gradient(135deg, var(--oc-gold) 0%, var(--oc-gold-light) 100%); border-radius: 50%; margin: -16px auto .4rem; position: relative; z-index: 1; box-shadow: 0 2px 6px rgba(184,154,90,.3); }
.oc-card__icon svg { width: 16px; height: 16px; stroke: #fff; fill: none; stroke-width: 2; }

@media (max-width: 900px) {
  .oc-grid { grid-template-columns: 1fr; max-width: 440px; }
  .oc-minister-wrapper { width: auto; }
  .oc-minister-deps { position: static; transform: none; white-space: normal; margin-top: 1rem; }
  .oc-state-branch { align-self: center; margin: 0; }
}
@media (max-width: 600px) {
  .orgchart-section { padding: 2rem 0 3rem; }
  .orgchart-intro { font-size: .85rem; padding: 1rem 1.2rem; }
  .oc-minister__badge { padding: .7rem 1.5rem; }
  .oc-minister__title { font-size: 1rem; }
  .oc-node { font-size: .82rem; padding: .6rem 1.2rem; }
  .oc-sub { font-size: .74rem; padding: .45rem .7rem; }
  .oc-card__head { font-size: .8rem; }
}
CSS;

$body = <<<'HTML'
{HEADER}
{FLOATING}
<main id="main">
    <section class="hero" style="background-image: url('../assets/img/hero-departments.png');">
        <div class="container hero__inner">
            <h1 class="hero__title">Organizational Structure</h1>
            <p class="hero__subtitle">Organizational Structure of the Ministry of Commerce and Industry</p>
        </div>
    </section>

    <section class="orgchart-section orgchart">
        <div class="container">
            <p class="orgchart-intro">Arrangement of departments per Amiri Decision No. (39) of 2022 on the organizational structure of the Ministry</p>

            <div class="oc-tree">

                <!-- ===== MINISTER ===== -->
                <div class="oc-minister-wrapper">
                    <div class="oc-minister__badge">
                        <h2 class="oc-minister__title">Minister of Commerce and Industry</h2>
                    </div>
                    <div class="oc-minister-deps">
                        <a class="oc-minister-dep oc-minister-dep--gold" href="dept-22.html">Minister&rsquo;s Office</a>
                        <a class="oc-minister-dep" href="dept-3.html">Technical Office</a>
                        <a class="oc-minister-dep" href="dept-2.html">Internal Audit Dept.</a>
                        <a class="oc-minister-dep" href="dept-1.html">Int&rsquo;l Cooperation &amp; Agreements</a>
                        <a class="oc-minister-dep" href="dept-6.html">Legal Affairs Dept.</a>
                    </div>
                </div>

                <div class="oc-vline"></div>

                <!-- State Minister (side branch) -->
                <div class="oc-state-branch">
                    <div class="oc-node oc-node--gold">Minister of State for Foreign Trade Affairs</div>
                    <div class="oc-vline--short"></div>
                    <a class="oc-sub oc-sub--office" href="dept-23.html">Office of the Minister of State</a>
                </div>

                <div class="oc-vline"></div>

                <!-- Undersecretary -->
                <div class="oc-node">Undersecretary</div>
                <div class="oc-vline--short"></div>
                <div class="oc-under-subs">
                    <a class="oc-sub oc-sub--office" href="dept-24.html">Office of the Undersecretary</a>
                    <a class="oc-sub" href="dept-5.html">Planning, Quality &amp; Innovation Dept.</a>
                </div>

                <div class="oc-vline"></div>

                <!-- ===== ASSISTANT UNDERSECRETARIES GRID ===== -->
                <div class="oc-grid">

                    <!-- 1. Commercial Affairs -->
                    <div class="oc-card">
                        <div class="oc-card__head">Asst. Undersecretary for Commercial Affairs</div>
                        <div class="oc-card__icon"><svg viewBox="0 0 24 24"><path d="M3 9h18M9 21V9M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg></div>
                        <div class="oc-card__body">
                            <a class="oc-sub oc-sub--office" href="dept-25.html">Office of the Asst. Undersecretary</a>
                            <a class="oc-sub" href="dept-4.html">Commercial Registration &amp; Licensing Dept.</a>
                            <a class="oc-sub" href="dept-9.html">Companies Affairs Dept.</a>
                            <a class="oc-sub" href="dept-8.html">Intellectual Property Rights Protection Dept.</a>
                            <a class="oc-sub" href="dept-7.html">Single Window Dept.</a>
                        </div>
                    </div>

                    <!-- 2. Industry & Business Development -->
                    <div class="oc-card">
                        <div class="oc-card__head">Asst. Undersecretary for Industry &amp; Business Dev.</div>
                        <div class="oc-card__icon"><svg viewBox="0 0 24 24"><path d="M2 20h20M5 20V10l7-7 7 7v10M9 20v-4h6v4"/></svg></div>
                        <div class="oc-card__body">
                            <a class="oc-sub oc-sub--office" href="dept-26.html">Office of the Asst. Undersecretary</a>
                            <a class="oc-sub" href="dept-12.html">Industrial Development Dept.</a>
                            <a class="oc-sub" href="dept-11.html">National Product Competitiveness Dept.</a>
                            <a class="oc-sub" href="dept-10.html">Business Development Dept.</a>
                            <a class="oc-sub" href="dept-15.html">Trade Exchange &amp; Investment Promotion Dept.</a>
                        </div>
                    </div>

                    <!-- 3. Consumer Affairs -->
                    <div class="oc-card">
                        <div class="oc-card__head">Asst. Undersecretary for Consumer Affairs</div>
                        <div class="oc-card__icon"><svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/><path d="M16 3.13a4 4 0 010 7.75M21 21v-2a4 4 0 00-3-3.85"/></svg></div>
                        <div class="oc-card__body">
                            <a class="oc-sub oc-sub--office" href="dept-27.html">Office of the Asst. Undersecretary</a>
                            <a class="oc-sub" href="dept-13.html">Consumer Protection &amp; Anti-Fraud Dept.</a>
                            <a class="oc-sub" href="dept-14.html">Strategic Supply &amp; Reserves Dept.</a>
                            <a class="oc-sub" href="dept-18.html">Specialized Licensing &amp; Market Supervision Dept.</a>
                            <a class="oc-sub" href="dept-17.html">Competition Protection Dept.</a>
                        </div>
                    </div>

                    <!-- 4. Shared Services -->
                    <div class="oc-card">
                        <div class="oc-card__head">Asst. Undersecretary for Shared Services</div>
                        <div class="oc-card__icon"><svg viewBox="0 0 24 24"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg></div>
                        <div class="oc-card__body">
                            <a class="oc-sub oc-sub--office" href="dept-28.html">Office of the Asst. Undersecretary</a>
                            <a class="oc-sub" href="dept-16.html">Public Relations &amp; Communications Dept.</a>
                            <a class="oc-sub" href="dept-21.html">Human Resources Dept.</a>
                            <a class="oc-sub" href="dept-20.html">Financial &amp; Administrative Affairs Dept.</a>
                            <a class="oc-sub" href="dept-19.html">Information Systems Dept.</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
{FOOTER}
HTML;

$body = str_replace('{HEADER}', $header, $body);
$body = str_replace('{FLOATING}', $floatingMenu, $body);
$body = str_replace('{FOOTER}', $footer, $body);

$fullCss = $css . "\n" . $orgchartCss;
$html = page_shell(
    'Organizational Structure &ndash; Ministry of Commerce and Industry',
    'Organizational Structure of the Ministry of Commerce and Industry per Amiri Decision No. 39 of 2022',
    $body, $fullCss, $js
);

file_put_contents($root . '/en/orgchart.html', $html);
echo "Wrote en/orgchart.html\n";
