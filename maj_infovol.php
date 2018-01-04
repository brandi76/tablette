<?php
header("Access-Control-Allow-Origin: *");
//error_reporting(E_ALL);
$bdd=mysqli_connect('195.114.27.208','web','admin','aircotedivoire');
$postdata = file_get_contents("php://input");
$param = json_decode($postdata);
$appro=$param->appro;
$query="SELECT v_code,v_vol,v_dest FROM vol where v_code='$appro' and v_rot=1";
$result = mysqli_query($bdd,$query);
$row = mysqli_fetch_array($result);
echo $row['v_code']. " ".$row['v_vol']." ".$row['v_dest'];
?> 
