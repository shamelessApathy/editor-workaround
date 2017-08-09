<head>
<style>
.np-container
{
	padding:100px;
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
</style>
</head>

<div class='np-container'>
	<div class='np-form-holder'>
		<form name='edit-product'>
			<label>Product Name</label><br>
			<input type='text' name='product-name'/ value="<?php echo $product['products_name'];?>"/><br>
			<div class='np-spacer'></div>
			<label>Gross Price</label><br>
			<input name='gross-price' type='number' value="<?php echo $product['products_price'];?>"><br><br>
			<label>DESCRIPTION</label><br>
			<textarea style='width:600px; height:400px;' value="<?php echo $product['products_description'];?>"/><br>
		</form>
	</div>
</div>

