<?php
session_start();

$name = $_POST['name'];
$surname = $_POST['surname'];
$tel = $_POST['tel'];
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

if($name&&$account&&$amount&&$tel)
{
	$connect = mysql_connect("localhost","root","")  or die ("can't connect");
	mysql_select_db("cesebank") or die ("can't find db");
	
	$query = mysql_query("SELECT idcustomer,balance FROM accountinfo WHERE idaccounwitpf='$account' ");
	$r = mysql_fetch_array($query);
	$n = $r['idcustomer'];
	//$query1 = mysql_query("SELECT idcustomer,citizenidcompanyid FROM customerinfo WHERE idcustomer='$n' AND citizenidcompanyid = '$ctz' ");
	//$t = mysql_fetch_array($query1);
	$op = $_SESSION['username'];
	$query2 = mysql_query("SELECT  idoperator, opname FROM operatorinfo WHERE  opusername='$op'");
	$bh = mysql_fetch_array($query2);
	$bywho = $bh['idoperator'];
	//echo $t['idcustomer'].$t['citizenidcompanyid'];
	$numrows = mysql_num_rows($query);
	if($numrows == 1){

		
		$newbalance = $r['balance'] + $amount ;
		//echo $newbalance;
		$sql = "UPDATE accountinfo SET balance='$newbalance' WHERE idcustomer='$n'";
		$query3 = mysql_query("SELECT  * FROM accountinfo WHERE  idaccounwitpf='$account'");
		$dpn = mysql_fetch_array($query3);
		$idacc = $dpn['idcustomer'];
		$query4 = mysql_query("SELECT  * FROM customerinfo WHERE  idcustomer='$idacc'");
		$dpn1 = mysql_fetch_array($query4);
		$namedp = $dpn1['name'];
		$surnamedp = $dpn1['surname'];
		$retval = mysql_query( $sql, $connect );
		$deposittor = $name."-".$surname."-".$tel;
		if (! $retval ) 
		{
            die('Could not enter data to accountinfo: ' . mysql_error());
        }
    	$sql = "INSERT INTO operationlog (bytype,bywho,operationtype,amount,destinationaccount,sourceaccount,crbalance) VALUES ('OP','".$bywho."','DP','".$amount."','".$account."','".$deposittor."','".$newbalance."')";
		$retval = mysql_query( $sql, $connect );

		if(! $retval ) 
		{
            die('Could not enter data: ' . mysql_error());
        }
        else		
    		echo "<h4>"."DEPOSIT successfully total amount : ".$amount." to account ".$account." ".$namedp ."  ".$surnamedp." <a href='Operator-Deposit.php'> click </a> to return"."</h4>" ;
    	//echo $_SESSION['username'];

    	 	

	}
	else
		echo "that account doesn't exist.";
		
	
}
else
	die ("plaese enter all information.");

?>
