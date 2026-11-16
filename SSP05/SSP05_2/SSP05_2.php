<?php
declare(strict_types=1);

    $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD')
        ?? ($_SERVER['REQUEST_METHOD'] ?? 'GET');

        $errors = [];
        $customer = '';
        $product = '';
        $quantity = null;
        $payment = '';
        $instructions = '';
        $options = [];

    if ($method === 'POST') {
        $customer = trim((string) (filter_input(INPUT_POST, 'cust_name') ?? ''));
        $product = (string) (filter_input(INPUT_POST, 'product') ?? '');
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1],

        ]);
        $payment = (string) (filter_input(INPUT_POST, 'payment') ?? '');
        $instructions = (string) (filter_input(INPUT_POST, 'instructions') ?? '');


        $options = filter_input(
            INPUT_POST,
            'options',
            FILTER_SANITIZE_SPECIAL_CHARS,
            FILTER_REQUIRE_ARRAY
        ) ?? [];


        if (!is_array($options)) {
            $options = [];
        }

        if ($customer === '') {
            $errors[] = 'Enter a customer name.';
        }
        if ($product === '') {
            $errors[] = 'Select a product.';
        }
        if (!is_int($quantity)) {
            $errors[] = 'Enter a whole-number quantity of at least 1.';
        }
        if (!in_array($payment, ['credit', 'debit', 'paypal'], true)) {
            $errors[] = 'Select a payment method.';
        }
    }
?>

    <!DOCTYPE html>
        <html lang="en">
        <head>
            <link rel="stylesheet" href="main.css">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SSP05 Exercise 7-2 — Product Order Form</title>
        </head>
    <body>
        <main>
            <h1>Product Order Form</h1>
            <p><a href="../index.html">back to index</a></p>

            <form action="SSP05_2.php" method="post">
                <p>
                    <label for="cust_name">Customer name:</label>
                        <input type="text" id="cust_name" name="cust_name" required>
                </p>

                <p>
                    <label for="product">Product:</label>
                    <select id="product" name="product" required>
                        <option value="">Select a product</option>
                        <option value="Star Notebook">Star Notebook — $6.00</option>
                        <option value="Sticker Sheet">Sticker Sheet — $3.50</option>
                        <option value="Plush Keychain">Plush Keychain — $12.00</option>
                        <option value="Canvas Tote">Canvas Tote — $15.00</option>
                    </select>
                </p>

                <p>
                    <label for="quantity">Quantity:</label>
                        <input type="text" id="quantity" name="quantity"
                            inputmode="numeric" value="1" required>
                </p>

                <fieldset>
                    <legend>Add-ons</legend>
                        <label><input type="checkbox" name="options[]" value="Gift wrap"> Gift wrap</label>
                        <label><input type="checkbox" name="options[]" value="Express shipping"> Express shipping</label>
                        <label><input type="checkbox" name="options[]" value="Insurance"> Insurance</label>
                </fieldset>

                <p>
                    <label for="instructions">Special instructions:</label><br>
                        <textarea id="instructions" name="instructions" rows="4" cols="35"></textarea>
                </p>

                <fieldset>
                    <legend>Payment method</legend>
                        <label><input type="radio" name="payment" value="credit" required> Credit</label>
                        <label><input type="radio" name="payment" value="debit"> Debit</label>
                        <label><input type="radio" name="payment" value="paypal"> PayPal</label>
                </fieldset>

                <p><button type="submit">Submit order</button></p>
            </form>
<?php if ($method === 'POST'): ?>
    <?php if ($errors !== []): ?>
        <section>
            <h2>Please correct your order</h2>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
            <?php else: ?>
                <section>
                    <h2>Order Summary</h2>

                    <p><strong>Customer:</strong>
                        <?= htmlspecialchars($customer, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p><strong>Product:</strong>
                        <?= htmlspecialchars($product, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p><strong>Quantity:</strong>
                        <?= htmlspecialchars((string) $quantity, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <p><strong>Payment:</strong>
                        <?= htmlspecialchars($payment, ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <h3>Selected Add-ons</h3>
                    <?php if ($options === []): ?>
                        <p>None selected.</p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($options as $option): ?>
                                <li><?= htmlspecialchars((string) $option, ENT_QUOTES, 'UTF-8') ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <p><strong>Special instructions:</strong><br>
                        <?= nl2br(htmlspecialchars($instructions, ENT_QUOTES, 'UTF-8')) ?>
                    </p>
                </section>
            <?php endif; ?>
        <?php endif; ?>
        </main>
    </body>
</html>