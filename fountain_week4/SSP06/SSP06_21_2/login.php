<?php
declare(strict_types=1);

session_start();

// Simulated user store — in production this is a DB query
$users = [
    'admin' => password_hash('secret123', PASSWORD_DEFAULT),
    'jsmith' => password_hash('php4life!', PASSWORD_DEFAULT),
];

$error = '';
$_SESSION['attempts'] ??= 0;

$rememberedUsername = (string) (
    filter_input(INPUT_COOKIE, 'ssp06_username', FILTER_DEFAULT) ?? ''
);

if ($_SESSION['attempts'] >= 3) {
    $error = 'Too many failed attempts. Login is locked for this session.';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) (
        filter_input(INPUT_POST, 'username', FILTER_DEFAULT) ?? ''
    ));
    $password = (string) (
        filter_input(INPUT_POST, 'password', FILTER_DEFAULT) ?? ''
    );

    if (isset($users[$username]) && password_verify($password, $users[$username])) {
        session_regenerate_id(true);
        $_SESSION['user'] = $username;
        $_SESSION['login_at'] = time();
        $_SESSION['attempts'] = 0;

        $remember = filter_input(INPUT_POST, 'remember') === '1';

        setcookie('ssp06_username', $remember ? $username : '', [
            'expires' => $remember ? time() + 30 * 24 * 60 * 60 : time() - 3600,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        header('Location: dashboard.php');
        exit;
    }

    $_SESSION['attempts']++;

    if ($_SESSION['attempts'] >= 3) {
        $error = 'Too many failed attempts. Login is locked for this session.';
    } else {
        $remaining = 3 - $_SESSION['attempts'];
        $error = "Invalid username or password. Attempts remaining: $remaining.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if ($error): ?>
        <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form method="post">
            <label>Username:
                <input type="text" name="username" autocomplete="username"
                    value="<?= htmlspecialchars($rememberedUsername, ENT_QUOTES, 'UTF-8') ?>">
            </label><br>

            <label>Password:
                <input type="password" name="password" autocomplete="current-password" required>
            </label><br>

            <label>
                <input type="checkbox" name="remember" value="1"
                    <?= $rememberedUsername !== '' ? 'checked' : '' ?>>
                Remember me!
            </label><br>
        <button type="submit">Log in</button>
    </form>
</body>
</html>