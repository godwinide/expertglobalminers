<!doctype html>
<html class="no-js" lang="en">

<?php require_once("../Connections/db.php"); ?>
<?php
$gre = mysql_query("SELECT * FROM setting") or die(mysql_error());
$dat = mysql_fetch_array($gre);

$sit = $dat['sitename'];

 define("sitename",$sit);?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "unverified";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../dashboard/";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$currentPage = $_SERVER["PHP_SELF"];

$colname_access = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_access = $_SESSION['MM_Username'];
}
mysql_select_db($database_dbconnect, $dbconnect);
$query_access = sprintf("SELECT * FROM users WHERE email = %s", GetSQLValueString($colname_access, "text"));
$access = mysql_query($query_access, $dbconnect) or die(mysql_error());
$row_access = mysql_fetch_assoc($access);
$totalRows_access = mysql_num_rows($access);

$maxRows_products = 10;
$pageNum_products = 0;
if (isset($_GET['pageNum_products'])) {
  $pageNum_products = $_GET['pageNum_products'];
}
$startRow_products = $pageNum_products * $maxRows_products;

mysql_select_db($database_dbconnect, $dbconnect);
$query_products = "SELECT * FROM products ORDER BY serial DESC";
$query_limit_products = sprintf("%s LIMIT %d, %d", $query_products, $startRow_products, $maxRows_products);
$products = mysql_query($query_limit_products, $dbconnect) or die(mysql_error());
$row_products = mysql_fetch_assoc($products);

if (isset($_GET['totalRows_products'])) {
  $totalRows_products = $_GET['totalRows_products'];
} else {
  $all_products = mysql_query($query_products);
  $totalRows_products = mysql_num_rows($all_products);
}
$totalPages_products = ceil($totalRows_products/$maxRows_products)-1;


$queryString_products = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_products") == false && 
        stristr($param, "totalRows_products") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_products = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_products = sprintf("&totalRows_products=%d%s", $totalRows_products, $queryString_products);
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo sitename?> | Unverified Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../dashboard/assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../dashboard/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dashboard/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../dashboard/assets/css/themify-icons.css">
    <link rel="stylesheet" href="../dashboard/assets/css/metisMenu.css">
    <link rel="stylesheet" href="../dashboard/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../dashboard/assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../dashboard/assets/css/typography.css">
    <link rel="stylesheet" href="../dashboard/assets/css/default-css.css">
    <link rel="stylesheet" href="../dashboard/assets/css/styles.css">
    <link rel="stylesheet" href="../dashboard/assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../dashboard/assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5d6c59fceb1a6b0be60a71d2/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                <a href="#"><img src="../dashboard/assets/images/bg/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Home</span></a>
                                <ul class="collapse">
                                    <li class="active"><a href="../dashboard/index.php">Dashboard</a></li>
                                    
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user-plus"></i><span>My Account
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="../dashboard/profile">Edit Profile</a></li>
                                    <li><a href="../dashboard/profile/security">Security</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-history"></i><span>Transactions</span></a>
                                <ul class="collapse">
                                    <li><a href="#">Trade History</a></li>
                                    
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-money"></i><span>Deposit</span></a>
                                <ul class="collapse">
                                    <li><a href="#">New Request</a></li>
                                      <li><a href="#">History</a></li>
                                  
                                </ul>
                            </li>
                            
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-bank"></i><span>Withdrawal</span></a>
                                <ul class="collapse">
                                    <li><a href="#">New Request</a></li>
                                      <li><a href="#">History</a></li>
                                  
                                </ul>
                            </li>
                           
                          
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-power-off"></i> <span>Logout</span></a>
                                <ul class="collapse">
                                    <li><a href="../logout">Logout</a></li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <!-- search box --> 
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            
                            </li>
                            
                            
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
  {
  "symbols": [
    {
      "title": "S&P 500",
      "proName": "OANDA:SPX500USD"
    },
    {
      "title": "Shanghai Composite",
      "proName": "INDEX:XLY0"
    },
    {
      "title": "EUR/USD",
      "proName": "FX_IDC:EURUSD"
    },
    {
      "title": "BTC/USD",
      "proName": "BITFINEX:BTCUSD"
    },
    {
      "title": "ETH/USD",
      "proName": "BITFINEX:ETHUSD"
    }
  ],
  "colorTheme": "light",
  "isTransparent": true,
  "displayMode": "adaptive",
  "locale": "en"
}
  </script>

<!-- TradingView Widget END -->
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            
                            <ul class="breadcrumbs pull-left">
                                
                                <li><span> <!-- TradingView Widget BEGIN -->

   </span></li>
                            </ul>
                            
                        </div>
                        
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><h5><?php echo $row_access['currency'];?> <?php echo number_format($row_access['bal'],2,'.',',');?></h5> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                               
                                <a class="dropdown-item" href="#">Settings</a>
                                <a class="dropdown-item" href="../logout">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- sales report area start -->
            
                      
                <!-- sales report area end -->
                <!-- overview area start -->
                
                <!-- overview are
                a end -->
                <!-- market value area start -->
               
                <!-- market value area end -->
                <!-- row area start -->
                <div class="row">
                    <!-- Live Crypto Price area start -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                
                                
                                <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Verify Your Account To Start Trading</h4>
                                            <p>Upload any of the (International Passport, Drivers Licence, Utility Bill)</p>
                                            <hr>
                                            <p class="mb-0">We will review your document and approve your account as soon as possible.</p>
                                        </div>    
                                   
                            <!-- TradingView Widget BEGIN -->

  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-hotlists.js" async>
  {
  "exchange": "US",
  "showChart": true,
  "locale": "en",
  "largeChartUrl": "",
  "width": "100%",
  "height": "320",
  "plotLineColorGrowing": "rgba(33, 150, 243, 1)",
  "plotLineColorFalling": "rgba(33, 150, 243, 1)",
  "gridLineColor": "rgba(242, 243, 245, 1)",
  "scaleFontColor": "rgba(131, 136, 141, 1)",
  "belowLineFillColorGrowing": "rgba(5, 122, 205, 0.12)",
  "belowLineFillColorFalling": "rgba(5, 122, 205, 0.12)",
  "symbolActiveColor": "rgba(225, 239, 249, 1)"
}
  </script>

