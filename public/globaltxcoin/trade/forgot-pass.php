<?php require_once('Connections/db.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area login-bg">
        <div class="container">
        
        
            <div class="login-box ptb--100">
           
   
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="login-form-head">
                    <p align="center"><img src="image/logo-epins.png"> </p>
                        <h4>Password Recovery</h4>
                        <p>Enter your email address or phone number and we will send you instructions on how to recover your password.</p>
                       
                    </div>
                    <div class="login-form-body">
                    
                    <p align="center">       <?php 
		  

if(isset($_POST['submit'])){
		
$email = $_POST['email'];




$check = "SELECT * FROM users WHERE email ='$email' OR phone ='$email' ";

    $result=mysql_query($check);
    $num = mysql_fetch_array($result);
    
    $user = $num['firstname'];
    $pas = $num['pass'];
    $sendto = $num['email'];
    $phone = $num['phone'];
    
 $img = " ";

    
    
    $search = array("$sendto", "$phone");
    
    if(in_array("$email",$search)){
      
   
echo '<div class="alert alert-success">Your password has been sent to your registered email address. Please check your inbox/spam. </div>';


$from = "FxeMarkets<no-reply@fxemarkets.bid>"; //the email address from which this is sent
$to = "$sendto"; //the email address you're sending the message to
$subject = "Your Password is here"; //the subject of the message

// To send HTML mail, the Content-type header must be set
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "X-Priority: 1\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
$body = "<html><body>

<a href='http://fxemarkets.bid'><img src=$img></a><br>

<h3 style='color:#f40;'>Hello $user</h3>

Your requested for password reset on your FxeMarkets Account.<br>

Your Password is: $pas<p>

If your didn't make this request, <br>

kindly contact support@fxemarkets.bid or <br>


Support Team<br>

<b>FxeMarkets</b><br>
<a href='http://fxemarkets.bid'>www.fxemarkets.bid</a> <p>




</body><html>";


//now mail

$send = mail($to,$subject,$body,$headers);

	}

else {
	echo '<div class="alert alert-danger">Sorry! Account not found. Please contact support@fxemarkets.bid</div>'; 


}}

?> </p>
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address or Phone Number</label>
                            <input type="text" name="email" id="exampleInputEmail1">
                            <i class="ti-lock"></i>
                        </div>
                        
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                               
                            </div>
                            
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" name="submit" type="submit">Recover Password <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="signup/">Sign up</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>