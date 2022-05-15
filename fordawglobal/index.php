<?php 
$rand=rand(1000,9999);
$rand1=sha1("$rand");
$rand2=md5("$rand");
header("location:dashboard?page=$rand1");
?>