<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<style type="text/css">
		form {
			margin-left: 300px;
		}
		#goodmessage {
			color: green;
			height: 15px;
			font-weight: bold;
		}
	</style>
</head>
	<body>
		<div id="goodmessage">
			<?php 	echo $this->session->flashdata('tempmessage');	 ?>
		</div>
		<div>
			<form action="/login/logout" method="post">
				<input type="submit" value="Logout">
			</form>
		</div>
 		<p>Welcome <?php echo $this->session->userdata('sessionAcc')[0]['first_name']; ?>!</p>
 		<h4>User Information</h4>
 		<p>First Name: <?php echo $this->session->userdata('sessionAcc')[0]['first_name'] ?></p>
 		<p>Last Name: <?php echo $this->session->userdata('sessionAcc')[0]['last_name'] ?></p>
 		<p>Email Address: <?php echo $this->session->userdata('sessionAcc')[0]['email'] ?></p>
	</body>
</html>