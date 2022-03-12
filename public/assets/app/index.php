<!DOCTYPE html>
<html>
<head>
 <title>Index Page</title>
</head>
<body>
 <?php
 $secret_code = 'secret';
 if(strtoupper(PHP_OS) == strtoupper("LINUX"))
 {
 $ds=shell_exec('udevadm info --query=all --name=/dev/sda | grep ID_SERIAL_SHORT');
 $serialx = explode("=", $ds);
 $serial = $serialx[1];
 $licensi = md5('username'.'password'.trim($serial).$secret_code);
 }
 else
 {
 function GetVolumeLabel($drive) 
 {
 if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) 
 {
 $volname = ' ('.$m[1].')'; 
 } 
 else 
 { 
 $volname = ''; 
 }
 return $volname;
 }
 $serial = str_replace("(","",str_replace(")","",GetVolumeLabel("c")));
 $licensi = md5('username'.'password'.trim($serial).$secret_code);
 }
 $lisfile = $licensi.'.key';

 if(!file_exists(__DIR__.'/'.$lisfile))
 {
 header('Location: activator.html');
 }
 ?>

 <h1>Welcome to web application</h1>
 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
 proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</body>
</html>