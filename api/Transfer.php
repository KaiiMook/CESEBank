
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "cesebank";
	// Create connection
	$conn = new mysql($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

  	$data = json_decode(file_get_contents("php://input"));
  	$from_Account = $data->{'from_Account'};
	$to_Account = $data->{'to_Account'};
	$Amount = $data->{'Amount'};
	$from_Bank = $data->{'from_Bank'};
	$key = $data->{'key'};
  
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if($key == "4R02vZ4c69"){
		print_r("Kong");
		$query = "INSERT INTO data SET mydata='$from_Account,$to_Account,$Amount,$from_Bank,$key'";
		$db = new Mysql("localhost","root","","postdata");
		$db ->query($query);
		print_r($Amount);
		$check = mysql_query("SELECT *  FROM accountinfo WHERE idaccounwitpf='1327100002'");
		if (mysql_num_rows($check)==1){
			$get = mysql_fetch_assoc($check);
			$balance = $get['balance']+$Amount;	
			$sql = "UPDATE accountinfo SET balance=$balance WHERE idaccounwitpf='1327100002'";
			if ($conn->query($sql) === TRUE) {
		    		echo "Record updated successfully";
			} 
			else {
		    		echo "Error updating record: " . $conn->error;
			}
		print_r($balance);
		}

	}
	else if($key == "01iTqwqgh7"){
		print_r("Non");
		$query = "INSERT INTO data SET mydata='$from_Account,$to_Account,$Amount,$from_Bank,$key'";
		$db = new Mysql("localhost","root","","postdata");
		$db -> query($query);
	}
}
	$conn->close();
	
?>
<!-- <?php
  	$data = json_decode(file_get_contents("php://input"));
	// $connect = mysql_connect("localhost","root","","postdata");
	// $check = mysql_query("SELECT *  FROM data WHERE id=13");
	// if (mysql_num_rows($check)===1){
	// 	$get = mysql_fetch_assoc($check);
	// 	$mydata = $get['mydata'];
	// }
	$from_Account = $data->{'from_Account'};
	$to_Account = $data->{'to_Account'};
	$Amount = $data->{'Amount'};
	$from_Bank = $data->{'from_Bank'};
	$key = $data->{'key'};
	$query = "INSERT INTO data SET mydata='$from_Account,$to_Account,$Amount,$from_Bank,$key'";
	$db = new Mysqli("localhost","root","","postdata");
	$db -> query($query);

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "postdata";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "UPDATE data SET mydata=$from_Account WHERE id=2";

	if ($conn->query($sql) === TRUE) {
	    echo "Record updated successfully";
	} else {
	    echo "Error updating record: " . $conn->error;
	}

	$conn->close();
	
?> -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>
