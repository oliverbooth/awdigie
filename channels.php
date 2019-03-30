<?php
$datapath = "art/database.php";
$i=0;
foreach(file("$datapath") as $line){
$br = explode("^^",$line); 
foreach($br as $brsett){
$data[$br[0]][]=$brsett;
}
$i++;
}

if(is_numeric($chan)){ $chan = channel.$chan; $size=big; }
$thfl = $data[$chan][1];
if (eregi(".txt", $data[$chan][1]) && file_exists($thfl)) {  readfile("art/readingfile.jpg"); }else{
if($size == big ){ 
$thissize=256;
}else{
$thissize=128;
}
$im = imageCreateTrueColor($thissize,$thissize);
$erim = @imagecreatefromjpeg($data[$chan][1]);
if($data[$chan][22] == on){
include("includes.php");
$data = connectfile();

list($dbthisshow,$dbaddess,$dbnotes,$dbtexten,$dbtext,$dbatsec,$dbsecen,$dbwateren,$dbwater,$dbtimeen,$dbttmmee,$dbenable,$dbtextpos,$dbfont,$dbcolor,$dbtextsize,$dbtexveric,$dbposi,$dbtxtsetting,$dbshadown,$dbshset,$zoomsett,$chnpwset,$dbprev,$dbfunction) =  $data[$chan];

if ($dbfunction == ""){ $dbfunction=watermarkYimagetext; }
$funct = explode("Y",$dbfunction);
if($data[other][7] !== ""){ 
if( (@include($data[other][7]))  == false){ $error = $error."-CANT USE PLUGIN: ".$data[other][7]." \n"; }
}
$image=$erim;
imagezoom();
$funct[0]();
$funct[1]();
$erim =$image;
}

if("$erim" == ""){ readfile("art/novalid.jpg");  }else{
@ImageCopyResized($im,$erim ,0,0,0,0,$thissize,$thissize,256,256);
imagejpeg($im,'',$data[settings][3]);
imagedestroy($im);
}}
?>
