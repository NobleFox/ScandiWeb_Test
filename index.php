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
	<script>
		$(document).ready(function(){
			$("form").hide();
			$open_add = false;
    		$("#add_btn").click(function(){
    			if($open_add){
        			$("form").hide(1000);
            		$open_add = false;
        		}else{
        			$("form").show(1000);
        			$(".fluid-container.List").hide(1000);
            		$open_list = false;
            		$open_add = true;
            		$('html, body').animate({
            			scrollTop:$('form').offset().top
            		},1000);
        		}
    		});
    		$(".fluid-container.List").hide();
			$open_list = false;
    		$("#show_btn").click(function(){
    			if($open_list){
        			$(".fluid-container.List").hide(1000);
            		$open_list = false;
        		}else{
        			$(".fluid-container.List").show(1000);
        			$("form").hide(1000);
            		$open_add = false;
            		$open_list = true;
            		$('html, body').animate({
            			scrollTop:$('.fluid-container.List').offset().top
            		},1000);
        		}
    		});
		});
	</script>
	
	<!-- List Add -->

	<form class="container" method="post" action="">
		<div class="form-group">
			<label class="control-label col-md-2" for="SKU">SKU</label><input type="number" min="0" name="SKU" placeholder="">
		</div>
		<div class="form-group">
			<label class="control-label col-md-2" for="Name">Name</label><input type="text" name="Name" placeholder="">
		</div>
		<div class="form-group">
			<label class="control-label col-md-2" for="Price">Price</label><input type="number" min="0" name="Price" placeholder="0.00" style="text-align: right;"> <strong>EUR</strong>
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
		<script type="text/javascript">
			$(document).ready(function(){
    			$("select").change(function(){
        			$(this).find("option:selected").each(function(){
        				$(".form-group.switched").hide();
            			var gg = $(this).attr("value");
            			if(gg){
            				$("." + gg).show(1000);
                			$(".form-group.switched").not("." + gg).hide();
            			} else{
               				$(".form-group.switched").hide();
            			}
        			});
    			}).change();
			});
		</script>

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
			$first = new ToolBox();
			if ($_POST['SKU'] && $_POST['Name'] && $_POST['Price'] != NULL) {
				if (($_POST['Weight'] || $_POST['Size']) && $_POST['switch'] != Null || ($_POST['Width'] && $_POST['Height'] && $_POST['Length'] && $_POST['switch'] ) != NULL) {
					if ($first->Check($_POST['SKU'], $conn)) {
						$first->addToList($_POST['SKU'], $_POST['Name'], $_POST['Price'], $conn);
						$first->Weight = $_POST['Weight'];
						$first->Size = $_POST['Size'];
						$first->Dim = $_POST['Width'].'x'.$_POST['Height'].'x'.$_POST['Length'];
						$first->addToSecondaryList($_POST['switch'], $_POST['SKU'], $conn);
					}else{
						echo "<script>alert('Already exists');</script>";
					}
				}else{
					echo "<script>alert('Second part is incorrect');</script>";
				}
			}else{
				echo "<script>alert('First part is incorrect');</script>";
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
	        </div>
			</form>
	        

			<?php 
				$gg = new ToolBox();
				if(isset($_POST['DALEK'])){
					$gg->DALEK_MODE_ON();
				}
			?>

	        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	        <!-- Show DVD -->
	        <?php 
				$second = new ToolBox();
				$result = $conn->query($second->ShowMeTheList('DVD', $conn));
				//print_r($result->fetch_assoc());
				while ($data = $result->fetch_assoc()):
				if($data["SKU"] && $data["Size"] !== NULL){
					?>
	        		<div class="list_product col-sm filter DVD">
						<?php 
							echo "SKU: ".$data["SKU"]."</br>"."Name: ".$data["Name"]."</br>"."Price: ".$data["Price"]." EUR"."</br>"."Size: ".$data["Size"]." mb"."</br>";
						?>
					</div>
					<?php
				}
				endwhile;?>
	        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	        <!-- Show Books -->
	        <?php 
				$second = new ToolBox();
				$result = $conn->query($second->ShowMeTheList('Book', $conn));
				//print_r($result->fetch_assoc());
				while ($data = $result->fetch_assoc()):
				if($data["SKU"] && $data["Weight"] !== NULL){
					?>
	        		<div class="list_product col-sm filter Book">
						<?php 
							echo "SKU: ".$data["SKU"]."</br>"."Name: ".$data["Name"]."</br>"."Price: ".$data["Price"]." EUR"."</br>"."Weight: ".$data["Weight"]." kg"."</br>";
						?>
					</div>
					<?php
				}
				endwhile;?>
	        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	        <!-- Show Furniture -->
	        <?php 
				$second = new ToolBox();
				$result = $conn->query($second->ShowMeTheList('Furniture', $conn));
				//print_r($result->fetch_assoc());
				while ($data = $result->fetch_assoc()):
				if($data["SKU"] && $data["Dimensions"] !== NULL){
					?>
	        		<div class="list_product col-sm filter Furniture">
						<?php 
							echo "SKU: ".$data["SKU"]."</br>"."Name: ".$data["Name"]."</br>"."Price: ".$data["Price"]." EUR"."</br>"."Dimension: ".$data["Dimensions"]."</br>";
						?>
					</div>
					<?php
				}
				endwhile;?>
	    </div>
	        <!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
	        <!-- Sorting -->
	        <script>
	        	$(document).ready(function(){
    				$(".filter-button").click(function(){
        				var value = $(this).attr('data-filter');
				        if(value == "all"){
				            $('.filter').show('1000');
				        }
				        else{
				            $(".filter").not('.'+value).hide('3000');
				            $('.filter').filter('.'+value).show('3000');   
				    	}
    				});
				});
	        </script>
		</div>
	</div>
	<!-- there no way to call function -->
	<!-- $third = new ToolBox();
	$third->DALEK_MODE_ON(); -->
</body>
</html>