<div class="span3">
	<div class="sidebar">


		<ul class="widget widget-menu unstyled">
			<li><a href="dashboard.php"><i class="menu-icon icon-cog"></i> Dashboard </a></li>
		</ul>

		<ul class="widget widget-menu unstyled">
			<li>
				<a class="collapsed" data-toggle="collapse" href="#togglePages">
					<i class="menu-icon icon-cog"></i>
					<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
					Order Management
				</a>
				<ul id="togglePages" class="collapse unstyled">
					<li>
						<a href="pending-orders.php">
							<i class="icon-tasks"></i>
							Pending Orders
							<?php
							$status = 'Delivered';
							$ret = mysqli_query($con, "SELECT COUNT(*) AS num_pending FROM pending WHERE status = 'Pending'");
							$row = mysqli_fetch_assoc($ret);
							$num = $row['num_pending']; { ?><b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
							<?php } ?>
						</a>
					</li>

					<li>
						<a href="topay-orders.php">
							<i class="icon-tasks"></i>
							To Pay Orders
							<?php
							$status = 'Delivered';
							$ret = mysqli_query($con, "SELECT COUNT(*) AS num_topay FROM pending WHERE status = 'To Pay'");
							$row = mysqli_fetch_assoc($ret);
							$num = $row['num_topay']; { ?><b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
							<?php } ?>
						</a>
					</li>

					<li>
						<a href="paid-orders.php">
							<i class="icon-tasks"></i>
							Paid Orders
							<?php
							$status = 'Delivered';
							$ret = mysqli_query($con, "SELECT COUNT(*) AS num_paid FROM pending WHERE status = 'Paid'");
							$row = mysqli_fetch_assoc($ret);
							$num = $row['num_paid']; { ?><b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
							<?php } ?>
						</a>
					</li>

					<li>
						<a href="accepted-orders.php">
							<i class="icon-tasks"></i>
							Accepted Orders
							<?php
							$status = 'Delivered';
							$ret = mysqli_query($con, "SELECT COUNT(*) AS num_accepted FROM pending WHERE status = 'Accepted'");
							$row = mysqli_fetch_assoc($ret);
							$num = $row['num_accepted']; { ?><b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
							<?php } ?>
						</a>
					</li>

					<li>
						<a href="declined-orders.php">
							<i class="icon-tasks"></i>
							Declined Orders
							<?php
							$status = 'Delivered';
							$ret = mysqli_query($con, "SELECT COUNT(*) AS num_pending FROM pending WHERE status = 'Declined'");
							$row = mysqli_fetch_assoc($ret);
							$num = $row['num_pending']; { ?><b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
							<?php } ?>
						</a>
					</li>

					<li>
						<a href="delivered-orders.php">
							<i class="icon-inbox"></i>
							Delivered Orders
							<?php
							$status = 'Delivered';
							$ret = mysqli_query($con, "SELECT COUNT(*) AS num_delivered FROM pending WHERE status = 'Delivered'");
							$row = mysqli_fetch_assoc($ret);
							$num = $row['num_delivered']; { ?><b class="label green pull-right"><?php echo htmlentities($num); ?></b>
							<?php } ?>
						</a>
					</li>
				</ul>
			</li>
		</ul>


		<ul class="widget widget-menu unstyled">
			<li><a href="category.php"><i class="menu-icon icon-tasks"></i> Create Category </a></li>
			<li><a href="subcategory.php"><i class="menu-icon icon-tasks"></i>Sub Category </a></li>
			<li><a href="insert-product.php"><i class="menu-icon icon-paste"></i>Insert Product </a></li>
			<li><a href="manage-products.php"><i class="menu-icon icon-table"></i>Manage Products </a></li>
			<li><a href="salesreport.php"><i class="menu-icon icon-tasks"></i>Sales Report </a></li>

		</ul><!--/.widget-nav-->

		<ul class="widget widget-menu unstyled">
			<li>
				<a href="logout.php">
					<i class="menu-icon icon-signout"></i>
					Logout
				</a>
			</li>
		</ul>

	</div><!--/.sidebar-->
</div><!--/.span3-->