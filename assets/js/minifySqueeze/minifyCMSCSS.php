<?php

$sourcecss = array();
$sourcecss[] = "/mc/webprojects/awscms/assets/css/";

foreach ($sourcecss as $sourcekey) {

    $sourcefolder = $sourcekey;
    $keydata = str_replace("/", "-", $sourcekey) . "#1";
    $compkey = md5($keydata);
    $compfolder = $sourcekey . $compkey . "/";

    $cssFiles = array();

    $cssdir = scandir($sourcefolder);
    $cnt = 0;
    foreach ($cssdir as $key) {
        if ($key === "." || $key === "..") {
            continue;
        }
        $newfile = str_replace('.css', '', $key) . '-' . $compkey . '.css';
        $cssFiles[$cnt]["fileurl"] = $sourcefolder . $key;
        $cssFiles[$cnt]["minfileurl"] = $compfolder . $newfile;
        $cnt++;
    }

    if (is_dir($compfolder) === false) {
        mkdir($compfolder);
    }

    for ($i = 0; $i < count($cssFiles); $i++) {

        $cssURL = $cssFiles[$i]['fileurl'];
        $cssMinPath = $cssFiles[$i]['minfileurl'];

        echo $cssURL . '<br/>';
        echo $cssMinPath . '<br/>';

        if ($cssURL == $cssMinPath) {
            echo 'Similar Files<br/>';
            continue;
        }

        $cssContents = file_get_contents($cssURL);
        $minifiedCss = compress($cssContents);
        $minifiedCss = css_strip_whitespace($minifiedCss);

        $fp = fopen($cssMinPath, 'w');
        fwrite($fp, $minifiedCss);
        fclose($fp);

        echo 'Done<br/>';
    }
}

function compress($buffer) {
    /* remove comments */
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    /* remove tabs, spaces, newlines, etc. */
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}

function css_strip_whitespace($css) {
    $replace = array(
        "#/\*.*?\*/#s" => "", // Strip C style comments.
        "#\s\s+#" => " ", // Strip excess whitespace.
    );
    $search = array_keys($replace);
    $css = preg_replace($search, $replace, $css);

    $replace = array(
        ": " => ":",
        "; " => ";",
        " {" => "{",
        " }" => "}",
        ", " => ",",
        "{ " => "{",
        ";}" => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} " => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys($replace);
    $css = str_replace($search, $replace, $css);

    return trim($css);
}
