<?php
declare(strict_types=1);
    ?>
    <!DOCTYPE html>
        <html lang="en">
        <head>
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
        </main>
    </body>
</html>