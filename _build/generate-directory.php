<?php
/**
 * Local build tool — NOT part of the shipped site.
 *
 * Option 2: same header, hero banner, and footer as the main listing
 * page — only the content area differs. Instead of a card grid, this
 * renders a dense grouped directory (category sections of compact rows,
 * each linking straight to the real department page) so all 21
 * departments are scannable without scrolling through card previews.
 *
 * Run with: php _build/generate-directory.php
 */

$root = dirname(__DIR__);

$rawJson = file_get_contents($root . '/data/departments_raw.json');
$raw = json_decode($rawJson, true);
if (!$raw) {
    fwrite(STDERR, "Could not read/parse departments_raw.json\n");
    exit(1);
}

$categories = [
    'office-legal' => ['label' => 'مكتب الوزير والشؤون القانونية', 'orders' => [1, 2, 3, 6]],
    'trade-corporate' => ['label' => 'التجارة وشؤون الشركات', 'orders' => [4, 7, 8, 9]],
    'industry-investment' => ['label' => 'الصناعة وتنمية الأعمال والاستثمار', 'orders' => [10, 11, 12, 15]],
    'consumer-markets' => ['label' => 'حماية المستهلك ومراقبة الأسواق', 'orders' => [13, 14, 17, 18]],
    'corporate-support' => ['label' => 'الخدمات المؤسسية والدعم', 'orders' => [5, 16, 19, 20, 21]],
];

$orderToCategory = [];
foreach ($categories as $key => $cat) {
    foreach ($cat['orders'] as $order) {
        $orderToCategory[$order] = $key;
    }
}

/* All five stay in the ministry's maroon/rose family — a graduated
   dark-to-light progression, not five unrelated hues, per client request. */
$categoryColors = [
    'office-legal' => 'var(--maroon-950)',
    'trade-corporate' => 'var(--maroon-900)',
    'industry-investment' => 'var(--maroon-700)',
    'consumer-markets' => 'var(--maroon-600)',
    'corporate-support' => 'var(--rose-500)',
];

$categoryIcons = [
    'office-legal' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v18M5 8l-3 5a4 4 0 0 0 8 0l-3-5H5Zm14 0l-3 5a4 4 0 0 0 8 0l-3-5h-2ZM5 8h4M15 8h4M8 21h8"/></svg>',
    'trade-corporate' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M3 12h18"/></svg>',
    'industry-investment' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l6-6 4 4 8-8"/><path d="M17 7h4v4"/></svg>',
    'consumer-markets' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 4v5c0 5-3.5 8-7 9-3.5-1-7-4-7-9V7l7-4Z"/><path d="M9 12l2 2 4-4"/></svg>',
    'corporate-support' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.9.3H9a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.9-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.9V9a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1Z"/></svg>',
];

$departments = [];
foreach ($raw as $row) {
    $departments[] = [
        'order' => $row['order'],
        'slug' => 'dept-' . $row['order'],
        'title' => $row['canonical_title'],
        'tasks' => $row['responsibilities'],
        'category' => $orderToCategory[$row['order']],
    ];
}
usort($departments, fn($a, $b) => $a['order'] <=> $b['order']);

$css = file_get_contents($root . '/assets/css/style.css');
$js = file_get_contents($root . '/assets/js/main.js');

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

/* ---- header/footer/shell: identical to generate.php, kept in sync by hand ---- */

