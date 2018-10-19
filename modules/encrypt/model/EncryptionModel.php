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
    public function encryptStringWithKey(string $string) {
        $stringAsArray = str_split($string);
        $encryptedMessage = '';
        if (isset($this->key)) {
            foreach ($stringAsArray as $key => $value) {
                echo $value;
                echo $this->englishAlphabet->getIndexByCharacter($value);
            }
        }

    }

    public function getIndexPlaceByKeyAndLetter() {

    }


}