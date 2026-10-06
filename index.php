<?php
$page_title = 'MME Private Limited | Civil & Mechanical Engineering';
$page_description = 'MME Private Limited — ISO 9001:2015 certified civil, mechanical & electrical engineering and construction across India since 2019.';
$page_canonical = '/';
require __DIR__ . '/includes/header.php';

sec_hero();
sec_about();
sec_stats();
sec_expertise_strip();
sec_services();
sec_industries();
sec_projects(true);
sec_why();
sec_director();
sec_clients();
sec_cta();

require __DIR__ . '/includes/footer.php';
