<?php

function get_tistory_class($url) {
    if (substr($url, 0, 4) != "http") {
        $url = "http://" . $url;
    }
    if ($html = @file_get_contents($url)) {
        $pattern = "/<title>.*<\/title>/";
        $title_array = array();
        preg_match($pattern, $html, $title_array);
        $title = $title_array[0];
        if (preg_match("/남똑/", $title)) { // http://www.20150421.com
            $class = 'Tistory_20150421';
            $included = (include 'classes/'.$class.'.class.php');
        } elseif (preg_match("/찰캉찰캉/", $title)) {   // http://ohmy8irl.tistory.com/
            $class = 'Tistory_ohmy8irl';
            $included = (include 'classes/'.$class.'.class.php');
        } else {
            $class = 'GenericTistory';
            $included = (include 'classes/'.$class.'.class.php');   // Generic tistory.
        }
        if (!$included) {
            $class = 'GenericTistory';
            require 'classes/'.$class.'.class.php';
        }
        $tistory_class = new $class($url);
        return $tistory_class;
    } else {
        return FALSE;
    }
}
