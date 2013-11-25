<?php 
    include 'bootstrap.php';
    head("Chico's Toy Store");
?>



<body>

    <?php include 'navbar.php' ?>
	<form class="form-horizontal" id="createForm" onsubmit="validate()" action="createItem.php" method="POST" enctype="application/x-www-form-urlencoded">
		<fieldset>
		<!-- Form Name -->
		<div class="row-fluid span4">
			<legend>Item creation screen</legend>
		</div>
		
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="isbn">ISBN:</label>
			  <div class="controls">
				<input id="isbn" name="isbn" type="text" placeholder="Enter isbn" class="input-xlarge" required>		
			  </div>
			</div>
		
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="qty">Quantity:</label>
			  <div class="controls">
				<input id="qty" name="qty" type="text" placeholder="Enter number" class="input-xlarge" required>		
			  </div>
			</div>

			<!-- Select Basic -->
			<div class="control-group">
			  <label class="control-label" for="type">Item Type:</label>
			  <div class="controls">
				<select id="type" name="type" class="input-xlarge">
				  <option value ="1">Game</option>
				  <option value="0">Toy</option>
				</select>
			  </div>
			</div>

			
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="price">Base Price:</label>
			  <div class="controls">
				<input id="price" name="price" type="text" placeholder="Enter price" class="input-xlarge" required>			
			  </div>
			</div>
			
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="name">Item Name:</label>
			  <div class="controls">
				<input id="name" name="name" type="text" placeholder="Enter item name" class="input-xlarge" required>			
			  </div>
			</div>
			
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="promo">Promotional Rate:</label>
			  <div class="controls">
				<input id="promo" name="promo" type="text" placeholder="Enter promotional rate" class="input-xlarge" required>			
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
	<script>
		var lowestNewIsbn = <?php print(lookup_max_isbn());?>;
		
		$('#createForm').submit(function(e){
			if (document.getElementById('isbn').value <= lowestNewIsbn) {
				e.preventDefault();
				alert("Isbn number must be greater than "+lowestNewIsbn);
			}
		});
		
	function validate(event) {
		if ($('#isbn').val().length > 10) {
			alert("ISBNs are limited to 10 characters");
			event.preventDefault();
		}
		else if (!$.isNumeric($('#qty').val())) {
			alert("Please put a numeric value in the Quantity field");
			event.preventDefault();
		}
		else if (!$.isNumeric($('#price').val())) {
			alert("Please put a numeric value in the Price field");
			event.preventDefault();
		}
		else if ($('#name').val().length > 50) {
			alert("Names are limited to 50 characters");
			event.preventDefault();
		}
		else if (!$.isNumeric($('#promo').val())) {
			alert("Please put a numeric value in the Promotion field");
			event.preventDefault();
		}
	}
	</script>
</body>
</html>
