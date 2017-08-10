<?php
/**
*
*	This entire editor-workaround was created because the behavior of Proline's Zencart
*   Installation has become erratic. A broswer error in multiple different browsers (ie: 
*   Chrome, Firefox, Safari) BROSWER ERROR STILL UNKNOWN 
*	Somewhere in zencart's product editor/creator functionality the problems lie
*	1. The browser thinks some element in the editor page is insecure, and cuts the database
*		query while zencart still thinks it's updating the product, this then causes it to
*      wipe whatever database entry was already there to nothing
*	2. For some reason, we do not have the ability to create new products with zencart's
*	   Current functionality, so I am creating both editors and new product creators outside
*	   of using zencarts functions in order to have something that I know will work since 
*      it's directly manipulating the database through my own commands
*    UPDATE: Here is chrome's error reasoning ERR_BLOCKED_BY_XSS_AUDITOR
*
*/

// Sending header reference maybe this will fix the chrome bug??
header('X-XSS-Protection:0');

$productId = '311';
$productId = (int) $productId;
$db_name = 'proliner_zcart';
		$db_user = 'root';
		$db_pass = '***';
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


$product = array(
	'products_id'=>$products_id, 
	'products_name'=>$products_name,
	'products_description'=>$products_description,


	);



$db_name = 'proliner_zcart';
		$db_user = 'root';
		$db_pass = '***';
		$host = 'localhost';
		$charset = 'utf8';
		$table = 'products_description';	
		$conn = new mysqli($host, $db_user, $db_pass, $db_name);
		$sql = "SELECT * FROM products WHERE products_id=$productId";
		$result = $conn->query($sql);
		$stuff = $result->fetch_array(MYSQLI_ASSOC);

$products_id = $productId;
$products_quantity = $stuff['products_quantity'];
$products_price = $stuff['products_price'];
$products_status = $stuff['products_status'];
$products_model = $stuff['products_model'];
$products_type = $stuff['products_type'];

/*
* I don't know why I originally started with defining these variables before hand
* then setting them to the correct array['key'] afterwards to prepare them for the view
* -B
*/
$product['id'] = $products_id;
$product['products_model'] = $products_model;
$product['products_status'] = $products_status;
$product['products_quantity'] = $products_quantity;
$product['products_price'] = $products_price;
// Apparently I stopped here, much less typing ;-)
$product['products_price'] = $stuff['products_price'];
$product['products_model'] = $stuff['products_model'];
$product['products_quantity'] = $stuff['products_quantity'];
$product['products_image'] = $stuff['products_image'];
require_once('new_edit_product.php');

