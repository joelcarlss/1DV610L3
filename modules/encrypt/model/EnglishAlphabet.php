<?php
namespace encrypt\model;


class EnglishAlphabet {

    private $alphabet;

    public function __construct () {
         $this->alphabet = range('a', 'z');
    }
    

}