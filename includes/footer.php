  </main>

  <?php $whatsappNumber = preg_replace('/\D/', '', $COMPANY['phone']); ?>
  <a href="https://wa.me/<?= e($whatsappNumber) ?>" target="_blank" rel="noreferrer noopener"
     aria-label="Chat with MME Private Limited on WhatsApp" data-testid="floating-whatsapp-link"
     class="group fixed bottom-5 right-5 sm:bottom-7 sm:right-7 z-[55] grid h-14 w-14 place-items-center rounded-full bg-[#25D366] text-white shadow-[0_10px_30px_rgba(0,0,0,0.28)] transition-colors hover:bg-[#20bd5a] focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#0a1a2f]">
    <span class="pointer-events-none absolute right-full mr-3 hidden whitespace-nowrap rounded-full bg-[#0a1a2f] px-3 py-2 text-xs font-semibold tracking-wide text-white opacity-0 shadow-lg transition-opacity group-hover:opacity-100 lg:block" data-testid="floating-whatsapp-label">WhatsApp us</span>
    <svg viewBox="0 0 24 24" class="h-7 w-7" fill="currentColor" aria-hidden="true"><path d="M12.004 0C5.383 0 .005 5.378.005 12c0 2.116.553 4.18 1.603 6L0 24l6.163-1.617A11.94 11.94 0 0 0 12.004 24C18.625 24 24 18.622 24 12S18.625 0 12.004 0Zm0 21.938a9.9 9.9 0 0 1-5.053-1.384l-.362-.215-3.657.959.975-3.563-.235-.37A9.89 9.89 0 0 1 2.066 12c0-5.477 4.46-9.934 9.942-9.934 5.478 0 9.938 4.457 9.938 9.934 0 5.478-4.46 9.938-9.942 9.938Zm5.447-7.444c-.298-.149-1.765-.87-2.04-.97-.273-.1-.473-.149-.672.15-.198.297-.77.97-.944 1.168-.174.198-.347.223-.646.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.76-1.654-2.059-.174-.297-.018-.458.13-.606.135-.134.298-.347.447-.521.149-.174.198-.298.298-.497.1-.198.05-.372-.025-.521-.075-.149-.672-1.62-.921-2.218-.242-.58-.487-.5-.672-.51l-.572-.01c-.198 0-.521.075-.795.372-.273.298-1.043 1.02-1.043 2.487s1.068 2.884 1.218 3.083c.149.198 2.102 3.21 5.094 4.504.71.307 1.265.49 1.697.627.713.227 1.362.195 1.874.118.572-.085 1.765-.72 2.014-1.416.248-.695.248-1.29.173-1.416-.074-.124-.273-.198-.572-.347Z" /></svg>
  </a>

  <footer class="bg-[#0a1a2f] text-white pt-20 pb-8" data-testid="site-footer">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
      <div class="grid lg:grid-cols-12 gap-12 pb-14 border-b border-white/10">
        <div class="lg:col-span-4">
          <a href="/" class="inline-flex items-center mb-6" aria-label="MME Private Limited home" data-testid="footer-logo-link">
            <img src="<?= e($COMPANY['logo']) ?>" alt="MME Private Limited" class="h-14 sm:h-16 w-auto max-w-[320px] object-contain drop-shadow-[0_2px_8px_rgba(0,0,0,0.35)]" data-testid="footer-logo-image" />
          </a>
          <p class="text-white/60 text-sm leading-relaxed max-w-sm mb-6"><?= e($COMPANY['legalName']) ?> — specialists in civil &amp; mechanical development, delivering industrial projects across India with discipline, quality and precision since <?= e($COMPANY['established']) ?>.</p>
          <div class="space-y-3 text-sm">
            <a href="mailto:<?= e($COMPANY['email']) ?>" class="flex items-center gap-3 text-white/70 hover:text-[#c8a25c] transition-colors"><?= icon('mail', 15, 'text-[#c8a25c]') ?> <?= e($COMPANY['email']) ?></a>
            <a href="<?= e($COMPANY['phoneRaw']) ?>" class="flex items-center gap-3 text-white/70 hover:text-[#c8a25c] transition-colors"><?= icon('phone', 15, 'text-[#c8a25c]') ?> <?= e($COMPANY['phone']) ?></a>
          </div>
          <div class="mt-7" data-testid="footer-social-icons">
            <p class="mb-3 text-[10px] font-semibold uppercase tracking-[0.22em] text-white/40" data-testid="footer-social-heading">Follow MME</p>
            <div class="flex items-center gap-2.5">
              <?php
              $social = [['facebook','Facebook'],['instagram','Instagram'],['linkedin','LinkedIn'],['youtube','YouTube']];
              $iconClass = 'grid h-9 w-9 place-items-center rounded-full border border-white/15 text-white/70 transition-colors hover:border-[#c8a25c] hover:text-[#c8a25c]';
              foreach ($social as [$key, $label]):
                $href = $COMPANY['socials'][$key] ?? '';
                if ($href): ?>
                  <a href="<?= e($href) ?>" target="_blank" rel="noreferrer noopener" aria-label="<?= e($label) ?>" class="<?= $iconClass ?>" data-testid="footer-social-<?= e($key) ?>"><?= icon($key, 16) ?></a>
                <?php else: ?>
                  <span role="img" aria-label="<?= e($label) ?> link coming soon" title="<?= e($label) ?> link coming soon" class="<?= $iconClass ?>" data-testid="footer-social-<?= e($key) ?>"><?= icon($key, 16) ?></span>
                <?php endif;
              endforeach; ?>
            </div>
          </div>
        </div>

        <div class="lg:col-span-2">
          <h4 class="font-display text-sm tracking-widest uppercase text-white/40 mb-5">Explore</h4>
          <ul class="space-y-3">
            <?php foreach ($NAV_LINKS as $l): ?>
              <li><a href="<?= e($l['to']) ?>" class="text-white/70 hover:text-[#c8a25c] text-sm transition-colors link-underline"><?= e($l['label']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="lg:col-span-2">
          <h4 class="font-display text-sm tracking-widest uppercase text-white/40 mb-5">Services</h4>
          <ul class="space-y-3">
            <?php foreach ($SERVICES as $s): ?>
              <li><a href="/services/<?= e($s['id']) ?>" class="text-white/70 hover:text-[#c8a25c] text-sm transition-colors text-left link-underline"><?= e($s['title']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="lg:col-span-4">
          <h4 class="font-display text-sm tracking-widest uppercase text-white/40 mb-5">Our Offices</h4>
          <div class="space-y-5">
            <?php foreach ($COMPANY['offices'] as $o): ?>
              <div class="flex gap-3">
                <?= icon('map-pin', 16, 'text-[#c8a25c] shrink-0 mt-0.5') ?>
                <div>
                  <p class="text-white/90 text-sm font-medium"><?= e($o['label']) ?></p>
                  <p class="text-white/55 text-xs leading-relaxed"><?= e($o['address']) ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-8">
        <p class="text-white/40 text-xs">© <?= date('Y') ?> <?= e($COMPANY['legalName']) ?>. All rights reserved.</p>
        <button type="button" id="back-to-top" class="group flex items-center gap-2 text-white/60 hover:text-[#c8a25c] text-xs tracking-widest uppercase transition-colors">
          Back to top
          <span class="w-9 h-9 rounded-full border border-white/20 grid place-items-center group-hover:border-[#c8a25c] transition-colors"><?= icon('arrow-up', 15) ?></span>
        </button>
      </div>
    </div>
  </footer>

  <!-- Toast host -->
  <div id="toast-host" class="fixed bottom-0 right-0 z-[100] flex max-h-screen w-full flex-col-reverse gap-2 p-4 sm:max-w-[420px]"></div>
</div>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
