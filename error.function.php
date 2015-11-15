<?php

function error($error_msg) {
    echo 'Error: '.$error_msg.PHP_EOL;
    echo 'Arguments needed:'.PHP_EOL
    .    '1. Directory (pictures will be saved here, inside a folder named after the provided URL)'.PHP_EOL
    .    '2. URL (the tistories URL)'.PHP_EOL
    .    '3. Numbers (numbers that denote where to download from; ex. 16 will download pictures from URL/16)'.PHP_EOL
    .    '4. Character [optional] (if enetered, will determine how the pictures are stored)'.PHP_EOL;
    die();
}