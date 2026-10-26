<?php
declare(strict_types=1);

/*
 * CS2623 SSP04: dates and times
 */

// get current date in relevant timezone
$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);

$today_name = $now->format('l');
$today_date = $now->format('F j, Y');
$today_time = $now->format('g:i:s A T');

$birth_str = '2005-12-19';
$birth_date = DateTime::createFromFormat('!Y-m-d', $birth_str, $tz);

// stop if bd cant be parsed
if ($birth_date === false) {
    exit('Unable to parse the birthdate.');
}

// diff() returns a DateInterval describing the elapsed time
$age_interval = $birth_date->diff($now);

$end_date = new DateTime('2026-12-17 00:00:00', $tz);
$countdown = $now->diff($end_date);

// handle both dates
if ($now < $end_date) {
    $countdown_text = $countdown->days . ' full days remaining';
} else {
    $countdown_text = 'The event date has arrived or passed.';
}


?>
<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content="LastName, FirstName">
            <meta name="description" content="CS2623 SSP04 date and time demonstrations">
            <title>CS2623 SSP04: Dates and Times</title>
            <link rel="stylesheet" href="main.css">
        </head>
    <body>
        <header>
            <h1>PHP Dates and Times</h1>
        </header>

        <nav aria-label="Assignment navigation">
                <a href="../../SSP01.php">Home</a>
                <a href="../CS2623-SSP/SSP02/SSP02.php">SSP02</a>
                <a href="../SSP03/index.php">SSP03</a>
                <a href="ex1_strings.php">SSP04: Strings</a>
                <a href="ex2_datetime.php">SSP04: Dates</a>
        </nav>

        <main>
            <section>
                    <h2>Current Central Date and Time</h2>

                    <p>
                        Today is:
                        <?php
                        echo htmlspecialchars(
                            $today_name . ', ' . $today_date,
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        ?>
                    </p>

                    <p>
                        Current time:
                        <?php
                        echo htmlspecialchars($today_time, ENT_QUOTES, 'UTF-8');
                        ?>
                    </p>

                    <p>The time updates when you refresh the page...</p>
            </section>

            <section>
                    <h2>Time Since Birthdate</h2>

                    <p>
                        Age in complete years:
                        <?php
                        echo htmlspecialchars(
                            (string) $age_interval->y,
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        ?>
                    </p>

                    <p>
                        Total full days elapsed:
                        <?php
                        echo htmlspecialchars(
                            (string) $age_interval->days,
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        ?>
                    </p>
            </section>

            <section>
                    <h2>Countdown!!!</h2>

                    <p>
                        Target date:
                        <?php
                        echo htmlspecialchars(
                            $end_date->format('F j, Y'),
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        ?>
                    </p>

                    <p>
                        <?php
                        echo htmlspecialchars($countdown_text, ENT_QUOTES, 'UTF-8');
                        ?>
                    </p>
            </section>
        </main>

        <footer>
                <p>
                    Disclaimer: Oklahoma City Community College does not necessarily
                    endorse the content or the respective links of this web page.
                </p>
        </footer>
    </body>
</html>