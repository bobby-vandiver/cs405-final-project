<?php 

include 'bootstrap.php';

    head("Chico's Toy Store");
?>



<body>

    <?php
        include 'navbar.php';
        require_once 'auth-utils.php';

        redirect_if_not_staff();
    ?>
	<form class="form-horizontal" name=lookupForm" action="staff_order_lookup.php" onsubmit="validate()" method="POST" enctype="application/x-www-form-urlencoded">
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
				  <option value="0">Pending</option>
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
<script>
	function validate(event) {
		if ($('#orderID').val().length > 50) {
			alert("Usernames are limited to 50 characters");
			event.preventDefault();
		}
		else if (!$.isNumeric($('#orderID').val()) && $('#orderID').val().length > 0 ) {
			alert("Please put a numeric value in the Order Number field");
			event.preventDefault();
		}
		else if (!$.isNumeric($('#startDate').val()) && $('#startDate').val().length > 0 ) {
			alert("Please put a numeric value in the Start Date field");
			event.preventDefault();
		}
		else if (!$.isNumeric($('#endDate').val()) && $('#endDate').val().length > 0 ) {
			alert("Please put a numeric value in the End Date field");
			event.preventDefault();
		}
	}
</script>
</html>
