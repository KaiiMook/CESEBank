<?php
session_start();
$bankk = $_POST['bank'];
$accountt = $_POST['name'];
$amountt = $_POST['name1'];	 
if($bankk&&$accountt&&$amountt)
{
	$connect = mysql_connect("localhost","root","")  or die ("can't connect");
	mysql_select_db("cesebank") or die ("can't find db");
	//destination
	$query = mysql_query("SELECT idcustomer,balance FROM accountinfo WHERE idaccounwitpf='$accountt' ");
	$r = mysql_fetch_array($query);
	$n = $r['idcustomer'];
	//$query1 = mysql_query("SELECT idcustomer,citizenidcompanyid FROM customerinfo WHERE idcustomer='$n' AND citizenidcompanyid = '$ctz' ");
	//$t = mysql_fetch_array($query1);
	//source
	$op = $_SESSION['username'];
	$query2 = mysql_query("SELECT idcustomer FROM customerinfo WHERE  username='$op'");
	$q2 = mysql_fetch_array($query2);
	$qq2 = $q2['idcustomer'];
	$query3 = mysql_query("SELECT * FROM accountinfo WHERE idcustomer='$qq2'");
	$bh = mysql_fetch_array($query3);
	$querye = mysql_query("SELECT  * FROM accountinfo WHERE  idaccounwitpf='$accountt'");
	$dpn = mysql_fetch_array($querye);
	$idacc = $dpn['idcustomer'];
	$bywho = $bh['idcustomer'];
	$byacc = $bh['idaccounwitpf'];
	//echo $t['idcustomer'].$t['citizenidcompanyid'];
	$numrows = mysql_num_rows($query);
	if($numrows == 1 && $bankk == '1' ){

		
		$newbalance = $r['balance'] + $amountt ;
		$newbalances = $bh['balance'] - $amountt; 
		//echo $newbalance;
		$sql = "UPDATE accountinfo SET balance='$newbalance' WHERE idcustomer='$n'";
		$retval = mysql_query( $sql, $connect );
		$deposittor = $bh['idaccounwitpf'];
		$query4 = mysql_query("SELECT  * FROM customerinfo WHERE  idcustomer='$idacc'");
		$dpn1 = mysql_fetch_array($query4);
		$namedp = $dpn1['name'];
		$surnamedp = $dpn1['surname'];
		
		
		if (! $retval ) 
		{
            die('Could not enter data to accountinfo: ' . mysql_error());
        }

		$sql = "UPDATE accountinfo SET balance='$newbalances' WHERE idcustomer='$bywho'";
		$retval = mysql_query( $sql, $connect );
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
 		<div class="Transfer-head"></div>
	 	<div class="container-fluid trans-blog" style="padding-bottom: 4vw;">
	 		<div class="row" style="margin-left: 2vw;">
	 			<h2>Transcript</h2>
	 		</div>
	 		<div class="row">
	 		<?php
		if (! $retval ) 
		{
            die('Could not enter data to accountinfo: ' . mysql_error());
        }
        		
    	else

    		echo "<h4>---- Successfully transfer ----<br/> From account".$byacc."<br/>Transfer to account : ".$accountt."<br/>Name : ".$namedp."  ".$surnamedp." <br/> Amount : ".$amountt ."<br/> Total money remain : ".$newbalances."<br/> <a class="submit-button" href='Transfer.php'> click to return</a></h4>" ;
    	//echo $_SESSION['username'];
    	?>
	 			<div class="col-xs-3 col-xs-offset-2">
	 				<h4>Bank destination</h4>
	 			</div>
	 			<div class="col-xs-4">
	 				<h4>
	 				<select name="bank" id="bank" onchange="" size="1">
						<option value="1"> CESE BANK </option>
					    <option value="2"> NONTAWAT BANK </option>
					    <option value="3"> ATTHASIT BANK </option>
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
<?php
$sql = "INSERT INTO operationlog (bytype,bywho,operationtype,amount,destinationaccount,sourceaccount,crbalance) VALUES ('CM','".$bywho."','TF','".$amountt."','".$accountt."','".$deposittor."','".$newbalances."'),('CM','".$bywho."','DP','".$amountt."','".$accountt."','".$deposittor."','".$newbalance."')";	
		$retval = mysql_query( $sql, $connect );
		if(! $retval ) 
		{
            die('Could not enter data: ' . mysql_error());
        }
        
	}
	else
	{
		if($bankk != 1)
			echo "can't transfer to other bank right now.";
		else
			echo "that account no. doesn't exist.";
	}
		
	
}
else
	die ("plaese enter all information.");

mysql_close($connect);
?>