
<?php 
require_once('Connections/db.php');

if(isset($_GET['id'])){
	
	$id = $_GET['id'];
	
$sql = mysql_query("SELECT * FROM verification WHERE fileno='$id' ") or die(mysql_error());	

$data = mysql_fetch_array($sql);

$email = $data['email'];

$fname = $data['firstname'];

$stat = "Approved";

$action = "";


$upd = mysql_query("UPDATE verification SET status='$stat',action='$action' WHERE fileno='$id' ");

if($upd){
	

	
	$sql_apr = mysql_query("SELECT * FROM users WHERE email='$email'") or die(mysql_error());
	
	$mdata = mysql_fetch_array($sql_apr);
	
	$level = "verified";
	
	$upd_member = mysql_query("UPDATE users SET level='$level' WHERE email='$email' ");
	
	
	// send Email admin
			
			
$to = "$email";

$subject = "EpicStock Account Approved";

$message = "
<html>
<head>
<title>Account Approval Notification</title>
</head>
<body>
<p><h3>Congratulations! $fname,</h3> </p>

Your account has been approved. <br>

And ready to start for trade.<p>



<a href='https://epicstock.bid/en/'> <button>Click here to get started</button></a> <p>


Regards, <p>

FXE Markets

</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: EpicStock<no-reply@epicstock.bid>' . "\r\n";


mail($to,$subject,$message,$headers);
	
	}

?>

<script type="text/javascript">
window.location = "account_verify.php";
</script>
<?php
	
	}


?>