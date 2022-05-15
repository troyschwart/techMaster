<?php 
$rand=rand(1000,9999);
$rand1=sha1("$rand");
header("location:login?lid=$rand1"); 
?>