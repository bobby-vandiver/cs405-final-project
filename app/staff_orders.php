<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="ico/favicon.png">
  </head>

<body>

    <?php include 'navbar.php' ?>
	<form class="form-horizontal" action="staff_order_lookup" method="post">
		<fieldset>

		<!-- Form Name -->
		<div class="row-fluid span12">
			<legend>Order Lookup by Order Number, Order Status, Username, or Date Range</legend>
		</div>
		
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="orderID">Order Number:</label>
			  <div class="controls">
				<input id="OrderID" name="orderID" type="text" placeholder="Enter number" class="input-xlarge">		
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="control-group">
			  <label class="control-label" for="status">Order Status:</label>
			  <div class="controls">
				<select id="Status" name="status" class="input-xlarge">
				  <option>All</option>
				  <option>Shipped</option>
				  <option>Not Shipped</option>
				</select>
			  </div>
			</div>

			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="customerUsername">Customer Username:</label>
			  <div class="controls">
				<input id="customerUsername" name="customerUsername" type="text" placeholder="Enter username" class="input-xlarge">			
			  </div>
			</div>
			
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="startDate">Start Date:</label>
			  <div class="controls">
				<input id="startDate" name="startDate" type="text" placeholder="Enter date in mm/dd/yyyy format" class="input-xlarge">			
			  </div>
			</div>
			
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="endDate">End Date:</label>
			  <div class="controls">
				<input id="endDate" name="endDate" type="text" placeholder="Enter date in mm/dd/yyyy format" class="input-xlarge">			
			  </div>
			</div>


			<!-- Button -->
			<div class="control-group">
			  <label class="control-label" for="Submit"></label>
			  <div class="controls">
				<button id="Submit" name="Submit" class="btn btn-primary">Submit</button>
			  </div>
			</div>

		</fieldset>
	</form>

		<?php include 'footer.php'; ?>
</body>
</html>
