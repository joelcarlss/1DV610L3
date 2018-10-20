<?php
namespace encrypt\model;

class EncryptionModel {

    private $key;

    private $englishAlphabet;

    private $spaceCharacter = ' ';

    public function __construct (\encrypt\model\EnglishAlphabet $ea) {
        $this->englishAlphabet = $ea;
    }

    public function setKey(int $key) {
        $this->key = $key;
    }

    public function encryptStringWithKey(string $string) : string {
        $stringAsArray = str_split($string);
        $encryptedMessage = '';
        if (isset($this->key)) {
            foreach ($stringAsArray as $key => $value) {
                $encryptedLetter = '';
                if ($this->characterIsSpace($value)) {
                    $encryptedLetter .= $this->spaceCharacter;
                } else {
                    $encryptedLetter .= $this->encryptCharacterWithKey($value);
                    echo $encryptedLetter;
                    
                }
                $encryptedMessage .= $encryptedLetter;
            }
        }
        return $encryptedMessage;
    }
    private function encryptCharacterWithKey(string $character) : string {
        $characterIndex = $this->englishAlphabet->getIndexByCharacter($character);
        $newCalculatedIndex = $this->getCalculatedIndexByKeyAndIndex($characterIndex);
        $encryptedLetter = $this->getCharacterByIndex($newCalculatedIndex);
        return $encryptedLetter;
    }

    private function characterIsSpace(string $character) {
        return ($character == ' ');
    }
    private function getCharacterByIndex($index) {
        return $this->englishAlphabet->getCharacterByIndex($index);
    }
    private function getCalculatedIndexByKeyAndIndex ($index) {
        $alphabetLength = $this->englishAlphabet->getLength();
        $newCalculatedIndex =  ($this->key + $index);
        if ($newCalculatedIndex >= $alphabetLength) {
            $newCalculatedIndex -= $alphabetLength;
        }
        return $newCalculatedIndex;
    }

    public function getIndexPlaceByKeyAndLetter() {

    }


}