<?php
require 'GenericTistory.class.php';
class Tistory_20150421 extends GenericTistory {
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
        parent::setFileName();
    }
    public function setSubFolderName() {
        $folder_name_array = array();
        $pattern = "/Filed under : <a href=\".*\">.*\((.*)\)<\/a>/";
        if (preg_match($pattern, $this->html, $folder_name_array) == 1) {
            $this->subFolderName = $folder_name_array[1];
        } else {
            parent::setSubFolderName();
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