<?php
session_start();
$bankk = $_POST['bank'];
$accountt = $_POST['name'];
$amountt = $_POST['name1'];	 

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
<body style="background: #fff url(img/op-bg.png) no-repeat fixed right bottom; background-size: contain;"">
 	<div class="container-fluid">
 		<div class="Operator-create-head"></div>
	 	<div class="container">
	 		<div class="row">






<?php
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
		if (! $retval ) 
		{
            die('Could not enter data to accountinfo: ' . mysql_error());
        }
        		
    	else
    		echo "<h4>transfer to account ".$accountt."  ".$namedp."  ".$surnamedp." successfully amount : ".$amountt ." total money remain : ".$newbalances." <a href='Transfer.php'> click </a> to return</h4>" ;
    	//echo $_SESSION['username'];
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