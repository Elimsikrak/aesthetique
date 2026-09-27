<?php
session_start();
include("includes/db.php");

// Simple fake callback for testing: ?order_id=ID&status=success|failed&method=...
// In real gateways you'd verify signature.

if (!isset($_GET['order_id'])) {
    die('Missing order_id');
}

$order_id = (int)$_GET['order_id'];
$status = isset($_GET['status']) ? $_GET['status'] : 'success';
$method = isset($_GET['method']) ? $_GET['method'] : 'TEST';

$finalStatus = ($status === 'failed') ? 'Payment Failed' : 'Paid';

// Update order status
mysqli_query(
    $conn,
    "UPDATE orders SET order_status='" . mysqli_real_escape_string($conn, $finalStatus) . "' WHERE id='" . $order_id . "'"
);

// Redirect to success page on success, otherwise go back to orders
$redirect = ($status === 'failed') ? "orders.php" : "payment_test_success.php";

$qs = "?order_id=" . $order_id;
if ($status !== 'failed') {
    $qs .= "&method=" . urlencode($method);
}

echo "<script>\n";
echo "alert('Payment " . ($status === 'failed' ? 'Failed' : 'Successful') . "');\n";
echo "window.location='" . $redirect . "'" . $qs . ";\n";
echo "</script>";

exit;
?>

