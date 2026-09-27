<?php
// Backward-compatible DB connector for the existing mysqli-based code.
// The project credentials live in config.php; we reuse them here.
require_once __DIR__ . '/../config.php';

// If config.php already created $conn as mysqli, keep it.
if (!isset($conn) || !($conn instanceof mysqli)) {
    // Create mysqli connection using the same credentials.
    $conn = mysqli_init();
    mysqli_options($conn, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
    mysqli_real_connect(
        $conn,
        DB_HOST,
        DB_USERNAME,
        DB_PASSWORD,
        DB_DATABASE,
        (int)DB_PORT
    );

    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }
}
?>
