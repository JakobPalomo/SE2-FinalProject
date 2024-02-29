<?php
require_once('vendor/autoload.php');
require_once('dbcon.php'); // Include the database connection file

$client = new \GuzzleHttp\Client();

// Get the ID parameter from the URL
$id = $_GET['id'];

// Retrieve the order details from the 'topay' table
$statement = $con->prepare("SELECT * FROM `pending` WHERE `id` = ?");
$statement->bind_param("i", $id);
$statement->execute();
$result = $statement->get_result();
$order = $result->fetch_assoc();

// Check if the order exists
if (!$order) {
    echo "Error: Order not found";
    exit;
}

// Extract items from the order
$items = unserialize($order['items']);

// Check if items are null before unserializing
if ($items !== false) {
    // Create the line items array
    $line_items = [];
    foreach ($items as $item) {
        $line_items[] = [
            'name' => $item['productName'],
            'quantity' => $item['quantity'],
            'amount' => $item['sizePrice'] * 100, // Amount should be in cents
            'currency' => 'PHP',
            'description' => $item['productName'],
        ];
    }

    // Create the checkout session
    $response = $client->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
        'json' => [
            'data' => [
                'attributes' => [
                    'send_email_receipt' => false,
                    'show_description' => true,
                    'show_line_items' => true,
                    'description' => 'Order #' . $order['id'],
                    'payment_method_types' => ['gcash'],
                    'line_items' => $line_items,
                ]
            ]
        ],
        'headers' => [
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
            'authorization' => 'Basic ' . base64_encode('sk_test_zC8KCgqHhczEs2ETxMhsRZcR' . ':'),
        ],
    ]);

    // Extract the checkout session ID from the response
    $data = json_decode($response->getBody(), true);
    $checkout_session_id = $data['data']['id'];

    // Redirect the user to the PayMongo checkout page
    // Redirect the user to the PayMongo checkout page
header('Location: ' . $data['data']['attributes']['checkout_url']);

// Call transfer.php after the successful payment
$transfer_url = 'http://localhost/paymongotest/transfer.php?id=' . $order['id'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $transfer_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

exit;

   
} else {
    echo "Error: Items are null in database";
    exit;
}
?>
