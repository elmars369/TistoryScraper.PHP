<?php
require 'GenericTistory.class.php';
class Tistory_alltwice extends GenericTistory {
    public $tistoryUrl;
    public $html;
    public $fileName;
    public $mainFolderName;
    public $subFolderName;
    public $imageUrlPattern;
    public $imageArray;
    public $fileNumber;
    
    public function __construct($url) {
        parent::__construct($url);
    }
    public function setFileName() {
        $file_name_array = array();
        $pattern = "/<title>.*([0-9][0-9]\/[0-1][0-9]\/[0-3][0-9])/";
        if (preg_match($pattern, $this->html, $file_name_array) == 1) {
            $this->fileName = str_replace('/', '', $file_name_array[1]);
        } else {
            $this->fileName = "image";
        }
    }
    public function setSubFolderName() {
        $folder_name_array = array();
        $pattern = "/<title>.*([0-9][0-9]\/[0-1][0-9]\/[0-3][0-9])/";
        if (preg_match($pattern, $this->html, $folder_name_array) == 1) {
            $this->subFolderName = str_replace('/', '', $folder_name_array[1]);
        } else {
            $this->subFolderName = $this->mainFolderName;
        }
    }
    public function setImageArray() {
        parent::setImageArray();
    }
    public function prepareDirectory($directory) {
        parent::prepareDirectory($directory);
    }
    public function download($directory, $first, $last) {
        parent::download($directory, $first, $last);
    }
}