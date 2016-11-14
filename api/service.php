<?php
	
	// Create connection // Check connection	
	$connect = mysql_connect("localhost","root","")  or die ("can't connect");
	mysql_select_db("cesebank") or die ("can't find db");	
  	$data = json_decode(file_get_contents("php://input"));
  	$shop_Account = $data->{'shop_Account'};
	$cus_Account = $data->{'cus_Account'};
	$Amount = $data->{'Amount'};
	$otp = $data->{'otp'};

  
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	//print_r("Kong");
	// update
	$queryc = mysql_query("SELECT * FROM accountinfo WHERE idaccounwitpf='$cus_Account'");
	$querys = mysql_query("SELECT * FROM accountinfo WHERE idaccounwitpf='$shop_Account'");
	if (mysql_num_rows($queryc)==1)
	{	
		if (mysql_num_rows($querys)==1)
		{
			$findblc = mysql_fetch_array($queryc);
			$findbls = mysql_fetch_array($querys);
			if($otp == $findblc['otp'])
			{
				$balancec = $findblc['balance'];
				if($balancec > $Amount){
					$balances = $findbls['balance'];
					$newbalancec = $balancec - $Amount;
					$newbalances = $balances + $Amount;
			   		$newotp = rand(111111,999999);
					$sqlc = "UPDATE accountinfo SET balance='$newbalancec', otp = '$newotp' WHERE idaccounwitpf='$cus_Account'";
					$retval = mysql_query( $sqlc, $connect );
					if (! $retval ) 
					{
						$data = array(
						  "success"=> false,
						  "error_message"=> "Could not enter data to account"
						);
						$str_data = json_encode($data);
						print_r($str_data);
			    	}
					$sqls = "UPDATE accountinfo SET balance='$newbalances' WHERE idaccounwitpf='$shop_Account'";
					$retval = mysql_query( $sqls, $connect );
					if (! $retval ) 
					{

						$data = array(
						  "success"=> false,
						  "error_message"=> "Could not enter data to account"
						);
						$str_data = json_encode($data);
						print_r($str_data);
			    	}
			    	else
			    	{	//add log
			    		$sql = "INSERT INTO operationlog (bytype,bywho,operationtype,amount,destinationaccount,sourceaccount,crbalance) VALUES ('SP','','TF','".$Amount."','".$shop_Account."','".$cus_Account."','".$newbalancec."'),('SP','','DP','".$Amount."','".$shop_Account."','".$cus_Account."','".$newbalances."')";	
			    	}
			    	$retval = mysql_query( $sql, $connect );
					if (! $retval ) 
					{
						$data = array(
						  "success"=> false,
						  "error_message"=> "Could not enter data to account"
						);
						$str_data = json_encode($data);
						print_r($str_data);
			    	}
			    	else
			    	{
						$data = array(
						  "success"=> true,
						  "error_message"=> "Could not enter data to account"
						);
						$str_data = json_encode($data);
						print_r($str_data);
			    	}
			    }
			    else
			    {
					$data = array(
					  "success"=> false,
					  "error_message"=> "customer money is not enough"
					);
					$str_data = json_encode($data);
					print_r($str_data);
			    }

		    }
		    else
		    {
				$data = array(
				  "success"=> false,
				  "error_message"=> "Wrong otp"
				);
				$str_data = json_encode($data);
				print_r($str_data);
		    }
		}
		else
		{
				$data = array(
				  "success"=> false,
				  "error_message"=> "no have this shop account"
				);
				$str_data = json_encode($data);
				print_r($str_data);
		}
	}
	else
	{
				$data = array(
				  "success"=> false,
				  "error_message"=> "no have this customer account"
				);
				$str_data = json_encode($data);
				print_r($str_data);
	}
}
mysql_close($connect);	
?>
