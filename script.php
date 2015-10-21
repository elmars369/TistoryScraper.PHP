<?php

function error($error_msg) {
    echo 'Error: '.$error_msg.PHP_EOL;
    echo 'Arguments needed:'.PHP_EOL
    .    '1. Directory (pictures will be saved here, inside a folder "pictures")'.PHP_EOL
    .    '2. Number > 0 (number that denotes where to download from; ex. 16 will download pictures from 20150421.com/16)'.PHP_EOL
    .    '3. Number >= 2nd arg [optional] (if enetered, will download from all urls starting from the 2nd arg through the 3rd arg (including))'.PHP_EOL;
    die();
}


// Passed argument errors
if (count($argv)<3) {
    error('Not enough arguments passed.');
}
if (count($argv)>4) {
    error('Too many arguments passed.');
}
if (!is_dir($argv[1])) {
    error('Passed directory does not exist.');
}
if ($argv[2]<1) {
    error('Second argument needs to be a positive number.');
}
if ($argv[3]!=NULL && $argv[3]<$argv[2]) {
    error('Third argument needs to be a number that is larger or equal to the second argument.');
}
// Passed argument errors


$directory = $argv[1];
if (substr($directory, -1) != '\\') {       // Add backslash to dirrectory name if there already isn't one.
    $directory .= '\\';
}
$number_start = $argv[2];
if (count($argv)==3) {                      // If a third argument is not passed, set the end number the same as the start number.
    $number_end = $number_start;
} else {
    $number_end = $argv[3];
}

for ($number=$number_start; $number<=$number_end; $number++) {          // Download from all URLs in th argument range.
    echo round(($number-$number_start)/($number_end-$number_start+1)*100).'%'.PHP_EOL;  // Percentage indicator.
    $url = "http://www.20150421.com/" . $number;
    $doc = new DOMDocument;
    if (@$doc->loadHTMLFile($url)) {            // Check if file can be loaded.
        $date = substr($doc->getElementsByTagName("title")->item(0)->textContent, 11, 6);  // Get the date the pictures were taken.
        $folder = $doc->getElementsByTagName("h4")->item(0)->firstChild->nextSibling->textContent;  // Get the category name
        $image_nodes = $doc->getElementsByTagName("img");
        $num = 1;       // Image numbering
        if(!is_dir($directory."pictures/".$folder)) {   // Make folder if it does not exist.
            mkdir($directory."pictures/".$folder, 0777, true);
        }
        if (file_exists($directory."pictures\\".$folder."\\".$date.".jpg")) {       // Check if images already exist with given name.
            $num++;
            while (file_exists($directory."pictures\\".$folder."\\".$date."(".$num.").jpg")) {
                $num++;
            }
        }
        for ($i=0; $i < $image_nodes->length; $i++) {       // Checks all images, if they fit the criteria - download.
            if (substr($image_nodes->item($i)->attributes->getNamedItem("src")->value, 0, 12) == "http://cfile") {
                $image = $image_nodes->item($i)->parentNode->attributes->getNamedItem("dir")->value;
                if ($num==1) {
                    file_put_contents($directory."pictures\\".$folder."\\".$date.".jpg", fopen($image, 'r'));
                } else {
                    file_put_contents($directory."pictures\\".$folder."\\".$date."(".$num.").jpg", fopen($image, 'r'));
                }
                $num++;
            }

        }
    } else {
        echo 'Failed to load '.$url.' --- skipped.'.PHP_EOL;
    }
}
echo '100%'.PHP_EOL;