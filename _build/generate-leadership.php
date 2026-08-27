<?php
/**
 * Local build tool — NOT part of the shipped site.
 *
 * Ministry leadership profile pages (undersecretaries). Same header/
 * hero/footer chrome as the rest of the site. Data is inline here
 * (small, hand-maintained list) rather than scraped — extend $people
 * as more bios arrive.
 *
 * Run with: php _build/generate-leadership.php
 */

$root = dirname(__DIR__);
$css = file_get_contents($root . '/assets/css/style.css');
$js = file_get_contents($root . '/assets/js/main.js');

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

/**
 * NOTE on saleh-al-khulaifi's Arabic bio: sourced from a PDF whose text
 * layer systematically dropped "ال" prefixes and a few hamza characters
 * (a common Arabic-PDF extraction artifact) — reconstructed here with
 * the missing articles restored. The opening clause "في صميم عمله..."
 * was a genuine judgment call (the extracted fragment was clearly cut
 * off mid-phrase) — flagged for the client to verify against the
 * source PDF before this goes live.
 */
$people = [
    [
        'slug' => 'hassan-al-ghanim',
        'name_ar' => 'حسن سلطان حسن الغانم',
        'name_en' => 'Hassan bin Sultan Al-Ghanim',
        'role_ar' => 'وكيل وزارة التجارة والصناعة لشؤون المستهلك',
        'role_en' => 'Assistant Undersecretary for Consumer Affairs',
        'email' => null,
        'photo' => 'hassan-al-ghanim.jpg',
        'bio_ar' => [
            'شغل السيد حسن الغانم منصب وكيل وزارة التجارة والصناعة لشؤون المستهلك منذ عام 2023، ويتمتع بخبرة تزيد عن عشرين عاماً في المبادرات الاقتصادية الاستراتيجية، وإدارة الاستثمارات، والتحول المؤسسي. يشرف على برنامج الدعم الغذائي الاستراتيجي لقطر ومخزون الغذاء الاستراتيجي، مع تحديث أنظمة حماية المستهلك.',
            'شغل سابقاً منصب سكرتير نائب رئيس مجلس الوزراء للشؤون الاقتصادية بوزارة الخارجية، حيث ساهم في صياغة السياسات الاقتصادية الوطنية وتعزيز الشراكات الاقتصادية العالمية لقطر. كما تولى مناصب مهمة في الديوان الأميري ومجموعة بروة العقارية، حيث أدار محافظ استثمارية بمليارات الريالات ومشاريع انشائية كبرى.',
            'يحمل درجة الماجستير في إدارة الأعمال من جامعة ليدز، بالإضافة إلى شهادات تنفيذية من معهد ماساتشوستس للتكنولوجيا MIT، وهارفارد، وجامعة جورجتاون. هو نائب رئيس مجلس إدارة شركة حصاد الغذائية، ونائب رئيس مجلس إدارة الميرة، وعضو مجلس إدارة ودام للأغذية.',
        ],
        'bio_en' => [
            'Mr. Hassan Al-Ghanim has served as Assistant Undersecretary for Consumer Affairs at the Ministry of Commerce and Industry since 2023. He brings over twenty years of experience in strategic economic initiatives, investment management, and institutional transformation. He oversees Qatar\'s strategic food subsidy programme and strategic food reserves, while modernising consumer protection systems.',
            'Previously, he served as Secretary to the Deputy Prime Minister for Economic Affairs at the Ministry of Foreign Affairs, where he contributed to shaping national economic policies and strengthening Qatar\'s global economic partnerships. He also held key positions at the Amiri Diwan and Barwa Real Estate Group, where he managed multi-billion-riyal investment portfolios and major construction projects.',
            'He holds an MBA from the University of Leeds, in addition to executive certificates from MIT, Harvard, and Georgetown University. He serves as Vice Chairman of the Board of Hassad Food Company, Vice Chairman of the Board of Al Meera, and Board Member of Widam Food Company.',
        ],
    ],
    [
        'slug' => 'saleh-al-khulaifi',
        'name_ar' => 'صالح ماجد الخليفي',
        'name_en' => 'Saleh Majid Al-Khulaifi',
        'role_ar' => 'وكيل الوزارة المساعد لشؤون الصناعة وتنمية الأعمال',
        'role_en' => 'Deputy Undersecretary for Industrial Affairs and Business Development',
        'email' => 'Salkhulaifi@moci.gov.qa',
        'photo' => 'saleh-al-khulaifi.jpg',
        'bio_ar' => [
            'في صميم عمله دفع التنمية الصناعية وريادة الأعمال وجذب الاستثمار الأجنبي المباشر للمساهمة في تشكيل المشهد الاقتصادي في قطر، حيث ساهم في تطوير الاستراتيجية الوطنية للصناعة.',
            'في إطار عمله بالوزارة، قاد الجهود الرامية إلى تحسين الخدمات التي تقدمها الوزارة للشركات، لضمان كفاءة الإجراءات وسهولة الوصول إليها ودعم نمو الأعمال، وتبسيط عمليات إنشاء الشركات، وخلق بيئة صديقة للأعمال لتعزيز روح المبادرة.',
            'استناداً إلى خبرته الواسعة، شغل عدة مناصب في القطاعين العام والخاص، حيث تولى سابقاً منصب المدير التنفيذي لتوطين الأعمال في بنك قطر للتنمية، حيث أشرف على مشروع “جاهز” الصناعي بقيمة 500 مليون ريال قطري، بالإضافة إلى المساهمة في خلق فرص تتجاوز قيمتها 1.2 مليار ريال قطري.',
            'حصل على درجة الماجستير في ريادة الأعمال التكنولوجية (MSc) عام 2011 من كلية لندن الجامعية (UCL). كما يحمل درجة البكالوريوس في إدارة الأعمال لعام 2010 من جامعة كارنيجي ميلون.',
        ],
        'bio_en' => [
            'Focusing on driving industrial development, entrepreneurship, and attracting foreign direct investment to help in shaping Qatar\'s economic landscape, he helped develop and implement the national manufacturing strategy.',
            'Within the ministry, he led efforts to improve customer-facing services for businesses, ensuring procedures are efficient, accessible, and supportive of business growth — streamlining company set-up processes and creating a business-friendly environment to boost entrepreneurship.',
            'Drawing on his extensive experience, he has held key positions in both the public and private sectors. Notably, he served as the Executive Director of Business Localization at Qatar Development Bank (QDB), where he managed the establishment of a QAR 500 million industrial cluster (Jahiz) as well as identifying opportunities for the private sector worth more than QAR 1.2 billion.',
            'Educationally, Mr. Al-Khulaifi holds a Master of Science in Technology Entrepreneurship (MSc) from University College London (UCL). Additionally, he earned a Bachelor\'s Degree in Business Administration from Carnegie Mellon University.',
        ],
    ],
    [
        'slug' => 'saleh-al-mana',
        'name_ar' => 'صالح عبد الله المانع',
        'name_en' => 'Saleh Abdulla Al-Mana',
        'role_ar' => 'وكيل الوزارة المساعد لشؤون التجارة',
        'role_en' => 'Assistant Undersecretary for Commercial Affairs',
        'email' => null,
        'photo' => 'saleh-al-mana.jpg',
        'bio_ar' => [
            'يشغل السيد صالح عبد الله المانع حالياً وظيفة وكيل الوزارة المساعد لشؤون التجارة بوزارة التجارة والصناعة، حيث يتولى الإشراف على عدد من الملفات الاستراتيجية، لا سيما السياسات التجارية، وتنظيم الأعمال، وحقوق الملكية الفكرية.',
            'وقبل تكليفه بهذه المهام، شغل وظيفة مدير إدارة التعاون الدولي والاتفاقيات التجارية، بالإضافة إلى وظيفة مدير إدارة تنمية التبادل التجاري وترويج الاستثمار بوزارة التجارة والصناعة. وفي مرحلة سابقة من مسيرته المهنية، مثّل دولة قطر في عدد من المنظمات الدولية بجنيف، بصفته رئيساً لمكتب دولة قطر لدى منظمة التجارة العالمية والمنظمات الاقتصادية الأخرى، كما عُيّن خلال تلك الفترة نائباً للمندوب الدائم لدولة قطر لدى منظمة التجارة العالمية.',
            'يحمل السيد صالح عبد الله المانع درجة البكالوريوس في السياسة الدولية من كلية الشؤون الدولية بجامعة جورجتاون في قطر، كما حصل على درجة الماجستير التنفيذي في إدارة الأعمال من جامعة جنيف في سويسرا.',
        ],
        'bio_en' => [
            'Mr. Saleh Abdulla Al-Mana currently serves as the Assistant Undersecretary for Commercial Affairs at the Ministry of Commerce and Industry. In this capacity, he oversees key portfolios related to commercial policy, market regulation, and Intellectual Property Rights.',
            'Prior to this role, he served as Director of the International Cooperation and Trade Agreements Department, as well as Director of the Trade Exchange Development and Investment Promotion Department at the Ministry. Earlier in his career, he represented the State of Qatar in various International Organizations in Geneva as Head of the Office of the State of Qatar to the World Trade Organization (WTO) and other Economic Organizations. During this period, he was also appointed as Qatar\'s Deputy Permanent Representative to the WTO.',
            'Mr. Saleh Abdulla Al-Mana holds a Bachelor\'s degree in International Politics from the School of Foreign Service at Georgetown University in Qatar. He further obtained an Executive MBA from the University of Geneva in Switzerland.',
        ],
    ],
    [
        'slug' => 'ali',
        'name_ar' => 'علي خالد الخليفي',
        'name_en' => 'Ali Khalid Al-Khalifi',
        'role_ar' => 'وكيل الوزارة المساعد لشؤون الخدمات المشتركة',
        'role_en' => 'Assistant Undersecretary for Shared Services',
        'email' => null,
        'photo' => 'ali.jpg',
        'bio_ar' => [
            'سيتم نشر السيرة الذاتية قريباً.',
        ],
        'bio_en' => [
            'Biography coming soon.',
        ],
    ],
];

