<?php 
/**
* 
*/
$conn = new mysqli($servername, $username, $password, $dbname);

class Book extends ToolBox
{

	public $data_arr = array();

	function addToList($conn)
	{
		$stmt = $conn->prepare("INSERT INTO List (SKU, Name, Price) VALUES (?,?,?)");
		$stmt->bind_param("ssd", $this->data_arr['SKU'], $this->data_arr['Name'], $this->data_arr['Price']);
		$stmt->execute();
		$stmt = $conn->prepare("INSERT INTO Book (SKU, Weight) VALUES (?,?)");
		$stmt->bind_param("sd", $this->data_arr['SKU'], $this->data_arr['Weight']);
		$stmt->execute();
	}

	function Check($sku, $conn)
	{
		$sql = "SELECT `List`.`SKU` FROM List";
		$result = mysqli_query($conn, $sql);
		while ($data = $result->fetch_assoc()):
			if ($data["SKU"] == $sku) {
				return false;
			}else{
				return true;
			}
		endwhile;
	}

	function show($table, $conn)
	{
		$result = $conn->query(ToolBox::ShowMeTheList($table));

		while ($data = $result->fetch_assoc()):
			if($data["SKU"] && $data["Weight"] !== NULL){
				echo "<div class='list_product col-sm filter $table'>";
				echo "SKU: ".$data["SKU"]."</br>"."Name: ".$data["Name"]."</br>"."Price: ".$data["Price"]." EUR"."</br>"."Weight: ".$data["Weight"]; 
				echo "</div>";
			}
		endwhile;
	}

	function __set($i, $value)
	{
		$this->data_arr[$i] = $value;
	}

	function __get($key)
	{
		return $this->data_arr[$key];
	}

	function addBook($conn)
	{
		if ($this->data_arr['SKU'] && $this->data_arr['Name'] && $this->data_arr['Price'] != NULL) {
				if ($this->data_arr['switch'] && $this->data_arr['Weight'] != NULL) {
					 if (Book::Check($this->data_arr['SKU'], $conn)){
						Book::addToList($conn);
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
}
?>