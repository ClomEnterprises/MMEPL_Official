<?php
/**
 * =====================================================================
 *  MME Private Limited — CENTRAL SITE CONFIG & CONTENT
 *  Edit ANY text or image path here. Nothing else to touch.
 *  Images live in /assets/images. Change a file there to swap a picture.
 * =====================================================================
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ---------------------------------------------------------------------
 *  SITE / ENVIRONMENT
 * ------------------------------------------------------------------- */
// Absolute site URL (no trailing slash) — used for canonical + og tags + sitemap.
define('SITE_URL', 'https://www.mmepl.co.in');
// Where contact & career form submissions are emailed.
define('FORM_RECIPIENT', 'info@mmepl.co.in');

/* ---------------------------------------------------------------------
 *  HELPER FUNCTIONS
 * ------------------------------------------------------------------- */
/** Escape output for safe HTML. */
function e($str) {
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

/** Current request path without query string, no trailing slash (except root). */
function current_path() {
    $p = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $p = rtrim($p, '/');
    return $p === '' ? '/' : $p;
}

/** Active-link test mirroring the original React logic. */
function nav_is_active($to) {
    $path = current_path();
    if ($to === '/') return $path === '/';
    return strpos($path, $to) === 0;
}

/** CSRF token for a given form key. */
function csrf_token($key = 'default') {
    if (empty($_SESSION['csrf'][$key])) {
        $_SESSION['csrf'][$key] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'][$key];
}

/** Hidden CSRF input field markup. */
function csrf_field($key = 'default') {
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token($key)) . '">';
}

/** Verify a submitted CSRF token. */
function csrf_verify($key, $token) {
    return !empty($_SESSION['csrf'][$key]) && is_string($token)
        && hash_equals($_SESSION['csrf'][$key], $token);
}

/* ---------------------------------------------------------------------
 *  COMPANY
 * ------------------------------------------------------------------- */
$COMPANY = [
    'name'      => 'Mangal Murtey Enterprises',
    'shortName' => 'MME Private Limited',
    'legalName' => 'Mangal Murtey Enterprises Private Limited',
    'tagline'   => "Building India's Industrial Backbone",
    'established' => '2019',
    'email'     => 'info@mmepl.co.in',
    'phone'     => '+91-120-3664152',
    'phoneRaw'  => 'tel:+911203664152',
    'socials'   => ['facebook' => '', 'instagram' => '', 'linkedin' => '', 'youtube' => ''],
    'hours'     => 'Mon – Sat : 10 AM to 6 PM',
    'logo'      => '/assets/images/mmepl-logo.png',
    'offices'   => [
        [
            'label' => 'Head / Corporate Office',
            'type'  => 'Head Office',
            'address' => 'A-111 & 112, First Floor, A Block, Plot No-2, Shakti Khand-2, Indrapuram, Ghaziabad, Uttar Pradesh 201014',
            'phone' => '+91-120-3664152',
            'phoneRaw' => 'tel:+911203664152',
            'email' => 'info@mmepl.co.in',
            'map'   => 'A-111 Shakti Khand 2 Indrapuram Ghaziabad Uttar Pradesh 201014',
        ],
        [
            'label' => 'Registered Office',
            'type'  => 'Registered Office',
            'address' => 'Plot No-1-1/25 Kalp City, Bijnaur Road, Lucknow, Uttar Pradesh 226001',
            'phone' => '+91-120-3664152',
            'phoneRaw' => 'tel:+911203664152',
            'email' => 'info@mmepl.co.in',
            'map'   => 'Kalp City Bijnaur Road Lucknow Uttar Pradesh 226001',
        ],
        [
            'label' => 'Branch Office',
            'type'  => 'Branch Office',
            'address' => '2nd Floor, Holding No-15 Sakshi, Sitaramdera, Jamshedpur, Jharkhand 831001',
            'phone' => '+91-120-3664152',
            'phoneRaw' => 'tel:+911203664152',
            'email' => 'info@mmepl.co.in',
            'map'   => 'Sitaramdera Jamshedpur Jharkhand 831001',
        ],
    ],
];

/* ---------------------------------------------------------------------
 *  IMAGES
 * ------------------------------------------------------------------- */
$IMAGES = [
    'heroSlides' => ['/assets/images/site/hero-1.jpg', '/assets/images/site/hero-2.jpg', '/assets/images/site/hero-3.jpg'],
    'about' => '/assets/images/site/about-main.jpg',
    'aboutSecondary' => '/assets/images/site/about-secondary.jpg',
    'expertise' => ['/assets/images/site/expertise-1.jpg', '/assets/images/site/industrial-structure.jpg', '/assets/images/site/expertise-3.jpg'],
    'serviceCement' => '/assets/images/site/about-secondary.jpg',
    'servicePower' => '/assets/images/site/power-plant.jpg',
    'serviceChemical' => '/assets/images/site/chemical-plant.jpg',
    'serviceBalance' => '/assets/images/site/balance-plant.jpg',
    'serviceSteel' => '/assets/images/site/steel-plant.jpg',
    'whyMme' => '/assets/images/site/why-mme.jpg',
    'ctaBg' => '/assets/images/site/industrial-structure.jpg',
    'careers' => '/assets/images/site/careers.jpg',
    'director' => '/assets/images/pradeep.png',
    'hr' => '/assets/images/vandana.png',
    'boardHero' => '/assets/images/site/board-hero.jpg',
    'teamHero' => '/assets/images/site/team-hero.jpg',
    'missionVision' => '/assets/images/site/mission-vision.jpg',
    'annualHero' => '/assets/images/site/power-plant.jpg',
];

/* ---------------------------------------------------------------------
 *  HERO
 * ------------------------------------------------------------------- */
$HERO = [
    ['kicker' => 'Civil · Mechanical · Infrastructure', 'accentTitle' => 'Engineering the', 'title' => 'Foundations of Modern India', 'description' => "Integrated civil, structural and mechanical solutions for India's most demanding industrial projects.", 'cta' => 'View Projects', 'target' => 'projects', 'secondaryCta' => 'Get in Touch', 'secondaryTarget' => 'contact'],
    ['kicker' => 'Cement · Power · Steel', 'accentTitle' => 'Precision Execution', 'title' => 'Across Industrial Plants', 'description' => 'Specialist engineering teams delivering complex erection, fabrication and balance-of-plant works with control and clarity.', 'cta' => 'Our Expertise', 'target' => 'services', 'secondaryCta' => 'Our Clients', 'secondaryTarget' => 'clients'],
    ['kicker' => 'Discipline · Quality · Delivery', 'accentTitle' => 'Built on Commitment', 'title' => 'Delivered On Time', 'description' => 'A dependable project partner focused on safe execution, exacting quality and accountable delivery across India.', 'cta' => 'View Track Record', 'target' => 'projects', 'secondaryCta' => 'Contact Project Desk', 'secondaryTarget' => 'contact'],
];
$HERO_ROUTE = ['about' => '/we-are/about-company', 'services' => '/services', 'projects' => '/projects', 'clients' => '/clients', 'contact' => '/contact'];

/* ---------------------------------------------------------------------
 *  ABOUT
 * ------------------------------------------------------------------- */
$ABOUT = [
    'kicker' => 'Welcome to MME',
    'heading' => 'Defining engineering excellence since 2019',
    'lead' => 'We are pleased to introduce MME Private Limited, an ISO 9001:2015 certified company established in 2019, specializing in comprehensive civil, mechanical, and electrical development work.',
    'highlights' => [
        ['title' => 'Engineering Experience', 'text' => 'Our team comprises highly skilled engineers and industry professionals with over 20 years of technical experience across road, bridge, building and township construction, cement plants, power plants, and Alternative Fuels & Raw Materials (AFR) facilities.'],
        ['title' => 'End-to-End EPC', 'text' => 'In addition to site execution, we offer specialized Design, Drawing, and Detailing services to deliver complete end-to-end EPC solutions.'],
        ['title' => 'Pan-India Execution', 'text' => 'A skilled technical team, essential heavy machinery, and a strong financial foundation enable us to manage large projects anywhere in India.'],
        ['title' => 'HSE, Quality & Delivery', 'text' => 'We uphold high construction standards through discipline, strict Health, Safety, and Environment compliance, superior quality, and timely project completion.'],
    ],
    'commitment' => 'Driven by strong professional ethics and a commitment to operational excellence, we prioritize total client satisfaction on every contract.',
    'paragraphs' => [
        'We are pleased to introduce MME Private Limited, an ISO 9001:2015 certified company established in 2019, specializing in comprehensive civil, mechanical, and electrical development work. Our team comprises highly skilled engineers and industry professionals with over 20 years of technical experience across various disciplines, including road construction, bridge construction, building construction, township development, cement plants, power plants, and Alternative Fuels & Raw Materials (AFR) facilities. In addition to site execution, we offer specialized Design, Drawing, and Detailing services to deliver end-to-end EPC solutions.',
        'We possess a skilled technical team, essential heavy machinery, and a strong financial foundation, enabling us to manage large projects anywhere in India. Our core goal is to uphold high standards in construction, emphasizing discipline, strict Health, Safety, and Environment (HSE) compliance, superior quality, and timely project completion.',
        'Driven by strong professional ethics and a commitment to operational excellence, we prioritize total client satisfaction on every contract.',
    ],
];

$STATS = [
    ['value' => 2019, 'suffix' => '', 'label' => 'Established', 'isYear' => true],
    ['value' => 20, 'suffix' => '+', 'label' => 'Years of Engineering Experience', 'isYear' => false],
    ['value' => 35, 'suffix' => '+', 'label' => 'Projects Completed', 'isYear' => false],
    ['value' => 12, 'suffix' => '+', 'label' => 'Marquee Clients Served', 'isYear' => false],
];

$SERVICES = [
    ['id' => 'cement', 'title' => 'Cement Projects', 'image' => $IMAGES['serviceCement'], 'desc' => 'Complete cement plant solutions backed by over 20 years of experience — ensuring top-notch quality and reliability across every phase of the project.', 'intro' => "MME provides complete cement plant solutions — from civil foundations and structural steel to the fabrication, erection and commissioning of process equipment. With more than two decades of collective experience across India's largest cement producers, we deliver every mandate to exacting quality and safety standards.", 'paragraphs' => ['Our teams have executed expansions and greenfield packages for marquee names including UltraTech, ACC, Wonder Cement, Shree Cement, Ramco and Nuvoco. From clinker handling and conveyor systems to preheater towers and packing plants, we manage the full mechanical scope with precision.', 'Whether a shutdown modification or a full line installation, our disciplined project management ensures timely delivery without compromising on craftsmanship or safety performance.'], 'features' => ['Fabrication & erection of process equipment', 'Belt conveyor & material handling systems', 'Preheater tower & kiln erection support', 'Packing plant & bulk loading systems', 'Shutdown modifications & liner replacement', 'Structural steel fabrication']],
    ['id' => 'power', 'title' => 'Power Projects', 'image' => $IMAGES['servicePower'], 'desc' => 'Expertise in power plant construction delivering efficient, sustainable and cost-effective energy solutions across multiple industries.', 'intro' => 'MME delivers civil and mechanical works for thermal and captive power facilities, supporting efficient, reliable and cost-effective energy infrastructure for industrial clients across India.', 'paragraphs' => ['Our scope spans structural fabrication, equipment erection and balance-of-plant works that keep power generation running dependably. We bring experienced engineers, essential machinery and a strong safety culture to every site.', 'From boiler house steelwork to ducting, piping and conveyor systems, MME executes power sector packages with discipline and technical rigour.'], 'features' => ['Boiler house & structural erection', 'Ducting, piping & pipe-rack fabrication', 'Coal & ash handling systems', 'Equipment installation & alignment', 'Captive power balance-of-plant works', 'Operation & maintenance support']],
    ['id' => 'chemical', 'title' => 'Chemical & Fertilizer Plant', 'image' => $IMAGES['serviceChemical'], 'desc' => 'We design and execute chemical and fertilizer plants with high precision — ensuring safety, efficiency and industry-compliant standards.', 'intro' => 'MME executes chemical and fertilizer plant packages with a strong emphasis on precision, safety and compliance — critical for facilities handling sensitive processes and materials.', 'paragraphs' => ['We undertake fabrication and erection of process structures, tanks, pipe racks and equipment, working to stringent quality and industry-compliant standards. Our experience extends to petrochemical corridors and refinery support works.', 'Every mandate is delivered with a rigorous focus on integrity, safety performance and on-time completion.'], 'features' => ['Process structure fabrication & erection', 'Tank & vessel installation', 'Pipe rack & piping systems', 'Petrochemical & refinery support works', 'Industry-compliant QA/QC', 'Safety-first execution']],
    ['id' => 'balance', 'title' => 'Balance of Plant', 'image' => $IMAGES['serviceBalance'], 'desc' => 'Comprehensive mechanical and electrical solutions that support the seamless operation of main plants across their entire lifecycle.', 'intro' => 'Our Balance of Plant (BOP) services provide the comprehensive mechanical and electrical solutions that keep main plants operating seamlessly — from initial installation through their entire operating lifecycle.', 'paragraphs' => ['MME delivers the supporting systems that surround core plant processes: material handling, utilities, auxiliary structures and services that are essential to reliable, efficient operations.', 'With our own machinery, skilled manpower and disciplined project management, we mobilise BOP packages of any scale, anywhere in India.'], 'features' => ['Material handling & conveyor systems', 'Auxiliary structural steel works', 'Utility & service installations', 'Mechanical & electrical support systems', 'Lifecycle maintenance', 'Rapid mobilisation across India']],
    ['id' => 'steel', 'title' => 'Steel Projects', 'image' => $IMAGES['serviceSteel'], 'desc' => 'Steel plant projects delivered with advanced engineering — ensuring structural integrity and optimised manufacturing processes.', 'intro' => 'MME delivers steel plant projects with advanced engineering solutions — ensuring structural integrity, precise erection and optimised manufacturing processes for heavy industry.', 'paragraphs' => ['From structural fabrication to heavy mechanical erection, our teams handle the demanding tolerances and scale of the steel sector, including ongoing works for Jindal Steel (MASYC) at Jajpur, Odisha.', 'We combine experienced engineers, essential machinery and a strong financial foundation to execute large steel mandates reliably and safely.'], 'features' => ['Heavy structural steel fabrication', 'Mechanical erection to tight tolerances', 'Equipment installation & alignment', 'Corridor & conveyor line works', 'Plant expansion support', 'Quality-assured welding']],
];

$EXPERTISE = [
    ['title' => 'Fabrication & Erection', 'desc' => 'Structural steel fabrication and heavy mechanical erection executed to exacting tolerances.'],
    ['title' => 'Plant Construction', 'desc' => 'End-to-end civil and mechanical construction for cement, power and steel plants.'],
    ['title' => 'Operation & Maintenance', 'desc' => 'Shutdown jobs, equipment replacement and lifelong maintenance support on live plants.'],
];

$INDUSTRIES = [
    ['name' => 'Cement', 'desc' => "Plant erection, expansions & equipment installation for India's largest cement producers.", 'icon' => 'factory'],
    ['name' => 'Power', 'desc' => 'Construction and mechanical works for thermal and captive power facilities.', 'icon' => 'zap'],
    ['name' => 'Steel', 'desc' => 'Structural fabrication and erection for steel plants and heavy industry.', 'icon' => 'layers'],
    ['name' => 'Chemical & Fertilizer', 'desc' => 'Precision execution of chemical and fertilizer plant packages.', 'icon' => 'flask-conical'],
    ['name' => 'Oil & Gas', 'desc' => 'Fabrication and erection support for refineries and petrochemical corridors.', 'icon' => 'fuel'],
    ['name' => 'Infrastructure', 'desc' => 'Roads, bridges, buildings and township development across India.', 'icon' => 'route'],
];

$PROJECTS = [
    ['srNo' => '1', 'name' => 'RAIGARH JPEL', 'client' => 'JINDAL PROJECTS & ENGINEERS LIMITED', 'location' => 'RAIGARH, CHATTISHGARH', 'type' => 'Steel', 'status' => 'Ongoing', 'statusLabel' => 'IN-PROGRESS', 'image' => $IMAGES['serviceSteel']],
    ['srNo' => '2', 'name' => 'NATHDWARA UTCL', 'client' => 'ULTRATECH CEMENT LIMITED', 'location' => 'PINDWARA, RAJASTHAN', 'type' => 'Cement', 'status' => 'Ongoing', 'statusLabel' => 'IN-PROGRESS', 'image' => $IMAGES['serviceCement']],
    ['srNo' => '3', 'name' => 'WANAKBORI UTCL LINE-2', 'client' => 'ULTRATECH CEMENT LIMITED', 'location' => 'WANAKBORI, GUJRAT', 'type' => 'Cement', 'status' => 'Ongoing', 'statusLabel' => 'IN-PROGRESS', 'image' => $IMAGES['expertise'][0]],
    ['srNo' => '3', 'name' => 'WANAKBORI UTCL LINE -3', 'client' => 'ULTRATECH CEMENT LIMITED', 'location' => 'WANAKBORI, GUJRAT', 'type' => 'Cement', 'status' => 'Ongoing', 'statusLabel' => 'IN-PROGRESS', 'image' => $IMAGES['aboutSecondary']],
    ['srNo' => '4', 'name' => 'PATNA UTCL PATLIPUTRA CEMENT', 'client' => 'ULTRATECH CEMENT LIMITED', 'location' => 'PATNA, BIHAR', 'type' => 'Cement', 'status' => 'Ongoing', 'statusLabel' => 'IN-PROGRESS', 'image' => $IMAGES['serviceCement']],
    ['srNo' => '5', 'name' => 'PALI UTCL', 'client' => 'ULTRATECH CEMENT LIMITED', 'location' => 'PALI, RAJASTHAN', 'type' => 'Cement', 'status' => 'Ongoing', 'statusLabel' => 'IN-PROGRESS', 'image' => $IMAGES['expertise'][1]],
    ['srNo' => '6', 'name' => 'INDORE UTCL, BINOD REAL ESTATE', 'client' => 'ULTRATECH CEMENT LIMITED', 'location' => 'INDORE, MADHYA PRADESH', 'type' => 'Cement', 'status' => 'Ongoing', 'statusLabel' => 'IN-PROGRESS', 'image' => $IMAGES['serviceCement']],
    ['srNo' => '7', 'name' => 'DHULE UTCL', 'client' => 'ULTRATECH CEMENT LIMITED', 'location' => 'DHULE, MAHARASTRA', 'type' => 'Cement', 'status' => 'Ongoing', 'statusLabel' => 'IN-PROGRESS', 'image' => $IMAGES['expertise'][1]],
    ['srNo' => '8', 'name' => 'PATRATU UTCL', 'client' => 'ULTRATECH CEMENT LIMITED', 'location' => 'PATRATU, JHARKHAND', 'type' => 'Cement', 'status' => 'Ongoing', 'statusLabel' => 'IN-PROGRESS', 'image' => $IMAGES['serviceCement']],
    ['srNo' => '9', 'name' => 'MAIHAR UTCL', 'client' => 'ULTRATECH CEMENT LIMITED', 'location' => 'MAIHAR, MADHYA PRADESH', 'type' => 'Cement', 'listingStatus' => 'Ongoing', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['aboutSecondary']],
    ['srNo' => '1', 'name' => 'ACC AMETHA CEMENT EXPANSION', 'client' => 'LARSEN & TOUBRO LTD.', 'location' => 'AMETHA, MADHYA PRADESH', 'type' => 'Cement', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['serviceCement']],
    ['srNo' => '2', 'name' => 'RAMCO CEMENT KOLIMIGUNDLA', 'client' => 'LARSEN & TOUBRO LTD.', 'location' => 'KOLIMIGUNDLA, ANDHRA PRADESH', 'type' => 'Cement', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['expertise'][0]],
    ['srNo' => '3', 'name' => 'ACC TIKARIYA EXPANSION', 'client' => 'KEC INTERNATIONAL LTD.', 'location' => 'TIKARIYA', 'type' => 'Cement', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['expertise'][0]],
    ['srNo' => '4', 'name' => 'RCCPL PLANT — MP BIRLA GROUP', 'client' => 'KEC INTERNATIONAL LTD.', 'location' => 'MUKUTBAN, MAHARASHTRA', 'type' => 'Cement', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['aboutSecondary']],
    ['srNo' => '5', 'name' => 'JOJOBERA CEMENT PLANT', 'client' => 'NUVOCO VISTAS CORP. LTD.', 'location' => 'JOJOBERA, JHARKHAND', 'type' => 'Cement', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['expertise'][1]],
    ['srNo' => '6', 'name' => 'WONDER CEMENT — RK NAGAR', 'client' => 'WONDER CEMENT LTD.', 'location' => 'NIMBAHERA, RAJASTHAN', 'type' => 'Cement', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['serviceCement']],
    ['srNo' => '7', 'name' => 'SOJITZ CORRIDOR LINE FABRICATION', 'client' => 'LARSEN & TOUBRO LTD.', 'location' => 'MARWAR JUNCTIO,N RAJASTHAN', 'type' => 'Fabrication', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['serviceSteel']],
    ['srNo' => '8', 'name' => 'PETRO PROJECT BAGRU KHURD', 'client' => 'LARSEN & TOUBRO LTD.', 'location' => 'BAGRU KHURD', 'type' => 'Oil & Gas', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['serviceChemical']],
    ['srNo' => '9', 'name' => 'NUVOCO VISTAS CEMENT WORKS', 'client' => 'NUVOCO VISTAS CORP. LTD.', 'location' => 'NUVOCO VISTAS CEMENT WORKS', 'type' => 'Cement', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['expertise'][1]],
    ['srNo' => '10', 'name' => 'SHREE CEMENT LTD.', 'client' => 'SHREE CEMENT LTD.', 'location' => 'NAWALGARH, RAJASTHAN', 'type' => 'Cement', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['aboutSecondary']],
    ['srNo' => '11', 'name' => 'JINDAL STAINLESS LIMITED', 'client' => 'MAYSC PROJECTS PVT LTD', 'location' => 'JAJPUR, ODISHA', 'type' => 'Steel', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['serviceSteel']],
    ['srNo' => '12', 'name' => 'RUNGTA STEEL', 'client' => 'RUNGTA STEEL', 'location' => 'DHENKANAL, ODISHA', 'type' => 'Steel', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['serviceSteel']],
    ['srNo' => '13', 'name' => 'PATNA UTCL PATLIPUTRA CEMENT', 'client' => 'ULTRATECH CEMENT LIMITED', 'location' => 'PATNA, BIHAR', 'type' => 'Cement', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['serviceCement']],
    ['srNo' => '14', 'name' => 'DHULE UTCL', 'client' => 'ULTRATECH CEMENT LIMITED', 'location' => 'DHULE, MAHARASTRA', 'type' => 'Cement', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['expertise'][1]],
    ['srNo' => '15', 'name' => 'RELIANCE JAMNAGAR', 'client' => 'LARSEN & TOUBRO LTD.', 'location' => 'JAMNAGAR, GUJRAT', 'type' => 'Oil & Gas', 'status' => 'Completed', 'statusLabel' => 'COMPLETED', 'image' => $IMAGES['serviceChemical']],
];
$PROJECT_FILTERS = ['All', 'Ongoing', 'Completed', 'Cement', 'Steel', 'Oil & Gas'];

$WHY = [
    'kicker' => 'Why MME',
    'heading' => 'A partner built on discipline, quality and trust',
    'points' => [
        ['title' => 'Experienced Engineers', 'desc' => 'A technical team led by engineers with 20+ years across heavy industry.'],
        ['title' => 'Own Machinery & Resources', 'desc' => 'Essential machinery and manpower to mobilise large projects anywhere in India.'],
        ['title' => 'Strong Financial Foundation', 'desc' => 'The financial strength to take on and complete large-scale industrial mandates.'],
        ['title' => 'On-Time Delivery', 'desc' => 'A long-standing tradition of timely completion without compromising quality.'],
        ['title' => 'Uncompromising Safety', 'desc' => 'Safety performance recognised as a core discipline on every live site.'],
        ['title' => 'Complete Client Satisfaction', 'desc' => 'Efficient management and excellent craftsmanship on every mandate.'],
    ],
];

$DIRECTOR = [
    'kicker' => "From the Director's Desk",
    'quote' => 'The company has gained prominence as a leader in the construction and engineering industry through competence, competitiveness and the timely delivery of projects with the highest quality standards, while recognising the importance of safety performance. In this era of advanced technologies and new techniques, we continuously strive for innovation and increased efficiency.',
    'name' => 'Pradeep Sharma',
    'role' => 'Managing Director & CEO',
    'image' => $IMAGES['director'],
];

$CLIENTS = [
    ['name' => 'Larsen & Toubro', 'logo' => '/assets/images/site/client-larsen-toubro.jpeg'],
    ['name' => 'UltraTech Cement', 'logo' => '/assets/images/site/client-ultratech.png'],
    ['name' => 'KEC International', 'logo' => '/assets/images/site/client-kec.png'],
    ['name' => 'Wonder Cement', 'logo' => '/assets/images/site/client-wonder.png'],
    ['name' => 'Shree Cement', 'logo' => '/assets/images/site/client-shree.png'],
    ['name' => 'Nuvoco Vistas', 'logo' => '/assets/images/site/client-nuvoco.png'],
    ['name' => 'Reliance Industries', 'logo' => '/assets/images/site/client-reliance.jpg'],
    ['name' => 'Jindal Steel', 'logo' => '/assets/images/site/client-jindal.jpg'],
    ['name' => 'Bangur Cement', 'logo' => '/assets/images/site/client-bangur.png'],
];

$GALLERY = [
    '/assets/images/site/industrial-structure.jpg', '/assets/images/site/gallery-2.jpg', '/assets/images/site/balance-plant.jpg', '/assets/images/site/gallery-4.jpg', '/assets/images/site/gallery-5.jpg', '/assets/images/site/gallery-6.jpg', '/assets/images/site/gallery-7.jpg', '/assets/images/site/gallery-8.jpg',
];

$HR = [
    'quote' => "As the General Manager – Human Resources, I'm proud to lead efforts in nurturing our greatest asset — our people. We focus on attracting, developing and retaining top talent in mechanical engineering, fostering a culture of growth, collaboration and innovation. At MME we value integrity, respect and excellence — making our company a great place to work and a family that thrives together.",
    'name' => 'Vandana Singh',
    'role' => 'General Manager – Human Resources',
    'image' => $IMAGES['hr'],
];

$CERTIFICATES = [
    ['title' => 'ISO Certification', 'img' => '/assets/images/site/certificate-iso.jpg'],
    ['title' => 'Company Certification', 'img' => '/assets/images/site/certificate-company.jpg'],
    ['title' => 'Work Completion Certificate', 'img' => '/assets/images/site/certificate-work-completion.jpg'],
    ['title' => 'Certificate of Excellence', 'img' => '/assets/images/site/certificate-excellence.jpg'],
    ['title' => 'UltraTech Cement Completion', 'img' => '/assets/images/site/certificate-ultratech.jpg'],
];

$WE_ARE_LINKS = [
    ['label' => 'About Company', 'to' => '/we-are/about-company'],
    ['label' => 'Board of Director', 'to' => '/we-are/board-of-directors'],
    ['label' => 'Our Team', 'to' => '/we-are/our-team'],
    ['label' => 'Our Client', 'to' => '/we-are/our-clients'],
    ['label' => 'Annual Report', 'to' => '/we-are/annual-report'],
];
$WE_SERVE_LINKS = [
    ['label' => 'Mechanical Work', 'to' => '/we-serve/mechanical-work'],
    ['label' => 'Civil Work', 'to' => '/we-serve/civil-work'],
    ['label' => 'Electrical Work', 'to' => '/we-serve/electrical-work'],
    ['label' => 'Additional Services', 'to' => '/we-serve/additional-services'],
];
$NAV_LINKS = [
    ['label' => 'Home', 'to' => '/'],
    ['label' => 'We Are', 'to' => '/we-are', 'children' => $WE_ARE_LINKS],
    ['label' => 'We Serve', 'to' => '/we-serve', 'children' => $WE_SERVE_LINKS],
    ['label' => 'Projects', 'to' => '/projects'],
    ['label' => 'Industries', 'to' => '/industries'],
    ['label' => 'Clients', 'to' => '/clients'],
    ['label' => 'Gallery', 'to' => '/gallery'],
    ['label' => 'Careers', 'to' => '/careers'],
    ['label' => 'Contact', 'to' => '/contact'],
];

$MISSION_VISION = [
    'mission' => 'We are a team committed to swift, dedicated efforts, unwavering integrity and hard work — delivering outstanding projects, products and services that stand the test of time.',
    'vision' => 'Rising above all standards. Our vision is to create infrastructure with unparalleled quality, utmost dedication and environmentally responsible production.',
    'commitment' => 'Committed to the timely and efficient execution of every assignment, we prioritise the excellence of our human capital to achieve continuous, sustained growth and profitability.',
    'values' => [
        ['title' => 'Integrity', 'desc' => 'Unwavering honesty and transparency in every relationship and every decision.'],
        ['title' => 'Quality', 'desc' => 'An uncompromising commitment to craftsmanship and engineering excellence.'],
        ['title' => 'Safety', 'desc' => 'A zero-harm culture that protects our people, partners and communities.'],
        ['title' => 'Sustainability', 'desc' => 'Environmentally responsible production that respects tomorrow.'],
    ],
];
$MISSION_VALUE_ICONS = ['shield-check', 'target', 'eye', 'handshake'];

$HSE_POLICY = [
    'intro' => 'MME Private Limited is committed to protecting the health and safety of every employee, partner and visitor while minimizing the environmental impact of our operations. HSE responsibility is built into planning, mobilization, execution and handover at every project site.',
    'commitments' => [
        ['title' => 'Zero-Harm Mindset', 'desc' => 'Identify hazards early, assess risk and apply effective controls before every activity begins.'],
        ['title' => 'Safe Work Systems', 'desc' => 'Follow permit-to-work, PPE, toolbox talk, inspection and emergency-response requirements without exception.'],
        ['title' => 'Environmental Care', 'desc' => 'Control waste, dust, emissions, noise and resource use through responsible site practices.'],
        ['title' => 'Continuous Improvement', 'desc' => 'Review incidents, observations and audit findings to strengthen training, systems and accountability.'],
    ],
];
$HSE_ICONS = ['hard-hat', 'shield-check', 'leaf', 'clipboard-check'];

$CORE_STRENGTHS = [
    ['title' => 'Integrated EPC Capability', 'desc' => 'Design, drawing, detailing, procurement support and disciplined site execution under one accountable team.'],
    ['title' => 'Experienced Leadership', 'desc' => 'Engineers and industry professionals with more than 20 years of multidisciplinary technical experience.'],
    ['title' => 'Pan-India Mobilization', 'desc' => 'Skilled manpower, project controls and resources ready to support large assignments anywhere in India.'],
    ['title' => 'Plant & Equipment Resources', 'desc' => 'Access to essential heavy machinery, tools and execution systems required for demanding industrial work.'],
    ['title' => 'Quality & HSE Governance', 'desc' => 'Structured QA/QC, safe-work controls and transparent reporting embedded throughout project delivery.'],
    ['title' => 'ISO Certifications & Compliance', 'desc' => 'ISO 9001:2015 certified quality management aligned with applicable statutory, client and industry requirements.'],
];
$STRENGTH_ICONS = ['wrench', 'users', 'map-pinned', 'factory', 'shield-check', 'badge-check'];

$BOARD = [
    ['name' => 'Pradeep Sharma', 'role' => 'Director & CEO', 'image' => '/assets/images/pradeep.png', 'imgPos' => 'object-top', 'message' => [
        'Welcome to MME Private Limited! As the Director and CEO of MME Private Limited, I am both honored and excited to share with you the story of our company and the values that have driven us to success in the dynamic world of mechanical engineering.',
        'Founded on the principles of innovation, precision, and dedication, MME Private Limited has steadily built a legacy of trust and excellence. For over ten years, we have consistently delivered high-quality mechanical solutions to industries ranging from automotive, construction, manufacturing, etc. Our ability to meet the evolving needs of our clients and address complex engineering challenges has positioned us as a reliable partner in the mechanical engineering space.',
        'At MME Private Limited, we believe that the foundation of our success lies in our unwavering commitment to quality, safety, and customer satisfaction. Our team of engineers, technicians, and professionals work tirelessly to provide customized solutions that drive efficiency, reduce costs, and ensure sustainability for our clients.',
        'As we continue to innovate and expand, we remain focused on building long-term relationships with our customers based on mutual respect and trust. We embrace challenges as opportunities for growth and are committed to staying at the cutting edge of technology, ensuring that we continue to meet the highest standards in the industry.',
        'Thank you for visiting our website. We invite you to explore our range of products and services and look forward to the possibility of working together to create lasting solutions for your business.',
    ]],
    ['name' => 'Vandana Singh', 'role' => 'General Manager - Human Resource', 'image' => '/assets/images/vandana.png', 'imgPos' => 'object-top', 'message' => [
        'Welcome to MME Private Limited! As the General Manager - Human Resource, I am proud to lead our efforts in building and nurturing the most valuable asset of our company - our people. At MME Private Limited, we believe that the strength of our organization lies in the talent, dedication, and passion of our team members. We are committed to creating an environment that fosters growth, collaboration, and innovation, empowering our employees to reach their full potential.',
        'Our HR philosophy is centered around attracting, developing, and retaining the best talent in the mechanical engineering industry. We invest in training, professional development, and a supportive work culture that promotes continuous learning and encourages excellence at all levels of the organization.',
        "We understand that in today's rapidly evolving industry, the success of any business is closely tied to the skills and expertise of its workforce. That's why we place a strong emphasis on providing a safe, inclusive, and engaging workplace where every individual has the opportunity to thrive. By aligning our people strategies with the company's vision, we ensure that we are not only meeting the needs of today but also preparing for the challenges and opportunities of tomorrow.",
        'At MME Private Limited, we are more than just a team—we are a family that values integrity, collaboration, and mutual respect. We are proud of the culture we have built, and we continue to invest in making MME Private Limited a great place to work.',
        'Thank you for visiting our website. We invite you to learn more about the opportunities that await and how we can work together to achieve success.',
    ]],
];

$TEAM = [
    ['name' => 'PRABHAT TIWARI', 'role' => 'Sr. GM', 'location' => 'HO GHAZIABAD', 'image' => '/assets/images/team/prabhat-tiwari.webp'],
    ['name' => 'GURVESH CHATURVEDI', 'role' => 'SALES MANAGER', 'location' => 'HO GHAZIABAD', 'image' => '/assets/images/team/gurvesh-chaturvedi.webp'],
    ['name' => 'SHUBHAM TIWARI', 'role' => 'MANAGER HR', 'location' => 'HO GHAZIABAD', 'image' => '/assets/images/team/shubham-tiwari.webp'],
    ['name' => 'BINOD KUMAR NAYAK', 'role' => 'MANAGER PROJECT', 'location' => 'HO GHAZIABAD', 'image' => '/assets/images/team/binod-kumar-nayak.webp'],
    ['name' => 'PRINCE SHARMA', 'role' => 'MANAGER HR', 'location' => 'HO GHAZIABAD', 'image' => '/assets/images/team/prince-sharma.webp'],
    ['name' => 'MANDEEP SINGH', 'role' => 'MANAGER FINANCE', 'location' => 'HO GHAZIABAD', 'image' => '/assets/images/team/mandeep-singh.webp'],
    ['name' => 'SACHIN SHUKLA', 'role' => 'ASST MANAGER PURCHASE', 'location' => 'HO GHAZIABAD', 'image' => '/assets/images/team/sachin-shukla.webp'],
    ['name' => 'BRIJESH KUMAR', 'role' => 'MANAGER FINANCE', 'location' => 'HO GHAZIABAD', 'image' => '/assets/images/team/brijesh-kumar.webp'],
    ['name' => 'ASHISH KR SINGH', 'role' => 'HR & ACCOUNTANT', 'location' => 'JAMSHEDPUR, JHARKHAND', 'image' => '/assets/images/team/ashish-kr-singh.webp'],
    ['name' => 'ABHISHEK RANJAN', 'role' => 'CA', 'location' => 'JAMSHEDPUR, JHARKHAND', 'image' => '/assets/images/team/abhishek-ranjan-v2.webp'],
    ['name' => 'NITESH KUMAR', 'role' => 'PROJECT MANAGER', 'location' => 'PALI, RAJASTHAN', 'image' => '/assets/images/team/nitesh-kumar-v2.webp'],
    ['name' => 'PT PARDHI', 'role' => 'HEAD P.M', 'location' => 'WANAKBORI, GUJRAT', 'image' => '/assets/images/team/pt-pardhi.webp'],
    ['name' => 'AYUSH SHARMA', 'role' => 'SITE MANAGER', 'location' => 'WANAKBORI, GUJRAT', 'image' => '/assets/images/team/ayush-sharma.webp'],
    ['name' => 'ROHIT PRASAD', 'role' => 'MANAGER-HR', 'location' => 'WANAKBORI, GUJRAT', 'image' => '/assets/images/team/rohit-prasad.webp'],
    ['name' => 'SNEHASIS GUPTA', 'role' => 'MANAGER PROJECT', 'location' => 'PATNA, BIHAR', 'image' => '/assets/images/team/snehasis-gupta.webp'],
    ['name' => 'PAWAN SINGH', 'role' => 'MANAGER-PROJECT', 'location' => 'RAIGARH, CHATTISGARH', 'image' => '/assets/images/team/pawan-singh.webp'],
    ['name' => 'SURENDRA SINGH', 'role' => 'PROJECT MANAGER', 'location' => 'RAIGARH, CHATTISGARH', 'image' => '/assets/images/team/surendra-singh.webp'],
    ['name' => 'ANIL KUMAR', 'role' => 'MANAGER PROJECT', 'location' => 'NATHDWARA, RAJASTHAN', 'image' => '/assets/images/team/anil-kumar.webp'],
    ['name' => 'SAMIR NAYEK', 'role' => 'MANAGER-PROJECTS', 'location' => 'INDORE, MP', 'image' => '/assets/images/team/samir-nayek.webp'],
    ['name' => 'PRADEEP RAMRAJRAM PASWAN', 'role' => 'MANAGER-PROJECT', 'location' => 'INDORE, MP', 'image' => '/assets/images/team/pradeep-ramrajram-paswan.webp'],
];

$OUR_CLIENTS = [
    ['name' => 'UltraTech Cement', 'location' => 'Patna, Bihar', 'sector' => 'Cement'],
    ['name' => 'Jindal Steel (MASYC)', 'location' => 'Jajpur, Odisha', 'sector' => 'Steel'],
    ['name' => 'Nuvoco Vistas Corp. Ltd.', 'location' => 'Charkhi Dadri, Haryana', 'sector' => 'Cement'],
    ['name' => 'Shree Cement Ltd.', 'location' => 'Nawalgarh, Rajasthan', 'sector' => 'Cement'],
    ['name' => 'Dalmia Cement (Bharat) Ltd.', 'location' => 'Cuttack, Odisha', 'sector' => 'Cement'],
    ['name' => 'Larsen & Toubro', 'location' => 'Pan India', 'sector' => 'Infrastructure'],
    ['name' => 'Wonder Cement Ltd.', 'location' => 'Chittorgarh, Rajasthan', 'sector' => 'Cement'],
    ['name' => 'Reliance Industries Ltd.', 'location' => 'Jamnagar, Gujarat', 'sector' => 'Oil & Gas'],
];

$ANNUAL_REPORTS = [
    ['year' => '2025 – 2026', 'label' => 'FY 2025-26', 'status' => 'In Progress', 'pdf' => ''],
    ['year' => '2024 – 2025', 'label' => 'FY 2024-25', 'status' => 'Published', 'pdf' => ''],
    ['year' => '2023 – 2024', 'label' => 'FY 2023-24', 'status' => 'Published', 'pdf' => ''],
    ['year' => '2022 – 2023', 'label' => 'FY 2022-23', 'status' => 'Published', 'pdf' => ''],
    ['year' => '2021 – 2022', 'label' => 'FY 2021-22', 'status' => 'Published', 'pdf' => ''],
    ['year' => '2020 – 2021', 'label' => 'FY 2020-21', 'status' => 'Published', 'pdf' => ''],
    ['year' => '2019 – 2020', 'label' => 'FY 2019-20', 'status' => 'Published', 'pdf' => ''],
];
$REPORT_HIGHLIGHTS = [
    ['value' => '35+', 'label' => 'Projects Delivered'],
    ['value' => '12+', 'label' => 'Marquee Clients'],
    ['value' => '20+', 'label' => 'Years of Expertise'],
    ['value' => '6', 'label' => 'Industry Sectors'],
];
$REVENUE = [
    ['year' => '2019 – 20', 'cr' => 1.23, 'amount' => '₹1,23,45,014/-', 'projected' => false],
    ['year' => '2020 – 21', 'cr' => 5.04, 'amount' => '₹5,04,37,443/-', 'projected' => false],
    ['year' => '2021 – 22', 'cr' => 2.09, 'amount' => '₹2,08,84,430/-', 'projected' => false],
    ['year' => '2022 – 23', 'cr' => 6.23, 'amount' => '₹6,22,55,561/-', 'projected' => false],
    ['year' => '2023 – 24', 'cr' => 5.17, 'amount' => '₹5,17,00,000/-', 'projected' => false],
    ['year' => '2024 – 25', 'cr' => 10.68, 'amount' => '₹10,68,00,000/-', 'projected' => false],
    ['year' => '2025 – 26', 'cr' => 28.0, 'amount' => '₹28,00,00,000/-', 'projected' => true],
];

/* ---------------------------------------------------------------------
 *  WE SERVE — 4 disciplines × 4 plant sectors
 * ------------------------------------------------------------------- */
$WS_PLANTS = [
    ['slug' => 'cement-plant', 'name' => 'Cement Plant', 'image' => $IMAGES['serviceCement']],
    ['slug' => 'power-plant', 'name' => 'Power Plant', 'image' => $IMAGES['servicePower']],
    ['slug' => 'steel-plant', 'name' => 'Steel Plant', 'image' => $IMAGES['serviceSteel']],
    ['slug' => 'fertilizer-plant', 'name' => 'Fertilizer Plant', 'image' => $IMAGES['serviceChemical']],
];
if (!function_exists('ws_sub')) {
    function ws_sub($plant, $desc, $features) {
        return ['slug' => $plant['slug'], 'title' => $plant['name'], 'image' => $plant['image'], 'desc' => $desc, 'features' => $features];
    }
}
$WE_SERVE = [
    ['slug' => 'mechanical-work', 'title' => 'Mechanical Work', 'short' => 'Mechanical Work', 'tagline' => 'Erection, equipment installation, piping and fabrication across every plant.', 'image' => $IMAGES['expertise'][0], 'intro' => [
        "Mechanical works are at the heart of MME's capability — mechanical erection, equipment installation, heavy-equipment handling, piping and fabrication delivered to exacting engineering standards across India's core process industries.",
        "With our own machinery, skilled manpower and disciplined project management, we execute mechanical packages of any scale — from single-equipment erection to a plant's complete mechanical scope.",
    ], 'subs' => [
        ws_sub($WS_PLANTS[0], 'Complete mechanical erection and equipment installation for cement plants — mills, kilns, conveyors and material-handling systems.', ['Vertical & ball mill erection', 'Kiln & preheater equipment', 'Conveyor & bulk material handling', 'Fans, ducts & separators', 'Alignment, grouting & commissioning', 'Shutdown mechanical works']),
        ws_sub($WS_PLANTS[1], 'Heavy mechanical erection and equipment installation for thermal and captive power plants.', ['Boiler pressure-part erection', 'Turbine hall & auxiliary equipment', 'Fans, mills & pumps', 'HP/LP piping erection', 'Ducting & expansion joints', 'Alignment & commissioning']),
        ws_sub($WS_PLANTS[2], 'Precision mechanical erection for the demanding tolerances and scale of steel plants.', ['Rolling mill equipment', 'Furnace & caster erection', 'Heavy equipment rigging', 'Utility & process piping', 'Cranes & handling systems', 'Precision alignment & testing']),
        ws_sub($WS_PLANTS[3], 'Mechanical installation for compliance-critical chemical and fertilizer facilities.', ['Reactor & vessel installation', 'Rotating equipment erection', 'Process & utility piping', 'Skid & package units', 'Exotic-alloy welding & NDT', 'Pre-commissioning support']),
    ]],
    ['slug' => 'civil-work', 'title' => 'Civil Work', 'short' => 'Civil Work', 'tagline' => 'Foundations, RCC and complete civil packages built to last.', 'image' => '/assets/images/site/we-serve-civil.jpg', 'intro' => [
        "MME's civil works form the durable foundation of every plant — RCC structures, machine foundations, industrial buildings, roads, drainage and complete site development, executed with quality-controlled concrete and experienced supervision.",
        'From greenfield civil packages to brownfield modifications, we deliver structurally sound, compliant civil works that meet the toughest load and safety requirements.',
    ], 'subs' => [
        ws_sub($WS_PLANTS[0], 'Foundations, silos and civil structures engineered for cement plant loads.', ['Equipment & mill foundations', 'Preheater tower civils', 'RCC silos & structures', 'Roads, drains & paving', 'Packing plant civils', 'Quality-controlled concrete']),
        ws_sub($WS_PLANTS[1], 'Heavy civil works for turbine, boiler and balance-of-plant structures.', ['Turbine & boiler foundations', 'Cooling tower & pump house', 'Chimney & duct civils', 'Coal & ash handling civils', 'Cable trenches & pits', 'Site development']),
        ws_sub($WS_PLANTS[2], 'Heavy machine foundations and RCC works for integrated steel plants.', ['Heavy machine foundations', 'Mill & furnace civils', 'RCC structures', 'Pits, trenches & sumps', 'Roads & hardstanding', 'Utility civils']),
        ws_sub($WS_PLANTS[3], 'Chemical-resistant civil works for fertilizer and process plants.', ['Process building civils', 'Equipment foundations', 'Chemical-resistant flooring', 'Bunds & containment', 'Drainage & effluent channels', 'Pipe-rack & utility civils']),
    ]],
    ['slug' => 'electrical-work', 'title' => 'Electrical Work', 'short' => 'Electrical Work', 'tagline' => 'HT/LT systems, cabling and power distribution — fully commissioned.', 'image' => '/assets/images/site/we-serve-electrical.jpg', 'intro' => [
        'MME delivers complete electrical works for process plants — installation, HT/LT systems, cable laying and termination, lighting, power distribution and maintenance — all executed to code with rigorous testing and safety.',
        'Our qualified electrical teams integrate seamlessly with mechanical and civil scope to hand over fully commissioned, reliable electrical systems.',
    ], 'subs' => [
        ws_sub($WS_PLANTS[0], 'Electrical installation, distribution and commissioning for cement plants.', ['MCC & switchgear installation', 'Motor & drive wiring', 'HT/LT distribution', 'Cable laying & termination', 'Earthing & lighting systems', 'Testing & commissioning']),
        ws_sub($WS_PLANTS[1], 'Switchyard, HT systems and power distribution for power plants.', ['Switchyard & HT systems', 'Transformer & panel installation', 'Cable & bus-duct works', 'Protection & relay coordination', 'Earthing & lightning protection', 'Commissioning support']),
        ws_sub($WS_PLANTS[2], 'Heavy-drive electrical works and distribution for steel plants.', ['Heavy-drive & motor wiring', 'HT/LT power distribution', 'Cable trenches & trays', 'Substation equipment', 'Lighting & earthing', 'Testing & energisation']),
        ws_sub($WS_PLANTS[3], 'Hazardous-area compliant electrical works for fertilizer plants.', ['Hazardous-area (Ex) wiring', 'Instrumentation power supply', 'HT/LT distribution', 'Cable laying & glanding', 'Earthing & lighting', 'Safety testing & commissioning']),
    ]],
    ['slug' => 'additional-services', 'title' => 'Additional Services', 'short' => 'Additional Services', 'tagline' => 'Project management, manpower and support that de-risk delivery.', 'image' => '/assets/images/site/we-serve-additional.jpg', 'intro' => [
        'Beyond our core disciplines, MME provides the engineering support that de-risks delivery — project management, manpower supply, equipment support, shutdown services, site supervision and technical consultancy.',
        'These services give clients a single, dependable partner for planning, mobilising and delivering complex plant projects with confidence.',
    ], 'subs' => [
        ws_sub($WS_PLANTS[0], 'Project management, manpower and shutdown support for cement plants.', ['Project management & planning', 'Skilled manpower supply', 'Shutdown & turnaround support', 'Equipment & crane support', 'Site supervision & QA/QC', 'Technical consultancy']),
        ws_sub($WS_PLANTS[1], 'O&M, shutdown and site support services for power plants.', ['O&M support', 'Shutdown management', 'Manpower mobilisation', 'Equipment & tooling support', 'Site supervision', 'Technical advisory']),
        ws_sub($WS_PLANTS[2], 'Heavy-equipment, manpower and maintenance support for steel plants.', ['Heavy-equipment support', 'Skilled manpower supply', 'Shutdown & maintenance', 'Project management', 'Site supervision', 'Technical consultancy']),
        ws_sub($WS_PLANTS[3], 'Turnaround, safety and technical support for fertilizer plants.', ['Turnaround services', 'Safety-permit management', 'Manpower supply', 'Equipment support', 'Site supervision', 'Technical consultancy']),
    ]],
];
$WESERVE_HERO = $IMAGES['expertise'][1];

if (!function_exists('ws_find_category')) {
    function ws_find_category($slug) {
        global $WE_SERVE;
        foreach ($WE_SERVE as $c) if ($c['slug'] === $slug) return $c;
        return null;
    }
}
if (!function_exists('ws_find_sub')) {
    function ws_find_sub($cat, $subSlug) {
        if (!$cat) return null;
        foreach ($cat['subs'] as $s) if ($s['slug'] === $subSlug) return $s;
        return null;
    }
}

/* ---------------------------------------------------------------------
 *  JOB OPENINGS (editable data file — see includes/jobs.php)
 * ------------------------------------------------------------------- */
require_once __DIR__ . '/jobs.php';
