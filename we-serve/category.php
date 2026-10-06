<?php
require_once __DIR__ . '/../includes/config.php';
$slug = isset($_GET['category']) ? preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['category'])) : '';
$cat = ws_find_category($slug);
if (!$cat) { header('Location: /we-serve'); exit; }

$page_title = e($cat['title']) . ' | We Serve | MME Private Limited';
$page_description = $cat['tagline'];
$page_canonical = '/we-serve/' . $cat['slug'];
$page_og_image = $cat['image'];
require __DIR__ . '/../includes/header.php';

page_hero('We Serve', $cat['title'], $cat['tagline'], $cat['image'],
  [['label' => 'We Serve', 'to' => '/we-serve'], ['label' => $cat['short']]]);
?>
<section class="bg-white py-24 lg:py-28">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10 grid lg:grid-cols-2 gap-14 lg:gap-20 items-center">
    <div class="reveal img-zoom rounded-sm overflow-hidden shadow-2xl">
      <img src="<?= e($cat['image']) ?>" alt="<?= e($cat['title']) ?>" class="w-full h-[380px] lg:h-[460px] object-cover" />
    </div>
    <div class="reveal reveal-delay-1">
      <p class="kicker text-[#c8a25c] mb-5">Overview</p>
      <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl leading-[1.1] mb-8" style="font-weight:800;letter-spacing:-0.02em"><?= e($cat['title']) ?></h2>
      <?php foreach ($cat['intro'] as $p): ?><p class="text-[15px] md:text-base leading-relaxed text-gray-600 mb-5"><?= e($p) ?></p><?php endforeach; ?>
    </div>
  </div>
</section>

<section class="bg-[#f5f4f1] py-24 lg:py-28">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
    <div class="max-w-2xl reveal mb-14">
      <p class="kicker text-[#c8a25c] mb-5">Industries We Serve</p>
      <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em"><?= e($cat['short']) ?> across every plant sector</h2>
    </div>
    <div class="grid sm:grid-cols-2 gap-6" data-testid="sub-grid">
      <?php foreach ($cat['subs'] as $i => $s): ?>
        <a href="/we-serve/<?= e($cat['slug']) ?>/<?= e($s['slug']) ?>" data-testid="sub-card-<?= e($s['slug']) ?>" class="reveal reveal-delay-<?= ($i % 3) + 1 ?> group relative rounded-sm overflow-hidden bg-[#0a1a2f] flex flex-col">
          <div class="relative h-48 overflow-hidden">
            <img src="<?= e($s['image']) ?>" alt="<?= e($s['title']) ?>" class="w-full h-full object-cover opacity-70 group-hover:opacity-55 group-hover:scale-105 transition-all duration-700" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a1a2f] via-[#0a1a2f]/30 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6 flex items-end justify-between">
              <h3 class="font-display text-white text-2xl leading-tight" style="font-weight:800"><?= e($s['title']) ?></h3>
              <span class="shrink-0 w-10 h-10 rounded-full border border-white/25 grid place-items-center text-white group-hover:bg-[#c8a25c] group-hover:border-[#c8a25c] group-hover:text-[#0a1a2f] transition-all"><?= icon('arrow-up-right', 17) ?></span>
            </div>
          </div>
          <div class="bg-white p-6 flex-1 flex flex-col">
            <p class="text-gray-600 text-sm leading-relaxed mb-5"><?= e($s['desc']) ?></p>
            <ul class="mt-auto grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
              <?php foreach (array_slice($s['features'], 0, 4) as $f): ?>
                <li class="flex items-start gap-2 text-[13px] text-gray-500"><?= icon('check', 14, 'text-[#c8a25c] mt-0.5 shrink-0') ?> <?= e($f) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
sec_cta();
require __DIR__ . '/../includes/footer.php';
