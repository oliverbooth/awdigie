<?php
$datapath = "art/database.php";
function connectfile(){
global $datapath;
$new_file = file("$datapath") ;
$bro = explode("^^",$new_file[7]); 
$bren = explode("&",$bro[3]);
$brset = explode("^^",$new_file[1]); 
$i=0;
foreach(file("$datapath") as $line){
$br = explode("^^",$line); 
$i=min($i, count($bren) - 1);
$i=max($i, 1);

if($bren[($i-1)] == "chan_enabled" or $br[0][0] !== "c"){

$br = explode("^^",$line); 
foreach($br as $brsett){
$data[$br[0]][]=$brsett;
}}

$i++;


}
return $data;
}

function word($number, $word){
if($number == 1){ return "$number $word"; }else{ return "$number $word"."s"; }
}
function countdown($chn){
if($chn == "globe"){ $n = 3; }else{ $n = 5; }
global $data;
$btt = explode("-",$data[$chn][$n]);
$left = (($btt[1] + $btt[0]) - time());
if($left >0){
if($left > 60){ return "".word((  round($left/60)),"Minute")."";
}else{
return word($left,"Second");
}}}

function textfilter($input,$chn){
return str_replace('%C',countdown($chn), str_replace('%T',date("jS \\a\\t H:i"), stripslashes($input))  );
}


function imagezoom(){
global $zoomsett,$image,$data,$dbaddess;



$zm = explode("&",$zoomsett);
$orimage=$image;
$getsize=@getimagesize($dbaddess);
$image =@imagecreatetruecolor($getsize[0],$getsize[1]);
if("$zm[4]" !== "" && file_exists($data["channel".$zm[4]][1]) && "$zm[0]"=="0"){  
$bckim =@imagecreatefromjpeg($data["channel".$zm[4]][1]);
$getcan=@getimagesize($data["channel".$zm[4]][1]);
if($zm[5] == "yes"){ $getcan[0] = $getsize[0]; $getcan[1] = $getsize[1]; }
$image =@imagecreatetruecolor($getcan[0],$getcan[1]);
@imageCopyResampled($image,$bckim,0,0,0,0,$getsize[0],$getsize[1],$getsize[0],$getsize[1]);
}
if("$zm[0]" !== "0"){ $orimage = @imagerotate($orimage, $zm[0],0); }
@imageCopyResampled($image,$orimage,$zm[2],$zm[1],0,0,$zm[3],$zm[3],256,256);


}

function imagetext(){
global $dbtext,$dbtxtsetting,$dbtexten,$dbthisshow,$dbfont,$image,$rota,$dbtextsize,$dbcolor,$dbshset,$dbtexveric,$dbtextpos,$dbshadown,$error;

if($dbtexten == "yes"){
$brtxtdata=array("");
if(preg_match("/\\.txt/i", $dbtext) ){ 
$brtxtdata = explode("-",$dbtxtsetting);
$stxting =str_replace(']','', str_replace('[','',$dbtext) ) ;
if( ( $txttext = @file($stxting)) == FALSE){ $error = $error."-CANT OPEN FILE: $stxting \n"; }   

if($brtxtdata[0] == "alllines"){ $dbtext = join($txttext); }
if($brtxtdata[0] == "onlyline"){ $dbtext = $txttext[($brtxtdata[1]-1)]; }
if($brtxtdata[0] == "last"){
$dbtext='';
for($ln=(sizeof($txttext) - $brtxtdata[1] );$ln<sizeof($txttext);$ln++){ $dbtext = $dbtext.$txttext[$ln];}
}}
if($brtxtdata[0] == "rotate"){ 
$dbtext = $txttext[(time()/10)%sizeof($txttext)];
}
if($dbtexveric == "yes"){ $rota= 90; }else{ $rota=0; }
$t_pos = explode("-",$dbtextpos); 

if($dbshadown == "yes"){ 
$shad = explode("&",$dbshset);
$shc = explode("_",$shad[2]);
$pp = explode("x",$shad[0]);

$y = eval("return $t_pos[1] $pp[1] $shad[1];");
$x = eval("return $t_pos[0] $pp[0] $shad[1];");

@imagettftext($image, $dbtextsize, $rota, $x, $y, imagecolorallocate($image, $shc[0], $shc[1], $shc[2]), "fonts/$dbfont", textfilter($dbtext,$dbthisshow) );
}

$hexrgb=$dbcolor;
$rgb = array( 
hexdec(substr($hexrgb,0,2)), 
hexdec(substr($hexrgb,2,2)), 
hexdec(substr($hexrgb,4,2))); 

if( (    @imagettftext($image, $dbtextsize, $rota, $t_pos[0], $t_pos[1], @imagecolorallocate($image, $rgb[0], $rgb[1], $rgb[2]), "fonts/$dbfont", textfilter($dbtext,$dbthisshow) )) ==false ){ $error = $error."imagettftext error in includes.php"; }
}
}

function watermark(){ 
global $dbwater,$error,$dbaddess,$dbaddess,$dbposi,$image,$enabwater,$dbwateren;
if ($enabwater == "yes" or $dbwateren == "yes"){
if (preg_match("/\\.txt/i", $dbwater) ){
if(($wfilet= @file("$dbwater")) == FALSE){ $error = $error."-WATEMARK TXT IS NOT VALID: $dbwater \n"; }
$dbwater=  preg_replace("/\n/","",$wfilet[(time()/10)%sizeof($wfilet)]); 
}
if(($png= @imagecreatefrompng("$dbwater")) == FALSE){ $error = $error."-CANT USE WATEMARK: $dbwater \n"; }
$w_size= @getimagesize($dbwater);
$i_size= @getimagesize($dbaddess);
$wpos["TopRight"] = (256-$w_size[0])."x0";
$wpos["TopLeft"] = "0x0";
$wpos["BottomRight"] = (256-$w_size[0])."x".(256-$w_size[1]);
$wpos["BottomLeft"] = "0x".($i_size[1]-$w_size[1]);
$w_pos = explode("x",$wpos[$dbposi]);
@imageCopyResampled($image, $png, $w_pos[0], $w_pos[1], 0, 0, $w_size[0], $w_size[1], $w_size[0], $w_size[1]);
}
}//end of function

?>
