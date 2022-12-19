<?php

include 'JSqueeze.php';

use Patchwork\JSqueeze;

$jz = new JSqueeze();

$jsFiles = array();

$jsFiles[0]["fileurl"] = "/var/www/html/EtvBharatPrimeApps/balbharat/pdf/mcpdf.min.js";
$jsFiles[0]["minfileurl"] = "/var/www/html/EtvBharatPrimeApps/balbharat/pdf/mcpdf.min.min.js";

for ($i = 0; $i < count($jsFiles); $i++) {

    $jsURL = $jsFiles[$i]['fileurl'];
    $jsMinPath = $jsFiles[$i]['minfileurl'];

    echo $jsURL . '<br/>';
    echo $jsMinPath . '<br/>';

    if ($jsURL == $jsMinPath) {
        echo 'Similar Files<br/>';
        continue;
    }

    $jsContents = file_get_contents($jsURL);
    $minifiedJs = $jz->squeeze(
            $jsContents,
            true, // $singleLine
            true, // $keepImportantComments
            false // $specialVarRx
    );

    $fp = fopen($jsMinPath, 'w');
    fwrite($fp, $minifiedJs);
    fclose($fp);

    echo 'Done<br/>';
}