<!-- TradingView Widget END -->
                            </div>
                        </div>
                    </div>
                    <!-- Live Crypto Price area end -->
                    <!-- trading history area start -->
                    <div class="col-lg-8 mt-sm-30 mt-xs-30">
                        <div class="card">
                            
                         
                            <div class="card card-bordered">
                            
                             <?php 
		 
	
		 
if(isset($_POST['submit']))
{
 
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	$folder="upload/";
	
	$fname = $row_access['firstname'];
	$lname = $row_access['lastname'];
	$email = $row_access['email'];
	$fileno = rand(89785,59774);
	$action = "Approve";
	
	$stat = "Pending";
	
	$date  = date("d/m/Y");
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
{
 
			
		$sql = mysql_query("INSERT INTO verification(firstname,lastname,filename,fileno,email,action,status,date) VALUES('$fname','$lname','$final_file','$fileno','$email','$action','$stat','$date')") or die(mysql_error());
		
	echo '<div class="alert alert-success"><strong>Your Verification Document has been received. Our account team will review your document and get back at you within 24 hours </strong> </div>';				
}
else {
	echo '<div class="alert alert-danger"><strong>Upload failed. Please try again.</strong></div>';
	}

	
	}

?>
                                
                                <div class="card-body">
                                   
                                   
                                    <p class="card-text">
                                    
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="payment" enctype="multipart/form-data" >
         
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="pass"><b>Upload Verification Document </b> </label>
                <input name="file" id="file" type="file" class="form-control" >
                 
              </div>
              <div class="col-md-6">
                
              </div>
            </div>
            <p align="center">   </p>
          </div>
          <input type="submit" value="Upload" name="submit" class="btn btn-success ">
        </form>
                                    </p>
                               
                                </div>
                            </div>
                        
                     
                 <!-- TradingView Widget BEGIN -->

  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-forex-cross-rates.js" async>
  {
  "width": "100%",
  "height": "400",
  "currencies": [
    "EUR",
    "USD",
    "JPY",
    "GBP",
    "CHF",
    "AUD",
    "CAD",
    "NZD",
    "CNY"
  ],
  "locale": "en"
}
  </script>

<!-- TradingView Widget END -->           
                            
                      
                            
                        </div>
                    </div>
                    <!-- trading history area end -->
                </div>
                <!-- row area end -->
               
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2019 <?php echo sitename ?>. All right reserved. .</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    <div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
        <ul class="nav offset-menu-tab">
            <li><a class="active" data-toggle="tab" href="#activity">Activity</a></li>
            <li><a data-toggle="tab" href="#settings">Settings</a></li>
        </ul>
        <div class="offset-content tab-content">
            <div id="activity" class="tab-pane fade in show active">
                <div class="recent-activity">
                    <div class="timeline-task">
                        <div class="icon bg1">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Added</h4>
                            <span class="time"><i class="ti-time"></i>7 Minutes Ago</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>You missed you Password!</h4>
                            <span class="time"><i class="ti-time"></i>09:20 Am</span>
                        </div>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Member waiting for you Attention</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="ti-signal"></i>
                        </div>
                        <div class="tm-title">
                            <h4>You Added Kaji Patha few minutes ago</h4>
                            <span class="time"><i class="ti-time"></i>01 minutes ago</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg1">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Ratul Hamba sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Hello sir , where are you, i am egerly waiting for you.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="ti-signal"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                </div>
            </div>
            <div id="settings" class="tab-pane fade">
                <div class="offset-settings">
                    <h4>General Settings</h4>
                    <div class="settings-list">
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Notifications</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch1" />
                                    <label for="switch1">Toggle</label>
                                </div>
                            </div>
                            <p>Keep it 'On' When you want to get all the notification.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show recent activity</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch2" />
                                    <label for="switch2">Toggle</label>
                                </div>
                            </div>
                            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show your emails</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch3" />
                                    <label for="switch3">Toggle</label>
                                </div>
                            </div>
                            <p>Show email so that easily find you.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show Task statistics</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch4" />
                                    <label for="switch4">Toggle</label>
                                </div>
                            </div>
                            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Notifications</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch5" />
                                    <label for="switch5">Toggle</label>
                                </div>
                            </div>
                            <p>Use checkboxes when looking for yes or no answers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offset area end -->

    <!-- jquery latest version -->
    <script src="../dashboard/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../dashboard/assets/js/popper.min.js"></script>
    <script src="../dashboard/assets/js/bootstrap.min.js"></script>
    <script src="../dashboard/assets/js/owl.carousel.min.js"></script>
    <script src="../dashboard/assets/js/metisMenu.min.js"></script>
    <script src="../dashboard/assets/js/jquery.slimscroll.min.js"></script>
    <script src="../dashboard/assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="../dashboard/assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="../dashboard/assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="../dashboard/assets/js/plugins.js"></script>
    <script src="../dashboard/assets/js/scripts.js"></script>
</body>

</html>
