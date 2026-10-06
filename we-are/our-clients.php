<?php
require_once __DIR__ . '/../includes/config.php';
$page_title = 'Our Clients | Trusted By India\'s Industry Leaders | MME Private Limited';
$page_description = 'We are proud to have partnered with some of the most respected names in cement, steel, power and infrastructure.';
$page_canonical = '/we-are/our-clients';
$page_og_image = $IMAGES['expertise'][2] ?? null;
require __DIR__ . '/../includes/header.php';

page_hero('We Are · Clients', "Trusted by India's industry leaders",
  'We are proud to have partnered with some of the most respected names in cement, steel, power and infrastructure.',
  $IMAGES['expertise'][2], [['label' => 'We Are'], ['label' => 'Our Client']]);
sec_clients();
?>
<section class="bg-white py-24 lg:py-28">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
    <div class="max-w-2xl reveal mb-14">
      <p class="kicker text-[#c8a25c] mb-5">Where We Work</p>
      <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-[2.6rem] leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">Marquee clients across the nation</h2>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5" data-testid="client-grid">
      <?php foreach ($OUR_CLIENTS as $i => $c): ?>
        <div data-testid="client-card-<?= $i ?>" class="reveal reveal-delay-<?= ($i % 3) + 1 ?> group relative bg-[#f5f4f1] rounded-sm p-7 border border-transparent hover:border-[#c8a25c]/40 hover:bg-white hover:shadow-xl transition-all duration-400 overflow-hidden">
          <span class="inline-block text-[11px] tracking-widest uppercase text-[#c8a25c] font-semibold mb-4"><?= e($c['sector']) ?></span>
          <h3 class="font-display text-[#0a1a2f] text-lg leading-snug mb-3" style="font-weight:800"><?= e($c['name']) ?></h3>
          <p class="flex items-center gap-2 text-sm text-gray-500"><?= icon('map-pin', 14, 'text-[#c8a25c]') ?> <?= e($c['location']) ?></p>
          <span class="absolute bottom-0 left-0 h-1 w-full bg-[#c8a25c] scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-500"></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
sec_cta();
require __DIR__ . '/../includes/footer.php';
