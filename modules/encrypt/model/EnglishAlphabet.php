<?php
namespace encrypt\model;
use Exception;
require_once('modules/encrypt/model/customExceptions.php');

class EnglishAlphabet {

    private $alphabet = [];

    public function __construct () {
         $this->alphabet = range('a', 'z');
    }

    public function getCharacterByIndex($i) : string {
        if ($i < count($this->alphabet)) {
            return $this->alphabet[$i];
        } else {
            throw new Exception('Index value is larger than alphabets length');
        }
    }

    public function getIndexByCharacter ($character) : int {
        $index = array_search($character, $this->alphabet);
        if (gettype($index) != 'integer') {
            throw new IllegalCharacterException('Letter not included in alphabet');
        }
        return $index;
    }

    public function getLength () : int {
        return count($this->alphabet);
    }
    


}