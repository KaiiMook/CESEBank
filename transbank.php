<?php
session_start();
$bankk = $_POST['bank'];
$accountt = $_POST['name'];
$amountt = $_POST['name1'];
$connect = mysql_connect("localhost","root","")  or die ("can't connect");
mysql_select_db("cesebank") or die ("can't find db");
function sendPostData($url, $post){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $result = curl_exec($ch);
  curl_close($ch);  // Seems like good practice
  return $result;
}
if($bankk&&$accountt&&$amountt)
{
	if($bankk == "1"){
		
		//destination
		$query = mysql_query("SELECT idcustomer,balance FROM accountinfo WHERE idaccounwitpf='$accountt' ");
		$r = mysql_fetch_array($query);
		$n = $r['idcustomer'];
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

    		$print =  "<h4> 
    				---- Successfully transfer ---- 
    				</h4>
    				<br/><br/>
    			 	<div class='col-xs-6' style='text-align:right;'>
    			 	<h4>
    			 	Transfer from account : 
    			 	<br/><br/>Transfer to account : 
    			 	<br/><br/>Name : 
    			 	<br/><br/> Amount : 
    			 	<br/><br/> Total money remain : 
    			 	</h4>
    			 	</div>
    			 	<div class='col-xs-6' style='text-align:left;'>
    			 	<h4>"
    			 	.$byacc.
    			 	"<br/><br/>"
    			 	.$accountt.
    			 	"<br/><br/>"
    			 	.$namedp."  ".$surnamedp.
    			 	"<br/><br/>"
    			 	.$amountt .
    			 	"<br/><br/>"
    			 	.$newbalances.
    			 	"<br/><br/> 
    			 	<a style='color:black;' href='Transfer.php'> 
    			 		click to return
    			 	</a></h4>
    			 	</div> ";
		$sql = "INSERT INTO operationlog (bytype,bywho,operationtype,amount,destinationaccount,sourceaccount,crbalance) VALUES ('CM','".$bywho."','TF','".$amountt."','".$accountt."','".$deposittor."','".$newbalances."')";	
				$retval = mysql_query( $sql, $connect );
				if(! $retval ) 
				{
		            die('Could not enter data: ' . mysql_error());
		        }
		        
			}
		}
		elseif ($bankk=="2") {
		//source
		$op = $_SESSION['username'];
		$query2 = mysql_query("SELECT idcustomer FROM customerinfo WHERE  username='$op'");
		$q2 = mysql_fetch_array($query2);
		$qq2 = $q2['idcustomer'];
		$query3 = mysql_query("SELECT * FROM accountinfo WHERE idcustomer='$qq2'");
		$bh = mysql_fetch_array($query3);
		$bywho = $bh['idcustomer'];
		$byacc = $bh['idaccounwitpf'];
		$deposittor = $bh['idaccounwitpf'];
		$data = array(
		  "from_Account"=> $byacc,
		  "to_Account"=> $accountt,
		  "Amount"=> (float)$amountt,
		  //"key"=> "test if not kong&non bank"
		  "key" => "kaiimook1111"
		);
		$url_send ="http://bank.route.in.th:9999/api/transfer";
		// $str_data = http_build_query($data);
		$str_data = $data;
		$result = sendPostData($url_send, $str_data);
	  	$result = json_decode($result);
	  	$success = $result->{'success'};
		$error_message = $result->{'error_message'};

		if($success == true ){
			$newbalances = $bh['balance'] - $amountt; 
			$sql = "UPDATE accountinfo SET balance='$newbalances' WHERE idcustomer='$bywho'";
			$retval = mysql_query( $sql, $connect );
		if (! $retval ) 
		{
            die('Could not enter data to accountinfo: ' . mysql_error());
        }
        		
    	else

    		$print =  "<h4> 
    				---- Successfully transfer ---- 
    				</h4>
    				<br/><br/>
    			 	<div class='col-xs-6' style='text-align:right;'>
    			 	<h4>
    			 	Transfer from account : 
    			 	<br/><br/>Transfer to account : 
    			 	<br/><br/>Name : 
    			 	<br/><br/> Amount : 
    			 	<br/><br/> Total money remain : 
    			 	</h4>
    			 	</div>
    			 	<div class='col-xs-6' style='text-align:left;'>
    			 	<h4>"
    			 	.$byacc.
    			 	"<br/><br/>"
    			 	.$accountt.
    			 	"<br/><br/>
    			 	Other Bank
    			 	<br/><br/>"
    			 	.$amountt .
    			 	"<br/><br/>"
    			 	.$newbalances.
    			 	"<br/><br/> 
    			 	<a style='color:black;' href='Transfer.php'> 
    			 		click to return
    			 	</a></h4>
    			 	</div> ";
			$sql = "INSERT INTO operationlog (bytype,bywho,operationtype,amount,destinationaccount,sourceaccount,crbalance) VALUES ('CM','".$bywho."','TF','".$amountt."','".$accountt."','".$deposittor."','".$newbalances."'),('CM','".$bywho."','DP','".$amountt."','".$accountt."','".$deposittor."','".$newbalance."')";	
				$retval = mysql_query( $sql, $connect );
				if(! $retval ) 
				{
		            die('Could not enter data: ' . mysql_error());
		        }
		        
			}
			else
			{
				print_r($error_message);	
			}
		}
		elseif ($bankk=="3") {
		
		//source
		$op = $_SESSION['username'];
		$query2 = mysql_query("SELECT idcustomer FROM customerinfo WHERE  username='$op'");
		$q2 = mysql_fetch_array($query2);
		$qq2 = $q2['idcustomer'];
		$query3 = mysql_query("SELECT * FROM accountinfo WHERE idcustomer='$qq2'");
		$bh = mysql_fetch_array($query3);
		$bywho = $bh['idcustomer'];
		$byacc = $bh['idaccounwitpf'];
		$deposittor = $bh['idaccounwitpf'];
		$data = array(
		  "from_Account"=> $byacc,
		  "to_Account"=> $accountt,
		  "Amount"=> (float)$amountt,
		  //"key"=> "test if not kong&non bank"
		  "key" => "746H32ABMN"
		);

		$url_send ="http://glacial-gorge-51031.herokuapp.com/api/transfer";
		// $str_data = http_build_query($data);
		$str_data = json_encode($data);
		$result = sendPostData($url_send, $str_data);
	  	$result = json_decode($result);
	  	$success = $result->{'status'};
		$error_message = $result->{'error_message'};

		if($success == true ){
			$newbalances = $bh['balance'] - $amountt; 
			$sql = "UPDATE accountinfo SET balance='$newbalances' WHERE idcustomer='$bywho'";
			$retval = mysql_query( $sql, $connect );
		if (! $retval ) 
		{
            die('Could not enter data to accountinfo: ' . mysql_error());
        }
        		
    	else

    		$print =  "<h4> 
    				---- Successfully transfer ---- 
    				</h4>
    				<br/><br/>
    			 	<div class='col-xs-6' style='text-align:right;'>
    			 	<h4>
    			 	Transfer from account : 
    			 	<br/><br/>Transfer to account : 
    			 	<br/><br/>Name : 
    			 	<br/><br/> Amount : 
    			 	<br/><br/> Total money remain : 
    			 	</h4>
    			 	</div>
    			 	<div class='col-xs-6' style='text-align:left;'>
    			 	<h4>"
    			 	.$byacc.
    			 	"<br/><br/>"
    			 	.$accountt.
    			 	"<br/><br/>
    			 	Other Bank
    			 	<br/><br/>"
    			 	.$amountt .
    			 	"<br/><br/>"
    			 	.$newbalances.
    			 	"<br/><br/> 
    			 	<a style='color:black;' href='Transfer.php'> 
    			 		click to return
    			 	</a></h4>
    			 	</div> ";
			$sql = "INSERT INTO operationlog (bytype,bywho,operationtype,amount,destinationaccount,sourceaccount,crbalance) VALUES ('CM','".$bywho."','TF','".$amountt."','".$accountt."','".$deposittor."','".$newbalances."')";	
				$retval = mysql_query( $sql, $connect );
				if(! $retval ) 
				{
		            die('Could not enter data: ' . mysql_error());
		        }
		        
			}
			else
			{
				print_r($error_message);	
			}
		}
	}
		else
			die ("please enter all information.");

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
	 		<br/>
	 			<h2>Transcript</h2>
	 		</div>
	 		<div class="row">
	 		<div class="col-xs-5 text-center col-xs-offset-2">
	 		<?php
	 		echo $print;
	 		?>
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
			mysql_close($connect);
?>