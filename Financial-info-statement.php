<?php
session_start();
if(!isset($_SESSION['username'])){
   header("Location:Login.html");
}

?>
	
		
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
		 				
		 			</div>
		 			<!-- NEWS -->
		 			<div class="Finance-blog3"></div>
	 				<!-- STATEMENT -->
	 				<div class="row">
	 					<div class="col-xs-8">	
		 					<div class="col-xs-3 col-xs-offset-1">
		 						<h4>
		 							<a class="statement-button" href="Financial-info.php">
		 							Transaction
		 							</a>
		 						</h4>
		 					</div>
		 					<div class="col-xs-3">
		 						<h4>
		 							<a class="statement-active" href="Financial-info-statement.php">
		 							Statement
		 							</a>
		 						</h4>
		 					</div>
		 				</div>
	 				</div>
		 			<div class="row fi-blog2" style="margin-left: 1vw;">
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
	 				</div>
	 				<div class="row" style="margin-left: 3vw;">
	 					<br/>
	 					
						
						<br/>
	 				</div>
	 				<div class="row fi-transac">
	 					<table class="table table-bordered" style="background-color: white;">
	 						<tr>
		 						<th>order</th>
		 						<th>date</th>
		 						<th>code</th>
		 						<th>transaction</th>
		 						<th>from</th>
		 						<th>to</th>
		 						<th>amount</th>
		 						<th>balance</th>
		 					</tr>
		 					<?php 
		 						$idacc = $dp['idaccounwitpf'];
		 						//echo $idacc;
		 						$state = mysql_query("SELECT * FROM operationlog WHERE sourceaccount = '$idacc' OR destinationaccount = '$idacc'");
		 						
		 						$row1 = mysql_num_rows($state);
		 						//echo $row1;
		 						
		 						while($row = mysql_fetch_array($state)){ 
		 								$ts = 'none';
		 							if ($row['operationtype'] == 'CA')
		 								$ts = "create account";
		 							if ($row['operationtype'] == 'DP')
		 								$ts = "deposit";
		 							if ($row['operationtype'] == 'WD')
		 								$ts = "withdraw";
		 							if ($row['operationtype'] == 'TF')
		 								$ts = "transfer";
		 							if (($row['operationtype'] == 'DP' && $row['destinationaccount'] == $idacc ) || ($row['operationtype'] == 'TF' && $row['sourceaccount'] == $idacc) || $row['operationtype'] == 'WD' ){

		 							echo "<tr><td>" . $row['idoperation'] . "</td><td>" . $row['optime'] . "</td><td>". $row['operationtype'] . "</td><td>". $ts ."</td><td>" .$row['sourceaccount']."</td><td>" .$row['destinationaccount']."</td><td>".$row['amount'] ."</td><td>".$row['crbalance']."</td></tr>" ;  
		 							}
								}
								
		 						mysql_close($connect);

		 					?>
		 					
	 					</table>
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
	</html>
