<?php
namespace encrypt\model;
// require_once('modules/encrypt/model/Alphabet.php');

class EnglishAlphabet {

    private $alphabet = [];

    public function __construct () {
         $this->alphabet = range('a', 'z');
    }

    public function getLetterByIndex($i) : string {
        if ($i < $this->alphabet) {
            return $this->alphabet[$i];
        } else {
            throw new Exception('Index value is larger than alphabets length');
        }
    }

    public function getLength () : int {
        return count($this->alphabet);
    }
    


}