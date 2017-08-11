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
</style>
</head>



<div class='np-container'>
	<div class='np-form-holder'>
		<h4>Editing Product ID#: <?php echo $product['id'];?></h4>
		<img id='np-product-thumb' src="<?php echo  '/images/' . $product['products_image'];?>"/>
		<form id='np-form' name='edit-product' method='POST' action='edit_product_action.php'>
		<div class='np-spacer'></div>
		<?php Header('X-XSS-Protection: 0');?>
			<label>Product Name</label><br>
			<textarea style='width:100%;' name='products_name'><?php echo $product['products_name'];?></textarea>
			<div class='np-spacer'></div>

			<label>Model</label><br>
			<input type='text' name='products_model' value="<?php echo $product['products_model'];?>"/>
			<div class='np-spacer'></div>

			<label>Quantity</label><br>
			<input type='number' name='products_quantity' value="<?php echo $product['products_quantity'];?>"/><br>
			<div class='np-spacer'></div>

			<label>Turn product on/off</label><br>
			<label>On</label>
			<input type='radio' value='1' name='products_status' <?php echo ($product['products_status'] === '1' ? "checked='checked'" : null); ?> name='on'><br>
			<label>Off</label>
			<input type='radio' value='0' name='products_status' <?php echo ($product['products_status'] === '0' ? "checked='checked'" : null); ?>><br>
			<div class='np-spacer'></div>

			<label>Gross Price</label><br>
			<p><?php echo $product['products_price'];?><span style='color:red; font-size:8px;'>Edit Price in other area</span></p>
			<label>DESCRIPTION</label><br>
			<textarea type='text' id="products_description" style='width:600px; height:400px;' value="<?php echo $product['products_description'];?>"></textarea><br>
			<input type='hidden' id='base-encode' name='base-encoded-description'/>
			<div class='np-spacer'></div>
			<button type='button' id='np-submit-button'>Submit</button>
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
		console.log('got form value');
		var encoded = encodeURI(formValue);
		console.log('encoded data');
		var data = {'code':encoded};
		console.log(data);
		var check = $.ajax({
		  type: "POST",
		  url: "http://zencart.dev/adminpro/editor-workaround/edit_product_action.php",
		  data: data,
		  success: function(results){
		  	console.log('in success');
		  	console.log(results);
		  },
		  dataType: 'json'
		});
		console.log(check);
	});
	/*button.on('click', function(){
		var stuff = form.serializeArray();
		var data = "";
		console.log('in the click function');
		$.ajax({
		  type: "POST",
		  url: "edit_product_action.php",
		  data: data,
		  success: function(results){
		  	console.log('in success');
		  	console.log(results);
		  },
		  dataType: 'json'
		});
	});*/
});

</script>
