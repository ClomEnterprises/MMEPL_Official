<?php
/**
 * Reusable section renderers — the PHP equivalents of the original React
 * components. Every page composes its layout from these functions, so a
 * change here updates that section everywhere it appears.
 */

function page_hero($kicker, $title, $subtitle, $image, $crumbs = []) { ?>
  <section class="relative min-h-[52vh] lg:min-h-[60vh] flex items-end overflow-hidden bg-[#0a1a2f]">
    <div class="absolute inset-0">
      <img src="<?= e($image) ?>" alt="<?= e($title) ?>" class="w-full h-full object-cover kenburns" />
      <div class="absolute inset-0 bg-gradient-to-r from-[#0a1a2f] via-[#0a1a2f]/80 to-[#0a1a2f]/40"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-[#0a1a2f] via-transparent to-transparent"></div>
    </div>
    <div class="relative z-10 w-full max-w-[1400px] mx-auto px-6 lg:px-10 pb-16 pt-32">
      <?php if ($kicker): ?><p class="kicker text-[#c8a25c] mb-5"><?= e($kicker) ?></p><?php endif; ?>
      <h1 class="font-display text-white text-4xl md:text-5xl lg:text-6xl leading-[1.02] max-w-4xl" style="font-weight:800;letter-spacing:-0.02em"><?= e($title) ?></h1>
      <?php if ($subtitle): ?><p class="mt-6 text-white/70 text-base md:text-lg max-w-2xl leading-relaxed"><?= e($subtitle) ?></p><?php endif; ?>
      <nav class="mt-8 flex items-center gap-2 text-sm text-white/50">
        <a href="/" class="hover:text-[#c8a25c] transition-colors">Home</a>
        <?php foreach ($crumbs as $c): ?>
          <span class="flex items-center gap-2">
            <?= icon('chevron-right', 14, 'text-white/30') ?>
            <?php if (!empty($c['to'])): ?>
              <a href="<?= e($c['to']) ?>" class="hover:text-[#c8a25c] transition-colors"><?= e($c['label']) ?></a>
            <?php else: ?>
              <span class="text-[#c8a25c]"><?= e($c['label']) ?></span>
            <?php endif; ?>
          </span>
        <?php endforeach; ?>
      </nav>
    </div>
  </section>
<?php }

function sec_hero() { global $HERO, $IMAGES, $HERO_ROUTE; ?>
  <section id="home" data-testid="hero-section" class="relative h-screen min-h-[640px] w-full overflow-hidden bg-[#0a1a2f]" data-hero>
    <?php foreach ($HERO as $i => $slide): ?>
      <div data-hero-slide="<?= $i ?>" data-testid="hero-slide-<?= $i ?>" class="absolute inset-0 transition-opacity duration-[1400ms] <?= $i === 0 ? 'opacity-100' : 'opacity-0' ?>">
        <div class="absolute inset-0 overflow-hidden">
          <img src="<?= e($IMAGES['heroSlides'][$i]) ?>" alt="MME industrial project" data-testid="hero-slide-image-<?= $i ?>" data-hero-img class="w-full h-full object-cover <?= $i === 0 ? 'kenburns' : '' ?>" />
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#081827]/95 via-[#0a1a2f]/75 to-[#0a1a2f]/25" aria-hidden="true"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#071421]/90 via-transparent to-[#071421]/20" aria-hidden="true"></div>
      </div>
    <?php endforeach; ?>

    <div class="relative z-10 h-full max-w-[1400px] mx-auto px-6 lg:px-10 flex flex-col justify-center">
      <?php foreach ($HERO as $i => $slide):
        $target = $HERO_ROUTE[$slide['target']] ?? '/we-are/about-company';
        $sTarget = $HERO_ROUTE[$slide['secondaryTarget']] ?? '/contact'; ?>
        <div data-hero-content="<?= $i ?>" data-testid="hero-slide-content-<?= $i ?>" class="absolute left-6 right-6 sm:left-10 lg:left-20 xl:left-32 transition-all duration-700 <?= $i === 0 ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6 pointer-events-none' ?>">
          <p class="mb-5 flex items-center gap-3 text-[10px] font-bold uppercase tracking-[0.2em] text-[#ff9a45] sm:text-xs sm:tracking-[0.24em]" data-testid="hero-slide-kicker-<?= $i ?>">
            <span class="h-0.5 w-8 bg-[#ff7a00]" aria-hidden="true"></span><?= e($slide['kicker']) ?>
          </p>
          <h1 data-testid="hero-slide-title-<?= $i ?>" class="hero-title max-w-4xl text-[9.5vw] leading-[1.02] sm:text-[2.8rem] md:text-[3.4rem] lg:text-[4.1rem] xl:text-[4.5rem]" style="font-weight:800">
            <span class="block text-[#ff7a00]" data-testid="hero-slide-accent-title-<?= $i ?>"><?= e($slide['accentTitle']) ?></span>
            <span class="block text-white" data-testid="hero-slide-main-title-<?= $i ?>"><?= e($slide['title']) ?></span>
          </h1>
          <p class="mt-5 max-w-2xl text-sm leading-relaxed text-white sm:text-base md:text-lg" data-testid="hero-slide-description-<?= $i ?>"><?= e($slide['description']) ?></p>
          <div class="mt-7 flex flex-wrap items-center gap-3 sm:gap-4">
            <a href="<?= e($target) ?>" data-testid="hero-slide-cta-<?= $i ?>" class="group inline-flex items-center gap-3 rounded-full bg-[#ff7a00] px-7 py-3.5 text-sm font-bold tracking-wide text-white shadow-[0_10px_28px_rgba(255,122,0,0.24)] transition-[background-color,box-shadow,transform] duration-300 hover:-translate-y-0.5 hover:bg-[#f06800] hover:shadow-[0_14px_34px_rgba(255,122,0,0.32)]">
              <?= e($slide['cta']) ?> <?= icon('arrow-right', 18, 'transition-transform group-hover:translate-x-1') ?>
            </a>
            <a href="<?= e($sTarget) ?>" data-testid="hero-slide-secondary-cta-<?= $i ?>" class="inline-flex items-center gap-3 rounded-full border border-white/35 bg-white/5 px-7 py-3.5 text-sm font-semibold tracking-wide text-white backdrop-blur-sm transition-[background-color,border-color,transform] duration-300 hover:-translate-y-0.5 hover:border-white/60 hover:bg-white/12"><?= e($slide['secondaryCta']) ?></a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="absolute bottom-10 right-6 lg:right-10 z-20 flex items-center gap-4" data-testid="hero-slide-indicators">
      <span class="font-display text-white/60 text-sm" data-hero-index>01</span>
      <div class="flex gap-2">
        <?php foreach ($HERO as $i => $_): ?>
          <button type="button" data-hero-dot="<?= $i ?>" data-testid="hero-slide-indicator-<?= $i ?>" class="h-[3px] transition-all duration-500 <?= $i === 0 ? 'w-10 bg-[#ff7a00]' : 'w-5 bg-white/30' ?>" aria-label="Slide <?= $i + 1 ?>"></button>
        <?php endforeach; ?>
      </div>
      <span class="font-display text-white/40 text-sm"><?= str_pad((string)count($HERO), 2, '0', STR_PAD_LEFT) ?></span>
    </div>

    <a href="#about" data-testid="hero-scroll-button" class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 text-white/50 hover:text-white transition-colors animate-bounce hidden md:block" aria-label="Scroll down"><?= icon('chevron-down', 26) ?></a>
  </section>
<?php }

function sec_about() { global $ABOUT, $IMAGES; ?>
  <section id="about" class="relative bg-white py-24 lg:py-32 overflow-hidden" data-testid="home-about-section">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
      <div class="grid lg:grid-cols-2 gap-14 lg:gap-20 items-center">
        <div class="reveal relative">
          <div class="img-zoom rounded-sm overflow-hidden shadow-2xl">
            <img src="<?= e($IMAGES['about']) ?>" alt="MME engineers on site" class="w-full h-[420px] lg:h-[540px] object-cover" />
          </div>
          <div class="img-zoom hidden sm:block absolute -bottom-10 -right-6 w-52 h-52 lg:w-64 lg:h-64 rounded-sm overflow-hidden border-8 border-white shadow-2xl">
            <img src="<?= e($IMAGES['aboutSecondary']) ?>" alt="Cement plant" class="w-full h-full object-cover" />
          </div>
          <div class="absolute -top-6 -left-6 bg-[#0a1a2f] text-white px-7 py-5 rounded-sm shadow-xl hidden sm:block">
            <p class="font-display text-4xl text-[#c8a25c]" style="font-weight:800">2019</p>
            <p class="text-xs tracking-widest uppercase text-white/60 mt-1">Established</p>
          </div>
        </div>
        <div class="reveal reveal-delay-1">
          <p class="kicker text-[#c8a25c] mb-5" data-testid="home-about-kicker"><?= e($ABOUT['kicker']) ?></p>
          <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-5xl leading-[1.08] mb-8" style="font-weight:800;letter-spacing:-0.02em" data-testid="home-about-heading"><?= e($ABOUT['heading']) ?></h2>
          <p class="border-l-2 border-[#c8a25c] pl-5 text-[15px] md:text-base leading-relaxed text-gray-700" data-testid="home-about-lead"><?= e($ABOUT['lead']) ?></p>
          <div class="mt-7 grid sm:grid-cols-2 gap-3.5" data-testid="home-about-highlights">
            <?php foreach ($ABOUT['highlights'] as $i => $item): ?>
              <article class="rounded-sm border border-[#0a1a2f]/10 bg-[#f5f4f1] p-5" data-testid="home-about-highlight-<?= $i ?>">
                <h3 class="font-display text-sm font-bold text-[#0a1a2f]"><?= e($item['title']) ?></h3>
                <p class="mt-2 text-[13px] leading-relaxed text-gray-600"><?= e($item['text']) ?></p>
              </article>
            <?php endforeach; ?>
          </div>
          <div class="mt-4 rounded-sm bg-[#0a1a2f] px-5 py-4" data-testid="home-about-commitment">
            <p class="text-[13px] md:text-sm leading-relaxed text-white"><?= e($ABOUT['commitment']) ?></p>
          </div>
          <a href="/services" class="group mt-4 inline-flex items-center gap-3 text-[#0a1a2f] font-semibold text-sm tracking-wide">
            <span class="link-underline">Explore our expertise</span>
            <?= icon('arrow-right', 18, 'text-[#c8a25c] group-hover:translate-x-1 transition-transform') ?>
          </a>
        </div>
      </div>
    </div>
  </section>
<?php }

function sec_stats() { global $STATS; ?>
  <section class="relative bg-[#0a1a2f] py-20 lg:py-28" data-stats>
    <div class="absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(circle at 1px 1px, #fff 1px, transparent 0);background-size:38px 38px"></div>
    <div class="relative max-w-[1400px] mx-auto px-6 lg:px-10">
      <p class="kicker text-[#c8a25c] text-center mb-14">Our Strength in Numbers</p>
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-12 divide-x-0 lg:divide-x lg:divide-white/10">
        <?php foreach ($STATS as $s): ?>
          <div class="text-center px-4">
            <p class="font-display text-white text-5xl md:text-6xl lg:text-7xl" style="font-weight:800;letter-spacing:-0.02em">
              <span data-counter data-target="<?= (int)$s['value'] ?>" data-year="<?= !empty($s['isYear']) ? '1' : '0' ?>">0</span><span class="text-[#c8a25c]"><?= e($s['suffix']) ?></span>
            </p>
            <p class="mt-3 text-white/55 text-xs md:text-sm tracking-widest uppercase"><?= e($s['label']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php }

function sec_expertise_strip() { global $EXPERTISE, $IMAGES; ?>
  <section class="bg-[#0a1a2f]">
    <div class="grid md:grid-cols-3">
      <?php foreach ($EXPERTISE as $i => $ex): ?>
        <div class="group relative h-[300px] md:h-[420px] overflow-hidden cursor-default">
          <div class="img-zoom absolute inset-0">
            <img src="<?= e($IMAGES['expertise'][$i]) ?>" alt="<?= e($ex['title']) ?>" class="w-full h-full object-cover" />
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-[#0a1a2f]/95 via-[#0a1a2f]/30 to-transparent group-hover:from-[#0a1a2f] transition-all duration-500"></div>
          <div class="absolute inset-0 flex flex-col justify-end p-8">
            <span class="font-display text-[#c8a25c] text-sm mb-2"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
            <h3 class="font-display text-white text-2xl lg:text-3xl" style="font-weight:700"><?= e($ex['title']) ?></h3>
            <p class="text-white/70 text-sm leading-relaxed mt-3 max-w-sm opacity-0 translate-y-3 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500"><?= e($ex['desc']) ?></p>
          </div>
          <?php if ($i < count($EXPERTISE) - 1): ?>
            <div class="hidden md:block absolute right-0 top-1/4 bottom-1/4 w-px bg-white/10"></div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
<?php }

function sec_services() { global $SERVICES; ?>
  <section id="services" class="bg-[#f5f4f1] py-24 lg:py-32">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
      <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-end mb-16">
        <div class="reveal">
          <p class="kicker text-[#c8a25c] mb-5">Our Services</p>
          <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-5xl leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">
            <span class="accent-bar"></span>Decades of dedication,<br class="hidden md:block" /> a lifetime of excellence
          </h2>
        </div>
        <p class="reveal reveal-delay-1 text-gray-600 leading-relaxed text-[15px] md:text-base max-w-xl">We deliver complete engineering solutions across India's core industries — from cement and power to steel, chemical and balance-of-plant. Each mandate is executed with precision, discipline and an uncompromising commitment to quality.</p>
      </div>
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($SERVICES as $i => $s): ?>
          <a href="/services/<?= e($s['id']) ?>" class="reveal reveal-delay-<?= ($i % 3) + 1 ?> group relative text-left rounded-sm overflow-hidden bg-[#0a1a2f] min-h-[380px] flex <?= $i === 0 ? 'lg:row-span-2 lg:min-h-[600px]' : '' ?>">
            <div class="img-zoom absolute inset-0">
              <img src="<?= e($s['image']) ?>" alt="<?= e($s['title']) ?>" class="w-full h-full object-cover opacity-70 group-hover:opacity-55 transition-opacity" />
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a1a2f] via-[#0a1a2f]/50 to-transparent"></div>
            <div class="relative z-10 mt-auto p-7 lg:p-8 w-full">
              <div class="flex items-start justify-between gap-4">
                <h3 class="font-display text-white text-2xl lg:text-[28px] leading-tight" style="font-weight:700"><?= e($s['title']) ?></h3>
                <span class="shrink-0 w-11 h-11 rounded-full border border-white/25 grid place-items-center text-white group-hover:bg-[#c8a25c] group-hover:border-[#c8a25c] group-hover:text-[#0a1a2f] transition-all"><?= icon('arrow-up-right', 18) ?></span>
              </div>
              <p class="mt-4 text-white/70 text-sm leading-relaxed max-w-md opacity-0 max-h-0 group-hover:opacity-100 group-hover:max-h-40 transition-all duration-500 overflow-hidden"><?= e($s['desc']) ?></p>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php }

function sec_industries() { global $INDUSTRIES; ?>
  <section id="industries" class="bg-white py-24 lg:py-32">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
      <div class="max-w-3xl mb-16 reveal">
        <p class="kicker text-[#c8a25c] mb-5">Industries We Serve</p>
        <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-5xl leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">Innovation has no limits</h2>
        <p class="mt-6 text-gray-600 leading-relaxed text-[15px] md:text-base">Our expertise spans a wide spectrum of India's heavy industry, integrating quality engineering with disciplined execution to deliver results that meet — and exceed — the highest standards.</p>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 border-t border-l border-gray-200">
        <?php foreach ($INDUSTRIES as $i => $ind): ?>
          <div class="reveal reveal-delay-<?= ($i % 3) + 1 ?> group relative p-9 lg:p-10 border-b border-r border-gray-200 hover:bg-[#0a1a2f] transition-colors duration-500">
            <div class="w-14 h-14 rounded-full bg-[#0a1a2f]/5 group-hover:bg-[#c8a25c] grid place-items-center mb-7 transition-colors duration-500">
              <?= icon($ind['icon'], 24, 'text-[#0a1a2f] group-hover:text-[#0a1a2f] transition-colors', ['stroke-width' => '1.6']) ?>
            </div>
            <h3 class="font-display text-xl lg:text-2xl text-[#0a1a2f] group-hover:text-white transition-colors mb-3" style="font-weight:700"><?= e($ind['name']) ?></h3>
            <p class="text-sm leading-relaxed text-gray-500 group-hover:text-white/70 transition-colors"><?= e($ind['desc']) ?></p>
            <span class="absolute top-9 right-9 font-display text-sm text-gray-300 group-hover:text-[#c8a25c] transition-colors"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php }

function sec_projects($preview = false) { global $PROJECTS, $PROJECT_FILTERS; ?>
  <section id="projects" class="bg-[#0a1a2f] py-24 lg:py-32" data-testid="<?= $preview ? 'home-projects-section' : 'projects-page-grid' ?>">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
      <div class="grid lg:grid-cols-2 gap-8 items-end mb-12">
        <div class="reveal">
          <p class="kicker text-[#c8a25c] mb-5">Our Projects</p>
          <h2 class="font-display text-white text-3xl md:text-4xl lg:text-5xl leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">Crafting the future,<br class="hidden md:block" /> across India</h2>
        </div>
        <p class="reveal reveal-delay-1 text-white/60 leading-relaxed text-[15px] md:text-base max-w-xl">A portfolio built on trust and delivery — spanning marquee cement, power, steel and oil &amp; gas mandates for India's most respected industrial names.</p>
      </div>
      <?php if (!$preview): ?>
        <div class="reveal flex flex-wrap gap-2 mb-10" data-project-filters>
          <?php foreach ($PROJECT_FILTERS as $j => $f):
            $slug = str_replace('&', 'and', str_replace(' ', '-', strtolower($f))); ?>
            <button type="button" data-filter="<?= e($f) ?>" data-testid="project-filter-<?= e($slug) ?>" class="px-5 py-2.5 rounded-full text-sm font-medium tracking-wide transition-all <?= $j === 0 ? 'bg-[#c8a25c] text-[#0a1a2f]' : 'bg-white/5 text-white/70 hover:bg-white/10 hover:text-white border border-white/10' ?>"><?= e($f) ?></button>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" data-project-grid>
        <?php
        $list = $preview ? array_slice($PROJECTS, 0, 6) : $PROJECTS;
        foreach ($list as $i => $p):
          $listingStatus = $p['listingStatus'] ?? $p['status']; ?>
          <article class="group relative rounded-sm overflow-hidden bg-[#0d2240] border border-white/5" data-testid="project-card-<?= $i ?>" data-type="<?= e($p['type']) ?>" data-status="<?= e($p['status']) ?>" data-listing="<?= e($listingStatus) ?>">
            <div class="img-zoom relative h-60 overflow-hidden">
              <img src="<?= e($p['image']) ?>" alt="<?= e($p['name']) ?>" class="w-full h-full object-cover" />
              <div class="absolute inset-0 bg-gradient-to-t from-[#0d2240] via-transparent to-transparent"></div>
              <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[11px] font-semibold tracking-wide <?= $p['status'] === 'Ongoing' ? 'bg-[#c8a25c] text-[#0a1a2f]' : 'bg-white/90 text-[#0a1a2f]' ?>" data-testid="project-status-<?= $i ?>"><?= e($p['statusLabel'] ?? $p['status']) ?></span>
              <span class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/10 backdrop-blur grid place-items-center text-white opacity-0 group-hover:opacity-100 transition-opacity"><?= icon('arrow-up-right', 16) ?></span>
            </div>
            <div class="p-6">
              <span class="text-[11px] uppercase tracking-widest text-[#c8a25c]"><?= e($p['type']) ?></span>
              <h3 class="font-display text-white text-lg leading-snug mt-2 mb-4" style="font-weight:700" data-testid="project-name-<?= $i ?>"><?= e($p['name']) ?></h3>
              <div class="space-y-2 text-sm text-white/60">
                <p class="flex items-center gap-2" data-testid="project-client-<?= $i ?>"><?= icon('building-2', 14, 'text-[#c8a25c]') ?> <?= e($p['client']) ?></p>
                <p class="flex items-center gap-2" data-testid="project-location-<?= $i ?>"><?= icon('map-pin', 14, 'text-[#c8a25c]') ?> <?= e($p['location']) ?></p>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
      <?php if ($preview): ?>
        <div class="reveal mt-12 text-center">
          <a href="/projects" class="group inline-flex items-center gap-3 bg-[#c8a25c] hover:bg-[#d9b877] text-[#0a1a2f] font-semibold text-sm tracking-wide px-8 py-4 rounded-full transition-colors" data-testid="home-projects-view-all-link">View all projects <?= icon('arrow-right', 18, 'group-hover:translate-x-1 transition-transform') ?></a>
        </div>
      <?php endif; ?>
    </div>
  </section>
<?php }

function sec_why() { global $WHY, $IMAGES; ?>
  <section class="bg-white py-24 lg:py-32">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
      <div class="grid lg:grid-cols-12 gap-14 lg:gap-16 items-center">
        <div class="lg:col-span-5 reveal">
          <div class="img-zoom rounded-sm overflow-hidden shadow-2xl relative">
            <img src="<?= e($IMAGES['whyMme']) ?>" alt="MME safety engineer" class="w-full h-[380px] lg:h-[560px] object-cover" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a1a2f]/40 to-transparent"></div>
          </div>
        </div>
        <div class="lg:col-span-7">
          <div class="reveal mb-12">
            <p class="kicker text-[#c8a25c] mb-5"><?= e($WHY['kicker']) ?></p>
            <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-5xl leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em"><?= e($WHY['heading']) ?></h2>
          </div>
          <div class="grid sm:grid-cols-2 gap-x-10 gap-y-8">
            <?php foreach ($WHY['points'] as $i => $pt): ?>
              <div class="reveal reveal-delay-<?= ($i % 2) + 1 ?> flex gap-4">
                <span class="shrink-0 w-10 h-10 rounded-full bg-[#0a1a2f] grid place-items-center"><?= icon('check', 18, 'text-[#c8a25c]', ['stroke-width' => '2.5']) ?></span>
                <div>
                  <h3 class="font-display text-lg text-[#0a1a2f] mb-1.5" style="font-weight:700"><?= e($pt['title']) ?></h3>
                  <p class="text-sm leading-relaxed text-gray-500"><?= e($pt['desc']) ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php }

function sec_director() { global $DIRECTOR; ?>
  <section class="relative bg-[#0d2240] py-24 lg:py-32 overflow-hidden">
    <div class="absolute top-0 right-0 w-1/2 h-full opacity-[0.05]" style="background-image:radial-gradient(circle at 1px 1px, #fff 1px, transparent 0);background-size:34px 34px"></div>
    <div class="relative max-w-[1400px] mx-auto px-6 lg:px-10">
      <div class="grid lg:grid-cols-12 gap-14 items-center">
        <div class="lg:col-span-4 reveal">
          <div class="relative max-w-xs mx-auto lg:mx-0">
            <div class="img-zoom rounded-sm overflow-hidden">
              <img src="<?= e($DIRECTOR['image']) ?>" alt="<?= e($DIRECTOR['name']) ?>" class="w-full h-[440px] object-cover" />
            </div>
            <div class="absolute -bottom-5 left-1/2 lg:left-6 -translate-x-1/2 lg:translate-x-0 bg-[#c8a25c] text-[#0a1a2f] px-6 py-3 rounded-sm shadow-xl whitespace-nowrap">
              <p class="font-display text-lg leading-tight" style="font-weight:800"><?= e($DIRECTOR['name']) ?></p>
              <p class="text-xs"><?= e($DIRECTOR['role']) ?></p>
            </div>
          </div>
        </div>
        <div class="lg:col-span-8 reveal reveal-delay-1">
          <p class="kicker text-[#c8a25c] mb-6"><?= e($DIRECTOR['kicker']) ?></p>
          <?= icon('quote', 46, 'text-[#c8a25c]/30 mb-4') ?>
          <p class="font-display text-white text-xl md:text-2xl lg:text-[2rem] leading-[1.5]" style="font-weight:500;letter-spacing:-0.01em"><?= e($DIRECTOR['quote']) ?></p>
        </div>
      </div>
    </div>
  </section>
<?php }

function sec_clients() { global $CLIENTS; ?>
  <section id="clients" class="bg-[#f5f4f1] py-24 lg:py-28 overflow-hidden">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-10 mb-14">
      <div class="text-center max-w-2xl mx-auto reveal">
        <p class="kicker text-[#c8a25c] mb-5">Our Prestigious Clients</p>
        <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-5xl leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">Trusted by India's industry leaders</h2>
        <p class="mt-6 text-gray-600 text-[15px] md:text-base leading-relaxed">We are proud to have partnered with some of the most respected names in cement, steel, power and infrastructure.</p>
      </div>
    </div>
    <div class="marquee-wrap relative">
      <div class="marquee-track">
        <?php foreach (array_merge($CLIENTS, $CLIENTS) as $c): ?>
          <div class="mx-5 shrink-0 h-24 w-44 bg-white rounded-sm border border-gray-100 shadow-sm grid place-items-center px-6 grayscale hover:grayscale-0 transition-all duration-500">
            <img src="<?= e($c['logo']) ?>" alt="<?= e($c['name']) ?>" class="max-h-14 max-w-full object-contain" onerror="this.style.display='none';this.parentElement.innerHTML='<span class=&quot;font-display text-[#0a1a2f] text-center text-sm font-bold&quot;><?= e($c['name']) ?></span>'" />
          </div>
        <?php endforeach; ?>
      </div>
      <div class="pointer-events-none absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-[#f5f4f1] to-transparent"></div>
      <div class="pointer-events-none absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-[#f5f4f1] to-transparent"></div>
    </div>
  </section>
<?php }

function sec_cta() { ?>
  <section class="relative py-28 lg:py-36 overflow-hidden">
    <div class="absolute inset-0">
      <img src="<?= e($GLOBALS['IMAGES']['ctaBg']) ?>" alt="steel structure" class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-gradient-to-r from-[#0a1a2f] via-[#0a1a2f]/85 to-[#0a1a2f]/60"></div>
    </div>
    <div class="relative max-w-[1400px] mx-auto px-6 lg:px-10 text-center">
      <p class="kicker text-[#c8a25c] mb-6 reveal">Let's Build Together</p>
      <h2 class="reveal font-display text-white text-3xl md:text-5xl lg:text-6xl leading-[1.02] max-w-4xl mx-auto" style="font-weight:800;letter-spacing:-0.02em">Have a project in mind? Let's engineer it to perfection.</h2>
      <a href="/contact" class="reveal reveal-delay-1 group mt-10 inline-flex items-center gap-3 bg-[#c8a25c] hover:bg-[#d9b877] text-[#0a1a2f] font-semibold text-sm tracking-wide px-9 py-4 rounded-full transition-colors">Get in touch <?= icon('arrow-right', 18, 'group-hover:translate-x-1 transition-transform') ?></a>
    </div>
  </section>
<?php }

function sec_gallery() { global $GALLERY; ?>
  <section id="gallery" class="bg-white py-24 lg:py-32">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
      <div class="max-w-2xl mb-14 reveal">
        <p class="kicker text-[#c8a25c] mb-5">Our Gallery</p>
        <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-5xl leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em">A closer look at our work</h2>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 auto-rows-[180px] md:auto-rows-[240px]" data-gallery>
        <?php foreach ($GALLERY as $i => $src): ?>
          <button type="button" data-gallery-item="<?= $i ?>" data-src="<?= e($src) ?>" class="reveal group relative rounded-sm overflow-hidden img-zoom <?= ($i === 0 || $i === 5) ? 'col-span-2 row-span-1' : '' ?>">
            <img src="<?= e($src) ?>" alt="MME project <?= $i + 1 ?>" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-[#0a1a2f]/0 group-hover:bg-[#0a1a2f]/30 transition-colors"></div>
          </button>
        <?php endforeach; ?>
      </div>
    </div>
    <div id="gallery-lightbox" class="fixed inset-0 z-[70] bg-black/90 flex items-center justify-center p-4 hidden">
      <button type="button" data-gallery-close class="absolute top-6 right-6 text-white/80 hover:text-white"><?= icon('x', 30) ?></button>
      <button type="button" data-gallery-prev class="absolute left-4 md:left-10 text-white/70 hover:text-[#c8a25c] p-2"><?= icon('chevron-left', 40) ?></button>
      <img data-gallery-image src="" alt="enlarged" class="max-h-[85vh] max-w-[90vw] object-contain rounded-sm" />
      <button type="button" data-gallery-next class="absolute right-4 md:right-10 text-white/70 hover:text-[#c8a25c] p-2"><?= icon('chevron-right', 40) ?></button>
    </div>
  </section>
<?php }

function sec_certifications() { global $CERTIFICATES; ?>
  <section class="bg-white py-24 lg:py-32" data-testid="certifications-section">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
      <div class="max-w-2xl mb-14 reveal">
        <p class="kicker text-[#c8a25c] mb-5">Our Achievements</p>
        <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-5xl leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em" data-testid="certifications-heading">Certifications &amp; recognitions</h2>
        <p class="mt-6 text-gray-600 text-[15px] md:text-base leading-relaxed">Our commitment to quality and safety is reflected in the certifications and completion recognitions awarded by our esteemed clients.</p>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5" data-certs>
        <?php foreach ($CERTIFICATES as $i => $c): ?>
          <button type="button" data-cert-item data-src="<?= e($c['img']) ?>" data-testid="certificate-card-<?= $i ?>" class="reveal group relative bg-[#f5f4f1] rounded-sm overflow-hidden border border-gray-100 aspect-[3/4]">
            <img src="<?= e($c['img']) ?>" alt="<?= e($c['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
            <div class="absolute inset-0 bg-[#0a1a2f]/0 group-hover:bg-[#0a1a2f]/20 transition-colors"></div>
            <span class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-[#0a1a2f] to-transparent p-3 pt-8">
              <span class="flex items-center gap-2 text-white text-xs font-medium"><?= icon('award', 14, 'text-[#c8a25c]') ?> <?= e($c['title']) ?></span>
            </span>
          </button>
        <?php endforeach; ?>
      </div>
    </div>
    <div id="cert-lightbox" class="fixed inset-0 z-[70] bg-black/90 flex items-center justify-center p-4 hidden" data-testid="certificate-modal">
      <button type="button" data-cert-close class="absolute top-6 right-6 text-white/80 hover:text-white" aria-label="Close certificate" data-testid="certificate-modal-close"><?= icon('x', 30) ?></button>
      <img data-cert-image src="" alt="certificate" class="max-h-[85vh] max-w-[90vw] object-contain rounded-sm bg-white" data-testid="certificate-modal-image" />
    </div>
  </section>
<?php }
