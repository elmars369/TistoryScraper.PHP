<?php
require 'GenericTistory.class.php';
class Tistory_ohmy8irl extends GenericTistory {
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
        $this->imageUrlPattern = "/http[s]?:\/\/www\.googledrive\.com\/host\/[\w]*/";
    }
    
    public function setFileName() {
        parent::setFileName();
    }
    public function setSubFolderName() {
        parent::setSubFolderName();
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