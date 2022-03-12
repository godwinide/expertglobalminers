<?php require_once("../Connections/db.php");?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Create Account | Global FX Miners</title>
    <link rel="icon" type="image/ico" href="assets/images/bg/icon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
   
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="container" style="background-color:#080F20;">
         <a href="../"><img src="assets/images/logo.png" alt=""></a>	
    </div>
    <div class="login-area login-bg">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-xl-4 offset-xl-8 col-lg-6 offset-lg-6">
                    <div class="login-box-s2 ptb--100">
                    
                     
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                            <div class="login-form-head">
                                <h4>Create Account</h4>
                                <p style="color: red;"> Sign up and Start Trading Stock and Global FX Miners Topup</p>
                                
                                <p><?php 
		  
 // Must include this

if(isset($_POST['btn'])){
		
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pass =  $_POST['pass'];
$phone = $_POST['phone'];
$level = "unverified";
$block = "Block";
$activate = "Activate";
$del = "Delete";
$bal = 0;
$cur = $_POST['customRadio2'];
$acctype = $_POST['acctype'];
$log = $_SERVER['REMOTE_ADDR'];
$country = $_POST['country'];
$accno = rand(907884,908487);



if($fname=='')  
    {  
        //javascript use for input checking  
echo"Please enter the First name";  
exit();//this use if first is not work then other will not show  
    }  
if($lname=='')  
    {  
        echo"Please Enter Last Name";  
exit();
	}
if($email=='')  
    {  
        echo"Please enter the email";  
    exit();  
    } 
	
	if($pass=='')  
    {  
        echo"Please enter Password";  
    exit();  
    }
    
    
	if($phone=='')  
    {  
        echo"Please enter Phone Number";  
    exit();  
    } 
$check = mysql_query("SELECT * FROM users WHERE email='$email' ") or die(mysql_error());//looking through existing usernames
   
    $num = mysql_num_rows($check);

    if ($num == 0){ //If there is already such username...

$sql = mysql_query("INSERT into users(firstname,lastname,email,pass,phone,level,IPaddress,block,activate,del,bal,currency,acctype,country,accno) VALUES('$fname','$lname','$email','$pass','$phone','$level','$log','$block','$activate','$del','$bal','$cur','$acctype','$country','$accno')") or die(mysql_error());


	
echo " Dear $fname,

Thank you for choosing Global FX Miners LIMITED as your brokerage service provider. <br> We'll do our best to provide you with the most convenient trading platforms and the best conditions possible.

In accordance with your online application we've opened for you a trading account with the following details:<br>

Membership ID: <b>$accno</b><br>
Account Type: <b>$acctype</b><br>
Password:<b> $pass</b><br>

We've also created a user ID in Global FX Miners Trades Private Office. Your access details are the following:<br>

Login: <b>$email</b><br>
Password: <b>$pass</b><br>
The Bitcoin wallet to which you must deposit is as follows: <br><font color=red>36Wuf8UaWsbp4iNdBhRBqyWwBrhwb4cVb3</font><br>

To start trading from your browser,<a href='index.php'> open 
Global FX Miners online platform.</a>";

$from = "support@globalfxminers.com"; //the email address from which this is sent
$to = "$email"; //the email address you're sending the message to
$subject = "Your Signup at Global FX Miners LIMITED"; //the subject of the message
$message = "

Dear $fname, 

Thank you for choosing Global FX Miners LIMITED as your brokerage service provider. We are delighted to inform you that your trading account has been successfully registered. <br> We'll do our best to provide you with the most convenient trading platforms and the best conditions possible.


We've also created a user ID in Global FX Miners Private Office. Your access/login details are the following:

Login: $email
Password: $pass
The Bitcoin wallet to which you must deposit is as follows:
36Wuf8UaWsbp4iNdBhRBqyWwBrhwb4cVb3


To start trading you need to deposit money to your account. Please check our payment options. Do let me know if there is anything else you want me to assist you with.


Warm Regards

-----------
Alex Giggs
Customer Support
Global FX Miners.com
";
//now mail
$SMTPMail = mail($to,$subject,$message,$headers);
	}

else {
	echo "<h4><font color='#FF0000'>Email already exist. If it's you please <a href='index.php'>login</a> to your account</font></h4>";  // ...kill the script!


}}

