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
#product-description
{
	height:400px;
	width:500px;
}

</style>
</head>

<div class='np-container'>
	<div class='np-form-holder'>
		<h3> New Product Creation </h3>
		<form id='np-form' name='new-product' method='POST' action='new_product_action.php'>
			
			<label>Category</label>
			<select name='products_category'>
				<?php foreach ($data as $category):?>
					<option value="<?php echo $category['categories_id'];?>"><?php echo $category['categories_name'];?></option>
				<?php endforeach;?>
			</select>

			<label>Product Status</label>
			<span>Off</span>
			<input type='radio' name='products_status' value='0'>
			<span>On</span>
			<input type='radio' name='products_status' value='1' checked='checked'>

			<label>Product Manufacturer</label>
			<input type='text' readonly value='1' name='products_manufacturer'><sub style='color:red;'>do not edit</sub>

			<label>Product Name</label>
			<input type='text' name='products_name' placeholder='product name here'>

			<label>Product Model</label>
			<input type='text' name='products_model' placeholder='product model #'>

			<div style='border:1px solid red; padding:5px;'>
			<label>[Always Free Shipping]</label>
			<p> this may need to be filled in, but I don't know if zencart programmatically checks to see if the hoods is 36" or under</p>
			</div>

			<label>Quantity</label>
			<input type='number' name='products_quantity' value='0'>

			<label>Product Description</label>
			<textarea id='product-description'></textarea>
			<input type='hidden' id='base64-product-description' name='product-description'>


			<br><button type='button' id='np-submit-button'>Submit</button>
		</form>
	</div>
</div>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<!-- TO BE MOVED INTO SEPERATE FILE -->
<script>
$(function(){
	var button = $('#np-submit-button');
	var form = $('#np-form');
	var description = $('#products_description');
	$(button).on('click', function(){
		var formValue = $(description).val();
		var encoded = encodeURI(formValue);
		var second_encoded = btoa(encoded);
		// Set Encoded form value
		$('#base64-product-description').attr('value',second_encoded);
		$('#product-description').val('');
		$('#np-form').submit();
	});
});

</script>