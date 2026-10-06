<?php
$page_title = 'Services | Complete Engineering Solutions | MME Private Limited';
$page_description = 'From cement and power to steel, chemical and balance-of-plant — every mandate delivered with precision, discipline and uncompromising quality.';
$page_canonical = '/services';
$page_og_image = $IMAGES['serviceCement'] ?? null;
require __DIR__ . '/includes/header.php';

page_hero('What We Do', 'Complete engineering solutions',
  'From cement and power to steel, chemical and balance-of-plant — every mandate delivered with precision, discipline and uncompromising quality.',
  $IMAGES['serviceCement'], [['label' => 'Services']]);
sec_services();
sec_expertise_strip();
sec_cta();
require __DIR__ . '/includes/footer.php';
