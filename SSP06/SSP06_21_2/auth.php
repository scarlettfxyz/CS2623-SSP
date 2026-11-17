<?php
declare(strict_types=1);

// auth.php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

header('Location: ../SSP06_21_2/login.php');