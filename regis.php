<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$address = $_POST['address'];
$tel = $_POST['tel'];
$customertype = $_POST['optionsRadios'];
$ctzcpnid = $_POST['citi'];
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
 				<!-- Login -->
 				<?php 
					if($username&&$password&&$name&&$address&&$tel&&$customertype&&$ctzcpnid)
					{
						$connect = mysql_connect("localhost","root","")  or die ("can't connect");
						mysql_select_db("cesebank") or die ("can't find db");

						$query = mysql_query("SELECT * FROM customerinfo WHERE username='$username'");
						$query1 = mysql_query("SELECT * FROM customerinfo WHERE name='$name'");
						$query2 = mysql_query("SELECT * FROM customerinfo WHERE surname='$surname'");

						$numrows = mysql_num_rows($query);
						$numrows1 = mysql_num_rows($query1);
						$numrows2 = mysql_num_rows($query2);

						if($numrows1 == 0 && $numrows2 == 0)
						{
							if($numrows != 0)
							{
								echo "<h2> this username has already taken </h2>";

							}
							else
							{
								$sql = "INSERT INTO customerinfo (username,password,name,surname,address,tel,customertype,citizenidcompanyid) VALUES ('".$username."','".$password."','".$name."','".$surname."','".$address."','".$tel."','".$customertype."','".$ctzcpnid."')";
								$retval = mysql_query( $sql, $connect );

								if(! $retval ) 
								{
						           die('Could not enter data: ' . mysql_error());
						        }

						        $id = mysql_insert_id();
						        $padded = str_pad((string)$id, '5', "0", STR_PAD_LEFT);
						        if($customertype == "C"){
						        	$idpf = '13271'.$padded;
						        }
						        else
						        {
						        	$idpf = '13270'.$padded;
						        }
						        $sql = "INSERT INTO accountinfo (idcustomer,idaccounwitpf) VALUES ('".$id."','".$idpf."')";

								$retval = mysql_query( $sql, $connect );

								if(! $retval ) 
								{
						           die('Could not enter data to accountinfo: ' . mysql_error());
						        }
                                $op = $_SESSION['username'];
                                $queryop = mysql_query("SELECT * FROM operatorinfo WHERE  opusername='$op'");
                                $bh = mysql_fetch_array($queryop);
                                $bywho = $bh['idoperator'];
                                $sql = "INSERT INTO operationlog (bytype,bywho,operationtype,amount,destinationaccount,crbalance) VALUES ('OP','".$bywho."','CA','0','".$idpf."','0')";
                                $retval = mysql_query( $sql, $connect );

                                if(! $retval ) 
                                {
                                   die('Could not enter data to accountinfo: ' . mysql_error());
                                }
						        //echo "Entered data successfully <a href='Operator-Create.php'> click </a> to return";
							}
						}
						else
							die("that user already have an account.");							
					}
					else
							die (" plaese enter all information.");
 				?>
 				<div class="col-xs-8 op-login-blog">
 					<div class="row" style="margin: 1vw 0 2vw 3vw;">
 						<h2>Confirm account</h2>
 					</div>
 					<div class="row">
                        <div class="col-xs-3 col-xs-offset-1">
                            <h4>CUSTOMER TYPE</h4>
                        </div>
                        <div class="col-xs-4">
                           <?php 
                           		if($customertype == 'C')
                           			echo "<h4> Company Account </h4>";
                           		else
                           			echo "<h4> Normal Account </h4>";

                             ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-1">
                            <h4>ACCOUNT NUMBER</h4>
                        </div>
                        <div class="col-xs-4">
                           <?php echo "<h4>".$idpf."</h4>"  ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5" style="text-align: right;">
                            <h4>CITIZEN ID./ COMPANY ID.</h4>
                        </div>
                        <div class="col-xs-4" name="citi">
                            <?php echo "<h4>".$ctzcpnid."</h4>"  ?>
                        </div>
                    </div> 
 					<div class="row">
 						<div class="col-xs-2  col-xs-offset-1" style="text-align: right;">
 							<h4>NAME</h4>
 						</div>
 						<div class="col-xs-3" name="name">
 							<?php echo "<h4>".$name."</h4>"  ?>
 						</div>
 						<div class="col-xs-2" style="text-align: right;">
 							<h4>SURNAME</h4>
 						</div>
 						<div class="col-xs-4" name="surname">
 							<?php echo "<h4>".$surname."</h4>"  ?>
 						</div>
 					</div>					
 					<div class="row">
 						<div class="col-xs-2  col-xs-offset-1" style="text-align: right;">
 							<h4>ADDRESS</h4>
 						</div>
 						<div class="col-xs-3" name="addr">
 							<?php echo "<h4>".$address."</h4>"  ?>
 						</div>
 						<div class="col-xs-2" style="text-align: right;">
 							<h4>TEL</h4>
 						</div>
 						<div class="col-xs-4" name="tel">
 							<?php echo "<h4>".$tel."</h4>"  ?>
 						</div>
					</div>
                    <div class="row">
                        <div class="col-xs-offset-1 col-xs-10">
                        <hr style="border-color: gray;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-xs-offset-2">
                            <h4>Username</h4>
                        </div>
                        <div class="col-xs-6" name="username">
                            <?php echo "<h4>".$username."</h4>"  ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-xs-offset-2">
                            <h4>Password</h4>
                        </div>
                        <div class="col-xs-6" type="password" name="password">
                            <?php echo "<h4>".$password."</h4>"  ?>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-xs-1 col-xs-offset-3">
                        <h4>
                        <a class="submit-button" href="Operator-Create.php">Return</a>
                        
                        </h4>
                        </div>
                    </div>
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
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
<?php mysql_close($connect); ?>