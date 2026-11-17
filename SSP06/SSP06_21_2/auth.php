<?php
declare(strict_types=1);

// auth.php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}