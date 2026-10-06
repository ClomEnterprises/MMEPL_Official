<?php
require_once __DIR__ . '/../includes/config.php';
$page_title = 'We Serve | Engineering Solutions Across Every Core Industry | MME Private Limited';
$page_description = 'From cement, power and steel to civil, mechanical and electrical works — MME delivers complete, disciplined execution for India\'s heavy industry.';
$page_canonical = '/we-serve';
$page_og_image = $WESERVE_HERO ?? null;
require __DIR__ . '/../includes/header.php';

page_hero('We Serve', 'Engineering solutions across every core industry',
  "From cement, power and steel to civil, mechanical and electrical works — MME delivers complete, disciplined execution for India's heavy industry.",
  $WESERVE_HERO, [['label' => 'We Serve']]);
?>
<section class="bg-white py-24 lg:py-32">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
    <div class="max-w-2xl reveal mb-16">
      <p class="kicker text-[#c8a25c] mb-5">Our Capabilities</p>
      <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-[2.6rem] leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">Four disciplines, every plant sector</h2>
      <p class="mt-6 text-gray-600 text-[15px] md:text-base leading-relaxed">Mechanical, civil, electrical and support services — delivered across cement, power, steel and fertilizer plants with a single, accountable partner.</p>
    </div>
    <div class="grid md:grid-cols-2 gap-6" data-testid="we-serve-grid">
      <?php foreach ($WE_SERVE as $i => $c): ?>
        <a href="/we-serve/<?= e($c['slug']) ?>" data-testid="we-serve-card-<?= e($c['slug']) ?>" class="reveal reveal-delay-<?= ($i % 3) + 1 ?> group relative rounded-sm overflow-hidden bg-[#0a1a2f] min-h-[360px] flex">
          <div class="img-zoom absolute inset-0">
            <img src="<?= e($c['image']) ?>" alt="<?= e($c['title']) ?>" class="w-full h-full object-cover opacity-60 group-hover:opacity-45 transition-opacity duration-500" />
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-[#0a1a2f] via-[#0a1a2f]/60 to-transparent"></div>
          <div class="relative z-10 mt-auto p-7 w-full">
            <span class="text-[11px] tracking-widest uppercase text-[#c8a25c] font-semibold">0<?= $i + 1 ?></span>
            <div class="flex items-start justify-between gap-4 mt-2">
              <h3 class="font-display text-white text-xl lg:text-2xl leading-tight" style="font-weight:700"><?= e($c['title']) ?></h3>
              <span class="shrink-0 w-10 h-10 rounded-full border border-white/25 grid place-items-center text-white group-hover:bg-[#c8a25c] group-hover:border-[#c8a25c] group-hover:text-[#0a1a2f] transition-all"><?= icon('arrow-up-right', 17) ?></span>
            </div>
            <p class="mt-3 text-white/60 text-sm leading-relaxed"><?= e($c['tagline']) ?></p>
            <p class="mt-4 text-[#c8a25c] text-xs font-semibold">Serving <?= count($c['subs']) ?> plant sectors</p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
sec_cta();
require __DIR__ . '/../includes/footer.php';
