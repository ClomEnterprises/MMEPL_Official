<?php
$page_title = 'Projects | Our Portfolio Across India | MME Private Limited';
$page_description = "A portfolio built on trust and delivery — spanning marquee cement, power, steel and oil & gas mandates for India's most respected industrial names.";
$page_canonical = '/projects';
$page_og_image = $IMAGES['expertise'][0] ?? null;
require __DIR__ . '/includes/header.php';

page_hero('Our Portfolio', 'Crafting the future, across India',
  "A portfolio built on trust and delivery — spanning marquee cement, power, steel and oil & gas mandates for India's most respected industrial names.",
  $IMAGES['expertise'][0], [['label' => 'Projects']]);
sec_projects(false);
sec_cta();
require __DIR__ . '/includes/footer.php';
