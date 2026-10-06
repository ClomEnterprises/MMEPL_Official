<?php
require_once __DIR__ . '/../includes/config.php';
$catSlug = isset($_GET['category']) ? preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['category'])) : '';
$subSlug = isset($_GET['sub']) ? preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['sub'])) : '';
$cat = ws_find_category($catSlug);
if (!$cat) { header('Location: /we-serve'); exit; }
$service = ws_find_sub($cat, $subSlug);
if (!$service) { header('Location: /we-serve/' . $cat['slug']); exit; }
$others = array_values(array_filter($cat['subs'], fn($s) => $s['slug'] !== $service['slug']));

$page_title = e($cat['short']) . ' — ' . e($service['title']) . ' | We Serve | MME Private Limited';
$page_description = $service['desc'];
$page_canonical = '/we-serve/' . $cat['slug'] . '/' . $service['slug'];
$page_og_image = $service['image'];
require __DIR__ . '/../includes/header.php';

page_hero('We Serve · ' . $cat['short'], $cat['short'] . ' — ' . $service['title'], $service['desc'], $service['image'],
  [['label' => 'We Serve', 'to' => '/we-serve'], ['label' => $cat['short'], 'to' => '/we-serve/' . $cat['slug']], ['label' => $service['title']]]);
?>
<section class="bg-white py-24 lg:py-32">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10 grid lg:grid-cols-12 gap-14 lg:gap-20">
    <div class="lg:col-span-7 reveal">
      <p class="kicker text-[#c8a25c] mb-5">Overview</p>
      <p class="font-display text-[#0a1a2f] text-xl md:text-2xl leading-[1.5] mb-8" style="font-weight:500"><?= e($service['desc']) ?></p>
      <div class="img-zoom rounded-sm overflow-hidden shadow-xl mb-8">
        <img src="<?= e($service['image']) ?>" alt="<?= e($service['title']) ?>" class="w-full h-[280px] object-cover" />
      </div>
      <p class="text-[15px] md:text-base leading-relaxed text-gray-600 mb-5">As part of our <?= e(strtolower($cat['title'])) ?> capability, MME delivers <?= e(strtolower($cat['short'])) ?> for <?= e(strtolower($service['title'])) ?> projects with experienced engineers, dedicated machinery and disciplined project management — meeting the highest standards of quality, safety and on-time completion anywhere in India.</p>
      <p class="text-[15px] md:text-base leading-relaxed text-gray-600">Every mandate is backed by rigorous QA/QC, a zero-harm safety culture and single-point accountability, so our clients can rely on a partner that delivers precisely what was promised.</p>
    </div>
    <div class="lg:col-span-5 reveal reveal-delay-1">
      <div class="bg-[#f5f4f1] rounded-sm p-8 lg:p-10 sticky top-28">
        <h3 class="font-display text-[#0a1a2f] text-xl mb-6" style="font-weight:800">Scope of Work</h3>
        <ul class="space-y-4">
          <?php foreach ($service['features'] as $f): ?>
            <li class="flex items-start gap-3 text-[15px] text-gray-700">
              <span class="mt-1 w-5 h-5 shrink-0 grid place-items-center bg-[#c8a25c] rounded-full"><?= icon('check', 12, 'text-[#0a1a2f]') ?></span>
              <?= e($f) ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="bg-[#f5f4f1] py-20 lg:py-24">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
    <div class="flex items-center justify-between mb-10">
      <h3 class="font-display text-[#0a1a2f] text-2xl md:text-3xl" style="font-weight:800">More in <?= e($cat['short']) ?></h3>
      <a href="/we-serve/<?= e($cat['slug']) ?>" class="hidden sm:inline-flex items-center gap-2 text-sm text-[#0a1a2f] hover:text-[#c8a25c] transition-colors"><?= icon('arrow-left', 16) ?> All <?= e($cat['short']) ?> services</a>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5" data-testid="other-subs">
      <?php foreach ($others as $s): ?>
        <a href="/we-serve/<?= e($cat['slug']) ?>/<?= e($s['slug']) ?>" class="group bg-white rounded-sm border border-gray-100 p-6 flex items-center justify-between gap-4 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-400">
          <div>
            <h4 class="font-display text-[#0a1a2f] text-base leading-snug" style="font-weight:700"><?= e($s['title']) ?></h4>
            <p class="text-gray-500 text-xs mt-1 line-clamp-1"><?= e($s['desc']) ?></p>
          </div>
          <?= icon('arrow-right', 18, 'text-[#c8a25c] shrink-0 group-hover:translate-x-1 transition-transform') ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
sec_cta();
require __DIR__ . '/../includes/footer.php';
