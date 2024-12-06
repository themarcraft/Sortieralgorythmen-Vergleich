<?php

$width = 2000;
$height = 1000;

$yAchseSkalierung = 100000;
$xAchseSkalierung = 1000;

$im = imagecreate($width, $height);
$col['grau'] = imagecolorallocate($im, 152, 152, 152);
$col['hellgrau'] = imagecolorallocate($im, 230, 230, 230);
$col['schwarz'] = imagecolorallocate($im, 0, 0, 0);
$col['rot'] = imagecolorallocate($im, 255, 0, 0);
$col['gruen'] = imagecolorallocate($im, 0, 255, 0);
$col['blau'] = imagecolorallocate($im, 0, 0, 255);
$col['orange'] = imagecolorallocate($im, 150, 255, 100);
$col['gelb'] = imagecolorallocate($im, 255, 255, 0);
$arial = $_SERVER["DOCUMENT_ROOT"] . "/arial.ttf";

$yAchseZaehler = 0;
for ($i = 0; $i < 60; $i += 5) {
    if ($yAchseZaehler == 0) {
        imagettftext($im, 15, 0, 130, ($height - 25), $col['rot'], $arial, '' . $yAchseZaehler);
    } elseif($yAchseZaehler < 1000) {
        imageline($im, 150, ($height - 50) - 15 * $i, $width - 50, ($height - 50) - 15 * $i, $col['hellgrau']);
        imagettftext($im, 15, 0, 110, ($height - 42) - 15 * $i, $col['rot'], $arial, $yAchseZaehler);
    } else {
        imageline($im, 150, ($height - 50) - 15 * $i, $width - 50, ($height - 50) - 15 * $i, $col['hellgrau']);
        imagettftext($im, 15, 0, 100 - 15 * 4, ($height - 42) - 15 * $i, $col['rot'], $arial, $yAchseZaehler);
    }
    $yAchseZaehler += $yAchseSkalierung;
}

$xAchseZaehler = 0;
for ($i = 0; $i < 18; $i += 1) {
    if ($xAchseZaehler == 0) {

    } else {
        imageline($im, 100 * $i + 150, $height - 50, 100 * $i + 150, 50, $col['hellgrau']);
        imagettftext($im, 15, 0, 100 * $i - 15 + 150, $height - 25, $col['rot'], $arial, $xAchseZaehler);
    }
    $xAchseZaehler += $xAchseSkalierung;
}


$radixSortWerte = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/radixsort.json'));
for($i = 0; $i < count($radixSortWerte) - 1; $i++) {
    imageline($im, round(150 + $radixSortWerte[$i][0] / $xAchseSkalierung), round($height - 50 - $radixSortWerte[$i][1] / $yAchseSkalierung), round(150 + $radixSortWerte[$i + 1][0] / $xAchseSkalierung), round($height - 50 - $radixSortWerte[$i + 1][1] / $yAchseSkalierung), $col['gruen']);
}

$quickSortWerte = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/quicksort.json'));
for($i = 0; $i < count($quickSortWerte) - 1; $i++) {
    imageline($im, round(150 + $quickSortWerte[$i][0] / $xAchseSkalierung), round($height - 50 - $quickSortWerte[$i][1] / $yAchseSkalierung), round(150 + $quickSortWerte[$i + 1][0] / $xAchseSkalierung), round($height - 50 - $quickSortWerte[$i + 1][1] / $yAchseSkalierung), $col['blau']);
}

$insertionSortWerte = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/insertionsort.json'));
for($i = 0; $i < count($insertionSortWerte) - 1; $i++) {
    imageline($im, round(150 + $insertionSortWerte[$i][0] / $xAchseSkalierung), round($height - 50 - $insertionSortWerte[$i][1] / $yAchseSkalierung), round(150 + $insertionSortWerte[$i + 1][0] / $xAchseSkalierung), round($height - 50 - $insertionSortWerte[$i + 1][1] / $yAchseSkalierung), $col['orange']);
}

$bucketSortWerte = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/bucketsort.json'));
for($i = 0; $i < count($bucketSortWerte) - 1; $i++) {
    imageline($im, round(150 + $bucketSortWerte[$i][0] / $xAchseSkalierung), round($height - 50 - $bucketSortWerte[$i][1] / $yAchseSkalierung), round(150 + $bucketSortWerte[$i + 1][0] / $xAchseSkalierung), round($height - 50 - $bucketSortWerte[$i + 1][1] / $yAchseSkalierung), $col['gelb']);
}

imageline($im, 150, 50, 150, $height - 50, $col['schwarz']);
imageline($im, 150, $height - 50, $width - 50, $height - 50, $col['schwarz']);

imageline($im, 125, 100, 150, 50, $col['schwarz']);
imageline($im, 175, 100, 150, 50, $col['schwarz']);

imageline($im, $width - 100, $height - 75, $width - 50, $height - 50, $col['schwarz']);
imageline($im, $width - 100, $height - 25, $width - 50, $height - 50, $col['schwarz']);

imagettftext($im, 20, 0, $width - 400, $height - 100, $col['schwarz'], $arial, "Anzahl Elemente (in Tausend)");
imagettftext($im, 20, 0, 25, 35, $col['schwarz'], $arial, "Anzahl Durchläufe (in Tausend)");

imagettftext($im, 30, 0, $width / 2 - 500, 50, $col['gruen'], $arial, "Radix Sort");
imagettftext($im, 30, 0, $width / 2 - 300, 50, $col['schwarz'], $arial, "vs");
imagettftext($im, 30, 0, $width / 2 - 250, 50, $col['blau'], $arial, "Quicksort");
imagettftext($im, 30, 0, $width / 2 - 75, 50, $col['schwarz'], $arial, "vs");
imagettftext($im, 30, 0, $width / 2 - 25, 50, $col['orange'], $arial, "Insertion Sort");
imagettftext($im, 30, 0, $width / 2 + 225, 50, $col['schwarz'], $arial, "vs");
imagettftext($im, 30, 0, $width / 2 + 275, 50, $col['gelb'], $arial, "Bucket Sort");

imagettftext($im, 20, 0, $width / 2 - 125, 100, $col['schwarz'], $arial, "©2024 Marvin Niermann");

imagepng($im, "tmp.png");

imagedestroy($im);


?>

<img src="tmp.png" width="100%">
<button onclick="location.href = '<?= $_SERVER['DOCUMENT_ROOT'] ?>/graph.php'">Reload</button>