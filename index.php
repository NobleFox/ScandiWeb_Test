<!DOCTYPE html>
<html lang="en">
<head>
	<!-- meta-tags -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Font-Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <!-- Bootstrap -->
    <link href="style/bootstrap.min.css" rel="stylesheet">
    <!-- Title	 -->
	<title>Add/View</title>
	<!-- links -->
	<link rel="stylesheet" href="style/style_add.css">
</head>
<body>
	<!-- Includes -->
	<?php
		include_once 'include/connect.php';
		include 'include/toolbox.php';
		include 'include/furniture.php';
		include 'include/book.php';
		include 'include/DVD.php';
	?>
	<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	<!-- Start -->
	<div class="fluid-container slider">
		<img src="img/slider.jpg" alt="" style="position: relative;" class="img-fluid img-responsive">
		<article>
		    <div class="caption greeting">
		 		<h1>Welcome to my Junior Developer test</h1>
		    </div>
		</article>
	</div>
	<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	<!-- User-Actions -->
	<div class="fluid-container text-center">
		<div class="pagination">
			<div class="btn-group">
				<button id="add_btn" class="btn btn-primary"><h2>Add</h2></button>
				<button id="show_btn" class="btn btn-primary"><h2>View</h2></button>
			</div>
		</div>
	</div>
	<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	<!-- Hide/Show add/List -->
	<script src="js/hide_show.js"></script>
	
	<!-- List Add -->

	<form class="container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<div class="form-group">
			<label class="control-label col-md-2" for="SKU">SKU</label><input type="number" min="0" name="SKU" placeholder="">
		</div>
		<div class="form-group">
			<label class="control-label col-md-2" for="Name">Name</label><input type="text" name="Name" placeholder="">
		</div>
		<div class="form-group">
			<label class="control-label col-md-2" for="Price">Price</label><input type="number" min="0" name="Price" placeholder="" style="text-align: right;"> <strong>EUR</strong>
		</div>
		<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
		<!-- Switcher -->
		<div class="form-group">
			<label class="control-label col-md-2" for="switcher">Type Switcher</label>
			<select name="switch" id="switcher">
				<option value="">
					Choose type
				</option>
				<option value="DVD">
					DVD
				</option>
				<option value="Book">
					Book
				</option>
				<option value="Furniture">
					Furniture
				</option>
			</select>
		</div>
		<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
		<!-- Switcher add's -->
		<script src="js/switcher.js"></script>

		<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
		<!-- Swither inner input-->
		<div class="DVD form-group switched">
			<label class="control-label col-md-2" for="Size">
				Size
			</label>
			<input type="number" min="0" name="Size" placeholder="">
			<strong>MB</strong>
		</div>
    	<div class="Book form-group switched">
    		<label class="control-label col-md-2" for="Weight">
				Weight
			</label>
			<input type="number" min="0" name="Weight" placeholder="">
			<strong>kg</strong>
    	</div>
    	<div class="Furniture form-group switched">
    		<div class="form-group">
    			<label class="control-label col-md-2" for="Width">
				Width
				</label>
				<input type="number" min="0" name="Width" placeholder="">
				<strong>mm</strong>
    		</div>
    		<div class="form-group">
    			<label class="control-label col-md-2" for="Heigth">
				Height
				</label>
				<input type="number" min="0" name="Height" placeholder="">
				<strong>mm</strong>
    		</div>
    		<div class="form-group">
    			<label class="control-label col-md-2" for="Length">
				Length
				</label>
				<input type="number" min="0" name="Length" placeholder="">
				<strong>mm</strong>
    		</div>
    	</div>
    	<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
		<!-- Submit -->
    	<div class="form-group">
    		<label class="control-label col-md-2" for="btn1">
				<strong>Press here --></strong>
			</label>
			<input type="submit" class="btn1" name="btn1">
    	</div>
	</form>
	<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	<!-- Add to DB -->
	<?php 
		if (isset($_POST['btn1'])) {
			switch ($_POST['switch']) {
				case 'DVD':
					$dvd = new DVD();
					foreach ($_POST as $key => $value) {
						$dvd->__set($key, $value);	
					}
					$dvd->addDVD($conn);
				break;
				case 'Book':
					$book = new Book();
					foreach ($_POST as $key => $value) {
						$book->__set($key, $value);	
					}
					$book->addBook($conn);
				break;
				
				case 'Furniture':
					$furniture = new Furniture();
					foreach ($_POST as $key => $value) {
						$furniture->__set($key, $value);
					}
					$furniture->addFurniture($conn);
				break;
			}
		}
		
	?>	

	<!-- List show -->
	
	<div class="fluid-container List"> 
		<div class="row">
	        <div class="list col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            <h1 class="Title">List</h1>
	        </div>
			<div align="center">
	            <button class="btn btn-default filter-button" data-filter="all">All</button>
	            <button class="btn btn-default filter-button" data-filter="DVD">DVD</button>
	            <button class="btn btn-default filter-button" data-filter="Book">Books</button>
	            <button class="btn btn-default filter-button" data-filter="Furniture">Furniture</button>
				<form method="post">
		            <button class="btn btn-default" name="DALEK" type="submit">MASS DELETE</button>
				</form>
			</div>

	        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	        <!-- Show DVD -->
	        <?php 
				$second = new DVD();
				$second->show('DVD', $conn);
			?>
	        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	        <!-- Show Books -->
	        <?php 
				$second = new Book();
				$second->show('Book', $conn);
			?>
	        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	        <!-- Show Furniture -->
	        <?php 
				$second = new Furniture();
				$second->show('Furniture', $conn);
			?>
	    </div>
	        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	        <!-- Sorting -->
	        <script src="js/sorting.js"></script>
		</div>
	</div>
	<!-- there no way to call function -->
	<!-- $third = new ToolBox();
	$third->DALEK_MODE_ON(); -->
</body>
</html>