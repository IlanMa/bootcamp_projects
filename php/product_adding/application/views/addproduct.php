<html>
<head>
	<title>Add Product</title>
	<style type="text/css">
	div {
		width: 200px;
	}
	.button {
		display: inline-table;
		width: 100px;
	}
	</style>
</head>
<body>
	<h2>Delete a Product</h2>
	<table>
		<?php 
		foreach ($this->session->userdata('listing') as $product){
			echo '<tr><td>'.$product['product'].'</td><td>'.$product['price'].'</td>
		<td><form action="/listings/deleteProduct" method="post">
			<input type="hidden" name="action" value="'.$product['product'].'">
			<input type="submit" value="Delete"></td>
		</form></tr>';

		}

		 ?>
		</table>
	<h2>Add a Product</h2>
	<div>
		<form action="/listings/addproduct" method="post">
			<input type="hidden" name="action" value="add">
			Description: <input type="text" name="description"><br>
			Price: <input type="text" name="price">
			<input type="submit" value="Add" class="button">
		</form>
		<form action="/listings" method="post">
			<input type="hidden" name="action" value="cancel">
			<input type="submit" value="Cancel" class="button">
		</form>
	</div>
</body>
</html>