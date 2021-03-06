<?php
require 'GenericTistory.class.php';
class Tistory_ohmy8irl extends GenericTistory {
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
        parent::__construct($parameters);
        if (!extension_loaded('openssl')) {
            echo "Extension \"openssl\" is not loaded. See README, section 6.1.";
            die();
        }
        $this->sortPatternArray = array(
            "default" => "/<meta name=\"twitter:title\" content=\"([0-9][0-9][0-1][0-9][0-3][0-9])/"
        );
        $this->imageUrlPattern = "/http[s]?:\/\/www\.googledrive\.com\/host\/[\w]*/";
    }
    public function setFileName() {
        parent::setFileName();
    }
    public function setMainFolderName() {
        parent::setMainFolderName();
    }
    public function setSubFolderName() {
        parent::setSubFolderName();
    }
    public function setImageArray() {
        parent::setImageArray();
    }
    public function prepareDirectory() {
        parent::prepareDirectory();
    }
    public function download() {
        parent::download();
    }
}