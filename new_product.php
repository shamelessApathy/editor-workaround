<?php
// Load environment variables
require_once('.env');

// Get all category IDs and theire names
$db_name = 'proliner_zcart';
		$db_user = $_ENV['DB_USER'];
		$db_pass = $_ENV['DB_PASS'];
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
		// put all results into seperate associative arrays
		$data = array();
		while($row = $result->fetch_assoc())
		{
 			$data[] = $row;
		}
?>


<!-- HTML SECTION -->

<head>
<style>
*
{
	margin-top:20px;
}
.np-container
{
	width:100%;
}
.np-form-holder
{
	width:500px;
	margin:0 auto;
	background:white;
}
.np-spacer
{
	width:100%;
	height:25px;
}
#np-product-thumb
{
	max-height:50px;
	max-width:50px;
}
label
{
	display:block;
	font-family:helvetica;
}

</style>
</head>

<div class='np-container'>
	<div class='np-form-holder'>
		<h3> New Product Creation </h3>
		<form name='new-product' method='POST' action='new_product_action.php'>
			<label>Category</label>
			<select name='products_category'>
				<?php foreach ($data as $category):?>
					<option value="<?php echo $category['categories_id'];?>"><?php echo $category['categories_name'];?></option>
				<?php endforeach;?>
			</select>
			<input type='submit'>
		</form>
	</div>
</div>