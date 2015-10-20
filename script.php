<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$msg = "";

if (count($argv)<2) {
    echo 'Arguments needed:\r\n'
    .    '1. Directory (pictures will be saved here, inside a folder "pictures")\r\n'
    .    '2. Number > 0 (number that denotes where to download from; ex. 16 will download pictures from 20150421.com/16)\r\n'
    .    '3. Number > 0 [optional] (if enetered, will download from all urls starting from the 2nd arg through the 3rd arg (including))\r\n';
}

$directory = $argv[1];
if (substr($directory, -1) != '\\') {
    $directory .= '\\';
}
$number_start = $argv[2];
if (count($argv)==3) {
    $number_end = $number_start;
} else {
    $number_end = $argv[3];
}

for ($number=$number_start; $number<=$number_end; $number++) {
    if (!empty($number)) {
        $url = "http://www.20150421.com/" . $number;
        $doc = new DOMDocument;
        if ($doc->loadHTMLFile($url)) {
            $msg = $doc->getElementsByTagName("title")->item(0)->textContent;
            $date = substr($doc->getElementsByTagName("title")->item(0)->textContent, 11, 6);
            $folder = $doc->getElementsByTagName("h4")->item(0)->firstChild->nextSibling->textContent;
            $image_nodes = $doc->getElementsByTagName("p");
            $num = 1;
            if(!is_dir($directory."pictures/".$folder)) {
                mkdir($directory."pictures/".$folder, 0777, true);
            }
            if (file_exists($directory."pictures\\".$folder."\\".$date.".jpg")) {
                $num++;
                while (file_exists($directory."pictures\\".$folder."\\".$date."(".$num.").jpg")) {
                    $num++;
                }
            }
            for ($i=1; $i< ($image_nodes->length-4); $i++) {
                if ($image_nodes->item($i)->firstChild!=NULL) {
                    if ($image_nodes->item($i)->firstChild->firstChild!=NULL) {
                        $image = $image_nodes->item($i)->firstChild->firstChild->attributes->getNamedItem("dir")->value;
                        if ($num==1) {
                            file_put_contents($directory."pictures\\".$folder."\\".$date.".jpg", fopen($image, 'r'));
                        } else {
                            file_put_contents($directory."pictures\\".$folder."\\".$date."(".$num.").jpg", fopen($image, 'r'));
                        }
                        $num++;
                    }
                }
                
            }
        } else {
            $msg = 'cant load';
        }
    }
}