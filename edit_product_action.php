<?php

// I had originally been having a problem getting this to communicate but it worked just fine after making sure
// this php function responded with a json formatted 'echo'  

// Get URL Encoded description
$post_encoded = $_POST['base-encoded-description'];
// decode from base64 to URL encode
$post_base64_decoded = base64_decode($post_encoded);
// Decode description
$changed = urldecode($post_base64_decoded);

// Set Product Variables
# These will go in products_description TABLE
$products_description = $changed;
$products_name = $_POST['products_name'];

# These will go in the products TABLE
$products_model = $_POST['products_model'];
$products_quantity = (int) $_POST['products_quantity'];
$products_status = (int) $_POST['products_status'];

# ProductID to change
$products_id = $_POST['products_id'];

# Need to stop whatever is adding the extra ' "> ' at the end of all my producy desc
$check = substr($changed, -2);
if ($check == '">')
{
$changed = substr($changed, 0 , -2);
}


// Check to make sure productId actually exists
$servername = "localhost";
$username = "root";
$password = "proline55";
$dbname = "proliner_zcart";
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM products WHERE products_id = :products_id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":products_id", $products_id, PDO::PARAM_INT);
	$stmt->execute();
		if ($stmt->rowCount() > 0)
		{
			$product_exists = TRUE;
		}
	}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;



if ($product_exists === TRUE)
{



// Update product in both products and products_description table in DB


# This piece of code updates the products table
$servername = "localhost";
$username = "root";
$password = "proline55";
$dbname = "proliner_zcart";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE products
    		SET products_quantity = :products_quantity,
    			products_model = :products_model
    		WHERE products_id= :products_id";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    // Bind Parameter Placeholders
    $stmt->bindParam(':products_id', $products_id, PDO::PARAM_INT);
    $stmt->bindParam(':products_model', $products_model, PDO::PARAM_STR);
    $stmt->bindParam(':products_quantity', $products_quantity, PDO::PARAM_INT);

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

$conn = null;

# This piece of code edits the products_description table
$servername = "localhost";
$username = "root";
$password = "proline55";
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
}
if ($success = TRUE)
{
	echo "Product $products_name has been updated successfully!";
	echo "Click <a href='/adminpro/categories.php'>here to go back to product listing";
}

?> 