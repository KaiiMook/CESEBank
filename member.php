<?php
	error_reporting( error_reporting() & ~E_NOTICE );
	session_start();
	
	if($_SESSION['username']){
		echo "welcome ".$_SESSION['username']."!<br><a href='logout.php'> LOGOUT </a>";
	}
	else
		die("you must be loged in");
?>