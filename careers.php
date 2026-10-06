<?php
$page_title = 'Careers | Your Next Opportunity Starts Here | MME Private Limited';
$page_description = 'We continuously seek passionate engineers and skilled professionals to join a culture of growth, collaboration and excellence.';
$page_canonical = '/careers';
$page_og_image = $IMAGES['careers'] ?? null;
require __DIR__ . '/includes/header.php';

page_hero('Careers at MME', 'Your next opportunity starts here',
  'We continuously seek passionate engineers and skilled professionals to join a culture of growth, collaboration and excellence.',
  $IMAGES['careers'], [['label' => 'Careers']]);

$openCount = count(array_filter($JOB_OPENINGS, fn($j) => ($j['status'] ?? '') === 'open'));
?>
<section id="openings" class="bg-white py-24 lg:py-32" data-testid="job-openings-section">
  <div class="max-w-[1400px] mx-auto px-6 lg:px-10">
    <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-end mb-16">
      <div class="reveal">
        <p class="kicker text-[#c8a25c] mb-5">Current Openings</p>
        <h2 class="font-display text-[#0a1a2f] text-3xl md:text-4xl lg:text-5xl leading-[1.05]" style="font-weight:800;letter-spacing:-0.02em"><span class="accent-bar"></span>Roles we're hiring for</h2>
      </div>
      <p class="reveal reveal-delay-1 text-gray-600 leading-relaxed text-[15px] md:text-base max-w-xl" data-testid="openings-count">
        <?php if ($openCount > 0): ?>We currently have <span class="font-semibold text-[#0a1a2f]"><?= $openCount ?></span> open <?= $openCount === 1 ? 'position' : 'positions' ?> across our project sites. Apply to an open role below, or send us your resume for future opportunities.<?php else: ?>There are no open positions right now. You're still welcome to submit your resume below and we'll reach out when a matching role opens.<?php endif; ?>
      </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" data-testid="openings-grid">
      <?php foreach ($JOB_OPENINGS as $i => $job): $isOpen = ($job['status'] ?? '') === 'open'; ?>
        <article data-testid="job-card-<?= $i ?>" class="reveal reveal-delay-<?= ($i % 3) + 1 ?> group flex flex-col rounded-sm border border-[#0a1a2f]/10 bg-[#f5f4f1] p-7 transition-[box-shadow,transform,border-color] duration-300 hover:-translate-y-1 hover:border-[#c8a25c]/50 hover:shadow-xl <?= $isOpen ? '' : 'opacity-80' ?>">
          <div class="flex items-start justify-between gap-3 mb-5">
            <span class="inline-block text-[11px] tracking-widest uppercase text-[#c8a25c] font-semibold"><?= e($job['department']) ?></span>
            <?php if ($isOpen): ?>
              <span class="inline-flex items-center gap-1.5 rounded-full bg-[#e8f3ec] px-3 py-1 text-[10px] font-semibold uppercase tracking-widest text-[#2e7d4f]" data-testid="job-status-<?= $i ?>"><span class="h-1.5 w-1.5 rounded-full bg-[#2e7d4f]"></span> Open</span>
            <?php else: ?>
              <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-200 px-3 py-1 text-[10px] font-semibold uppercase tracking-widest text-gray-500" data-testid="job-status-<?= $i ?>"><span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span> Closed</span>
            <?php endif; ?>
          </div>
          <h3 class="font-display text-[#0a1a2f] text-xl leading-snug mb-3" style="font-weight:800" data-testid="job-title-<?= $i ?>"><?= e($job['title']) ?></h3>
          <div class="flex flex-wrap gap-x-5 gap-y-2 text-sm text-gray-500 mb-4">
            <span class="inline-flex items-center gap-1.5"><?= icon('map-pin', 14, 'text-[#c8a25c]') ?> <?= e($job['location']) ?></span>
            <span class="inline-flex items-center gap-1.5"><?= icon('briefcase', 14, 'text-[#c8a25c]') ?> <?= e($job['type']) ?></span>
            <span class="inline-flex items-center gap-1.5"><?= icon('trending-up', 14, 'text-[#c8a25c]') ?> <?= e($job['experience']) ?></span>
          </div>
          <p class="text-[13px] leading-relaxed text-gray-600 mb-6"><?= e($job['description']) ?></p>
          <div class="mt-auto pt-2">
            <?php if ($isOpen): ?>
              <button type="button" data-apply-job data-role="<?= e($job['title']) ?>" data-testid="job-apply-<?= $i ?>" class="group/btn inline-flex items-center justify-center gap-2 rounded-sm bg-[#0a1a2f] px-6 py-3 text-xs font-bold uppercase tracking-[0.12em] text-white transition-colors hover:bg-[#c8a25c] hover:text-[#0a1a2f]">Apply <?= icon('arrow-right', 16, 'transition-transform group-hover/btn:translate-x-1') ?></button>
            <?php else: ?>
              <span data-testid="job-closed-<?= $i ?>" class="inline-flex cursor-not-allowed items-center justify-center gap-2 rounded-sm border border-gray-300 bg-white px-6 py-3 text-xs font-bold uppercase tracking-[0.12em] text-gray-400"><?= icon('lock', 14) ?> Closed</span>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php $inputClass = 'w-full rounded-sm border border-slate-200 bg-white px-4 py-3.5 text-[15px] text-[#0a1a2f] outline-none transition-[border-color,box-shadow] placeholder:text-slate-400 focus:border-[#c8a25c] focus:ring-4 focus:ring-[#c8a25c]/10';
