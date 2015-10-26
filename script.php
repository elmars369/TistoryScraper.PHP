<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'get_tistory_class.function.php';

function error($error_msg) {
    echo 'Error: '.$error_msg.PHP_EOL;
    echo 'Arguments needed:'.PHP_EOL
    .    '1. Directory (pictures will be saved here, inside a folder "pictures")'.PHP_EOL
    .    '2. URL (the tistories URL)'.PHP_EOL
    .    '3. Number > 0 (number that denotes where to download from; ex. 16 will download pictures from URL/16)'.PHP_EOL
    .    '4. Number >= 2nd arg [optional] (if enetered, will download from all urls starting from the 2nd arg through the 3rd arg (including))'.PHP_EOL;
    die();
}


$start_time = microtime(true);

// Passed argument errors
if (count($argv)<4) {
    error('Not enough arguments passed.');
}
if (count($argv)>5) {
    error('Too many arguments passed.');
}
if (!is_dir($argv[1])) {
    error('Passed directory does not exist.');
}
if ($argv[3]<1) {
    error('Second argument needs to be a positive number.');
}
if ($argv[4]!=NULL && $argv[4]<$argv[3]) {
    error('Third argument needs to be a number that is larger or equal to the second argument.');
}
// Passed argument errors


$directory = $argv[1];
if (substr($directory, -1) != '\\') {       // Add backslash to dirrectory name if there already isn't one.
    $directory .= '\\';
}
$number_start = $argv[3];
if (count($argv)==4) {                      // If a third argument is not passed, set the end number the same as the start number.
    $number_end = $number_start;
} else {
    $number_end = $argv[4];
}


if ($tistory_class = get_tistory_class($argv[2])) {
    $tistory_class->download($directory, $number_start, $number_end);
} else {
    echo 'Can not load provided URL - '.$argv[2];
}

echo round(((microtime(TRUE) - $start_time)/60), 1)." minutes elapsed while downloading.";