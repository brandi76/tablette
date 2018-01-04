<?php
header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL);
$bdd=mysqli_connect('195.114.27.208','web','admin','aircotedivoire');
$query="select cours from devise where id=950";
$result = mysqli_query($bdd,$query);
$row = mysqli_fetch_array($result);
$xaf=$row['cours']+0;
$query="select cours from devise where id=952";
$result = mysqli_query($bdd,$query);
$row = mysqli_fetch_array($result);
$xof=$row['cours']+0;
$query="select cours from devise where id=840";
$result = mysqli_query($bdd,$query);
$row = mysqli_fetch_array($result);
$usd=$row['cours']+0;
$query="select cours from devise where id=826";
$result = mysqli_query($bdd,$query);
$row = mysqli_fetch_array($result);
$gpb=$row['cours']+0;
$outp='[{"cours":1,"sigle":"E","precision":2},{"cours":'.$xof.',"sigle":"XOF","precision":0},{"cours":'.$usd.',"sigle":"$","precision":0},{"cours":'.$gpb.',"sigle":"L","precision":0},{"cours":'.$xaf.',"sigle":"XAF","precision":0}]';

print "$outp";	



