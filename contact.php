<?php
$page_title = "Contact | Let's Build Something Enduring | MME Private Limited";
$page_description = "Three offices, one dependable team. Reach out and we'll help you take the next step on your project.";
$page_canonical = '/contact';
$page_og_image = $IMAGES['about'] ?? null;
require __DIR__ . '/includes/header.php';

$firstMap = $COMPANY['offices'][0]['map'];
$mapSrc = 'https://maps.google.com/maps?q=' . rawurlencode($firstMap) . '&z=15&output=embed';
$dir = 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode($firstMap);

page_hero('Get In Touch', "Let's build something enduring",
  "Three offices, one dependable team. Reach out and we'll help you take the next step on your project.",
  $IMAGES['about'], [['label' => 'Contact']]);

$quick = [
  ['icon' => 'phone', 'label' => 'Call Us', 'value' => $COMPANY['phone'], 'href' => $COMPANY['phoneRaw']],
  ['icon' => 'mail', 'label' => 'Email Us', 'value' => $COMPANY['email'], 'href' => 'mailto:' . $COMPANY['email']],
  ['icon' => 'clock', 'label' => 'Opening Hours', 'value' => $COMPANY['hours'], 'href' => null],
];
?>
<section class="bg-white py-16 lg:py-20">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10 grid sm:grid-cols-3 gap-5">
    <?php foreach ($quick as $i => $q):
      $inner = '<span class="w-14 h-14 rounded-full bg-[#0a1a2f] grid place-items-center shrink-0 group-hover:bg-[#c8a25c] transition-colors duration-400">' . icon($q['icon'], 22, 'text-[#c8a25c] group-hover:text-[#0a1a2f] transition-colors duration-400') . '</span><span><span class="block text-xs uppercase tracking-widest text-gray-400">' . e($q['label']) . '</span><span class="text-[#0a1a2f] font-display text-lg" style="font-weight:700">' . e($q['value']) . '</span></span>';
      $cls = 'reveal reveal-delay-' . (($i % 3) + 1) . ' group flex items-center gap-4 bg-[#f5f4f1] rounded-sm p-6';
      if ($q['href']): ?>
        <a href="<?= e($q['href']) ?>" data-testid="quick-<?= e($q['label']) ?>" class="<?= $cls ?> hover:shadow-xl transition-all duration-400"><?= $inner ?></a>
      <?php else: ?>
        <div class="<?= $cls ?>"><?= $inner ?></div>
      <?php endif;
    endforeach; ?>
  </div>
</section>

<section class="bg-[#0a1a2f] py-24 lg:py-28" data-testid="offices-section">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
    <div class="max-w-2xl reveal mb-14">
      <p class="kicker text-[#c8a25c] mb-5">Our Offices</p>
      <h2 class="font-display text-white text-3xl md:text-4xl lg:text-[2.6rem] leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">Find us across India</h2>
    </div>
    <div class="grid lg:grid-cols-12 gap-6 lg:gap-8" data-offices>
      <div class="lg:col-span-5 space-y-4">
        <?php foreach ($COMPANY['offices'] as $i => $o): $act = $i === 0; ?>
          <button type="button" data-office="<?= $i ?>" data-map="<?= e($o['map']) ?>" data-label="<?= e($o['label']) ?>" data-testid="office-card-<?= $i ?>" class="w-full text-left rounded-sm p-6 border transition-all duration-400 <?= $act ? 'bg-[#c8a25c] border-[#c8a25c]' : 'bg-white/[0.04] border-white/10 hover:border-[#c8a25c]/50' ?>">
            <div class="flex items-start gap-4">
              <span class="w-11 h-11 rounded-sm grid place-items-center shrink-0 <?= $act ? 'bg-[#0a1a2f]' : 'bg-[#c8a25c]' ?>" data-office-badge><?= icon('building-2', 20, $act ? 'text-[#c8a25c]' : 'text-[#0a1a2f]') ?></span>
              <div class="flex-1">
                <p class="font-display text-lg <?= $act ? 'text-[#0a1a2f]' : 'text-white' ?>" style="font-weight:800" data-office-title><?= e($o['label']) ?></p>
                <p class="text-sm leading-relaxed mt-1.5 <?= $act ? 'text-[#0a1a2f]/80' : 'text-white/55' ?>" data-office-addr><?= e($o['address']) ?></p>
                <div class="flex flex-wrap gap-x-5 gap-y-1 mt-3 text-sm <?= $act ? 'text-[#0a1a2f]' : 'text-white/70' ?>" data-office-contact>
                  <span class="inline-flex items-center gap-1.5"><?= icon('phone', 13) ?> <?= e($o['phone']) ?></span>
                  <span class="inline-flex items-center gap-1.5"><?= icon('mail', 13) ?> <?= e($o['email']) ?></span>
                </div>
              </div>
            </div>
          </button>
        <?php endforeach; ?>
      </div>
      <div class="lg:col-span-7 reveal">
        <div class="rounded-sm overflow-hidden shadow-2xl border border-white/10 h-[360px] lg:h-full min-h-[360px] bg-white">
          <iframe data-office-map title="Map — <?= e($COMPANY['offices'][0]['label']) ?>" data-testid="office-map" src="<?= e($mapSrc) ?>" class="w-full h-full" style="border:0" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        </div>
        <a data-office-directions href="<?= e($dir) ?>" target="_blank" rel="noreferrer" data-testid="get-directions" class="mt-4 inline-flex items-center gap-2 bg-[#c8a25c] hover:bg-white text-[#0a1a2f] font-semibold px-6 py-3 rounded-sm transition-colors"><?= icon('navigation', 17) ?> <span data-office-dir-label>Get directions to <?= e($COMPANY['offices'][0]['label']) ?></span></a>
      </div>
    </div>
  </div>
