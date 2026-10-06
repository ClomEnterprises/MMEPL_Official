<?php
require_once __DIR__ . '/../includes/config.php';
$page_title = 'Annual Reports | MME Private Limited';
$page_description = 'A transparent look at our growth, performance and commitment to excellence — year after year.';
$page_canonical = '/we-are/annual-report';
$page_og_image = $IMAGES['annualHero'] ?? null;
require __DIR__ . '/../includes/header.php';

page_hero('We Are · Governance', 'Annual Reports',
  'A transparent look at our growth, performance and commitment to excellence — year after year.',
  $IMAGES['annualHero'], [['label' => 'We Are'], ['label' => 'Annual Report']]);

// --- Build revenue line chart geometry (replaces the React/Recharts chart) ---
$vbW = 800; $vbH = 340; $padL = 44; $padR = 22; $padT = 28; $padB = 34;
$plotW = $vbW - $padL - $padR; $plotH = $vbH - $padT - $padB;
$ticks = [0, 5, 10, 15, 20, 25, 30]; $maxV = 30;
$n = count($REVENUE);
$pts = [];
foreach ($REVENUE as $i => $r) {
    $x = $padL + ($n > 1 ? $i * ($plotW / ($n - 1)) : 0);
    $y = $padT + (1 - ($r['cr'] / $maxV)) * $plotH;
    $pts[] = ['x' => round($x, 1), 'y' => round($y, 1), 'r' => $r];
}
$linePath = '';
foreach ($pts as $i => $p) { $linePath .= ($i === 0 ? 'M' : 'L') . $p['x'] . ' ' . $p['y'] . ' '; }
$table = array_reverse($REVENUE);
?>
<section class="bg-white py-20 lg:py-24">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
    <div class="max-w-2xl reveal mb-14">
      <p class="kicker text-[#c8a25c] mb-5">Performance at a Glance</p>
      <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-[2.6rem] leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">A track record of sustained growth</h2>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
      <?php foreach ($REPORT_HIGHLIGHTS as $i => $h): ?>
        <div class="reveal reveal-delay-<?= ($i % 3) + 1 ?> bg-[#0a1a2f] rounded-sm p-8 text-center">
          <?= icon('trending-up', 22, 'text-[#c8a25c] mx-auto mb-4') ?>
          <p class="font-display text-white text-4xl lg:text-5xl" style="font-weight:800;letter-spacing:-0.02em"><?= e($h['value']) ?></p>
          <p class="text-white/60 text-xs md:text-sm mt-2"><?= e($h['label']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="bg-[#f5f4f1] py-24 lg:py-28" data-testid="revenue-section">
  <div class="max-w-[1200px] mx-auto px-6 lg:px-10">
    <div class="max-w-2xl reveal mb-14">
      <p class="kicker text-[#c8a25c] mb-5">Financial Highlights</p>
      <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">Revenue growth year on year</h2>
    </div>

    <div class="reveal bg-white rounded-lg shadow-[0_20px_60px_rgba(10,26,47,0.10)] border border-gray-100 p-6 sm:p-10 overflow-hidden">
      <div class="flex items-center justify-between gap-4 mb-8">
        <div>
          <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-[#c8a25c]">Year-on-year performance</p>
          <h3 class="mt-1 font-display text-[#0a1a2f] text-xl md:text-2xl" style="font-weight:800" data-testid="revenue-chart-title">Revenue Trend</h3>
        </div>
        <div class="flex items-center gap-2 text-xs text-gray-500" data-testid="revenue-chart-legend">
          <span class="h-2.5 w-2.5 rounded-full bg-[#0a1a2f]"></span> Actual
          <span class="ml-2 h-2.5 w-2.5 rounded-full bg-[#c8a25c]"></span> Projected
        </div>
      </div>
      <div class="w-full relative" data-testid="revenue-line-chart" data-revenue-chart>
        <svg viewBox="0 0 <?= $vbW ?> <?= $vbH ?>" class="w-full h-auto" preserveAspectRatio="xMidYMid meet" font-family="Inter, sans-serif">
          <defs>
            <linearGradient id="revenueLine" x1="0" y1="0" x2="1" y2="0">
              <stop offset="0%" stop-color="#0a1a2f" /><stop offset="78%" stop-color="#1c4b7a" /><stop offset="100%" stop-color="#c8a25c" />
            </linearGradient>
          </defs>
          <?php foreach ($ticks as $t):
            $gy = round($padT + (1 - ($t / $maxV)) * $plotH, 1); ?>
            <line x1="<?= $padL ?>" y1="<?= $gy ?>" x2="<?= $vbW - $padR ?>" y2="<?= $gy ?>" stroke="#e9e7e1" stroke-dasharray="4 5" />
            <text x="<?= $padL - 8 ?>" y="<?= $gy + 4 ?>" text-anchor="end" fill="#9ca3af" font-size="11"><?= $t ?></text>
          <?php endforeach; ?>
          <?php foreach ($pts as $p): ?>
            <text x="<?= $p['x'] ?>" y="<?= $vbH - 12 ?>" text-anchor="middle" fill="#6b7280" font-size="11"><?= e($p['r']['year']) ?></text>
          <?php endforeach; ?>
          <path d="<?= trim($linePath) ?>" fill="none" stroke="url(#revenueLine)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
          <?php foreach ($pts as $idx => $p): $proj = !empty($p['r']['projected']); ?>
            <circle cx="<?= $p['x'] ?>" cy="<?= $p['y'] ?>" r="<?= $proj ? 6 : 5 ?>" fill="<?= $proj ? '#c8a25c' : '#0a1a2f' ?>" stroke="#ffffff" stroke-width="3" data-testid="revenue-line-point-<?= $idx ?>" data-year="<?= e($p['r']['year']) ?>" data-amount="<?= e($p['r']['amount']) ?>" data-projected="<?= $proj ? '1' : '0' ?>" class="cursor-pointer" data-revenue-point></circle>
          <?php endforeach; ?>
        </svg>
        <div class="pointer-events-none absolute hidden min-w-[190px] rounded-sm border border-[#c8a25c]/30 bg-[#0a1a2f] px-4 py-3 text-white shadow-2xl" data-testid="revenue-chart-tooltip" data-revenue-tooltip></div>
      </div>
    </div>

    <div class="reveal reveal-delay-1 mt-8 bg-white rounded-lg shadow-[0_20px_60px_rgba(10,26,47,0.08)] border border-gray-100 overflow-x-auto" data-testid="revenue-table">
      <table class="w-full text-left min-w-[440px]">
        <thead>
          <tr class="bg-[#0a1a2f] text-white">
            <th class="py-4 px-5 sm:px-8 text-xs tracking-widest uppercase font-semibold w-16">Sl. No.</th>
            <th class="py-4 px-5 sm:px-8 text-xs tracking-widest uppercase font-semibold">Year</th>
            <th class="py-4 px-5 sm:px-8 text-xs tracking-widest uppercase font-semibold text-right">Revenue (in ₹)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($table as $i => $r): ?>
            <tr class="border-b border-gray-100 last:border-0 <?= $i % 2 ? 'bg-[#faf9f6]' : 'bg-white' ?> hover:bg-[#fbf3e2] transition-colors">
              <td class="py-4 px-5 sm:px-8 text-sm text-[#c8a25c] font-bold"><?= $i + 1 ?></td>
              <td class="py-4 px-5 sm:px-8 text-sm text-gray-700 font-medium"><?= e(str_replace('–', 'to', $r['year'])) ?></td>
              <td class="py-4 px-5 sm:px-8 text-sm text-[#0a1a2f] font-semibold text-right"><?= e($r['amount']) ?> <?php if (!empty($r['projected'])): ?><span class="text-[#c8a25c] font-normal">(Projected)</span><?php endif; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="bg-white py-24 lg:py-28">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
    <div class="max-w-2xl reveal mb-14">
      <p class="kicker text-[#c8a25c] mb-5">Download Centre</p>
      <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">Year-wise annual reports</h2>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5" data-testid="report-grid">
      <?php foreach ($ANNUAL_REPORTS as $i => $r): $hasPdf = !empty($r['pdf']); ?>
        <div data-testid="report-card-<?= $i ?>" class="reveal reveal-delay-<?= ($i % 3) + 1 ?> group bg-[#f5f4f1] rounded-sm border border-gray-100 p-7 flex flex-col hover:shadow-2xl hover:-translate-y-1 transition-all duration-400">
          <div class="flex items-start justify-between mb-8">
            <div class="w-12 h-12 grid place-items-center bg-[#0a1a2f] rounded-sm group-hover:bg-[#c8a25c] transition-colors duration-400"><?= icon('file-text', 22, 'text-white group-hover:text-[#0a1a2f] transition-colors duration-400') ?></div>
            <span class="text-[10px] tracking-widest uppercase font-semibold px-3 py-1 rounded-full <?= $r['status'] === 'Published' ? 'bg-[#e8f3ec] text-[#2e7d4f]' : 'bg-[#fbf3e2] text-[#c8a25c]' ?>"><?= e($r['status']) ?></span>
          </div>
          <p class="text-xs tracking-widest uppercase text-gray-400 mb-1">Financial Year</p>
          <h3 class="font-display text-[#0a1a2f] text-2xl mb-6" style="font-weight:800"><?= e($r['year']) ?></h3>
          <?php if ($hasPdf): ?>
            <a href="<?= e($r['pdf']) ?>" target="_blank" rel="noopener" data-testid="report-download-<?= $i ?>" class="mt-auto inline-flex items-center justify-center gap-2 text-sm font-medium py-3 rounded-sm transition-all duration-300 bg-[#0a1a2f] text-white hover:bg-[#c8a25c] hover:text-[#0a1a2f]"><?= icon('download', 16) ?> Download PDF</a>
          <?php else: ?>
            <button type="button" data-report-soon data-label="<?= e($r['label']) ?>" data-testid="report-download-<?= $i ?>" class="mt-auto inline-flex items-center justify-center gap-2 text-sm font-medium py-3 rounded-sm transition-all duration-300 bg-white text-gray-500 border border-gray-200 hover:bg-gray-100"><?= icon('lock', 15) ?> Available Soon</button>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
sec_cta();
require __DIR__ . '/../includes/footer.php';
