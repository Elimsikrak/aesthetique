<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['order_id'])) {
    die('Missing order_id');
}

$order_id = (int)$_GET['order_id'];
$user_id = (int)$_SESSION['user_id'];

// Ensure order belongs to current user
$check = mysqli_query($conn, "SELECT * FROM orders WHERE id='" . $order_id . "' AND user_id='" . $user_id . "' LIMIT 1");
if (mysqli_num_rows($check) === 0) {
    die('Invalid order');
}

$amount = 0;
$row = mysqli_fetch_assoc($check);
if ($row && isset($row['total'])) {
    $amount = (float)$row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Test Payment</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include("includes/navbar.php"); ?>

<div class="container">
    <h2>Payment (Test)</h2>
    <p><b>Order ID:</b> <?php echo $order_id; ?></p>
    <p><b>Amount:</b> Rs. <?php echo number_format($amount, 2); ?></p>

    <h3>Select Payment Method (Test)</h3>

    <div style="display:flex;flex-wrap:wrap;gap:10px;">
        <?php
        $methods = [
            'Khalti' => 'KHALTI',
            'eSewa' => 'ESEWA',
            'eBanking' => 'EBANKING',
            'IME Pay' => 'IMEPAY',
            'Connect IPS' => 'CONNECTIPS',
        ];

        foreach ($methods as $label => $method) {
            echo '<a class="btn" style="text-decoration:none;" href="payment_test_callback.php?order_id=' . $order_id . '&status=success&method=' . $method . '">' . $label . ' (Pay Successful)</a> ';
            echo '<a class="btn" style="text-decoration:none;" href="payment_test_callback.php?order_id=' . $order_id . '&status=failed&method=' . $method . '">' . $label . ' (Fail)</a><br/>';
        }
        ?>
    </div>

    <p style="margin-top:20px;"><a href="orders.php">← Back to Orders</a></p>
</div>
</body>
</html>

