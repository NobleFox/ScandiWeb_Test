<?php 
/**
* 
*/
$conn = new mysqli($servername, $username, $password, $dbname);

class DVD extends ToolBox
{
	public $data_arr = array();

	function addToList($conn)
	{
		$stmt = $conn->prepare("INSERT INTO List (SKU, Name, Price) VALUES (?,?,?)");
		$stmt->bind_param("ssd", $this->data_arr['SKU'], $this->data_arr['Name'], $this->data_arr['Price']);
		$stmt->execute();
		$stmt = $conn->prepare("INSERT INTO DVD (SKU, Size) VALUES (?,?)");
		$stmt->bind_param("sd", $this->data_arr['SKU'], $this->data_arr['Size']);
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
			if($data["SKU"] && $data["Size"] !== NULL){
				echo "<div class='list_product col-sm filter $table'>";
				echo "SKU: ".$data["SKU"]."</br>"."Name: ".$data["Name"]."</br>"."Price: ".$data["Price"]." EUR"."</br>"."Size: ".$data["Size"]; 
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

	function addDVD($conn)
	{
		if ($this->data_arr['SKU'] && $this->data_arr['Name'] && $this->data_arr['Price'] != NULL) {
				if ($this->data_arr['switch'] && $this->data_arr['Size'] != NULL) {
					 if (DVD::Check($this->data_arr['SKU'], $conn)){
						DVD::addToList($conn);
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