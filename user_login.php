<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if($username&&$password)
{
	$connect = mysql_connect("localhost","root","")  or die ("can't connect");
	mysql_select_db("cesebank") or die ("can't find db");
	$query = mysql_query("SELECT * FROM customerinfo WHERE username='$username'");
	$numrows = mysql_num_rows($query);
	if($numrows != 0)
	{
		while($row = mysql_fetch_assoc($query))
		{
				$usn = $row['username'];
				$pw  = $row['password'];
		}
		if($username==$usn&&$password==$pw)
		{
			//echo ("correct!! <a href='member.php'> click </a> here to customer page");
			$_SESSION['username'] = $username ;
			header('Location:Financial-info-statement.php');
		}
		else
			echo ("incorrect password");

	}
	else
		die("that operator doesn't exist.");
	
		
		
}
else
	die ("plaese enter username and password");

?>
