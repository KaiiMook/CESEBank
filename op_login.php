<?php
session_start();
$username = $_POST["username"];
$password = $_POST["password"];

if($username&&$password)
{
	$connect = mysql_connect("localhost","root","")  or die ("can't connect");
	mysql_select_db("cesebank") or die ("can't find db");
	$query = mysql_query("SELECT * FROM operatorinfo WHERE opusername='$username'");
	$numrows = mysql_num_rows($query);
	if($numrows != 0){
		while($row = mysql_fetch_assoc($query))
		{
				$operatorusn = $row['opusername'];
				$operatorpw  = $row['oppassword'];
		}
		if($username==$operatorusn&&$password==$operatorpw)
		{
			//echo ("correct!!");
			$_SESSION['username'] = $username ;
			header('Location:Operator-Create.php');
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
