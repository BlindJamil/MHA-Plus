<?php
declare(strict_types=1);

/**
 * Universal front controller for shared hosting (Hostinger-friendly)
 * - Prefer Laravel public/index.php if present
 * - Fallback to WordPress
 * - Then static index.html
 * - Else show a simple info page
 */

// Suppress display of errors in web output; logs should capture them
@ini_set('display_errors', '0');
error_reporting(E_ALL);

$publicIndex = __DIR__ . '/public/index.php';
if (is_file($publicIndex)) {
    chdir(dirname($publicIndex));
    $_SERVER['SCRIPT_FILENAME'] = $publicIndex;
    $_SERVER['SCRIPT_NAME']     = '/index.php';
    $_SERVER['PHP_SELF']        = '/index.php';
    require $publicIndex;
    exit;
}

// WordPress fallback
$wpHeader = __DIR__ . '/wp-blog-header.php';
if (is_file($wpHeader)) {
    if (!defined('WP_USE_THEMES')) define('WP_USE_THEMES', true);
    require $wpHeader;
    exit;
}

// Static fallbacks
$rootIndexHtml   = __DIR__ . '/index.html';
$publicIndexHtml = __DIR__ . '/public/index.html';
if (is_file($rootIndexHtml)) { readfile($rootIndexHtml); exit; }
if (is_file($publicIndexHtml)) { readfile($publicIndexHtml); exit; }

http_response_code(503);
header('Content-Type: text/html; charset=utf-8');
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Site not ready</title>
  <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;margin:0;padding:2rem;color:#0f172a;background:#f8fafc}
    .card{max-width:720px;margin:10vh auto;background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:1.5rem 1.75rem;box-shadow:0 10px 20px rgba(2,6,23,.05)}
    h1{font-size:1.25rem;margin:0 0 .5rem}
    code{background:#f1f5f9;padding:.15rem .4rem;border-radius:6px}
    ul{margin:.75rem 0 0 1.25rem}
  </style>
</head>
<body>
  <div class="card">
    <h1>Site is almost ready</h1>
    <p>No application entry point found.</p>
    <ul>
      <li>For Laravel, ensure <code>public/index.php</code> exists and vendor deps are installed.</li>
      <li>For WordPress, upload core files including <code>wp-blog-header.php</code>.</li>
      <li>For a static site, place <code>index.html</code> in root or <code>/public</code>.</li>
    </ul>
  </div>
</body>
</html>
