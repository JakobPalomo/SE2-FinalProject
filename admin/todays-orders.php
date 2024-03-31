
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


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Today's Orders</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/0f6618b60b.js" crossorigin="anonymous"></script>
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
								<h3>Today's Orders</h3>
							</div>
							<div class="module-body table">
	<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />


	<?php
	date_default_timezone_set('Asia/Manila');
    $status = 'Delivered';
	$startOfDay = date('Y-m-d 00:00:00');
    $endOfDay = date('Y-m-d 23:59:59');
	$query = mysqli_query($con, "SELECT pending.id AS id, pending.name AS username, pending.email AS useremail, pending.contact AS usercontact, pending.preparation_date AS orderdate, pending.items AS products, pending.payment_option AS payment_option, pending.delivery_option AS delivery_option, pending.total_price AS total_price, pending.delivery_address AS delivery_address FROM pending WHERE pending.status != 'Delivered'
        AND DATE(pending.preparation_date) = CURDATE()");

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

    // Now $orderProducts contains products grouped by order ID
?>

							<div class="tabling">
								<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped display table-responsive">
									<thead>
										<tr><th>Action</th>
											<th>Order ID</th>
											<th>Name</th>
											<th width="70">Contact no</th>
											<th>Email</th>
											<th>Product</th>
											<th>Qty</th>
											<th>Price</th>
											<th>Total</th>
											<th>Total All</th>
											<th>Payment</th>
											<th>Dlvry Option</th>
											<th>Address</th>
											<th>Order Date</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
											$cnt = 1;
											foreach ($orderProducts as $orderId => $order) {
												foreach ($order['products'] as $index => $product) {
										?>
													<tr>
														<?php if ($index === 0): ?>
															<td rowspan="<?php echo count($order['products']); ?>"><a href="updateorder.php?oid=<?php echo htmlentities($orderId); ?>" title="Update order" target="_blank"><i class="fa-regular fa-pen-to-square" style="color: #48BE25;  font-size: 20px"></i></a></td>
															<td rowspan="<?php echo count($order['products']); ?>"><?php echo htmlentities($orderId); ?></td>
															<td rowspan="<?php echo count($order['products']); ?>"><?php echo htmlentities($order['username']); ?></td>
															<td rowspan="<?php echo count($order['products']); ?>"><?php echo htmlentities($order['usercontact']); ?></td>
															<td rowspan="<?php echo count($order['products']); ?>"><?php echo htmlentities($order['useremail']); ?></td>
														<?php endif; ?>
														<td><?php echo isset($product['productName']) ? htmlentities($product['productName']) : ''; ?></td>
														<td><?php echo isset($product['quantity']) ? htmlentities($product['quantity']) : ''; ?></td>
														<td><?php echo isset($product['sizePrice']) ? htmlentities($product['sizePrice']) : ''; ?></td>
														<td><?php echo isset($product['totalPrice']) ? htmlentities($product['totalPrice']) : ''; ?></td>
														<?php if ($index === 0): ?>
															<td rowspan="<?php echo count($order['products']); ?>"><?php echo htmlentities($order['total_price']); ?></td>
															<td rowspan="<?php echo count($order['products']); ?>"><?php echo htmlentities($order['payment_option']); ?></td>
															<td rowspan="<?php echo count($order['products']); ?>"><?php echo htmlentities($order['delivery_option']); ?></td>
															<td rowspan="<?php echo count($order['products']); ?>"><?php echo htmlentities($order['delivery_address']); ?></td>
															<td rowspan="<?php echo count($order['products']); ?>"><?php echo htmlentities($order['orderdate']); ?></td>
															
														<?php endif; ?>
													</tr>
										<?php
													$cnt++;
												}
											}
										?>
									</tbody>
								</table>
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
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
<?php } ?>