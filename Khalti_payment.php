<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get order details from query
$order_id = $_GET['order_id'] ?? null;
$amount   = $_GET['amount'] ?? null;

if (!$order_id || !$amount) {
    die("Invalid request. Missing order details.");
}

// Convert to paisa
$amount_paisa = (int) round($amount * 100);

// Fetch user info
$query = "SELECT name, email, phone FROM user_form WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Build payload
$payload = [
    "return_url"          => BASE_URL . "khalti_verify.php",
    "website_url"         => BASE_URL,
    "amount"              => $amount_paisa,
    "purchase_order_id"   => $order_id,
    "purchase_order_name" => "Ecommerce Order #$order_id",
    "customer_info"       => [
        "name"  => $user_data['name'] ?? "Customer",
        "email" => $user_data['email'] ?? "customer@example.com",
        "phone" => $user_data['phone'] ?? "9800000000"
    ]
];

// Initiate payment with Khalti Sandbox
$ch = curl_init("https://dev.khalti.com/api/v2/epayment/initiate/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Key " . KHALTI_SECRET_KEY,
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
$response = curl_exec($ch);
$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http !== 200) {
    echo "<pre>Initiate failed (HTTP $http)\n" . htmlspecialchars($response) . "</pre>";
    exit;
}

$data = json_decode($response, true);
if (!empty($data["payment_url"])) {
    header("Location: " . $data["payment_url"]);
    exit;
}

echo "<pre>Unexpected initiate response:\n" . htmlspecialchars($response) . "</pre>";
