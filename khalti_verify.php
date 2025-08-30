<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Not logged in.'); window.location.href='login_form.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = $_GET['purchase_order_id'] ?? null;
$pidx = $_GET['pidx'] ?? null;

if (!$order_id || !$pidx) {
    die("Invalid response from Khalti.");
}

// Verify payment with Khalti
$ch = curl_init("https://dev.khalti.com/api/v2/epayment/lookup/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Key " . KHALTI_SECRET_KEY,
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["pidx" => $pidx]));
$response = curl_exec($ch);
$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http !== 200) {
    echo "<pre>Lookup failed (HTTP $http)\n" . htmlspecialchars($response) . "</pre>";
    exit;
}

$data = json_decode($response, true);
$status = $data['status'] ?? 'Failed';

if ($status === 'Completed') {
    // ✅ Update order as paid
    $stmt = $conn->prepare("UPDATE orders SET payment_status='paid', status='pending' WHERE order_id=? AND user_id=?");
    $stmt->bind_param("ii", $order_id, $user_id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Payment successful! Order placed.'); window.location.href='order_confirmation.php';</script>";
    exit();
} else {
    echo "<script>alert('Payment not completed. Status: $status'); window.location.href='order_confirmation.php';</script>";
    exit();
}
