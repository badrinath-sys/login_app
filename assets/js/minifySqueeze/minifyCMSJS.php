<?php

include 'JSqueeze.php';

use Patchwork\JSqueeze;

$jz = new JSqueeze();

$jsFiles = array();
$cnt = 0;

$jsFiles[$cnt]["fileurl"] = "/mc/webprojects/awscms/assets/js/ads.js";
$jsFiles[$cnt]["minfileurl"] = "/mc/webprojects/awscms/assets/js/min/ads.min.js";
$cnt++;

$jsFiles[$cnt]["fileurl"] = "/mc/webprojects/awscms/assets/js/common.js";
$jsFiles[$cnt]["minfileurl"] = "/mc/webprojects/awscms/assets/js/min/common.min.js";
$cnt++;

$jsFiles[$cnt]["fileurl"] = "/mc/webprojects/awscms/assets/js/country_state.js";
$jsFiles[$cnt]["minfileurl"] = "/mc/webprojects/awscms/assets/js/min/country_state.min.js";
$cnt++;

$jsFiles[$cnt]["fileurl"] = "/mc/webprojects/awscms/assets/js/country_state_new.js";
$jsFiles[$cnt]["minfileurl"] = "/mc/webprojects/awscms/assets/js/min/country_state_new.min.js";
$cnt++;

$jsFiles[$cnt]["fileurl"] = "/mc/webprojects/awscms/assets/js/notification_validations.js";
$jsFiles[$cnt]["minfileurl"] = "/mc/webprojects/awscms/assets/js/min/notification_validations.min.js";
$cnt++;

$jsFiles[$cnt]["fileurl"] = "/mc/webprojects/awscms/assets/js/pellipandiri.js";
$jsFiles[$cnt]["minfileurl"] = "/mc/webprojects/awscms/assets/js/min/pellipandiri.min.js";
$cnt++;

$jsFiles[$cnt]["fileurl"] = "/mc/webprojects/awscms/assets/js/siri_country_state.js";
$jsFiles[$cnt]["minfileurl"] = "/mc/webprojects/awscms/assets/js/min/siri_country_state.min.js";
$cnt++;

$jsFiles[$cnt]["fileurl"] = "/mc/webprojects/awscms/assets/js/siri_validations.js";
$jsFiles[$cnt]["minfileurl"] = "/mc/webprojects/awscms/assets/js/min/siri_validations.min.js";
$cnt++;

$jsFiles[$cnt]["fileurl"] = "/mc/webprojects/awscms/assets/js/validations.js";
$jsFiles[$cnt]["minfileurl"] = "/mc/webprojects/awscms/assets/js/min/validations.min.js";
$cnt++;

$jsFiles[$cnt]["fileurl"] = "/mc/webprojects/awscms/assets/js/validations_new.js";
$jsFiles[$cnt]["minfileurl"] = "/mc/webprojects/awscms/assets/js/min/validations_new.min.js";
$cnt++;

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
