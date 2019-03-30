<?php
$datapath= "art/database.php";
$thispath=$_SERVER['PHP_SELF'];
$strlength=15;

$i=0;
foreach(file("$datapath") as $line){
$br = explode("^^",$line); 
foreach($br as $brsett){
$data[$br[0]][]=$brsett;

}
$i++;
}
if($_COOKIE["awdigiecookie"] == $data["settings"][1] ){ 
$datafile= $data["other"][1];

if(isset($_GET["timeline"])){
$ttfile=file($datafile);
$back= imagecreatefromjpeg("timeline.jpg");
imagefill($back,0,0,ImageColorAllocate($back,109,109,224));
$i=0;
$str_color=ImageColorAllocate($back,255,255,255);
if("$range" !== ""){ $imv=$range; }else{ $imv=0; }
while($imv < count($ttfile)){
$top_color='';
$br = explode("^",$ttfile[$imv]); 
$top =15;
$thumh=33;
$thumw=33;
$left=($i*($thumw +6 ))+4;

if("$br[3]"  !== ""){ $br[0] ="FB.jpg";  }
if(($im= @imagecreatefromjpeg($br[0])) == false ){

$im = imageCreateTrueColor($thumh,$thumw);
$top_color = ImageColorAllocate($back,255,0,0);
}
$s = @getimagesize($br[0]);

@imagefilledrectangle($back,($left -1 ), ($top - 2 ),($left +$thumw+ 1), ($top + $thumh ), $col ); 
@imagefilledrectangle($back,($left -1 ), ($top - 15 ),($left +$thumw+ 1), ($top -4 ), $top_color ); 

imagecopyresampled($back, $im,$left , $top, 0, 0, $thumh, $thumw, $s[0], $s[1]);

$str_w= $imv+1;
$srt_left = $left+(18-(  strlen($str_w) *4));
imagettftext($back, 7, 0, $srt_left,($top  - 5), $str_color, "fonts/TIMES.TTF",$str_w);

$i++;
$imv++;
}//end loop
$range=$range+1;
$total_images=count($ttfile);
$rq = ( 619-  (   ($total_images / 17) * 60)  ); //for image
if($rq < 0){ $rq =0;}
$bar_left=19;
$bar_r =$rq;
imagefilledrectangle($back,($bar_left  ), 53,($bar_left +$bar_r), 57, ImageColorAllocate($back,0,153,204) ); 
imagejpeg($back);
imagedestroy($back);

}else{

if(isset($_GET["driveimage"])){
$fim= imagecreatefromjpeg("FB.jpg");
$i=1;
$sd=0;
$top=23;
$dh= @opendir($driveimage);
while (false !== ($fise= @readdir($dh) )&& $i < 5) {
if($fise !== '..' && $fise !== '.' && eregi(("\.jpg|\.jpeg"), $fise) ){
$im = @imagecreatefromjpeg($driveimage.'/'.$fise);
$s=getimagesize($driveimage.'/'.$fise);
if($i == 3){
$top=70;
$sd=0;
}
$left=($sd*50)+20;
@imagefilledrectangle($fim,($left -1 ), ($top - 1 ),($left +41), ($top + 41 ), $col ); 
@imagecopyresampled($fim, $im,$left , $top, 0, 0, 40, 40, $s[0], $s[1]);
$allim[]=$fise;
$i++;
$sd++;
}
}//end of loop

imagejpeg($fim);
imagedestroy($fim);
}else{

function notes($in){  
global $data;
if($data["other"][6] == "Show"){ echo "<font color=\"#003366\" size=2>$in</font> ";  }}

function short($in){
global $strlength;
if(strlen($in) > $strlength){ return substr($in,0,$strlength).'..'; }else{ return $in; } 
}
function word($input,$word){ if($input == 1){ return "<strong>$input</strong> $word"; }else{ return "<strong>$input</strong> $word".s; }}

$DB= @file($datafile);
if(!strpos($DB[0], "|") ){ echo "<font size=2>You need to run <a href=\""; if(file_exists("txt_to_program.php")){ echo "txt_to_program.php"; }else{ echo "http://www.vmist.net/scripts/download.php?file=txt_to_program";   } echo '">txt_to_program</a> in order to use AWD Program.</font>';    }else{  

for($a=0;$a<count($DB);$a++){
if(!$ishere){
$lines[$a]=$DB[$a];
}else{
$input = y;
$div = explode("|",$DB[$a]);
$dv = explode("^",$div[0]);
$lines[$a] ="$valpath[$a]^$valname[$a]^$valplug[$a]^".$dv[3]."^".str_replace("\n","",stristr($DB[$a], '|'))."
";
}//if not mod
}


if($add){
if(is_dir($imfield)){

$dh= opendir($imfield);
$dfl=1;
while (false !== ($fl= readdir($dh))) {
if($fl !== '..' && $fl !== '.' && eregi(("\.jpg|\.jpeg"), $fl) ){
if($dfl){ $dri_str = "$imfield/$fl^Folder - $imfield^None^$imfield^|"; unset($dfl); }else{

$dri_str = $dri_str."$imfield/$fl^|"; 
}// if not dfl

$none=n;
}// end if jpeg
}// end loop
if("$none" == "n"){

$lines[(count($lines))] = "$dri_str
";
$input = y;

}else{ 
$imfielderror ="No Images found in directory.<br>";
}
}else{ //if not dir 
if(!@imagecreatefromjpeg($imfield)){ $imfielderror = "Can't Use Image.<br>";  }else{  

if($imfield[0] == '/' ){ $imfields = $imfield; }else{ $imfields = '/'.$imfield; }
$lines[(count($lines))] ="$imfield^".substr(strrchr($imfields, "/"), 1)."^None^^|
";
$input = y;

}// if  valid image
}// if file
}// if add
if("$remove" !== ""){ $lines[$remove]='';  $input = y; }
if($multido == "Remove"){ 
if(!empty($check)){
foreach($check as $value){

$lines[$value]='';

 $input = y; 
}// end of loop
}//if empty
}//end of multido

if("$movefrom" !== ""){
$norm= $lines;
$movethis=$movefrom;
$tonumber=$emptyvar2;
$to = $norm[$movethis];
unset($norm[$movethis]);
array_splice($norm, $tonumber, count($norm), array_merge(array("$to"), array_slice($norm, $tonumber))); 
$lines = $norm;
$input = y; 

}// if move
if("$input" !== ""){
$fp = fopen($datafile,"w+");
for($a=0;$a<count($lines);$a++){
fputs($fp,"$lines[$a]");
}
fclose($fp);
}
$set=file("$datafile");
$net = explode("^%",$data["other"][8]); 
$total_images=substr_count(join($set), "|");
?>
<style type="text/css">
<!--
input.sly{ background: #F0F4FB }


A:link { color: #006699}
A:visited {color: #006699}
A:hover {color: #000099} 

 select { 
background-color: #CCCCCC; 
font-family: Trebuchet MS; 
font-size: 11px; 
} 
-->
</style>
<script language="JavaScript">

 if(navigator.appName !== "Microsoft Internet Explorer"){
 alert("You're not using the Internet Explorer browser. \n Some Javascript controls will not work.")
}

function movebox(id,numi){
tab = document.getElementById('tabNum'+numi);

document.formlist.emptyvar.value=numi; 

moveidbox.style.display='block';
moveidbox.style.top=event.y;
moveidbox.style.left=event.x;
tab.bgColor='00CCFF';
nummenu.focus();

}

function numendmove(sel){
if(sel !== null){
formlist.submit();
}
moveidbox.style.display='none';
tab.bgColor='EFEFEF';
}
function rename(id,name,num,what,bld){
doc = document.getElementById(id);
tab = document.getElementById('tab'+name+num);
val = document.getElementById('val'+name+num);


if(bld == null){ bbwd.innerText='Rename '; }else{ bbwd.innerText=bld; }

renamebox.style.top=event.y;
renamebox.style.left=event.x;
renamebox.style.display='block';
wre.innerText=name;
textrename.value=val.value;
tab.bgColor='00CCFF';
textrename.focus();
}

function renameout(){
renamebox.style.display='none';
tab.bgColor='EFEFEF';
}

function load(id,ll){

fid = document.getElementById('filesize'+id);
sid = document.getElementById('imagesize'+id);
nid = document.getElementById('valname'+id);
if(ll){
imid =ll;
}else{
imid = document.getElementById('valpath'+id).value
}

imgpreview=document.getElementById('imgpreview');


filesize.innerText=fid.value;
imagesize.innerText=sid.value;
filename.innerText=nid.value
imgpreview.src=imid;
}
</script>
<body>
<div id="renamebox" style="position:absolute; left:847px; top:378px; width:91px; height:16px;  background-color: #B0C5E3; layer-background-color: #B0C5E3; border: 1px none #000000; display:none" > 
  <font size="2"><a id=bbwd></a><strong> <a id=wre></a></strong></font><br>
  <input id="textrename" type="text" size="10" onkeyup="if(this.value.length > 15){ doc.innerText=this.value.substr(0,15)+'..'; }else{doc.innerText=this.value; }  val.value=this.value;" onBlur="renameout()">
</div>
<div id="moveidbox" style="position:absolute; left:842px; top:320px; width:91px; height:16px;  background-color: #B0C5E3; layer-background-color: #B0C5E3; border: 1px none #000000; display:none" > 
  <font size="2"> Move This To</font><br>
  <script language="JavaScript">
  document.write('<select id=nummenu name=nummenu onblur="numendmove(null)" onchange="document.formlist.emptyvar.name=\'movefrom\';  document.formlist.emptyvar2.value=this.options[this.selectedIndex].value; formlist.submit(); "><option  selected></option>'); 

  for (var i=0; i <= <?php echo sizeof($set)-1 ?>; i++ ) { 
    document.write('<option value=' + i + '>Place' + (i+1) +'</option>'); 	
}
  document.write('</select>'); 
</script>
</div>
<script language="JavaScript">
function selectchk(){
wcb=document.getElementById('wchk').innerText;

if(document.getElementById('wchk').innerText == 'All'){ 
ct= true; 
document.getElementById('wchk').innerText='None'; 
}else{ 
ct= false; 
document.getElementById('wchk').innerText='All'; 
}

for (var i=0; i <= <?php echo sizeof($set)-1 ?>; i++ ) { 

document.getElementById('check['+i+']').checked=ct;


}// end for()
}//end function
  </script>
<?php echo "AWD Program - <strong>$datafile</strong>"; notes("<br>Small program for easier editing the program guide."); ?> 
<font size="2"><a href="control.php"><br>
Back to control</a></font> 
<form action="<?php echo $thispath  ?>" method="post" name="formlist" id="formlist">
  <table width="694" border="0" cellspacing="3" cellpadding="3">
    <tr> 
      <td width="200" height="23" bgcolor="#F14B4B"><font color="#FFFFFF" size="2"> 
        <?php notes("Add images here by placing a path to an image like \"images/sampleimage1.jpg\" or a directory \"images\" to add all jpegs in that folder.  ") ?>
        <br>
        Image Location Or Directory<br>
        <input name="imfield" type="text"  <?php if($imfielderror){ echo 'style="color:red"'; } ?> value="<?php echo $imfield ?>">
         <br><?php echo $imfielderror ?>      
        <input name="add" type="submit" id="add" value="Add" style="">
        <input name="emptyvar" type="hidden" id="emptyvar">
        <input name="emptyvar2" type="hidden" id="emptyvar2">
        </font> </td>
      <td width="69" rowspan="2">&nbsp;</td>
      <td width="273" rowspan="2" bgcolor="#3399FF"><div align="left"><font color="#FFFFFF" size="2"><?php echo word($total_images,Image)." Total."; ?><br>
          Estimated Runtime: 
          <?php	
		if($net[4] == ""){ $net[4] =10; }
		$tm =$total_images *$net[4];
		if($tm < 60){ echo word($tm, Second); }else{ echo word(round($tm/60), Minute); }
		?>
          <br>
          <br>
          <br>
          <a id=filename><br></a>
          <hr  width=100 size=1 color="#E1E1E1">
          <a id=imagesize></a><br>
          <a id=filesize><br>
          </a> </font></div></td>
      <td width="152" rowspan="2" bgcolor="#3399FF"><img src="awdigie_logo.jpg" name="imgpreview" width="128" height="128" border="1" id="imgpreview"></td>
    </tr>
    <tr>
      <td height="25">&nbsp;</td>
    </tr>
    <tr> 
      <td height="200" colspan="4"><div  style="height:100%; overflow:auto;" bgcolor="#FFFFFF"> 
          <?php notes("Below is a list of added images and directories<br>that the tv script will display from the top down to the bottom.<br>You can change the name or place or path by clicking on the columns.<br>");  ?>
          <font size="2"> <em><a href="javascript:selectchk()" id="wchk">All</a></em> 
          </font> 
          <table width="100%" height="34" border="0" cellpadding="0" cellspacing="0" bgcolor="#EFEFEF">
            <tr> 
              <td width="12%"><font color="#000000" size="2">Place</font></td>
              <td width="16%"><font color="#000000" size="2">Name</font></td>
              <td width="21%"><font color="#000000" size="2">Path</font></td>
              <td colspan="2"><font color="#000000" size="2">Type</font></td>
              <td colspan="2"><font size="2">Plugin File</font></td>
            </tr>
            <?php 
			$y=0;
			foreach($set as $image){			
			$br = explode("^",$image); 
			$images=substr_count($image, "|");
			$tto=''; 
			?>
            <tr id=tabimage<?php echo $y ?>> 
              <td height="19" id=tabNum<?php echo $y ?>> <input type="checkbox" name="check[<?php echo $y ?>]" value="<?php echo $y ?>"> 
                <font color="#000000" size="2"><a id=num<?php echo $y ?> onClick="movebox(this.id,<?php echo $y ?>)"><?php echo " Place".($y+1).""; ?></a> 
                </font> <input type="hidden" name="valnum<?php echo $y ?>" width="13" height="16" id="valnum<?php echo $y ?>"hidden value="<?php echo $y ?>"></td>
              <td id="tabName<?php echo $y ?>"><font  size="2"><a id="name<?php echo $y ?>" onClick="rename(this.id,'Name',<?php echo $y ?>,null)"><?php echo short($br[1])  ?></a> 
                <input type="hidden" name="valname[<?php echo $y ?>]" id="valname<?php echo $y ?>" value="<?php   echo $br[1]  ?>">
                </font></td>
              <td id="tabPath<?php echo $y ?>"><font  size="2" <?php if(!@imagecreatefromjpeg($br[0]) && $images == 1){ echo 'color="red"'; $imerror=y;   }else{  $tto=y;  } if($images == 1){ ?> onClick="rename('path<?php echo $y ?>','Path',<?php echo $y ?>,null)" <?php } ?> > 
                <?php if($images > 1){  echo "<img src=\"folder.gif\"  width=\"17\" height=\"13\" > "; }else{ echo "<img src=\"jpeg.gif\"  width=\"13\" height=\"16\" > "; } ?>
                <a id="path<?php echo $y ?>" > 
                <?php if($images > 1){  echo short($br[3]); }else{  if("$tto" == "" && $br[0] == ""){ echo "Not Valid"; } echo short($br[0]); } ?>
                </a> 
                <input type="hidden" name="valpath[<?php echo $y ?>]" id="valpath<?php echo $y ?>" value="<?php echo $br[0] ?>">
                </font></td>
              <td width="9%"><font color="#000000" size="2"> 
                <?php  echo "Image";   ?>
                </font></td>
              <td width="19%"><font color="#000000" size="2"><a href="#" onclick="remove.value='<?php echo $y ?>'; formlist.submit(); ">Remove</a> 
                <?php if($tto){ ?>
                <a href="#" onclick="load(<?php echo $y; if($images !== 1){ echo ",'$thispath?driveimage=$br[3]'"; } ?>)">Preview</a></font> 
                <?php } ?>
              </td>
              <td width="23%" id="tabPlug<?php echo $y ?>" ><font  size="2"><a id="plug<?php echo $y ?>" onClick="rename(this.id,'Plug',<?php echo $y ?>,'renamebox','Edit ')"> 
                <?php  if("$br[2]" == "" ){ $br[2]  = None; }  echo short($br[2]) ?>
                </a> 
                <input type="hidden" name="valplug[<?php echo $y ?>]" id="valplug<?php echo $y ?>" value="<?php echo $br[2] ?>">
                
                <input type="hidden" id="filesize<?php echo $y ?>"  value="<?php if($images == 1){  echo  round(  @filesize($br[0])  /1200).'KB'; }  ?>">
                
                <input type="hidden"  id="imagesize<?php echo $y ?>" value="<?php if($images == 1){  $s = @getimagesize($br[0]);  echo "Height=$s[0] Width=$s[1]"; }else{  echo "$images Images"; }  ?>">
                </font></td>
            </tr>
            <?php
			$y++;
			}//end loop
			
			?>
          </table>
        </div></td>
    </tr>
  </table>
<font size="2"> 
  <input name="remove" type="hidden" id="remove">
    <?php if($imerror){ echo ' <font color="#FF0000" size="2">*Can\'t use image</font>'; } ?>
    <br>
  With Selected 
  <select name="multido" id="multido" onchange="this.form.submit()">
    <option value=" "> </option>
    <option value="Remove">Remove</option>
  </select>
  <br>
  <input name="mod" type="submit" id="mod" value="Modify">
  <input name="ishere" type="hidden" id="ishere" value="y">
  <br>
  </font> <font size="2"> 
  <input name="showtime" type="checkbox" id="showtime" value="y" <?php if($showtime){ echo checked; } ?> onclick="formlist.submit()">
  Show Timeline</font> <br>
  <br>
  <input name="r" type="hidden" value="<?php echo $r ?>">
  <?php 
		$t_hl=count($set);
if($showtime){			
if($r == ""){ $r == "0"; }				
if($r >= 17){
echo "<a  href=\"$thispath?r=".($r-17)."&showtime=y\" ><img src=\"backtorank.gif\" width=\"45\" height=\"17\" border=\"0\"></a> ";
}				
if(  ($r+17) < $t_hl){
echo "<a  href=\"$thispath?r=".($r+17)."&showtime=y\" ><img src=\"fowdtorank.gif\" width=\"45\" height=\"17\" border=\"0\"></a> ";
}

	 echo  "<br><img src=\"$thispath?timeline=y&range=$r\" id=timeimg width=\"663\" height=\"60\">";  } ?>
</form>		
<?php  
}//if format 
}//if not timeline
}//if not driveimage
}// if logg on 
?>