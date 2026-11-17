<?php
declare(strict_types=1);

require __DIR__ . '/../SSP06_21_2/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['cart']);
}

header('Location: index.php', true, 303);
exit;