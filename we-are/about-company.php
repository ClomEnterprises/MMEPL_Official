<?php
require_once __DIR__ . '/../includes/config.php';
$page_title = 'About Company | MME Private Limited';
$page_description = 'ISO 9001:2015 certified engineering expertise delivering end-to-end civil, mechanical, electrical and EPC solutions across India.';
$page_canonical = '/we-are/about-company';
$page_og_image = $IMAGES['about'] ?? null;
require __DIR__ . '/../includes/header.php';

page_hero('We Are · About Company', 'Defining engineering excellence since 2019',
  'ISO 9001:2015 certified engineering expertise delivering end-to-end civil, mechanical, electrical and EPC solutions across India.',
  $IMAGES['about'], [['label' => 'We Are'], ['label' => 'About Company']]);
?>
<section class="bg-white py-24 lg:py-32" data-testid="about-company-intro-section">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10 grid lg:grid-cols-2 gap-14 lg:gap-20 items-center">
    <div class="reveal img-zoom rounded-sm overflow-hidden shadow-2xl">
      <img src="<?= e($IMAGES['aboutSecondary']) ?>" alt="MME plant" class="w-full h-[440px] lg:h-[540px] object-cover" />
    </div>
    <div class="reveal reveal-delay-1">
      <p class="kicker text-[#c8a25c] mb-5">Who We Are</p>
      <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl leading-[1.1] mb-8" style="font-weight:800;letter-spacing:-0.02em" data-testid="about-company-intro-heading"><?= e($ABOUT['heading']) ?></h2>
      <p class="border-l-2 border-[#c8a25c] pl-5 text-[15px] md:text-base leading-relaxed text-gray-700" data-testid="about-company-intro-lead"><?= e($ABOUT['lead']) ?></p>
      <div class="mt-7 grid sm:grid-cols-2 gap-3.5" data-testid="about-company-intro-highlights">
        <?php foreach ($ABOUT['highlights'] as $i => $item): ?>
          <article class="rounded-sm border border-[#0a1a2f]/10 bg-[#f5f4f1] p-5" data-testid="about-company-intro-highlight-<?= $i ?>">
            <h3 class="font-display text-sm font-bold text-[#0a1a2f]"><?= e($item['title']) ?></h3>
            <p class="mt-2 text-[13px] leading-relaxed text-gray-600"><?= e($item['text']) ?></p>
          </article>
        <?php endforeach; ?>
      </div>
      <div class="mt-4 rounded-sm bg-[#0a1a2f] px-5 py-4" data-testid="about-company-intro-commitment">
        <p class="text-[13px] md:text-sm leading-relaxed text-white"><?= e($ABOUT['commitment']) ?></p>
      </div>
    </div>
  </div>
</section>
<?php sec_stats(); ?>

<section class="relative py-24 lg:py-32 overflow-hidden bg-[#0a1a2f]" data-testid="mission-vision-section">
  <div class="absolute inset-0">
    <img src="<?= e($IMAGES['missionVision']) ?>" alt="Vision" class="w-full h-full object-cover opacity-20" />
    <div class="absolute inset-0 bg-gradient-to-b from-[#0a1a2f] via-[#0a1a2f]/90 to-[#0a1a2f]"></div>
  </div>
  <div class="relative z-10 max-w-[1400px] mx-auto px-6 lg:px-10">
    <div class="text-center max-w-2xl mx-auto reveal">
      <p class="kicker text-[#c8a25c] mb-5">Our Mission &amp; Vision</p>
      <h2 class="font-display text-white text-3xl md:text-4xl lg:text-5xl leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">Rising above all standards</h2>
    </div>
    <div class="grid md:grid-cols-2 gap-6 lg:gap-8 mt-16">
      <div class="reveal bg-white/[0.04] border border-white/10 backdrop-blur-sm rounded-sm p-9 lg:p-11 hover:border-[#c8a25c]/50 transition-colors duration-500">
        <div class="w-14 h-14 grid place-items-center bg-[#c8a25c] rounded-sm mb-7"><?= icon('target', 26, 'text-[#0a1a2f]') ?></div>
        <h3 class="font-display text-white text-2xl mb-4" style="font-weight:700">Our Mission</h3>
        <p class="text-white/70 leading-relaxed text-[15px] md:text-base"><?= e($MISSION_VISION['mission']) ?></p>
      </div>
      <div class="reveal reveal-delay-1 bg-white/[0.04] border border-white/10 backdrop-blur-sm rounded-sm p-9 lg:p-11 hover:border-[#c8a25c]/50 transition-colors duration-500">
        <div class="w-14 h-14 grid place-items-center bg-[#c8a25c] rounded-sm mb-7"><?= icon('eye', 26, 'text-[#0a1a2f]') ?></div>
        <h3 class="font-display text-white text-2xl mb-4" style="font-weight:700">Our Vision</h3>
        <p class="text-white/70 leading-relaxed text-[15px] md:text-base"><?= e($MISSION_VISION['vision']) ?></p>
      </div>
    </div>
    <div class="reveal mt-8 bg-[#c8a25c] rounded-sm p-9 lg:p-11 flex flex-col md:flex-row md:items-center gap-6">
      <?= icon('handshake', 40, 'text-[#0a1a2f] shrink-0') ?>
      <p class="text-[#0a1a2f] leading-relaxed text-[15px] md:text-lg font-medium"><?= e($MISSION_VISION['commitment']) ?></p>
    </div>
  </div>
</section>

