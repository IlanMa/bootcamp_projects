<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#picker').datepicker();
		})
	</script>
	<style type="text/css">

		#logincontainer {
			width: 320px;
			text-align: right
		}
		#registercontainer {
			width: 320px;
			text-align: right;
		}	
		#messages {
			height:15px;
			margin-left: 100px;
		}
		#badmessage {
			color: red;
		}
		#goodmessage {
			color: green;
		}
		.inline {
			display: inline-table;
		}
		h3 {
			text-align: left;
		}
		div form p {
			font-size: 12px;
			margin-top: 0px;
			margin-bottom: 0px;
		}
	</style>
</head>
<body>

	<?php 
	echo $this->session->flashdata('errors'); 
	?>
	<div id="messages">
		<div id="badmessage">
			<?php echo $this->session->flashdata('message');  ?>
		</div>
		<div id="goodmessage">
			<?php echo $this->session->flashdata('goodmessage');  ?>
		</div>
	</div>
	<div id="registercontainer" class="inline">
		<h3>Register</h3>
		<form action="/login/register" method="post">
			<input type="hidden" name="action" value="register">
			Name: <input type="text" name="name"><br>
			Alias: <input type="text" name="alias"><br>
			Email: <input type="text" name="email"><br>
			Password: <input type="password" name="password"><br>
			<p>*Password should be at least 8 characters</p>
			Confirm PW: <input type="password" name="confirm_password"><br>	
			Date of Birth: <input type="text" name="birth" id="picker" placeholder="Pick Date">
			<input type="submit" value="Register">
		</form>
	</div>
	<div id="logincontainer" class="inline">
		<h3>Log In</h3>
		<form action="/login/checklogin" method="post">
			<input type="hidden" name="action" value="login">
			Email:<input type="text" name="email"><br>
			Password:<input type="password" name="password"><br>
			<input type="submit" value="Login">
		</form>
	</div>
</body>
</html>