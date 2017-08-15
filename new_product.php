<?php


// Get all category IDs
$db_name = 'proliner_zcart';
		$db_user = 'root';
		$db_pass = 'proline55';
		$host = 'localhost';
		$charset = 'utf8';
		$table = 'products_description';	
		$conn = new mysqli($host, $db_user, $db_pass, $db_name);
		$other_sql = "SELECT categories.categories_id, categories_description.categories_name
					  FROM categories 
					  INNER JOIN categories_description
					  ON categories.categories_id = categories_description.categories_id";
		//$sql = "SELECT categories_id FROM categories";
		$result = $conn->query($other_sql);
		var_dump($result);
		//$stuff = $result->fetch_assoc();
		$data = array();
		while($row = $result->fetch_assoc())
		{
 			$data[] = $row;
		}
		echo "<pre>";
		print_r($data);
		echo "</pre>";

		# Currently getting 

?>