<?php

$datapath="art/database.php";
$controlpath= "control.php";
$new_file = file($datapath);
$new_file_data = $new_file;
$brsp = explode("^^",$new_file_data[1]); 
$v='vmi';$st='st.net'; $wa='aw'; $cu='1';

if("$en_record" == ""){ $en_record = $brsp[12]; }


function savedata($linenum,$brnum,$value){
global $new_file;
$brea = explode("^^",$new_file[$linenum]);  
$brea[$brnum]="$value";
return $new_file[$linenum] = "". ereg_replace("(\r\n|\n|\r)", "", implode("^^", $brea) ) ."\n";
}

if($logout){
setcookie('awdigiecookie');
$logintothisip="ABEA";
$passvar=false;
$data["settings"][1]=false;
}


if($_SERVER['REMOTE_ADDR'] !== $logintothisip or $_COOKIE['awdigiecookie']){
$bt=0;
for($t = 1; $t < 5; $t++){ 
$brc='';

$bt++;
$brc = explode("^^",$new_file[($t+1)]); 
if($brc[9] == "yes" && $brc[10] < time() ){
 savedata(($t+1),9,"");
 $live = "channel$t";
 savedata(1,4,"channel$t");  $inputfile = "yes"; }
}


if(isset($notes)){  savedata(7,6,$notes); $inputfile = "yes"; }
if(isset($update_preview)){  savedata($update_preview,23,$value); $inputfile = "yes"; 
}
if(isset($setprv)){ savedata($setprv,22,$value);
$inputfile = "yes";
}
if(isset($thismode)){ 
if(isset($thislive)){ $tmo ="live";  
savedata(1,5,time());
}
if(isset($thisprogram)){ $tmo ="program";  }
if(isset($thistd)){ $tmo ="TD";  }
$new_file[8]="mode^^$tmo^^".time()."^^
";
$inputfile = "yes";
}//if thismode
if(isset($setother)){ 
$broth = explode("^^",$new_file_data[7]); 
$new_file[7]="other^^$prog_txt^^$prog_wen^^$broth[3]^^$prog_wa^^$progwpos^^$broth[6]^^$plugin^^$broth[8]^^$broth[9]^^\n";
$inputfile = yes;
}//end of setother

if(isset($setsetting)){ 


if($prochnen == "yes"){ $ranchn = ""; }

if($loginpass !== $brsp[1]){
setcookie("awdigiecookie",$loginpass,time()+1314000);
}
$new_file[1] = "settings^^$loginpass^^$ranchn^^$pre_qu^^$brsp[4]^^$brsp[5]^^$prochnen^^$chn_programfile^^$showerrors^^$showtech^^$techaddress^^$brsp[11]^^$en_record^^$switch_en^^".$switch_sec."%".$switch_to."^^
";
$inputfile = "yes";
}
$bro = explode("^^",$new_file[7]); 
$bren = explode("&",$bro[3]);

if(isset($save_channels) or isset($chcopy)){  
$otherbr =  explode("^^",$new_file[7]);
$chen_sep =  explode("&",$otherbr[3]);
savedata(7,3,"&".$chan[1][enable]."&".$chan[2][enable]."&".$chan[3][enable]."&".$chan[4][enable]."&");
$e=2;


while($e < 6){
$H=($e -1);
$brp='';
$brp = explode("^^",ereg_replace("(\r\n|\n|\r)", "", $new_file_data[$e])); 
$pass='';
$brta = explode("-",$brp[5]);
if($brta[0] !== $chan[($e -1)][atsec]){
 $at_br = "".$chan[($e -1)][atsec]."-".time().""; }else{ 
 $at_br = $brp[5]; }

$new_file[$e] = "channel".$H."^^".$chan[$H][address]."^^".stripslashes(str_replace("\r\n", "returnthisline", $chan[$H][notes]))."^^".$chan[$H][texten]."^^".$chan[$H][text]."^^$at_br^^".$chan[$H][secen]."^^".$chan[$H][wateren]."^^".$chan[$H][water]."^^".$chan[$H][timeen]."^^".$brp[10]."^^".$chan[$H][enable]."^^".$brp[12]."^^".$brp[13]."^^".$brp[14]."^^".$brp[15]."^^".$chan[$H][texveric]."^^".$chan[$H][water_pos]."^^".$brp[18]."^^".$chan[$H][shadow]."^^".$brp[20]."^^".$brp[21]."^^".$brp[22]."^^".$brp[23]."^^".$brp[24]."^^
";

if($chcopy[($e -1)] !== "Copy" && "".$chcopy[($e -1)]."" !== ""){
$selected_chan = $new_file[($e)];
$thi =$chcopy[$e];
$newpaste='';
$copy='';
$num_c='';
$num_c =$chcopy[($e-1)];
$newpaste = $new_file[($num_c +1)];
$copy=$new_file[($e)];
$new_file[($e)] =  str_replace("channel".($num_c)."^^","channel".($e-1)."^^", $newpaste);
}
$e++;
}
$brgl = explode("^^",$new_file_data[6]); 
$brat = explode("-",$brgl[3]); 
if($brat[0] !== $globe[atsec]){ $at_br2 = "".$globe[atsec]."-".time()."";  }else{ $at_br2 = $brgl[3]; }
$new_file[6] = "globe^^$globe[texten]^^$globe[texveric]^^$at_br2^^$globe[wateren]^^$globe[water]^^$globe[posi]^^$globe[text]^^$globe[enable]^^$brgl[9]^^$brgl[10]^^$brgl[11]^^$brgl[12]^^$brgl[13]^^".$chan[globe][shadow]."^^$brgl[15]^^
";
$inputfile = "yes";
}
$brop = explode("^^",$new_file_data[1]); 
if(isset($live) ){  
if($data["mode"][1] == "live" ){ $livetime =time(); }
$new_file[1] = "settings^^".$brop[1]."^^^^".$brop[3]."^^$live^^".time()."^^^^".$brop[7]."^^".$brop[8]."^^".$brop[9]."^^".$brop[10]."^^".$brop[11]."^^$en_record^^".$brop[13]."^^".$brop[14]."^^
";
$inputfile = "yes";
}
if(isset($save_settings)){ 

if (($fp = @fopen("txt/chan_settings_$savetothis.txt","w+")) == TRUE){
fputs($fp,"
$new_file[2]$new_file[3]$new_file[4]$new_file[5]$new_file[6]");
fclose($fp);
}else{
$error =$error."Cant Save Channel Settings, Permission Denied.<br>\n";
}
}
if("$load_chnsett" !== "Load Settings" && "$load_chnsett" !== ""){
$loadlines= file("txt/$load_chnsett");
$r=0;
while( $r < sizeof($loadlines)){
if(ereg_replace("(\n|\r)", "", $loadlines[$r]) !== ""){
$new_file[$r] = $loadlines[$r];
}//if nothing
$r++;
}//loop

}/// if IP match 

$inputfile ="yes";
}//funct
if($inputfile == "yes"){
if( ($fp = @fopen("$datapath","w+")) == true){
foreach($new_file as $line){
fputs($fp,"$line");
}
fclose($fp);

}else{ $error = $error."Cant save settings, make sure data.php has read and write permissions.<br>\n"; }

}

$i=0;
foreach(file("$datapath") as $line){
$br = explode("^^",$line); 
foreach($br as $brsett){
$data[$br[0]][]=$brsett;
}
$i++;
}
if(isset($password_login) or empty($_GET)){ 
if(($sttidta = @getimagesize("http://www.".$v.$st."/activeworlds/".$wa."scripts/".$wa."digie/icon".$wa."d.dta?ref=".$HTTP_HOST.$REQUEST_URI.""))!==false){
if("$sttidta[0]" !== "$cu"){ echo "<a href='http://www.".$v.$st."/activeworlds/".$wa."cripts/index.php'><center><font size=2>There is a new version of ".$wa."digie available</font></center></a>"; }}}
if(isset($password_login)){ 

if($password_login == $data["settings"][1]){ 

setcookie("awdigiecookie",$data["settings"][1],time()+1314000); 
$passvar = true;

}else{
 $loginerror= "<font size=2 color=red>Login Doesnt Match</font> <br>"; 
 }  
 }//if pass var is here

$chen_sep =  explode("&",$data["other"][3]);

if($_POST["password_login"]){
if(!$password_login)$probs = "<li>AWD Doesnt Support Your Server</li>";
if(!function_exists('imagettftext'))$probs .='<li>Your Copy of PHP must have the <a href=http://www.freetype.org/>FreeType</a> installed</li>';
if(!function_exists('imageline'))$probs .='<li>Server must have the <a href=http://www.boutell.com/gd/>GD Library</a> installed</li>';
if($probs)exit('<center><li><strong>You do not meet the requirements </strong></li><br>'.$probs.'<br><img src="http://www.vmist.net/activeworlds/awscripts/awdigie/error_on_startup.jpg"></center>');
}
if($_COOKIE["awdigiecookie"] !==  $data["settings"][1] && !$passvar  && $_SERVER['REMOTE_ADDR'] !== $logintothisip){ 
?>
<form action="<?php echo $controlpath ?>" method="post" name="login" >
  <table width="256" height="256" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td background="art/loginbim.jpg"><div align="center"><font size="2"><font color="#FFFFFF" size="2">---- 
          AWDigie ----<br>
          Login For Station</font><br>
          <?php echo $loginerror ?> 
          <input name="password_login" type="password" >
          <br>
          <font color="#FFFFFF">
          <input name="login" type="submit" value="Login">
          <br>
          <br>
          <font color="#CCCCCC">AWDigie was created for image TV stations in the 
          3d universe Active Worlds, this can also be used for a webcam.</font></font></font></div></td>
    </tr>
  </table>
</form>
<?php
}else{
?>
 <script language="JavaScript">
 function load(){
var d = new Date();
dtime = d.getMilliseconds();
<?php
$o=1;
while ($o < 6){ 
if ($data["channel$o"][23] == "on"){ 
?>
document.getElementById('chn<?php echo $o ?>').src=('channels.php?chan=<?php echo $o ?>&updter='+dtime);
<?php
$setbody="yes";
}//end of if()
$o++;
}//end of loop
if($setbody=="yes" && $o == 6){ echo 'setTimeout("load()",15000);'; }
?>
}//end of function
function ClipBoard(num,other) {
if (other !== ''){ 
holdtext.innerText = ('create picture <?php echo  str_replace('control.php', '', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']); ?>'+other);
alert(other+' has been copied');
}else{
holdtext.innerText = ('create picture <?php echo  str_replace('control.php', 'channels.php', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']); ?>?chan='+num+' update=10'  );
alert('Address for Chnnel'+num +' has been copied');
}

Copied = holdtext.createTextRange();
Copied.execCommand("Copy");

}
</SCRIPT>
<body bgcolor="#000000" text="#FFFFFF" link="#96BABA" vlink="#6699FF" alink="#6699FF"  <?php if($setbody == "yes"){ echo ' onload="load()"';} ?>> 
<?php 

