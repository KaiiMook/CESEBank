
<div class="row fi-blog1">
	<h2>WELCOME <span class="font-red">
	<?php
	session_start();
	$connect = mysql_connect("localhost","root","")  or die ("can't connect");
	mysql_select_db("cesebank") or die ("can't find db");
	$usdisplay = $_SESSION['username'];
	$queryusdisplay = mysql_query("SELECT * FROM customerinfo WHERE  username='$usdisplay'");
	$display = mysql_fetch_array($queryusdisplay);
	$dpname = $display['name'];
	$dpsurname = $display['surname'];
	$id4ac = $display['idcustomer'];
	echo $dpname."  ".$dpsurname;
	?>

	</span></h2>
	<h4>(You has logged in at last when </h4> <h4> <?php date_default_timezone_set('Asia/Bangkok'); $date = date('m/d/Y h:i:s a', time()); echo $date; ?> </h4>
	<hr/>
	<h4>Account CESE-no. digital account is <?php $queryaccount = mysql_query("SELECT * FROM accountinfo WHERE  idcustomer='$id4ac'"); $dp = mysql_fetch_array($queryaccount);
	$acc = $dp['idaccounwitpf']; echo $acc; ?></h4>
</div>