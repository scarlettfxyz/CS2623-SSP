<?php
declare(strict_types=1);
?>
    <!DOCTYPE html>
        <html lang="en">
        <head>
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
        </main>
    </body>
</html>