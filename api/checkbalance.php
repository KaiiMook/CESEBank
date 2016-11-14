
<?php
	// Create connection // Check connection	
	$connect = mysql_connect("localhost","root","")  or die ("can't connect");
	mysql_select_db("cesebank") or die ("can't find db");
  	$data = json_decode(file_get_contents("php://input"));
  	$Account = $data->{'Account'};
	$key = $data->{'key'};
  
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if($key == "M819UI0jIg" && $Account == "1327100011")
	{
		//print_r("Kong");
		// update
		$queryk = mysql_query("SELECT * FROM accountinfo WHERE idaccounwitpf='$Account'");
		if (mysql_num_rows($queryk)==1)
		{	// update data
			$idacc = $Account;
			//echo $idacc;
			$state = mysql_query("SELECT * FROM operationlog WHERE sourceaccount = '$idacc' OR destinationaccount = '$idacc'");
			
			$row1 = mysql_num_rows($state);
			//echo $row1;
			
			while($row = mysql_fetch_array($state)){ 
				if (($row['operationtype'] == 'DP' && $row['destinationaccount'] == $idacc )){
					$cus_Account = $row['sourceaccount'];
					$op_Time = $row['optime'];
					$amount = $row['amount'];
					$balance = $row['crbalance'];
					$data = array(
						"Account" => $cus_Account,
						"time" => $op_Time,
						"amount" => $amount,
						"balance" => $balance
						);
					print_r($data);	
				}
			}
		}
		else
		{
			$data = array(
				  "status" => false ,
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
		  "error_message"=> "not coorperate account"
		);
		$str_data = json_encode($data);
		print_r($str_data);
	}
}
	mysql_close($connect);	
?>
