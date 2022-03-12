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
  <link rel="shortcut icon" href="../dashboard/img/favicon.png">

  <title>Admin | Dashboard</title>

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
      <a href="index.php" class="logo">Global FX Miners<span class="lite"> Earn</span></a>
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
                                <img alt="" src="img/avatar_mini4.jpg" width="45" height="45">
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
              <li><a class="" href="deposit.php">Deposit</a></li>
             <li><a class="" href="credit.php">Credit</a></li>
             
             <li><a class="" href="trade.php">Add Trade</a></li>
            
           
              
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
              <li><a class="" href="request.php"> View Request</a></li>
             
              
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
              
              <li><a class="" href="settings.php"><span>Settings</span></a></li>
              <li><a class="" href=""><span>Add Wallet Address</span></a></li>
              <li><a class="" href=""><span>Refferals Link</span></a></li>
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
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
          </div>
        </div>

        <div class="row">
          
          <!--/.col-->

          
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box dark-bg">
              <i class="fa fa-group"></i>
              <div class="count"><?php 
			  $tot = "SELECT count(*)as firstname FROM users";
			  $do = mysql_query($tot);
			  if($do){
				  $total = mysql_result($do,0);
				  
				  echo $total;
				  }
			
			   ?></div>
              <div class="title">Members</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box green-bg">
              <i class="fa fa-bank"></i>
              <div class="count"><?php 
			  $tot = "SELECT count(*)as orderno FROM withdrawal";
			  $do = mysql_query($tot);
			  if($do){
				  $total = mysql_result($do,0);
				  
				  echo $total;
				  }
			
			   ?></div>
              <a href="request.php"><div class="title">Withdrawal Request</div></a>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->
          
          
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
              <i class="fa fa-bank"></i>
              <div class="count"><?php 
			  $tot = "SELECT count(*)as orderno FROM deposit";
			  $do = mysql_query($tot);
			  if($do){
				  $total = mysql_result($do,0);
				  
				  echo $total;
				  }
			
			   ?></div>
              <a href="deposit.php"><div class="title">Deposit Request</div></a>
            </div>
          
          

        </div>
        <!--/.row-->


        <div class="row">
          <div class="col-lg-9 col-md-12">

            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><i class="fa fa-map-marker red"></i><strong>Members</strong></h2>
                <div class="panel-actions">
                  <a href="index.php#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                  <a href="index.php#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="index.php#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
              </div>
              <div class="panel-body-map">
                <!-- Members list-->
                
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    
                    <th>Name</th>
                   
                    <th>Phone</th>
                    <th>Email</th>
                    
                    <th>Balance</th>
                   
                    <th>Status</th>
                    <th>Member ID</th>
                    <th>Account Type</th>
                     <th>Password</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <?php do { ?>
                    <tr>
                      <tbody>
                      <td><?php echo $row_members['firstname']; ?> <?php echo $row_members['lastname']; ?> <br>
                      
                      </td>
                     
                      <td><?php echo $row_members['phone']; ?></td>
                      <td><?php echo $row_members['email']; ?></td>
                     
                      <td>USD <?php echo $row_members['bal']; ?></td>
                      
                      <?php 
					  $lev = $row_members['level'];
					  $thisVer = "verified";
					  
					  if($lev !== $thisVer){
						  $color = "danger";
						  
						  
						  }else{
							 
							 $color = "success"; 
							  }
							  
							  
					  $sta = $row_members['level'];
					  $thisStat = "verified";
					  $thisNew = "unverified";
					  $dom = $row_members['blockstat'];
					  $isblo = "Dormant";
					  $noDom = "";
					  $thisdom = $row_members['blockinfo'];
					 
			
					  
					  ?>
                      <td><span class="alert-<?php echo $color; ?>"><?php if($sta !== $thisStat && $dom === $isblo){ echo $thisdom;} elseif($sta === $thisNew or $thisStat){echo $row_members['level'];} ?></span></td>
                      <td><?php echo $row_members['accno']; ?></td>
                      <td><?php echo $row_members['acctype']; ?></td>
                      <td><?php echo $row_members['pass']; ?></td>
                      <td>
                      
                       <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">Action</button>
                                       
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="btn btn-danger" href="action.php?del=<?php echo $row_members['accno']; ?> "><?php echo $row_members['del']; ?></a>
                                            <a class="btn btn-info" href="action.php?blo=<?php echo $row_members['accno']; ?>"><?php echo $row_members['block']; ?></a>
                                            <a class="btn btn-success" href="action.php?un=<?php echo $row_members['accno']; ?>">Approve</a>
                                            
                                            
                                        </div>
                                    </div>
                      </td>
                    </tr>
                    <?php } while ($row_members = mysql_fetch_assoc($members)); ?>
                    </tbody>
                </table>
                
                
                
                
                </div>
              </div>

            </div>
          </div>
          

        <!-- Today status end -->



        
          

        </div>



        <!-- statics end -->




        
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
    
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>

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
    
    
   
</body>

</html>
<?php
mysql_free_result($admin);

mysql_free_result($members);
?>
