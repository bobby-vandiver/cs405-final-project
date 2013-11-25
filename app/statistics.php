<?php 
    include 'bootstrap.php';
    head("Chico's Toy Store");
?>
<body>
    <?php
        include 'navbar.php';
        require_once 'auth-utils.php';

        redirect_if_not_admin();
    ?>
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
				  <option value="items">Item ISBN</option>
				  <option value="numbers">Number Sold</option>
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
