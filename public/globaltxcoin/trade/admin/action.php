
<?php 
require_once('Connections/db.php');

if(isset($_GET['del'])){
	
	$del = $_GET['del'];
	
$sql = mysql_query("SELECT * FROM users WHERE accno='$del' ") or die(mysql_error());	

$data = mysql_fetch_array($sql);

$accno = $data['accno'];

$sql_del = mysql_query("DELETE FROM users WHERE accno='$accno'") or die(mysql_query());


 header("Location: dashboard.php");


	}


if(isset($_GET['blo'])){
	
	$blo = $_GET['blo'];
	
$sql = mysql_query("SELECT * FROM users WHERE accno='$blo' ") or die(mysql_error());	

$data = mysql_fetch_array($sql);

$accno = $data['accno'];

$thisBlock = "unverified";
$thisStat = "Dormant";

$stat = "<font color=#FF0000>Dormant</font>";

$sql_del = mysql_query("UPDATE users SET level='$thisBlock',blockinfo='$stat',blockstat='$thisStat' WHERE accno='$accno'") or die(mysql_query());


 header("Location: dashboard.php");


	}
	
	
	if(isset($_GET['un'])){
	
	$blo = $_GET['un'];
	
$sql = mysql_query("SELECT * FROM users WHERE accno='$blo' ") or die(mysql_error());	

$data = mysql_fetch_array($sql);

$accno = $data['accno'];

$thisBlock = "verified";

$stat = "";
$thisStat = "";

$sql_del = mysql_query("UPDATE users SET level='$thisBlock',blockinfo='$stat',blockstat='$thisStat' WHERE accno='$accno'") or die(mysql_query());


header("Location: dashboard.php");


	}
	
	
	if(isset($_GET['wp'])){
	
	$ac = $_GET['wp'];
	
$sql = mysql_query("SELECT * FROM withdrawal WHERE orderid='$ac' ") or die(mysql_error());	

$data = mysql_fetch_array($sql);

$accno = $data['accno'];

$em = $data['email'];
$amt = $data['amount'];

$thisBlock = "verified";

$pstat = "Paid";
$thisAct = "";

$sql_wid = mysql_query("UPDATE users SET bal=bal-'$amt' WHERE email='$em'") or die(mysql_query());

$sql_pwid = mysql_query("UPDATE withdrawal SET status='$pstat',action='$thisAct' WHERE orderid='$ac'") or die(mysql_query());

header("Location: dashboard.php");


	}
	
	
	if(isset($_GET['wd'])){
	
	$ad = $_GET['wd'];
	
$sql = mysql_query("SELECT * FROM withdrawal WHERE orderid='$ad' ") or die(mysql_error());	

$data = mysql_fetch_array($sql);

$oid = $data['orderid'];


$sql_pdel = mysql_query("DELETE FROM withdrawal WHERE orderid='$ad'") or die(mysql_query());

header("Location: dashboard.php");


	}

?>