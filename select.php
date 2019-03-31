<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE);
extract($_REQUEST);

$datapath = "art/database.php";
$new_file = file($datapath);

$i = 0;
foreach (file("$datapath") as $line) {
  $br = explode("^^", $line);
  foreach ($br as $brsett) {
    $data[$br[0]][] = $brsett;
  }
  $i++;
}
if ($_COOKIE["awdigiecookie"] == $data["settings"][1]) {
  $chn = "channel" . $change;
  if ($change == "globe") {
    list($dbthisshow, $dbtexten, $dbtexveric, $dbatsec, $dbwateren, $dbwater, $dbposi, $dbtext, $dbenable, $dbfont, $dbtextpos, $dbcolor, $dbtextsize,,, $dbtxtsetting) = $data["globe"];
  } else {
    list($dbthisshow, $dbaddess, $dbnotes, $dbtexten, $dbtext, $dbatsec, $dbsecen, $dbwateren, $dbwater, $dbtimeen, $dbttmmee, $dbenable, $dbtextpos, $dbfont, $dbcolor, $dbtextsize, $dbtexveric, $dbposi, $dbtxtsetting, $dbshadown, $dbshset, $dbzoom, $chnpwset, $dbprev, $dbfunction) = $data[$chn];
  }

  $dbimad = $dbaddess;
  if (preg_match("/\\.txt/i", $dbaddess)) {
    if (($trxrt = @file("$dbaddess")) == true) {
      $dbaddess = preg_replace("[\r\n]", "", $trxrt[0]);
    } else {

      $dbaddess = "awdigie_logo.jpg";
    }
  }

  function title($in)
  {
    echo "<title>$in</title>\n<center><font color=\"#0066CC\" size=\"2\"><strong>$in</strong></font></center>";
  }

  function notes($in)
  {
    global $data;
    if ($data["other"][6] == "Show") {
      echo "<font  size=2>$in</font> ";
    }
  }

  function savedata($brnum, $value)
  {
    global $new_file, $change;
    if ($change == "globe") {
      $lnu = 6;
    } else {
      $lnu = ($change + 1);
    }
    if ($change == "other") {
      $lnu = 7;
    }
    $brea = explode("^^", $new_file[$lnu]);
    $brea[$brnum] = "$value";
    return $new_file[$lnu] = implode("^^", $brea);
  }

  function sameas()
  {
    global $change;
    if ("$change" !== "globe") {
      ?>
<meta>
<table width="119" height="20" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="4">
            <font size="2">As same as channel</font>
        </td>
    </tr>
    <tr>
        <?php if ("$change" !== "1") { ?> <td width="29" bgcolor="#F5F5F5">
            <font size="2"><strong>1 <br> <input type="radio" name="sameas" value="channel1" onclick="document.form.submit()"></strong></font>
        </td> <?php 
            } ?>
        <?php if ("$change" !== "2") { ?> <td width="28">
            <font size="2"><strong> 2 <br><input type="radio" name="sameas" value="channel2" onclick="document.form.submit()"> </strong></font>
        </td> <?php 
            } ?>
        <?php if ("$change" !== "3") { ?> <td width="27" bgcolor="#F5F5F5">
            <font size="2"><strong>3 <br> <input type="radio" name="sameas" value="channel3" onclick="document.form.submit()"> </strong></font>
        </td> <?php 
            } ?>
        <?php if ("$change" !== "4") { ?> <td width="35">
            <font size="2"><strong>4 <br> <input type="radio" name="sameas" value="channel4" onclick="document.form.submit()"> </strong></font>
        </td> <?php 
            } ?>
    </tr>
</table>
<?php 
}
}

if ($mode == "position") {
  if ("$pos_sub" == "") {

    title("Position Text");
    ?>
<form action="" method="get" name="form">
    <div align="center">
        <font size="2">Click on the image to select where<br>
            the top left corner of the text should go.</font><br>
        <input type="image" src="<?php if ($change == globe) {
                                    echo "awdigie_logo.jpg";
                                  } else {
                                    echo   $dbaddess;
                                  } ?>" name="d">
        <input name="change" type="hidden" value="<?php echo $change ?>">
        <input name="pos_sub" type="hidden" value="yes">
        <input name="mode" type="hidden" value="<?php echo $mode ?>">
        <br>
        <?php sameas() ?>
    </div>
</form>
<?php

} else {

  if ("$sameas" == "") {
    $vals = "" . $d_x . "-" . $d_y . "";
  } else {
    $vals = $data[$sameas][12];
  }

  if ($change == "globe") {
    $rb = 10;
  } else {
    $rb = 12;
  }
  savedata($rb, $vals);
  $inputfile = "yes";
}
}
if ($mode == "font") {
  if ($font_sub == "") {

    title("Text Font");
    ?>

<form name="form" method="post" action="">
    <center>
        <font size="2">Select a font to use for Text <br><?php notes("<br></center>TTF Type fonts are used, they are stored in the folder \"fonts\". 3 sample fonts are included in awdigie.<br> <br><center>") ?>
            <select name="font" size="5" id="font" onChange="document.form.font_img.src=('font_preview.php?font=' +  this.options[this.selectedIndex].value )">
                <?php

                $dh = opendir("fonts");
                while (false !== ($filename = readdir($dh))) {
                  if ($filename !== '..' && $filename !== '.' &&  preg_match("/ttf/i", $filename)) {
                    echo "<option value=\"$filename\" ";
                    if ($dbfont == $filename) {
                      echo "selected";
                    }
                    echo ">$filename</option>\n";
                  }
                }
                ?>
            </select>
            <br>
            <img src="http://profile.vmist.net/font_preview.php?font=<?php echo $dbfont ?>" name="font_img">
            <br>
            <input type="submit" value="Select Font">
            <input name="change" type="hidden" value="<?php echo $change ?>">
            <input name="font_sub" type="hidden" value="yes">
            <input name="mode2" type="hidden" value="<?php echo $mode ?>">
            <br>
            <br>
            <?php sameas() ?>
        </font>
    </center>
</form>

<?php

} else {

  if ("$sameas" !== "") {
    $font = $data[$sameas][13];
  }
  if ($change == "globe") {
    $rb = 9;
  } else {
    $rb = 13;
  }
  savedata($rb, $font);
  $inputfile = "yes";
}
} //if font
if ($mode == "color") {
  if ($font_sub == "") {
    title("Text Color");
    $var = "select.php?mode=color&font_sub=yes&change=$change&color=";
    echo "
	  
	  <form name=form method=post action=\"\">
	  <input name=font_sub type=hidden value=yes>
	  <input name=mode type=hidden value=color>
	  <input name=change type=hidden value=$change>
	   
	  <center><font size=2>Select a color to use for text</font><br><img src=\"art/color_map.gif\" width=292 height=196 border=0 usemap=\"#Map1\">
    <map name=Map1>
    <AREA  COORDS=\"2,2,18,18\"       HREF=\"" . $var . "330000\" >
    <AREA  COORDS=\"18,2,34,18\"      HREF=\"" . $var . "333300\" >
    <AREA  COORDS=\"34,2,50,18\"      HREF=\"" . $var . "336600\" >
    <AREA  COORDS=\"50,2,66,18\"      HREF=\"" . $var . "339900\" >
    <AREA  COORDS=\"66,2,82,18\"      HREF=\"" . $var . "33CC00\" >
    <AREA  COORDS=\"82,2,98,18\"      HREF=\"" . $var . "33FF00\" >
    <AREA  COORDS=\"98,2,114,18\"     HREF=\"" . $var . "66FF00\" >
    <AREA  COORDS=\"114,2,130,18\"    HREF=\"" . $var . "66CC00\" >
    <AREA  COORDS=\"130,2,146,18\"    HREF=\"" . $var . "669900\" >
    <AREA  COORDS=\"146,2,162,18\"    HREF=\"" . $var . "666600\" >
    <AREA  COORDS=\"162,2,178,18\"    HREF=\"" . $var . "663300\" >
    <AREA  COORDS=\"178,2,194,18\"    HREF=\"" . $var . "660000\" >
    <AREA  COORDS=\"194,2,210,18\"    HREF=\"" . $var . "FF0000\" >
    <AREA  COORDS=\"210,2,226,18\"    HREF=\"" . $var . "FF3300\" >
    <AREA  COORDS=\"226,2,242,18\"    HREF=\"" . $var . "FF6600\" >
    <AREA  COORDS=\"242,2,258,18\"    HREF=\"" . $var . "FF9900\" >
    <AREA  COORDS=\"258,2,274,18\"    HREF=\"" . $var . "FFCC00\" >
    <AREA  COORDS=\"274,2,290,18\"    HREF=\"" . $var . "FFFF00\" >

    <AREA  COORDS=\"2,18,18,34\"      HREF=\"" . $var . "330033\" >
    <AREA  COORDS=\"18,18,34,34\"     HREF=\"" . $var . "333333\" >
    <AREA  COORDS=\"34,18,50,34\"     HREF=\"" . $var . "336633\" >
    <AREA  COORDS=\"50,18,66,34\"     HREF=\"" . $var . "339933\" >
    <AREA  COORDS=\"66,18,82,34\"     HREF=\"" . $var . "33CC33\" >
    <AREA  COORDS=\"82,18,98,34\"     HREF=\"" . $var . "33FF33\" >
    <AREA  COORDS=\"98,18,114,34\"    HREF=\"" . $var . "66FF33\" >
    <AREA  COORDS=\"114,18,130,34\"   HREF=\"" . $var . "66CC33\" >
    <AREA  COORDS=\"130,18,146,34\"   HREF=\"" . $var . "669933\" >
    <AREA  COORDS=\"146,18,162,34\"   HREF=\"" . $var . "666633\" >
    <AREA  COORDS=\"162,18,178,34\"   HREF=\"" . $var . "663333\" >
    <AREA  COORDS=\"178,18,194,34\"   HREF=\"" . $var . "660033\" >
    <AREA  COORDS=\"194,18,210,34\"   HREF=\"" . $var . "FF0033\" >
    <AREA  COORDS=\"210,18,226,34\"   HREF=\"" . $var . "FF3333\" >
    <AREA  COORDS=\"226,18,242,34\"   HREF=\"" . $var . "FF6633\" >
    <AREA  COORDS=\"242,18,258,34\"   HREF=\"" . $var . "FF9933\" >
    <AREA  COORDS=\"258,18,274,34\"   HREF=\"" . $var . "FFCC33\" >
    <AREA  COORDS=\"274,18,290,34\"   HREF=\"" . $var . "FFFF33\" >

    <AREA  COORDS=\"2,34,18,50\"      HREF=\"" . $var . "330066\" >
    <AREA  COORDS=\"18,34,34,50\"     HREF=\"" . $var . "333366\" >
    <AREA  COORDS=\"34,34,50,50\"     HREF=\"" . $var . "336666\" >
    <AREA  COORDS=\"50,34,66,50\"     HREF=\"" . $var . "339966\" >
    <AREA  COORDS=\"66,34,82,50\"     HREF=\"" . $var . "33CC66\" >
    <AREA  COORDS=\"82,34,98,50\"     HREF=\"" . $var . "33FF66\" >
    <AREA  COORDS=\"98,34,114,50\"    HREF=\"" . $var . "66FF66\" >
    <AREA  COORDS=\"114,34,130,50\"   HREF=\"" . $var . "66CC66\" >
    <AREA  COORDS=\"130,34,146,50\"   HREF=\"" . $var . "669966\" >
    <AREA  COORDS=\"146,34,162,50\"   HREF=\"" . $var . "666666\" >
    <AREA  COORDS=\"162,34,178,50\"   HREF=\"" . $var . "663366\" >
    <AREA  COORDS=\"178,34,194,50\"   HREF=\"" . $var . "660066\" >
    <AREA  COORDS=\"194,34,210,50\"   HREF=\"" . $var . "FF0066\" >
    <AREA  COORDS=\"210,34,226,50\"   HREF=\"" . $var . "FF3366\" >
    <AREA  COORDS=\"226,34,242,50\"   HREF=\"" . $var . "FF6666\" >
    <AREA  COORDS=\"242,34,258,50\"   HREF=\"" . $var . "FF9966\" >
    <AREA  COORDS=\"258,34,274,50\"   HREF=\"" . $var . "FFCC66\" >
    <AREA  COORDS=\"274,34,290,50\"   HREF=\"" . $var . "FFFF66\" >

    <AREA  COORDS=\"2,50,18,66\"      HREF=\"" . $var . "330099\" >
    <AREA  COORDS=\"18,50,34,66\"     HREF=\"" . $var . "333399\" >
    <AREA  COORDS=\"34,50,50,66\"     HREF=\"" . $var . "336699\" >
    <AREA  COORDS=\"50,50,66,66\"     HREF=\"" . $var . "339999\" >
    <AREA  COORDS=\"66,50,82,66\"     HREF=\"" . $var . "33CC99\" >
    <AREA  COORDS=\"82,50,98,66\"     HREF=\"" . $var . "33FF99\" >
    <AREA  COORDS=\"98,50,114,66\"    HREF=\"" . $var . "66FF99\" >
    <AREA  COORDS=\"114,50,130,66\"   HREF=\"" . $var . "66CC99\" >
    <AREA  COORDS=\"130,50,146,66\"   HREF=\"" . $var . "669999\" >
    <AREA  COORDS=\"146,50,162,66\"   HREF=\"" . $var . "666699\" >
    <AREA  COORDS=\"162,50,178,66\"   HREF=\"" . $var . "663399\" >
    <AREA  COORDS=\"178,50,194,66\"   HREF=\"" . $var . "660099\" >
    <AREA  COORDS=\"194,50,210,66\"   HREF=\"" . $var . "FF0099\" >
    <AREA  COORDS=\"210,50,226,66\"   HREF=\"" . $var . "FF3399\" >
    <AREA  COORDS=\"226,50,242,66\"   HREF=\"" . $var . "FF6699\" >
    <AREA  COORDS=\"242,50,258,66\"   HREF=\"" . $var . "FF9999\" >
    <AREA  COORDS=\"258,50,274,66\"   HREF=\"" . $var . "FFCC99\" >
    <AREA  COORDS=\"274,50,290,66\"   HREF=\"" . $var . "FFFF99\" >

    <AREA  COORDS=\"2,66,18,82\"      HREF=\"" . $var . "3300CC\" >
    <AREA  COORDS=\"18,66,34,82\"     HREF=\"" . $var . "3333CC\" >
    <AREA  COORDS=\"34,66,50,82\"     HREF=\"" . $var . "3366CC\" >
    <AREA  COORDS=\"50,66,66,82\"     HREF=\"" . $var . "3399CC\" >
    <AREA  COORDS=\"66,66,82,82\"     HREF=\"" . $var . "33CCCC\" >
    <AREA  COORDS=\"82,66,98,82\"     HREF=\"" . $var . "33FFCC\" >
    <AREA  COORDS=\"98,66,114,82\"    HREF=\"" . $var . "66FFCC\" >
    <AREA  COORDS=\"114,66,130,82\"   HREF=\"" . $var . "66CCCC\" >
    <AREA  COORDS=\"130,66,146,82\"   HREF=\"" . $var . "6699CC\" >
    <AREA  COORDS=\"146,66,162,82\"   HREF=\"" . $var . "6666CC\" >
    <AREA  COORDS=\"162,66,178,82\"   HREF=\"" . $var . "6633CC\" >
    <AREA  COORDS=\"178,66,194,82\"   HREF=\"" . $var . "6600CC\" >
    <AREA  COORDS=\"194,66,210,82\"   HREF=\"" . $var . "FF00CC\" >
    <AREA  COORDS=\"210,66,226,82\"   HREF=\"" . $var . "FF33CC\" >
    <AREA  COORDS=\"226,66,242,82\"   HREF=\"" . $var . "FF66CC\" >
    <AREA  COORDS=\"242,66,258,82\"   HREF=\"" . $var . "FF99CC\" >
    <AREA  COORDS=\"258,66,274,82\"   HREF=\"" . $var . "FFCCCC\" >
    <AREA  COORDS=\"274,66,290,82\"   HREF=\"" . $var . "FFFFCC\" >

    <AREA  COORDS=\"2,82,18,98\"      HREF=\"" . $var . "3300FF\" >
    <AREA  COORDS=\"18,82,34,98\"     HREF=\"" . $var . "3333FF\" >
    <AREA  COORDS=\"34,82,50,98\"     HREF=\"" . $var . "3366FF\" >
    <AREA  COORDS=\"50,82,66,98\"     HREF=\"" . $var . "3399FF\" >
    <AREA  COORDS=\"66,82,82,98\"     HREF=\"" . $var . "33CCFF\" >
    <AREA  COORDS=\"82,82,98,98\"     HREF=\"" . $var . "33FFFF\" >
    <AREA  COORDS=\"98,82,114,98\"    HREF=\"" . $var . "66FFFF\" >
    <AREA  COORDS=\"114,82,130,98\"   HREF=\"" . $var . "66CCFF\" >
    <AREA  COORDS=\"130,82,146,98\"   HREF=\"" . $var . "6699FF\" >
    <AREA  COORDS=\"146,82,162,98\"   HREF=\"" . $var . "6666FF\" >
    <AREA  COORDS=\"162,82,178,98\"   HREF=\"" . $var . "6633FF\" >
    <AREA  COORDS=\"178,82,194,98\"   HREF=\"" . $var . "6600FF\" >
    <AREA  COORDS=\"194,82,210,98\"   HREF=\"" . $var . "FF00FF\" >
    <AREA  COORDS=\"210,82,226,98\"   HREF=\"" . $var . "FF33FF\" >
    <AREA  COORDS=\"226,82,242,98\"   HREF=\"" . $var . "FF66FF\" >
    <AREA  COORDS=\"242,82,258,98\"   HREF=\"" . $var . "FF99FF\" >
    <AREA  COORDS=\"258,82,274,98\"   HREF=\"" . $var . "FFCCFF\" >
    <AREA  COORDS=\"274,82,290,98\"   HREF=\"" . $var . "FFFFFF\" >

    <AREA  COORDS=\"2,98,18,114\"     HREF=\"" . $var . "0000FF\" >
    <AREA  COORDS=\"18,98,34,114\"    HREF=\"" . $var . "0033FF\" >
    <AREA  COORDS=\"34,98,50,114\"    HREF=\"" . $var . "0066FF\" >
    <AREA  COORDS=\"50,98,66,114\"    HREF=\"" . $var . "0099FF\" >
    <AREA  COORDS=\"66,98,82,114\"    HREF=\"" . $var . "00CCFF\" >
    <AREA  COORDS=\"82,98,98,114\"    HREF=\"" . $var . "00FFFF\" >
    <AREA  COORDS=\"98,98,114,114\"   HREF=\"" . $var . "99FFFF\" >
    <AREA  COORDS=\"114,98,130,114\"  HREF=\"" . $var . "99CCFF\" >
    <AREA  COORDS=\"130,98,146,114\"  HREF=\"" . $var . "9999FF\" >
    <AREA  COORDS=\"146,98,162,114\"  HREF=\"" . $var . "9966FF\" >
    <AREA  COORDS=\"162,98,178,114\"  HREF=\"" . $var . "9933FF\" >
    <AREA  COORDS=\"178,98,194,114\"  HREF=\"" . $var . "9900FF\" >
    <AREA  COORDS=\"194,98,210,114\"  HREF=\"" . $var . "CC00FF\" >
    <AREA  COORDS=\"210,98,226,114\"  HREF=\"" . $var . "CC33FF\" >
    <AREA  COORDS=\"226,98,242,114\"  HREF=\"" . $var . "CC66FF\" >
    <AREA  COORDS=\"242,98,258,114\"  HREF=\"" . $var . "CC99FF\" >
    <AREA  COORDS=\"258,98,274,114\"  HREF=\"" . $var . "CCCCFF\" >
    <AREA  COORDS=\"274,98,290,114\"  HREF=\"" . $var . "CCFFFF\" >

    <AREA  COORDS=\"2,114,18,130\"    HREF=\"" . $var . "0000CC\" >
    <AREA  COORDS=\"18,114,34,130\"   HREF=\"" . $var . "0033CC\" >
    <AREA  COORDS=\"34,114,50,130\"   HREF=\"" . $var . "0066CC\" >
    <AREA  COORDS=\"50,114,66,130\"   HREF=\"" . $var . "0099CC\" >
    <AREA  COORDS=\"66,114,82,130\"   HREF=\"" . $var . "00CCCC\" >
    <AREA  COORDS=\"82,114,98,130\"   HREF=\"" . $var . "00FFCC\" >
    <AREA  COORDS=\"98,114,114,130\"  HREF=\"" . $var . "99FFCC\" >
    <AREA  COORDS=\"114,114,130,130\" HREF=\"" . $var . "99CCCC\" >
    <AREA  COORDS=\"130,114,146,130\" HREF=\"" . $var . "9999CC\" >
    <AREA  COORDS=\"146,114,162,130\" HREF=\"" . $var . "9966CC\" >
    <AREA  COORDS=\"162,114,178,130\" HREF=\"" . $var . "9933CC\" >
    <AREA  COORDS=\"178,114,194,130\" HREF=\"" . $var . "9900CC\" >
    <AREA  COORDS=\"194,114,210,130\" HREF=\"" . $var . "CC00CC\" >
    <AREA  COORDS=\"210,114,226,130\" HREF=\"" . $var . "CC33CC\" >
    <AREA  COORDS=\"226,114,242,130\" HREF=\"" . $var . "CC66CC\" >
    <AREA  COORDS=\"242,114,258,130\" HREF=\"" . $var . "CC99CC\" >
    <AREA  COORDS=\"258,114,274,130\" HREF=\"" . $var . "CCCCCC\" >
    <AREA  COORDS=\"274,114,290,130\" HREF=\"" . $var . "CCFFCC\" >

    <AREA  COORDS=\"2,130,18,146\"    HREF=\"" . $var . "000099\" >
    <AREA  COORDS=\"18,130,34,146\"   HREF=\"" . $var . "003399\" >
    <AREA  COORDS=\"34,130,50,146\"   HREF=\"" . $var . "006699\" >
    <AREA  COORDS=\"50,130,66,146\"   HREF=\"" . $var . "009999\" >
    <AREA  COORDS=\"66,130,82,146\"   HREF=\"" . $var . "00CC99\" >
    <AREA  COORDS=\"82,130,98,146\"   HREF=\"" . $var . "00FF99\" >
    <AREA  COORDS=\"98,130,114,146\"  HREF=\"" . $var . "99FF99\" >
    <AREA  COORDS=\"114,130,130,146\" HREF=\"" . $var . "99CC99\" >
    <AREA  COORDS=\"130,130,146,146\" HREF=\"" . $var . "999999\" >
    <AREA  COORDS=\"146,130,162,146\" HREF=\"" . $var . "996699\" >
    <AREA  COORDS=\"162,130,178,146\" HREF=\"" . $var . "993399\" >
    <AREA  COORDS=\"178,130,194,146\" HREF=\"" . $var . "990099\" >
    <AREA  COORDS=\"194,130,210,146\" HREF=\"" . $var . "CC0099\" >
    <AREA  COORDS=\"210,130,226,146\" HREF=\"" . $var . "CC3399\" >
    <AREA  COORDS=\"226,130,242,146\" HREF=\"" . $var . "CC6699\" >
    <AREA  COORDS=\"242,130,258,146\" HREF=\"" . $var . "CC9999\" >
    <AREA  COORDS=\"258,130,274,146\" HREF=\"" . $var . "CCCC99\" >
    <AREA  COORDS=\"274,130,290,146\" HREF=\"" . $var . "CCFF99\" >

    <AREA  COORDS=\"2,146,18,162\"    HREF=\"" . $var . "000066\" >
    <AREA  COORDS=\"18,146,34,162\"   HREF=\"" . $var . "003366\" >
    <AREA  COORDS=\"34,146,50,162\"   HREF=\"" . $var . "006666\" >
    <AREA  COORDS=\"50,146,66,162\"   HREF=\"" . $var . "009966\" >
    <AREA  COORDS=\"66,146,82,162\"   HREF=\"" . $var . "00CC66\" >
    <AREA  COORDS=\"82,146,98,162\"   HREF=\"" . $var . "00FF66\" >
    <AREA  COORDS=\"98,146,114,162\"  HREF=\"" . $var . "99FF66\" >
    <AREA  COORDS=\"114,146,130,162\" HREF=\"" . $var . "99CC66\" >
    <AREA  COORDS=\"130,146,146,162\" HREF=\"" . $var . "999966\" >
    <AREA  COORDS=\"146,146,162,162\" HREF=\"" . $var . "996666\" >
    <AREA  COORDS=\"162,146,178,162\" HREF=\"" . $var . "993366\" >
    <AREA  COORDS=\"178,146,194,162\" HREF=\"" . $var . "990066\" >
    <AREA  COORDS=\"194,146,210,162\" HREF=\"" . $var . "CC0066\" >
    <AREA  COORDS=\"210,146,226,162\" HREF=\"" . $var . "CC3366\" >
    <AREA  COORDS=\"226,146,242,162\" HREF=\"" . $var . "CC6666\" >
    <AREA  COORDS=\"242,146,258,162\" HREF=\"" . $var . "CC9966\" >
    <AREA  COORDS=\"258,146,274,162\" HREF=\"" . $var . "CCCC66\" >
    <AREA  COORDS=\"274,146,290,162\" HREF=\"" . $var . "CCFF66\" >

    <AREA  COORDS=\"2,162,18,178\"    HREF=\"" . $var . "000033\" >
    <AREA  COORDS=\"18,162,34,178\"   HREF=\"" . $var . "003333\" >
    <AREA  COORDS=\"34,162,50,178\"   HREF=\"" . $var . "006633\" >
    <AREA  COORDS=\"50,162,66,178\"   HREF=\"" . $var . "009933\" >
    <AREA  COORDS=\"66,162,82,178\"   HREF=\"" . $var . "00CC33\" >
    <AREA  COORDS=\"82,162,98,178\"   HREF=\"" . $var . "00FF33\" >
    <AREA  COORDS=\"98,162,114,178\"  HREF=\"" . $var . "99FF33\" >
    <AREA  COORDS=\"114,162,130,178\" HREF=\"" . $var . "99CC33\" >
    <AREA  COORDS=\"130,162,146,178\" HREF=\"" . $var . "999933\" >
    <AREA  COORDS=\"146,162,162,178\" HREF=\"" . $var . "996633\" >
    <AREA  COORDS=\"162,162,178,178\" HREF=\"" . $var . "993333\" >
    <AREA  COORDS=\"178,162,194,178\" HREF=\"" . $var . "990033\" >
    <AREA  COORDS=\"194,162,210,178\" HREF=\"" . $var . "CC0033\" >
    <AREA  COORDS=\"210,162,226,178\" HREF=\"" . $var . "CC3333\" >
    <AREA  COORDS=\"226,162,242,178\" HREF=\"" . $var . "CC6633\" >
    <AREA  COORDS=\"242,162,258,178\" HREF=\"" . $var . "CC9933\" >
    <AREA  COORDS=\"258,162,274,178\" HREF=\"" . $var . "CCCC33\" >
    <AREA  COORDS=\"274,162,290,178\" HREF=\"" . $var . "CCFF33\" >

    <AREA  COORDS=\"2,178,18,194\"    HREF=\"" . $var . "000000\" >
    <AREA  COORDS=\"18,178,34,194\"   HREF=\"" . $var . "003300\" >
    <AREA  COORDS=\"34,178,50,194\"   HREF=\"" . $var . "006600\" >
    <AREA  COORDS=\"50,178,66,194\"   HREF=\"" . $var . "009900\" >
    <AREA  COORDS=\"66,178,82,194\"   HREF=\"" . $var . "00CC00\" >
    <AREA  COORDS=\"82,178,98,194\"   HREF=\"" . $var . "00FF00\" >
    <AREA  COORDS=\"98,178,114,194\"  HREF=\"" . $var . "99FF00\" >
    <AREA  COORDS=\"114,178,130,194\" HREF=\"" . $var . "99CC00\" >
    <AREA  COORDS=\"130,178,146,194\" HREF=\"" . $var . "999900\" >
    <AREA  COORDS=\"146,178,162,194\" HREF=\"" . $var . "996600\" >
    <AREA  COORDS=\"162,178,178,194\" HREF=\"" . $var . "993300\" >
    <AREA  COORDS=\"178,178,194,194\" HREF=\"" . $var . "990000\" >
    <AREA  COORDS=\"194,178,210,194\" HREF=\"" . $var . "CC0000\" >
    <AREA  COORDS=\"210,178,226,194\" HREF=\"" . $var . "CC3300\" >
    <AREA  COORDS=\"226,178,242,194\" HREF=\"" . $var . "CC6600\" >
    <AREA  COORDS=\"242,178,258,194\" HREF=\"" . $var . "CC9900\" >
    <AREA  COORDS=\"258,178,274,194\" HREF=\"" . $var . "CCCC00\" >
    <AREA  COORDS=\"274,178,290,194\" HREF=\"" . $var . "CCFF00\" >
    </map></center>";
    sameas();
    echo '</form>';
  } else {

    if ("$sameas" !== "") {
      $color = $data[$sameas][14];
    }

    if ($change == globe) {
      $rb = 11;
    } else {
      $rb = 14;
    }
    savedata($rb, $color);

    $inputfile = "yes";
  }
} //if color

