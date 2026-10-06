<?php
/**
 * Shared secure form-processing helpers for the contact & career forms.
 * Uses PHP mail() (per project configuration) with a properly built
 * multipart message so file attachments are delivered correctly.
 */
require_once __DIR__ . '/../includes/config.php';

/** Always answer with JSON and stop. */
function json_response($ok, $message, $code = 200) {
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => (bool)$ok, 'message' => $message]);
    exit;
}

/** Reject anything that is not a POST request. */
function require_post() {
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
        json_response(false, 'Invalid request method.', 405);
    }
}

/** Basic per-session + per-IP rate limiting (spam protection). */
function rate_limit($key, $maxPerWindow = 5, $windowSeconds = 600) {
    $now = time();
    $bucket = $_SESSION['rate'][$key] ?? [];
    $bucket = array_values(array_filter($bucket, fn($t) => ($now - $t) < $windowSeconds));
    if (count($bucket) >= $maxPerWindow) {
        json_response(false, 'Too many submissions. Please try again later.', 429);
    }
    $bucket[] = $now;
    $_SESSION['rate'][$key] = $bucket;
}

/** Trim + strip control chars from a scalar field. */
function slen($v) {
    return function_exists('mb_strlen') ? mb_strlen((string)$v) : strlen((string)$v);
}
function clean($v) {
    $v = is_string($v) ? trim($v) : '';
    return preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $v);
}

/** Guard email-header injection in a single-line value. */
function sanitize_header($v) {
    return str_replace(["\r", "\n", "%0a", "%0d"], '', clean($v));
}

/** Validate an uploaded file (existence, size, extension + MIME). */
function validate_upload($file, $allowedExt, $allowedMime, $maxBytes, $label, $required) {
    if (!$file || !isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE || $file['size'] === 0) {
        if ($required) json_response(false, "$label is required.", 422);
        return null;
    }
    if ($file['error'] !== UPLOAD_ERR_OK) json_response(false, "Could not upload $label. Please try again.", 422);
    if ($file['size'] > $maxBytes) json_response(false, "$label exceeds the maximum allowed size.", 422);
    if (!is_uploaded_file($file['tmp_name'])) json_response(false, "Invalid $label upload.", 422);
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) json_response(false, "$label has an unsupported file type.", 422);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    if (!in_array($mime, $allowedMime, true)) json_response(false, "$label failed file-type validation.", 422);
    return ['name' => preg_replace('/[^A-Za-z0-9._-]/', '_', basename($file['name'])), 'tmp' => $file['tmp_name'], 'mime' => $mime];
}

/**
 * Send an email (optionally with attachments) via PHP mail().
 * @param array $attachments each ['name','tmp','mime']
 */
function send_mail($subject, $bodyText, $replyTo = '', $attachments = []) {
    $to = FORM_RECIPIENT;
    $from = 'website@' . (preg_replace('/^www\./', '', $_SERVER['HTTP_HOST'] ?? 'mmepl.co.in'));
    $boundary = '=_mme_' . bin2hex(random_bytes(12));

    $headers = [];
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'From: MME Website <' . $from . '>';
    if ($replyTo) $headers[] = 'Reply-To: ' . $replyTo;
    $headers[] = 'X-Mailer: PHP/' . phpversion();

    if ($attachments) {
        $headers[] = 'Content-Type: multipart/mixed; boundary="' . $boundary . '"';
        $body  = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $body .= $bodyText . "\r\n";
        foreach ($attachments as $a) {
            $data = chunk_split(base64_encode(file_get_contents($a['tmp'])));
            $body .= "--$boundary\r\n";
            $body .= 'Content-Type: ' . $a['mime'] . '; name="' . $a['name'] . "\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n";
            $body .= 'Content-Disposition: attachment; filename="' . $a['name'] . "\"\r\n\r\n";
            $body .= $data . "\r\n";
        }
        $body .= "--$boundary--";
    } else {
        $headers[] = 'Content-Type: text/plain; charset=UTF-8';
        $body = $bodyText;
    }

    $subjectEnc = '=?UTF-8?B?' . base64_encode($subject) . '?=';
    return @mail($to, $subjectEnc, $body, implode("\r\n", $headers));
}

/** Append a submission to the local log (fallback record even if mail fails). */
function log_submission($type, $data) {
    $dir = __DIR__ . '/../logs';
    if (!is_dir($dir)) @mkdir($dir, 0755, true);
    $line = '[' . date('c') . '] ' . strtoupper($type) . ' ' . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n";
    @file_put_contents($dir . '/submissions.log', $line, FILE_APPEND | LOCK_EX);
}
