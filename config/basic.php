<?php

function pr($array, $end = true) {
    if (!is_object($array)) {
        if (!is_array($array)) {
            $array = htmlspecialchars($array);
        } else {
            foreach ($array as $key => $str) {
                if (is_string($str)) {
                    try {
                        $array[$key] = htmlspecialchars($str);
                    } catch (Exception $e) {
                        var_dump($str);
                        die();
                    }
                }
            }
        }
    }

    echo "<pre>";
        print_r($array);
    echo "</pre>";
    if ($end) {
        die();
    }
}

function logs($content = "") {
    if (LOGSWRITE) {
        iBDL\Core\Log::write($content);
    }
}