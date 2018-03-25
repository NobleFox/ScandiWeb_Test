 <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ScandiWeb_DB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

class ToolBox
{
	var $Weight = "";
	var $Size = "";
	var $Dim = "";

	function addToList($sku, $name, $price, mysqli $conn)
	{
		$sql = "INSERT INTO List (SKU, Name, Price)
		VALUES ('$sku', '$name', '$price')";
		mysqli_query($conn,$sql);
	}

	function Check($sku, $conn)
	{
		$sql = "SELECT `List`.`SKU` FROM List";
		$result = mysqli_query($conn, $sql);
		while ($data = $result->fetch_assoc()):
			if ($data["SKU"]== $sku) {
				return false;
			}else{
				return true;
			}
		endwhile;
	}

	function addToSecondaryList($table,$sku, $conn)
	{
		if($table == "Book"){
			$sql = "INSERT INTO Book (SKU, Weight)
			VALUES ('$sku', '$this->Weight')";
			mysqli_query($conn, $sql);
		}

		if($table == "DVD"){
			$sql = "INSERT INTO DVD (SKU, Size)
			VALUES ('$sku', '$this->Size')";
			mysqli_query($conn, $sql);
		}

		if($table == "Furniture"){
			$sql = "INSERT INTO Furniture (SKU, Dimensions)
			VALUES ('$sku', '$this->Dim')";
			mysqli_query($conn, $sql);
		}
	}

	function ShowMeTheList($table, $conn)
	{
		//FULL JOIN
		$sql = "SELECT * FROM List 
				Left JOIN $table ON `List`.`SKU` = `$table`.`SKU`     
				UNION
				SELECT * FROM List 
				Right JOIN $table ON `List`.`SKU` = `$table`.`SKU`";
		return $sql;				
	}

	function DALEK_MODE_ON()
	{	
		$sql = "DELETE * FROM List";
		mysqli_query($conn,$sql);
	}
}
?>