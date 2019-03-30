<?php
$datapath = "art/database.php";
foreach (file("$datapath") as $line) {
    $br = explode("^^", $line);
    $brset = explode("^^", $new_file[1]);
    if ("$br[11]" == "chan_enabled" or $br[0][0] !== c) {
        foreach ($br as $brsett) {
            $data[$br[0]][] = $brsett;
        }
    }
}

$orimage = imagecreatefromjpeg("$im");
$getsize = getimagesize($im);
$image = imagecreatetruecolor($getsize[0], $getsize[1]);
if ("$buse" !== "" && file_exists($data["channel" . $buse][1]) && "$rotate" == "0") {
    $bckim = imagecreatefromjpeg($data["channel" . $buse][1]);
    $getcan = getimagesize($data["channel" . $buse][1]);
    if ($dontsizeback == "yes") {
        $getcan[0] = $getsize[0];
        $getcan[1] = $getsize[1];
    }
    $image = imagecreatetruecolor($getcan[0], $getcan[1]);
    imageCopyResampled($image, $bckim, 0, 0, 0, 0, $getsize[0], $getsize[1], $getsize[0], $getsize[1]);
}
if ("$rotate" !== "0") {
    $orimage = imagerotate($orimage, $rotate, 0);
}
imageCopyResampled($image, $orimage, $posx, $posy, 0, 0, $zoom, $zoom, 256, 256);
imagejpeg($image, null 95);
imagedestroy($image);
 