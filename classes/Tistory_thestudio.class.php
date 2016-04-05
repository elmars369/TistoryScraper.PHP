<?php
require 'GenericTistory.class.php';
class Tistory_thestudio extends GenericTistory {
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
        array_shift($this->imageArray[0]);
        array_shift($this->imageArray[0]);
        array_shift($this->imageArray[0]);
    }
    public function prepareDirectory() {
        parent::prepareDirectory();
    }
    public function download() {
        parent::download();
    }
}
