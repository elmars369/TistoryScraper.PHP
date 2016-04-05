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
        $this->imageUrlPattern = "/http[s]?:\/\/cfile[0-9]*\.uf.tistory.com\/attach\/[\w]*/";
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
        preg_match_all($this->imageUrlPattern, $this->html, $this->imageArray);
        for ($i = 0; $i < count($this->imageArray[0]); $i++) {
            str_replace("attach", "original", $this->imageArray[0][$i]);
        }
        array_shift($this->imageArray[0]);
    }
    public function prepareDirectory() {
        parent::prepareDirectory();
    }
    public function download() {
        parent::download();
    }
}