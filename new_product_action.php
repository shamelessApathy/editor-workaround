<?php
require_once('.env');
// I had originally been having a problem getting this to communicate but it worked just fine after making sure
// this php function responded with a json formatted 'echo'  

// Get URL Encoded description
$post_encoded = $_POST['product-description'];
// decode from base64 to URL encode
$post_base64_decoded = base64_decode($post_encoded);
// Decode description
$changed = urldecode($post_base64_decoded);

// Set Product Variables
# These will go in products_description TABLE
$products_description = $changed;
$products_name = $_POST['products_name'];
$products_manufacturer = $_POST['products_manufacturer'];

# These will go in the products TABLE
$products_model = $_POST['products_model'];
$products_quantity = (int) $_POST['products_quantity'];
$products_status = (int) $_POST['products_status'];
$products_category = $_POST['products_category'];

# This piece of code updates the products table
$servername = "localhost";
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname = "proliner_zcart";
date_default_timezone_set('America/Denver');
$date = date('Y-m-d H:i:s');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO products
    		SET products_quantity = :products_quantity,
    			products_model = :products_model,
    			fishbowl_update = :date_time,
    			master_categories_id = :products_category_id,
    			manufacturers_id = :products_manufacturer,
    			products_status = :products_status";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    // Bind Parameter Placeholders
    $stmt->bindParam(':products_model', $products_model, PDO::PARAM_STR);
    $stmt->bindParam(':products_quantity', $products_quantity, PDO::PARAM_INT);
    $stmt->bindParam(':products_status', $products_status, PDO::PARAM_INT);
    $stmt->bindParam(':products_category_id', $products_category, PDO::PARAM_INT);
    $stmt->bindParam(':products_manufacturer', $products_manufacturer, PDO::PARAM_INT);
    $stmt->bindParam(':date_time', $date, PDO::PARAM_STR);

    // execute the query
	$stmt->execute();
	// Get the newly created ProductID
	$products_id = $conn->lastInsertId();
	    
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

// Need to update the product description table now
$servername = "localhost";
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname = "proliner_zcart";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE products_description
    		SET products_description = :products_description,
    			products_name = :products_name
    		WHERE products_id = :products_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":products_description", $products_description, PDO::PARAM_STR);
    $stmt->bindParam(":products_name", $products_name, PDO::PARAM_STR);  
    $stmt->bindParam(":products_id", $products_id, PDO::PARAM_INT);  
    // execute the query
    if ($stmt->execute())
    {
    	$success = TRUE;
    }

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
if ($success = TRUE)
{
	echo "Product $products_name has been created successfully!";
	echo "Click <a href='/adminpro/categories.php'>here to go back to product listing";
}
?>