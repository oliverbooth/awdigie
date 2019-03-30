<?php
# for awdigie 1.1
include("includes.php");
$data = connectfile();
$error = "";
$dbwateren = isset($_GET["dbwateren"]) ? $_GET["dbwateren"] : "";
$dbfunction = isset($_GET["dbfunction"]) ? $_GET["dbfunction"] : "";

if($data["mode"][1] == "TD"){ readfile($data["settings"][10]); }else{
if($data["mode"][1] == "program"){
if(($progf= fopen($data["other"][1],"r+"))  == FALSE){ $error = $error."-CANT OPEN PROGRAM FILE: ".$data["other"][1]." \n"; }
$pimages = @fread($progf, @filesize($data["other"][1]));
@fclose($progf);

if( strpos($pimages, "|") ){
$bpr = explode("|", str_replace("
", "", $pimages)); 
function choose($nim){
global $bpr;
return explode("^",  $bpr[$nim] );
}
$numofcun =(time()/10)%sizeof($bpr);
$biir = choose($numofcun);
if(!$biir[1]){ $biir=choose( ($numofcun-1) );  }
$dbaddess=$biir[0];
if("$biir[2]" !== "" && "$biir[2]" !== "None"){ 
if(  (@include($biir[2]))  == false){ $error = $error."-CANT USE IM PLUG: ".$biir[2]." \n"; }
}
}else{
$progf = explode("\n", $pimages); 
$dbaddess=  preg_replace("/\n/","",$progf[(time()/10)%sizeof($progf)]); 
}

if(($image = @imagecreatefromjpeg("$dbaddess")) == FALSE){ $error = $error."-CANT USE IMAGE: $dbaddess \n";  }
$dbwater = $data["other"][4]; 
$dbposi = $data["other"][5]; 
}
if($data["mode"][1] == "live"){

for($t = 1; $t < 5; $t++){ 
if($data["channel".$t][9] == "yes" && $data["channel".$t][10] < time() ){ $ocurrent=$data["channel".$t]; }
}

if($data["settings"][2] == "yes"){ 
$ch = array("channel1","channel2","channel3","channel4");
$current=$data[$ch[(rand(0,3))]];
}else{
if($data["settings"][6] == "yes"){ 
if(($rotchn = @file($data["settings"][7])) == false){ $error = $error."-CANT USE CH ROTATE FILE\n";  }
$current =$data[(preg_replace("/\n/","",$rotchn[(time()/10)%sizeof($rotchn)]))];
}else{
$current=$data[$data["settings"][4]];
}
}
if("$ocurrent" !== ""){  $current=$ocurrent; }
if($data["globe"][8] == "chan_enabled"){ 
list($dbthisshow,$dbtexten,$dbtexveric,$dbatsec,$dbwateren,$dbwater,$dbposi,$dbtext,$dbenable,$dbfont,$dbtextpos,$dbcolor,$dbtextsize,$dbtxtsetting,$dbshadown,$dbshset) = $data["globe"];
$dbaddess=$current[1];
}else{
list($dbthisshow,$dbaddess,$dbnotes,$dbtexten,$dbtext,$dbatsec,$dbsecen,$dbwateren,$dbwater,$dbtimeen,$dbttmmee,$dbenable,$dbtextpos,$dbfont,$dbcolor,$dbtextsize,$dbtexveric,$dbposi,$dbtxtsetting,$dbshadown,$dbshset,$zoomsett,$chnpwset,$dbprev,$dbfunction) = $current;
}

if($data["other"][7] !== ""){ 



if(  (@include($data["other"][7]))  == false){ $error = $error."-CANT USE PLUGIN: ".$data["other"][7]." \n"; }
}

if($data["overchan"] !== ""){ $current=$data[$data["overchan"]];  }
if (eregi(".txt", $dbaddess) ){
if(($tdf= @file("$dbaddess"))  == FALSE){ $error = $error."-CANT OPEN FILE: $dbaddess \n"; }
$dbaddess=  eregi_replace("\n","",$tdf[(time()/10)%sizeof($tdf)]); 
}else{
if($data["settings"][13] == "yes"  ){ 
$bsw = explode("%",$data["settings"][14]);
if((time() - filemtime($dbaddess)) > $bsw[0]){
$dbaddess = $data[$bsw[1]][1];
}}}

if(($image = @imagecreatefromjpeg($dbaddess)) == FALSE){ $error = $error."-CANT USE IMAGE: $dbaddess \n"; 
$imerror= $data["settings"][10];
}
if($data["globe"][8] !== "chan_enabled"){ 
imagezoom();
}
}//end of if mode is live

if($dbwateren == "yes" or $data["other"][2] == "yes" && $data["mode"][1] == "program"){
$enabwater="yes";
}

if ($dbfunction == "" ){ $dbfunction="watermarkYimagetext"; if($data["globe"][8] !== "chan_enabled"){ 
if($data["mode"][1] !== "program"){$error = $error."-ERROR READING DB FUNCTION STRING\n";  }
}}
$funct = explode("Y",$dbfunction);

$funct[0]();
$funct[1]();

if($data["mode"][1] == "live"){

$brec = explode("%",$data["settings"][11]);
if(($brec[1] == "yes" && $brec[2] < time()) ){ $pass="yes"; }
if($data["settings"][12] == "Record Now"){ $pass="yes"; }
if($pass == "yes" ){
$rec_txt= "txt/rec_".$brec[0]."_".$brec[6].".txt";
$sim= file($rec_txt);
if($data["settings"][4] == $brec[0] || $brec[0]== "all"){
if(filesize(preg_replace("/(\n|\r)/","",end($sim))) !== filesize($dbaddess) && $brec[5] > sizeof($sim) ){
$fpr = fopen($rec_txt,"a+");
fputs($fpr,"rec/$brec[6]/".$brec[0]."_$brec[7]".sizeof($sim).".jpg
");
fclose($fpr);
copy($dbaddess, "rec/$brec[6]/".$brec[0]."_$brec[7]".sizeof($sim).".jpg");
}}}}// end of if live mode
if($data["settings"][8] == "yes" && $_COOKIE['awdigiecookie'] == $data["settings"][1] && "$error" !== "" ){ 
if($image == "" ){ $image = imagecreate(256,256); imagefilltoborder ($image, 256, 200, 150, ImageColorAllocate($image, 0 , 0 , 0));  }
imagettftext($image, 6, 0, 5, 10, ImageColorAllocate($image, 255 , 255 , 255), "fonts/DigitaldreamFat.TTF", "ERRORS WHILE PROCESSING TV.PHP\nONLY ADMIN CAN SEE THIS MESSAGE\n\n $error");
}
if(isset($imerror) && "$imerror" !== "" && $data["settings"][9] == "yes" &&  $_COOKIE['awdigiecookie'] !== $data["settings"][1] ){ 
$image= imagecreatefromjpeg($imerror);
}
if(isset($status) && "$status" == "true"){ echo "<body bgcolor=0 text=white>\n"; if($error){ echo"Station Errors<br>".str_replace("\n", "<img src=art/flash_red.gif>\n<br>", $error);}else{echo"Station is up\n<br>Current Mode <b>".$data["mode"][1]."</b>";}}else{
header("Content-type: image/jpeg");
imagejpeg($image,null,'95');
@imagedestroy($image);
}
}//if tex
?>