function render_header(array $breadcrumbs, bool $active, string $enHref): string
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
            <a class="breadcrumb-back" href="leadership.html">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                العودة إلى وكلاء الوزارة
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

/* ---------------------------- Index page ---------------------------- */

$cardsHtml = '';
foreach ($people as $p) {
    $href = $p['slug'] . '.html';
    if ($p['photo']) {
        $photoHtml = '<a href="' . $href . '"><img class="person-card__photo" src="assets/img/people/' . $p['photo'] . '" alt="' . e($p['name_ar']) . '" loading="lazy"></a>';
    } else {
        $initials = mb_substr($p['name_ar'], 0, 1, 'UTF-8');
        $photoHtml = '<a href="' . $href . '"><span class="person-card__photo person-card__photo--placeholder" aria-hidden="true">' . $initials . '</span></a>';
    }
    $cardsHtml .= <<<HTML
                <article class="person-card">
                    {$photoHtml}
                    <div class="person-card__body">
                        <h2 class="person-card__name"><a href="{$href}">{$p['name_ar']}</a></h2>
                        <p class="person-card__role">{$p['role_ar']}</p>
                        <a class="person-card__link" href="{$href}">
                            عرض السيرة الذاتية
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </a>
                    </div>
                </article>
HTML;
}

$header = render_header([['label' => 'عن الوزارة', 'href' => 'ministry-departments.html'], ['label' => 'وكلاء الوزارة']], true, 'en/leadership.html');
$footer = render_footer();
$floatingMenu = render_floating_menu_button();

