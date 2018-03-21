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
	<?php
		include_once 'include/connect.php';
		include 'include/product_add.php';
	?>
	<div class="fluid-container slider">
		<img src="img/slider.jpg" alt="" class="img-responsive">
		<img class="bottom-arrow" src="img/05.png" alt="Scroll to bottom please">
		<article>
		    <div class="greeting">
		 		<h1>Welcome to my Junior Developer test</h1>
		    </div>
		</article>
	</div>
	<div class="fluid-container text-center">
		<div class="pagination">
			<div class="btn-group">
				<button id="add_btn" class="btn btn-primary"><h2>Add</h2></button>
				<button id="view_btn" class="btn btn-primary"><h2>View</h2></button>
			</div>
		</div>
	</div>
	<form class="form-horizontal" method="post" action="">
		<div class="form-group">
			<label class="control-label col-md-2" for="SKU">SKU</label><input type="number" name="SKU" placeholder="">
		</div>
		<div class="form-group">
			<label class="control-label col-md-2" for="Name">Name</label><input type="text" name="Name" placeholder="">
		</div>
		<div class="form-group">
			<label class="control-label col-md-2" for="Price">Price</label><input type="number" name="Price" placeholder="0.00" style="text-align: right;"> <strong>EUR</strong>
		</div>
		<input type="submit" value="Add Employee">
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
	</form>
	<form action="">
		<!-- /////////////////////////////////////////////////////////////// -->
		<script type="text/javascript">
			$(document).ready(function(){
    			$("select").change(function(){
        			$(this).find("option:selected").each(function(){
        				$(".form-group.switched").hide();
            			var gg = $(this).attr("value");
            			if(gg){
            				$("." + gg).show();
                			$(".form-group.switched").not("." + gg).hide();
            			} else{
               				$(".form-group.switched").hide();
            			}
        			});
    			}).change();
			});
		</script>
		<!-- /////////////////////////////////////////////////////////////// -->

		<div class="DVD form-group switched">
			<label class="control-label col-md-2" for="Size">
				Size
			</label>
			<input type="number" name="Size" placeholder="">
			<strong>MB</strong>
		</div>
    	<div class="Book form-group switched">
    		<label class="control-label col-md-2" for="Weight">
				Weight
			</label>
			<input type="number" name="Weight" placeholder="">
			<strong>kg</strong>
    	</div>
    	<div class="Furniture form-group switched">
    		<label class="control-label col-md-2" for="X">
				X
			</label>
			<input type="number" name="X" placeholder="">
			<strong>mm</strong>
			</br>
			<label class="control-label col-md-2" for="Y">
				Y
			</label>
			<input type="number" name="Y" placeholder="">
			<strong>mm</strong>
			</br>
			<label class="control-label col-md-2" for="Z">
				Z
			</label>
			<input type="number" name="Z" placeholder="">
			<strong>mm</strong>
			<?php
				
			?>
    	</div>

	</form>
	
</body>
</html>