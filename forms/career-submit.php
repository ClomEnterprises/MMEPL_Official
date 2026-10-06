<?php
require_once __DIR__ . '/mailer.php';
require_post();

if (!csrf_verify('career', $_POST['csrf_token'] ?? '')) {
    json_response(false, 'Your session expired. Please refresh the page and try again.', 419);
}
if (!empty($_POST['website'])) {
    json_response(true, 'Thank you. Your application has been received.');
}
rate_limit('career');

$role          = clean($_POST['role'] ?? '');
$fullName      = clean($_POST['full_name'] ?? '');
$dob           = clean($_POST['date_of_birth'] ?? '');
$gender        = clean($_POST['gender'] ?? '');
$phone         = clean($_POST['phone'] ?? '');
$email         = clean($_POST['email'] ?? '');
$qualification = clean($_POST['qualification'] ?? '');
$maritalStatus = clean($_POST['marital_status'] ?? '');
$address       = clean($_POST['address'] ?? '');

if ($role === '' || $fullName === '' || $dob === '' || $gender === '' || $phone === '' || $email === '' || $qualification === '' || $address === '') {
    json_response(false, 'Please complete all required fields.', 422);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    json_response(false, 'Please enter a valid email address.', 422);
}

$attachments = [];
$resume = validate_upload($_FILES['resume'] ?? null, ['pdf', 'doc', 'docx'],
    ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/x-cfb', 'application/zip'],
    5 * 1024 * 1024, 'Resume', true);
if ($resume) $attachments[] = $resume;

$photo = validate_upload($_FILES['photo'] ?? null, ['jpg', 'jpeg', 'png'],
    ['image/jpeg', 'image/png'], 2 * 1024 * 1024, 'Photo', false);
if ($photo) $attachments[] = $photo;

$body  = "New career application from the MME website\n";
$body .= "----------------------------------------\n";
$body .= "Role Applied For : $role\n";
$body .= "Full Name        : $fullName\n";
$body .= "Date of Birth    : $dob\n";
$body .= "Gender           : $gender\n";
$body .= "Phone            : $phone\n";
$body .= "Email            : $email\n";
$body .= "Qualification    : $qualification\n";
$body .= "Marital Status   : " . ($maritalStatus !== '' ? $maritalStatus : '—') . "\n";
$body .= "Address          : $address\n";
$body .= "----------------------------------------\n";
$body .= "Attachments      : " . (count($attachments) ? implode(', ', array_map(fn($a) => $a['name'], $attachments)) : 'none') . "\n";
$body .= "Submitted: " . date('d M Y, H:i') . " | IP: " . ($_SERVER['REMOTE_ADDR'] ?? '');

$subject = 'Career Application — ' . $fullName . ' (' . $role . ')';
$sent = send_mail($subject, $body, sanitize_header($email), $attachments);
log_submission('career', compact('role', 'fullName', 'email', 'phone') + ['sent' => $sent]);

if ($sent) {
    json_response(true, 'Your application and resume have been emailed to our HR team.');
}
json_response(false, 'Your application could not be sent right now. Please email ' . FORM_RECIPIENT . ' directly.', 502);