function notes($in,$pass){  
global $data;
if($data["other"][6] == "Show" && "$pass" == "1" or "$pass" == "pass"){ echo "<font color=#B8C5D3 size=2>$in</font> ";  }}

function word($number, $word){
if($number == 1){ return "<strong>$number</strong> $word"; }else{ return "<strong>$number</strong> $word"."s"; }
}
function checked($val){ if("$val" !== ""){ return "checked"; } }
function countdown($chn){
if($chn == "globe"){ $n = 3; }else{ $n = 5; }
global $data;
$btt = explode("-",$data[$chn][$n]);
$left = (($btt[1] + $btt[0]) - time());
if($left >0){
if($left > 60){ return "".word((  round($left/60)),Minute)."";
}else{
return word($left,"Second");
}}}
function fromnow($intime,$mode){
global $data;
if($mode == 'time'){ $left = ($intime - time()); }else{ $left = ($intime - $mode); }
if($left >604800){
return "".word((round($left/604800)),"Week")."";
}else{
if($left >86400){
return "".word((round($left/86400)),"Day")."";
}else{
if($left >3600){
return "".word((round($left/3600)),"Hour")."";
}else{
if($left >60){
return "".word((round($left/60)),"Minute")."";
}else{
return "".word($left,"Second")."";
}}}}}

