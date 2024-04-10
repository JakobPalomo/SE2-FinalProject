
<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Manila');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

    // Define functions to calculate daily, weekly, and yearly earnings
    function calculateEarnings($data) {
        $dailyEarnings = 0;
        $weeklyEarnings = 0;
        $yearlyEarnings = 0;

        $currentDate = date('Y-m-d');
        $currentWeek = date('W');
        $currentYear = date('Y');

        foreach ($data as $order) {
            // Extract order date
            $orderDate = date('Y-m-d', strtotime($order['orderdate']));
            $orderWeek = date('W', strtotime($order['orderdate']));
            $orderYear = date('Y', strtotime($order['orderdate']));

            // Calculate earnings for each order
            foreach ($order['products'] as $product) {
                $totalPrice = floatval($product['totalPrice']);

                // Daily earnings
                if ($orderDate === $currentDate) {
                    $dailyEarnings += $totalPrice;
                }

                // Weekly earnings
                if ($orderWeek === $currentWeek && $orderYear === $currentYear) {
                    $weeklyEarnings += $totalPrice;
                }

                // Yearly earnings
                if ($orderYear === $currentYear) {
                    $yearlyEarnings += $totalPrice;
                }
            }
        }

        return array(
            'daily' => $dailyEarnings,
            'weekly' => $weeklyEarnings,
            'yearly' => $yearlyEarnings,
			'total' => $dailyEarnings + $weeklyEarnings + $yearlyEarnings
        );
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sales Report</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="../img/logomini.png">
    <link type="text/css" href="css/salesreportstyle.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/0f6618b60b.js" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>

	<script language="javascript" type="text/javascript">
			var popUpWin=0;
			function popUpWindow(URLStr, left, top, width, height)
			{
			if(popUpWin)
			{
			if(!popUpWin.closed) popUpWin.close();
			}
			popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
			}
</script>
</head>

<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

	<div class="module">
							<div class="module-head">
								<h3>Sales Report</h3>
							</div>
			<div class="module-body table">
				<?php if(isset($_GET['del']))
					{?>
							<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong>Oh snap!</strong><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
							</div>
					<?php } ?>

									<br />

	<?php
    $status = 'Delivered';
    $query = mysqli_query($con, "SELECT pending.id AS id, pending.name AS username, pending.email AS useremail, pending.contact AS usercontact, pending.preparation_date AS orderdate, pending.items AS products, pending.payment_option AS payment_option, pending.delivery_option AS delivery_option, pending.total_price AS total_price, pending.delivery_address AS delivery_address FROM pending WHERE pending.status = 'Delivered'");

    $orderProducts = []; // Associative array to store products grouped by order ID

    while ($row = mysqli_fetch_array($query)) {
        $orderId = $row['id'];
        // Unserialize the products array
        $products = unserialize($row['products']);

        // If products for this order ID are not added yet, initialize an array
        if (!isset($orderProducts[$orderId])) {
            $orderProducts[$orderId] = [
                'username' => $row['username'],
                'usercontact' => $row['usercontact'],
                'useremail' => $row['useremail'],
                'payment_option' => $row['payment_option'],
                'delivery_option' => $row['delivery_option'],
                'orderdate' => $row['orderdate'],
                'total_price' => $row['total_price'],
				'delivery_address' => $row['delivery_address'],
                'products' => []
            ];
        }

        // Add products to the array for this order ID
        foreach ($products as $product) {
            $orderProducts[$orderId]['products'][] = [
                'productName' => $product['productName'],
                'quantity' => $product['quantity'] . ' ' . $product['size'],
                'sizePrice' => $product['sizePrice'],
                'totalPrice' => $product['totalPrice']
            ];
        }
    }
	// Calculate earnings based on the fetched data
    $earnings = calculateEarnings($orderProducts);

?>
					  <style>
						
						.earnings h2 {
							color: #666;
							margin-bottom: 5px;
						}
						.earnings p {
							margin: 5px 0;
						}
						.total-earnings p {
							margin: 5px 0;
							font-size: 18px;
							font-weight: bold;
						}
    				</style>
							<div class="container-sales">
								
                                <div class="earnings-container">
								<div class="earnings">
									<p>Daily Earnings:</p>
									<h2>₱<?php echo number_format($earnings['daily'], 2); ?></h2>
								</div>
								<div class="earnings">
									<p>Weekly Earnings:</p>
									<h2>₱<?php echo number_format($earnings['weekly'], 2); ?></h2>
								</div>
								<div class="earnings">
									<p>Yearly Earnings:</p>
									<h2>₱<?php echo number_format($earnings['yearly'], 2); ?></h2>
								</div></div>
								<br>
                                <div class="total-earnings-box">
								<div class="total-earnings">
									<p>Total Earnings:</p>
									<center><h2>₱<?php echo number_format($earnings['total'], 2); ?></h2></center>
								</div>
                                </div>
							</div>
						</div>
					</div>				

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>

<script>
        // Wait for the document to be ready
        $(document).ready(function(){
            // Function to perform search
            function performSearch() {
                var searchText = $('#searchInput').val().toLowerCase(); // Get the search text
                $('#orderTable tbody tr').hide(); // Hide all table rows
                // Loop through each table row
                $('#orderTable tbody tr').each(function() {
                    var rowText = $(this).text().toLowerCase(); // Get text of current row
                    // Check if row text contains search text
                    if (rowText.indexOf(searchText) !== -1) {
                        $(this).show(); // Show the row if it matches the search
                    }
                });
            }

            // Call performSearch function when the search input changes
            $('#searchInput').on('input', performSearch);
        });
    </script>

<script>
    // Function to perform search
    function performSearch() {
        var searchDate = $('#searchDate').val(); // Get the selected date

        // Format the searchDate to match the orderdate format (YYYY-MM-DD)
        var formattedSearchDate = $.datepicker.formatDate('yy-mm-dd', new Date(searchDate));
		console.log("Formatted search date: ", formattedSearchDate); 

        $('#orderTable tbody tr').hide(); // Hide all table rows
        // Loop through each table row
        $('#orderTable tbody tr').each(function() {
            var rowDate = $(this).find('td:eq(13)').text().trim(); 
            // Check if row date matches the search date
            if (rowDate === formattedSearchDate) {
                $(this).show(); // Show the row if it matches the search
            }
        });
    }

    // Wait for the document to be ready
    $(document).ready(function(){
        // Initialize datepicker
        $('.datepicker').datepicker();

        // Call performSearch function when the search date changes
        $('#searchDate').on('change', performSearch);
    });
</script>

</body>
<?php } ?>