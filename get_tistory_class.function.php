<?php

function get_tistory_class($url) {
    
    $TISTORIES = array("20150421", "ohmy8irl");
    
    if (substr($url, 0, 4) != "http") { // Can't connect without a http or https wrapper, add it if absent.
        $url = "http://" . $url;
    }
    if ($html = @file_get_contents($url)) {
        // Check if the provided Tistory has a special class
        
        for ($i = 0; $i < count($TISTORIES); $i++) {
            if (preg_match($TISTORIES[$i], $url) == 1) {
                $class = "Tistory_" . $TISTORIES[$i];
                $included = (include 'classes/'.$class.'.class.php');
                $i = count($TISTORIES);
            }
        }
        if (!isset($included) || $included == FALSE) {
            $class = 'GenericTistory';
            require 'classes/'.$class.'.class.php';
        }
        $tistory_class = new $class($url);
        return $tistory_class;
    } else {
        return FALSE;   // Can't connect.
    }
}
