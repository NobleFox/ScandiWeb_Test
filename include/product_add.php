 <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ScandiWeb_DB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

class Product_Add
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

	function addToSecondaryList($table,$sku, $conn)
	{
		if($table == "Books"){
			$sql = "INSERT INTO Books (SKU, Weight)
			VALUES ('$sku', '$this->Weight')";
			mysqli_query($conn, $sql);
		}

		if($table == "DVD"){
			$sql = "INSERT INTO DVD (SKU, Size)
			VALUES ('$sku', '$this->Size')";
			mysqli_query($conn, $sql);
		}

		if($table == "Furniture"){
			$sql = "INSERT INTO Furniture (SKU, )
			VALUES ('$sku', '$this->Dim')";
			mysqli_query($conn, $sql);
		}
	}
}
?>