if ($mode == "size") {
  if ($size_sub == "") {
    title("Text Size");
    ?>
<form action="" method="get" name="form">
    <div align="center">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <?php echo $size_sub ?>
        <p>
            <font size="2">Input a number that will be used for the text size.<br>
                20 is recommended. <br>
                <input name="textsize" type="text" size="3" maxlength="3" value="<?php echo $dbtextsize ?>">
                <input name="change" type="hidden" value="<?php echo $change ?>">
                <input name="size_sub" type="hidden" value="yes">
                <input name="mode" type="hidden" value="size">
                <br>
                <input type="submit" value="Select Size">
                <br>
                <?php sameas() ?>
            </font>
        </p>
    </div>
</form>
<?php

} else {

  if ("$sameas" !== "") {
    $textsize = $data[$sameas][15];
  }
  if ($change == globe) {
    $rb = 12;
  } else {
    $rb = 15;
  }
  savedata($rb, $textsize);

  $inputfile = "yes";
}
} //if mode is size

if ($mode == "timing") {
  if ($timing_sub == "") {

    function dateset($display, $time)
    {
      global $data;
      if ($time == "") {
        $time = time();
      }
      return date("$display", $time);
    }
    ?>
<?php title("Timing Settings") ?>
<table width="291" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="291" height="279">
            <form action="" method="post" name="form">
                <font size="2">At this time, show <?php echo $chn ?>.
                    <br>
                    Current time
                    <?php echo date("Y : m : H : i : s") ?>

                    <?php if ($dbttmmee < time()) {
                      echo "<br><font color=blue><br>The current time is set below</font>";
                      $datatt = time();
                    } else {
                      $datatt = $dbttmmee;
                    }  ?> </font>
                <table width="288" border="0" cellpadding="0" cellspacing="0" bgcolor="#F4F4F4">
                    <tr>
                        <td height="30">
                            <div align="center">
                                <font color="#CC0000" size="2">
                                    Year</font>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font color="#CC0000" size="2">Month<br>
                                </font>
                                <font color="#CC0000" size="2">(1 - 12)</font>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font color="#CC0000" size="2">Day(24)</font>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font color="#CC0000" size="2">Hour</font>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font color="#CC0000" size="2">Minute</font>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font color="#CC0000" size="2">Second</font>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td height="22">
                            <div align="center">
                                <font size="2">
                                    <input name="year" type="text" value="<?php echo dateset("Y", $datatt); ?>" size="4">
                                </font>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font size="2">
                                    <input name="month" type="text" value="<?php echo dateset("m", $datatt); ?>" size="2">
                                </font>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font size="2">
                                    <input name="day" type="text" value="<?php echo dateset("j", $datatt); ?>" size="2">
                                </font>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font size="2">
                                    <input name="hour" type="text" value="<?php echo dateset("H", $datatt); ?>" size="2">
                                </font>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font size="2">
                                    <input name="minute" type="text" value="<?php echo dateset("i", $datatt); ?>" size="2">
                                </font>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <font size="2">
                                    <input name="second" type="text" value="<?php echo dateset("s", $datatt); ?>" size="2">
                                </font>
                            </div>
                        </td>
                    </tr>
                </table>
                <font size="2"><br>
                    <?php notes(" Note: You will have to be in live mode for the timer to work. Also remeber 
        to check the Enable Timing<br>") ?>
                    <center>
                        <input name="change" type="hidden" value="<?php echo $change ?>">
                        <input name="timing_sub" type="hidden" value="yes">
                        <input name="mode" type="hidden" value="timing">
                        <br>
                        <input type="submit" name="Submit" value="Submit">
                    </center>
                </font>
            </form>
            <p>&nbsp;</p>
        </td>
    </tr>
</table>


<?php

} else {
  $enddate = mktime($hour, $minute, $second, $month, $day, $year);
  if ($enddate < time()) {
    echo "<p>&nbsp;</p><center><font size=2 >The time has already passed</font></center><meta http-equiv=\"refresh\"content=\"3;URL=select.php?mode=timing&change=$change\">";
  } else {
    savedata(10, $enddate);
    $inputfile = "yes";
  }
}
}
if ($mode == "textfile") {
  if ($textfile_sub == "") {
    $brtxtdata = explode("-", $dbtxtsets);
    if ($brtxtdata[0] == "") {
      $brtxtdata[0] = "alllines";
      $noset = "<br><font color=blue>Default settings set</font>";
    }
    title("Text Settings");
    ?>

<table width="261" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="261" height="200">
            <font size="2">
                <center>
                    <?php echo $noset ?>
                </center>
                <br>
                <?php notes("When reading text messages off of a text file, there are several options that you can set to display how the text is displayed on the channel.")  ?>
                <br>
            </font>
            <form action="" method="post" name="form">
                <p>
                    <font size="2">
                        <input name="display" type="radio" value="last" <?php if ($brtxtdata[0] == last) {
                                                                          echo "checked";
                                                                        } ?>>
                        Display the last
                        <input name="thisarea1" type="text" size="3" maxlength="3" value="<?php echo $brtxtdata[1];  ?>">
                        lines in the file <br>
                        <input type="radio" name="display" value="onlyline" <?php if ($brtxtdata[0] == onlyline) {
                                                                              echo "checked";
                                                                            } ?>>
                        Display only this line
                        <input name="thisarea2" type="text"" size=" 3" maxlength="3" value="<?php echo $brtxtdata[1];  ?>">
                        <br>
                        <input type="radio" name="display" value="alllines" <?php if ($brtxtdata[0] == alllines) {
                                                                              echo "checked";
                                                                            } ?>>
                        Display all lines<br>
                        <input type="radio" name="display" value="rotate" <?php if ($brtxtdata[0] == rotate) {
                                                                            echo "checked";
                                                                          } ?>>
                        Rotate lines<br>
                        <input name="change" type="hidden" value="<?php echo $change ?>">
                        <input name="textfile_sub" type="hidden" value="yes">
                        <input name="mode" type="hidden" value="textfile">
                    </font>
                    <center>
                        <input type="submit" value="Submit">
                        <br>
                        <br>
                        <?php sameas() ?>
                    </center>
                </p>
            </form>
            <br>
        </td>
    </tr>
</table>
<?php

} else {

  if ($display == "last") {
    $thisarea = $thisarea1;
  }
  if ($display == "onlyline") {
    $thisarea = $thisarea2;
  }

  if ("$sameas" !== "") {
    $dtextfi = $data[$sameas][18];
  } else {
    $dtextfi = "$display-$thisarea-$fade";
  }
  if ($change == "globe") {
    $rb = 13;
  } else {
    $rb = 18;
  }
  savedata($rb, $dtextfi);
  $inputfile = "yes";
}
}
if ($mode == "shadow") {
  if ($sub_shadow == "") {

    $shad = explode("&", $dbtxtsetting);
    function if_sel($vu, $val, $what)
    {
      if ($what == "") {
        $what = "selected";
      }
      if ($vu == "$val") {
        echo $what;
      }
    }

    title("Text Shadow");
    ?>

<table width="265" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="261" height="156">
            <center>
                <form action="" method="post" name="form">
                    <input name="change" type="hidden" value="<?php echo $change ?>">
                    <input name="sub_shadow" type="hidden" value="yes">
                    <input name="mode" type="hidden" value="shadow">
                    <br>
                    <font size="2">Direction of shadow<br>
                        Up Left
                        <input name="direction" type="radio" value="-x-" <?php if_sel($shad[0], "-x-", checked)  ?>>
                        <img src="art/-x-.jpg" width="60" height="25"><br>
                        Down Left
                        <input type="radio" name="direction" value="-x+" <?php if_sel($shad[0], "-x+", checked)  ?>>
                        <img src="art/-x%2B.jpg" width="60" height="25"><br>
                        Down Right
                        <input type="radio" name="direction" value="+x+" <?php if_sel($shad[0], "+x+", checked)  ?>>
                        <img src="art/%2Bx%2B.jpg" width="60" height="25"><br>
                        Up Right
                        <input type="radio" name="direction" value="+x-" <?php if_sel($shad[0], "+x-", checked)  ?>>
                        <img src="art/%2Bx-.jpg"></font> <br>
                    <br>
                    <table width="214" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="101" height="53">
                                <font size="2">Shadow <br>
                                    Distance<br>
                                    <select name="distance">
                                        <option value="1" <?php if_sel($shad[1], "1", '')  ?>>1 Pixel</option>
                                        <option value="2" <?php if_sel($shad[1], "2", '')  ?>>2 Pixels</option>
                                        <option value="3" <?php if_sel($shad[1], "3", '')  ?>>3 Pixels</option>
                                        <option value="4" <?php if_sel($shad[1], "4", '')  ?>>4 Pixels</option>
                                        <option value="5" <?php if_sel($shad[1], "5", '')  ?>>5 Pixels</option>
                                    </select>
                                </font>
                            </td>
                            <td width="113">
                                <p>
                                    <font size="2">Shadow Color<br>
                                        <select name="shcolor" size="2">
                                            <option value="255_255_255" <?php if_sel($shad[2], "255_255_255", '')  ?>>White</option>
                                            <option value="0_0_0" <?php if_sel($shad[2], "0_0_0", '')  ?>>Black</option>
                                            <option value="255_0_0" <?php if_sel($shad[2], "255_0_0", '')  ?>>Red</option>
                                            <option value="0_0_255" <?php if_sel($shad[2], "0_0_255", '')  ?>>Blue</option>
                                            <option value="255_255_0" <?php if_sel($shad[2], "255_255_0", '')  ?>>Yellow</option>
                                            <option value="0_0_255" <?php if_sel($shad[2], "0_0_255", '')  ?>>Green</option>
                                            <option value="255 _204_51" <?php if_sel($shad[2], "255 _204_51", '')  ?>>Orange
                                            </option>
                                            <option value="153 _153 _153" <?php if_sel($shad[2], "153 _153 _153", '')  ?>>Grey</option>
                                        </select>
                                    </font>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <input name="submit" type="submit" value="Submit">
                    <p>
                        <?php sameas() ?>
                    </p>
                </form>
            </center>
        </td>
    </tr>
</table>

<?php

} else {

  if ("$sameas" !== "") {
    $tshad = $data[$sameas][20];
  } else {
    $tshad = "$direction&$distance&$shcolor";
  }
  if ($change == "globe") {
    $rb = 15;
  } else {
    $rb = 20;
  }
  savedata($rb, $tshad);
  $inputfile = "yes";
}
}

if ($mode == "checkimages") {
  echo "<center>Scaned $dbimad file...<br>Results:</center><br><br><font size=2>";
  notes("Below shows what images are good and valid to use <br>with AWDigie in the selected txt file.<br><br>");
  if ($change == "program") {
    $dbimad = $data["other"][1];
  }
  foreach (file("$dbimad") as $line) {

    if (file_exists(ereg_replace("(\n|\r)", "", $line)) && imagecreatefromjpeg(ereg_replace("(\n|\r)", "", $line))) {
      echo "\"$line\" <font color=blue>Is Valid</font><br>";
    } else {

      echo "\"$line\" <font color=red>Is Not Valid</font><br>";
    }
  }
  echo "</font><br><center><input  type=button onClick=\"self.close()\" Value=Close></center>";
}

if ($mode == "zoom") {
  if ($sub_zoom == "") {
    $brz = explode("&", $dbzoom);

    if ("$brz[2]" == "" && "$dothis" == "" or $reset == "reset") {
      $posx = 0;
      $posy = 0;
      $zoom = 256;
      $rotate = 0;
      $dothis = "zin";
      $enback = '';
    } else {

      if ("$dothis" == "") {
        $posx = $brz[2];
        $posy = $brz[1];
        $zoom = $brz[3];
        $rotate = $brz[0];
        $dothis = "zin";
        $buse = $brz[4];
        if ("$brz[4]" !== "") {
          $enback = "yes";
        }
      }
    }
    if ($changed == $buse && $enback == $enchanged && $changeddsb == $dontsizeback) {

      if ($dothis == "zin") {
        $zoom = ($zoom + $power);
      }
      if ($dothis == "zout") {
        $zoom = ($zoom - $power);
      }
      if ($dothis == "zpan") {
        $posy = $zp_y - ($zoom / 2);
        $posx = $zp_x - ($zoom / 2);
      }
      if ($dothis == "zro") {
        $rotate = (128 - $zp_x) + $rotate;
      }
    } // if other
    if ($zoom == 0) {
      $zoom = 1;
    }
    function radio($in)
    {
      global $buse, $enback, $change, $rotate, $brz;
      if ("$buse" == "$in") {
        $ck = "checked";
      } else {
        $href = "onclick=\"form.submit()\"";
      }
      if ("$change" !== "$in" && "$enback" == "yes" && "$rotate" == "0") {
        echo "<input type=radio name=buse value=$in $href $ds $ck> Use Channel$in<br> \n";
      }
    }
    $getsize = @getimagesize($dbaddess);
    $getch = @getimagesize($data["channel" . $buse][1]);
    title("Zoom/Pan");
    ?>
<table width="448" height="426" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="448" height="426">
            <form action="" method="get" name="form" id="form">

                <?php notes("<br>Here you can zoom in, zoom out, pan or rotate.<br>This will only transform the image and not any text or watermarks set.<br>If you zoom out you will notice that there is  black  along sides of<br>the image border, you can replace this black with another channel by clicking <br>on the \"Background Channel\" checkbox and selecting a channel. ");
                if ($data["other"][6] !== "Show") {
                  echo "<font size=2>Channel settings for zooming and panning.<br> Note zooming in can make things pixlelated</font> ";
                }  ?>
                <br><br>
                <table width="457" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="260"><input type="image" name="zp" src="<?php echo "zoom.php?im=$dbaddess&zoom=$zoom&posx=$posx&posy=$posy&rotate=$rotate&buse=$buse&dontsizeback=$dontsizeback";   ?>" width="256" height="256">
                        </td>
                        <td width="183">
                            <p>
                                <input name="enback" type="checkbox" value="yes" onclick="form.submit()" <?php if ("$enback" == "yes") {
                                                                                                            echo "checked";
                                                                                                          }
                                                                                                          if ("$rotate" !== "0") {
                                                                                                            echo "disabled";
                                                                                                          } ?>>
                                <font size="2"> Background Channel<br>
                                    Checking this will use a background image channel<br>
                                    <input name="changed" type="hidden" id="changed" value=<?php echo $buse ?>>
                                    <input name="enchanged" type="hidden" id="enchanged" value=<?php echo $enback ?>>
                                    <input name="changeddsb" type="hidden" id="changeddsb" value=<?php echo $dontsizeback ?>>
                                    <br>
                                    <?php if ($enback == "yes") { ?>
                                    <input name="dontsizeback" type="checkbox" value="yes" onclick="form.submit()" <?php if ($dontsizeback == "yes") {
                                                                                                                      echo "checked";
                                                                                                                    } ?>>
                                    Dont Size Background Image
                                    <?php 
                                  } ?>
                                    <br>
                                    <br>
                                    <?php 
                                    radio(1);
                                    radio(2);
                                    radio(3);
                                    radio(4);
                                    ?>
                                    <br>
                                    <br>
                                    <?php if ($getch[0] < $getsize[0] && $zoom < 240 && "$enback" == "yes" && "$buse" !== "" && $dontsizeback !== "yes") {
                                      echo '<font color=red> Images will look blurry<br>(The background image is smaller then the Channel)</font><br>';
                                    }  ?>
                                </font>
                            </p>
                        </td>
                    </tr>
                </table>
                <table width="452" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="136" height="135">
                            <font size="2">Clicking on image will<br>
                                <img src="art/in.jpg" width="17" height="17"></font>
                            <input type="radio" name="dothis" value="zout" <?php if ($dothis == "zout") {
                                                                              echo "checked";
                                                                            } ?>>
                            <font size="2">Zoom out<br>
                                <img src="art/out.jpg" width="17" height="17">
                                <input name="dothis" type="radio" value="zin" <?php if ($dothis == "zin") {
                                                                                echo "checked";
                                                                              } ?>>
                                Zoom in<br>
                                <img src="art/pan.gif" width="17" height="17">
                                <input name="dothis" type="radio" value="zpan" <?php if ($dothis == "zpan") {
                                                                                  echo "checked";
                                                                                } ?>>
                                Pan</font> <br>
                            <img src="art/ro.gif" width="17" height="17">
                            <font size="2">
                                <input type="radio" name="dothis" value="zro" <?php if ($dothis == "zro") {
                                                                                echo "checked";
                                                                              } ?>>
                                Rotate</font>
                            <font size="2"> <br>
                                Power Control<br>
                                <select name="power">
                                    <option value="22" <?php if ($power == 22) {
                                                          echo "selected";
                                                        } ?>>1</option>
                                    <option value="44" <?php if ($power == 44) {
                                                          echo "selected";
                                                        } ?>>2</option>
                                    <option value="68" <?php if ($power == 68) {
                                                          echo "selected";
                                                        } ?>>3</option>
                                    <option value="90" <?php if ($power == 90) {
                                                          echo "selected";
                                                        } ?>>4</option>
                                    <option value="112" <?php if ($power == 112) {
                                                          echo "selected";
                                                        } ?>>5</option>
                                </select>
                            </font> <br>
                        </td>
                        <td width="316">
                            <div align="right">
                                <font size="2">Click the &quot;To
                                    Channel&quot; button <br>
                                    to save zoom/pan<br>
                                    <input name="rotate" type="hidden" value="<?php echo $rotate ?>">
                                    <input name="change" type="hidden" value="<?php echo $change ?>">
                                    <input name="posy" type="hidden" value="<?php echo $posy ?>">
                                    <input name="posx" type="hidden" value="<?php echo $posx ?>">
                                    <input name="zoom" type="hidden" value="<?php echo $zoom ?>">
                                    <input name="mode" type="hidden" value="zoom">
                                    <input name="sub_zoom" type="submit" value="To Channel">
                                    <br>
                                    <br>
                                    <?php echo "<a href=\"select.php?change=$change&mode=zoom&reset=reset\">Reset</a>"; ?>
                                </font>
                            </div>
                        </td>
                    </tr>
                </table>
                <div align="center"></div>
            </form>
        </td>
    </tr>
</table>


<?php

} else {

  if ("$sameas" !== "") {
    $tzoom = $data[$sameas][21];
  } else {
    $tzoom = "$rotate&$posy&$posx&$zoom&$buse&$dontsizeback&";
  }
  echo "Saving as $buse<br>";
  savedata(21, "$tzoom");
  $inputfile = "yes";
}
}
if ($mode == "record") {

  if ($sub_record == "") {
    $brr = explode("%", $data["settings"][11]);

    function if_select($mnum, $this)
    {
      if ("$this" == "") {
        if ($mnum == date("n", "")) {
          echo "selected";
        }
      } else {
        if ("$this" == "$mnum") {
          echo "selected";
        }
      }
    }

    function if_date($let)
    {
      global $brr;
      if ("$brr[2]" == "") {
        return date("$let");
      } else {
        return date("$let", $brr[2]);
      }
    }
    title("Recording");
    ?>
<script language=javascript>
    function alla(id, v) {
        for (i = 0; i < 2; i++) {
            document.getElementById(id + [i]).innerText = v;
        }
    }
</script>
<form method="post" action="">
    <table width="310" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="310">
                <p>
                    <font size="2"><br>
                        This will only record channels when they are live.<br>
                        Or select All Broadcast to record all of the channels in broadcasting
                        order. Channels will not be recorded with settings<br>
                        <select name="recordwhat" size="1" onChange=" alla('what',this.options[this.selectedIndex].value)">
                            <option value="all">The Broadcast</option>
                            <option value="Channel1">Channel1</option>
                            <option value="Channel2">Channel2</option>
                            <option value="Channel3">Channel3</option>
                            <option value="Channel4">Channel4</option>
                        </select>
                    </font>
                </p>

                <table width="264" border="0" cellpadding="0" cellspacing="0" bgcolor="#F4F4F4">
                    <tr>
                        <td height="15" colspan="4">
                            <p>
                                <input name="start_en" type="checkbox" value="yes" <?php if ($brr[1] == "yes") {
                                                                                      echo "checked";
                                                                                    } ?>>
                                <font size="2"> Start Recording At time <br>
                                    Current time
                                    <?php echo date("m:j:H:i") ?>
                                    <br>
                                </font>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td width="74" height="52">
                            <p align="center">
                                <font color="#CC0000" size="2">
                                    Month<br>
                                    (1 - 12)<br></font>
                                <input name="stmonth" type="text" value="<?php echo if_date("m"); ?>" size="2">
                                <font color="#CC0000" size="2"> </font>
                            </p>
                        </td>
                        <td width="42">
                            <div align="center">
                                <font color="#CC0000" size="2">Day</font><br>
                                <input name="stday" type="text" value="<?php echo if_date("j"); ?>" size="2" maxlength="2">
                            </div>
                        </td>
                        <td width="59">
                            <center>
                                <font color="#CC0000" size="2">Hour(24)</font> <br>

                                <input name="sthour" type="text" value="<?php echo if_date("H"); ?>" size="2" maxlength="2">

                            </center>
                        </td>
                        <td width="69">
                            <center>
                                <font color="#CC0000" size="2">Minute</font><br>

                                <input name="stmin" type="text" value="<?php echo if_date("i"); ?>" size="2" maxlength="2">
                                </font>
                            </center>
                        </td>
                    </tr>
                </table>
                <font size="2"><br>
                    Stop after
                    <input name="stop_after" type="text" size="4" value="<?php echo $brr[5]  ?>">
                    Images <br>
                    <br>
                    Images will be saved as <strong> :<br>
                        rec/<a id=wdir0><?php echo $brr[6] ?></a>/<a id=what0><?php echo $brr[0] ?></a>_<a id=wprefex><?php echo $brr[7] ?></a>xxx.jpg
                    </strong><br>
                    <br>
                    A Text file for later playing back will be <br>
                    created as:<br>
                    <b>txt/rec_<a id=what1><?php echo $brr[0] ?></a>_<a id=wdir1><?php echo $brr[6] ?></a>.txt";
                    </b> <br>
                    <input name="dir" type="text" size="10" value="<?php echo $brr[6]  ?>" onchange="if(this.value == ''){ alla('wdir','<?php echo $brr[6]  ?>'); this.value=('<?php echo $brr[6]  ?>'); }else{ alla('wdir',this.value); } ">
                    /
                    <input name="prefex" type="text" size="10" value="<?php echo $brr[7]  ?>" onchange="if(this.value == ''){ document.getElementById('wprefex').innerText=('<?php echo $brr[7]  ?>'); this.value=('<?php echo $brr[7]  ?>'); }else{  document.getElementById('wprefex').innerText=this.value  } ">
                </font> .jpg<font size="2"><br>
                    <input name="sub_record" type="submit" value="Submit">
                    <input name="change" type="hidden" value="settings">
                    <input name="mode" type="hidden" value="record">
                </font>
            </td>
        </tr>
    </table>
</form>
<p>
    <?php

  } else {
    $brr = explode("%", $data["settings"][11]);
    $rec_txt = "txt/rec_" . $recordwhat . "_" . $dir . ".txt";
    if (!file_exists($rec_txt)) {
      fopen($rec_txt, "a+");
    }
    if ($brr[6] !== $dir && sizeof(@file("txt/rec_$brr[0]_$brr[6].txt")) == 0) {
      unlink("txt/rec_$brr[0]_$brr[6].txt");
    } //if txt file exists
    if (!is_dir("rec/$dir/")) {
      if ((@mkdir("rec/$dir/", 0777)) == false) {
        echo "<font color=red>Cant Create The Directory <b>rec/$dir/</b></font> <br>Make sure that <b>rec/</b> has the correct permissions <br><br>";
        $dont = np;
      }
    }
    $startdate = mktime($sthour, $stmin, "0", $stmonth, $stday, date("Y"));
    if ($startdate < time() && $start_en == "yes") {
      echo "<font color=red>The time has already passed </font><br>";
      $dont = "np";
    }
    echo "<br>$startdate<br>" . time() . "";
    if ($dont == "") {
      savedata(11, "$recordwhat%$start_en%$startdate%$with_marks%$to_txt%$stop_after%$dir%$prefex");
      $inputfile = "yes";
    }
  }
}
if ($mode == "create_view") {
  title("Create View");
  ?>
    <p align="center">
        <meta http-equiv="refresh" content="10">
        <img src="tv.php" width="256" height="256"><br>
        <font size="2">Image will update in 10 seconds<br>
            "create picture <?php echo  str_replace('select.php', 'tv.php', $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']); ?>
            update=10"</font> <br>
        <textarea name="textarea" cols="40">
<meta http-equiv="refresh" content="10">
<img src="tv.php" width="256" height="256">
<font size="2">Image will update in 10 seconds<br>
"create picture <?php echo  str_replace('select.php', 'tv.php', $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']); ?> update=10"</font>
 </textarea>
    </p>
    <?php

  }
  if ($mode == "moni") {
    title("Viewing $chn");
    ?>
    <meta http-equiv="refresh" content="<?php echo $uf ?>">
    <center>
        <img src="channels.php?size=big&chan=<?php echo $chn ?>" width="256" height="256"><br>
        <font size="2">Update Frequency <?php for ($a = 1; $a < 21; $a++) {
                                          $b = '';
                                          $eb = '';
                                          if ($uf == $a) {
                                            $b = '<b><font size=3>';
                                            $eb = '</font></b>';
                                          }
                                          echo " $b<a href=select.php?uf=$a&mode=moni&change=$change>$a</a>$eb \n";
                                        }  ?></font>
    </center>
    <?php 
  }
  if ($mode == "awsettings") {
    if ($sub_awsettings == "") {
      title("AWDigie Settings");
      $net = explode("^%", $data["other"][8]);
      $gdeset = explode("&", $data["other"][9]);
      ?>
    <script language="JavaScript">
        function bytokb(input) {
            document.form.byte.value = input * 1024;
        }

        function kbtoby(input) {
            document.form.kb.value = Math.round(input / 1024);
        }
    </script>
    <table width="488" height="383" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="488" height="84" bgcolor="#F7F4F4">
                <form name="form" method="post" action="">
                    <strong>Guides</strong>
                    <?php echo $discript ?>
                    <font size="2">
                        <?php notes(" <br>
          These settings will be used on the admin control panel. If an image 
          is above the settings below, they will be red tagged.<br>
          <br>") ?>
                        <br>
                    </font>
                    <table width="498" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="197">
                                <font size="2">Max Image Size</font><br>
                                <font size="2">Hieght
                                    <input name="imH" type="text" id="imH" size="3" maxlength="3" value=<?php echo $gdeset[0] ?>>
                                    Width
                                    <input name="imW" type="text" id="imW" size="3" maxlength="3" value=<?php echo $gdeset[1] ?>>
                                </font>
                            </td>
                            <td width="301">
                                <font size="2">Max Image File Size</font><br>
                                <font size="2">
                                    Kilobytes
                                    <input name="imKB" type="text" id="kb" value="<?php echo round($gdeset[2] / 1024) ?>" size="7" onChange="bytokb(this.value)">
                                    Bytes
                                    <input name="imBY" type="text" id="byte" value="<?php echo $gdeset[2] ?>" size="7" onChange="kbtoby(this.value)">
                                </font>
                            </td>
                        </tr>
                    </table>
                    <input name="sub_awsettings" type="submit" value="Set Guides">
                </form>

            </td>
        </tr>
        <tr>
            <td height="239" bgcolor="#E8EAEC">
                <form name="form2" method="get" action="http://www.vmist.net/activeworlds/awscripts/awdigie/network_setup.php">
                    <table width="488" height="275" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="2">
                                <div align="center"><strong><a href="http://www.vmist.net/activeworlds/awscripts/awdigie/network.php" target="newnet">Network</a>
                                        Settings</strong>
                                    <font size="2"> <br>
                                        <input name="tognetwork" type="checkbox" value="yes" <?php if ($net[1] == "yes") {
                                                                                                echo "checked";
                                                                                              } ?>>
                                        Place this station on the AWDigie network.</font>
                                </div>
                                <font size="2">
                                    <?php notes("  <br>
          The AWDigie network is a list of users that are currently <br>
          using AWDigie and placing their station on the <a href=http://www.vmist.net/activeworlds/awscripts/awdigie/network.php target=_newnet>AWDigie Network</a>. People can view the list and watch online, rank, take snapshots or make comments. <br>
By adding your station to the network all content outputted must be PG or below, it may be removed at any time without notice. <br>
          <br>") ?>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td width="255" height="223">
                                <font size="2">Required Information<br>
                                    <br>
                                    Station Name or call letters<br>
                                    <input name="name" type="text" id="name" value="<?php echo $net[0] ?>" size="10" maxlength="10">
                                    <br>
                                    <input name="path" type="hidden" value="<?php echo  str_replace('select.php', '', $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']); ?>">
                                    <input name="thisup" type="hidden" value="<?php echo $net[5] ?>">
                                </font>
                                <font size="2"><br>
                                    <br>
                                    Station Discription <br>
                                </font>
                                <font size="2">
                                    <textarea name="discript" cols="25" rows="3" id="textarea2"><?php echo  str_replace("returnthisline", "\n", stripslashes($net[2])); ?></textarea>
                                    <br>
                                </font>
                                <font size="2">&nbsp; </font>
                            </td>
                            <td width="233">
                                <font size="2"><br>
                                    Optional Info<br>
                                    <br>
                                    Update Frequency in Seconds<br>
                                    <input name="fre" type="text" size="5" maxlength="5" value=<?php echo $net[4];  ?>>
                                    <br>
                                    Homepage<br>
                                    <input name="homepage" type="text" id="homepage" value="<?php echo $net[7] ?>">
                                    <br>
                                    Image Logo (small image)<br>
                                    <input name="logo" type="text" id="logo" value="<?php echo $net[8] ?>">
                                    <br>
                                    Email<br>
                                    <input name="owner" type="text" id="owner" value="<?php echo  stripslashes($net[9])  ?>">
                                    <br>
                                    <input name="rank" type="checkbox" id="rank" value="yes" <?php if ($net[10] == "yes") {
                                                                                                echo "checked";
                                                                                              } ?>>
                                    Allow Ranking<br>
                                    <input name="comments" type="checkbox" id="comments" value="yes" <?php if ($net[12] == "yes") {
                                                                                                        echo "checked";
                                                                                                      } ?>>
                                    Allow Comments</font>
                            </td>
                        </tr>
                    </table>
                    <font size="2">
                        <input name="setthis" type="submit" id="setthis" value="Set Network Settings">
                        <br>
                    </font>
                </form>

            </td>
        </tr>
    </table>
    <p>
        <?php
        $discript = stripslashes(str_replace("\r\n", "returnthisline", "$discript"));
      } else {

        if ($netpwork == "yes") {

          savedata(8, "$name^%$tognetwork^%$discript^%$path^%$fre^%$thisup^%$views^%$homepage^%$logo^%$owner^%$rank^%$save^%$comments^%");
        } else {
          savedata(9, "$imH&$imW&$imBY");
        }
        $inputfile = "yes";
      }
    }

    if ($mode == "layers") {
      if ("$sub_layers" == "") {
        title("Text Water Mark Layers");
        echo $dbfunction;
        ?>
    </p>
    <form action="" method="post" name="form" id="form">
        <table width="339" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td width="339">
                    <div align="center">
                        <font size="2">Select how to layer
                            the watermark and text message<br>
                            <br>
                            Watermark on top, text on bottom.<br>
                            <a href="<?php echo "select.php?mode=layers&sub_layers=yes&order=imagetextYwatermark&change=$change" ?>"><img src="art/water_over.jpg" width="180" height="60" border="<?php if ($dbfunction  == "imagetextYwatermark") {
                                                                                                                                                                                                      echo 3;
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                      echo 0;
                                                                                                                                                                                                    } ?>"></a><br>
                            Text on top watermark on bottom.<br>
                            <a href="<?php echo "select.php?mode=layers&sub_layers=yes&order=watermarkYimagetext&change=$change"; ?>"><img src="art/text_over.jpg" width="176" height="57" border="<?php if ($dbfunction  == "watermarkYimagetext") {
                                                                                                                                                                                                      echo 3;
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                      echo 0;
                                                                                                                                                                                                    } ?>"></a><br>
                            <input name="change2" type="hidden" value="<?php echo $change ?>">
                            <input name="sub_layers" type="hidden" id="timing_sub" value="yes">
                            <input name="mode" type="hidden" id="mode" value="layers">
                            <br>
                            <?php sameas() ?>
                            <br>
                        </font>
                    </div>
                </td>
            </tr>
        </table>
    </form>
    <p>
        <?php

      } else {
        if ("$sameas" !== "") {
          $tl = $data[$sameas][24];
        } else {
          $tl = "$order";
        }
        savedata(24, $tl);
        $inputfile = "yes";
      }
    }

    if ($inputfile == "yes") {
      $fp = fopen("$datapath", "w+");
      foreach ($new_file as $line) {
        fputs($fp, "$line");
      }
      fclose($fp);
      echo '
<script language="javascript"> 
window.opener.location.reload(); 
window.close(); 
</script> ';
    }
  } // cookie

  ?>
    </p> 