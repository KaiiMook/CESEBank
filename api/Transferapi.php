
<?php
	
	// Create connection // Check connection	
	$connect = mysql_connect("localhost","root","")  or die ("can't connect");
	mysql_select_db("cesebank") or die ("can't find db");
  	$data = json_decode(file_get_contents("php://input"));
  	$from_Account = $data->{'from_Account'};
	$to_Account = $data->{'to_Account'};
	$Amount = $data->{'Amount'};
	$key = $data->{'key'};
  
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if($key == "4R02vZ4c69")
	{
		//print_r("Kong");
		// update
		$queryk = mysql_query("SELECT * FROM accountinfo WHERE idaccounwitpf='$to_Account'");
		if (mysql_num_rows($queryk)==1)
		{	// update data
			$findblk = mysql_fetch_array($queryk);
			$balancek = $findblk['balance'];
			$newbalancek = $balancek + $Amount;
			$sqlk = "UPDATE accountinfo SET balance='$newbalancek' WHERE idaccounwitpf='$to_Account'";
			$retval = mysql_query( $sqlk, $connect );
			if (! $retval ) 
			{
				$data = array(
				  "success" => false ,
				  "error_message"=> "Could not enter data to account"
				);
				$str_data = json_encode($data);
				print_r($str_data);
            	die('Could not enter data to accountinfo: ' . mysql_error());
        	}
        	else
        	{	//add log
        		$sacc = $from_Account;
        		$sqlk = "INSERT INTO operationlog (bytype,bywho,operationtype,amount,destinationaccount,sourceaccount,crbalance) VALUES ('OB',' ','TF','".$Amount."','".$to_Account."','".$sacc."','".$newbalancek."')";
        	}
        	$retval = mysql_query( $sqlk, $connect );
			if (! $retval ) 
			{
				$data = array(
				  "success" => false ,
				  "error_message"=> "Could not enter data to account"
				);
				$str_data = json_encode($data);
				print_r($str_data);
            	die('Could not enter data to accountinfo: ' . mysql_error());
        	}
        	else
        	{
				$data = array(
				  "success" => true ,
				  "error_message"=> "Don't care"
				);
				$str_data = json_encode($data);
				print_r($str_data);
			}
		}
		else
		{
			$data = array(
				  "success" => false ,
				  "error_message"=> "no have account number"
				);
				$str_data = json_encode($data);
				print_r($str_data);
		}
	}
	else if($key == "01iTqwqgh7")
	{
		$queryn = mysql_query("SELECT * FROM accountinfo WHERE idaccounwitpf='$to_Account'");
		if (mysql_num_rows($queryn)==1)
		{	// update data
			$findbln = mysql_fetch_array($queryn);
			$balancen = $findbln['balance'];
			$newbalancen = $balancen + $Amount;
			$sqln = "UPDATE accountinfo SET balance='$newbalancen' WHERE idaccounwitpf='$to_Account'";
			$retval = mysql_query( $sqln, $connect );
			if (! $retval ) 
			{
            	die('Could not enter data to accountinfo: ' . mysql_error());
        	}
        	else
        	{	//add log
        		$saccn = $from_Account;
        		$sqln = "INSERT INTO operationlog (bytype,bywho,operationtype,amount,destinationaccount,sourceaccount,crbalance) VALUES ('OB',' ','TF','".$Amount."','".$to_Account."','".$saccn."','".$newbalancen."')";
        	}
        	$retval = mysql_query( $sqln, $connect );
			if (! $retval ) 
			{
            	die('Could not enter data to accountinfo: ' . mysql_error());
        	}
        	else
        	{
				$data = array(
				  "success" => true ,
				  "error_message"=> "don't care"
				);
				$str_data = json_encode($data);
				print_r($str_data);
        		
			}		
		}
		else
		{
			$data = array(
			  "success" => false ,
			  "error_message"=> "no have account number"
			);
			$str_data = json_encode($data);
			print_r($str_data);
		}
	}
	else
	{
		$data = array(
		  "success" => false ,
		  "error_message"=> "not coorperate bank"
		);
		$str_data = json_encode($data);
		print_r($str_data);
	}
}
	mysql_close($connect);	
?>
