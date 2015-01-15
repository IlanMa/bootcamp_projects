<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
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
	</style>
</head>
<body>
	<?php var_dump($this->session->userdata('errors')); ?>
	<div id="messages">
		<div id="badmessage">
			<?php echo $this->session->flashdata('message');  ?>
		</div>
		<div id="goodmessage">
			<?php echo $this->session->flashdata('goodmessage');  ?>
		</div>
	</div>
	<h3>Log In</h3>
	<div id="logincontainer">
		<form action="/login/checklogin" method="post">
			<input type="hidden" name="action" value="login">
			Email:<input type="text" name="email"><br>
			Password:<input type="text" name="password"><br>
			<input type="submit" value="Login">
		</form>
	</div>
	<h3>Or Register</h3>
	<div id="registercontainer">
		<form action="/login/register" method="post">
			<input type="hidden" name="action" value="register">
			First Name:<input type="text" name="first_name"><br>
			Last Name:<input type="text" name="last_name"><br>
			Email Address:<input type="text" name="email"><br>
			Password:<input type="password" name="password"><br>
			Confirm Password:<input type="password" name="confirm_password"><br>	
			<input type="submit" value="Register">
		</form>
	</div>
</body>
</html>