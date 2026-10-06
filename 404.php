<?php
http_response_code(404);
$page_title = 'Page Not Found | MME Private Limited';
$page_description = 'The page you are looking for could not be found.';
require __DIR__ . '/includes/header.php';
?>
<section class="relative min-h-[70vh] flex items-center justify-center overflow-hidden bg-[#0a1a2f]">
  <div class="absolute inset-0 opacity-[0.05]" style="background-image:radial-gradient(circle at 1px 1px, #fff 1px, transparent 0);background-size:34px 34px"></div>
  <div class="relative z-10 max-w-2xl mx-auto px-6 text-center pt-28 pb-20">
    <p class="kicker text-[#c8a25c] mb-5">Error 404</p>
    <h1 class="font-display text-white text-6xl md:text-8xl leading-none" style="font-weight:800;letter-spacing:-0.03em">404</h1>
    <h2 class="mt-6 font-display text-white text-2xl md:text-3xl" style="font-weight:700">This page could not be found</h2>
    <p class="mt-4 text-white/60 text-[15px] md:text-base leading-relaxed">The page you're looking for may have moved or no longer exists. Let's get you back on track.</p>
    <div class="mt-9 flex flex-wrap items-center justify-center gap-4">
      <a href="/" class="group inline-flex items-center gap-3 rounded-full bg-[#c8a25c] hover:bg-[#d9b877] text-[#0a1a2f] font-semibold text-sm tracking-wide px-8 py-4 transition-colors">Back to home <?= icon('arrow-right', 18, 'group-hover:translate-x-1 transition-transform') ?></a>
      <a href="/contact" class="inline-flex items-center gap-3 rounded-full border border-white/25 text-white hover:border-[#c8a25c] hover:text-[#c8a25c] font-semibold text-sm tracking-wide px-8 py-4 transition-colors">Contact us</a>
    </div>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php';
