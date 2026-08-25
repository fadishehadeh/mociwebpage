<?php
/**
 * Local build tool — NOT part of the shipped site.
 *
 * Landing page (index.html): introduces this as a redesign concept for
 * the Ministry of Commerce and Industry's departments page, and offers
 * two design directions to explore. Same header/footer as the rest of
 * the site so it feels like one connected package.
 *
 * Run with: php _build/generate-landing.php
 */

$root = dirname(__DIR__);
$css = file_get_contents($root . '/assets/css/style.css');
$js = file_get_contents($root . '/assets/js/main.js');

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function render_header(bool $active, string $enHref = 'en/index.html'): string
{
    return <<<HTML
<a class="skip-link" href="#main">تخطي إلى المحتوى</a>
<header class="site-header">
    <div class="utility-bar">
        <div class="container utility-bar__inner">
            <button type="button" class="icon-btn" aria-label="خيارات إتاحة الوصول">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="5" r="2"/><path d="M4 8.5 12 10l8-1.5M12 10v5m0 0-3 7m3-7 3 7"/></svg>
            </button>
            <button type="button" class="icon-btn" aria-label="حسابي">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c1.6-4 5-6 8-6s6.4 2 8 6"/></svg>
            </button>
            <a class="icon-btn lang-switch" href="{$enHref}" aria-label="Switch to English">EN</a>
            <button type="button" class="icon-btn" aria-label="بحث">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
            </button>
        </div>
    </div>

    <div class="container main-nav-row">
        <a href="index.html" class="brand">
            <span class="brand__crest" aria-hidden="true">MOCI</span>
            <span class="brand__text">
                <span class="brand__title">وزارة التجارة والصناعة</span><br>
                <span class="brand__subtitle">Ministry of Commerce and Industry</span>
            </span>
        </a>

        <nav class="main-nav" id="mainNav" aria-label="التنقل الرئيسي">
            <ul class="main-nav__list">
                <li class="is-active"><a href="index.html">الرئيسية</a></li>
                <li><a href="ministry-departments.html">عن الوزارة</a></li>
                <li><a href="#">مركز الخدمات</a></li>
                <li><a href="#">الخدمات الإلكترونية</a></li>
                <li><a href="#">المركز الإعلامي</a></li>
                <li><a href="#">استثمر في قطر</a></li>
                <li><a href="#">النافذة الواحدة</a></li>
            </ul>
        </nav>

        <button type="button" class="nav-toggle" id="navToggle" aria-label="فتح القائمة" aria-expanded="false" aria-controls="mainNav">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
    </div>
</header>
HTML;
}

function render_footer(): string
{
    $year = date('Y');
    return <<<HTML
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
        <div>
            <h3>المركز الإعلامي</h3>
            <ul>
                <li><a href="#">أخبار</a></li>
                <li><a href="#">النماذج والتقارير</a></li>
                <li><a href="#">موارد</a></li>
            </ul>
        </div>
        <div>
            <h3>استثمر في قطر</h3>
            <ul>
                <li><a href="#">لماذا قطر</a></li>
                <li><a href="#">خطوات الاستثمار</a></li>
                <li><a href="#">الشراكات الدولية</a></li>
            </ul>
        </div>
        <div>
            <h3>مركز الخدمات</h3>
            <ul>
                <li><a href="#">خدمات المستهلك</a></li>
                <li><a href="#">منصة خدمات الصناعة</a></li>
                <li><a href="#">خدمات المستثمر المحلي</a></li>
            </ul>
        </div>
        <div>
            <h3>عن الوزارة</h3>
            <ul>
                <li><a href="ministry-departments.html">إدارات الوزارة</a></li>
                <li><a href="leadership.html">وكلاء الوزارة</a></li>
                <li><a href="#">اتصل بنا</a></li>
            </ul>
        </div>
    </div>

    <div class="container footer-bottom">
        <span>© {$year} وزارة التجارة والصناعة. جميع الحقوق محفوظة.</span>
        <div class="footer-legal">
            <a href="#">خريطة الموقع</a>
            <a href="#">شروط الاستخدام</a>
            <a href="#">سياسة الخصوصية</a>
        </div>
    </div>
</footer>

<button type="button" class="back-to-top" id="backToTop" aria-label="العودة إلى الأعلى">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
</button>
HTML;
}

$header = render_header(true);
$footer = render_footer();

$body = <<<HTML
{$header}
<main id="main">
    <section class="hero" style="background-image: url('assets/img/hero-departments.png');">
        <div class="container hero__inner">
            <h1 class="hero__title">إدارات الوزارة</h1>
            <p class="hero__subtitle">تصميم مُعاد لصفحة إدارات وزارة التجارة والصناعة، بنفس الهوية البصرية ونفس المحتوى.</p>
        </div>
    </section>

    <div class="container">
        <div class="options-grid options-grid--single">
            <article class="option-card">
                <div class="option-preview option-preview--cards">
                    <span></span><span></span><span></span><span></span>
                </div>
                <h2 class="option-card__title">إدارات الوزارة</h2>
                <p class="option-card__desc">شبكة من البطاقات المصغّرة لكل إدارة، مع تصنيفات وبحث سريع للوصول مباشرة إلى اختصاصات كل إدارة.</p>
                <a class="btn btn-primary" href="ministry-departments.html">
                    استعراض إدارات الوزارة
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" width="16" height="16"><path d="M13 6l6 6-6 6M5 12h14"/></svg>
                </a>
            </article>
        </div>

        <div class="quicklinks">
            <h2 class="quicklinks__title">روابط إضافية</h2>
            <div class="quicklinks-grid">
                <a class="quicklink-card" href="leadership.html">
                    <span class="quicklink-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3"/><path d="M3 21v-1a6 6 0 0 1 6-6h0a6 6 0 0 1 6 6v1"/><circle cx="17" cy="8.5" r="2.5"/><path d="M21 21v-1a5 5 0 0 0-3-4.6"/></svg>
                    </span>
                    <span class="quicklink-card__body">
                        <h3>وكلاء الوزارة</h3>
                        <p>القيادات الإدارية العليا في الوزارة ونبذة عن كل منهم</p>
                    </span>
                    <svg class="quicklink-card__arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
            </div>
        </div>
    </div>
</main>
{$footer}
HTML;

$html = <<<HTML
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>وزارة التجارة والصناعة</title>
<meta name="description" content="الصفحة الرئيسية لإعادة تصميم موقع وزارة التجارة والصناعة.">
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

file_put_contents($root . '/index.html', $html);
echo "Wrote index.html\n";
