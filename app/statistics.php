<?php 

include 'bootstrap.php';

$inline_css = '<style>body { padding-top: 60px; } </style>';

    head("Chico's Toy Store", $inline_css);
?>



<body>

    <?php include 'navbar.php' ?>
	<form class="form-horizontal" action="statisticsView.php" method="POST" enctype="application/x-www-form-urlencoded"
		<fieldset>
		<!-- Form Name -->
		<div class="row-fluid span12">
			<legend>Sales Statistics Select</legend>
		</div>

			<!-- Select Basic -->
			<div class="control-group">
			  <label class="control-label" for="interval">Time Interval:</label>
			  <div class="controls">
				<select id="interval" name="interval" class="input-xlarge">
				  <option>Week</option>
				  <option>Month</option>
				  <option>Year</option>
				</select>
			  </div>
			</div>
			
			<!-- Select Basic -->
			<div class="control-group">
			  <label class="control-label" for="sort">Sort By:</label>
			  <div class="controls">
				<select id="sort" name="sort" class="input-xlarge">
				  <option value="Items.isbn as unsigned) asc">Item ISBN</option>
				  <option value="sum(ois.quantity) as unsigned) desc">Number Sold</option>
				</select>
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