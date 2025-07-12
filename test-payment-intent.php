<?php
// Test create-payment-intent endpoint
session_start();

// Simulate Discord user session
$_SESSION['discord_user'] = [
    'id' => '123456789',
    'username' => 'testuser#1234'
];

// Test data
$test_data = [
    'plan' => 'monthly',
    'email' => 'test@example.com',
    'full_name' => 'Test User',
    'postcode' => 'SW1A 1AA'
];

echo "🧪 Testing create-payment-intent endpoint...\n\n";

// Make a POST request to the endpoint
$url = 'http://localhost/premium/create-payment-intent';
$data = json_encode($test_data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data)
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status: $http_code\n";
echo "Response:\n";
echo $response;

// Also test directly by including the file
echo "\n\n" . str_repeat('=', 50) . "\n";
echo "Direct test (simulating request):\n";
echo str_repeat('=', 50) . "\n";

// Simulate the request data
$_POST['data'] = json_encode($test_data);
$_SERVER['REQUEST_METHOD'] = 'POST';

// Capture output
ob_start();
$_REQUEST_URI = '/premium/create-payment-intent';

try {
    // Simulate the request input
    file_put_contents('php://input', json_encode($test_data));
    
    include 'premium/create-payment-intent.php';
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

$output = ob_get_clean();
echo $output;
?>
