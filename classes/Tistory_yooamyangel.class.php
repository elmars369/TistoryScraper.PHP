<?php
require 'GenericTistory.class.php';
class Tistory_yooamyangel extends GenericTistory {
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
        $this->imageUrlPattern = "/http[s]?:\/\/cfile[0-9]*\.uf.tistory.com\/image\/[\w]*/";
        $this->sortPatternArray = array(
            "default" => "/<a href=\"\/[0-9]+\">([0-9][0-9][0-1][0-9][0-3][0-9])/"
        );
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
        preg_match_all($this->imageUrlPattern, $this->html, $this->imageArray);
        for ($i = 0; $i < count($this->imageArray[0]); $i++) {
            str_replace("image", "original", $this->imageArray[0][$i]);
        }
        for ($i = 0; $i < 4; $i++) {
            array_shift($this->imageArray[0]);
        }
    }
    public function prepareDirectory() {
        parent::prepareDirectory();
    }
    public function download() {
        parent::download();
    }
}