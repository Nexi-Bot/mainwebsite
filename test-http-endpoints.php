<?php
// Simple HTTP test for the payment endpoints
header('Content-Type: text/plain');

echo "=== HTTP ENDPOINT TEST ===\n\n";

// Function to make HTTP request
function testEndpoint($url, $method = 'GET', $data = null) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, true);
    
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            ]);
        }
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    
    curl_close($ch);
    
    return [
        'http_code' => $httpCode,
        'response' => $response,
        'error' => $error
    ];
}

// Test URLs
$base_url = 'https://nexibot.uk';  // Change this to your actual domain
$test_urls = [
    'create-payment-intent' => $base_url . '/premium/create-payment-intent.php',
    'validate-coupon' => $base_url . '/premium/validate-coupon.php',
    'webhook' => $base_url . '/premium/webhook.php'
];

foreach ($test_urls as $name => $url) {
    echo "Testing $name:\n";
    echo "URL: $url\n";
    
    if ($name === 'webhook') {
        // Test webhook with POST (should return signature error)
        $testData = json_encode(['type' => 'test.event']);
        $result = testEndpoint($url, 'POST', $testData);
    } else {
        // Test payment endpoints with POST (should return auth error)
        $testData = json_encode(['test' => true]);
        $result = testEndpoint($url, 'POST', $testData);
    }
    
    echo "HTTP Code: " . $result['http_code'] . "\n";
    
    if ($result['error']) {
        echo "cURL Error: " . $result['error'] . "\n";
    }
    
    // Extract just the response body (remove headers)
    $response_parts = explode("\r\n\r\n", $result['response'], 2);
    $response_body = isset($response_parts[1]) ? $response_parts[1] : $result['response'];
    
    echo "Response: " . trim($response_body) . "\n";
    echo "Status: ";
    
    if ($result['http_code'] == 500) {
        echo "❌ 500 ERROR - Server Error\n";
    } elseif ($result['http_code'] == 401) {
        echo "✅ 401 AUTH ERROR - Endpoint working but requires auth\n";
    } elseif ($result['http_code'] == 400) {
        echo "✅ 400 BAD REQUEST - Endpoint working but invalid data\n";
    } elseif ($result['http_code'] == 200) {
        echo "✅ 200 OK - Endpoint responding\n";
    } else {
        echo "⚠️  Unexpected status code\n";
    }
    
    echo "\n" . str_repeat("-", 50) . "\n\n";
}

echo "=== TEST COMPLETE ===\n";
?>
