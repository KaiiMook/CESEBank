<?php
session_start();

$bank = $_POST['bank'];
$account = $_POST['account'];
//$amount = $_POST['amount'];
echo $bank;
echo $account;

/*
if($bank&&$account&&$amount)
{
	$connect = mysql_connect("localhost","root","")  or die ("can't connect");
	mysql_select_db("cesebank") or die ("can't find db");
	//destination
	$query = mysql_query("SELECT idcustomer,balance FROM accountinfo WHERE idaccounwitpf='$account' ");
	$r = mysql_fetch_array($query);
	$n = $r['idcustomer'];
	//$query1 = mysql_query("SELECT idcustomer,citizenidcompanyid FROM customerinfo WHERE idcustomer='$n' AND citizenidcompanyid = '$ctz' ");
	//$t = mysql_fetch_array($query1);
	//source
	$op = $_SESSION['username'];
	$query2 = mysql_query("SELECT idcustomer FROM customerinfo WHERE  username='$op'");
	$q2 = mysql_fetch_array($query2);
	$qq2 = $q2['idcustomer'];
	$query3 = mysql_query("SELECT idaccounwitpf,balance,idcustomer FROM accountinfo WHERE idcustomer='$qq2'");
	$bh = mysql_fetch_array($query3);
	$bywho = $bh['idcustomer'];
	//echo $t['idcustomer'].$t['citizenidcompanyid'];
	$numrows = mysql_num_rows($query);
	if($numrows == 1 && $bank == '1' ){

		
		$newbalance = $r['balance'] + $amount ;
		$newbalances = $bh['balance'] - $amount; 
		//echo $newbalance;
		$sql = "UPDATE accountinfo SET balance='$newbalance' WHERE idcustomer='$n'";
		$retval = mysql_query( $sql, $connect );
		$deposittor = $bh['idaccounwitpf'];
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
    	echo "transfer successfully total money remain : ".$newbalances." <a href='Transfer.php'> click </a> to return" ;
    	//echo $_SESSION['username'];
    	$sql = "INSERT INTO operationlog (bytype,bywho,operationtype,amount,destinationaccount,sourceaccount) VALUES ('CM','".$bywho."','TF','".$amount."','".$account."','".$deposittor."')";
		$retval = mysql_query( $sql, $connect );

		if(! $retval ) 
		{
            die('Could not enter data: ' . mysql_error());
        }
    	 	

	}
	else
		echo "that account doesn't exist.";
		
	
}
else
	die ("plaese enter all information.");
*/
?>
