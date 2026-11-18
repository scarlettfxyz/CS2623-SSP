<?php declare(strict_types=1);
$dataDir = __DIR__ . '/data/';
$logFile = $dataDir . 'log.txt';
$message = '';
$fileContent = '';

// Create data directory if it doesn't exist
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Handle form POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = filter_input(INPUT_POST, 'action') ?? 'save';

    if ($action === 'clear') {
        $saved = file_put_contents($logFile, '', LOCK_EX);
        $message = $saved !== false
            ? 'Log cleared.'
            : 'Unable to clear the log.';
    } elseif ($action === 'save') {
        $entry = trim((string) (
            filter_input(INPUT_POST, 'entry', FILTER_DEFAULT) ?? ''
        ));

        if ($entry !== '') {
            $now = new DateTime('now', new DateTimeZone('America/Chicago'));
            $line = $now->format('Y-m-d H:i:s') . ' — ' . $entry . PHP_EOL;

            $saved = file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
            $message = $saved !== false
                ? 'Entry saved.'
                : 'Unable to save the entry.';
        } else {
            $message = 'Entry cannot be empty.';
        }
    }
}

// Apply Unix file permissions when running on filezilla server
if (is_file($logFile) && PHP_OS_FAMILY !== 'Windows') {
    chmod($logFile, 0644);
}

if (filter_input(INPUT_GET, 'action') === 'download') {
    if (!is_file($logFile)) {
        http_response_code(404);
        exit('No log file is available to download.');
    }

    header('Content-Type: text/plain; charset=UTF-8');
    header('Content-Disposition: attachment; filename="log.txt"');
    readfile($logFile);
    exit;
}

// Read log file
if (file_exists($logFile)) {
    $fileContent = file_get_contents($logFile);
}

// List files in data directory
$files = array_filter(
    scandir($dataDir),
    fn($f) => is_file($dataDir . $f)
);

// Clear file status cache to ensure accurate file size
clearstatcache(true, $logFile);
$logSize = is_file($logFile) ? filesize($logFile) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ex 16-1 File I/O</title>
</head>
<body>
    <h1>File Log Demo</h1>

    <?php if ($message): ?>
        <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form method="post">
        <label>
            New log entry:
            <input type="text" name="entry" maxlength="200">
        </label>
        <button type="submit">Save Entry</button>

        <form method="post">
            <button type="submit" name="action" value="clear">Clear Log</button>
        </form>
    </form>

    <p><a href="?action=download">Download Log</a></p>
    <p>Log size: <?= htmlspecialchars(number_format((float) $logSize), ENT_QUOTES, 'UTF-8') ?> bytes</p>

    <h2>Log Contents</h2>
    <?php if ($fileContent !== ''): ?>
        <pre><?= htmlspecialchars($fileContent, ENT_QUOTES, 'UTF-8') ?></pre>
    <?php else: ?>
        <p>No entries yet.</p>
    <?php endif; ?>

    <h2>Files in /data/</h2>
    <ul>
        <?php foreach ($files as $f): ?>
            <li><?= htmlspecialchars(basename($f), ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
    </ul>
    <p><a href="../index.html">Back to index...</a></p>
</body>
</html>