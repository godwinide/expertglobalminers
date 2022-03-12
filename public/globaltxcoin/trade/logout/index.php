<?php require_once('../Connections/db.php'); ?>
<?php
session_start();
if(session_destroy())
{
echo "<h2 align='center'><font color='#FFFFFF'>Logging out...</font></h2> 
<p align='center'></p> <script> 
				setTimeout(function(){
				window.location.href='../index.php';},1000);</script>";
}
?>