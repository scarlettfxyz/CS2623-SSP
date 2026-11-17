<?php
declare(strict_types=1);

require __DIR__ . '/auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Profile</title>

</head>
    <body>
        <main>
            <h1>Your Profile</h1>
            <p>Username: <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?></p>
            <p><a href="dashboard.php">Back to dashboard</a></p>
        </main>
        
    </body>
</html>