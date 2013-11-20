<?php

$orderNumber =  $_POST["orderID"];
$orderStatus = $_POST["status"];
$userName = $_POST["customerUsername"];
$date1 = $_POST["startDate"];
$date2 = $_POST["endDate"];

$results;
if ($ordernumber) {
	$results = find_all_order_items_by_order_id($orderNumber);
} 
else if ($orderstatus) {
	$results = find_all_orders_by_status($status);	
}
else if ($userName) {
	$results = find_all_orders_by_username($userName); 
}
else {
	$results = find_all_orders_by_date($date1, $date2);
}




?>

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

	<legend>Orders Display</legend>

	<table class="table table-striped">
		<?php //output rows using for each ?>
	</table>

</body>
</html>