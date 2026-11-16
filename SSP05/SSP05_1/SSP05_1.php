<?php
declare(strict_types=1);

        $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD')
            ?? ($_SERVER['REQUEST_METHOD'] ?? 'GET');

    if ($method === 'POST') {
            $first = filter_input(INPUT_POST, 'first_name') ?? '';
            $last = filter_input(INPUT_POST, 'last_name') ?? '';
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
            $gender = filter_input(INPUT_POST, 'gender') ?? 'Not specified';
            $country = filter_input(INPUT_POST, 'country') ?: 'Not specified';
            $comments = filter_input(INPUT_POST, 'comments') ?? '';
    }
?>

    <!DOCTYPE html>
        <html lang="en">
        <head>
            <link rel="stylesheet" href="main.css">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SSP05 Exercise 7-1: Personal Info Form</title>
        </head>
    <body>
        <main>
            <h1>Personal Info Form</h1>
            <p><a href="../index.html">back to index</a></p>

            <form action="SSP05_1.php" method="post">
                <p>
                    <label for="first_name">First name:</label>
                        <input type="text" id="first_name" name="first_name" required>
                </p>

                <p>
                    <label for="last_name">Last name:</label>
                        <input type="text" id="last_name" name="last_name" required>
                </p>

                <p>
                    <label for="email">Email:</label>
                        <input type="email" id="email" name="email">
                </p>

                <p>
                    <label for="age">Age:</label>
                        <input type="text" id="age" name="age" inputmode="numeric">
                </p>

                <fieldset>
                    <legend>Gender</legend>
                        <label><input type="radio" name="gender" value="male"> Male</label>
                        <label><input type="radio" name="gender" value="female"> Female</label>
                        <label><input type="radio" name="gender" value="other"> Other</label>
                </fieldset>

                <p>
                    <label for="country">Country:</label>
                        <select id="country" name="country">
                            <option value="">Select a country</option>
                            <option value="United States">United States</option>
                            <option value="Canada">Canada</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Japan">Japan</option>
                            <option value="United Kingdom">United Kingdom</option>
                        </select>
                </p>

                <p>
                    <label for="comments">Comments:</label><br>
                        <textarea id="comments" name="comments" rows="4" cols="35"></textarea>
                </p>

                <button type="submit">Submit</button>
            </form>

                <?php if ($method === 'POST'): ?>
                    <section>
                        <h2>Submitted Information</h2>

                        <p><strong>Name:</strong>
                            <?= htmlspecialchars($first . ' ' . $last, ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <p><strong>Email:</strong>
                            <?= htmlspecialchars($email ?: '(missing or invalid)', ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <p><strong>Age:</strong>
                            <?= htmlspecialchars(is_int($age) ? (string) $age : '(missing or invalid)', ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <p><strong>Gender:</strong>
                            <?= htmlspecialchars($gender, ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <p><strong>Country:</strong>
                            <?= htmlspecialchars($country, ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <p><strong>Comments:</strong><br>
                            <?= nl2br(htmlspecialchars($comments, ENT_QUOTES, 'UTF-8')) ?>
                        </p>
                    </section>
                <?php endif; ?>


        </main>
    </body>
</html>