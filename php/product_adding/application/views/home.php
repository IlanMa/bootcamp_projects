<!DOCTYPE html>
<html>
<head>
	<title>Products Listings</title>
	<style type="text/css">
		h3 {
			display: inline-table;
			font-weight: bold;
		}
		p {
			display: inline-table;
			margin-left: 350px;
			font-size: 20px;
			text-decoration: underline;
		}
		th {
			width: 50px;
			padding-right: 10px;
		}
		h5 {
			color: green;
			font-size: 20px;
			margin-top: 0px;
		}
		h6 {
			font-size: 16px;
			margin-top: 100px;
		}


	</style>
</head>
<body>
	<div>
		<h3>Products</h3>
		<p><a href="/listings/checkout">Your Cart (<?php echo $this->session->userdata('cart'); ?>)</a></p>
	</div>
	<table>
		<thead>
			<tr>
				<th>Description</th>
				<th>Price</th>
				<th>Qty</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($items as $product){
				echo '<tr><td>'.$product['product'].'</td><td>'.$product['price'].'</td><td><form action="/listings/buy" method="post">
						<select name="qty">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select></td><td><input type="hidden" name="action" value="'.$product['product'].'">
						<input type="submit" value="Buy"></form></td></tr>';
			}

			 ?>
	
	</table>
		<h5><?php echo $this->session->flashdata('order'); ?></h5>
		<h6><a href="/listings/add">Add/Remove Product</a></h6>
</body>
</html>