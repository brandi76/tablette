<?php
header("Access-Control-Allow-Origin: *");
//error_reporting(E_ALL);
$bdd=mysqli_connect('195.114.27.208','web','admin','aircotedivoire');
$postdata = file_get_contents("php://input");
$param = json_decode($postdata);
$appro=$param->appro;
//$trol=2711;
$query="SELECT produit.pr_cd_pr,pr_desi,ap_prix,pr_famille,ap_qte0 FROM appro,produit,produit_plus where ap_code='$appro' and ap_cd_pr=produit.pr_cd_pr and produit_plus.pr_cd_pr=produit.pr_cd_pr ";
print $query;
$result = mysqli_query($bdd,$query);
$outp="";
while ($row = mysqli_fetch_array($result)){
	$pr_cd_pr=$row['pr_cd_pr'];
	$pr_desi=$row['pr_desi'];
	$pr_prx_vte=$row['ap_prix']/100;
	$pr_famille=$row['pr_famille'];
	$pr_stck=$row['ap_qte0']/100;
	$query="SELECT tr_prix FROM trolley,vol where tr_code=v_troltype*10 and tr_cd_pr='$pr_cd_pr' and v_rot=1 and v_code='$appro'";
	//print $query;
	$result2 = mysqli_query($bdd,$query);
	$row2 = mysqli_fetch_array($result2);
	$pr_prx_xof=$row2[0]/100;
	if ($pr_famille==6 || $pr_famille==7){$famille="Bijouterie";}
	if ($pr_famille==21 || $pr_famille==19){$famille="Accessoires";}
	if ($pr_famille==1 ||$pr_famille==10){$famille="Parfums Femmes";}
	if ($pr_famille==3){$famille="Parfums Hommes";}
	if ($pr_famille==2 || $pr_famille==8 ){$famille="Coffrets Parfums";}
	if ($pr_famille==5){$famille="Comestiques";}
	if ($pr_famille==4){$famille="Montres";}
	$query="select image_s from dfc.produit_mag where code='$pr_cd_pr'";
	$result2 = mysqli_query($bdd,$query);
	$row2 = mysqli_fetch_array($result2);
	$image_s=$row2['image_s'];
	$pr_remise=0;
	if ($outp == ""){$outp = '[{"pr_cd_pr":"'.$pr_cd_pr.'","pr_desi":"'.$pr_desi.'","pr_prx_vte":'.$pr_prx_vte.',"pr_prx_xof":'.$pr_prx_xof.',"pr_stck":'.$pr_stck.',"pr_famille":"'.$famille.'","pr_image_s":"'.$image_s.'"}';}
	else{
		$outp .= ',{"pr_cd_pr":"'.$pr_cd_pr.'","pr_desi":"'.$pr_desi.'","pr_prx_vte":'.$pr_prx_vte.',"pr_prx_xof":'.$pr_prx_xof.',"pr_stck":'.$pr_stck.',"pr_famille":"'.$famille.'","pr_image_s":"'.$image_s.'"}';	
	}
}
$outp.=']';
echo "$outp";
?> 
