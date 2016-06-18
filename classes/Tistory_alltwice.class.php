<?php
require 'GenericTistory.class.php';
class Tistory_alltwice extends GenericTistory {
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
        $this->sortPatternArray = array(
            "default" => "/<title>.*([0-9][0-9]\/[0-1][0-9]\/[0-3][0-9])/"
        );
    }
    public function setFileName() {
        $file_name_array = array();
        $pattern = $this->sortPatternArray["default"];
        if (preg_match($pattern, $this->html, $file_name_array) == 1) {
            $this->fileName = str_replace('/', '', $file_name_array[1]);
        } else {
            $this->fileName = "image";
        }
    }
    public function setMainFolderName() {
        parent::setMainFolderName();
    }
    public function setSubFolderName() {
        parent::setSubFolderName();
        $this->subFolderName = str_replace('/', '', $this->subFolderName);
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