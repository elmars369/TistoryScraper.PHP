<?php

class GenericTistory {
    public $tistoryUrl;
    public $html;
    public $fileName;
    public $mainFolderName;
    public $subFolderName;
    public $imageUrlPattern;
    public $imageArray;
    public $fileNumber;
    
    public function __construct($url) {
        $this->tistoryUrl = $url;
        $this->html = '';
        $this->fileName = '';
        $this->mainFolderName = '';
        $this->subFolderName = '';
        $this->imageArray = array();
        $this->imageUrlPattern = "/http[s]?:\/\/cfile[0-9]*\.uf.tistory.com\/original\/[\w]*/";
        $this->fileNumber = 1;
    }
    public function setFileName() {
        $file_name_array = array();
        $pattern = "/<title>.*([0-9][0-9][0-1][0-9][0-3][0-9])/";
        if (preg_match($pattern, $this->html, $file_name_array) == 1) {
            $this->fileName = $file_name_array[1];
        } else {
            $this->fileName = "image";
        }
    }
    public function setSubFolderName() {
        $folder_name_array = array();
        $pattern = "/<title>.*([0-9][0-9][0-1][0-9][0-3][0-9])/";
        if (preg_match($pattern, $this->html, $folder_name_array) == 1) {
            $this->subFolderName = $folder_name_array[1];
        } else {
            $this->subFolderName = $this->mainFolderName;
        }
    }
    public function setImageArray() {
        preg_match_all($this->imageUrlPattern, $this->html, $this->imageArray, PREG_SET_ORDER);
    }
    public function prepareDirectory($directory) {
        $this->mainFolderName = substr($this->tistoryUrl, strpos($this->tistoryUrl, '://')+3);
        if (strpos($this->mainFolderName, '/') != FALSE) {
            $this->mainFolderName = substr($this->mainFolderName, 0, strpos($this->mainFolderName, '/'));
        }
        if(!is_dir($directory.$this->mainFolderName."/".$this->subFolderName)) {   // Make folder if it does not exist.
            mkdir($directory.$this->mainFolderName."/".$this->subFolderName, 0777, true);
        }
        if (file_exists($directory.$this->mainFolderName."/".$this->subFolderName."/".$this->fileName.".jpg")) {       // Check if images already exist with given name.
            $this->fileNumber++;
            while (file_exists($directory.$this->mainFolderName."/".$this->subFolderName."/".$this->fileName."(".$this->fileNumber.").jpg")) {
                $this->fileNumber++;
            }
        }
    }
    public function download($directory, $first, $last) {
        if (!@file_get_contents($this->tistoryUrl)) {
            echo 'Can not connect to '.$this->tistoryUrl;
        } else {
            for ($number=$first; $number<=$last; $number++) {          // Download from all URLs in th argument range.
                if (round(($number-$first)/($last-$first+1)*100) != round(($number-$first-1)/($last-$first+1)*100)) {
                    echo round(($number-$first)/($last-$first+1)*100).'%'.PHP_EOL;  // Percentage indicator.
                }
                $url = $this->tistoryUrl . '/' . $number;
                if ($this->html = @file_get_contents($url)) {
                    $this->setFileName();
                    $this->setSubFolderName();
                    $this->setImageArray();
                    $this->prepareDirectory($directory);
                    foreach ($this->imageArray as $image) {
                        if ($this->fileNumber==1) {
                            @file_put_contents($directory.$this->mainFolderName."/".$this->subFolderName."/".$this->fileName.".jpg", fopen($image[0], 'r'));
                        } else {
                            @file_put_contents($directory.$this->mainFolderName."/".$this->subFolderName."/".$this->fileName."(".$this->fileNumber.").jpg", fopen($image[0], 'r'));
                        }
                        $this->fileNumber++;
                    }
                    $this->fileNumber = 1;
                } else {
                    echo 'Failed to load '.$url.' --- skipped.'.PHP_EOL;
                }
            }
            echo '100%'.PHP_EOL;
        }
    }
}
