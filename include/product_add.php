<?php

include_once 'connect.php';

/**
* 
*/
class Product_Add
{
	function addToList()
	{
		$sql = "INSERT INTO List (SKU, Name, Price)
		VALUES ('$sku', '$name', '$price')";
		mysqli_query($conn,$sql);
	}

	function addToList($table)
	{
		addToList();
		if($table == "Books"){
			$sql = "INSERT INTO Books (SKU, Weight)
			VALUES ('$sku', '$Weight')";
			mysqli_query($conn,$sql);
		}

		if($table == "DVD"){
			$sql = "INSERT INTO DVD (SKU, Size)
			VALUES ('$sku', '$Size')";
			mysqli_query($conn,$sql);
		}

		if($table == "Furniture"){
			$sql = "INSERT INTO Furniture (SKU, )
			VALUES ('$sku', '$')";
			mysqli_query($conn,$sql);
		}
	}
}