</section>

<section class="bg-[#f5f4f1] py-24 lg:py-28" id="enquiry">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10 grid lg:grid-cols-12 gap-14 lg:gap-20 items-start">
    <div class="lg:col-span-5 reveal">
      <p class="kicker text-[#c8a25c] mb-5">Send an Enquiry</p>
      <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl leading-[1.05] mb-6" style="font-weight:800;letter-spacing:-0.02em">Tell us about your project</h2>
      <p class="text-gray-600 text-[15px] leading-relaxed mb-8">Share a few details and our team will get back to you promptly. Whether it's a shutdown, a new plant or an expansion, MME is ready to deliver.</p>
      <div class="space-y-4">
        <a href="<?= e($COMPANY['phoneRaw']) ?>" class="flex items-center gap-4 group">
          <span class="w-12 h-12 rounded-full bg-[#0a1a2f] grid place-items-center shrink-0"><?= icon('phone', 18, 'text-[#c8a25c]') ?></span>
          <span class="text-[#0a1a2f] font-medium group-hover:text-[#c8a25c] transition-colors"><?= e($COMPANY['phone']) ?></span>
        </a>
        <a href="mailto:<?= e($COMPANY['email']) ?>" class="flex items-center gap-4 group">
          <span class="w-12 h-12 rounded-full bg-[#0a1a2f] grid place-items-center shrink-0"><?= icon('mail', 18, 'text-[#c8a25c]') ?></span>
          <span class="text-[#0a1a2f] font-medium group-hover:text-[#c8a25c] transition-colors"><?= e($COMPANY['email']) ?></span>
        </a>
      </div>
    </div>

    <div class="lg:col-span-7 reveal reveal-delay-1">
      <form action="/forms/contact-submit.php" method="post" data-ajax-form data-form-key="contact" data-testid="contact-form" class="bg-white rounded-sm p-8 lg:p-10 shadow-xl border border-gray-100">
        <?= csrf_field('contact') ?>
        <input name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true" data-testid="contact-honeypot-input" />
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Name *</label>
            <input name="name" required data-testid="input-name" placeholder="Your name" class="w-full bg-[#f5f4f1] border border-gray-200 rounded-sm px-4 py-3.5 text-[#0a1a2f] focus:outline-none focus:border-[#c8a25c] transition-colors" />
          </div>
          <div>
            <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Phone</label>
            <input name="phone" data-testid="input-phone" placeholder="Phone number" class="w-full bg-[#f5f4f1] border border-gray-200 rounded-sm px-4 py-3.5 text-[#0a1a2f] focus:outline-none focus:border-[#c8a25c] transition-colors" />
          </div>
          <div>
            <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Email *</label>
            <input name="email" type="email" required data-testid="input-email" placeholder="you@company.com" class="w-full bg-[#f5f4f1] border border-gray-200 rounded-sm px-4 py-3.5 text-[#0a1a2f] focus:outline-none focus:border-[#c8a25c] transition-colors" />
          </div>
          <div>
            <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Preferred Office</label>
            <select name="office" data-testid="input-office" class="w-full bg-[#f5f4f1] border border-gray-200 rounded-sm px-4 py-3.5 text-[#0a1a2f] focus:outline-none focus:border-[#c8a25c] transition-colors">
              <?php foreach ($COMPANY['offices'] as $o): ?><option value="<?= e($o['label']) ?>"><?= e($o['label']) ?></option><?php endforeach; ?>
            </select>
          </div>
          <div class="sm:col-span-2">
            <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Message *</label>
            <textarea name="message" rows="5" required data-testid="input-message" placeholder="Tell us about your project..." class="w-full bg-[#f5f4f1] border border-gray-200 rounded-sm px-4 py-3.5 text-[#0a1a2f] focus:outline-none focus:border-[#c8a25c] transition-colors resize-none"></textarea>
          </div>
        </div>
        <button type="submit" data-testid="submit-enquiry" class="group w-full mt-6 inline-flex items-center justify-center gap-2 bg-[#0a1a2f] hover:bg-[#c8a25c] hover:text-[#0a1a2f] text-white font-semibold py-4 rounded-sm transition-colors disabled:cursor-not-allowed disabled:opacity-60" data-submit-label="Send message" data-loading-label="Sending…">
          <span data-btn-text>Send message</span> <?= icon('send', 17, 'text-[#c8a25c] group-hover:text-[#0a1a2f] group-hover:translate-x-1 transition-all') ?>
        </button>
        <p role="status" aria-live="polite" class="mt-4 text-center text-sm text-[#0a1a2f] hidden" data-testid="contact-form-status" data-form-status></p>
      </form>
    </div>
  </div>
</section>
<?php
require __DIR__ . '/includes/footer.php';
