<?php 
/**
* 
*/
$conn = new mysqli($servername, $username, $password, $dbname);

class Furniture extends ToolBox
{
	function show($table, $conn)
	{
		$result = $conn->query(ToolBox::ShowMeTheList($table));

		while ($data = $result->fetch_assoc()):
			if($data["SKU"] && $data["Dimensions"] !== NULL){
				echo "<div class='list_product col-sm filter $table'>";
				echo "SKU: ".$data["SKU"]."</br>"."Name: ".$data["Name"]."</br>"."Price: ".$data["Price"]." EUR"."</br>"."Dimension: ".$data["Dimensions"]; 
				echo "</div>";
			}
		endwhile;
	}
}
?>