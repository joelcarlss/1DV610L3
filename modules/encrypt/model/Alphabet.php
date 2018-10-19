<?php
namespace encrypt\model;

class Alphabet {

    private $alphabet;

    public function getLetterByIndex($i) : string {
        if ($i < $this->alphabet) {
            return $this->alphabet[$i];
        } else {
            throw new Exception('This should be impossible');
        }
    }

}