<?php
session_start();
if(!isset($_SESSION['username'])){
   header("Location:Login.html");
}
	$connect = mysql_connect("localhost","root","")  or die ("can't connect");
	mysql_select_db("cesebank") or die ("can't find db");
	$usdisplay = $_SESSION['username'];
	$queryusdisplay = mysql_query("SELECT * FROM customerinfo WHERE  username='$usdisplay'");
	$display = mysql_fetch_array($queryusdisplay);
	$dpname = $display['name'];
	$dpsurname = $display['surname'];
	$id4ac = $display['idcustomer'];
	$newotp = rand(111111,999999);
	$sqlc = "UPDATE accountinfo SET otp = '$newotp' WHERE  idcustomer='$id4ac'";
	$retval = mysql_query( $sqlc, $connect );
	if (! $retval ) 
	{
    	die('Could not enter data to accountinfo: ' . mysql_error());
	}
	$queryaccount = mysql_query("SELECT * FROM accountinfo WHERE  idcustomer='$id4ac'");
	$dp = mysql_fetch_array($queryaccount);
	$otp = $dp['otp'];	
?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>-CESE BANK-</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
 	<div class="container-fluid">
 		<div class="Requestotp-head"></div>
	 	<div class="container-fluid trans-blog" style="padding-bottom: 4vw;">
	 		<div class="row" style="margin-left: 2vw;">
	 			<h2>Request One Time Password</h2>
	 		</div>
	 		<div class="row">
	 			<div class="col-xs-3 col-xs-offset-2">
	 				<h4>Your OTP</h4>
	 			</div>
	 			<div class="col-xs-4">
	 				<h4>
	 				<?php
	 				echo $otp;
	 				?>

	 				</h4>
	 			</div>
	 		</div>
	 		<div class="row text-center" style="margin-top: 2vw;">
	 			<div class="col-xs-2 col-xs-offset-1">
	 			<h4>
	 			<a class="submit-button" value="Refresh Page" onClick="window.location.reload()">Request New OTP</a>
	 			</h4>
	 			</div>
	 		</div>
	 	</div>
 	</div>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <!-- My js -->
    <script type="text/javascript" src="js/jquery.js"></script>

</body>
</form>
</html>
<?php
mysql_close($connect);	
?>