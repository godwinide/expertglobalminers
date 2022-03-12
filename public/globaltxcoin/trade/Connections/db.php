<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_dbconnect = "localhost";
$database_dbconnect = "globcgoj_db";
$username_dbconnect = "globcgoj_cool";
$password_dbconnect = "Osabohien1";
$dbconnect = mysql_pconnect($hostname_dbconnect, $username_dbconnect, $password_dbconnect) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db("globcgoj_db",$dbconnect);
?>