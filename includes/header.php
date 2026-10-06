<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/icons.php';
require_once __DIR__ . '/partials.php';

/**
 * Per-page SEO variables — set these BEFORE including the header:
 *   $page_title, $page_description, $page_canonical (path), $page_og_image
 */
$page_title       = $page_title       ?? 'MME Private Limited | Civil & Mechanical Engineering';
$page_description = $page_description ?? 'MME Private Limited — civil & mechanical engineering and construction across India since 2019.';
$canonical        = SITE_URL . (isset($page_canonical) ? $page_canonical : current_path());
$og_image         = SITE_URL . (isset($page_og_image) ? $page_og_image : '/assets/images/site/hero-1.jpg');
$org_schema = [
    '@context' => 'https://schema.org',
    '@type'    => 'Organization',
    'name'     => $COMPANY['legalName'],
    'alternateName' => $COMPANY['shortName'],
    'url'      => SITE_URL,
    'logo'     => SITE_URL . $COMPANY['logo'],
    'email'    => $COMPANY['email'],
    'telephone'=> $COMPANY['phone'],
    'foundingDate' => $COMPANY['established'],
    'address'  => array_map(function ($o) {
        return ['@type' => 'PostalAddress', 'name' => $o['label'], 'streetAddress' => $o['address']];
    }, $COMPANY['offices']),
];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#0a1a2f" />
  <title><?= e($page_title) ?></title>
  <meta name="description" content="<?= e($page_description) ?>" />
  <link rel="canonical" href="<?= e($canonical) ?>" />
  <meta name="robots" content="index, follow" />

  <!-- Open Graph -->
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="<?= e($COMPANY['shortName']) ?>" />
  <meta property="og:title" content="<?= e($page_title) ?>" />
  <meta property="og:description" content="<?= e($page_description) ?>" />
  <meta property="og:url" content="<?= e($canonical) ?>" />
  <meta property="og:image" content="<?= e($og_image) ?>" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= e($page_title) ?>" />
  <meta name="twitter:description" content="<?= e($page_description) ?>" />
  <meta name="twitter:image" content="<?= e($og_image) ?>" />

  <link rel="icon" href="/favicon.ico" sizes="any" />
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png" />
  <link rel="preload" as="style" href="/assets/css/main.css" />
  <link rel="stylesheet" href="/assets/css/main.css" />
  <script type="application/ld+json"><?= json_encode($org_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body>
<div class="App">
  <header id="site-header" data-testid="site-header"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-500 bg-gradient-to-b from-[#0a1a2f]/80 to-transparent py-5">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-10 flex items-center justify-between">
      <a href="/" class="flex items-center gap-2.5" data-testid="header-logo-link">
        <span class="grid place-items-center" data-testid="header-logo-mark">
          <img src="<?= e($COMPANY['logo']) ?>" alt="MME Private Limited" class="h-14 w-auto max-w-[320px] object-contain drop-shadow-[0_2px_8px_rgba(0,0,0,0.35)]" data-testid="header-logo-image" />
        </span>
      </a>

      <nav class="hidden lg:flex items-center gap-7">
        <?php foreach ($NAV_LINKS as $l): $active = nav_is_active($l['to']); ?>
          <?php if (!empty($l['children'])): ?>
            <div class="relative group">
              <a href="<?= e($l['to']) ?>" class="flex items-center gap-1 text-[13px] font-medium tracking-wide transition-colors <?= $active ? 'text-[#c8a25c]' : 'text-white/80 hover:text-white' ?>">
                <?= e($l['label']) ?> <?= icon('chevron-down', 14, 'group-hover:rotate-180 transition-transform') ?>
              </a>
              <div class="absolute top-full left-1/2 -translate-x-1/2 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                <div class="bg-white rounded-sm shadow-2xl overflow-hidden w-64 py-2">
                  <?php foreach ($l['children'] as $c): ?>
                    <a href="<?= e($c['to']) ?>" class="block px-5 py-3 text-sm text-[#0a1a2f] hover:bg-[#f5f4f1] hover:text-[#c8a25c] border-l-2 border-transparent hover:border-[#c8a25c] transition-all"><?= e($c['label']) ?></a>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          <?php else: ?>
            <a href="<?= e($l['to']) ?>" class="link-underline text-[13px] font-medium tracking-wide transition-colors <?= $active ? 'text-[#c8a25c]' : 'text-white/80 hover:text-white' ?>"><?= e($l['label']) ?></a>
          <?php endif; ?>
        <?php endforeach; ?>
      </nav>

      <div class="flex items-center gap-4">
        <a href="/contact" class="hidden md:inline-flex items-center justify-center rounded-sm bg-[#c8a25c] px-5 py-2.5 text-xs font-bold uppercase tracking-[0.14em] text-[#0a1a2f] shadow-md transition-[background-color,transform] hover:scale-[1.02] hover:bg-[#d9b877] active:scale-[0.98]" data-testid="header-get-quote-button">Get a Quote</a>
        <button type="button" id="mobile-menu-open" class="lg:hidden text-white p-1" aria-label="Open menu" data-testid="mobile-menu-open-button"><?= icon('menu', 26) ?></button>
      </div>
    </div>
  </header>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="fixed inset-0 z-[60] bg-[#0a1a2f] transition-all duration-500 overflow-y-auto opacity-0 pointer-events-none">
    <div class="max-w-[1400px] mx-auto px-6 py-6 flex items-center justify-between">
      <div class="flex items-center" data-testid="mobile-logo">
        <span class="grid place-items-center" data-testid="mobile-logo-mark">
          <img src="<?= e($COMPANY['logo']) ?>" alt="MME Private Limited" class="h-12 w-auto max-w-[290px] object-contain drop-shadow-[0_2px_8px_rgba(0,0,0,0.35)]" data-testid="mobile-logo-image" />
        </span>
      </div>
      <button type="button" id="mobile-menu-close" class="text-white p-1" aria-label="Close menu" data-testid="mobile-menu-close-button"><?= icon('x', 28) ?></button>
    </div>
    <nav class="px-8 mt-4 flex flex-col">
      <?php foreach ($NAV_LINKS as $i => $l): ?>
        <div class="border-b border-white/10" data-mobile-item>
          <div class="flex items-center justify-between">
            <a href="<?= e($l['to']) ?>" class="flex-1 py-4 font-display text-2xl text-white/90 hover:text-[#c8a25c] transition-colors" style="font-weight:700"><?= e($l['label']) ?></a>
            <?php if (!empty($l['children'])): ?>
              <button type="button" class="text-[#c8a25c] p-2" data-mobile-submenu-toggle="<?= $i ?>" data-testid="mobile-submenu-toggle-<?= $i ?>">
                <span data-plus><?= icon('plus', 20) ?></span><span data-minus class="hidden"><?= icon('minus', 20) ?></span>
              </button>
            <?php endif; ?>
          </div>
          <?php if (!empty($l['children'])): ?>
            <div class="pb-3 pl-3 hidden" data-mobile-submenu="<?= $i ?>">
              <?php foreach ($l['children'] as $c): ?>
                <a href="<?= e($c['to']) ?>" class="block py-2.5 text-white/60 hover:text-[#c8a25c] text-[15px]"><?= e($c['label']) ?></a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </nav>
    <div class="px-8 mt-8 pb-10 text-white/60 text-sm space-y-2">
      <a href="mailto:<?= e($COMPANY['email']) ?>" class="block hover:text-[#c8a25c]"><?= e($COMPANY['email']) ?></a>
      <a href="/contact" class="mt-5 inline-flex rounded-sm bg-[#c8a25c] px-5 py-3 text-xs font-bold uppercase tracking-[0.14em] text-[#0a1a2f]" data-testid="mobile-get-quote-button">Get a Quote</a>
    </div>
  </div>

  <main>
