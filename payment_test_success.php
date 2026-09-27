<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$method = isset($_GET['method']) ? $_GET['method'] : '';
$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

// If order_id is present, fetch its latest status for a clean UI
$orderStatus = '';
if ($order_id > 0) {
    $user_id = (int)$_SESSION['user_id'];
    $check = mysqli_query($conn, "SELECT order_status FROM orders WHERE id='" . $order_id . "' AND user_id='" . $user_id . "' LIMIT 1");
    if ($check && mysqli_num_rows($check) > 0) {
        $row = mysqli_fetch_assoc($check);
        $orderStatus = $row['order_status'] ?? '';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Result</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include("includes/navbar.php"); ?>
<div class="container">
    <h2>Payment Successful (Test)</h2>
    <p><b>Order ID:</b> <?php echo $order_id; ?></p>
    <?php if($orderStatus !== ''){ echo "<p><b>Current Status:</b> ".htmlspecialchars($orderStatus)."</p>"; } ?>
    <?php if($method !== ''){ echo "<p><b>Method:</b> ".htmlspecialchars($method)."</p>"; } ?>
    <p><a href="orders.php">Go to My Orders</a></p>
</div>
</body>
</html>

