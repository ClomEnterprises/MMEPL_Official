<?php
require_once __DIR__ . '/../includes/config.php';
$page_title = 'Board of Directors | MME Private Limited';
$page_description = 'Meet the leaders steering MME Private Limited with vision, integrity and decades of engineering expertise.';
$page_canonical = '/we-are/board-of-directors';
$page_og_image = $IMAGES['boardHero'] ?? null;
require __DIR__ . '/../includes/header.php';

page_hero('We Are · Leadership', 'Board of Directors',
  'Meet the leaders steering MME Private Limited with vision, integrity and decades of engineering expertise.',
  $IMAGES['boardHero'], [['label' => 'We Are'], ['label' => 'Board of Director']]);
?>
<section class="bg-white py-24 lg:py-32">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10 space-y-24 lg:space-y-32">
    <?php foreach ($BOARD as $idx => $d): $odd = $idx % 2 === 1; ?>
      <div data-testid="director-card-<?= $idx ?>" class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center">
        <div class="lg:col-span-4 reveal <?= $odd ? 'lg:order-2' : '' ?>">
          <div class="relative max-w-sm mx-auto">
            <div class="absolute -inset-3 border border-[#c8a25c]/40 rounded-sm"></div>
            <div class="img-zoom rounded-sm overflow-hidden relative shadow-2xl">
              <img src="<?= e($d['image']) ?>" alt="<?= e($d['name']) ?>" class="w-full h-[440px] lg:h-[520px] object-cover <?= e($d['imgPos'] ?? '') ?>" />
            </div>
            <div class="absolute -bottom-5 left-1/2 -translate-x-1/2 bg-[#c8a25c] text-[#0a1a2f] px-7 py-3 rounded-sm shadow-xl whitespace-nowrap text-center">
              <p class="font-display text-lg leading-tight" style="font-weight:800"><?= e($d['name']) ?></p>
              <p class="text-xs"><?= e($d['role']) ?></p>
            </div>
          </div>
        </div>
        <div class="lg:col-span-8 reveal reveal-delay-1 <?= $odd ? 'lg:order-1' : '' ?>">
          <p class="kicker text-[#c8a25c] mb-4">Message from the Desk</p>
          <?= icon('quote', 44, 'text-[#c8a25c]/30 mb-5') ?>
          <div class="space-y-5">
            <?php foreach ($d['message'] as $p): ?>
              <p class="text-[15px] md:text-base leading-relaxed text-gray-600"><?= e($p) ?></p>
            <?php endforeach; ?>
          </div>
          <div class="mt-8 pt-6 border-t border-gray-100">
            <p class="font-display text-xl text-[#0a1a2f]" style="font-weight:800"><?= e($d['name']) ?></p>
            <p class="text-sm text-[#c8a25c]"><?= e($d['role']) ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php
sec_cta();
require __DIR__ . '/../includes/footer.php';
