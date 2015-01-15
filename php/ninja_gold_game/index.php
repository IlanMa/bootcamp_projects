<?php 
	session_start();
	if(!isset($_SESSION['gold'])){
		$_SESSION['gold'] = 0;
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Pimpin ain't easy</title>
<link type="text/css" rel="stylesheet" href="style.css"/>
 </head>
 <body>
 <div id="gold">
 	<h2>Your Gold</h2>
 	<div>
 		<?php 
 		if(isset($_SESSION['gold'])){
		echo $_SESSION['gold'];
		} ?>

 	</div>
 </div>
 <div class="buildings">
 	<h2>Farm</h2>
 	<h3>(earns 10-20 golds)</h3>
 	<form action="process.php" method="post">
 		<input class="submit" type="submit" name="farm" value="Find Gold!"/>
 	</form>
 </div> 

 <div class="buildings">
 	<h2>Cave</h2>
 	<h3>(earns 5-10 golds)</h3>
 	<form action="process.php" method="post">
 		<input class="submit" type="submit" name="cave" value="Find Gold!"/>
 	</form>
 </div> 

 <div class="buildings">
 	<h2>House</h2>
 	<h3>(earns 2-5 golds)</h3>
 	<form action="process.php" method="post">
 		<input class="submit" type="submit" name="house" value="Find Gold!"/>
 	</form>
 </div> 

 <div class="buildings">
 	<h2>Casino!</h2>
 	<h3>(earns/takes 0-50 golds)</h3>
 	<form action="process.php" method="post">
 		<input class="submit" type="submit" name="casino" value="Find Gold!"/>
 	</form>
 </div>
 <p>Activties:</p>
 <div id="activities" >
 	<?php 	
 	if(isset($_SESSION['event'])){
 		echo implode(' ', ($_SESSION['event']));
		} ?>
 </div>
 <form action="process.php" method="post">
 		<input class="submit" type="submit" name="reset" value="Reset"/>
 </form>

 </body>
 </html>

