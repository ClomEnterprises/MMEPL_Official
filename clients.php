<?php
$page_title = "Clients & Achievements | MME Private Limited";
$page_description = 'We are proud to have partnered with some of the most respected names in cement, steel, power and infrastructure.';
$page_canonical = '/clients';
$page_og_image = $IMAGES['expertise'][2] ?? null;
require __DIR__ . '/includes/header.php';

page_hero('Clients & Achievements', "Trusted by India's industry leaders",
  'We are proud to have partnered with some of the most respected names in cement, steel, power and infrastructure.',
  $IMAGES['expertise'][2], [['label' => 'Clients']]);
sec_clients();
sec_certifications();
sec_cta();
require __DIR__ . '/includes/footer.php';
