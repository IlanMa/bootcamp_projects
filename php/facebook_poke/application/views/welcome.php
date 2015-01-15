<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<style type="text/css">
		#logout {
			margin-left: 300px;
		}
		.inline{
			display: inline-table;
		}
		h4 {
			margin-top: 0px;
			margin-bottom: 0px;
		}
		h5 {
			margin-top: 0px;
		}
		#poke {
			border: 1px solid black;
			width: 300px;
			height: 50px;
			border-radius: 10px;
			padding-top: 10px;
		}
		td {
			border-left: 1px solid black;
			border-right: 1px solid black;
			text-align: center;
		}
		table {
			border-collapse: collapse;
			border: 1px solid black;
		}
		th {
			border: 1px solid black;
			background-color: gray;
		}
		#topDiv p
		{
			margin-left: 440px;
			margin-bottom: 0px;
		}


	</style>
</head>
<body>
	<div id="topDiv">
		<h4 class="inline">Welcome, <?php echo $this->session->userdata('currentAcc')[0]['alias']; ?>!</h4>
		<p class="inline"><a href="/login/logout">Logout</a></p>
	</div>
	<h5><?php echo $this->session->userdata('currentAcc')[0]['pokedsince']; ?> times poked since last login!</h5>
	<div id="poke">
		You have been poked a total of <?php echo $this->session->userdata('currentAcc')[0]['poke'] ?> times across all your friends!
	</div>
	<p>People you may want to poke:</p>
	<table>
		<thead>
			<tr>
				<th width="150px">Name</th>
				<th width="50px">Alias</th>
				<th width="200px">Email Address</th>
				<th width="100px">Poke History</th>
				<th width="75px">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach ($this->session->userdata('accounts') as $user){
				if($this->session->userdata('currentAcc')[0]['id'] != $user['id']){
					echo
					'<tr>
						<td>'.$user['name'].'</td>
						<td>'.$user['alias'].'</td>
						<td>'.$user['email'].'</td>
						<td>'.$user['poke'].' pokes</td>
						<td>
						<form action="/login/poke/'.$user['id'].'" method="post">
							<input type="submit" value="Poke!">
						</form>
						</td>
					<tr>';
				}
			}
		?>
		</tbody>
	 </table>
</body>
</html>