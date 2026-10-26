<?php
declare(strict_types=1);

/*
 * CS2623 SSP04: string functions
 */

// sample product
$description = 'A soft blue plush cat with embroidered stars.';
$price = 19.9;
$quantity = 1250000;

$purpleDescription = str_replace('blue', 'purple', $description);
$containsBlue = str_contains($description, 'blue');
$lowercaseDescription = strtolower($description);
$uppercaseDescription = strtoupper($description);
$descriptionLength = strlen($description);
$formattedPrice = sprintf('$%.2f', $price);
$formattedQuantity = number_format($quantity);
$descriptionBeginning = substr($description, 0, 11);

// organize the demonstrations into function, input, and output columns.
$rows = [
    ['Original description', $description, $description],
    ['str_replace()', $description, $purpleDescription],
    ['str_contains(): blue', $description, $containsBlue ? 'true' : 'false'],
    ['strtolower()', $description, $lowercaseDescription],
    ['strtoupper()', $description, $uppercaseDescription],
    ['strlen()', $description, (string) $descriptionLength],
    ['sprintf()', (string) $price, $formattedPrice],
    ['number_format()', (string) $quantity, $formattedQuantity],
    ['substr(): first 11 characters', $description, $descriptionBeginning]
];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content="LastName, FirstName">
            <meta name="description" content="CS2623 SSP04 PHP string demonstrations">
            <title>CS2623 SSP04: string functions</title>
            <link rel="stylesheet" href="main.css">
    </head>
    <body>
            <header>
                <h1>PHP String Functions</h1>
            </header>

            <nav aria-label="Assignment navigation">
                    <a href="../../SSP01/index.php">Home</a>
                    <a href="../../SSP02/SSP02.php">SSP02</a>
                    <a href="../SSP03/index.php">SSP03</a>
                    <a href="ex1_strings.php">SSP04: Strings</a>
                    <a href="ex2_datetime.php">SSP04: Dates</a>
            </nav>

            <main>
                <!-- show each operation and result -->
                <table id="string-results">
                    <caption>Product Description String Demonstrations</caption>
                    <thead>
                        <tr>
                            <th scope="col">Function</th>
                            <th scope="col">Input</th>
                            <th scope="col">Output</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // output each row, escaping every cells text
                        foreach ($rows as $row) {
                            echo "<tr>\n";

                            foreach ($row as $cell) {
                                echo '<td>'
                                    . htmlspecialchars($cell, ENT_QUOTES, 'UTF-8')
                                    . "</td>\n";
                            }

                            echo "</tr>\n";
                        }
                        ?>
                    </tbody>
                </table>
            </main>

            <footer>
                <p>
                    <strong>Disclaimer:</strong> Oklahoma City Community College does not necessarily
                    endorse the content or the respective links of this web page.
                </p>
            </footer>
    </body>
</html>