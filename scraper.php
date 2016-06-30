<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
//error_reporting(0);

require 'get_tistory_class.function.php';
require 'error.function.php';
require 'classes/Parameters.class.php';

if(!ini_get('allow_url_fopen')) {
    echo "Configuration parameter \"allow_url_fopen\" is not enabled. See README, section 6.2.";
    die();
}

$start_time = microtime(true);


// Passed argument errors
$parameters = new Parameters($argv);
// Passed argument errors

if ($tistory_class = get_tistory_class($parameters)) {
    $tistory_class->download();
} else {
    echo 'Can not load provided URL - '.$parameters->url.PHP_EOL;
}

echo round(((microtime(TRUE) - $start_time)/60), 1)." minutes elapsed.".PHP_EOL;
