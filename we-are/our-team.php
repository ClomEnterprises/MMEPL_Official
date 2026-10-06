<?php
require_once __DIR__ . '/../includes/config.php';
$page_title = 'Our Team | The Team Behind Every Milestone | MME Private Limited';
$page_description = 'A group of dedicated engineers and managers driving quality, safety and timely delivery on every site across India.';
$page_canonical = '/we-are/our-team';
$page_og_image = $IMAGES['teamHero'] ?? null;
require __DIR__ . '/../includes/header.php';

$GRADIENTS = ['from-[#0a1a2f] to-[#1c3a5e]', 'from-[#1c3a5e] to-[#0a1a2f]', 'from-[#0d2240] to-[#243b53]'];

page_hero('We Are · Our People', 'The team behind every milestone',
  'A group of dedicated engineers and managers driving quality, safety and timely delivery on every site across India.',
  $IMAGES['teamHero'], [['label' => 'We Are'], ['label' => 'Our Team']]);
?>
<section class="bg-white py-24 lg:py-32">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
    <div class="max-w-2xl reveal mb-16">
      <p class="kicker text-[#c8a25c] mb-5">Meet Our Experts</p>
      <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-[2.6rem] leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">Skilled professionals, one shared standard</h2>
      <p class="mt-6 text-gray-600 text-[15px] md:text-base leading-relaxed">Our project and HR managers bring decades of combined experience across cement, steel, power and infrastructure — ensuring every mandate is delivered with discipline and precision.</p>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6" data-testid="team-grid">
      <?php foreach ($TEAM as $i => $m): ?>
        <div data-testid="team-member-<?= $i ?>" class="reveal reveal-delay-<?= ($i % 3) + 1 ?> group bg-white rounded-sm border border-gray-100 overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
          <div class="relative h-56 bg-gradient-to-br <?= $GRADIENTS[$i % count($GRADIENTS)] ?> grid place-items-center overflow-hidden">
            <img src="<?= e($m['image']) ?>" alt="<?= e($m['name']) ?>, <?= e($m['role']) ?>" loading="lazy" class="h-full w-full bg-[#eef1f4] object-contain object-center transition-transform duration-700 group-hover:scale-[1.02]" data-testid="team-photo-<?= $i ?>" />
            <span class="absolute bottom-0 left-0 right-0 h-1 bg-[#c8a25c] scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-500"></span>
          </div>
          <div class="p-6 text-center">
            <h3 class="font-display text-[#0a1a2f] text-lg" style="font-weight:800" data-testid="team-name-<?= $i ?>"><?= e($m['name']) ?></h3>
            <p class="text-sm text-[#c8a25c] mt-1" data-testid="team-role-<?= $i ?>"><?= e($m['role']) ?></p>
            <p class="mt-3 flex items-center justify-center gap-1.5 text-[11px] font-semibold uppercase tracking-[0.08em] text-gray-500" data-testid="team-location-<?= $i ?>"><?= icon('map-pin', 12, 'text-[#0a1a2f]') ?> <?= e($m['location']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
sec_cta();
require __DIR__ . '/../includes/footer.php';
