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

<?php var_dump($product['products_status']);?>
<?php echo $product['products_id'];?>
<div class='np-container'>
	<div class='np-form-holder'>
		<form name='edit-product'>
		<div class='np-spacer'></div>
			<label>Product Name</label><br>
			<textarea style='width:100%;' name='products_name'><?php echo $product['products_name'];?></textarea>
			<div class='np-spacer'></div>
			<label>Quantity</label>
			<input type='number' value="<?php echo $product['products_quantity'];?>"/><br>
			<div class='np-spacer'></div>
			<label>Turn product on/off</label><br>
			<label>On</label>
			<input type='radio' value='status' <?php echo ($product['products_status'] === '1' ? "checked='checked'" : null); ?> name='on'><br>
			<label>Off</label>
			<input type='radio' value='status' name='off' <?php echo ($product['products_status'] === '0' ? "checked='checked'" : null); ?>>
			<br>
			
			<div class='np-spacer'></div>
			<label>Gross Price</label><br>
			<p><?php echo $product['products_price'];?>   <span style='color:red; font-size:8px;'>Edit Price in other area</span></p>
			<label>DESCRIPTION</label><br>
			<textarea style='width:600px; height:400px;' value="<?php echo $product['products_description'];?>"/><br>
		</form>
	</div>
</div>

