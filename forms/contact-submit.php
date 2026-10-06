<?php
require_once __DIR__ . '/mailer.php';
require_post();

// CSRF
if (!csrf_verify('contact', $_POST['csrf_token'] ?? '')) {
    json_response(false, 'Your session expired. Please refresh the page and try again.', 419);
}
// Honeypot (bots fill hidden field)
if (!empty($_POST['website'])) {
    json_response(true, 'Thank you. Your message has been received.');
}
rate_limit('contact');

$name    = clean($_POST['name'] ?? '');
$email   = clean($_POST['email'] ?? '');
$phone   = clean($_POST['phone'] ?? '');
$office  = clean($_POST['office'] ?? '');
$message = clean($_POST['message'] ?? '');

if ($name === '' || $email === '' || $message === '') {
    json_response(false, 'Name, email and message are required.', 422);
}
if (slen($name) > 120 || slen($message) > 5000) {
    json_response(false, 'One of the fields is too long.', 422);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    json_response(false, 'Please enter a valid email address.', 422);
}

$body  = "New enquiry from the MME website\n";
$body .= "----------------------------------------\n";
$body .= "Name           : $name\n";
$body .= "Email          : $email\n";
$body .= "Phone          : " . ($phone !== '' ? $phone : '—') . "\n";
$body .= "Preferred Office: " . ($office !== '' ? $office : '—') . "\n";
$body .= "----------------------------------------\n";
$body .= "Message:\n$message\n";
$body .= "----------------------------------------\n";
$body .= "Submitted: " . date('d M Y, H:i') . " | IP: " . ($_SERVER['REMOTE_ADDR'] ?? '');

$subject = 'Website Enquiry — ' . $name;
$sent = send_mail($subject, $body, sanitize_header($email));
log_submission('contact', compact('name', 'email', 'phone', 'office') + ['sent' => $sent]);

if ($sent) {
    json_response(true, 'Your enquiry has been emailed to our team.');
}
json_response(false, 'Your enquiry could not be sent right now. Please email ' . FORM_RECIPIENT . ' directly.', 502);
