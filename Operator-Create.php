<?php
session_start();
if(!isset($_SESSION['username'])){
   header("Location:Operator-Login.html");
}
?>



<!DOCTYPE html>
<html>
<form action='regis.php' method='POST'>
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
 				<div class="col-xs-8 op-login-blog">
 					<div class="row" style="margin: 1vw 0 2vw 3vw;">
 						<h2>Create account</h2>
 					</div>
 					<div class="row">
                    <div class="col-xs-3 col-xs-offset-1">
                        <h4>CUSTOMER TYPE</h4>
                    </div>
                    <div class="col-xs-4">
                      <label>
                        <h4><input type="radio" name="optionsRadios" id="optionsRadios1" value="N" checked>
                        Normal Account</h4>
                      </label></div>
                      <div class="col-xs-4">
                      <label>
                        <h4><input type="radio" name="optionsRadios" id="optionsRadios1" value="C" checked>
                        Company Account</h4>
                      </label></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5" style="text-align: right;">
                            <h4>CITIZEN ID./ COMPANY ID.</h4>
                        </div>
                        <div>
                            <h4><input class="col-xs-4" type="text" name="citi">
                            </h4>
                        </div>
                    </div> 
 					<div class="row">
 						<div class="col-xs-2" style="text-align: right;">
 							<h4>NAME</h4>
 						</div>
 						<div class="col-xs-4">
 							<h4><input type="text" name="name">
 							</h4>
 						</div>
 						<div class="col-xs-2" style="text-align: right;">
 							<h4>SURNAME</h4>
 						</div>
 						<div class="col-xs-4">
 							<h4><input type="text" name="surname">
 							</h4>
 						</div>
 					</div>					
 					<div class="row">
 						<div class="col-xs-2" style="text-align: right;">
 							<h4>ADDRESS</h4>
 						</div>
 						<div class="col-xs-4">
 							<h4><input type="text" name="address">
 							</h4>
 						</div>
 						<div class="col-xs-2" style="text-align: right;">
 							<h4>TEL</h4>
 						</div>
 						<div class="col-xs-4">
 							<h4><input type="text" name="tel">
 							</h4>
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
                        <div class="col-xs-6">
                            <h4><input type="text" name="username">
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-xs-offset-2">
                            <h4>Password</h4>
                        </div>
                        <div class="col-xs-6">
                            <h4><input type="password" name="password">
                            </h4>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-xs-1 col-xs-offset-3">
                        <h4>
                        <button class="submit-button" type="submit">SUBMIT</button>
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
</form>
</html>