$body = <<<HTML
{$header}
{$floatingMenu}
<main id="main">
    <section class="hero" style="background-image: url('assets/img/hero-departments.png');">
        <div class="container hero__inner">
            <h1 class="hero__title">وكلاء الوزارة</h1>
            <p class="hero__subtitle">القيادات الإدارية العليا في وزارة التجارة والصناعة.</p>
        </div>
    </section>

    <section class="departments">
        <div class="container">
            <div class="leadership-grid">
{$cardsHtml}
            </div>
        </div>
    </section>
</main>
{$footer}
HTML;

$html = page_shell('وكلاء الوزارة – وزارة التجارة والصناعة', 'القيادات الإدارية العليا في وزارة التجارة والصناعة.', $body, $css, $js);
file_put_contents($root . '/leadership.html', $html);
echo "Wrote leadership.html\n";

/* ---------------------------- Profile pages ---------------------------- */

foreach ($people as $p) {
    $bioHtml = '';
    foreach ($p['bio_ar'] as $para) {
        $bioHtml .= '<p>' . e($para) . '</p>';
    }

    $emailHtml = '';
    if ($p['email']) {
        $emailHtml = '<div class="profile-photo-card__footer"><a class="profile-photo-card__email" href="mailto:' . e($p['email']) . '">' . e($p['email']) . '</a></div>';
    }

    if ($p['photo']) {
        $profilePhotoHtml = '<img src="assets/img/people/' . $p['photo'] . '" alt="' . e($p['name_ar']) . '">';
    } else {
        $initials = mb_substr($p['name_ar'], 0, 1, 'UTF-8');
        $profilePhotoHtml = '<span class="profile-photo-card__placeholder">' . $initials . '</span>';
    }

    $header = render_header([
        ['label' => 'عن الوزارة', 'href' => 'ministry-departments.html'],
        ['label' => 'وكلاء الوزارة', 'href' => 'leadership.html'],
        ['label' => $p['name_ar']],
    ], true, 'en/' . $p['slug'] . '.html');
    $footer = render_footer();
    $floatingMenu = render_floating_menu_button();

    $body = <<<HTML
{$header}
{$floatingMenu}
<main id="main">
    <section class="detail">
        <div class="container profile-layout">
            <aside class="profile-photo-card">
                {$profilePhotoHtml}
                {$emailHtml}
            </aside>

            <article class="profile-main">
                <span class="profile-main__role">{$p['role_ar']}</span>
                <h1 class="profile-main__title">{$p['name_ar']}</h1>
                <div class="profile-bio">
                    {$bioHtml}
                </div>
            </article>
        </div>
    </section>
</main>
{$footer}
HTML;

    $html = page_shell(
        e($p['name_ar']) . ' – وزارة التجارة والصناعة',
        e($p['role_ar']) . ' – ' . e($p['name_ar']),
        $body,
        $css,
        $js
    );
    file_put_contents($root . '/' . $p['slug'] . '.html', $html);
    echo "Wrote {$p['slug']}.html\n";
}

