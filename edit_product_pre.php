<?php

$productId = '311';

$db_name = 'proliner_zcart';
		$db_user = 'root';
		$db_pass = 'proline55';
		$host = 'localhost';
		$charset = 'utf8';
		$table = 'products_description';	
		$conn = new mysqli($host, $db_user, $db_pass, $db_name);
		$sql = "SELECT * FROM products_description WHERE products_id=$productId";
		$result = $conn->query($sql);
		$stuff = $result->fetch_array(MYSQLI_ASSOC);



$products_description = $stuff['products_description'];
$products_id = $stuff['products_id'];
$products_name = $stuff['products_name'];

$product = array('products_id'=>$products_id, 'products_name'=>$products_name,'products_description'=>$products_description);



$db_name = 'proliner_zcart';
		$db_user = 'root';
		$db_pass = 'proline55';
		$host = 'localhost';
		$charset = 'utf8';
		$table = 'products_description';	
		$conn = new mysqli($host, $db_user, $db_pass, $db_name);
		$sql = "SELECT * FROM products WHERE products_id=$productId";
		$result = $conn->query($sql);
		$stuff = $result->fetch_array(MYSQLI_ASSOC);


$product['products_price'] = $stuff['products_price'];
$product['products_model'] = $stuff['products_model'];
$product['products_quantity'] = $stuff['products_quantity'];

require_once('new_edit_product.php');
echo "<pre>";
print_r($product);
echo "<pre>";