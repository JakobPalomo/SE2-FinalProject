<?php
session_start();
include('../dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['index'], $_POST['newSize'], $_POST['newQuantity'])) {
    $index = $_POST['index'];
    $newSize = $_POST['newSize'];
    $newQuantity = $_POST['newQuantity'];

    // Update the cart item in the session
    $_SESSION['cart'][$index]['size'] = $newSize;
    $_SESSION['cart'][$index]['quantity'] = $newQuantity;

    // Retrieve updated details from the database
    $productId = $_SESSION['cart'][$index]['productId'];
    $query = "SELECT mediumPrice, largePrice, xlPrice, xxlPrice FROM products WHERE id = $productId";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $productDetails = mysqli_fetch_assoc($result);

        // Modify to dynamically select price based on size
        switch ($newSize) {
            case 'M':
                $price = $productDetails['mediumPrice'];
                break;
            case 'L':
                $price = $productDetails['largePrice'];
                break;
            case 'XL':
                $price = $productDetails['xlPrice'];
                break;
            case 'XXL':
                $price = $productDetails['xxlPrice'];
                break;
            default:
                $price = 0;
                break;
        }

        // Compute the total price based on the retrieved price and new quantity
        $totalPrice = $price * $newQuantity;

        // Include the computed total price in the response
        $response = [
            'price' => $price,
            'quantity' => $newQuantity,
            'totalPrice' => $totalPrice
        ];

        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