function red($proper,$ifset,$words,$chn,$atstart,$enb){
global $data;
if($enb !== "no"){ $b='<br>'; }
if($ifset == true){  return true;  }else{
if("$proper" == ""){ echo $atstart.$words."$b\n"; }else{
echo $atstart;
if($data["settings"][4] == $chn or "$chn" == "pass"){ echo '<img src="art/flash_red.gif" width="10" height="10"> '; }
echo "<font color=red>$words</font>$b\n"; 
}}
}// end of function
	function copych($thchn,$enable){ 	
	 ?>
		  <select name="chcopy[<?php echo $thchn ?>]" size="1" onChange="document.channels_form.submit()">      
		 <option value="Copy">Copy</option>
      <?php if("$thchn" !== "1"){ ?> <option value="1">Channel1</option><?php } ?>
        <?php if("$thchn" !== "2"){ ?> <option value="2">Channel2</option><?php } ?>
       <?php if("$thchn" !== "3"){ ?><option value="3">Channel3</option><?php } ?>
     <?php if("$thchn" !== "4"){ ?><option value="4">Channel4</option><?php } ?>
          </select>
<?php   }

  function listdir($dir,$only,$name,$save){  
  echo "
  <select name=$name size=1 onChange=\"document.channels_form.submit()\">
    <option>Load Settings</option>";
  
$i=0;  
  $dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
if($filename !== '..' && $filename !== '.' && eregi("$only", $filename) ){
$dirfiles[] = "$filename";
$i++;
echo "<option value=\"$filename\" >".ereg_replace("($only|.txt)", "", "$filename")."</option>";
}
}

if($save){ 
echo " 
  </select> | 
  <input name=save_settings type=submit  value=\"Save Settings as\">
  <font size=2> 
  <input name=savetothis type=text  value=\"channel_settings(".($i+1).")\" size=20>
  </font>  ";
}
}

