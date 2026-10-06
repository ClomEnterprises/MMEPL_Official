<?php
$page_title = 'Gallery | A Closer Look At Our Work | MME Private Limited';
$page_description = 'Moments from our sites across India — fabrication, erection, plant construction and mechanical works.';
$page_canonical = '/gallery';
$page_og_image = $IMAGES['expertise'][1] ?? null;
require __DIR__ . '/includes/header.php';

page_hero('Our Gallery', 'A closer look at our work',
  'Moments from our sites across India — fabrication, erection, plant construction and mechanical works.',
  $IMAGES['expertise'][1], [['label' => 'Gallery']]);
sec_gallery();
sec_cta();
require __DIR__ . '/includes/footer.php';
