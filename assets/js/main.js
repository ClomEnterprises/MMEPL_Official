/* =====================================================================
 *  MME Private Limited — site interactions (vanilla JS, no dependencies)
 * ===================================================================== */
(function () {
  "use strict";
  var $ = function (s, c) { return (c || document).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

  /* ---------- Toast ---------- */
  function toast(title, description, variant) {
    var host = $("#toast-host");
    if (!host) { return; }
    var el = document.createElement("div");
    var border = variant === "destructive" ? "border-red-500/40" : "border-[#c8a25c]/40";
    el.className = "pointer-events-auto w-full overflow-hidden rounded-md border " + border +
      " bg-[#0a1a2f] px-5 py-4 text-white shadow-2xl transition-all duration-300 translate-y-2 opacity-0";
    el.setAttribute("role", "status");
    el.innerHTML = '<p class="font-display text-sm font-bold">' + title + "</p>" +
      (description ? '<p class="mt-1 text-sm text-white/70">' + description + "</p>" : "");
    host.appendChild(el);
    requestAnimationFrame(function () { el.classList.remove("translate-y-2", "opacity-0"); });
    setTimeout(function () {
      el.classList.add("opacity-0", "translate-y-2");
      setTimeout(function () { el.remove(); }, 320);
    }, 5000);
  }

  /* ---------- Navbar scroll state ---------- */
  var header = $("#site-header");
  var scrolledCls = ["bg-[#0a1a2f]/95", "backdrop-blur-md", "py-3", "shadow-[0_10px_40px_rgba(0,0,0,0.25)]"];
  var topCls = ["bg-gradient-to-b", "from-[#0a1a2f]/80", "to-transparent", "py-5"];
  function onScroll() {
    if (!header) { return; }
    if (window.scrollY > 40) {
      topCls.forEach(function (c) { header.classList.remove(c); });
      scrolledCls.forEach(function (c) { header.classList.add(c); });
    } else {
      scrolledCls.forEach(function (c) { header.classList.remove(c); });
      topCls.forEach(function (c) { header.classList.add(c); });
    }
  }
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  /* ---------- Mobile menu ---------- */
  var mobile = $("#mobile-menu");
  function setMenu(open) {
    if (!mobile) { return; }
    mobile.classList.toggle("opacity-100", open);
    mobile.classList.toggle("pointer-events-auto", open);
    mobile.classList.toggle("opacity-0", !open);
    mobile.classList.toggle("pointer-events-none", !open);
    document.body.style.overflow = open ? "hidden" : "";
  }
  var openBtn = $("#mobile-menu-open"), closeBtn = $("#mobile-menu-close");
  if (openBtn) { openBtn.addEventListener("click", function () { setMenu(true); }); }
  if (closeBtn) { closeBtn.addEventListener("click", function () { setMenu(false); }); }
  $$("[data-mobile-submenu-toggle]").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var i = btn.getAttribute("data-mobile-submenu-toggle");
      var panel = $('[data-mobile-submenu="' + i + '"]');
      var plus = $("[data-plus]", btn), minus = $("[data-minus]", btn);
      var hidden = panel.classList.toggle("hidden");
      if (plus) { plus.classList.toggle("hidden", !hidden); }
      if (minus) { minus.classList.toggle("hidden", hidden); }
    });
  });

  /* ---------- Hero slider ---------- */
  var hero = $("[data-hero]");
  if (hero) {
    var slides = $$("[data-hero-slide]", hero);
    var contents = $$("[data-hero-content]", hero);
    var dots = $$("[data-hero-dot]", hero);
    var idxEl = $("[data-hero-index]", hero);
    var cur = 0, total = slides.length, timer;
    function show(n) {
      cur = (n + total) % total;
      slides.forEach(function (s, i) {
        s.classList.toggle("opacity-100", i === cur);
        s.classList.toggle("opacity-0", i !== cur);
        var img = $("[data-hero-img]", s);
        if (img) { img.classList.toggle("kenburns", i === cur); }
      });
      contents.forEach(function (c, i) {
        var on = i === cur;
        c.classList.toggle("opacity-100", on);
        c.classList.toggle("translate-y-0", on);
        c.classList.toggle("opacity-0", !on);
        c.classList.toggle("translate-y-6", !on);
        c.classList.toggle("pointer-events-none", !on);
      });
      dots.forEach(function (d, i) {
        d.classList.toggle("w-10", i === cur);
        d.classList.toggle("bg-[#ff7a00]", i === cur);
        d.classList.toggle("w-5", i !== cur);
        d.classList.toggle("bg-white/30", i !== cur);
      });
      if (idxEl) { idxEl.textContent = String(cur + 1).padStart(2, "0"); }
    }
    function play() { timer = setInterval(function () { show(cur + 1); }, 6000); }
    function reset() { clearInterval(timer); play(); }
    dots.forEach(function (d) {
      d.addEventListener("click", function () { show(parseInt(d.getAttribute("data-hero-dot"), 10)); reset(); });
    });
    play();
  }

  /* ---------- Reveal on scroll ---------- */
  function initReveal() {
    var els = $$(".reveal:not(.in-view)");
    if (!("IntersectionObserver" in window)) {
      els.forEach(function (el) { el.classList.add("in-view"); });
      return;
    }
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) { entry.target.classList.add("in-view"); obs.unobserve(entry.target); }
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -60px 0px" });
    els.forEach(function (el) { obs.observe(el); });
  }
  requestAnimationFrame(initReveal);

  /* ---------- Animated counters ---------- */
  var statsWrap = $("[data-stats]");
  if (statsWrap) {
    var ran = false;
    var run = function () {
      if (ran) { return; }
      ran = true;
      $$("[data-counter]", statsWrap).forEach(function (el) {
        var target = parseInt(el.getAttribute("data-target"), 10) || 0;
        var isYear = el.getAttribute("data-year") === "1";
        var start = null, dur = 1800;
        function step(ts) {
          if (!start) { start = ts; }
          var p = Math.min((ts - start) / dur, 1);
          var eased = 1 - Math.pow(1 - p, 3);
          var val = Math.floor(eased * target);
          el.textContent = isYear ? String(val) : val.toLocaleString("en-IN");
          if (p < 1) { requestAnimationFrame(step); } else { el.textContent = isYear ? String(target) : target.toLocaleString("en-IN"); }
        }
        requestAnimationFrame(step);
      });
    };
    var sObs = new IntersectionObserver(function (e) {
      if (e[0].isIntersecting) { run(); sObs.disconnect(); }
    }, { threshold: 0.35 });
    sObs.observe(statsWrap);
  }

  /* ---------- Project filters ---------- */
  var filterWrap = $("[data-project-filters]");
  if (filterWrap) {
    var grid = $("[data-project-grid]");
    var cards = $$("[data-testid^='project-card-']", grid);
    $$("[data-filter]", filterWrap).forEach(function (btn) {
      btn.addEventListener("click", function () {
        var f = btn.getAttribute("data-filter");
        $$("[data-filter]", filterWrap).forEach(function (b) {
          var on = b === btn;
          b.classList.toggle("bg-[#c8a25c]", on);
          b.classList.toggle("text-[#0a1a2f]", on);
          b.classList.toggle("bg-white/5", !on);
          b.classList.toggle("text-white/70", !on);
          b.classList.toggle("hover:bg-white/10", !on);
          b.classList.toggle("hover:text-white", !on);
          b.classList.toggle("border", !on);
          b.classList.toggle("border-white/10", !on);
        });
        cards.forEach(function (card) {
          var show;
          if (f === "All") { show = true; }
          else if (f === "Ongoing" || f === "Completed") { show = card.getAttribute("data-listing") === f; }
          else { show = card.getAttribute("data-type") === f; }
          card.style.display = show ? "" : "none";
        });
      });
    });
  }

  /* ---------- Generic lightbox (gallery + certificates) ---------- */
  function bindLightbox(cfg) {
    var box = $(cfg.box);
    if (!box) { return; }
    var imgEl = $(cfg.image, box);
    var items = $$(cfg.item);
    var srcs = items.map(function (it) { return it.getAttribute("data-src"); });
    var active = 0;
    function open(i) { active = i; imgEl.src = srcs[active]; box.classList.remove("hidden"); document.body.style.overflow = "hidden"; }
    function close() { box.classList.add("hidden"); document.body.style.overflow = ""; }
    items.forEach(function (it, i) { it.addEventListener("click", function () { open(i); }); });
    if (cfg.close) { $$(cfg.close, box).forEach(function (b) { b.addEventListener("click", close); }); }
    if (cfg.prev) { var p = $(cfg.prev, box); if (p) { p.addEventListener("click", function (e) { e.stopPropagation(); active = (active - 1 + srcs.length) % srcs.length; imgEl.src = srcs[active]; }); } }
    if (cfg.next) { var n = $(cfg.next, box); if (n) { n.addEventListener("click", function (e) { e.stopPropagation(); active = (active + 1) % srcs.length; imgEl.src = srcs[active]; }); } }
    box.addEventListener("click", function (e) { if (e.target === box) { close(); } });
    if (imgEl) { imgEl.addEventListener("click", function (e) { e.stopPropagation(); }); }
    document.addEventListener("keydown", function (e) { if (e.key === "Escape" && !box.classList.contains("hidden")) { close(); } });
  }
  bindLightbox({ box: "#gallery-lightbox", image: "[data-gallery-image]", item: "[data-gallery-item]", close: "[data-gallery-close]", prev: "[data-gallery-prev]", next: "[data-gallery-next]" });
  bindLightbox({ box: "#cert-lightbox", image: "[data-cert-image]", item: "[data-cert-item]", close: "[data-cert-close]" });

  /* ---------- Contact office selector ---------- */
  var offices = $("[data-offices]");
  if (offices) {
    var mapFrame = $("[data-office-map]");
    var dirLink = $("[data-office-directions]");
    var dirLabel = $("[data-office-dir-label]");
    var buttons = $$("[data-office]", offices);
    buttons.forEach(function (btn) {
      btn.addEventListener("click", function () {
        var q = btn.getAttribute("data-map");
        var label = btn.getAttribute("data-label");
        buttons.forEach(function (b) {
          var on = b === btn;
          b.classList.toggle("bg-[#c8a25c]", on);
          b.classList.toggle("border-[#c8a25c]", on);
          b.classList.toggle("bg-white/[0.04]", !on);
          b.classList.toggle("border-white/10", !on);
          b.classList.toggle("hover:border-[#c8a25c]/50", !on);
          var badge = $("[data-office-badge]", b);
          if (badge) { badge.classList.toggle("bg-[#0a1a2f]", on); badge.classList.toggle("bg-[#c8a25c]", !on); }
          var t = $("[data-office-title]", b); if (t) { t.classList.toggle("text-[#0a1a2f]", on); t.classList.toggle("text-white", !on); }
          var a = $("[data-office-addr]", b); if (a) { a.classList.toggle("text-[#0a1a2f]/80", on); a.classList.toggle("text-white/55", !on); }
          var c = $("[data-office-contact]", b); if (c) { c.classList.toggle("text-[#0a1a2f]", on); c.classList.toggle("text-white/70", !on); }
        });
        if (mapFrame) { mapFrame.src = "https://maps.google.com/maps?q=" + encodeURIComponent(q) + "&z=15&output=embed"; }
        if (dirLink) { dirLink.href = "https://www.google.com/maps/dir/?api=1&destination=" + encodeURIComponent(q); }
        if (dirLabel) { dirLabel.textContent = "Get directions to " + label; }
      });
    });
  }

  /* ---------- Revenue chart tooltip ---------- */
  var chart = $("[data-revenue-chart]");
  if (chart) {
    var tip = $("[data-revenue-tooltip]", chart);
    $$("[data-revenue-point]", chart).forEach(function (pt) {
      pt.addEventListener("mouseenter", function () {
        var proj = pt.getAttribute("data-projected") === "1";
        tip.innerHTML = '<p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#c8a25c]">Financial Year</p>' +
          '<p class="mt-1 font-display text-base font-bold">' + pt.getAttribute("data-year") + "</p>" +
          '<p class="mt-2 text-sm text-white/80">' + pt.getAttribute("data-amount") + "</p>" +
          (proj ? '<p class="mt-1 text-xs text-[#c8a25c]">Projected</p>' : "");
        var r = pt.getBoundingClientRect(), cr = chart.getBoundingClientRect();
        tip.classList.remove("hidden");
        tip.style.left = Math.min(Math.max(r.left - cr.left - 90, 0), cr.width - 200) + "px";
        tip.style.top = (r.top - cr.top - tip.offsetHeight - 12) + "px";
      });
      pt.addEventListener("mouseleave", function () { tip.classList.add("hidden"); });
    });
  }

  /* ---------- "Available soon" reports ---------- */
  $$("[data-report-soon]").forEach(function (btn) {
    btn.addEventListener("click", function () {
      toast(btn.getAttribute("data-label") + " report", "This annual report will be available for download shortly. Please check back soon.");
    });
  });

  /* ---------- Apply to a job opening (prefill role + scroll to form) ---------- */
  $$("[data-apply-job]").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var role = btn.getAttribute("data-role") || "";
      var roleInput = $('[data-testid="career-role-input"]');
      var formSection = document.getElementById("careers");
      if (roleInput) { roleInput.value = role; }
      if (formSection) {
        var y = formSection.getBoundingClientRect().top + window.pageYOffset - 74;
        window.scrollTo({ top: y, behavior: "smooth" });
        setTimeout(function () { if (roleInput) { roleInput.focus({ preventScroll: true }); } }, 600);
      }
    });
  });

  /* ---------- Back to top ---------- */
  var toTop = $("#back-to-top");
  if (toTop) { toTop.addEventListener("click", function () { window.scrollTo({ top: 0, behavior: "smooth" }); }); }

  /* ---------- AJAX forms ---------- */
  $$("[data-ajax-form]").forEach(function (form) {
    var btn = $("[type=submit]", form);
    var btnText = btn ? $("[data-btn-text]", btn) : null;
    var statusEl = $("[data-form-status]", form);
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      // Client-side file size guards for the career form (parity with original)
      var resume = form.querySelector('input[name="resume"]');
      var photo = form.querySelector('input[name="photo"]');
      if (resume && resume.files[0] && resume.files[0].size > 5 * 1024 * 1024) {
        return showStatus("Resume must be 5 MB or smaller.", true);
      }
      if (photo && photo.files[0] && photo.files[0].size > 2 * 1024 * 1024) {
        return showStatus("Photo must be 2 MB or smaller.", true);
      }

      var loading = btn ? btn.getAttribute("data-loading-label") : "Sending…";
      var normal = btn ? btn.getAttribute("data-submit-label") : "Send";
      if (btn) { btn.disabled = true; if (btnText) { btnText.textContent = loading; } }
      if (statusEl) { statusEl.classList.add("hidden"); }

      fetch(form.getAttribute("action"), { method: "POST", body: new FormData(form) })
        .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, d: d }; }); })
        .then(function (res) {
          if (res.ok && res.d.ok) {
            var isCareer = form.getAttribute("data-form-key") === "career";
            form.reset();
            showStatus(res.d.message, false);
            toast(isCareer ? "Application submitted successfully" : "Message sent successfully", res.d.message);
          } else {
            showStatus(res.d.message || "Something went wrong.", true);
            toast("Submission could not be completed", res.d.message || "Please try again.", "destructive");
          }
        })
        .catch(function () {
          showStatus("Network error. Please try again.", true);
          toast("Message not sent", "Please check your connection and try again.", "destructive");
        })
        .finally(function () {
          if (btn) { btn.disabled = false; if (btnText) { btnText.textContent = normal; } }
        });
    });
    function showStatus(msg, isErr) {
      if (!statusEl) { return; }
      statusEl.textContent = msg;
      statusEl.classList.remove("hidden");
      statusEl.classList.toggle("text-red-600", !!isErr);
      statusEl.classList.toggle("text-[#0a1a2f]", !isErr);
    }
  });

  /* ---------- Smooth anchor scroll (hero "scroll down") ---------- */
  $$('a[href^="#"]').forEach(function (a) {
    a.addEventListener("click", function (e) {
      var id = a.getAttribute("href").slice(1);
      if (!id) { return; }
      var el = document.getElementById(id);
      if (el) {
        e.preventDefault();
        var y = el.getBoundingClientRect().top + window.pageYOffset - 74;
        window.scrollTo({ top: y, behavior: "smooth" });
      }
    });
  });
})();
