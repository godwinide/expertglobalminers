<?php require_once('../Connections/db.php'); ?>
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
$query_members = "SELECT * FROM members ORDER BY `date` DESC";
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
  <link rel="shortcut icon" href="../dashboard/img/favicon.png">

  <title>EpicStock</title>

  <!-- Bootstrap CSS -->
  <link href="../dashboard/css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="../dashboard/css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="../dashboard/css/elegant-icons-style.css" rel="stylesheet" />
  <link href="../dashboard/css/font-awesome.min.css" rel="stylesheet" />
  <!-- full calendar css-->
  <link href="../dashboard/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="../dashboard/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="../dashboard/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="../dashboard/css/owl.carousel.css" type="text/css">
  <link href="../dashboard/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="../dashboard/css/fullcalendar.css">
  <link href="../dashboard/css/widgets.css" rel="stylesheet">
  <link href="../dashboard/css/style.css" rel="stylesheet">
  <link href="../dashboard/css/style-responsive.css" rel="stylesheet" />
  <link href="../dashboard/css/xcharts.min.css" rel=" stylesheet">
  <link href="../dashboard/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
  
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
      <a href="../dashboard/index.php" class="logo">Mega Earns<span class="lite">Stock</span></a>
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
                                <img alt="" src="../dashboard/img/avatar.png" width="45" height="45">
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
                <a href="../logout.php"><i class="icon_key_alt"></i> Log Out</a>
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
              
              <li><a class="" href="credit.php">Credit Member</a></li>
             <li><a class="" href="depositreq.php">Funding Request</a></li>
              <li><a class="" href="transaction.php">Add PIN Unit</a></li>
              
            </ul>
          </li>
          <li>
            <a class="" href="smsblast.php">
                          <i class="icon_genius"></i>
                          <span>Bulk SMS</span>
                      </a>
          </li>
          
          
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Recharge PIN</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="#"> PIN ORDER</a></li>
              <li><a class="" href="account_verify.php">LOAD PIN</a></li>
              
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
              <li><a class="" href="logout.php">LOG OUT</a></li>
              
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
            <h3 class="page-header"><i class="fa fa-laptop"></i> DEPOSIT REQUEST</h3>
            
          </div>
        </div>

       


        <div class="row">
          <div class="col-lg-9 col-md-12">

            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><i class="fa fa-map-marker red"></i><strong>CREDIT MEMBER</strong></h2>
                <div class="panel-actions">
                  <a href="../dashboard/index.php#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                  <a href="../dashboard/index.php#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="../dashboard/index.php#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
              </div>
              <div class="panel-body-map">
              
              <?php 
			  
			  $username = "admin";
			  
			  if(isset($_POST['credit'])){
				  
				  $mid = $_POST['mid'];
				  $amount = $_POST['amount'];
				  
				  
				  
		$check = "SELECT * FROM members WHERE id='$mid' ";
		
		$dos = mysql_query($check);
		
		$pul = mysql_fetch_array($dos);
		
		$id = $pul['id'];
		$phone = $pul['phone'];	
		$fname = $pul['firstname'];	  
	
	
	    if($id === $mid){
			
			$restp = "UPDATE members set balance=balance+$amount WHERE id='$mid' ";
			$dores = mysql_query($restp);
			
			echo "<b>Fund added successfully.</b>";
			
			
			
			
			} else{ echo "<p align='center'><font color='#FF0000'> Account not found. Fund not added</p></font>";}
			
					  
		
				  }
			  
			  ?>
                <!-- Members list-->
               <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" autocomplete = 'off'> 
  
  
  
 <div class="w3-group">
        <label>Member ID</label> 
		 <input type="text" id="mid" name="mid" placeholder="Enter Member ID" class="w3-input w3-border" required>
		
      </div> 
	  

	   <div class="w3-group">
        <label>Amount</label> 
		 <input type="text" id="amount" name="amount" placeholder="Amount" class="w3-input w3-border" required>
		
      </div> 
	  
    
	  
	  
      <button type="submit" name="credit" class="w3-btn-block w3-padding-large w3-green w3-margin-bottom">Add Fund</button>
    </form>  
               
              </div>

            </div>
          </div>
          <div class="col-md-3">
            <!-- List starts -->
            


        </div>


        <!-- Today status end -->



        
          <!--/col-->
          



        <!-- statics end -->




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
  <script src="../dashboard/js/jquery.js"></script>
  <script src="../dashboard/js/jquery-ui-1.10.4.min.js"></script>
  <script src="../dashboard/js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="../dashboard/js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="../dashboard/js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="../dashboard/js/jquery.scrollTo.min.js"></script>
  <script src="../dashboard/js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="../dashboard/assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="../dashboard/js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="../dashboard/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="../dashboard/js/owl.carousel.js"></script>
  <!-- jQuery full calendar -->
  <<script src="../dashboard/js/fullcalendar.min.js"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="../dashboard/assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="../dashboard/js/calendar-custom.js"></script>
    <script src="../dashboard/js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="../dashboard/js/jquery.customSelect.min.js"></script>
    <script src="../dashboard/assets/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="../dashboard/js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="../dashboard/js/sparkline-chart.js"></script>
    <script src="../dashboard/js/easy-pie-chart.js"></script>
    <script src="../dashboard/js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../dashboard/js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../dashboard/js/xcharts.min.js"></script>
    <script src="../dashboard/js/jquery.autosize.min.js"></script>
    <script src="../dashboard/js/jquery.placeholder.min.js"></script>
    <script src="../dashboard/js/gdp-data.js"></script>
    <script src="../dashboard/js/morris.min.js"></script>
    <script src="../dashboard/js/sparklines.js"></script>
    <script src="../dashboard/js/charts.js"></script>
    <script src="../dashboard/js/jquery.slimscroll.min.js"></script>
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
    
    
 
</body>

</html>
<?php
mysql_free_result($admin);

mysql_free_result($members);
?>
