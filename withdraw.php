<?php
session_start();

$ctz = $_POST['citi'];
$account = $_POST['account'];
$amount = $_POST['amount'];
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

if($ctz&&$account&&$amount)
{
	$connect = mysql_connect("localhost","root","")  or die ("can't connect");
	mysql_select_db("cesebank") or die ("can't find db");
	
	$query = mysql_query("SELECT idcustomer,balance FROM accountinfo WHERE idaccounwitpf='$account' ");
	$r = mysql_fetch_array($query);
	$n = $r['idcustomer'];
	$query1 = mysql_query("SELECT idcustomer,citizenidcompanyid FROM customerinfo WHERE idcustomer='$n' AND citizenidcompanyid = '$ctz' ");
	$t = mysql_fetch_array($query1);
	$op = $_SESSION['username'];
	$query2 = mysql_query("SELECT  idoperator, opname FROM operatorinfo WHERE  opusername='$op'");
	$bh = mysql_fetch_array($query2);
	$bywho = $bh['idoperator'];
	//echo $t['idcustomer'].$t['citizenidcompanyid'];
	$numrows = mysql_num_rows($query1);
	$numrows1 = mysql_num_rows($query2);
	if($numrows == 1){
		echo "correct person";
		if ($r['balance']>= $amount)
		{
			$newbalance = $r['balance'] - $amount ;
			//echo $newbalance;
			$sql = "UPDATE accountinfo SET balance='$newbalance' WHERE idcustomer='$n'";
			$retval = mysql_query( $sql, $connect );
			if (! $retval ) 
			{
            die('Could not enter data to accountinfo: ' . mysql_error());
        	}
		
    		echo "<h4> WITHDRAW successfully total money remain : ".$newbalance." <a href='Operator-Withdraw.php'> click </a> to return </h4> " ;
    		//echo $_SESSION['username'];
    		$sql = "INSERT INTO operationlog (bytype,bywho,operationtype,amount,destinationaccount,crbalance) VALUES ('OP','".$bywho."','WD','".$amount."','".$account."','".$newbalance."')";
			$retval = mysql_query( $sql, $connect );

			if(! $retval ) 
			{
               die('Could not enter data: ' . mysql_error());
            }
    	}
    	else
    		echo "<h4> not enough money to withdraw <a href='Operator-Withdraw.php'> click </a> to return </h4> ";

	}
	else
		echo "<h4> not owner can't with draw </h4> ";
	
	

	
}
else
	die ("<h4> plaese enter all information. </h4>");

?>