/* ========================= Tabbed single-page version ========================= */

$tabsHtml = '';
$panelsHtml = '';
foreach ($people as $i => $p) {
    $activeClass = $i === 0 ? ' is-active' : '';
    $tabsHtml .= '<button type="button" class="leadership-tab' . $activeClass . '" data-tab="' . $i . '">' . e($p['name_ar']) . '</button>';

    if ($p['photo']) {
        $panelPhoto = '<img class="leadership-panel__photo" src="assets/img/people/' . $p['photo'] . '" alt="' . e($p['name_ar']) . '">';
    } else {
        $initials = mb_substr($p['name_ar'], 0, 1, 'UTF-8');
        $panelPhoto = '<span class="leadership-panel__photo leadership-panel__photo--placeholder">' . $initials . '</span>';
    }

    $panelBio = '';
    foreach ($p['bio_ar'] as $para) {
        $panelBio .= '<p>' . e($para) . '</p>';
    }

    $panelsHtml .= <<<HTML
            <div class="leadership-panel{$activeClass}" data-panel="{$i}">
                {$panelPhoto}
                <div class="leadership-panel__body">
                    <h2>{$p['role_ar']}</h2>
                    <h3>{$p['name_ar']}</h3>
                    {$panelBio}
                </div>
            </div>
HTML;
}

$tabJs = <<<JS
(function(){
    var tabs = Array.prototype.slice.call(document.querySelectorAll('.leadership-tab'));
    var panels = Array.prototype.slice.call(document.querySelectorAll('.leadership-panel'));
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            var idx = tab.getAttribute('data-tab');
            tabs.forEach(function(t){ t.classList.remove('is-active'); });
            panels.forEach(function(p){ p.classList.remove('is-active'); });
            tab.classList.add('is-active');
            var target = document.querySelector('[data-panel="' + idx + '"]');
            if (target) target.classList.add('is-active');
        });
    });
})();
JS;

$header = render_header([['label' => 'عن الوزارة', 'href' => 'ministry-departments.html'], ['label' => 'وكلاء الوزارة']], true, 'en/leadership-tabbed.html');
$footer = render_footer();
$floatingMenu = render_floating_menu_button();

$tabbedBody = <<<HTML
{$header}
{$floatingMenu}
<main id="main">
    <section class="hero" style="background-image: url('assets/img/hero-departments.png');">
        <div class="container hero__inner">
            <h1 class="hero__title">وكلاء الوزارة</h1>
            <p class="hero__subtitle">القيادات الإدارية العليا في وزارة التجارة والصناعة.</p>
        </div>
    </section>

    <section class="departments">
        <div class="container">
            <div class="leadership-tabs">
                {$tabsHtml}
            </div>
            {$panelsHtml}
        </div>
    </section>
</main>
{$footer}
HTML;

$tabbedJs = $js . "\n" . $tabJs;
$tabbedHtml = page_shell('وكلاء الوزارة – وزارة التجارة والصناعة', 'القيادات الإدارية العليا في وزارة التجارة والصناعة.', $tabbedBody, $css, $tabbedJs);
file_put_contents($root . '/leadership-tabbed.html', $tabbedHtml);
echo "Wrote leadership-tabbed.html\n";
