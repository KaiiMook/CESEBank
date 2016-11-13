<?php
session_start();
if(!isset($_SESSION['username'])){
   header("Location:Login.html");
}
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
 		<div class="Finance-head"></div>
	 	<div class="container">
	 		<div class="row">
	 			<!-- WELCOME -->
	 			<div class="col-xs-8">
	 				<div class="Finance-blog1"></div>
	 				<!-- STATEMENT -->
	 				<div class="row">
	 					<div class="col-xs-3 col-xs-offset-1">
	 						<h4>
	 							<a class="statement-active" href="Financial-info.php">
	 							Transaction
	 							</a>
	 						</h4>
	 					</div>
	 					<div class="col-xs-3">
	 						<h4>
	 							<a class="statement-button" href="Financial-info-statement.php">
	 							Statement
	 							</a>
	 						</h4>
	 					</div>
	 				</div>
	 				<div class="row fi-blog2">
	 					<div class="row">
	 						<div class="col-xs-4">
	 							<h4>
	 								Bank balance(bath)
	 							</h4>
	 						</div>
	 						<div class="col-xs-3">
	 							<h4>
	 									 <?php
										
											$connect = mysql_connect("localhost","root","")  or die ("can't connect");
											mysql_select_db("cesebank") or die ("can't find db");
											$usdisplay = $_SESSION['username'];
											$queryusdisplay = mysql_query("SELECT * FROM customerinfo WHERE  username='$usdisplay'");
											$display = mysql_fetch_array($queryusdisplay);
											$dpname = $display['name'];
											$dpsurname = $display['surname'];
											$id4ac = $display['idcustomer'];
											$queryaccount = mysql_query("SELECT * FROM accountinfo WHERE  idcustomer='$id4ac'"); $dp = mysql_fetch_array($queryaccount);
											$bl = $dp['balance']; 
											echo $bl;
										?>
	 							</h4>
	 						</div>
	 					</div>
	 					<div class="row">
	 						<div class="col-xs-4">
	 							<h4>
	 								Cash(bath)
	 							</h4>
	 						</div>
	 						<div class="col-xs-3">
	 							<h4>
	 								<?php echo $bl; ?>
	 							</h4>
	 						</div>
	 					</div>
	 					
	 					<div class="row">
	 						<div class="col-xs-10">
		 						<h5>•	Insurance products are offered through Merrill Lynch Life Agency Inc., Bank of America, N.A. and/or Banc of America Insurance Services, Inc.,</h5>
	 						</div>
	 					</div>
	 				</div>
	 			</div>
	 			<!-- NEWS -->
	 			<div class="Finance-blog2"></div>
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
</html>