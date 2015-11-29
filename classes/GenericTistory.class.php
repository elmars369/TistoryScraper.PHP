<?php

class GenericTistory {
    public $html;
    public $fileName;
    public $mainFolderName;
    public $subFolderName;
    public $imageUrlPattern;
    public $imageArray;
    public $fileNumber;
    public $parameters;
    public $sortPatternArray;


    public function __construct($parameters) {
        $this->html = '';
        $this->fileName = '';
        $this->mainFolderName = '';
        $this->subFolderName = '';
        $this->imageArray = array();
        $this->imageUrlPattern = "/http[s]?:\/\/cfile[0-9]*\.uf.tistory.com\/original\/[\w]*/";
        $this->fileNumber = 1;
        $this->parameters = $parameters;
        $this->sortPatternArray = array(
            "default" => "/<title>.*([0-9][0-9][0-1][0-9][0-3][0-9])/"
        );
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
        if ($this->parameters->sort == "none") {
            $this->subFolderName = "";
        } else {
            if (array_key_exists($this->parameters->sort, $this->sortPatternArray)) {
                $pattern = $this->sortPatternArray[$this->parameters->sort];
            } else {
                $pattern = $this->sortPatternArray["default"];
            }
            if (preg_match($pattern, $this->html, $folder_name_array) == 1) {
                $this->subFolderName = $folder_name_array[1];
            } else {
                $this->subFolderName = $this->mainFolderName;
            }
        }
    }
    public function setImageArray() {
        preg_match_all($this->imageUrlPattern, $this->html, $this->imageArray);
    }
    public function prepareDirectory() {
        $this->mainFolderName = substr($this->parameters->url, strpos($this->parameters->url, '://')+3);
        if (strpos($this->mainFolderName, 'www.') !== FALSE) {
            $this->mainFolderName = substr($this->mainFolderName, strpos($this->mainFolderName, 'www.')+4);
        }
        if (strpos($this->mainFolderName, '/') !== FALSE) {
            $this->mainFolderName = substr($this->mainFolderName, 0, strpos($this->mainFolderName, '/'));
        }
        if(!is_dir($this->parameters->dir."/".$this->mainFolderName."/".$this->subFolderName)) {   // Make folder if it does not exist.
            mkdir($this->parameters->dir."/".$this->mainFolderName."/".$this->subFolderName, 0777, true);
        }
        if (file_exists($this->parameters->dir."/".$this->mainFolderName."/".$this->subFolderName."/".$this->fileName.".jpg")) {       // Check if images already exist with given name.
            $this->fileNumber++;
            while (file_exists($this->parameters->dir."/".$this->mainFolderName."/".$this->subFolderName."/".$this->fileName."(".$this->fileNumber.").jpg")) {
                $this->fileNumber++;
            }
        }
    }
    public function download() {
        foreach ($this->parameters->array as $number) {           // Download from all URLs in th argument range.
            $url = $this->parameters->url . '/' . $number;
            if ($this->html = @file_get_contents($url)) {
                $this->setFileName();
                $this->setSubFolderName();
                $this->setImageArray();
                $this->prepareDirectory();
                echo 'Downloaded from .../'.$number.' to .../'.$this->subFolderName.' :';
                foreach ($this->imageArray[0] as $image) {
                    if ($this->fileNumber==1) {
                        if (@file_put_contents($this->parameters->dir."/".$this->mainFolderName."/".$this->subFolderName."/".$this->fileName.".jpg", fopen($image, 'r'))) {
                            echo ' '.$this->fileName.".jpg;";
                        } else {
                            echo ' '.$this->fileName.".jpg [failed];"; 
                        }
                    } else {
                        if (@file_put_contents($this->parameters->dir."/".$this->mainFolderName."/".$this->subFolderName."/".$this->fileName."(".$this->fileNumber.").jpg", fopen($image, 'r'))) {
                            echo ' '.$this->fileName."(".$this->fileNumber.").jpg;";
                        } else {
                            echo ' '.$this->fileName."(".$this->fileNumber.").jpg [failed];"; 
                        }
                    }
                    $this->fileNumber++;
                }
                $this->fileNumber = 1;
                echo PHP_EOL.'Download of .../'.$number." complete.".PHP_EOL;
            } else {
                echo 'Failed to load '.$url.' --- skipped.'.PHP_EOL;
            }
        }
    }
}
