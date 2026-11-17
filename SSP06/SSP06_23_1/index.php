<?php
declare(strict_types=1);

require __DIR__ . '/../SSP06_21_2/auth.php';

// Product catalog
$products = [
    1 => ['id' => 1, 'name' => 'Fender Stratocaster', 'price' => 499.99],
    2 => ['id' => 2, 'name' => 'Gibson Les Paul', 'price' => 799.99],
    3 => ['id' => 3, 'name' => 'Martin D-28 Acoustic', 'price' => 1299.99],
    4 => ['id' => 4, 'name' => 'Ibanez RG550', 'price' => 299.99],
];

// Initialize cart
$_SESSION['cart'] ??= []; 

// Handle "Add to cart" POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $action = filter_input(INPUT_POST, 'action') ?? 'add';

    if (is_int($id) && isset($products[$id])) {
        if ($action === 'add') {
            $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
        } elseif ($action === 'remove' && isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]--;

            if ($_SESSION['cart'][$id] === 0) {
                unset($_SESSION['cart'][$id]);
            }
        }
    }

    header('Location: index.php');
    exit;
}

// Calculate cart total
$total = 0.0;
foreach ($_SESSION['cart'] as $pid => $qty) {
    if (isset($products[$pid])) {
        $total += $products[$pid]['price'] * $qty;
    }
}
?>

<!-- Product catalog display -->
<?php foreach ($products as $p): ?>
    <div class="product">
        <h3><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></h3>
        <p>$<?= number_format($p['price'], 2) ?></p>
        <form method="post">
            <input
                type="hidden"
                name="product_id"
                value="<?= (int) $p['id'] ?>"
            >
            <button type="submit">Add to Cart</button>
        </form>
    </div>
<?php endforeach; ?>

<!-- Cart display -->
<h2>Your Cart</h2>
<?php if (empty($_SESSION['cart'])): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>
        <?php foreach ($_SESSION['cart'] as $pid => $qty): ?>
            <?php if (isset($products[$pid])): ?>
                <tr>
                    <td><?= htmlspecialchars($products[$pid]['name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= (int) $qty ?></td>
                    <td>$<?= number_format($products[$pid]['price'] * $qty, 2) ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="product_id" value="<?= (int) $pid ?>">
                            <button type="submit" name="action" value="remove">Remove one</button>
                        </form>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
            <tr>
                <td colspan="2"><strong>Total</strong></td>
                <td><strong>$<?= number_format($total, 2) ?></strong></td>
                <td></td>
            </tr>
    </table>
<?php endif; ?>

<a href="cart_clear.php">Clear Cart</a>