<?php
$page_title = 'Industries | Innovation Has No Limits | MME Private Limited';
$page_description = "Our expertise spans a wide spectrum of India's heavy industry, integrating quality engineering with disciplined execution.";
$page_canonical = '/industries';
$page_og_image = $IMAGES['serviceChemical'] ?? null;
require __DIR__ . '/includes/header.php';

page_hero('Industries We Serve', 'Innovation has no limits',
  "Our expertise spans a wide spectrum of India's heavy industry, integrating quality engineering with disciplined execution.",
  $IMAGES['serviceChemical'], [['label' => 'Industries']]);
sec_industries();
sec_expertise_strip();
sec_cta();
require __DIR__ . '/includes/footer.php';
