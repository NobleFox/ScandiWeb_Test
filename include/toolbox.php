 <?php
class ToolBox
{
	function ShowMeTheList($table)
	{
		//FULL JOIN
		$sql = "SELECT * FROM List 
				Left JOIN $table ON `List`.`SKU` = `$table`.`SKU`     
				UNION
				SELECT * FROM List 
				Right JOIN $table ON `List`.`SKU` = `$table`.`SKU`";
		return $sql;				
	}
}
?>