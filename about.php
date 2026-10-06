<?php
$page_title = 'About MME | Defining engineering excellence since 2019';
$page_description = 'ISO 9001:2015 certified engineering expertise delivering end-to-end civil, mechanical, electrical and EPC solutions across India.';
$page_canonical = '/about';
$page_og_image = $IMAGES['about'] ?? null;
require __DIR__ . '/includes/header.php';

page_hero('About MME', 'Defining engineering excellence since 2019',
  'ISO 9001:2015 certified engineering expertise delivering end-to-end civil, mechanical, electrical and EPC solutions across India.',
  $IMAGES['about'], [['label' => 'About']]);
?>
<section class="bg-white py-24 lg:py-32">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10 grid lg:grid-cols-2 gap-14 lg:gap-20 items-center">
    <div class="reveal img-zoom rounded-sm overflow-hidden shadow-2xl">
      <img src="<?= e($IMAGES['aboutSecondary']) ?>" alt="MME plant" class="w-full h-[440px] lg:h-[520px] object-cover" />
    </div>
    <div class="reveal reveal-delay-1">
      <p class="kicker text-[#c8a25c] mb-5">Who We Are</p>
      <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl leading-[1.1] mb-8" style="font-weight:800;letter-spacing:-0.02em"><?= e($ABOUT['heading']) ?></h2>
      <?php foreach ($ABOUT['paragraphs'] as $p): ?>
        <p class="text-[15px] md:text-base leading-relaxed text-gray-600 mb-5"><?= e($p) ?></p>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
sec_stats();
sec_director();
?>
<section class="bg-white py-24 lg:py-32">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10 grid lg:grid-cols-12 gap-14 items-center">
    <div class="lg:col-span-8 order-2 lg:order-1 reveal">
      <p class="kicker text-[#c8a25c] mb-6">Human Resources</p>
      <?= icon('quote', 44, 'text-[#c8a25c]/30 mb-4') ?>
      <p class="font-display text-[#0a1a2f] text-xl md:text-2xl lg:text-[1.8rem] leading-[1.5]" style="font-weight:500"><?= e($HR['quote']) ?></p>
      <div class="mt-8">
        <p class="font-display text-lg text-[#0a1a2f]" style="font-weight:800"><?= e($HR['name']) ?></p>
        <p class="text-sm text-gray-500"><?= e($HR['role']) ?></p>
      </div>
    </div>
    <div class="lg:col-span-4 order-1 lg:order-2 reveal reveal-delay-1">
      <div class="img-zoom rounded-sm overflow-hidden max-w-xs mx-auto">
        <img src="<?= e($HR['image']) ?>" alt="<?= e($HR['name']) ?>" class="w-full h-[420px] object-cover" />
      </div>
    </div>
  </div>
</section>
<?php
sec_why();
sec_cta();
require __DIR__ . '/includes/footer.php';
