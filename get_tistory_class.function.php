<?php

function get_tistory_class($parameters) {
    $url = $parameters->url;
    $TISTORIES = array("20150421", "ohmy8irl", "990618", "all-twice", "thestudio",
        "yooamyangel", "keyhami");
    if ($html = @file_get_contents($url)) {
        // Check if the provided Tistory has a special class

        for ($i = 0; $i < count($TISTORIES); $i++) {
            if (preg_match("/" . $TISTORIES[$i] . "/", $url) == 1) {
                $class = "Tistory_" . str_replace('-', '', $TISTORIES[$i]);
                $included = (include 'classes/'.$class.'.class.php');
                $i = count($TISTORIES);
            }
        }
        if (!isset($included) || $included == FALSE) {
            $class = 'GenericTistory';
            require 'classes/'.$class.'.class.php';
        }
        $tistory_class = new $class($parameters);
        return $tistory_class;
    } else {
        return FALSE;   // Can't connect.
    }
}
