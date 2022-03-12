<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_vatserve = "localhost";
$database_vatserve = "globcgoj_db";
$username_vatserve = "globcgoj_cool";
$password_vatserve = "Osabohien1";
$vatserve = mysql_pconnect($hostname_vatserve, $username_vatserve, $password_vatserve) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_select_db("globcgoj_db",$vatserve);
?>