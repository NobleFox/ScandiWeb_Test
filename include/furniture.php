<?php 
/**
* 
*/
$conn = new mysqli($servername, $username, $password, $dbname);

class Furniture extends ToolBox
{

	public $data_arr = array();
	var $smt = "";

	function addToList($conn)
	{
		$stmt = $conn->prepare("INSERT INTO List (SKU, Name, Price) VALUES (?,?,?)");
		$stmt->bind_param("ssd", $this->data_arr['SKU'], $this->data_arr['Name'], $this->data_arr['Price']);
		$stmt->execute();
		$stmt = $conn->prepare("INSERT INTO Furniture (SKU, Dimensions) VALUES (?,?)");
		$stmt->bind_param("ss", $this->data_arr['SKU'], $this->smt);
		$stmt->execute();
	}

	function sew()
	{
		$smt = $this->data_arr['Width'].'xx'.$this->data_arr['Height'].'xx'.$this->data_arr['Length'];
		$this->smt = $smt;
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
			if($data["SKU"] && $data["Dimensions"] !== NULL){
				echo "<div class='list_product col-sm filter $table'>";
				echo "SKU: ".$data["SKU"]."</br>"."Name: ".$data["Name"]."</br>"."Price: ".$data["Price"]." EUR"."</br>"."Dimension: ".$data["Dimensions"]; 
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

	function addFurniture($conn)
	{
		if ($this->data_arr['SKU'] && $this->data_arr['Name'] && $this->data_arr['Price'] != NULL) {
				if ($this->data_arr['switch'] && $this->data_arr['Width'] && $this->data_arr['Height'] && $this->data_arr['Length'] != NULL) {
					 if (Furniture::Check($this->data_arr['SKU'], $conn)){
					 	Furniture::sew();
						Furniture::addToList($conn);
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