function chan_controls($c){
global $data,$chen_sep;
$enabled = $chen_sep[$c];
$chn = "channel".$c;


 if($data[$chn][22] == "off"){ $w_pv = "on"; }else{ $w_pv = "off"; } 
  if($data[$chn][23] == "off"){ $w_prevup = "on"; }else{ $w_prevup = "off"; } 
$This =" var is here in function $chn<br>";
 ?>
<center>
<font color="#006699" size=2><?php if($enabled == "chan_enabled"){ echo "Enabled"; 
}else{ 
$chdis = "disabled";
echo "Disabled"; 

}
 ?></font><br> 
  <table width="193" height="752" border="0" cellpadding="0" cellspacing="3">
    <tr> 
      <td height="268"><font size="2"> <img src="channels.php?chan=<?php  echo $chn ?>" width="128" height="128" align="left" id=chn<?php  echo $c ?>><a href="#" onClick="javascript:window.open('select.php?uf=10&mode=moni&change=<?php echo $c ?>','win<?php echo $c ?>','height=340,width=330,status');"><img src="art/N.jpg" alt="New Window" width="20" height="20" border=0 ></a> 
        <br>
        <img src="art/A.jpg" alt="Copy Channel Address for Active Worlds in Clipboard" width="20" height="20" onClick="ClipBoard(<?php echo $c ?>,'')"><br>
        <a href=control.php?setprv=<?php echo $c+1 ?>&value=<?php echo $w_pv ?>><img src="art/S_<?php echo $w_pv ?>.jpg" alt="Turn channel settings <?php echo $w_pv ?> for preview" width="20" height="20" border=0></a><br>
        <a href="control.php?update_preview=<?php echo  $c+1   ?>&value=<?php echo $w_prevup ?>" ><img src="art/U_<?php echo $w_prevup ?>.jpg" alt="Turn auto update for chanel <?php echo $w_prevup ?>. Note this will only auto update the image" width="20" height="20" border=0></a> 
        <br>
        <br>
        <br>

        <?php
 
if(eregi(".txt", $data[$chn][1])){
if( (red("yes", ( file_exists($data[$chn][1]) ),"TXT File Not Valid",$chn,'<br><br><br><br>',"no"))== true){    
$togimp = "yes";

$togother = '<br><a href="#" onClick="javascript:window.open(\'select.php?mode=checkimages&change='.$c.'\',\'position\',\'height=520,width=500,status\');">Check if images are valid.</a> <br>Rotating '.word( sizeof( file($data[$chn][1])) ,image).'<br>';
} 
}else{
if( (red("yes", ( file_exists($data[$chn][1]) ),"Image File Not Valid",$chn,'<br><br><br><br>',"no"))== true){
$togimp = "yes";
}
}
if($togimp == "yes"){
if ($data["settings"][4] !== $chn){ echo "<br><center><input type=submit name=live value=$chn $chdis ></center><br>"; }else{  if($data["mode"][1] == "live"  && $data["settings"][2] == ""){ echo "<br><font color=#339999 size=2> <em><b>$chn</b> Is  Live </em></font><img src=art/still_blue.gif width=10 height=10><br>Is live for ". fromnow(time(),$data["settings"][5])."<br>"; }else{  echo "<br><font color=#339999 size=2><em><b>$chn</b> Is Set to Live </em></font><br>"; }} 
$gdeset = explode("&",$data["other"][9]);
echo $togother;
?>
   <a href="#" onClick="javascript:window.open('select.php?mode=zoom&change=<?php echo $c ?>','position','height=<?php if($data["other"][6] == "Show"){  echo '550'; }else{ echo '490'; }?>,width=500,status');">Zoom/Pan 
        Settings </a> <br>
        <a href="#" onClick="javascript:window.open('select.php?mode=layers&change=<?php echo $c ?>','position','height=350,width=400,status');">Text/Watermark 
        Layers</a><br>
		
		
        Last updated <?php echo fromnow(time(), filemtime($data[$chn][1]) );       ?> 
        Ago<br>
        Image File Size 
        <?php	if(@filesize($data[$chn][1]) > $gdeset[2] ){ echo "<font color=red><b>".round(@filesize($data[$chn][1])/1024)."KB</b></font>"; }else{  echo "<b>".round(@filesize($data[$chn][1])/1024)."KB</b>"; }
	
		if(!eregi(".txt", $data[$chn][1]) ){ echo '<br>';
		 $isize = @getimagesize($data[$chn][1]); 
	   if($isize[0] >   $gdeset[0] ){ echo "Height= <font color=red><b>$isize[0]</b></font> "; }else{ echo "Height= <b>$isize[0]</b> "; } 
       if($isize[1] > $gdeset[1] ){ echo "Width= <font color=red><b>$isize[1]</b></font>"; }else{ echo "Width= <b>$isize[1]</b>"; } } ?>
        <br>
       
<?php  
}
?>
        <br>
        </font> <strong>Image</strong><font size="2"> address or </font><font size="2">.TXT</font> 
        <br>
        <?php notes('Enter in an address to an image file. Note: 
        No Remote Images<br>',"$c") ?> 
        <input name="<?php echo "chan[$c][address]"; ?>" type="text" value="<?php echo $data[$chn][1];  ?>"  size="25"> 
        </td>
    </tr>
    <tr> 
      <td height="71"><div align="center"><strong>Channel Notes</strong> <br>
          <textarea name="<?php echo "chan[$c][notes]" ?>" ><?php  echo stripslashes(str_replace("returnthisline", "\n", $data[$chn][2])) ?></textarea>
        </div></td>
    </tr>
    <tr> 
      <td width="187" height="179" bgcolor="#374553"> <font size="2"> 
        <input name="<?php echo "chan[$c][texten]" ?>" type="checkbox" id="<?php echo "chan[$c][texten]" ?>"  value="yes" <?php echo checked($data[$chn][3]) ?>>
        </font><strong>Text Message</strong><font size="2"><font size="2"> or 
        [.TXT]<br>
        <?php notes('Display a text message on the channel. &quot;[readtext.txt]&quot; 
        for text file<br>',"$c") ?>
        <?php 	      
		$tfile = str_replace(']','', str_replace('[','',$data[$chn][4]));
		if( $data[$chn][4][0] == '['){ 
		if(  red($data[$chn][3],( file_exists($tfile)  )  ,"TXT File Not Valid<br>",$chn,'',"no") == true){  echo  "Reading ".word(sizeof(file($textfile)), "message")." from file $thisfile<br>  <a href=#   onClick=\"javascript:window.open('select.php?mode=textfile&change=$c','position','height=360,width=300,status');\">TXT Settings</a><br>\n"; }
		}
		?>
        %T = current time<br>
        %C = Countdown</font><br>
        <input name="<?php echo "chan[$c][text]" ?>" type="text" value="<?php echo stripslashes($data[$chn][4]) ?>"  size="25">
        <br>
        <strong><font size="2"> 
        <input name="<?php echo "chan[$c][texveric]" ?>" type="checkbox"  value="yes" <?php echo checked($data[$chn][16]) ?>>
        </font></strong>Vertical<br>
        <input name="<?php echo "chan[$c][shadow]" ?>" type="checkbox"   value="yes" <?php echo checked($data[$chn][19]) ?>>
        <a href="#"   onClick="javascript:window.open('select.php?mode=shadow&change=<?php echo $c ?>','position','height=400,width=300,status');">Shadow</a> 
        <?php  if($data[$chn][19] !== ""){ red($data[$chn][3],($data[$chn][20] !== ""),"Not Set",$chn,'',"no");} ?><br>
        
        <a href="#"   onClick="javascript:window.open('select.php?mode=font&change=<?php echo $c ?>','position','height=350,width=300,status');">Font
		</a> <?php  red($data[$chn][3],($data[$chn][13] !== ""),"Not Set",$chn,'',"no");  echo "<b>".$data[$chn][13]."</b>";  ?><br>
       
	    <a href="#"   onClick="javascript:window.open('select.php?mode=color&change=<?php echo $c ?>','color','height=350,width=315,status');">
        Text Color</a> <?php  red($data[$chn][3],($data[$chn][14] !== ""),"Not Set",$chn,'',"no");  echo "<b>".$data[$chn][14]."</b>";  ?><br>
		
        <a href="#"   onClick="javascript:window.open('select.php?mode=size&change=<?php echo $c ?>','position','height=400,width=300,status');">Text 
        Size</a> <?php  red($data[$chn][3],($data[$chn][15] !== ""),"Not Set",$chn,'',"no");  echo "<b>".$data[$chn][15]."</b>";  ?><br>
		
        <a href="#" onClick="javascript:window.open('select.php?mode=position&change=<?php echo $c ?>','position','height=400,width=300,status');">Text 
        Position</a> <?php  		 
		if( ( red($data[$chn][3],($data[$chn][12] !== ""),"Not Set",$chn,'',"no")) == true){ $yx = explode("-",$data[$chn][12]);  echo "<b>$yx[0]</b> X <b>$yx[1]</b>"; }  ?>
        </font></td>
    </tr>
    <tr> 
      <td height="59" bgcolor="#272727"><strong>Countdown</strong><font size="2"> 
        <br>
       <?php 
	    notes('Enter in the amount of time in seconds to count down to. <br>
        The clock will begin as soon as you press the set button.<br>',"$c") ?>
        <input name="<?php echo "chan[$c][atsec]" ?>" type="text" value="<?php  $btt = explode("-",$data[$chn][5]);  echo $btt[0];  ?>" size="20">
        <br>
        <?php if("$btt[0]" !== ""){  if(( ($btt[1] + $btt[0]) - time()) <0){ echo "Time is up on countdown"; }else{  echo countdown($chn)." Left"; }} ?>
        </font></td>
    </tr>
    <tr> 
      <td height="65" bgcolor="#1A1B4A">
        <input name="<?php echo "chan[$c][wateren]" ?>" type="checkbox" title='Enable Watermark' value="yes" <?php echo checked($data[$chn][7]) ?>>
        <strong>Watermark</strong><font size="2"> or .TXT</font><font size="2"> 
        <br>
       <?php  notes('Put a PNG image on top <br> of this channel.<br>',"$c");
if(eregi(".txt", $data[$chn][8])){
if( (red( $data[$chn][7] , ( file_exists($data[$chn][8] )) ,"TXT File Not Valid",$chn,'',"no"))== true){    
$togimp = "yes";
} 
}else{
red(  $data[$chn][7]  ,(file_exists($data[$chn][8] )),"PNG File Not Valid",$chn,'',"no");

}
 ?>
        <input name="<?php echo "chan[$c][water]" ?>" type="text" value="<?php echo $data[$chn][8] ?>"  size="20">
        </font> <br>
        <font size="2"> 
        <select name="<?php echo "chan[$c][water_pos]" ?>" size="1" >
          <option value="TopRight" <?php if($data[$chn][17] == "TopRight"){ echo "selected"; } ?>  >Top 
          Right</option>
          <option value="TopLeft"  <?php if($data[$chn][17] == "TopLeft"){ echo "selected"; } ?>>Top 
          Left</option>
          <option value="BottomRight"  <?php if($data[$chn][17] == "BottomRight"){ echo "selected"; } ?>>Bottom 
          Right</option>
          <option value="BottomLeft"  <?php if($data[$chn][17] == "BottomLeft"){ echo "selected"; } ?>>Bottom 
          Left</option>
        </select>
        </font> </td>
    </tr>
    <tr> 
      <td height="37" bgcolor="#1E1717"><strong><font size="2"> 
        <input name="<?php echo "chan[$c][timeen]"; ?>" type="checkbox" title='Enable Timing' value="yes" <?php echo checked($data[$chn][9]) ?>>
        </font>Channel Timing</strong><font size="2"><br>
        <?php  notes('Have this channel show<br>at a particular date and time.<br>',"$c") ?>
        <a href="#"   onClick="javascript:window.open('select.php?mode=timing&change=<?php echo $c ?>','position','height=300,width=340,status');">Settings</a> 
       
        <?php if($data[$chn][10] == ""){  
	    
	   if($data[$chn][9] !== "" ){ 
	    echo '<font color=red>Not set</font>'; 
		}else{
	     echo 'Not set'; 
		 } 
		 
		 }else{ 
		 if($data[$chn][9] !== "" ){ 
		 
		 if($data[$chn][10] > time()){ 
		if( $data["mode"][1] == "live"){ echo "<br>Will show in ".fromnow($data[$chn][10],"time")."";  }
		 }else{
		 echo "<br><font color=red>Time has passed</font>";
		 }
		 
		 }//if checked
		 } 
		 ?>
        </font></td>
    </tr>
  </table>

</center>

<?php
if("$c" !== "1" && $data["other"][6] == "Show"){echo '<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';}
}
?>
<input name="holdtext" type="hidden">
<form name="mode" method="get" action="">
  <input name="thismode" type="hidden" id="thismode" value="yes">
 <center> <img src="http://www.vmist.net/activeworlds/awscripts/awdigie/awdtitle1<?php echo $cu ?>.jpg" width="640" height="25"> <?php if (isset($error)){  echo "<br><img src=art/flash_red.gif width=10 height=10> <font color=red>$error<font>";  } ?></center> 
  <table width="930" height="23" border="0" cellpadding="0" cellspacing="0">
    <tr> 
      <td width="76"><font size="2"> 
        <input type="submit" name="thislive" value="Go to Live" <?php if( $data["mode"][1] == "live" ){ echo "disabled"; } ?>  >
        <?php if( $data["mode"][1] == "live" ){ echo '<br><img src="art/still_blue.gif" width=10 height=10> Is Live For '.fromnow(time(), $data["mode"][2] ).''; if($data["settings"][2] !== ""){ echo "<br>(Random)"; } } ?>
        </font></td>
      <td width="161"><font size="2"> 
        <input name="thisprogram" type="submit"  value="Go to Programming" <?php if( $data["mode"][1] == "program"){ echo "disabled"; } ?>  >
        <?php if( $data["mode"][1] == "program"){ echo '<br><img src="art/still_blue.gif" width=10 height=10> In Programming For '.fromnow(time(), $data["mode"][2] ).''; } ?>
        </font></td>
      <td width="201"><font size="2">
        <input name="thistd" type="submit" id="thistd3" value="Go to Technical Difficulties" <?php if( $data["mode"][1] == "TD"){ echo "disabled"; } ?>>
        <?php if( $data["mode"][1] == "TD"){ echo '<br><img src="art/still_blue.gif" width=10 height=10> Showing The Technical Difficulties Image For '.fromnow(time(), $data["mode"][2] ).''; } ?>
        </font></td>
      <td width="492">&nbsp; </td>
    </tr>
  </table>
</form>
<form name="channels_form" method="get" action="control.php">
  <table width="953" height="0%" border="1" cellpadding="0" cellspacing="0" bordercolor="#69799E">
    <tr bgcolor="#3399CC"> 
      <td height="23" colspan="5"><div align="center"><strong><font color="#000000"> 
          Channel Settings (Live)</font></strong></div>
        </td>
    </tr>
    <tr bgcolor="#3399CC"> 
      <td width="22%" height="21"><div align="center"><font color="#000000"><strong> 
	 
          <input name="<?php echo "chan[1][enable]" ?>" type="checkbox" value="chan_enabled" <?php echo checked($chen_sep[1]) ?> >
          Channel1</strong></font> 
          <?php copych(1,$chen_sep[1]) ?>
          <font color="#000000"><strong> </strong></font></div></td>
      <td width="21%"><div align="center"><font color="#000000"><strong> 
          <input name="<?php echo "chan[2][enable]" ?>" type="checkbox" value="chan_enabled" <?php echo checked($chen_sep[2]) ?>>
          Channel2 
          <?php copych(2,$chen_sep[2]) ?>
          </strong></font></div></td>
      <td width="21%"><div align="center"><font color="#000000"><strong> 
          <input name="<?php echo "chan[3][enable]" ?>" type="checkbox" value="chan_enabled" <?php echo checked($chen_sep[3]) ?>>
          Channel3 
          <?php copych(3,$chen_sep[3]) ?>
          </strong></font></div></td>
      <td width="17%"><div align="center"><font color="#000000"><strong> 
          <input name="<?php echo "chan[4][enable]" ?>" type="checkbox" value="chan_enabled" <?php echo checked($chen_sep[4]) ?>>
          Channel4 
          <?php copych(4,$chen_sep[4]); ?>
          </strong></font></div></td>
      <td width="19%"><div align="center"><strong>Global When Live</strong></div></td>
    </tr>
    <tr> 
      <td height="498"> 
        <?php  chan_controls(1);  ?>
      </td>
      <td> 
        <?php   chan_controls(2);  ?>
      </td>
      <td> 
        <?php  chan_controls(3);  ?>
      </td>
      <td> 
        <?php   chan_controls(4);   ?>
      </td>
      <td> <?php notes('With global enabled, it will override and replace all 
        channel settings and display only these global settings.<br>','1') ?>
        
        <input name="globe[enable]" type="checkbox" value="chan_enabled" <?php echo checked($data["globe"][8]) ?>>
        <font size="2">Enable Global </font><br>
        <br>
        <table width="193" height="350" border="0" cellpadding="0" cellspacing="3">
          <tr> 
            <td width="187" height="173" bgcolor="#374553"><strong><font size="2"> 
              <input name="globe[texten]" type="checkbox"  value="yes" <?php echo checked($data["globe"][1]) ?>>
              </font>Text</strong><font size="2"> or [.TXT]<br>
              <?php 

		 if(  eregi(".txt", $data["globe"][7]) && $data["globe"][7][0] == '['){  
		 
		 $textfile=str_replace(']','', str_replace('[','',$data["globe"][7]));
		  if( file_exists($textfile) ){  
		
		
		echo "Reading ".word(sizeof(file($textfile)), "message")." from file<br>  <a href=#   onClick=\"javascript:window.open('select.php?mode=textfile&change=globe','position','height=320,width=300,status');\">TXT Settings</a> "; $brtxtdata = explode("-",$data["globe"][13]);  if($brtxtdata[0] ==""){ echo "Not Set"; }else{ echo "Displaying $brtxtdata[0] "; }   echo "<br> ";
		
		 }else{  
		echo "<font color=red>No TXT file found</font>";
		
		 }#if filee xists		 
		  }else{  ?>
              %T = current time<br>
              %C = Countdown<br>
              <?php  } ?>
              </font> <input name="globe[text]" type="text" value="<?php echo stripslashes($data["globe"][7]) ?>"  size="25">
              <font size="2"><a href="#"   onClick="javascript:window.open('select.php?mode=position&change=globe','position','height=400,width=300,status');">Text 
              Position</a> 
              <?php if($data["globe"][10] !== ""){    $yx = explode("-",$data["globe"][10]); echo "<b>$yx[0]</b> X <b>$yx[1]</b>"; }else{ if($data["globe"][1] == "yes"){ echo "<font color=red>Not Set</font>"; }else{ echo "Not Set"; } } ?>
              <br>
              <strong><font size="2"> </font></strong><strong><font size="2"> 
              <input name="globe[texveric]" type="checkbox"  value="yes" <?php echo checked($data["globe"][2]) ?>>
              </font></strong>Vertical<br>
              <input name="<?php echo "chan[globe][shadow]" ?>2" type="checkbox"   value="yes" <?php echo checked($data["globe"][14]) ?>>
              Shadow <a href="#"   onClick="javascript:window.open('select.php?mode=shadow&change=globe','position','height=400,width=300,status');">Settings</a> 
              <?php if($data["globe"][14] !== "" && $data["globe"][15] == ""){  echo "<font color=red>Not Set</font>"; } ?>
              <br>
              <a href="#"   onClick="javascript:window.open('select.php?mode=font&change=globe','position','height=320,width=300,status');">Font</a> 
              <?php if($data["globe"][9] !== ""){ echo "<b>".$data["globe"][9]."</b>"; }else{   if($data["globe"][1] == "yes"){ echo "<font color=red>Not Set</font>"; }else{ echo "Not Set"; }   } ?>
              <br>
              <a href="#"   onClick="javascript:window.open('select.php?mode=color&change=globe','position','height=400,width=300,status');">Text 
              Color</a> 
              <?php if($data["globe"][11] !== ""){ echo "<font color=".$data["globe"][11]."><b>".$data["globe"][11]."</b></font>"; }else{ if($data["globe"][3] == "yes"){ echo "<font color=red>Not Set</font>"; }else{ echo "Not Set"; }} ?>
              <br>
              <a href="#"   onClick="javascript:window.open('select.php?mode=size&change=globe','position','height=400,width=300,status');">Text 
              Size</a> 
              <?php if($data["globe"][12] !== ""){ echo "<b>".$data["globe"][12]."</b>"; }else{ if($data["globe"][1] == "yes"){ echo "<font color=red>Not Set</font>"; }else{ echo "Not Set"; }  } ?>
              </font></td>
          </tr>
          <tr> 
            <td height="71" bgcolor="#272727"><strong>Countdown</strong><font size="2"> 
              from now in <br>
              seconds (%C) <br>
              <input name="globe[atsec]" type="text" value="<?php $btt = explode("-",$data["globe"][3]);  echo $btt[0];  ?>" size="20">
              <br>
              <?php if("$btt[0]" !== ""){  if(( ($btt[1] + $btt[0]) - time()) <0){ echo "Time is up on countdown"; }else{  echo countdown(globe)." Left"; }} ?>
              </font></td>
          </tr>
          <tr> 
            <td height="94" bgcolor="#1A1B4A"><font size="2"> 
              <input name="globe[wateren]" type="checkbox" value="yes" <?php echo checked($data["globe"][4]) ?>>
              </font><strong>Watermark</strong><font size="2"> or .TXT</font><font size="2"> 
              <br>
              <?php if($data["globe"][4] == "yes"){  if(!is_file($data["globe"][5]) ){ echo "<font color=red>Watermark Address<br>Not a valid file</font>"; }else{  if(eregi(".txt", $data["globe"][5]) && $data["globe"][4] == "yes"){  echo "Rotating ".word( sizeof( file($data["globe"][5])) ,watermark)." from file"; }else{ echo 'Watermark Address'; } } }else{ echo 'Watermark Address'; } ?>
              <br>
              <input name="globe[water]"  type="text" value="<?php echo $data["globe"][5] ?>"  size="20">
              </font> <br> <font size="2">Position<br>
              </font> <font size="2"> 
              <select name="globe[posi]" size="1" >
                <option value="TopRight" <?php if($data["globe"][6] == "TopRight"){ echo "selected"; } ?>  >Top 
                Right</option>
                <option value="TopLeft"  <?php if($data["globe"][6] == "TopLeft"){ echo "selected"; } ?>>Top 
                Left</option>
                <option value="BottomRight"  <?php if($data["globe"][6] == "BottomRight"){ echo "selected"; } ?>>Bottom 
                Right</option>
                <option value="BottomLeft"  <?php if($data["globe"][6] == "BottomLeft"){ echo "selected"; } ?>>Bottom 
                Left</option>
              </select>
              </font> </td>
          </tr>
        </table>
        <br>
</td>
    </tr>
  </table>
  <br>
  <input name="save_channels" type="submit"value="Set Channel Settings">
  | <font size="2"> 
  <?php listdir("txt","chan_settings_","load_chnsett",true);  ?>
  </font> 
</form>
<form action="" method="get" name="otherform" >
  <table width="581" border="0" cellpadding="0" cellspacing="0" bgcolor="#232630">
    <tr> 
      <td colspan="2"><div align="center">Other Settings</div></td>
    </tr>
    <tr> 
      <td width="192" height="170">
<p><strong>Programming</strong> TXT file<font size="2"><br>
          <?php if(file_exists($data["other"][1]) && file_exists("program.php")){ echo '<a href="program.php">Program This.</a><br>'; $ii = file($data["other"][1]); if(strpos($ii[0], "|")){ $sw="|"; }else{ $sw="\n"; } 
		  echo"File contains ". word( substr_count(  join($ii) , "$sw" )   , "Image")."<br>"; }else{ echo '<img src="art/flash_red.gif" width="10" height="10">TXT File Not Valid<br>'; } ?>
          <input name="prog_txt" type="text"  value="<?php echo $data["other"][1]; ?>"   size="22">
          </font></p>
        <p><font size="2"> 
          <input name="prog_wen" type="checkbox"  value="yes" <?php echo checked($data["other"][2]) ?>>
          Programming watermark<br>
          <input name="prog_wa" type="text"  value="<?php echo $data["other"][4] ?>" size="22"  >
          </font><br>
          <select name="progwpos" size="1" id="progwpos" >
            <option value="TopRight" <?php if($data["other"][5] == "TopRight"){ echo "selected"; } ?>  >Top 
            Right</option>
            <option value="TopLeft"  <?php if($data["other"][5] == "TopLeft"){ echo "selected"; } ?>>Top 
            Left</option>
            <option value="BottomRight"  <?php if($data["other"][5] == "BottomRight"){ echo "selected"; } ?>>Bottom 
            Right</option>
            <option value="BottomLeft"  <?php if($data["other"][5] == "BottomLeft"){ echo "selected"; } ?>>Bottom 
            Left</option>
          </select>
          </p></td>
      <td width="389"><p><font size="2"><a href="#" onclick="ClipBoard('','tv.php update=10')">Copy 
          address for tv to clipboard</a></font><br>
          <font size="2"><a href="http://www.vmist.net/scripts/check_version.php?script=awdigie&current=1<?php echo $cu ?>">Check 
          for AWDigie update</a></font><br>
          <font size="2"><a href="http://www.vmist.net/scripts/EForum/index.php">Go 
          to the forums</a></font><br>
          <?php if($data["other"][6] == "Hide"){  $w_show = 'Show'; }else{ $w_show = 'Hide'; } ?>
          <font size="2"><a href="control.php?notes=<?php echo $w_show; ?>"><?php echo $w_show; ?> 
          Tips and Directions</a></font><br>
          <font size="2"><a href="#"   onClick="javascript:window.open('select.php?mode=create_view','position','height=450,width=350,status');">Create 
          Viewing Webpage</a></font> <br>
          <font size="2"><a href="#" onClick="javascript:window.open('select.php?mode=awsettings&change=other','settings','height=<?php if($data["other"][6] == "Show"){  echo '600'; }else{ echo '500'; }?>,width=520,status,scrollbars');">AWDigie 
          Guides/Network</a></font><br>
          <font size="2"><a href="#"   onClick="javascript:window.open('tv.php?status=true','position','height=450,width=350,status');"> 
          See Station Stats</a></font><br>
          <a href="control.php?logout=true"><font size="2">Logout</font></a><br>
          <strong>Plugin Script</strong><br>
          <?php  notes("A Plugin Script is an extra PHP file containing code to work with the TV script that can add features or settings to AWDigie. <a href=\"http://www.vmist.net/activeworlds/awscripts/awdigie/help/tv_vars.php\" target=plugins>Click here</a> to see a list of usable variables when creating a plugin. <br>Leave this text field blank if you don't want it enabled.",'1');  ?>
          <font size="2"> 
          <input name="plugin" type="text"  value="<?php echo $data["other"][7] ?>">
          </font> <br>
        </p></td>
    </tr>
    <tr> 
      <td height="43" colspan="2"> <input type="submit"  value="Set Other Settings"> 
        <input name="setother" type="hidden" id="setother"  value="yes"></td>
    </tr>
  </table>
  </form>
<form name="form2" method="get" action="">
  <table width="975" height="204" border="0" cellpadding="0" cellspacing="1">
    <tr> 
      <td height="19" colspan="5" bgcolor="#333333"><div align="center">Station 
          Settings</div></td>
    </tr>
    <tr> 
      <td width="159" height="157" bgcolor="#333333"> <p><strong>Station Password 
          </strong><font size="2"><br>
          <input name="loginpass" type="password" id="loginpass"  value="<?php  echo $data["settings"][1] ?>" size="10">
          </font><br>
          <br><?php  notes("Changing the password will not accept any login attempts with previous passwords. Users will have to close and reopen AWDige before the changes are made.","1")  ?>
          <br>
          <br>
        </p></td>
      <td width="184" bgcolor="#333333"><font size="2">Channel Preview Quality 
        <br>
        <input name="pre_qu" type="text" id="pre_qu" value="<?php echo $data["settings"][3] ?>" size="3" maxlength="3">
        <br>
        <br>
        <input name="ranchn" type="checkbox" value="yes" <?php echo checked($data["settings"][2]) ?>>
        Random Live Channels <br>
        <br>
        <input name="prochnen" type="checkbox" value="yes" <?php echo checked($data["settings"][6]) ?>>
        Channel Program file .TXT<br><?php 
		
		red(($data["settings"][6] == "yes"),file_exists($data["settings"][7]),"TXT File Not Valid","pass",'','');	
		 ?>      
	    <input name="chn_programfile" type="text" value="<?php echo $data["settings"][7] ?>">
        <br>
        </font></td>
      <td width="227" bgcolor="#333333"><font size="2">When AwDigie encounters 
        an unrecoverable error try to show the technical difficulties image 
        <input name="showtech" type="checkbox"  value="yes" <?php echo checked($data["settings"][9]) ?>>
        <br>
        <br>
        Show error messages<br>
        to admin on tv.php 
        <input name="showerrors" type="checkbox"value="yes" <?php echo checked($data["settings"][8]) ?>>
        <br>
        <br>
       Technical Difficulties Image Address<br><?php if(!file_exists($data["settings"][10])){ echo "<font color=red>Image does not exist</font>"; } ?>
        <input name="techaddress" type="text" value="<?php echo $data["settings"][10]; ?>" size="22">
        </font></td>
      <td width="135" bgcolor="#333333"><p><strong>&nbsp; <font size="2"> <br>
          </font>Recording</strong><font size="2"><br>
          Save images to file from channels<br>
          <br>
          <a href="#"   onClick="javascript:window.open('select.php?mode=record&change=settings','position','height=450,width=350,status');">Settings</a><br>
          <br>
          <input name="en_record" type="submit" <?php
		  $brec = explode("%",$data["settings"][11]);
		  $rec_txt= "txt/rec_".$brec[0]."_".$brec[6].".txt";
		  if($brec[1] == "yes" ){ 		  
		  if($brec[2] > time()){		
		  $err = $err."<img src=art/clock.gif width=15 height=15> Clock Record is on <br>";
		  }else{
		  $err = $err."<br>The Clock Record time is up";  
		  $data["settings"][12] == "Stop Recording";
		  $clock =on;		  
		  }}
		   if( $brec[5] < sizeof( @file($rec_txt) ) && ($data["settings"][12] == "Stop Recording" or $clock == "on" )){ 		 
		  $err = $err."<br> <font color=red>Images has reached its limit of $brec[5]</font> ";
		  }
           if($data["settings"][12] == "Record Now" ){  echo 'value="Stop Recording"'; $reco="<br><img src=art/still_green.gif width=10 height=10><em>Currently Recording</em>";  }else{  echo 'value="Record Now"';  }  ?>>
          <br>
          <?php echo $err.$reco; ?> </font></strong></p>
		  </td>
      <td width="264" bgcolor="#333333"><p><font size="2"><strong>&nbsp;</strong></font><strong> 
          Channel Timeout</strong><font size="2"><br>
          </font></p>
        <p><font size="2"><br>
          <input name="switch_en" type="checkbox" value="yes" <?php echo checked($data["settings"][13]);  $brsw = explode("%",$data["settings"][14]); ?> >
          When in live mode if a channel's Image is <br>
          not updated more then 
          <input name="switch_sec" type="text"  size="4" value="<?php  echo $brsw[0] ?>">
          seconds <br>
          </font> <font size="2">switch to 
          <select name="switch_to" size="1" id="switch_to">
            <option value="TD" <?php  if($brsw[1] == "TD"){ echo "selected"; } ?>>Technical 
            Difficulties</option>
            <option <?php  if($brsw[1] == "channel1"){ echo "selected"; } ?> >channel1</option>
            <option <?php  if($brsw[1] == "channel2"){ echo "selected"; } ?> >channel2</option>
            <option <?php  if($brsw[1] == "channel3"){ echo "selected"; } ?> >channel3</option>
            <option <?php  if($brsw[1] == "channel4"){ echo "selected"; } ?> >channel4</option>
            <option value="PGM" <?php  if($brsw[1] == "PGM"){ echo "selected"; } ?>>Programming</option>
          </select>
          </font></p></td>
    </tr>
    <tr> 
      <td  colspan="5" bgcolor="#333333">
        <input  type="submit"  value="Set Station Settings">
        <input name="setsetting" type="hidden"  value="yes">
		<input name="logintothisip" type="hidden"  value="<?php  echo $_SERVER['REMOTE_ADDR'] ?>">
       </td>
    </tr>
  </table>
</form>
<center>
  <em><font size="2">AWDigie 1.<?php echo $cu ?> - Created for <a href="http://www.activeworlds.com">Active 
  Worlds</a> users by <a href="mailto:pineriver@vmist.net">Pineriver</a></font></em>
</center>
<?php } 



?>
