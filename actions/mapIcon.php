<?php

$number = (int) $_GET['n'];

$image = imagecreatefrompng('assets/images/mapIcon.png');
$color = imagecolorallocate($image, 255, 255, 255);

$x = 12;
$fontsize = 10;
if (strlen($number) > 1) {
    $x = $x - (strlen($number)+2);
}
if (strlen($number) > 2) {
    $fontsize = 3;
    $x = 6;
}

imagestring($image,$fontsize,$x,5,$number,$color);

//Header e output
header('Content-type: image/png');
imagepng($image,null,9);
exit;
?>