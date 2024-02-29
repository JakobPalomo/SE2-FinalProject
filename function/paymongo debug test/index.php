<!DOCTYPE html>
<html>
<head>
    <title>Display To Pay</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Orders To Pay</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Items</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once('dbcon.php'); // Include the database connection file

            // Retrieve data from the 'topay' table
            $statement = $con->prepare("SELECT * FROM `topay` WHERE `status` = 'To Pay'");
            $statement->execute();
            $result = $statement->get_result();
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['contact']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['items']}</td>";
                echo "<td>{$row['total_price']}</td>";
                echo "<td><a href=\"checkout.php?id={$row['id']}\">Checkout</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
