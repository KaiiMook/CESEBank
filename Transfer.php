<?php
session_start();
if(!isset($_SESSION['username'])){
   header("Location:Login.html");
}
?>



<!DOCTYPE html>
<html>
<form action='transbank.php' method='POST'>
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
 		<div class="Transfer-head"></div>
	 	<div class="container-fluid trans-blog" style="padding-bottom: 4vw;">
	 		<div class="row" style="margin-left: 2vw;">
	 			<h2>Transfer</h2>
	 		</div>
	 		<div class="row">
	 			<div class="col-xs-3 col-xs-offset-2">
	 				<h4>Bank destination</h4>
	 			</div>
	 			<div class="col-xs-4">
	 				<h4>
	 				<select name="bank" id="bank" onchange="" size="1">
						<option value="1"> CESE BANK </option>
					    <option value="2"> The Real BANK </option>
					    <option value="3"> KMITL BANK </option>
					</select>
					</h4>
	 			</div>
 			</div>
	 		<div class="row">
	 			<div class="col-xs-3 col-xs-offset-2">
	 				<h4>Account NO.</h4>
	 			</div>
	 			<div class="col-xs-4">
	 				<h4><input type="text" name="name">
	 				</h4>
	 			</div>
	 		</div>
	 		<div class="row">
	 			<div class="col-xs-3 col-xs-offset-2">
	 				<h4>Amount</h4>
	 			</div>
	 			<div class="col-xs-4">
	 				<h4><input type="text" name="name1">
	 				</h4>
	 			</div>
	 		</div>
	 		<div class="row text-center" style="margin-top: 2vw;">
	 			<div class="col-xs-1 col-xs-offset-3">
	 			<h4>
	 			<button class="submit-button" type="submit">Transfer</button>
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