?> </p>
                            </div>
                            <div class="login-form-body">
                                <div class="form-gp">
                                    <label for="exampleInputName1">First Name</label>
                                    <input type="text"  name="fname" id="exampleInputName1" required>
                                    <i class="ti-user"></i>
                                </div>
                                
                                <div class="form-gp">
                                    <label for="exampleInputName1">Last Name</label>
                                    <input type="text" name="lname" id="exampleInputName1"  required>
                                    <i class="ti-user"></i>
                                </div>
                                <div class="form-group  ">
                <select required="required" class="form-control" name="country">
            <option selected="selected" value="">Country *</option>
            <option value='Afghanistan' data-dcode='93'>Afghanistan (AFG)</option><option value='Albania' data-dcode='355'>Albania (ALB)</option><option value='Algeria' data-dcode='213'>Algeria (DZA)</option><option value='American Samoa' data-dcode='1684'>American Samoa (ASM)</option><option value='Andorra' data-dcode='376'>Andorra (AND)</option><option value='Angola' data-dcode='244'>Angola (AGO)</option><option value='Anguilla' data-dcode='1264'>Anguilla (AIA)</option><option value='Antigua' data-dcode='1268'>Antigua and Barbuda (ATG)</option><option value='Argentina' data-dcode='54'>Argentina (ARG)</option><option value='Armenia' data-dcode='374'>Armenia (ARM)</option><option value='Aruba' data-dcode='297'>Aruba (ABW)</option><option value='Australia' data-dcode='61'>Australia (AUS)</option><option value='Austria' data-dcode='43'>Austria (AUT)</option><option value='Azerbaijan' data-dcode='994'>Azerbaijan (AZE)</option><option value='Bahamas' data-dcode='1242'>Bahamas (BHS)</option><option value='Bahrain' data-dcode='973'>Bahrain (BHR)</option><option value='Bangladesh' data-dcode='880'>Bangladesh (BGD)</option><option value='Barbados' data-dcode='1246'>Barbados (BRB)</option><option value='Belarus' data-dcode='375'>Belarus (BLR)</option><option value='Belize' data-dcode='501'>Belize (BLZ)</option><option value='Benin' data-dcode='229'>Benin (BEN)</option><option value='Bermuda' data-dcode='1441'>Bermuda (BMU)</option><option value='Bhutan' data-dcode='975'>Bhutan (BTN)</option><option value='Bolivia' data-dcode='591'>Bolivia (BOL)</option><option value='Bosnia' data-dcode='387'>Bosnia and Herzegovina (BIH)</option><option value='Botswana' data-dcode='267'>Botswana (BWA)</option><option value='Bouvet Is.' data-dcode='55'>Bouvet Island (BVT)</option><option value='Brazil' data-dcode='55'>Brazil (BRA)</option><option value='Indian Ocean' data-dcode='246'>British Indian Ocean Territory (IOT)</option><option value='Brunei' data-dcode='673'>Brunei Darussalam (BRN)</option><option value='Bulgaria' data-dcode='359'>Bulgaria (BGR)</option><option value='Burkina Faso' data-dcode='226'>Burkina Faso (BFA)</option><option value='Burundi' data-dcode='257'>Burundi (BDI)</option><option value='Cambodia' data-dcode='855'>Cambodia (KHM)</option><option value='Cameroon' data-dcode='237'>Cameroon (CMR)</option><option value='Canada' data-dcode='237'>Canada (CN)</option><option value='Cape Verde' data-dcode='238'>Cape Verde (CPV)</option><option value='Cayman Islands' data-dcode='1345'>Cayman Islands (CYM)</option><option value='C.A.F' data-dcode='236'>Central African Republic (CAF)</option><option value='td' data-dcode='235'>Chad (TCD)</option><option value='Chile' data-dcode='56'>Chile (CHL)</option><option value='China' data-dcode='86'>China (CHN)</option><option value='Colombia' data-dcode='57'>Colombia (COL)</option><option value='Comoros' data-dcode='269'>Comoros (COM)</option><option value='Congo' data-dcode='242'>Congo (COG)</option><option value='Congo DR' data-dcode='243'>Congo, The Democratic Republic (COD)</option><option value='Cook Island' data-dcode='682'>Cook Islands (COK)</option><option value='Costa Rica' data-dcode='506'>Costa Rica (CRI)</option><option value='Cote D Ivoire' data-dcode='225'>Cote D'Ivoire (CIV)</option><option value='Croatia' data-dcode='385'>Croatia (HRV)</option><option value='Cuba' data-dcode='53'>Cuba (CUB)</option><option value='Cyprus' data-dcode='357'>Cyprus (CYP)</option><option value='Czech Republic' data-dcode='420'>Czech Republic (CZE)</option><option value='Denmark' data-dcode='45'>Denmark (DNK)</option><option value='Djibouti' data-dcode='253'>Djibouti (DJI)</option><option value='Dominica' data-dcode='1767'>Dominica (DMA)</option><option value='Dominica Rep.' data-dcode='1809'>Dominican Republic (DOM)</option><option value='Ecuador' data-dcode='593'>Ecuador (ECU)</option><option value='Egypt' data-dcode='20'>Egypt (EGY)</option><option value='El Salvador' data-dcode='503'>El Salvador (SLV)</option><option value='Eq. Guinea' data-dcode='240'>Equatorial Guinea (GNQ)</option><option value='Eritrea' data-dcode='291'>Eritrea (ERI)</option><option value='Estonia' data-dcode='372'>Estonia (EST)</option><option value='Ethiopia' data-dcode='251'>Ethiopia (ETH)</option><option value='Falkland Island' data-dcode='500'>Falkland Islands (Malvinas) (FLK)</option><option value='Faroe Island' data-dcode='298'>Faroe Islands (FRO)</option><option value='Fiji' data-dcode='679'>Fiji (FJI)</option><option value='Finland' data-dcode='358'>Finland (FIN)</option><option value='French Guiana' data-dcode='594'>French Guiana (GUF)</option><option value='French Polynesia' data-dcode='689'>French Polynesia (PYF)</option><option value='Gabon' data-dcode='241'>Gabon (GAB)</option><option value='Gambia' data-dcode='220'>Gambia (GMB)</option><option value='Georgia' data-dcode='995'>Georgia (GEO)</option><option value='Germany' data-dcode='49'>Germany (DEU)</option><option value='Ghana' data-dcode='233'>Ghana (GHA)</option><option value='Gibraltar' data-dcode='350'>Gibraltar (GIB)</option><option value='Greece' data-dcode='30'>Greece (GRC)</option><option value='Greenland' data-dcode='299'>Greenland (GRL)</option><option value='Grenada' data-dcode='1473'>Grenada (GRD)</option><option value='Guadeloupe' data-dcode='590'>Guadeloupe (GLP)</option><option value='Guam' data-dcode='1671'>Guam (GUM)</option><option value='Guatemala' data-dcode='502'>Guatemala (GTM)</option><option value='Guinea' data-dcode='224'>Guinea (GIN)</option><option value='Guinea-Bissau' data-dcode='245'>Guinea-Bissau (GNB)</option><option value='Guyana' data-dcode='592'>Guyana (GUY)</option><option value='Haiti' data-dcode='509'>Haiti (HTI)</option><option value='Holy See' data-dcode='379'>Holy See (Vatican City State) (VAT)</option><option value='Honduras' data-dcode='504'>Honduras (HND)</option><option value='Hong Kong' data-dcode='852'>Hong Kong (HKG)</option><option value='Hungary' data-dcode='36'>Hungary (HUN)</option><option value='Iceland' data-dcode='354'>Iceland (ISL)</option><option value='India' data-dcode='91'>India (IND)</option><option value='Indonesia' data-dcode='62'>Indonesia (IDN)</option><option value='Iran' data-dcode='98'>Iran, Islamic Republic (IRN)</option><option value='Iraq' data-dcode='964'>Iraq (IRQ)</option><option value='Ireland' data-dcode='353'>Ireland (IRL)</option><option value='Italy' data-dcode='39'>Italy (ITA)</option><option value='Jamaica' data-dcode='1876'>Jamaica (JAM)</option><option value='Japan' data-dcode='81'>Japan (JPN)</option><option value='Jordan' data-dcode='962'>Jordan (JOR)</option><option value='Kazakhstan' data-dcode='7'>Kazakhstan (KAZ)</option><option value='Kenya' data-dcode='254'>Kenya (KEN)</option><option value='Kiribati' data-dcode='686'>Kiribati (KIR)</option><option value='Korea North' data-dcode='850'>Korea (North) (PRK)</option><option value='Korea South' data-dcode='82'>Korea (South) (KOR)</option><option value='Kuwait' data-dcode='965'>Kuwait (KWT)</option><option value='Kyrgyzstan' data-dcode='996'>Kyrgyzstan (KGZ)</option><option value='Laos' data-dcode='856'>Laos (LAO)</option><option value='Latvia' data-dcode='371'>Latvia (LVA)</option><option value='Lebanon' data-dcode='961'>Lebanon (LBN)</option><option value='Lesotho' data-dcode='266'>Lesotho (LSO)</option><option value='Liberia' data-dcode='231'>Liberia (LBR)</option><option value='Libyan A.R' data-dcode='218'>Libyan Arab Jamahiriya (LBY)</option><option value='Liechtenstein' data-dcode='423'>Liechtenstein (LIE)</option><option value='Lithuania' data-dcode='370'>Lithuania (LTU)</option><option value='Luxembourg' data-dcode='352'>Luxembourg (LUX)</option><option value='Macao' data-dcode='853'>Macao (MAC)</option><option value='Macedonia' data-dcode='389'>Macedonia (MKD)</option><option value='Madagascar' data-dcode='261'>Madagascar (MDG)</option><option value='Malawi' data-dcode='265'>Malawi (MWI)</option><option value='Malaysia' data-dcode='60'>Malaysia (MYS)</option><option value='Maldives' data-dcode='960'>Maldives (MDV)</option><option value='Mali' data-dcode='223'>Mali (MLI)</option><option value='Malta' data-dcode='356'>Malta (MLT)</option><option value='Marshall' data-dcode='692'>Marshall Islands (MHL)</option><option value='Martinique' data-dcode='596'>Martinique (MTQ)</option><option value='Mauritania' data-dcode='222'>Mauritania (MRT)</option><option value='Mauritius' data-dcode='230'>Mauritius (MUS)</option><option value='Mayotte' data-dcode='262'>Mayotte (MYT)</option><option value='Mexico' data-dcode='52'>Mexico (MEX)</option><option value='Micronesia' data-dcode='691'>Micronesia (FSM)</option><option value='Moldova' data-dcode='373'>Moldova (MDA)</option><option value='Monaco' data-dcode='377'>Monaco (MCO)</option><option value='Mongolia' data-dcode='976'>Mongolia (MNG)</option><option value='Montenegro' data-dcode='382'>Montenegro (MNE)</option><option value='Montserrat' data-dcode='1664'>Montserrat (MSR)</option><option value='Morocco' data-dcode='212'>Morocco (MAR)</option><option value='Mozambique' data-dcode='258'>Mozambique (MOZ)</option><option value='Myanmar' data-dcode='95'>Myanmar (MMR)</option><option value='Namibia' data-dcode='264'>Namibia (NAM)</option><option value='Nauru' data-dcode='674'>Nauru (NRU)</option><option value='Nepal' data-dcode='977'>Nepal (NPL)</option><option value='Netherlands' data-dcode='31'>Netherlands (NLD)</option><option value='Netherlands Antilles' data-dcode='599'>Netherlands Antilles (ANT)</option><option value='New Caledonia' data-dcode='687'>New Caledonia (NCL)</option><option value='New Zealand' data-dcode='64'>New Zealand (NZL)</option><option value='Nicaragua' data-dcode='505'>Nicaragua (NIC)</option><option value='Niger' data-dcode='227'>Niger (NER)</option><option value='Nigeria' data-dcode='234'>Nigeria (NGA)</option><option value='Niue' data-dcode='683'>Niue (NIU)</option><option value='Norfolk Is.' data-dcode='672'>Norfolk Island (NFK)</option><option value='Northem Mariana Is.' data-dcode='1670'>Northern Mariana Islands (MNP)</option><option value='Norway' data-dcode='47'>Norway (NOR)</option><option value='Oman' data-dcode='968'>Oman (OMN)</option><option value='Pakistan' data-dcode='92'>Pakistan (PAK)</option><option value='Palau' data-dcode='680'>Palau (PLW)</option><option value='Palestinian Ter.' data-dcode='970'>Palestinian Territory (PSE)</option><option value='Panama' data-dcode='507'>Panama (PAN)</option><option value='Papua Guiana' data-dcode='675'>Papua New Guinea (PNG)</option><option value='Paraguay' data-dcode='595'>Paraguay (PRY)</option><option value='Peru' data-dcode='51'>Peru (PER)</option><option value='Philippines' data-dcode='63'>Philippines (PHL)</option><option value='Poland' data-dcode='48'>Poland (POL)</option><option value='Portugal' data-dcode='351'>Portugal (PRT)</option><option value='Puerto Rico' data-dcode='1787'>Puerto Rico (PRI)</option><option value='Qatar' data-dcode='974'>Qatar (QAT)</option><option value='Reunion' data-dcode='262'>Reunion (REU)</option><option value='Romania' data-dcode='40'>Romania (ROU)</option><option value='Russian' data-dcode='7'>Russian Federation (RUS)</option><option value='Rwanda' data-dcode='250'>Rwanda (RWA)</option><option value='Saint Helena' data-dcode='290'>Saint Helena (SHN)</option><option value='Saint Kitts' data-dcode='1869'>Saint Kitts and Nevis (KNA)</option><option value='Saint Lucia' data-dcode='1758'>Saint Lucia (LCA)</option><option value='Saint Pierre' data-dcode='508'>Saint Pierre and Miquelon (SPM)</option><option value='Saint Vincent' data-dcode='1784'>Saint Vincent and the Grenadines (VCT)</option><option value='Samoa' data-dcode='685'>Samoa (WSM)</option><option value='San Marino' data-dcode='378'>San Marino (SMR)</option><option value='Sao Tome' data-dcode='239'>Sao Tome and Principe (STP)</option><option value='Saudi Arabia' data-dcode='966'>Saudi Arabia (SAU)</option><option value='Saudi Arabia' data-dcode='221'>Senegal (SEN)</option><option value='Serbia' data-dcode='381'>Serbia (SRB)</option><option value='Seychelles' data-dcode='248'>Seychelles (SYC)</option><option value='Sierra Leone' data-dcode='232'>Sierra Leone (SLE)</option><option value='Slovakia' data-dcode='421'>Slovakia (SVK)</option><option value='Slovenia' data-dcode='386'>Slovenia (SVN)</option><option value='Solomon Island' data-dcode='677'>Solomon Islands (SLB)</option><option value='Somalia' data-dcode='252'>Somalia (SOM)</option><option value='South Africa' data-dcode='27'>South Africa (ZAF)</option><option value='SGS' data-dcode='995'>South Georgia and the South Sandwich Islands (SGS)</option><option value='Spain' data-dcode='34'>Spain (ESP)</option><option value='Sri Lanka' data-dcode='94'>Sri Lanka (LKA)</option><option value='Sudan' data-dcode='249'>Sudan (SDN)</option><option value='Suriname' data-dcode='597'>Suriname (SUR)</option><option value='Swaziland' data-dcode='268'>Swaziland (SWZ)</option><option value='Sweden' data-dcode='46'>Sweden (SWE)</option><option value='Switzerland' data-dcode='41'>Switzerland (CHE)</option><option value='Syrian Arab Rep.' data-dcode='963'>Syrian Arab Republic (SYR)</option><option value='Taiwan' data-dcode='886'>Taiwan (TWN)</option><option value='Tajikistan' data-dcode='992'>Tajikistan (TJK)</option><option value='Tanzania' data-dcode='255'>Tanzania (TZA)</option><option value='Thailand' data-dcode='66'>Thailand (THA)</option><option value='Timor-Leste' data-dcode='670'>Timor-Leste (TLS)</option><option value='Togo' data-dcode='228'>Togo (TGO)</option><option value='Tokelau' data-dcode='690'>Tokelau (TKL)</option><option value='Tonga' data-dcode='676'>Tonga (TON)</option><option value='Trinidad and Tobago' data-dcode='1868'>Trinidad and Tobago (TTO)</option><option value='Tunisia' data-dcode='216'>Tunisia (TUN)</option><option value='Turkey' data-dcode='90'>Turkey (TUR)</option><option value='Turkmenistan' data-dcode='993'>Turkmenistan (TKM)</option><option value='Turks and Caicos' data-dcode='1649'>Turks and Caicos Islands (TCA)</option><option value='Tuvalu' data-dcode='688'>Tuvalu (TUV)</option><option value='Uganda' data-dcode='256'>Uganda (UGA)</option><option value='Ukraine' data-dcode='380'>Ukraine (UKR)</option><option value='UAE' data-dcode='971'>United Arab Emirates (UAE)</option><option value='Uruguay' data-dcode='598'>Uruguay (URY)</option><option value='USA' data-dcode='598'>United States (USA)</option><option value="Uk">United Kingdom (UK)</option><option value='Uzbekistan' data-dcode='998'>Uzbekistan (UZB)</option><option value='Vanuatu' data-dcode='678'>Vanuatu (VUT)</option><option value='Venezuela' data-dcode='58'>Venezuela (VEN)</option><option value='Vietnam' data-dcode='84'>Vietnam (VNM)</option><option value='Virgin Island B.' data-dcode='1284'>Virgin Islands, British (VGB)</option><option value='Virgin Island US' data-dcode='1340'>Virgin Islands, U.S. (VIR)</option><option value='Wallis and Futuna' data-dcode='681'>Wallis and Futuna (WLF)</option><option value='Western Sahara' data-dcode='212'>Western Sahara (ESH)</option><option value='Yemen' data-dcode='967'>Yemen (YEM)</option><option value='Zambia' data-dcode='260'>Zambia (ZMB)</option><option value='Zimbabwe' data-dcode='263'>Zimbabwe (ZWE)</option>
        </select>            
            </div>
                                <div class="form-gp">
                                    <label for="exampleInputName1">ZipCode</label>
                                    <input type="text" name="zip" id="exampleInputName1"  required>
                                    <i class="ti-zip"></i>
                                </div>
                                
                                <div class="form-gp">
                                    <label for="exampleInputEmail1">Email (Username)</label>
                                    <input type="email" name="email" id="exampleInputEmail1" placeholder"" required>
                                    <i class="ti-email"></i>
                                </div>
                                
                                <div class="form-gp">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="pass" id="exampleInputPassword1"  required>
                                    <i class="ti-lock"></i>
                                </div>
                                
                                <div class="form-gp">
                                    <label for="exampleInputPassword2">Phone</label>
                                    <input type="phone"  name="phone"id="exampleInputPassword2"  required>
                                    <i class="ti-mobile"></i>
                                    <input name="country" type="hidden" class="form-control" id="country" value="<?php

    include("geoip.inc");

    function ipAddress(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])){ //check ip from share internet
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ // proxy pass ip
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    $gi = geoip_open("GeoIP.dat",GEOIP_STANDARD);

    echo geoip_country_name_by_addr($gi, ipAddress());
    // echo geoip_country_code_by_addr($gi, ipAddress()); <-- country code   

    geoip_close($gi);

?>">
            
                                </div>
                                
                             <div class="form-group  ">
                <select required="required"  class="form-control " name="type">
                    <option selected="selected" value="">Product Type</option>
                    <option value="trade">Forex</option>
                    <option value="mining">Cryptos</option>
                    <option value="mining">Stocks</option>
                    <option value="mining">Indices</option>
                </select>            
            </div>
            <div class="form-group  ">
                <select required="required"  class="form-control " name="acctype">
                    <option selected="selected" value="">Investment Plans</option>
                    <option value="Basic Plan" name="acctype">Standard Plan: 0.054BTC -1BTC</option>
                    <option value="Standard Plan" name="acctype">Pro Plan:  0.11 - 10BTC</option>
                    <option value="VIP Plan" name="acctype">VIP Plan: 10BTC and Above</option>
                </select>            
            </div>
            <div class="form-group  ">
                <select required="required"  class="form-control " name="type">
                    <option selected="selected" value="">Investment Option</option>
                    <option value="mining">MT4 (Forex, CFDs on Stocks, Equity Indices, Metals, Energies)</option>
                    <option value="trade">MT5 (Forex, CFDs on Stocks, Equity Indices, Metals, Energies)</option>
                </select>            
            </div>
                             <div class="form-group">
                                        
                                     <b class="text-muted mb-3 mt-4 d-block">Account Currency:</b>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="USD" checked id="customRadio4" name="customRadio2" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio4">$ USD</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="GBP" id="customRadio5" name="customRadio2" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio5">&pound; GBP</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="GBP" id="customRadio6" name="customRadio2" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio6">&euro; EUR</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="GBP" id="customRadio7" name="customRadio2" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio7">&#3647; BTC</label>
                                            </div>
                                            
                                            
                                           </div> 
                                
                                <div class="submit-btn-area">
                                    <button id="form_submit" name="btn" >Submit <i class="ti-arrow-right"></i></button>
                                   
                                </div>
                                <div class="form-footer text-center mt-5">
                                    <p class="text-muted">Already have an account? <a href="../index.php">Sign in</a><p class="text-muted"><a href="https://Global FX Miners.com"><b>Homepage</b></a></p></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
    <!--Start of Tawk.to Script-->

    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
  
</body>

</html>