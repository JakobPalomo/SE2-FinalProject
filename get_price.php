<?php
include('dbcon.php');

if (isset($_GET['productId']) && isset($_GET['size'])) {
    $productId = intval($_GET['productId']);
    $size = mysqli_real_escape_string($con, $_GET['size']);

    // Map size selection to the corresponding price column
    switch ($size) {
        case 'M':
            $priceColumn = 'mediumPrice';
            break;
        case 'L':
            $priceColumn = 'largePrice';
            break;
        case 'XL':
            $priceColumn = 'xlPrice';
            break;
        case 'XXL':
            $priceColumn = 'xxlPrice';
            break;
        default:
            // Default to mediumPrice if size is not recognized
            $priceColumn = 'mediumPrice';
            break;
    }

    // Fetch the price based on product ID and size
    $query = "SELECT {$priceColumn} AS price FROM products WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $productId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $price);

        if (mysqli_stmt_fetch($stmt)) {
            echo $price;
        } else {
            // Handle error or default price
            echo "0.00";
        }

        mysqli_stmt_close($stmt);
    } else {
        // Handle error with the prepared statement
        echo "0.00";
    }
} else {
    // Handle missing parameters
    echo "0.00";
}
?>
