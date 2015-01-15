<!DOCTYPE html>
<html>
<head>
	<title>Check Out</title>
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
		h4 {
			border-top: solid 1px black;
			width: 280px;
			font-size: 20px;
			text-align: center;
			margin-top: 5px;
			padding-top: 5px;
		}
		td{
			text-align: center;
		}
		#form {
			width: 250px;
			text-align: right;
		}
		h5 {
			font-size: 20px;
		}
</style>
</head>
<body>
	<h3>Check Out</h3>
	<table>
		<thead>
			<tr>
				<th>Qty</th>
				<th>Description</th>
				<th>Price</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			 foreach ($this->session->userdata('listing') as $product){
			 	if (empty($this->session->userdata($product['product'].'tqty'))){
			 		$this->session->set_userdata($product['product'].'tqty', 0);
			 	}
			 	echo '<tr><td>'.$this->session->userdata($product['product'].'tqty').'</td><td>'.
			 	$product['product'].'</td><td>$'.$product['price'] * $this->session->userdata($product['product'].'tqty').'</td><td>
			 	<form action="/listings/delete" method="post">
			 		<input type="hidden" name="action" value="'.$product['product'].'">
			 		<input type="submit" value="Delete"></td>
			 	</form><tr>';
			 	$this->session->set_userdata($product['product'].'price', $product['price']);
			 }
			$this->session->set_userdata('totalprice', 0);
			foreach ($this->session->userdata('listing') as $product){
				$this->session->set_userdata('totalprice', $this->session->userdata('totalprice') + $product['price'] * $this->session->userdata($product['product'].'tqty'));
			}
			 ?>

	</table>
	<h4>Total $<?php echo $this->session->userdata('totalprice'); ?></h4>
	<h5>Billing Info</h5>
	<div id="form">
		<form action="/listings/order" method="post">
			<input type="hidden" name="action" value="order">
			Name: <input type="text" name="Name">
			Address: <input type="text" name="Address">
			Card #: <input type="text" name="Card">
			<input type="submit" value="Order">
		</form>
	</div>
</body>
</html>