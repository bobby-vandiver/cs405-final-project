<?php 

include 'bootstrap.php';

$inline_css = '<style>body { padding-top: 60px; } </style>';

    head("Chico's Toy Store", $inline_css);
?>



<body>

    <?php include 'navbar.php' ?>
	<form class="form-horizontal" action="staff_order_lookup.php" method="POST" enctype="application/x-www-form-urlencoded"
		<fieldset>
		<!-- Form Name -->
		<div class="row-fluid span12">
			<legend>Order Lookup by Order Number, Order Status, Username, or Date Range</legend>
		</div>
		
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="customer">Customer:</label>
			  <div class="controls">
				<input id="customer" name="customer" type="text" placeholder="Enter customer" class="input-xlarge">		
			  </div>
			</div>
		
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="orderID">Order Number:</label>
			  <div class="controls">
				<input id="orderID" name="orderID" type="text" placeholder="Enter number" class="input-xlarge">		
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="control-group">
			  <label class="control-label" for="status">Order Status:</label>
			  <div class="controls">
				<select id="status" name="status" class="input-xlarge">
				  <option value="2">All</option>
				  <option value="1">Shipped</option>
				  <option value="0">Not Shipped</option>
				</select>
			  </div>
			</div>

			
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="startDate">Start Date:</label>
			  <div class="controls">
				<input id="startDate" name="startDate" type="text" placeholder="Enter date in yyyymmdd format" class="input-xlarge">			
			  </div>
			</div>
			
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="endDate">End Date:</label>
			  <div class="controls">
				<input id="endDate" name="endDate" type="text" placeholder="Enter date in yyyymmdd format" class="input-xlarge">			
			  </div>
			</div>


			<!-- Button -->
			<div class="control-group">
			  <label class="control-label" for="Submit"></label>
			  <div class="controls">
				<button type="submit" id="Submit" value="Submit" name="Submit" class="btn btn-primary">Submit</button>
			  </div>
			</div>
		</fieldset>
	</form>

		<?php include 'footer.php'; ?>
</body>
</html>