?>
<section id="careers" class="relative overflow-hidden bg-[#f5f4f1] py-24 lg:py-32" data-testid="career-application-section">
  <div class="absolute inset-x-0 top-0 h-52 bg-[#0a1a2f]" aria-hidden="true"></div>
  <div class="relative mx-auto max-w-[1400px] px-6 lg:px-10">
    <div class="reveal mb-10 text-center text-white">
      <span class="kicker mb-5 inline-flex items-center justify-center gap-2 text-[#c8a25c]" data-testid="career-form-kicker"><?= icon('briefcase', 16) ?> Join Our Team</span>
      <h2 class="font-display text-2xl leading-[1.1] md:text-3xl lg:text-4xl" style="font-weight:800;letter-spacing:-0.02em" data-testid="career-form-heading">Career Application Form</h2>
      <p class="reveal reveal-delay-1 mx-auto mt-5 max-w-2xl text-sm leading-relaxed text-white/70 md:text-base" data-testid="career-form-intro">Bring your experience to an engineering team built on safety, discipline and delivery. Complete the form and attach your latest resume for HR review.</p>
    </div>

    <form action="/forms/career-submit.php" method="post" enctype="multipart/form-data" data-ajax-form data-form-key="career" class="reveal rounded-sm border border-slate-200 bg-white p-6 shadow-[0_24px_70px_rgba(10,26,47,0.12)] sm:p-8 lg:p-12" data-testid="career-application-form">
      <?= csrf_field('career') ?>
      <input name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true" data-testid="career-honeypot-input" />
      <div class="grid gap-x-5 gap-y-6 md:grid-cols-2">
        <label data-testid="career-field-role"><span class="mb-2 block text-sm font-semibold text-[#0a1a2f]">Role<span class="ml-1 text-red-600">*</span></span>
          <input name="role" required type="text" minlength="2" maxlength="120" placeholder="e.g. Site Mechanical Engineer" class="<?= $inputClass ?>" data-testid="career-role-input" /></label>
        <label data-testid="career-field-full-name"><span class="mb-2 block text-sm font-semibold text-[#0a1a2f]">Full Name<span class="ml-1 text-red-600">*</span></span>
          <input name="full_name" required minlength="2" maxlength="120" autocomplete="name" placeholder="Enter your full name" class="<?= $inputClass ?>" data-testid="career-full-name-input" /></label>
        <label data-testid="career-field-date-of-birth"><span class="mb-2 block text-sm font-semibold text-[#0a1a2f]">Date of Birth<span class="ml-1 text-red-600">*</span></span>
          <input name="date_of_birth" required type="date" class="<?= $inputClass ?>" data-testid="career-date-of-birth-input" /></label>
        <label data-testid="career-field-gender"><span class="mb-2 block text-sm font-semibold text-[#0a1a2f]">Gender<span class="ml-1 text-red-600">*</span></span>
          <select name="gender" required class="<?= $inputClass ?>" data-testid="career-gender-select">
            <option value="" disabled selected>Select gender</option>
            <option>Male</option><option>Female</option><option>Other</option><option>Prefer not to say</option>
          </select></label>
        <label data-testid="career-field-phone"><span class="mb-2 block text-sm font-semibold text-[#0a1a2f]">Phone Number<span class="ml-1 text-red-600">*</span></span>
          <input name="phone" required type="tel" minlength="7" maxlength="30" autocomplete="tel" placeholder="+91 XXXXX XXXXX" class="<?= $inputClass ?>" data-testid="career-phone-input" /></label>
        <label data-testid="career-field-email"><span class="mb-2 block text-sm font-semibold text-[#0a1a2f]">Email Address<span class="ml-1 text-red-600">*</span></span>
          <input name="email" required type="email" autocomplete="email" placeholder="Enter your email" class="<?= $inputClass ?>" data-testid="career-email-input" /></label>
        <label data-testid="career-field-qualification"><span class="mb-2 block text-sm font-semibold text-[#0a1a2f]">Highest Qualification<span class="ml-1 text-red-600">*</span></span>
          <input name="qualification" required minlength="2" maxlength="160" placeholder="e.g. B.Tech / Diploma" class="<?= $inputClass ?>" data-testid="career-qualification-input" /></label>
        <label data-testid="career-field-marital-status"><span class="mb-2 block text-sm font-semibold text-[#0a1a2f]">Marital Status</span>
          <select name="marital_status" class="<?= $inputClass ?>" data-testid="career-marital-status-select">
            <option value="" selected>Select marital status</option><option>Single</option><option>Married</option><option>Other</option>
          </select></label>
        <label class="md:col-span-2" data-testid="career-field-address"><span class="mb-2 block text-sm font-semibold text-[#0a1a2f]">Address / Current Location<span class="ml-1 text-red-600">*</span></span>
          <textarea name="address" required minlength="5" maxlength="1000" rows="3" placeholder="Enter your complete current address" class="<?= $inputClass ?> resize-y" data-testid="career-address-input"></textarea></label>
        <label data-testid="career-field-resume"><span class="mb-2 block text-sm font-semibold text-[#0a1a2f]">Upload Resume<span class="ml-1 text-red-600">*</span></span>
          <div class="rounded-sm border border-dashed border-slate-300 bg-slate-50 p-4 transition-colors focus-within:border-[#c8a25c]">
            <?= icon('file-text', 24, 'mb-3 text-[#c8a25c]') ?>
            <input name="resume" required type="file" accept=".pdf,.doc,.docx" class="block w-full text-sm text-slate-500 file:mr-3 file:rounded-sm file:border-0 file:bg-[#0a1a2f] file:px-4 file:py-2 file:text-xs file:font-semibold file:text-white" data-testid="career-resume-input" />
            <p class="mt-2 text-xs text-slate-500">PDF, DOC or DOCX · Maximum 5 MB</p>
          </div></label>
        <label data-testid="career-field-photo"><span class="mb-2 block text-sm font-semibold text-[#0a1a2f]">Upload Photo</span>
          <div class="rounded-sm border border-dashed border-slate-300 bg-slate-50 p-4 transition-colors focus-within:border-[#c8a25c]">
            <?= icon('image', 24, 'mb-3 text-[#c8a25c]') ?>
            <input name="photo" type="file" accept=".jpg,.jpeg,.png" class="block w-full text-sm text-slate-500 file:mr-3 file:rounded-sm file:border-0 file:bg-[#0a1a2f] file:px-4 file:py-2 file:text-xs file:font-semibold file:text-white" data-testid="career-photo-input" />
            <p class="mt-2 text-xs text-slate-500">JPG or PNG · Maximum 2 MB</p>
          </div></label>
      </div>

      <div class="mt-9 flex flex-col items-center">
        <button type="submit" class="group inline-flex min-w-[240px] items-center justify-center gap-3 rounded-sm bg-[#c8a25c] px-8 py-4 text-sm font-bold uppercase tracking-[0.12em] text-[#0a1a2f] shadow-lg transition-[background-color,transform] hover:-translate-y-0.5 hover:bg-[#d9b877] disabled:cursor-not-allowed disabled:opacity-60" data-testid="career-form-submit-button" data-submit-label="Submit Application" data-loading-label="Submitting…">
          <span data-btn-text>Submit Application</span> <?= icon('send', 18, 'transition-transform group-hover:translate-x-1') ?>
        </button>
        <p class="mt-4 text-center text-sm text-[#0a1a2f] hidden" role="status" aria-live="polite" data-testid="career-form-status" data-form-status></p>
        <p class="mt-3 text-center text-xs text-slate-500" data-testid="career-form-privacy">Your information is used only for recruitment by <?= e($COMPANY['shortName']) ?>.</p>
      </div>
    </form>
  </div>
</section>
<?php
sec_why();
require __DIR__ . '/includes/footer.php';