function render_header(array $breadcrumbs, bool $active, string $enHref = 'en/ministry-departments-directory.html'): string
{
    $activeClass = $active ? 'is-active' : '';
    $crumbsHtml = '';
    foreach ($breadcrumbs as $i => $crumb) {
        $crumbsHtml .= '<span class="sep">/</span>';
        if (isset($crumb['href']) && $i < count($breadcrumbs) - 1) {
            $crumbsHtml .= '<a href="' . e($crumb['href']) . '">' . e($crumb['label']) . '</a>';
        } else {
            $crumbsHtml .= '<span class="current">' . e($crumb['label']) . '</span>';
        }
    }

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
                <li><a href="index.html">الرئيسية</a></li>
                <li class="{$activeClass}"><a href="ministry-departments.html">عن الوزارة</a></li>
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

    <div class="breadcrumb-bar">
        <div class="container breadcrumb-bar__inner">
            <a class="breadcrumb-back" href="ministry-departments.html">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                العودة إلى عن الوزارة
            </a>
            <div class="breadcrumb-trail">
                <a href="index.html">الرئيسية</a>
                {$crumbsHtml}
            </div>
        </div>
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
                <li><a href="#">برنامج الشراكة بين القطاعين الحكومي والخاص</a></li>
                <li><a href="#">مشاريع الشراكة</a></li>
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
                <li><a href="#">الرؤية والرسالة والقيم</a></li>
                <li><a href="#">استراتيجية الوزارة</a></li>
                <li><a href="#">الهيكل التنظيمي</a></li>
                <li><a href="ministry-departments.html">إدارات الوزارة</a></li>
                <li><a href="#">اللجان الوطنية</a></li>
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

function render_floating_menu_button(): string
{
    return <<<HTML
<a href="index.html" class="floating-menu-btn">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
    <span>القائمة الرئيسية</span>
</a>
HTML;
}

function page_shell(string $title, string $description, string $bodyHtml, string $css, string $js): string
{
    return <<<HTML
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{$title}</title>
<meta name="description" content="{$description}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
<style>
{$css}
</style>
</head>
<body>
{$bodyHtml}
<script>
{$js}
</script>
</body>
</html>
HTML;
}

/* ---------------------------- Directory content area ---------------------------- */

$groupsHtml = '';
$groupIndex = 0;
foreach ($categories as $catKey => $cat) {
    $groupIndex++;
    $rowsHtml = '';
    $groupCount = 0;
    foreach ($departments as $dept) {
        if ($dept['category'] !== $catKey) continue;
        $groupCount++;
        $totalTasks = count($dept['tasks']);
        $href = $dept['slug'] . '.html';
        $icon = $categoryIcons[$catKey];
        $searchBlob = e(mb_strtolower($dept['title'] . ' ' . implode(' ', $dept['tasks']), 'UTF-8'));

        $rowsHtml .= <<<HTML
                    <a class="directory__row" href="{$href}" data-searchable data-category="{$catKey}" data-search="{$searchBlob}">
                        <span class="dept-card__icon" aria-hidden="true">{$icon}</span>
                        <span class="directory__row-title">{$dept['title']}</span>
                        <span class="directory__row-count">{$totalTasks} اختصاصاً</span>
                        <svg class="directory__row-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </a>
HTML;
    }

    $icon = $categoryIcons[$catKey];
    $groupStyle = "--cat-fg:{$categoryColors[$catKey]};";
    $plainClass = $groupIndex % 2 === 0 ? ' directory__group--plain' : '';
    $groupsHtml .= <<<HTML
                <div class="directory__group{$plainClass}" data-group data-category="{$catKey}" style="{$groupStyle}">
                    <div class="directory__group-header">
                        <span class="directory__group-icon" aria-hidden="true">{$icon}</span>
                        <h2>{$cat['label']}</h2>
                        <span class="directory__group-count">{$groupCount} إدارات</span>
                    </div>
                    <div class="directory__rows">
                        {$rowsHtml}
                    </div>
                </div>
HTML;
}

$pillsHtml = '<button type="button" class="filter-pill is-active" data-category="all">جميع الإدارات</button>';
foreach ($categories as $key => $cat) {
    $pillsHtml .= '<button type="button" class="filter-pill" data-category="' . $key . '">' . e($cat['label']) . '</button>';
}

$header = render_header([['label' => 'عن الوزارة', 'href' => '#'], ['label' => 'الإدارات']], true);
$footer = render_footer();
$floatingMenu = render_floating_menu_button();

$body = <<<HTML
{$header}
{$floatingMenu}
<main id="main">
    <section class="hero" style="background-image: url('assets/img/hero-departments.png');">
        <div class="container hero__inner">
            <h1 class="hero__title">إدارات الوزارة</h1>
            <p class="hero__subtitle">إدارات وزارة التجارة والصناعة ومسؤولياتها.</p>
        </div>
    </section>

    <div class="filter-bar">
        <div class="container filter-bar__inner">
            <div class="filter-search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="search" id="deptSearch" placeholder="ابحث باسم الإدارة أو اختصاصها...">
            </div>
            <div class="filter-bar__row">
                <div class="filter-pills">
                    {$pillsHtml}
                </div>
                <span class="filter-count" data-template="{n} من {total} إدارة"></span>
            </div>
        </div>
    </div>

    <section class="departments">
        <div class="container">
            <div class="directory" data-dept-grid>
{$groupsHtml}
            </div>
            <div class="no-results">
                <strong>لا توجد نتائج مطابقة</strong>
                <span>جرّب كلمة بحث مختلفة أو اختر تصنيفاً آخر.</span>
            </div>
        </div>
    </section>

    <section class="newsletter">
        <div class="container newsletter__inner">
            <div>
                <h2 class="newsletter__title">انضم إلينا</h2>
                <p class="newsletter__text">ابق على اتصال مع وزارة التجارة والصناعة في قطر. انضم إلى مجتمع متنامٍ من المستثمرين والشركاء والمبتكرين الذين يصنعون المستقبل.</p>
            </div>
            <form class="newsletter__form">
                <label class="visually-hidden" for="newsletterEmail">عنوان بريدك الإلكتروني</label>
                <input class="newsletter__input" type="email" id="newsletterEmail" placeholder="عنوان بريدك الإلكتروني" data-success-label="تم الاشتراك بنجاح، شكراً لك!" required>
                <button type="submit" class="btn btn-light">اشترك</button>
            </form>
        </div>
    </section>
</main>
{$footer}
HTML;

$html = page_shell('دليل إدارات الوزارة – وزارة التجارة والصناعة', 'دليل إدارات وزارة التجارة والصناعة ومسؤولياتها.', $body, $css, $js);
file_put_contents($root . '/ministry-departments-directory.html', $html);
echo "Wrote ministry-departments-directory.html\n";