<section class="bg-[#f5f4f1] py-24 lg:py-28" data-testid="core-values-section">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
    <div class="max-w-2xl reveal">
      <p class="kicker text-[#c8a25c] mb-5">What Drives Us</p>
      <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-[2.6rem] leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">The values behind every project</h2>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-14">
      <?php foreach ($MISSION_VISION['values'] as $i => $v): ?>
        <div class="reveal reveal-delay-<?= ($i % 3) + 1 ?> bg-white rounded-sm p-8 border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-400">
          <?= icon($MISSION_VALUE_ICONS[$i % count($MISSION_VALUE_ICONS)], 30, 'text-[#c8a25c] mb-6') ?>
          <h3 class="font-display text-[#0a1a2f] text-xl mb-3" style="font-weight:700"><?= e($v['title']) ?></h3>
          <p class="text-gray-600 text-sm leading-relaxed"><?= e($v['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="relative overflow-hidden bg-[#071421] py-24 lg:py-28" data-testid="hse-policy-section">
  <div class="absolute inset-0 opacity-[0.05]" style="background-image:radial-gradient(circle at 1px 1px, #fff 1px, transparent 0);background-size:30px 30px"></div>
  <div class="relative mx-auto grid max-w-[1400px] gap-14 px-6 lg:grid-cols-12 lg:px-10">
    <div class="reveal lg:col-span-5">
      <p class="kicker mb-5 text-[#c8a25c]">Responsible Execution</p>
      <h2 class="font-display text-3xl leading-[1.06] text-white md:text-4xl lg:text-[2.7rem]" style="font-weight:800;letter-spacing:-0.02em" data-testid="hse-policy-heading">HSE Policy <span class="block text-[#c8a25c]">Health, Safety &amp; Environment</span></h2>
      <p class="mt-7 text-[15px] leading-relaxed text-white/70 md:text-base" data-testid="hse-policy-intro"><?= e($HSE_POLICY['intro']) ?></p>
      <div class="mt-8 flex items-center gap-3 border-l-2 border-[#c8a25c] pl-5 text-sm font-semibold uppercase tracking-[0.12em] text-white"><?= icon('shield-check', 22, 'text-[#c8a25c]') ?> Safety before schedule</div>
    </div>
    <div class="grid gap-4 sm:grid-cols-2 lg:col-span-7">
      <?php foreach ($HSE_POLICY['commitments'] as $i => $item): ?>
        <article class="reveal reveal-delay-<?= ($i % 3) + 1 ?> border border-white/10 bg-white/[0.05] p-7 backdrop-blur-sm transition-[border-color,transform] duration-300 hover:-translate-y-1 hover:border-[#c8a25c]/50" data-testid="hse-policy-card-<?= $i ?>">
          <?= icon($HSE_ICONS[$i], 27, 'mb-5 text-[#c8a25c]') ?>
          <h3 class="font-display text-lg font-bold text-white"><?= e($item['title']) ?></h3>
          <p class="mt-3 text-sm leading-relaxed text-white/60"><?= e($item['desc']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="bg-[#f5f4f1] py-24 lg:py-28" data-testid="core-strengths-section">
  <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
    <div class="reveal grid gap-7 lg:grid-cols-12 lg:items-end">
      <div class="lg:col-span-7">
        <p class="kicker mb-5 text-[#c8a25c]">Built to Deliver</p>
        <h2 class="font-display text-3xl leading-[1.05] text-[#0a1a2f] md:text-4xl lg:text-[2.7rem]" style="font-weight:800;letter-spacing:-0.02em" data-testid="core-strengths-heading">Core Strengths</h2>
      </div>
      <p class="text-[15px] leading-relaxed text-gray-600 lg:col-span-5">The people, systems and resources that enable MME to execute complex industrial assignments with confidence.</p>
    </div>
    <div class="mt-14 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($CORE_STRENGTHS as $i => $item): ?>
        <article class="reveal reveal-delay-<?= ($i % 3) + 1 ?> group relative overflow-hidden border border-[#0a1a2f]/10 bg-white p-8 transition-[box-shadow,transform,border-color] duration-300 hover:-translate-y-1 hover:border-[#c8a25c]/50 hover:shadow-xl" data-testid="core-strength-card-<?= $i ?>">
          <span class="absolute right-5 top-4 font-display text-4xl font-black text-[#0a1a2f]/[0.04]"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
          <div class="grid h-11 w-11 place-items-center bg-[#0a1a2f] text-[#c8a25c] transition-colors duration-300 group-hover:bg-[#c8a25c] group-hover:text-[#0a1a2f]"><?= icon($STRENGTH_ICONS[$i], 21) ?></div>
          <h3 class="mt-6 font-display text-xl font-bold text-[#0a1a2f]"><?= e($item['title']) ?></h3>
          <p class="mt-3 text-sm leading-relaxed text-gray-600"><?= e($item['desc']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php sec_certifications(); ?>

<section class="bg-white py-16 lg:py-20">
  <div class="max-w-[1100px] mx-auto px-6 lg:px-10">
    <div class="reveal border-l-4 border-[#c8a25c] bg-[#fbf8f1] rounded-sm p-8 lg:p-10 flex gap-5">
      <?= icon('triangle-alert', 28, 'text-[#c8a25c] shrink-0 mt-1') ?>
      <div>
        <h3 class="font-display text-[#0a1a2f] text-lg mb-2" style="font-weight:800">Caution Notice</h3>
        <p class="text-gray-600 text-sm md:text-[15px] leading-relaxed">It has come to our notice that certain fraudulent individuals are using the name of MME Private Limited on social media, websites and WhatsApp to solicit fees or payments for various schemes. MME Private Limited never solicits payment of any kind for any scheme, nor charges fees for online submissions. We have not authorised any third-party website or entity claiming to represent us and offering monetary benefits.</p>
      </div>
    </div>
  </div>
</section>
<?php
sec_cta();
require __DIR__ . '/../includes/footer.php';
