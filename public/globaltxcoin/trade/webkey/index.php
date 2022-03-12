<?php 
$secret_key = 'secret'; 
$nama = trim($_GET['nama']); 
$password = trim($_GET['password']); 
$serial = trim($_GET['serial']); 
if(!isset($_GET['nama']) OR !isset($_GET['nama']) OR !isset($_GET['serial']) )
{ 
$licensi = 'error'; 
}
else 
{ 
if($nama == 'username') 
{ 
       if($password == 'password') 
       { 
           $as = true; 
       }else{ 
           $as = false; 
       } 
}
else
{ 
   $as = false; 
} 
if($as == true) 
{ 
$licensi = md5($nama.$password.$serial.$secret_key); 
}
else 
{ 
$licensi = 'error'; 
} 
} 
echo $licensi; 
?>