<?php

class Parameters {
    public $dir;
    public $url;
    public $array;
    public $sort;
    
    public function __construct($arguments) {
        if (count($arguments)<4) {
            error('Not enough arguments passed.');
        }
        if (count($arguments)>5) {
            error('Too many arguments passed.');
        }
        
        $this->parseDir($arguments[1]);
        $this->parseUrl($arguments[2]);
        $this->parseNum($arguments[3]);
        if (isset($arguments[4])) {
            $this->sort = $arguments[4];
        } else {
            $this->sort = "default";
        }

    }
    
    private function parseDir($dir) {
        if (!is_dir($dir)) {
            if (!@mkdir($dir, 0777, TRUE)) {
                error('Passed directory does not exist and can\'t be made.');
            }
        }
        $this->dir = $dir;
    }
    
    private function parseUrl($url) {
        $url = strtolower($url);
        if (substr($url, 0, 4) != "http") { // Can't connect without a http or https wrapper, add it if absent.
            $url = "http://" . $url;
        }
        $this->url = $url;
    }
    
    private function parseNum($num) {
        $arr = array();
        if (preg_match_all("/([0-9]+[-]?[0-9]*)[^0-9]*/", $num, $arr) != FALSE) {
            $this->array = $arr[1];
            $this->sortArray();
        } else {
            error("Third argument needs to be either a positive number or a sequence of numbers separated by '-'");
        }
    }
    
    private function sortArray() {
        $size = count($this->array);
        for ($i = 0; $i < $size; $i++) {
            if (strpos($this->array[$i], '-') !== FALSE) {
                if (substr($this->array[$i], -1) == '-') {
                    $this->array[$i] = rtrim($this->array[$i], '-');
                } else {
                    $intervalArray = explode('-', $this->array[$i]);
                    for ($j = $intervalArray[0]+1; $j <= $intervalArray[1]; $j++) {
                        array_push($this->array, (string)$j);
                    }
                    $this->array[$i] = $intervalArray[0];
                }
            }
        }
        $this->array = array_unique($this->array);
        sort($this->array);
    }
}
