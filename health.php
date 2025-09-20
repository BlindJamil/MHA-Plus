<?php
header('Content-Type: text/plain; charset=utf-8');

$results = [];

$results['php_version'] = PHP_VERSION;
$results['cwd'] = getcwd();
$results['document_root'] = $_SERVER['DOCUMENT_ROOT'] ?? '';

$paths = [
  'root' => __DIR__,
  'public_index' => __DIR__ . '/public/index.php',
  'vendor_autoload' => __DIR__ . '/vendor/autoload.php',
  'env' => __DIR__ . '/.env',
  'storage' => __DIR__ . '/storage',
  'storage_logs' => __DIR__ . '/storage/logs',
  'storage_log_file' => __DIR__ . '/storage/logs/laravel.log'
];

foreach ($paths as $k => $p) {
  $results['exists'][$k] = file_exists($p) ? 'yes' : 'no';
}

$results['writable']['storage'] = is_writable($paths['storage']) ? 'yes' : 'no';
$results['writable']['storage_logs'] = is_writable($paths['storage_logs']) ? 'yes' : 'no';

// Try to include composer autoload without failing hard
$autoloadOk = file_exists($paths['vendor_autoload']);
$results['vendor_autoload'] = $autoloadOk ? 'present' : 'missing';

// Tail last 50 lines of laravel log if exists
$log = '';
if (file_exists($paths['storage_log_file'])) {
  $lines = @file($paths['storage_log_file']);
  if ($lines !== false) {
    $tail = array_slice($lines, -50);
    $log = implode('', $tail);
  }
}

$status = [
  'ok' => $autoloadOk && file_exists($paths['public_index']),
  'hint' => !$autoloadOk ? 'Run composer install in production.' : 'Front controller exists.'
];

echo "HEALTH CHECK\n";
echo str_repeat('=', 40) . "\n";
print_r($results);
echo str_repeat('=', 40) . "\n";
print_r($status);
echo "\n";
if ($log) {
  echo str_repeat('-', 40) . "\nLOG TAIL (storage/logs/laravel.log)\n";
  echo $log;
}
