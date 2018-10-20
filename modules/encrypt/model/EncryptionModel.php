<?php
namespace encrypt\model;

class EncryptionModel {

    private $key;

    private $englishAlphabet;

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
                $characterIndex = $this->englishAlphabet->getIndexByCharacter($value);
                $newCalculatedIndex = $this->getCalculatedIndexByKeyAndIndex($characterIndex);
                $encryptedLetter = $this->getCharacterByIndex($newCalculatedIndex);
                $encryptedMessage .= $encryptedLetter;
            }
        }
        return $encryptedMessage;
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