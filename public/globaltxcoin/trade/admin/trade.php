<?php require_once('Connections/db.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
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

$colname_admin = "-1";
if (isset($_SESSION['MM_username'])) {
  $colname_admin = $_SESSION['MM_username'];
}
mysql_select_db($database_vatserve, $vatserve);
$query_admin = sprintf("SELECT * FROM `admin` WHERE username = %s", GetSQLValueString($colname_admin, "text"));
$admin = mysql_query($query_admin, $vatserve) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);
$totalRows_admin = mysql_num_rows($admin);

mysql_select_db($database_vatserve, $vatserve);
$query_members = "SELECT * FROM users ORDER BY `joining_date` DESC";
$members = mysql_query($query_members, $vatserve) or die(mysql_error());
$row_members = mysql_fetch_assoc($members);
$totalRows_members = mysql_num_rows($members);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>admin</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- full calendar css-->
  <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
  <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="css/fullcalendar.css">
  <link href="css/widgets.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/xcharts.min.css" rel=" stylesheet">
  <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  <!-- =======================================================
    Theme Name: NiceAdmin
    Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">


    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="index.php" class="logo">Mega Earns<span class="lite">Stock</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
            
          </li>
        </ul>
        <!--  search form end -->
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

          <!-- task notificatoin start -->
        
          <!-- task notificatoin end -->
          <!-- inbox notificatoin start-->
          
          <!-- inbox notificatoin end -->
          <!-- alert notification start-->
         
          <!-- alert notification end-->
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="img/avatar.png" width="45" height="45">
                            </span>
                            <span class="username"> <?php echo $row_admin['username']; ?> </span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="#"><i class="icon_profile"></i> My Profile</a>
              </li>
              
             
              <li>
                <a href="../logout"><i class="icon_key_alt"></i> Log Out</a>
              </li>
              
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="dashboard.php">
                          <i class="icon_house_alt">w</i>
                          <span>Admin Dashboard</span>
                      </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Customers</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="dashboard.php">View Members</a></li>
              
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_desktop"></i>
                          <span>Transactions</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="transaction.php">View Transactions</a></li>
              
              <li><a class="" href="trade.php">Trade</a></li>
            
              
            </ul>
          </li>
          <li>
            <a class="" href="account_verify.php">
                          <i class="icon_genius"></i>
                          <span>Verify Account</span>
                      </a>
          </li>
          
          
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Withdrawal</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="#"> View Request</a></li>
            
              
            </ul>
          </li>
         

          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>My Account</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
            
              <li><a class="" href="changepwd.php"><span>SECURITY</span></a></li>
              <li><a class="" href="../logout">LOG OUT</a></li>
              
            </ul>
          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> trade execution</h3>
           
          </div>
        </div>

        <!--/.row-->


        <div class="row">
          <div class="col-lg-9 col-md-12">

            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><i class="fa fa-map-marker red"></i><strong>TRADE EXECUTION</strong></h2>
                <div class="panel-actions">
                  <a href="index.php#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                  <a href="index.php#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="index.php#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
              </div>
              <div class="panel-body-map">
              
              <?php 
			  
			  if(isset($_GET['ref'])){
				  
				  $ref = $_GET['ref'];
				  
			$thisSql = mysql_query("SELECT * FROM trade WHERE id='$ref'") or die(mysql_error());
			
			$thisData = mysql_fetch_array($thisSql);
			
			$thisSymbol = $thisData['symbol'];	
			$thisamt = $thisData['amount'];	
			$thisType = $thisData['type'];	
			$thisTime = $thisData['time'];	
			$thisEmail = $thisData['email'];	
			$thisSL = $thisData['SL'];	
			$thisTP = $thisData['TP'];	
			$thisStat = $thisData['status'];
			$thisExptime = date("h:s:iA");
			$thisID = $thisData['id'];
			  
				  }else{
					
		    $thisSymbol = "";	
			$thisamt = "";	
			$thisType = "";	
			$thisTime = "";	
			$thisEmail = "";	
			$thisSL = "";	
			$thisTP = ""; 
			$thisStat = ""; 
			$thisExptime = date("h:s:iA");
			$thisID = "";
					  
					  }
			  
			
			  if(isset($_POST['execute'])){
				  
				  $mid = $_POST['mid'];
				  $amount = $_POST['amount'];
				  $thisRef = $_POST['isRef'];
				 
				  $exp = 0;
				  
		$check = mysql_query("SELECT * FROM users WHERE email='$mid' ") or die(mysql_error());
		
		$data = mysql_fetch_array($check);
		
		
		$email = $data['email'];		  
		$fname = $data['firstname'];
		$stat = "Completed";	
		
		$action = "Modify";
		
		$type = $_POST['type'];
		$pair = $_POST['pair'];
		$sl = $_POST['sl'];
		$tp = $_POST['tp'];
		$prof = $_POST['profit'];
		 $tim = date("h:i:sA");
		 $priz = "";
		 $exetype = $_POST['exetype'];
		
		 $exgain = "Profit";
		 $exloss = "Loss";
		
	    if($email === $mid && $exetype !== $exloss){
			
         $sql_Trade = mysql_query("UPDATE trade SET status='$stat',profit='$prof',exptime='$thisExptime',action='$action' WHERE id='$thisRef' ") or die(mysql_error());
		 
		 $sqlCred = mysql_query("UPDATE users SET bal=bal+$prof WHERE email='$email' ") or die(mysql_error()); 
		 
		 
			echo '<div class="alert alert-success"><strong> Profit Trade Executed Successfully</strong> </div>';

			// send Email
				$to = "$email";
$subject = "Trade Alert ";

$message = "
<html>
<head>
<title>Trade Notification</title>
</head>
<body>
<p><h3>Hello $fname,</h3> </p>

Find below your trade summary ; <br>
<table>
<thead>
<tr>
<td>Order</td>
<td>Time</td>
<td>Currency Pairs</td>

<td>Profit</td>

</thead>
</tr>

<tr>
<tbody>
<td>$thisID</td>
<td>$thisExptime</td>
<td>$pair</td>
<td>$prof</td>
<tbody>
</tr>
 
<p>

Happy Trading ! <p>



</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: Fxemarkets <no-reply@fxemarkets.bid>' . "\r\n";


mail($to,$subject,$message,$headers);
		
			
			}elseif($email === $mid && $exetype !== $exgain){
				
	    $sqlTrade = mysql_query("UPDATE trade SET status='$stat',loss='$prof',exptime='$thisExptime',action='$action' WHERE id='$thisRef' ") or die(mysql_error()); 
		
		 $sqlCred = mysql_query("UPDATE users SET bal=bal-$prof WHERE email='$email' ") or die(mysql_error()); 
				
			echo '<div class="alert alert-success"><strong>Loss Trade Executed Successfully</strong> </div>';	
				
				} 
			
			else{ 
			
			echo '<div class="alert alert-danger"><strong>Account not found. </strong> </div>';

			}
			
					  
		
				  }
			  
			  ?>
                <!-- Members list-->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" autocomplete = 'off'> 
  
  
  <?php 
  $isPending = "Pending";
  $isCom = $thisStat;
  if($isCom !== $isPending){
	
	$color1 =  "success";
	
	echo '<div class="alert alert-'.$color1.'"><strong>'.$isCom.' </strong></div>';
	  
	  }else{
		
		$color2 =  "danger";  
		
		echo '<div class="alert alert-'.$color2.'"><strong>'.$isCom.' </strong></div>';
		  }
  
  ?>
  
  
 <div class="w3-group">
        <label>Member Email</label> 
		 <input type="email" id="mid" name="mid"  value="<?php echo $thisEmail; ?>" class="w3-input w3-border" required>
		<input type="hidden" value="<?php echo $thisID;?>" name="isRef">
      </div> 
      
      
      <div class="w3-group">
        <label>Execution Type</label> 
		 <select name="exetype" class="w3-input w3-border">
         <option value="Loss">Loss</option>
         <option value="Gain">Profit</option>
         </select>
		
      </div> 
	  

	   <div class="w3-group">
        <label>Amount</label> 
		 <input type="text" id="amount" name="amount" value="<?php echo $thisamt; ?>" class="w3-input w3-border" required>
		
      </div> 
	  
    
    <div class="w3-group">
        <label>Trade Type</label>
		<input type="text" id="type" name="type" value="<?php echo $thisType; ?>" class="w3-input w3-border" required>
		
      </div> 
	  
      <div class="w3-group">
        <label>Currency Pairs</label>
		 <input type="text" id="pair" name="pair"  value="<?php echo $thisSymbol;?>" class="w3-input w3-border" required >
		
      </div>
      
      <div class="w3-group">
        <label>Stop Loss</label>
		 <input type="text" id="sl" name="sl"  value="<?php echo $thisSL; ?>" class="w3-input w3-border"  required>
		
      </div>
      
      
      
      <div class="w3-group">
        <label>Take Profit</label>
		 <input type="text" id="tp" name="tp"  value="<?php echo $thisTP; ?>" class="w3-input w3-border" required >
		
      </div>
      
      <div class="w3-group">
        <label>Expire Time</label>
		 <input type="text" id="tp" name="tp"  value="<?php echo $thisExptime; ?>" class="w3-input w3-border" required >
		
      </div>
      
        <div class="w3-group">
        <label>Profit</label>
		 <input type="text" id="profit" name="profit"  value="" class="w3-input w3-border" required >
		
      </div>
	  
      <button type="submit" name="execute" class="w3-btn-block w3-padding-large w3-green w3-margin-bottom">Execute Order </button>
    </form>  
               
              </div>

            </div>
          </div>
          <div class="col-md-3">
            <!-- List starts -->
            


        </div>





        <!-- project team & activity start -->
        <div class="row"></div><br><br>

        <div class="row"></div>
        <!-- project team & activity end -->

      </section>
      <div class="text-right">
        <div class="credits">
          <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
          -->
          
        </div>
      </div>
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="js/owl.carousel.js"></script>
  <!-- jQuery full calendar -->
  <<script src="js/fullcalendar.min.js"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js"></script>
    <script src="assets/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/xcharts.min.js"></script>
    <script src="js/jquery.autosize.min.js"></script>
    <script src="js/jquery.placeholder.min.js"></script>
    <script src="js/gdp-data.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/sparklines.js"></script>
    <script src="js/charts.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script>
      //knob
      $(function() {
        $(".knob").knob({
          'draw': function() {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation: true,
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true

        });
      });

      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
    </script>
    

<!--End of Tawk.to Script-->

</body>

</html>
<?php
mysql_free_result($admin);

mysql_free_result($members);
?>
    
