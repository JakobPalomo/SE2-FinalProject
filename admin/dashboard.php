<?php
session_start();
include ('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Manila');// change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Dashboard</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="css/dashboard.css" rel="stylesheet">
        <link type="text/css" href="css/salesreportstyle.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link rel="shortcut icon" type="x-icon" href="../img/logomini.png">
        <script src="https://kit.fontawesome.com/0f6618b60b.js" crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>

        <script language="javascript" type="text/javascript">
            var popUpWin = 0;
            function popUpWindow(URLStr, left, top, width, height) {
                if (popUpWin) {
                    if (!popUpWin.closed) popUpWin.close();
                }
                popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
            }
        </script>
    </head>

    <body>
        <?php include ('include/header.php'); ?>

        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php include ('include/sidebar.php'); ?>
                    <div class="span9">
                        <div class="content">

                            <div class="module">
                                <div class="module-head">
                                    <h3>Dashboard</h3>
                                </div>
                                <div class="module-body table">
                                    <?php if (isset($_GET['del'])) { ?>
                                        <div class="alert alert-error">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>Oh
                                                snap!</strong><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                                        </div>
                                    <?php } ?>

                                    <br />

                                    <?php
                                    $currentDate = date('Y-m-d'); // Current date in YYYY-MM-DD format
                                    $endDate = date('Y-m-d', strtotime('+7 days')); // End date is 7 days from current date
                                
                                    $query = mysqli_query($con, "SELECT pending.id AS id, pending.name AS username, pending.email AS useremail, pending.contact AS usercontact, pending.preparation_date AS orderdate, pending.items AS products, pending.payment_option AS payment_option, pending.delivery_option AS delivery_option, pending.total_price AS total_price, pending.delivery_address AS delivery_address, pending.delivery_time AS delivery_time FROM pending WHERE pending.status = 'Accepted' AND STR_TO_DATE(pending.preparation_date, '%Y-%m-%d') >= '$currentDate' ORDER BY STR_TO_DATE(pending.preparation_date, '%Y-%m-%d') ASC LIMIT 6");

                                    // Fetching the counts of orders with different statuses
                                    $countPending = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS pendingCount FROM pending WHERE status = 'Pending'"));
                                    $countToPay = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS toPayCount FROM pending WHERE status = 'To Pay'"));
                                    $countPaid = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS paidCount FROM pending WHERE status = 'Paid'"));
                                    $countAccepted = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS acceptedCount FROM pending WHERE status = 'Accepted'"));

                                    // Your existing PHP code...
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
                                    <!-- Your existing content -->
                                    <div class="container-sales">
                                        <div class="total-earnings-box">
                                            <div class="total-earnings">
                                                <p>Upcoming Orders</p>
                                                <div class="row">
                                                    <!-- Display upcoming orders here -->
                                                    <?php
                                                    $count = 0; // Counter to track number of orders
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        ?>
                                                        <div class="col-lg-4 col-md-6 mb-4">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Order ID: <?php echo $row['id']; ?></h5>
                                                                    <p class="card-text"><strong>Name:</strong> <?php echo $row['username']; ?></p>
                                                                    <p class="card-text"><strong>Order Date:</strong> <?php echo $row['orderdate']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $count++;
                                                        // Start a new row after every 3 orders
                                                        if ($count % 3 == 0) {
                                                            echo '</div><div class="row">';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Remaining content -->
                                        <div class="earnings-container">
                                            <!-- Counts of orders with different statuses -->
                                            <div class="earnings" onclick="window.location.href='pending-orders.php';"
                                                style="cursor: pointer;">
                                                <p>Pending</p>
                                                <h2><?php echo $countPending['pendingCount']; ?></h2>
                                            </div>

                                            <div class="earnings" onclick="window.location.href='topay-orders.php';"
                                                style="cursor: pointer;">
                                                <p>To Pay</p>
                                                <h2><?php echo $countToPay['toPayCount']; ?></h2>
                                            </div>

                                            <div class="earnings" onclick="window.location.href='paid-orders.php';"
                                                style="cursor: pointer;">
                                                <p>Paid</p>
                                                <h2><?php echo $countPaid['paidCount']; ?></h2>
                                            </div>

                                            <div class="earnings" onclick="window.location.href='accepted-orders.php';"
                                                style="cursor: pointer;">
                                                <p>Accepted</p>
                                                <h2><?php echo $countAccepted['acceptedCount']; ?></h2>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>




                        </div><!--/.content-->
                    </div><!--/.span9-->
                </div>
            </div><!--/.container-->
        </div><!--/.wrapper-->

        <?php include ('include/footer.php'); ?>

        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script>
            $(document).ready(function () {
                $('.datatable-1').dataTable();
                $('.dataTables_paginate').addClass("btn-group datatable-pagination");
                $('.dataTables_paginate > a').wrapInner('<span />');
                $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
                $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
            });
        </script>

        <script>
            // Wait for the document to be ready
            $(document).ready(function () {
                // Function to perform search
                function performSearch() {
                    var searchText = $('#searchInput').val().toLowerCase(); // Get the search text
                    $('#orderTable tbody tr').hide(); // Hide all table rows
                    // Loop through each table row
                    $('#orderTable tbody tr').each(function () {
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
                $('#orderTable tbody tr').each(function () {
                    var rowDate = $(this).find('td:eq(13)').text().trim();
                    // Check if row date matches the search date
                    if (rowDate === formattedSearchDate) {
                        $(this).show(); // Show the row if it matches the search
                    }
                });
            }

            // Wait for the document to be ready
            $(document).ready(function () {
                // Initialize datepicker
                $('.datepicker').datepicker();

                // Call performSearch function when the search date changes
                $('#searchDate').on('change', performSearch);
            });
        </script>

    </body>
<?php } ?>