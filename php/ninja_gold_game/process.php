<?php 
	session_start();

if(isset($_POST['reset'])) {
session_destroy();
}
elseif(isset($_POST['farm'])) {
$location = $_SESSION['enter'] = "farm";
$gain = $gold_gain = rand(10,20);	
}
else if(isset($_POST['cave'])) {
$location = $_SESSION['enter'] = "cave";
$gain = $gold_gain = rand(5,10);
}
else if (isset($_POST['house'])) {
$location = $_SESSION['enter'] = "house";
$gain = $gold_gain = rand(2,5);
}
elseif (isset($_POST['casino'])) {
$location = $_SESSION['enter'] = "casino";
$casino_chance = rand(1,100);
	if($casino_chance <= 70){
	$gain =	$gold_gain = rand(0,50);
	}else{
	$gain =	$gold_gain = rand(0,-50);
	$red = true;
	}		

}

if(!isset($_SESSION['event'])) {
$_SESSION['event'] = array();
}
if($red){
array_unshift($_SESSION['event'], '<p class=red>You entered a'.' '.$location.' '. 'and lost'.' '.$gain.' '. 'golds ...Ouch..'.' ('.date("D M d, Y G:i a"). ')<p>');
}else {
array_unshift($_SESSION['event'], '<p class=green>You entered a'.' '.$location.' '. 'and earned'.' '.$gain.' '. 'golds'.' ('.date("D M d, Y G:i a"). ')<p>');
}

$_SESSION['gold'] = $_SESSION['gold'] + $gold_gain;
header('location: index.php');
 ?>