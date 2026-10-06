<?php
require_once __DIR__ . '/includes/config.php';
$id = isset($_GET['id']) ? preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['id'])) : '';
$service = null;
foreach ($SERVICES as $s) { if ($s['id'] === $id) { $service = $s; break; } }
if (!$service) { $service = $SERVICES[0]; }
$others = array_values(array_filter($SERVICES, fn($s) => $s['id'] !== $service['id']));

$page_title = e($service['title']) . ' | Services | MME Private Limited';
$page_description = $service['desc'];
$page_canonical = '/services/' . $service['id'];
$page_og_image = $service['image'];
require __DIR__ . '/includes/header.php';

page_hero('Our Services', $service['title'], $service['desc'], $service['image'],
  [['label' => 'Services', 'to' => '/services'], ['label' => $service['title']]]);
?>
<section class="bg-white py-24 lg:py-32">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10 grid lg:grid-cols-12 gap-14 lg:gap-20">
    <div class="lg:col-span-7 reveal">
      <p class="kicker text-[#c8a25c] mb-5">Overview</p>
      <p class="font-display text-[#0a1a2f] text-xl md:text-2xl leading-[1.5] mb-8" style="font-weight:500"><?= e($service['intro']) ?></p>
      <?php foreach ($service['paragraphs'] as $p): ?>
        <p class="text-[15px] md:text-base leading-relaxed text-gray-600 mb-5"><?= e($p) ?></p>
      <?php endforeach; ?>
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
      <h3 class="font-display text-[#0a1a2f] text-2xl md:text-3xl" style="font-weight:800">Other Services</h3>
      <a href="/services" class="hidden sm:inline-flex items-center gap-2 text-sm text-[#0a1a2f] hover:text-[#c8a25c] transition-colors"><?= icon('arrow-left', 16) ?> All services</a>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php foreach ($others as $s): ?>
        <a href="/services/<?= e($s['id']) ?>" class="group relative rounded-sm overflow-hidden min-h-[220px] flex bg-[#0a1a2f]">
          <div class="img-zoom absolute inset-0">
            <img src="<?= e($s['image']) ?>" alt="<?= e($s['title']) ?>" class="w-full h-full object-cover opacity-60 group-hover:opacity-45 transition-opacity" />
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-[#0a1a2f] to-transparent"></div>
          <div class="relative z-10 mt-auto p-6 w-full flex items-center justify-between">
            <h4 class="font-display text-white text-lg" style="font-weight:700"><?= e($s['title']) ?></h4>
            <?= icon('arrow-right', 18, 'text-[#c8a25c] group-hover:translate-x-1 transition-transform') ?>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
sec_cta();
require __DIR__ . '/includes/footer.php';
