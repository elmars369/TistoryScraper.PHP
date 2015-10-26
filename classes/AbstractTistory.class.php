<?php

abstract class AbstractTistory {
    public $tistoryUrl;
    public $html;
    public $date;
    public $mainFolderName;
    public $subFolderName;
    public $imageUrlPattern;
    public $imageArray;
    public $fileNumber;
    
    public function __construct($url) {
        $this->tistoryUrl = $url;
        $this->html = '';
        $this->date = '';
        $this->mainFolderName = '';
        $this->subFolderName = '';
        $this->imageArray = array();
        $this->imageUrlPattern = "/http:\/\/cfile[0-9]*\.uf.tistory.com\/original\/[\w]*/";
        $this->fileNumber = 1;
    }
    abstract public function setDate();
    abstract public function setSubFolderName();
    abstract public function setImageArray();
    abstract public function prepareDirectory($directory);
    abstract public function download($directory, $first, $last);
}
